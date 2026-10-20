# HB Metals India - Website Redesign

Premium, responsive, and cinematic industrial B2B website for **HB Metals India** (Rajkot, Gujarat). Built with pure **PHP 8.2+**, Vanilla CSS3 (Design Tokens), and Vanilla JavaScript, adhering strictly to the master specification in `HBMetals.md`.

---

## Features & Highlights

- **Pure PHP Architecture:** Zero third-party runtime framework dependencies. Clean MVC structure with router, controllers, models, and template views.
- **Central Data Layer:** Supports file-based **SQLite** out-of-the-box with automatic schema creation and seeding from `data/site_data.php`, or toggles to **MySQL/MariaDB** via PDO.
- **Authentic Brand & Content:** Preserves verified company history (established 2013 in Rajkot), managing director details (Mr. Anil Patel), official factory address in Shapar, authentic product catalog, and real product photography.
- **Complete Commercial Workflows:**
  - Fast search & category filtering across product lines.
  - Individual product detail pages with chemical formulas, CAS numbers, and specifications.
  - Global Request for Quotation (RFQ) modal with prefilling and document attachment.
  - Contact form with CSRF protection, anti-spam honeypot, and transactional storage.
- **Technical SEO Ready:** Clean canonical URLs, dynamic XML sitemap (`/sitemap.xml`), human HTML sitemap (`/sitemap/`), OpenGraph metadata, Schema.org Organization, and BreadcrumbList markup.
- **Fully Responsive & Accessible:** Fluid clamp typography, WCAG AA/AAA compliant contrast ratios, accessible keyboard focus rings, and `prefers-reduced-motion` handling.

---

## Directory Structure

```text
hbmetals/
├── public/                 # Document root
│   ├── index.php           # Master entry point & router dispatch
│   ├── .htaccess           # Apache rewrite rules & security headers
│   ├── robots.txt          # Dispatched dynamically
│   ├── sitemap.xml         # Dispatched dynamically
│   └── assets/             # CSS, JavaScript, Images, and Fonts
│       ├── css/            # tokens.css, base.css, layout.css, components.css, animations.css, responsive.css
│       ├── js/             # navigation.js, forms.js, motion.js, main.js
│       └── images/         # Authentic product images & SVG assets
├── app/                    # Application source
│   ├── Config/             # App bootstrap, environment & session handling
│   ├── Controllers/        # Home, Page, Product, Enquiry, Technical, and SEO controllers
│   ├── Models/             # Database, SiteSetting, Category, Product, TechnicalDocument, Faq, Enquiry
│   ├── Services/           # Mailer and notification handlers
│   ├── Validation/         # Server-side validation, honeypot & file upload checks
│   ├── Routing/            # Router with trailing-slash normalization and 301 redirects
│   ├── Views/              # Layouts, components, pages, products, errors
│   └── Support/            # Helpers (escaping, asset URL, slugify) and Csrf
├── data/                   # Database schema (schema.sql) and site data source of truth (site_data.php)
├── storage/                # SQLite database, application logs, private file uploads
├── config/                 # Database connection settings
├── docs/                   # AUDIT_REPORT.md, MIGRATION_MAP.md, QA_REPORT.md
├── HBMetals.md             # Master project specification
├── .env.example            # Environment variables template
├── .gitignore              # Version control ignore rules
└── README.md
```

---

## Quick Start (Local Development)

### 1. Requirements
- PHP 8.2 or newer with `pdo_sqlite` or `pdo_mysql` enabled.

### 2. Launch Local Server
From the project root:
```bash
php -S localhost:5000 -t public public/index.php
```

### 3. Open in Browser
Visit:
```text
http://localhost:5000/
```
The database will automatically initialize SQLite storage in `storage/database/hbmetals.sqlite` and seed all authentic product data, settings, categories, and FAQs on the very first request.

---

## Database Configuration (PostgreSQL / pgsql)

The project natively supports **PostgreSQL (`pgsql`)** as its primary relational database via `pdo_pgsql`.

### 1. PostgreSQL Schema & Configuration
PostgreSQL uses the dedicated schema file at `data/schema.pgsql.sql` with auto-incrementing `SERIAL` primary keys, strict foreign key constraints, and `TIMESTAMP` columns.

Set in your `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=hbmetals
DB_USERNAME=postgres
DB_PASSWORD=your_password
DB_SCHEMA=public
DB_CHARSET=utf8
```

### 2. Run Migration & Seed Data
To run the automated schema creation and data seeding tool:
```bash
php data/migrate_pgsql.php
```

### 3. Automatic Resilience & SQLite Fallback
If PostgreSQL is unreachable or during quick local prototyping without an active Postgres service, the application gracefully logs the issue and falls back to pre-seeded SQLite (`storage/database/hbmetals.sqlite`) so the site never encounters a downtime fatal error.

---

## Verification & Automated Smoke Tests

To verify that all PHP files are free of syntax errors:
```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```
