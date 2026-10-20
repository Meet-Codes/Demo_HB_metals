<?php

namespace App\Models;

class SiteSetting
{
    private static ?array $cached = null;

    public static function get(): array
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        try {
            $siteData = require __DIR__ . '/../../data/site_data.php';
            $defaultSettings = $siteData['settings'];

            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM site_settings LIMIT 1");
            $row = $stmt->fetch();
            if ($row) {
                if (!empty($row['social_links_json'])) {
                    $row['social_links'] = json_decode($row['social_links_json'], true) ?: [];
                }
                self::$cached = array_merge($defaultSettings, $row);
                return self::$cached;
            }
            self::$cached = $defaultSettings;
            return self::$cached;
        } catch (\Throwable $e) {
            error_log("SiteSetting error: " . $e->getMessage());
        }

        // Fallback to PHP site data file
        $siteData = require __DIR__ . '/../../data/site_data.php';
        self::$cached = $siteData['settings'];
        return self::$cached;
    }
}
