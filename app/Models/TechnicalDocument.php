<?php

namespace App\Models;

class TechnicalDocument
{
    public static function all(): array
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT td.*, p.name as product_name, p.slug as product_slug 
                                 FROM technical_documents td 
                                 LEFT JOIN products p ON td.product_id = p.id 
                                 WHERE td.status = 'active' 
                                 ORDER BY td.id ASC");
            $rows = $stmt->fetchAll();
            if (!empty($rows)) {
                foreach ($rows as &$row) {
                    if (empty($row['product_name'])) {
                        // Extract product name from title fallback
                        $row['product_name'] = preg_replace('/^Technical Data Sheet\s*-\s*/i', '', $row['title'] ?? 'HB Metals Product');
                    }
                }
                return $rows;
            }
        } catch (\Throwable $e) {
            error_log("TechnicalDocument error: " . $e->getMessage());
        }

        $siteData = require __DIR__ . '/../../data/site_data.php';
        return $siteData['technical_documents'] ?? [];
    }

    public static function forProduct(string $productSlug): array
    {
        $all = self::all();
        return array_values(array_filter($all, fn($d) => ($d['product_slug'] ?? '') === $productSlug));
    }
}
