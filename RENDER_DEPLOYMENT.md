# Deploying HB Metals to Render (render.com) with Neon PostgreSQL

This guide walks you through deploying the **HB Metals India** website to **Render** using Docker and your **Neon Serverless PostgreSQL** database.

---

## 🚀 Option 1: 1-Click Blueprint Deployment (Fastest)

Render provides Infrastructure-as-Code via [`render.yaml`](./render.yaml).

### Step 1: Push Code to GitHub / GitLab
1. Initialize git and commit your files (if not already done):
   ```bash
   git add .
   git commit -m "Configure Render Dockerfile, PostgreSQL schema, and Neon DB"
   ```
2. Push your repository to your GitHub or GitLab account:
   ```bash
   git push origin main
   ```

### Step 2: Deploy on Render
1. Go to [dashboard.render.com](https://dashboard.render.com/) and sign in.
2. Click **New +** (top right) and select **Blueprint**.
3. Connect your GitHub/GitLab repository (`HBMetals`).
4. Render will read [`render.yaml`](./render.yaml) and automatically configure:
   - **Service Name:** `hbmetals-web`
   - **Environment:** `Docker`
   - **Environment Variables:** `DB_URL` / `DATABASE_URL` pointing to your Neon database, `DB_CONNECTION=pgsql`, `APP_ENV=production`.
5. Click **Apply**.
6. Render will:
   - Build the Docker container with PHP 8.3 + Apache + `pdo_pgsql`.
   - Run `php data/migrate_pgsql.php` on container startup to verify/migrate the schema and seed the catalog into Neon PostgreSQL.
   - Assign you a live public HTTPS URL (e.g., `https://hbmetals-web.onrender.com`).

---

## 🛠️ Option 2: Manual Web Service Setup (Without Blueprint)

If creating the Web Service directly from the Render dashboard:

1. In Render Dashboard, click **New +** → **Web Service**.
2. Connect your Git repository.
3. Configure the service settings:
   - **Name:** `hbmetals-web`
   - **Region:** Ohio (US East - `us-east-2`, same region as your Neon database for lowest latency!)
   - **Branch:** `main`
   - **Runtime:** `Docker`
   - **Dockerfile Path:** `./Dockerfile`
   - **Plan:** Free
4. Under **Environment Variables**, add:
   | Key | Value | Notes |
   | :--- | :--- | :--- |
   | `DB_CONNECTION` | `pgsql` | Enables PostgreSQL mode |
   | `DB_URL` | `postgresql://neondb_owner:npg_TCl2MQv4XPwk@ep-ancient-base-b401ttm9-pooler.c-6.us-east-2.aws.neon.tech/neondb?sslmode=require&channel_binding=require` | Your Neon database URL |
   | `DATABASE_URL` | `postgresql://neondb_owner:npg_TCl2MQv4XPwk@ep-ancient-base-b401ttm9-pooler.c-6.us-east-2.aws.neon.tech/neondb?sslmode=require&channel_binding=require` | Standard alias |
   | `APP_ENV` | `production` | Production environment |
   | `APP_DEBUG` | `false` | Disable error display for visitors |
   | `NOTIFICATION_EMAIL` | `info@hbmetals.co.in` | Where RFQ / Contact emails go |
   | `MAIL_DRIVER` | `log` (or `mail` / `smtp`) | Mail driver |
5. Click **Create Web Service**.

---

## 📦 What Files Were Added for Render

1. **[`Dockerfile`](./Dockerfile):**
   - Official PHP 8.3 Apache base with `pdo_pgsql`, `pgsql`, `pdo_sqlite`, and `opcache`.
   - DocumentRoot mapped to `/var/www/html/public`.
   - Apache `mod_rewrite` enabled for clean MVC URL routing and security headers.
   - Dynamic `$PORT` binding for Render compatibility.

2. **[`docker-entrypoint.sh`](./docker-entrypoint.sh):**
   - Automatically adapts Apache to Render's dynamic `$PORT`.
   - Automatically runs `php data/migrate_pgsql.php` on container boot to ensure PostgreSQL schema & catalog seed data are ready.
   - Launches `apache2-foreground`.

3. **[`.dockerignore`](./.dockerignore):**
   - Keeps build contexts lightweight by excluding local logs, `.git`, and development `.env` files.

4. **[`render.yaml`](./render.yaml):**
   - Complete Blueprint specifying the web container and managed PostgreSQL database with auto-wiring.

5. **[`config/database.php`](./config/database.php):**
   - Updated to automatically parse Render's `DATABASE_URL` string into individual PDO parameters without any manual string splitting.

---

## 🔍 Verification & Health Check

* **Health Check Path:** `/` (configured in `render.yaml`)
* **Database Verification:** Check Render runtime logs during deployment to confirm:
  ```text
  [*] Checking PostgreSQL connection and running migrations...
  [+] Successfully connected to PostgreSQL server!
  [+] Schema applied successfully.
  [+] Data successfully seeded into PostgreSQL tables.
  ```
