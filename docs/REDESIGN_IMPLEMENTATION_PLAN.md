# HB Metals India — Master Website Redesign & Implementation Plan
## Full-Website Cinematic Liquid Glass UI, Motion Design, Responsive Optimization & QA

**Target:** Multi-page industrial B2B website for HB Metals India (Rajkot, Gujarat)  
**Architecture:** Pure PHP 8.2+ MVC (No runtime JS frameworks / No SPA)  
**Database:** SQLite (pre-seeded out-of-the-box in `storage/database/hbmetals.sqlite`) & MySQL/MariaDB PDO  
**Status:** In Progress (Phase 1 Completed)

---

## 1. Codebase Inventory & Architectural Baseline

### 1.1 Registered Application Routes (`public/index.php`)
- **GET /** — `HomeController::index` (Cinematic Hero, WebGL noise-morph slider, telemetry counters, featured catalogue, squeeze carousel, manufacturing highlights, FAQs, dithered footer)
- **GET /about-us/** — `PageController::about` (Corporate history, Mr. Anil Patel MD, Shapar manufacturing facility, verified facts table)
- **GET /capabilities/** — `PageController::capabilities` (Automatic machinery, chemical synthesis & calcination, moisture-proof packaging, storage)
- **GET /quality/** — `PageController::quality` (5-stage verification pipeline, COA protocols, analytical assay metrics)
- **GET /our-products/** — `ProductController::index` (Search & category filtering, 14 authentic products grid)
- **GET /product-category/{slug}/** — `ProductController::category` (Dynamic category view with sidebar navigation)
- **GET /{product-slug}/** — Individual Product routes:
  - `/magnesium-metal-powder/`
  - `/magnesium-metal-turning/`
  - `/sodium-tungstate/`
  - `/tungsten-trioxide-powder/`
  - `/tungstic-acid/`
  - `/cobalt-oxide/`
  - `/cobalt-acetate/`
  - `/ammonium-paratungstate/`
- **GET /contact-us/** — `PageController::contact` (Works contacts, Google Maps, contact enquiry form)
- **POST /contact-submit/** — `EnquiryController::submitContact` (CSRF, honeypot, validation, mailer, database storage)
- **GET /request-a-quote/** — `PageController::requestQuote` (Formal commercial RFQ form, preselected product)
- **POST /rfq-submit/** — `EnquiryController::submitRfq` (Formal RFQ transmission with optional document attachment)
- **GET /enquiry/thank-you/** — `EnquiryController::thankYou` (Unique transaction reference, next steps)
- **GET /technical-resources/** — `TechnicalController::index` (TDS specification library, document requests)
- **GET /faq/** — `PageController::faqs` (Commercial and technical FAQs with accordions)
- **GET /sitemap/** — `PageController::sitemap` (Human-readable HTML sitemap)
- **GET /sitemap.xml** — `SeoController::sitemapXml` (Dynamic XML sitemap)
- **GET /robots.txt** — `SeoController::robotsTxt` (Robots directive)
- **GET /privacy-policy/** — `PageController::privacyPolicy`
- **GET /terms-and-conditions/** — `PageController::terms`
- **Fallback 404** — `errors/404.php`
- **Fallback 500** — `errors/500.php`

### 1.2 Layouts & View Components
- `app/Views/layouts/main.php` (Master document, meta, fonts, CSS bundles, JS modules, global 3D stage)
- `app/Views/layouts/header.php` (Top bar, brand logo, navigation links, category dropdown, quote CTA, mobile trigger)
- `app/Views/layouts/footer.php` (Brand tagline, newsletter subscription, navigation, product families, address, copyright)
- `app/Views/components/breadcrumbs.php` (Dynamic hierarchical navigation with Schema.org breadcrumbs)
- `app/Views/components/product_card.php` (Reusable product card with CAS, MOQ, image, actions)
- `app/Views/components/rfq_modal.php` (Global accessible RFQ modal with AJAX support)
- `app/Views/components/mobile_dock.php` (iOS glass bottom tab dock & sliding action sheet)

### 1.3 Stylesheets (`public/assets/css/`)
- `tokens.css` (Master color palette, typography scale, 4px/8px rhythm spacing, radii, shadows, z-index)
- `base.css` (Reset, Google Fonts `@import`, body, typography, accessible skip link, selection)
- `layout.css` (Top bar, header, containers, grid-2/3/4, section spacing, footer)
- `components.css` (Buttons, form controls, product cards, tables, badges, accordions, modals, iOS dock)
- `animations.css` (Scroll reveals, custom cursor, telemetry corners, metallic shimmer)
- `responsive.css` (Breakpoints: 320px, 375px, 600px, 768px, 900px, 1024px, 1280px, 1440px)

### 1.4 Frontend Script Modules (`public/assets/js/`)
- `navigation.js` (Sticky header scroll watcher, mobile menu, iOS action sheet, escape key listener)
- `forms.js` (Accordions, RFQ modal controller, AJAX form submission, error messaging)
- `motion.js` (IntersectionObserver scroll reveals, animated numeric telemetry counters)
- `main.js` (Dithered footer spotlight, newsletter interaction)
- `cursor.js` (Adaptive magnetic cursor with dot & spring-lerp ring)
- `tilt.js` (3D perspective card tilt with gyroscope/mouse listener)
- `morph-hero-slider.js` (WebGL noise-morph shader slider for authentic hero slides)
- `carousel-squeeze.js` (Interactive category squeeze carousel)
- `telemetry-rail.js` (Desktop chapter navigation indicator)
- `three-stage.js` (Background particle continuum & 3D ambient stage)
- `molecule-viewer.js` (Interactive 3D ball-and-stick atomic lattices on product show pages)
- `powder-particles.js` (Ambient metal powder floating particles)

---

## 2. Visual Direction & Liquid-Glass System Design

### 2.1 Aesthetic Foundations
1. **Liquid-Glass Editorial:** Translucent, deeply frosted surfaces (`backdrop-filter: blur(16px) saturate(180%)`), hair-thin luminous borders (`rgba(255, 255, 255, 0.15)` on dark, `rgba(20, 38, 51, 0.08)` on light), inset reflections, and diffuse ambient shadows.
2. **Industrial Material Authenticity:** Grounded in real metallurgy: Titanium/Steel blue-greys, high-purity Magnesium silver, Tungsten charcoal, and warm Copper accents (`#B86D3C`).
3. **Typography Mastery:** High-contrast pairing of editorial geometric sans (`Manrope`) with ultra-readable functional sans (`Inter`), complemented by monospaced technical tags (`SFMono`, `Consolas`) for CAS registry numbers, chemical formulas, and batch assays.
4. **Cinematic Rhythms:** Fluid `clamp()` scale, deliberate negative space, structured data grids, accessible high-contrast text ratios exceeding WCAG AA/AAA standards.

### 2.2 Core Reusable Liquid-Glass Classes
- `.liquid-glass` / `.glass-card`: Base frosted glass card with light & dark variations.
- `.glass-nav`: Floating frosted navigation bar with adaptive scroll states.
- `.glass-pill` / `.glass-badge`: Refined metadata pill for CAS numbers and chemical formulas.
- `.glass-control`: Translucent buttons, inputs, and sliders with subtle glow on focus.
- `.glass-overlay`: Soft dark atmospheric veil preserving underlying WebGL and photography clarity.
- `.glass-border`: Gradient border effect simulating light refraction on curved glass edges.

---

## 3. Implementation Phases & Status

- [x] **Phase 1: Codebase Audit & Baseline Documentation**
- [x] **Phase 2: Global Design System & Token Enhancement**
  - Refined `tokens.css` with liquid-glass variables, blur tokens, refraction borders, and depth shadows.
  - Upgraded `base.css` with typography enhancements, monospaced utilities (`JetBrains Mono`), and refined focus rings.
  - Implemented full liquid-glass component styles in `components.css`.
- [x] **Phase 3: Shared Layout & Navigation Upgrade**
  - Transformed `header.php` into an adaptive frosted liquid-glass bar with contact info bar.
  - Enhanced product category dropdown with glass styling and formula tags.
  - Refined mobile navigation dock and iOS action sheet with frosted glass styling.
  - Upgraded `footer.php` with cohesive industrial dithered glass finish.
- [x] **Phase 4: Homepage & Cinematic Hero Redesign**
  - Elevated `home.php` hero with liquid-glass telemetry HUD, WebGL morph slider, and fluid typography.
  - Upgraded Quality Pillars, Featured Products, Squeeze Carousel, and Facility sections with liquid-glass styling.
- [x] **Phase 5: Interior Pages Comprehensive Redesign**
  - About Us (`about.php`) - Transformed with liquid-glass profile table, milestones, and authentic facility claims.
  - Capabilities (`capabilities.php`) - 4 processing pillars in liquid-glass cards with detailed technical parameters.
  - Quality Protocol (`quality.php`) - 5-stage analytical verification pipeline and testing benchmarks.
  - Product Catalogue (`products/index.php`) - Liquid-glass filter bar, product grid with CAS/Formula badges.
  - Product Category (`products/category.php`) - Category navigation sidebar and responsive product grid.
  - Product Detail (`products/show.php`) - Liquid-glass specification tables, 3D molecular lattice, and RFQ callouts.
  - Contact Us (`contact.php`) - Plant leadership telemetry cards, interactive map, and secure contact form.
  - Request a Quote (`request_quote.php`) - Structured commercial RFQ form with document upload support.
  - Technical Resources (`technical_resources.php`) - Specification document library with download requests.
  - FAQs (`faqs.php`) - Accessible accordions with liquid-glass item styling and facility showcase.
  - Legal & Utility Pages (`privacy_policy.php`, `terms.php`, `thank_you.php`, `404.php`, `500.php`, `sitemap_html.php`).
- [x] **Phase 6: Motion, Micro-Interactions & Accessibility**
  - Optimized `motion.js`, `cursor.js`, `tilt.js`, `powder-particles.js`, and `navigation.js`.
  - Added strict `prefers-reduced-motion` compliance to custom cursor, particles, and kinetic transitions.
  - Verified keyboard focus rings, semantic landmarks, and ARIA labels.
- [x] **Phase 7: Optimization, QA & Verification**
  - Run complete PHP linter across all files: 100% clean (0 syntax errors).
  - Verified SQLite database querying and product lookups.
  - Multi-viewport responsive optimization (320px to 1920px).
  - Repacked clean production zip file (`hbmetals-production.zip`).

