<?php

$dbUrl = getenv('DATABASE_URL') ?: getenv('DB_URL');
$pgHost = getenv('DB_HOST') ?: '127.0.0.1';
$pgPort = getenv('DB_PORT') ?: '5432';
$pgDatabase = getenv('DB_DATABASE') ?: 'hbmetals';
$pgUser = getenv('DB_USERNAME') ?: 'postgres';
$pgPass = getenv('DB_PASSWORD') ?: '';
$pgSslMode = getenv('DB_SSLMODE') ?: 'prefer';

if ($dbUrl) {
    $parsed = parse_url($dbUrl);
    if (!empty($parsed['host'])) {
        $pgHost = $parsed['host'];
    }
    if (!empty($parsed['port'])) {
        $pgPort = (string)$parsed['port'];
    }
    if (!empty($parsed['path'])) {
        $pgDatabase = ltrim($parsed['path'], '/');
    }
    if (!empty($parsed['user'])) {
        $pgUser = urldecode($parsed['user']);
    }
    if (isset($parsed['pass'])) {
        $pgPass = urldecode($parsed['pass']);
    }
    if (!empty($parsed['query'])) {
        parse_str($parsed['query'], $queryParams);
        if (!empty($queryParams['sslmode'])) {
            $pgSslMode = $queryParams['sslmode'];
        }
    }
}

return [
    'default' => getenv('DB_CONNECTION') ?: 'pgsql',

    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => $pgHost,
            'port' => $pgPort,
            'database' => $pgDatabase,
            'username' => $pgUser,
            'password' => $pgPass,
            'sslmode' => $pgSslMode,
            'charset' => getenv('DB_CHARSET') ?: 'utf8',
            'schema' => getenv('DB_SCHEMA') ?: 'public',
            'prefix' => '',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => __DIR__ . '/../' . (getenv('DB_FILE') ?: 'storage/database/hbmetals.sqlite'),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('DB_PORT') ?: '3306',
            'database' => getenv('DB_DATABASE') ?: 'hbmetals',
            'username' => getenv('DB_USERNAME') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        ],
    ],
];
