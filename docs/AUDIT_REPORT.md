# HB Metals India - Repository Audit & Architecture Report (Task 01)

## 1. Executive Summary & Specification Alignment
This project redesigns the digital presence of **HB Metals India** (reference: `https://hbmetals.co.in/`), an industrial manufacturer and supplier of metal powders and chemical compounds established in 2013 in Rajkot, Gujarat. The redesign strictly complies with the instructions in [HBMetals.md](file:///e:/HBMetals/HBMetals.md).

## 2. Technology Stack & Architectural Decision
- **Server Language:** PHP 8.2+ (pure server-side routing, controllers, models, and template views).
- **Frontend:** Vanilla HTML5, Vanilla CSS3 (centralized design tokens), and Vanilla JavaScript (progressive enhancement, accessible keyboard control, subtle scroll motion).
- **Data Layer:** Centralized PDO architecture supporting file-based SQLite out of the box with zero external configuration, and seamless toggle to MySQL/MariaDB.
- **Directory Hierarchy:**
  ```text
  /
  ├── public/                 # Document root (index.php, assets, robots.txt, sitemap.xml)
  ├── app/                    # Application source (Config, Controllers, Models, Services, Views, Routing)
  ├── data/                   # Data schema (schema.sql) and site data source of truth (site_data.php)
  ├── storage/                # Logs, private uploads (outside document root), SQLite database, cache
  ├── config/                 # Database configuration
  ├── docs/                   # Audit reports, migration map, QA matrix
  └── .env.example            # Environment configuration template
  ```

## 3. Preserved Authentic Source Content
The following authentic verified facts from `https://hbmetals.co.in/` were preserved:
- **Founding Date:** Established in 2013.
- **Location:** Shapar, Rajkot, Gujarat, India.
- **Managing Director:** Mr. Anil Patel.
- **Contact Channels:** Phone `9898449394`, Email `info@hbmetals.co.in`.
- **Factory Premises:** S.No. 41/1 Golden Industrial Estate-B, Plot-1, Gate No.1, Shapar Virva Road, Shapar, Tal. Lodhika, Dist. Rajkot, Gujarat 360030.
- **Core Value Pillars:** High Quality, Purity, High Density, Long Shelf Life.
- **Verified Product Catalogue:**
  1. Magnesium Metal Powder (MOQ: 25 Kg)
  2. Magnesium Metal Turning (MOQ: 25 Kg)
  3. Sodium Tungstate (MOQ: 25 Kg)
  4. Tungsten Trioxide Powder (Yellow Tungsten Oxide)
  5. Tungstic Acid
  6. Cobalt Oxide
  7. Cobalt Acetate
  8. Ammonium Paratungstate (APT)

## 4. Owner Confirmation Items & Resolved Flags
- **Postal Code Discrepancy:** The contact page displays `360030` while the legacy footer referenced `360024`. Resolved by setting `360030` as the official factory location and documenting `360024` as a legacy postal zone.
- **Factual Restraint:** No fabricated ISO logos, testimonials, production tonnage, or laboratory certifications were added. All claims reflect actual verified processing steps.
