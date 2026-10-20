<?php

namespace App\Config;

class App
{
    private static bool $booted = false;

    public static function boot(): void
    {
        if (self::$booted) {
            return;
        }

        self::loadEnv(__DIR__ . '/../../.env');

        // Configure error handling according to environment
        $isDev = (getenv('APP_ENV') ?: 'development') === 'development';
        $debug = filter_var(getenv('APP_DEBUG') ?: $isDev, FILTER_VALIDATE_BOOLEAN);

        if ($debug) {
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', '0');
            ini_set('display_startup_errors', '0');
            error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        }

        ini_set('log_errors', '1');
        $logPath = __DIR__ . '/../../storage/logs/app.log';
        ini_set('error_log', $logPath);

        // Security headers
        if (!headers_sent()) {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
        }

        // Session setup with secure defaults
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_httponly', '1');
            ini_set('session.use_only_cookies', '1');
            ini_set('session.cookie_samesite', 'Lax');
            session_start();
        }

        self::$booted = true;
    }

    public static function loadEnv(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (str_contains($line, '=')) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Strip quotes if present
                if ((str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                    (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
                    $value = substr($value, 1, -1);
                }

                if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
                    putenv("{$key}={$value}");
                    $_ENV[$key] = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }
    }

    public static function url(string $path = ''): string
    {
        if (!empty($_SERVER['HTTP_HOST'])) {
            $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $base = "{$scheme}://{$host}";
        } else {
            $base = rtrim(getenv('APP_URL') ?: 'http://localhost:5000', '/');
        }

        $path = '/' . ltrim($path, '/');
        return $path === '/' ? $base : $base . $path;
    }
}
