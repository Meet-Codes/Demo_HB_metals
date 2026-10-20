<?php

namespace App\Models;

class Category
{
    public static function all(): array
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM product_categories ORDER BY sort_order ASC, id ASC");
            $rows = $stmt->fetchAll();
            if (!empty($rows)) {
                return $rows;
            }
        } catch (\Throwable $e) {
            error_log("Category error: " . $e->getMessage());
        }

        $siteData = require __DIR__ . '/../../data/site_data.php';
        return array_values($siteData['categories']);
    }

    public static function findBySlug(string $slug): ?array
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM product_categories WHERE slug = ? LIMIT 1");
            $stmt->execute([$slug]);
            $row = $stmt->fetch();
            if ($row) {
                return $row;
            }
        } catch (\Throwable $e) {
            error_log("Category find error: " . $e->getMessage());
        }

        $siteData = require __DIR__ . '/../../data/site_data.php';
        return $siteData['categories'][$slug] ?? null;
    }
}
