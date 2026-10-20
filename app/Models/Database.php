<?php

namespace App\Models;

use PDO;
use Exception;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $config = require __DIR__ . '/../../config/database.php';
        $default = $config['default'];

        // 1. PostgreSQL (pgsql) Support
        if ($default === 'pgsql' && extension_loaded('pdo_pgsql')) {
            try {
                $c = $config['connections']['pgsql'];
                $ssl = !empty($c['sslmode']) ? ";sslmode={$c['sslmode']}" : "";
                $dsn = "pgsql:host={$c['host']};port={$c['port']};dbname={$c['database']}{$ssl};options='--client_encoding={$c['charset']}'";
                self::$pdo = new PDO($dsn, $c['username'], $c['password'], $c['options']);
                self::ensureSchema(self::$pdo);
                return self::$pdo;
            } catch (Exception $e) {
                error_log("PostgreSQL connection failed: " . $e->getMessage() . ". Falling back to SQLite.");
            }
        }

        // 2. MySQL Support
        if ($default === 'mysql' && extension_loaded('pdo_mysql')) {
            try {
                $c = $config['connections']['mysql'];
                $dsn = "mysql:host={$c['host']};port={$c['port']};dbname={$c['database']};charset={$c['charset']}";
                self::$pdo = new PDO($dsn, $c['username'], $c['password'], $c['options']);
                self::ensureSchema(self::$pdo);
                return self::$pdo;
            } catch (Exception $e) {
                error_log("MySQL connection failed: " . $e->getMessage() . ". Falling back to SQLite.");
            }
        }

        // 3. SQLite Support (Default / Resilient Fallback)
        $sqliteConfig = $config['connections']['sqlite'];
        $dbPath = $sqliteConfig['database'];
        $dir = dirname($dbPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $dsn = "sqlite:{$dbPath}";
        self::$pdo = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        self::ensureSchema(self::$pdo);
        return self::$pdo;
    }

    private static function ensureSchema(PDO $pdo): void
    {
        $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
        if ($driver === 'sqlite') {
            $check = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='products'");
        } elseif ($driver === 'pgsql') {
            $check = $pdo->query("SELECT 1 FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'products'");
        } else {
            $check = $pdo->query("SHOW TABLES LIKE 'products'");
        }
        if ($check && $check->fetch()) {
            return; // Already initialized
        }

        $schemaFile = ($driver === 'pgsql')
            ? __DIR__ . '/../../data/schema.pgsql.sql'
            : __DIR__ . '/../../data/schema.sql';

        if (file_exists($schemaFile)) {
            $sql = file_get_contents($schemaFile);
            $pdo->exec($sql);
            self::seedInitialData($pdo);
        }
    }

    private static function seedInitialData(PDO $pdo): void
    {
        $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
        $siteData = require __DIR__ . '/../../data/site_data.php';

        // 1. Site Settings
        $s = $siteData['settings'];
        $stmt = $pdo->prepare("INSERT INTO site_settings (
            site_name, site_tagline, phone, email, address_line_1, address_line_2,
            city, state, postal_code, alternate_postal_code, postal_code_note, country,
            map_embed_url, social_links_json, seo_default_title, seo_default_description
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $s['site_name'], $s['site_tagline'], $s['phone'], $s['email'],
            $s['address_line_1'], $s['address_line_2'], $s['city'], $s['state'],
            $s['postal_code'], $s['alternate_postal_code'], $s['postal_code_note'],
            $s['country'], $s['map_embed_url'], json_encode($s['social_links']),
            $s['seo_default_title'], $s['seo_default_description']
        ]);

        // 2. Categories
        $catStmt = $pdo->prepare("INSERT INTO product_categories (
            name, slug, short_description, long_description, image_path, meta_title, meta_description
        ) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $catMap = [];
        foreach ($siteData['categories'] as $cat) {
            $catStmt->execute([
                $cat['name'], $cat['slug'], $cat['short_description'], $cat['long_description'],
                $cat['image'], "{$cat['name']} | HB Metals India", $cat['short_description']
            ]);
            $catMap[$cat['slug']] = (int)($driver === 'pgsql' ? $pdo->lastInsertId('product_categories_id_seq') : $pdo->lastInsertId());
        }

        // 3. Products
        $prodStmt = $pdo->prepare("INSERT INTO products (
            name, slug, category_id, short_description, description, chemical_name,
            chemical_formula, cas_number, grade, purity_value, physical_form, particle_size,
            packaging_options_json, minimum_order_quantity, minimum_order_unit,
            applications_json, specifications_json, handling_notes, storage_notes,
            featured, source_url, meta_title, meta_description, canonical_url
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($siteData['products'] as $p) {
            $catId = $catMap[$p['category_slug']] ?? null;
            $prodStmt->execute([
                $p['name'], $p['slug'], $catId, $p['short_description'], $p['description'],
                $p['chemical_name'], $p['chemical_formula'], $p['cas_number'], $p['grade'],
                $p['purity_value'], $p['physical_form'], $p['particle_size'],
                json_encode($p['packaging_options']), $p['minimum_order_quantity'], $p['minimum_order_unit'],
                json_encode($p['applications']), json_encode($p['specifications']),
                $p['handling_notes'], $p['storage_notes'], $p['featured'] ? 1 : 0,
                $p['source_url'], "{$p['name']} - Specifications & Quote | HB Metals India",
                $p['short_description'], "/{$p['slug']}/"
            ]);
            $prodId = (int)($driver === 'pgsql' ? $pdo->lastInsertId('products_id_seq') : $pdo->lastInsertId());

            // Insert primary image
            $imgStmt = $pdo->prepare("INSERT INTO product_images (product_id, image_path, alt_text, is_primary) VALUES (?, ?, ?, 1)");
            $imgStmt->execute([$prodId, $p['image'], $p['name']]);
        }

        // 4. Technical Documents
        $docStmt = $pdo->prepare("INSERT INTO technical_documents (
            title, document_type, revision, published_at, file_size, status
        ) VALUES (?, ?, ?, ?, ?, ?)");

        foreach ($siteData['technical_documents'] as $doc) {
            $docStmt->execute([
                $doc['title'], $doc['document_type'], $doc['revision'],
                $doc['published_at'], $doc['file_size'], $doc['status']
            ]);
        }

        // 5. FAQs
        $faqStmt = $pdo->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
        foreach ($siteData['faqs'] as $faq) {
            $faqStmt->execute([$faq['question'], $faq['answer']]);
        }

        // 6. Redirects (Preserve legacy URL mappings)
        $redStmt = $pdo->prepare("INSERT INTO url_redirects (source_path, destination_path, http_status) VALUES (?, ?, ?)");
        $legacyRedirects = [
            ['/magnesium-metal-turning', '/magnesium-metal-turning/', 301],
            ['/sodium-tungstate//', '/sodium-tungstate/', 301],
            ['/about-us', '/about-us/', 301],
            ['/our-products', '/our-products/', 301],
            ['/contact-us', '/contact-us/', 301],
            ['/tungsten-powder/', '/product-category/tungsten-powder/', 301],
            ['/tungsten-oxide/', '/product-category/tungsten-oxide/', 301],
            ['/metal-oxides/', '/product-category/metal-oxides/', 301],
            ['/metallic-salts/', '/product-category/metallic-salts/', 301],
        ];
        foreach ($legacyRedirects as $r) {
            $redStmt->execute($r);
        }
    }
}
