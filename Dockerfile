# ==============================================================================
# HB Metals India - Render Production Dockerfile
# Base: Official PHP 8.3 Apache with PostgreSQL, SQLite, and Opcache
# ==============================================================================
FROM php:8.3-apache

# Install PostgreSQL client libraries and system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    libsqlite3-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    pgsql \
    pdo_sqlite \
    opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure Apache DocumentRoot to point to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Directory directive to allow .htaccess overrides
RUN echo '<Directory /var/www/html/public>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/hbmetals.conf \
    && a2enconf hbmetals

# Enable Apache mod_rewrite and mod_headers for routing and security headers
RUN a2enmod rewrite headers

# Copy application source code
WORKDIR /var/www/html
COPY . /var/www/html

# Ensure storage directories exist with write permissions
RUN mkdir -p storage/database storage/logs storage/cache storage/private-uploads \
    && chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Install entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Render dynamically injects the $PORT environment variable (defaults to 10000)
EXPOSE 10000

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
