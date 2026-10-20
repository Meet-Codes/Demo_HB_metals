<?php

namespace App\Support;

use App\Config\App;

class Helpers
{
    /**
     * Escape HTML output safely using ENT_QUOTES and UTF-8
     */
    public static function e(?string $value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generate canonical or absolute URL
     */
    public static function url(string $path = ''): string
    {
        return App::url($path);
    }

    /**
     * Generate asset URL with cache-busting timestamp
     */
    public static function asset(string $path): string
    {
        $relativePath = ltrim($path, '/');
        $fullPath = __DIR__ . '/../../public/' . $relativePath;
        $version = file_exists($fullPath) ? filemtime($fullPath) : '1.0';
        return App::url($relativePath) . '?v=' . $version;
    }

    /**
     * Slugify a text string
     */
    public static function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text ?: 'n-a');
    }

    /**
     * Render a view template with variables
     */
    public static function view(string $template, array $data = [], string $layout = 'layouts/main'): void
    {
        extract($data);

        // Path to the inner content template
        $templatePath = __DIR__ . '/../Views/' . str_replace('.', '/', $template) . '.php';

        if (!file_exists($templatePath)) {
            http_response_code(500);
            echo "View template not found: " . self::e($template);
            return;
        }

        // Buffer the page content
        ob_start();
        require $templatePath;
        $content = ob_get_clean();

        // If a layout is specified, wrap with layout
        if ($layout !== '') {
            $layoutPath = __DIR__ . '/../Views/' . str_replace('.', '/', $layout) . '.php';
            if (file_exists($layoutPath)) {
                require $layoutPath;
                return;
            }
        }

        echo $content;
    }

    /**
     * Redirect to another URL safely
     */
    public static function redirect(string $path, int $status = 302): void
    {
        $target = str_starts_with($path, 'http') ? $path : self::url($path);
        header("Location: {$target}", true, $status);
        exit;
    }

    /**
     * Return JSON response
     */
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
