<?php

require_once __DIR__ . '/app/Config/App.php';

// PSR-4 autoloader
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';
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

$pdo = \App\Models\Database::getConnection();
$driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
echo "Active PDO Driver: " . $driver . PHP_EOL;

$stmt = $pdo->query("SELECT name, cas_number, purity_value FROM products ORDER BY id ASC LIMIT 3");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Fetched rows from Neon PostgreSQL:\n";
print_r($rows);
