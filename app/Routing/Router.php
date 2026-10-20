<?php

namespace App\Routing;

use App\Models\Database;
use App\Support\Helpers;

class Router
{
    private array $routes = [];

    public function get(string $path, array|callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, array|callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, array|callable $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $this->normalizePath($path),
            'handler' => $handler,
        ];
    }

    private function normalizePath(string $path): string
    {
        $parsed = parse_url($path, PHP_URL_PATH) ?? '/';
        // If path has a file extension like .xml or .txt, keep it without trailing slash
        if (preg_match('~/[^/]+\.[a-z0-9]+$~i', $parsed)) {
            return '/' . ltrim($parsed, '/');
        }
        $trimmed = trim($parsed, '/');
        return $trimmed === '' ? '/' : '/' . $trimmed . '/';
    }

    public function dispatch(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $requestPath = parse_url($requestUri, PHP_URL_PATH) ?? '/';

        // Check if there are active redirects
        $this->checkRedirects($requestPath);

        $normalizedPath = $this->normalizePath($requestPath);

        // Normalize trailing slash for directories (exclude paths with file extensions)
        if ($requestPath !== '/' && !str_ends_with($requestPath, '/') && !preg_match('~/[^/]+\.[a-z0-9]+$~i', $requestPath)) {
            $queryString = $_SERVER['QUERY_STRING'] ?? '';
            $target = $requestPath . '/' . ($queryString ? '?' . $queryString : '');
            Helpers::redirect($target, 301);
            return;
        }

        // Match registered routes
        try {
            foreach ($this->routes as $route) {
                $methodMatches = ($route['method'] === $requestMethod) || ($requestMethod === 'HEAD' && $route['method'] === 'GET');
                if ($methodMatches && $route['path'] === $normalizedPath) {
                    $this->executeHandler($route['handler']);
                    return;
                }
            }

            // Dynamic Product Category check: /product-category/{slug}/
            if ($requestMethod === 'GET' && preg_match('~^/product-category/([^/]+)/$~', $normalizedPath, $matches)) {
                $this->executeHandler([\App\Controllers\ProductController::class, 'category'], [$matches[1]]);
                return;
            }
        } catch (\Throwable $e) {
            error_log("Unhandled Exception at {$requestUri}: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            http_response_code(500);
            Helpers::view('errors.500', [
                'meta_title' => 'Server Error (500) | HB Metals India',
                'meta_description' => 'A server incident occurred while processing your request.',
            ]);
            return;
        }

        // 404 Not Found
        http_response_code(404);
        Helpers::view('errors.404', [
            'meta_title' => 'Page Not Found (404) | HB Metals India',
            'meta_description' => 'The requested page could not be located on HB Metals India.',
            'requested_path' => $requestPath,
        ]);
    }

    private function executeHandler(array|callable $handler, array $params = []): void
    {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            $controller = new $class();
            call_user_func_array([$controller, $method], $params);
            return;
        }
    }

    private function checkRedirects(string $path): void
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT destination_path, http_status FROM url_redirects WHERE source_path = ? AND active = 1 LIMIT 1");
            $stmt->execute([$path]);
            $redirect = $stmt->fetch();
            if ($redirect) {
                Helpers::redirect($redirect['destination_path'], (int)$redirect['http_status']);
            }
        } catch (\Throwable $e) {
            // Ignore DB redirect errors on cold start
        }
    }
}
