<?php

namespace App\Models;

class Product
{
    public static function all(?int $categoryId = null, ?string $search = null): array
    {
        try {
            $pdo = Database::getConnection();
            $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, pi.image_path as image
                    FROM products p
                    LEFT JOIN product_categories c ON p.category_id = c.id
                    LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_primary = 1
                    WHERE p.status = 'published'";
            $params = [];

            if ($categoryId !== null) {
                $sql .= " AND p.category_id = ?";
                $params[] = $categoryId;
            }

            if ($search !== null && trim($search) !== '') {
                $sql .= " AND (p.name LIKE ? OR p.short_description LIKE ? OR p.chemical_name LIKE ? OR p.cas_number LIKE ? OR p.chemical_formula LIKE ?)";
                $term = '%' . trim($search) . '%';
                $params[] = $term;
                $params[] = $term;
                $params[] = $term;
                $params[] = $term;
                $params[] = $term;
            }

            $sql .= " ORDER BY p.featured DESC, p.id ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll();

            foreach ($rows as &$row) {
                self::decodeJsonFields($row);
            }
            return $rows;
        } catch (\Throwable $e) {
            error_log("Product all error: " . $e->getMessage());
        }

        // Fallback to PHP site data
        $siteData = require __DIR__ . '/../../data/site_data.php';
        $items = array_values($siteData['products']);

        if ($categoryId !== null) {
            // Find category slug corresponding to categoryId
            $catMap = [
                1 => 'magnesium-products',
                2 => 'magnesium-products',
                3 => 'sodium-tungstate',
                4 => 'tungsten-oxide',
                5 => 'tungsten-oxide',
                6 => 'metal-oxides',
                7 => 'metallic-salts',
                8 => 'ammonium-paratungstate',
            ];
            $targetSlug = $catMap[$categoryId] ?? null;
            if ($targetSlug) {
                $items = array_filter($items, fn($p) => ($p['category_slug'] ?? '') === $targetSlug);
            }
        }

        if ($search !== null && trim($search) !== '') {
            $q = strtolower(trim($search));
            $items = array_filter($items, function ($item) use ($q) {
                return str_contains(strtolower($item['name'] ?? ''), $q) ||
                       str_contains(strtolower($item['short_description'] ?? ''), $q) ||
                       str_contains(strtolower($item['chemical_name'] ?? ''), $q) ||
                       str_contains(strtolower($item['cas_number'] ?? ''), $q) ||
                       str_contains(strtolower($item['chemical_formula'] ?? ''), $q);
            });
        }

        return array_values($items);
    }

    public static function featured(): array
    {
        $all = self::all();
        return array_values(array_filter($all, fn($p) => !empty($p['featured'])));
    }

    public static function findBySlug(string $slug): ?array
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug, pi.image_path as image
                                   FROM products p
                                   LEFT JOIN product_categories c ON p.category_id = c.id
                                   LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_primary = 1
                                   WHERE p.slug = ? AND p.status = 'published' LIMIT 1");
            $stmt->execute([$slug]);
            $row = $stmt->fetch();
            if ($row) {
                self::decodeJsonFields($row);
                return $row;
            }
        } catch (\Throwable $e) {
            error_log("Product find error: " . $e->getMessage());
        }

        $siteData = require __DIR__ . '/../../data/site_data.php';
        return $siteData['products'][$slug] ?? null;
    }

    public static function getRelated(int $productId, ?int $categoryId = null, int $limit = 3): array
    {
        $all = self::all();
        $related = [];
        foreach ($all as $item) {
            if ((int)($item['id'] ?? 0) === $productId) {
                continue;
            }
            if ($categoryId !== null && (int)($item['category_id'] ?? 0) === $categoryId) {
                $related[] = $item;
            }
        }

        // If not enough from same category, fill from remaining
        if (count($related) < $limit) {
            foreach ($all as $item) {
                if ((int)($item['id'] ?? 0) !== $productId && !in_array($item, $related, true)) {
                    $related[] = $item;
                    if (count($related) >= $limit) {
                        break;
                    }
                }
            }
        }

        return array_slice($related, 0, $limit);
    }

    private static function decodeJsonFields(array &$row): void
    {
        if (isset($row['packaging_options_json']) && is_string($row['packaging_options_json'])) {
            $row['packaging_options'] = json_decode($row['packaging_options_json'], true) ?: [];
        }
        if (isset($row['applications_json']) && is_string($row['applications_json'])) {
            $row['applications'] = json_decode($row['applications_json'], true) ?: [];
        }
        if (isset($row['specifications_json']) && is_string($row['specifications_json'])) {
            $row['specifications'] = json_decode($row['specifications_json'], true) ?: [];
        }
    }
}
