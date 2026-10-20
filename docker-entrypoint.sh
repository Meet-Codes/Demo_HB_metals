#!/bin/bash
set -e

# Render binds to the port defined by $PORT (defaults to 10000 on Render, fallback 80)
PORT="${PORT:-10000}"

# Configure Apache to listen on $PORT
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/*.conf

# Synchronize DB_URL and DATABASE_URL if either is set
if [ -n "${DB_URL}" ] && [ -z "${DATABASE_URL}" ]; then
    export DATABASE_URL="${DB_URL}"
fi
if [ -n "${DATABASE_URL}" ] && [ -z "${DB_URL}" ]; then
    export DB_URL="${DATABASE_URL}"
fi

# Ensure storage directories have write permissions
chown -R www-data:www-data /var/www/html/storage 2>/dev/null || true
chmod -R 775 /var/www/html/storage 2>/dev/null || true

# Run PostgreSQL migration & seeding if DB_CONNECTION is pgsql or DATABASE_URL / DB_URL is provided
if [ "${DB_CONNECTION}" = "pgsql" ] || [ -n "${DATABASE_URL}" ] || [ -n "${DB_URL}" ]; then
    echo "[*] Checking PostgreSQL connection and running migrations..."
    php data/migrate_pgsql.php || echo "[!] Notice: PostgreSQL migration returned an exit code. Falling back to SQLite if needed."
fi

# Execute the main container command
exec "$@"
