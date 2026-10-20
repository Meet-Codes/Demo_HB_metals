<?php

declare(strict_types=1);

/**
 * HB Metals India - PostgreSQL Migration & Verification Tool
 * Connects to PostgreSQL, checks/creates schema from data/schema.pgsql.sql,
 * and seeds initial authentic product and company data.
 */

require_once __DIR__ . '/../app/Config/App.php';

// PSR-4 autoloader
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

\App\Config\App::boot();

echo "=========================================================\n";
echo "  HB Metals India - PostgreSQL Migration Script\n";
echo "=========================================================\n\n";

if (!extension_loaded('pdo_pgsql')) {
    echo "[-] ERROR: The PHP extension 'pdo_pgsql' is not loaded.\n";
    echo "    Please enable 'extension=pdo_pgsql' in your php.ini.\n";
    exit(1);
}

$config = require __DIR__ . '/../config/database.php';
$c = $config['connections']['pgsql'] ?? null;

if (!$c) {
    echo "[-] ERROR: 'pgsql' connection configuration not found in config/database.php.\n";
    exit(1);
}

$host = $c['host'];
$port = $c['port'];
$db   = $c['database'];
$user = $c['username'];
$pass = $c['password'];

echo "[*] Connecting to PostgreSQL at {$host}:{$port}/{$db} as {$user}...\n";

try {
    $ssl = !empty($c['sslmode']) ? ";sslmode={$c['sslmode']}" : "";
    $dsn = "pgsql:host={$host};port={$port};dbname={$db}{$ssl};options='--client_encoding={$c['charset']}'";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "[+] Successfully connected to PostgreSQL server!\n";
} catch (Exception $e) {
    echo "[-] Connection Failed: " . $e->getMessage() . "\n\n";
    echo "Tip: Verify your PostgreSQL service is running and credentials in .env are correct:\n";
    echo "     DB_CONNECTION=pgsql\n";
    echo "     DB_HOST={$host}\n";
    echo "     DB_PORT={$port}\n";
    echo "     DB_DATABASE={$db}\n";
    echo "     DB_USERNAME={$user}\n";
    echo "     DB_PASSWORD=your_password\n\n";
    echo "Note: The application includes a transparent fallback to SQLite so it remains\n";
    echo "      functional locally while you configure your PostgreSQL server.\n";
    exit(1);
}

// Check tables
$schemaFile = __DIR__ . '/schema.pgsql.sql';
if (!file_exists($schemaFile)) {
    echo "[-] Schema file not found: {$schemaFile}\n";
    exit(1);
}

echo "[*] Applying schema: {$schemaFile}...\n";
$sql = file_get_contents($schemaFile);
$pdo->exec($sql);
echo "[+] Schema applied successfully.\n";

// Count products
$check = $pdo->query("SELECT COUNT(*) as cnt FROM products");
$count = (int)($check->fetch()['cnt'] ?? 0);

if ($count === 0) {
    echo "[*] Seeding authentic HB Metals product catalog & company data...\n";
    $siteData = require __DIR__ . '/site_data.php';

    // 1. Settings
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
    ) VALUES (?, ?, ?, ?, ?, ?, ?) RETURNING id");

    $catMap = [];
    foreach ($siteData['categories'] as $cat) {
        $catStmt->execute([
            $cat['name'], $cat['slug'], $cat['short_description'], $cat['long_description'],
            $cat['image'], "{$cat['name']} | HB Metals India", $cat['short_description']
        ]);
        $catMap[$cat['slug']] = (int)$catStmt->fetchColumn();
    }

    // 3. Products
    $prodStmt = $pdo->prepare("INSERT INTO products (
        name, slug, category_id, short_description, description, chemical_name,
        chemical_formula, cas_number, grade, purity_value, physical_form, particle_size,
        packaging_options_json, minimum_order_quantity, minimum_order_unit,
        applications_json, specifications_json, handling_notes, storage_notes,
        featured, source_url, meta_title, meta_description, canonical_url
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING id");

    $imgStmt = $pdo->prepare("INSERT INTO product_images (product_id, image_path, alt_text, is_primary) VALUES (?, ?, ?, 1)");

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
        $prodId = (int)$prodStmt->fetchColumn();
        $imgStmt->execute([$prodId, $p['image'], $p['name']]);
    }

    // 4. Documents
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

    // 6. Redirects
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

    echo "[+] Data successfully seeded into PostgreSQL tables.\n";
} else {
    echo "[+] PostgreSQL already contains {$count} products. Skipping seeding.\n";
}

echo "\n[✓] Migration Complete! Your PostgreSQL database is ready for HB Metals.\n";
