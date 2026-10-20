# HB Metals India - Production Deployment Guide

This package contains the complete, production-ready website for **HB Metals India**.

---

## 🚀 Quick Deployment Options

### Option 1: Shared Hosting (cPanel / Hostinger / GoDaddy / Namecheap)

1. **Upload Files:**
   - Extract the contents of `hbmetals-production.zip` directly into your web root directory (usually `public_html` or `public_html/subfolder`).
2. **Environment Configuration:**
   - Rename `.env.production` (or `.env.example`) to `.env`.
   - Update `APP_URL` to your domain (e.g. `https://hbmetals.co.in`). If left blank, it will auto-detect your domain.
   - Configure your email settings under `MAIL_DRIVER` and `SMTP_*` if using custom SMTP.
3. **Database:**
   - **Zero setup required for SQLite:** The pre-seeded database is located at `storage/database/hbmetals.sqlite`. It contains all 14 authentic products, categories, FAQs, and company data.
   - **Optional MySQL:** If your host requires MySQL, create a MySQL database in cPanel, import `data/schema.sql`, and update the `DB_*` variables in `.env`.
4. **File Permissions:**
   - Ensure `storage/` directory and its subdirectories (`storage/database`, `storage/logs`, `storage/cache`, `storage/private-uploads`) are writable (chmod `775` or `755`).

---

### Option 2: Apache on VPS / Dedicated Server (Ubuntu / Debian / CentOS)

1. **Upload & Extract:**
   - Copy and extract the zip file to `/var/www/hbmetals`.
2. **Configure VirtualHost:**
   - Set the DocumentRoot to the `public/` directory:
     ```apache
     <VirtualHost *:80>
         ServerName hbmetals.co.in
         ServerAlias www.hbmetals.co.in
         DocumentRoot /var/www/hbmetals/public

         <Directory /var/www/hbmetals/public>
             AllowOverride All
             Require all granted
         </Directory>

         ErrorLog ${APACHE_LOG_DIR}/hbmetals_error.log
         CustomLog ${APACHE_LOG_DIR}/hbmetals_access.log combined
     </VirtualHost>
     ```
3. **Enable Apache Modules:**
   ```bash
   sudo a2enmod rewrite headers
   sudo systemctl restart apache2
   ```
4. **Permissions:**
   ```bash
   sudo chown -R www-data:www-data /var/www/hbmetals/storage
   sudo chmod -R 775 /var/www/hbmetals/storage
   ```

---

### Option 3: Nginx on VPS / Dedicated Server

1. **Upload & Extract:**
   - Copy and extract to `/var/www/hbmetals`.
2. **Nginx Configuration:**
   - A complete Nginx configuration file is provided in `nginx.conf.example`.
   - Copy or link it to `/etc/nginx/sites-available/hbmetals.conf` and enable it in `sites-enabled/`.
   - Ensure `root` points to `/var/www/hbmetals/public`.
3. **Test & Reload:**
   ```bash
   sudo nginx -t
   sudo systemctl reload nginx
   ```

---

## 🔒 Security & Checklist

- [x] Sensitive directories (`app/`, `config/`, `data/`, `storage/`, `.env`) are blocked from direct web access via `.htaccess` and Nginx rules.
- [x] Security headers (`X-Frame-Options`, `X-Content-Type-Options`, `X-XSS-Protection`, `Referrer-Policy`) are pre-configured.
- [x] `APP_DEBUG=false` in production to prevent leaking sensitive stack traces.
- [x] CSRF protection enabled on all forms.
- [x] Honeypot anti-spam enabled on contact & RFQ submission forms.
- [x] SEO sitemap dynamically generated at `/sitemap.xml` and HTML sitemap at `/sitemap/`.
