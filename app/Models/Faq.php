<?php

namespace App\Models;

class Faq
{
    public static function all(): array
    {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM faqs WHERE status = 'published' ORDER BY sort_order ASC, id ASC");
            $rows = $stmt->fetchAll();
            if (!empty($rows)) {
                return $rows;
            }
        } catch (\Throwable $e) {
            error_log("Faq error: " . $e->getMessage());
        }

        $siteData = require __DIR__ . '/../../data/site_data.php';
        return $siteData['faqs'];
    }
}
