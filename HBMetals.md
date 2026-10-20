# HBMetals.md

## Master Website Redesign Specification for Antigravity IDE

**Project:** HB Metals India website redesign\
**Reference website:** https://hbmetals.co.in/\
**Required implementation language:** PHP\
**Document purpose:** Master blueprint, implementation instructions,
data model, design system, content migration plan, QA requirements, and
task-by-task prompts for Antigravity IDE.

------------------------------------------------------------------------

# 1. How Antigravity Must Use This Document

Treat this file as the primary project specification. Read it completely
before modifying or creating files. Implement the website in the phases
and task order below.

## Non-negotiable rules

1.  **PHP is the application language.** Use PHP for server-side
    routing, templates, form processing, data access, validation, and
    business logic. Do not build the website as a Node.js, Python,
    React, Next.js, Laravel, or other-language application. Do not
    introduce a framework unless the project already uses it and the
    owner explicitly approves retaining it.
2.  HTML, CSS and browser-side JavaScript are allowed as supporting
    frontend technologies. Use vanilla JavaScript by default. Do not use
    JavaScript to replace PHP server-side responsibilities.
3.  Inspect the existing project before changing it. Preserve working
    configuration and existing useful code. Do not overwrite files
    blindly.
4.  Build section by section. Complete and test each task before
    proceeding to the next. Do not generate the entire site in one
    uncontrolled code dump.
5.  Use the source website as the primary reference for company
    information: https://hbmetals.co.in/. Inspect its pages and product
    links, including:
    -   `/`
    -   `/about-us/`
    -   `/our-products/`
    -   `/contact-us/`
    -   `/magnesium-metal-powder/`
    -   `/magnesium-metal-turning/`
    -   `/sodium-tungstate/`
    -   `/tungsten-trioxide-powder/`
    -   `/tungstic-acid/`
    -   `/cobalt-oxide/`
    -   `/cobalt-acetate/`
6.  Preserve all meaningful source information. Correct grammar and
    improve readability without changing the meaning of technical or
    business claims. Keep a content migration record.
7.  Never invent products, product specifications, certifications, test
    results, customer logos, customer testimonials, capacity figures,
    delivery promises, export markets, years of experience beyond the
    established year, or company-owned machinery. Mark missing
    information as `Needs confirmation` in the internal content
    inventory and do not publish the placeholder as a factual claim.
8.  The source pages have overlapping category and product descriptions.
    Build a consistent catalogue, but do not delete, merge, or redirect
    existing URLs until the old URL has been mapped and the content
    owner has approved the mapping.
9.  Generate new website images only as supporting creative assets. Do
    not present AI-generated factory photographs, laboratory staff,
    certificates, product samples or facilities as authentic evidence of
    HB Metals' real operations. Use authentic supplied images for actual
    products and facilities whenever available. If no authentic image
    exists, use a neutral abstract/industrial visual or label the asset
    as illustrative.
10. Create one central source of truth for company settings, product
    categories, products, page content, navigation, FAQs and technical
    documents. Avoid duplicating the same facts manually across PHP
    templates.
11. Responsive layout is mandatory at all screen sizes. No horizontal
    overflow, clipped content, overlapping elements, broken grids,
    illegible technical tables, or inaccessible menus.
12. Cinematic visual design must not compromise speed, accessibility,
    readability, SEO, enquiry conversion or reduced-motion preferences.
13. Every visible button, link, menu item, search control, form and
    download must work. Do not leave decorative controls pretending to
    be functional.
14. Do not expose secrets, database credentials, debug output, server
    paths or private enquiry data in the browser.
15. After every task, report changed files, tests run, known gaps and
    the next task. Do not claim a test passed unless it was actually
    run.

## Working procedure

-   First inventory the existing repository and identify the current PHP
    entry point, templates, assets, routing style, database and
    deployment assumptions.
-   Create a backup or use version control before major edits.
-   Create `docs/HBMetals.md` or keep this specification at the project
    root as `HBMetals.md`, according to the owner's project structure.
    Do not create multiple competing versions.
-   Create a task checklist and track status as `Not started`,
    `In progress`, `Blocked`, or `Done`.
-   If a task requires missing company facts, implement the field/data
    structure and mark the content as requiring approval instead of
    guessing.
-   Do not proceed past a failed critical test without fixing it or
    clearly recording an approved blocker.

------------------------------------------------------------------------

# 2. Project Objectives

Build a premium, modern, cinematic and responsive industrial B2B website
for HB Metals India that:

-   Clearly explains the company, its history, business model and
    capabilities.
-   Organizes the actual product catalogue into a consistent and
    technically accurate structure.
-   Gives every product a useful, reusable detail page.
-   Provides verified technical information and document access where
    available.
-   Converts visitors into trackable business enquiries.
-   Makes company information and catalogue content maintainable in PHP
    through a central data layer.
-   Improves on-page SEO, technical SEO, accessibility, performance and
    internal linking.
-   Preserves relevant source-site content and existing search-engine
    value.
-   Works on desktop, laptop, tablet, mobile and wide-screen displays.
-   Uses cinematic imagery, controlled motion and refined UI details
    without making the site slow or difficult to use.

## Success criteria

-   Every approved page has a working URL and correct title/H1.
-   All existing source URLs are mapped to a destination or
    intentionally retained.
-   No unapproved factual claims are introduced.
-   Product/category relationships are consistent.
-   Forms validate server-side and provide clear success/error feedback.
-   All layout breakpoints are tested; no unintended horizontal
    scrolling or overlaps.
-   Images are optimized and have meaningful alt text where appropriate.
-   Keyboard navigation, visible focus and reduced-motion support work.
-   Sitemap, robots rules, canonical URLs, metadata and structured data
    are validated.
-   No PHP warnings, fatal errors, broken links or console errors remain
    in production mode.
-   There is a clear documented setup and deployment procedure.

------------------------------------------------------------------------

# 3. Source Website Content Inventory

Use the live website as the starting content source. Re-fetch pages
during implementation because content may change. The information below
is a migration checklist, not permission to assume facts not shown on
the current website.

## 3.1 Homepage

Source: `https://hbmetals.co.in/`

Current source content includes: - Brand: HB Metals / HB Metals India. -
Established in 2013, in Rajkot, Gujarat, India. - The company describes
itself as manufacturing and supplying Tungsten Oxide, Tungsten Powder,
Metal Powder and Ammonium Paratungstate. - Source claims mention high
melting point, purity, high density, shelf life, moisture-proof
packaging and accurate composition. These claims must be checked against
the specific product and actual supporting evidence before being
repeated as universal claims. - Homepage featured products include
Magnesium Metal Powder, Magnesium Metal Turning, Sodium Tungstate and
Tungsten Trioxide Powder. - Homepage benefits include ethical business
policies, infrastructure, product quality, pricing, professional team
and distribution network. Rephrase as professional copy, but do not turn
generic claims into measurable promises. - Source contact details
include phone `9898449394`, email `info@hbmetals.co.in`, and footer
location `Shapar, Rajkot - 360024, Gujarat, India`. Verify address and
postal code before launch.

## 3.2 About Us

Source: `https://hbmetals.co.in/about-us/`

Existing information includes: - Company established in 2013 in Rajkot,
Gujarat, India. - Company describes activities in metal powders,
tungsten oxide and ammonium paratungstate. - The source mentions
processing, production, procurement, testing, research and development,
warehousing and packaging departments. - The source mentions inspection
by quality inspectors and machinery/tools. - The source mentions a
skilled professional team and training/workshops. - The source mentions
customer-centric service, transparent dealings and ethical business
practices. - Preserve the meaning, improve grammar, and verify the
current operational reality before making detailed facility claims.

## 3.3 Product catalogue

Source: `https://hbmetals.co.in/our-products/`

Source category families include: - Sodium Tungstate / related
compounds - Tungsten Powder - Tungsten Oxide - Ammonium Paratungstate -
Metal Oxides - Metallic Salts

The source catalogue mentions product names or variants including: -
Sodium Salt of Tungstic Acid - Sodium Tungstate - Tungstic Acid - Sodium
Tungstate Dihydrate ACS (confirm exact commercial name and grade) -
Tungsten Trioxide Powder - Tungstic Oxide - Tungsten Powders - Tungsten
Oxide - Sodium Tungstate ACS (confirm identity and distinction) -
Tungsten Carbide (confirm availability) - Ammonium Paratungstate /
Ammonium Para Tungstate - Ammonium Tungstate - Metal Oxides - Metallic
Salts

The top-level navigation also lists: - Magnesium Metal Powder -
Magnesium Metal Turning - Sodium Tungstate - Tungsten Trioxide Powder -
Tungstic Acid - Cobalt Oxide - Cobalt Acetate

Do not assume every name above is a separate stocked SKU. Reconcile the
category and product inventory with the company before launch. A
chemical synonym, grade, hydrate, compound or product form must not be
silently treated as an identical product.

## 3.4 Contact Us

Source: `https://hbmetals.co.in/contact-us/`

Published contact information: - Contact person shown: Mr Anil Patel
(Managing Director). - Phone: `9898449394`. - Email:
`info@hbmetals.co.in`. - Contact-page address:
`S.No. 41/1 Golden Industrial Estate-B, Plot-1, Gate No.1, Shapar Virva Road, Shapar, Tal. Lodhika, Dist. Rajkot, Gujarat 360030, India`. -
The footer displays the shorter location
`Shapar, Rajkot - 360024, Gujarat, India`.

**Address discrepancy:** Do not choose one postal code by guess. Flag
the discrepancy and ask the owner to confirm the official address and
postal code. Keep the address in a single settings record so it is
corrected everywhere at once.

## 3.5 Product detail pages

Inspect and migrate content from: -
`https://hbmetals.co.in/magnesium-metal-powder/` -
`https://hbmetals.co.in/magnesium-metal-turning/` -
`https://hbmetals.co.in/sodium-tungstate/` -
`https://hbmetals.co.in/tungsten-trioxide-powder/` -
`https://hbmetals.co.in/tungstic-acid/` -
`https://hbmetals.co.in/cobalt-oxide/` -
`https://hbmetals.co.in/cobalt-acetate/`

For each source page record: - Current URL and HTTP status. - Current
title, H1 and meta description, if present. - Product name and
category. - Full body text and relevant image assets. - Existing MOQ, if
stated. - Technical facts and any supporting document. - Internal links
and inbound source-site links. - New destination URL and redirect
decision. - Content requiring owner confirmation.

Do not discard source content because it is repetitive. First preserve
it in the migration inventory, then decide what belongs on the product
page, category page, company page or technical resource.

------------------------------------------------------------------------

# 4. Full Proposed Website Map

This is the target architecture. Some pages are new recommendations;
they are not claims that these URLs already exist. Create pages only
when there is enough accurate, useful content to justify them. Thin or
duplicated pages should not be published.

## 4.1 Primary navigation

1.  Home
2.  About Us
3.  Products
4.  Capabilities
5.  Quality
6.  Technical Resources
7.  Insights / Resources (only when useful content exists)
8.  Contact
9.  Persistent primary CTA: Request a Quote

## 4.2 Proposed sitemap

### A. Main pages

-   `/`
-   `/about-us/`
-   `/our-products/`
-   `/capabilities/`
-   `/quality/`
-   `/technical-resources/`
-   `/industries/` (publish only if supported)
-   `/resources/` (publish when there are useful resources)
-   `/contact-us/`
-   `/request-a-quote/`

### B. Product categories

Use category paths only after confirming the actual category
structure: - `/product-category/tungsten-oxide/` -
`/product-category/tungsten-powder/` -
`/product-category/sodium-tungstate/` -
`/product-category/ammonium-paratungstate/` -
`/product-category/metal-oxides/` -
`/product-category/metallic-salts/` -
`/product-category/magnesium-products/` -
`/product-category/other-products/` (only if needed)

The category page should show the category introduction, product list,
optional relevant filters, technical resources and enquiry CTA.

### C. Individual product pages

Preserve the current source URL if it remains accurate and useful: -
`/magnesium-metal-powder/` - `/magnesium-metal-turning/` -
`/sodium-tungstate/` - `/tungsten-trioxide-powder/` -
`/tungstic-acid/` - `/cobalt-oxide/` - `/cobalt-acetate/`

Add other product URLs only after the business confirms the product is
offered and supplies its correct product name and technical details.

### D. Company and capabilities

-   `/about-us/our-history/` (only if verified milestones exist)
-   `/about-us/leadership-team/` (only with approved
    names/photos/profiles)
-   `/capabilities/infrastructure/`
-   `/capabilities/manufacturing/`
-   `/capabilities/procurement/` (if relevant)
-   `/capabilities/warehousing-packaging/`
-   `/capabilities/research-development/` (only if confirmed)
-   `/quality/quality-control/`
-   `/quality/certifications/` (show only genuine current
    certifications)
-   `/quality/safety/`

### E. Technical centre

-   `/technical-resources/`
-   `/technical-resources/tds/`
-   `/technical-resources/sds/`
-   `/technical-resources/coa/` (controlled access or enquiry-based
    delivery where appropriate)
-   `/technical-resources/specifications/`
-   `/technical-resources/handling/`
-   `/technical-resources/storage/`
-   `/faq/`
-   `/technical-enquiry/`

Do not publish a document library with empty fake downloads. Only list
documents that exist, are approved and match the exact product/version.

### F. Enquiry pages

-   `/request-a-quote/`
-   `/bulk-supply/` (if useful)
-   `/custom-requirements/` (only if the business accepts such requests)
-   `/business-enquiry/`
-   `/enquiry/thank-you/` (noindex)
-   `/enquiry/error/` (noindex, if a separate page is necessary)

### G. Insights/resources (optional)

-   `/resources/`
-   `/resources/product-guides/`
-   `/resources/material-guides/`
-   `/resources/applications/`
-   `/resources/quality-testing/`
-   `/resources/news/`

Create articles only when the company can review them for technical
accuracy. Avoid mass-generated pages that make unsupported technical
claims.

### H. Policies and utility

-   `/privacy-policy/`
-   `/terms-and-conditions/`
-   `/disclaimer/`
-   `/cookie-policy/` (if applicable)
-   `/search/`
-   `/sitemap/` (human-readable HTML sitemap)
-   `/sitemap.xml`
-   `/robots.txt`
-   Custom 404 page

## 4.3 Global page relationships

-   Homepage links to product categories, company information,
    quality/capabilities, resources and RFQ.
-   Every category links to its own products.
-   Every product links to its parent category, relevant documents,
    relevant related products and RFQ.
-   Technical documents link back to the exact product.
-   Resources link to relevant product and category pages.
-   Breadcrumbs are present on all nested pages.
-   The same product must not have multiple indexable canonical URLs.

------------------------------------------------------------------------

# 5. Section-by-Section Page Blueprints

## 5.1 Homepage

Build in this order:

1.  **Header:** approved logo, primary navigation, product dropdown,
    search, phone/contact shortcut where appropriate, and a prominent
    RFQ CTA.
2.  **Hero:** cinematic but lightweight image/video treatment, clear
    product specialisation, concise supporting statement, Explore
    Products and Request a Quote actions. Avoid vague claims such as
    "best in the world."
3.  **Company snapshot:** established in 2013, Rajkot, Gujarat, India;
    show only verified facts.
4.  **Product families:** accurate category cards and concise
    descriptions.
5.  **Featured products:** real catalogue entries, product thumbnails,
    short copy and detail links.
6.  **Capabilities:** manufacturing/supply model, procurement,
    processing, testing, packaging or warehousing only as confirmed.
7.  **Quality:** actual inspection steps and available documents, no
    invented certifications.
8.  **Applications/industries:** only sectors relevant to the products
    the company actually supplies.
9.  **Why HB Metals:** evidence-backed points rather than generic
    superlatives.
10. **Technical resources:** links to approved documents and technical
    enquiries.
11. **FAQs:** real, reviewed questions and answers.
12. **Final RFQ banner:** invite product/grade/quantity requirements.
13. **Footer:** approved contact details, category links, company links
    and policies.

Avoid making the homepage too long with repeated statements. Each
section must provide distinct information and have a clear purpose.

## 5.2 About Us

1.  Breadcrumb and page introduction.
2.  Company overview and established year.
3.  Company history only if milestones are verified.
4.  Business model: clearly distinguish in-house manufacturing,
    processing, sourcing and distribution.
5.  Team and leadership only with approved information.
6.  Infrastructure/facilities using authentic photographs.
7.  Actual manufacturing, procurement, testing and packaging processes.
8.  Quality-control approach.
9.  Customer service and business principles.
10. CTA to explore products or submit an enquiry.

## 5.3 Product catalogue

1.  Breadcrumb and category introduction.
2.  Search/filter interface only for fields supported by real data.
3.  Category navigation.
4.  Product grid with consistent cards.
5.  Pagination if needed; never hide important products behind
    inaccessible infinite scroll.
6.  Clear empty-state and search-no-results message.
7.  RFQ CTA.
8.  Related categories and useful technical resources.

## 5.4 Individual product page

1.  Breadcrumbs and exact product name.
2.  Main product image/gallery with correct alt text.
3.  Product summary and enquiry CTA.
4.  Product identity: chemical name, formula, CAS number if applicable;
    verify each field.
5.  Specification table with actual values/units and data provenance.
6.  Grade, purity, form, particle size or other parameters only when
    confirmed.
7.  Applications and material characteristics, reviewed for accuracy.
8.  Packaging, MOQ and supply terms only when confirmed.
9.  Available TDS/SDS/COA links.
10. Storage/handling safety guidance from approved sources.
11. Product FAQs.
12. Related products and parent category.
13. Product-specific RFQ form.
14. Structured data only for fields actually visible and accurate.

## 5.5 Capabilities and quality

-   Explain the business's actual supply/manufacturing model.
-   Show genuine facilities and equipment only.
-   Describe quality checks only if performed.
-   List certifications only if valid and approved for public display.
-   Add a clear distinction between a company's general quality process
    and an accredited certification.
-   Do not claim ISO, export approvals, testing accreditations, capacity
    or laboratory equipment without proof.

## 5.6 Technical resources

-   Search/filter by product and document type.
-   Show document name, matching product, revision/version,
    publication/update date and file size where available.
-   Serve downloads securely from approved files.
-   Use meaningful download labels, not "Click here."
-   Provide a technical enquiry path if a requested document is not
    public.
-   Ensure the file truly exists before showing a download link.

## 5.7 Contact and RFQ

-   Contact details from the central settings record.
-   A clear general contact form and separate RFQ workflow.
-   Product-specific enquiry should prefill product name and URL.
-   Required fields: name, business email or contact method, message and
    privacy acknowledgement where appropriate.
-   RFQ fields: product(s), required quantity/unit, requested
    grade/specification, delivery destination, preferred packaging,
    target date if relevant, company details, message and optional file
    upload.
-   Validate server-side; escape output; prevent spam and file-upload
    abuse.
-   Provide clear success/failure state and a reference ID when an
    enquiry is stored.
-   Do not claim that an email was sent if the mail operation failed.
    Log the failure safely and show a useful response.

------------------------------------------------------------------------

# 6. Design System

Build the design system before creating page-specific layouts. Store
design tokens centrally and use them across all templates.

## 6.1 Visual direction

-   Premium industrial B2B, precise and confident.
-   Cinematic compositions using controlled contrast, large but readable
    typography, authentic product photography, subtle depth and
    deliberate whitespace.
-   Clean technical content areas with restrained cards and borders.
-   Use a consistent grid and spacing system.
-   Avoid generic template styling, excessive gradients, glowing
    effects, decorative animation everywhere, random rounded cards,
    giant empty hero space or repeated AI-looking images.
-   The design must feel intentional and brand-specific, not like an
    off-the-shelf AI template.

## 6.2 Proposed colour palette

This is a proposed palette, not a claim about the current logo.
Reconcile it with the actual HB Metals logo before finalizing.

  Token                    Hex         Usage
  ------------------------ ----------- -------------------------------------
  `--color-ink`            `#142633`   Primary text, deep surfaces
  `--color-navy`           `#1C3445`   Header, footer, hero overlay
  `--color-steel`          `#536878`   Secondary text and technical labels
  `--color-copper`         `#B86D3C`   Main CTA and restrained accents
  `--color-copper-hover`   `#96552F`   CTA hover state
  `--color-paper`          `#F7F8F8`   Main light background
  `--color-white`          `#FFFFFF`   Cards and reading surfaces
  `--color-line`           `#DCE2E6`   Borders and dividers
  `--color-muted`          `#6A7882`   Secondary copy
  `--color-success`        `#28724A`   Success messages
  `--color-warning`        `#93641C`   Warnings
  `--color-error`          `#B42318`   Validation and error messages
  `--color-focus`          `#1D70D6`   Accessible keyboard focus

Check contrast ratios before release. Do not use colour alone to convey
success/error. CTA text and focus indicators must remain legible.

## 6.3 Typography

Use a practical, performant typography system. Prefer locally hosted
licensed fonts or a dependable system stack. If using a web font, ensure
fallback fonts and avoid blocking the initial render.

Suggested stack: - Display/headings: `Manrope`, with system sans-serif
fallback, if properly licensed and self-hosted/loaded efficiently. -
Body/UI: `Inter`, with system sans-serif fallback, if properly licensed
and self-hosted/loaded efficiently. - Fallback:
`Arial, Helvetica, sans-serif`.

Suggested responsive scale: - Hero display:
`clamp(2.5rem, 5.5vw, 5.5rem)`, line-height 0.98--1.08. - H1:
`clamp(2.25rem, 4vw, 4.25rem)`. - H2: `clamp(1.75rem, 3vw, 3rem)`. - H3:
`clamp(1.25rem, 2vw, 1.75rem)`. - Body large: `1.125rem` where useful. -
Body: `1rem` with 1.55--1.75 line-height. - Small text: no smaller than
comfortably readable; generally avoid less than `0.8125rem` except
compact metadata. - Technical table values: readable, aligned and wrap
safely.

Use sentence case for headings. Avoid uppercase paragraphs. Do not use
overly thin fonts on dark backgrounds.

## 6.4 Spacing, layout and shape tokens

Use CSS custom properties: - Base spacing: 4px/8px rhythm; tokens such
as 4, 8, 12, 16, 24, 32, 48, 64, 80, 96, 120px. - Content max width:
approximately 1200--1320px, configurable. - Reading text width:
approximately 65--75 characters per line. - Section vertical spacing:
responsive `clamp()` values. - Standard card radius: 10--16px. - Large
image/hero radius: 0--20px based on composition, not random. - Border
width: 1px. - Shadows: subtle and purposeful. - Use CSS Grid/Flexbox;
avoid fixed widths that break on small devices. - Use `min-width: 0` for
grid/flex children containing long text. - Use `overflow-wrap: anywhere`
for long emails, URLs and identifiers where necessary.

## 6.5 Buttons and interaction states

Create consistent variants: - Primary: copper accent, accessible
contrast. - Secondary: outline or quiet neutral. - Text/link action. -
Disabled, loading, success and error states where relevant.

All controls need hover, keyboard focus, pressed and disabled states.
Buttons should have real actions. Use semantic `<button>` for actions
and `<a>` for navigation.

## 6.6 Product cards and specification tables

Product cards must have: - Consistent image ratio and image behaviour. -
Product name and concise, accurate summary. - Optional verified
grade/form badges. - Clear View Product and/or Request a Quote
actions. - Consistent alignment without forcing all descriptions into
fixed-height clipped boxes.

Tables must: - Use semantic table markup and header cells. - Wrap long
values or use an accessible horizontal-scroll wrapper only where
necessary. - Never force the entire page to overflow horizontally. -
Work on touch devices and at browser zoom.

------------------------------------------------------------------------

# 7. Cinematic Visuals, Generated Images and Animation

## 7.1 Cinematic approach

Use a restrained art direction: - Hero may use a high-quality, dark
industrial composition with product-relevant detail and a subtle
gradient overlay for readable text. - Use genuine product/facility
photography whenever supplied. - Use macro material textures, metal
surfaces, abstract technical geometry and controlled lighting as
secondary visuals. - Use layered composition and whitespace rather than
excessive decoration. - Keep the product and company content visually
dominant over effects. - Ensure text contrast over all images. - Avoid
autoplay video with sound. - If a video is used, provide a poster,
pause/control behaviour where appropriate, a static fallback, and
reduced-motion handling. - Use no more than a few purposeful animated
moments per page.

## 7.2 Image generation plan

Create an asset inventory before generating or sourcing images.
Suggested assets: 1. Homepage hero industrial-material image. 2.
Category visuals for confirmed product families. 3. Product photographs
for each verified product, preferably supplied by the company. 4.
Abstract technical/material textures. 5. Authentic company/team/facility
images if provided. 6. Technical resource and quality-section visuals.

Asset requirements: - Create new images with a consistent art direction,
lighting and tonal range. - Never use generated imagery as proof of real
company premises, people, certification or production equipment. - Do
not generate labels, chemical formulas, certificates or text inside
images; render real text in HTML. - Do not alter genuine product
packaging/identity if a real product image is provided. - Generate
suitable desktop and mobile crops when needed; use `object-position` to
preserve important subjects. - Use modern formats such as WebP/AVIF when
supported and provide fallbacks as appropriate. - Set intrinsic
width/height or aspect ratio to reduce layout shift. - Lazy-load
below-the-fold images; do not lazy-load the main hero/LCP image. -
Provide alt text for informative images; use empty alt for purely
decorative images. - Maintain a local asset manifest with filename,
purpose, dimensions, format, origin, licence/approval and alt text.

## 7.3 Motion design

Use CSS transitions and IntersectionObserver only when needed. Avoid
unnecessary animation libraries.

Suggested motion: - Header background/contrast transition after
scroll. - Hero text reveal with short opacity/transform sequence. -
Subtle image parallax only if it remains smooth and does not harm mobile
performance. - Section reveal with opacity and a small vertical
movement. - Product-card hover image movement or border change. - Button
feedback and navigation dropdown transitions. - Number counters only for
verified numerical company facts; do not invent counters.

Motion rules: - Keep common transitions around 150--350ms; longer
cinematic sequences must remain short and purposeful. - Respect
`prefers-reduced-motion: reduce`. - Do not hide essential content until
animation completes. - Do not animate large layout-affecting properties
when transform/opacity is sufficient. - Disable/reduce parallax and
complex effects on mobile or low-capability devices. - Avoid
scroll-jacking, forced smooth-scroll behaviour, flashing and motion that
blocks interaction. - Test at 60Hz where possible and on lower-powered
mobile hardware.

------------------------------------------------------------------------

# 8. Full Responsive Design Requirements

Build mobile-first and verify at, at minimum, these viewport widths: -
320px - 360px - 375px - 390px - 430px - 600px - 768px - 820px - 1024px -
1280px - 1440px - 1920px

Also test intermediate widths and browser zoom. Do not rely only on
named device presets.

## Required behaviour

### Mobile

-   No page-level horizontal overflow.
-   Header collapses into an accessible menu.
-   Hero title wraps naturally; CTA buttons stack or wrap without
    clipping.
-   Product grid becomes one column or a suitable compact layout.
-   Product image and specification sections stack logically.
-   Forms use full-width fields and comfortable touch targets.
-   Footer columns stack.
-   Fixed/sticky actions must not cover form fields, cookie notices or
    content.
-   Tables use a contained scroll region or an alternate card
    presentation if appropriate.
-   Long email addresses, URLs and chemical identifiers must not break
    the layout.

### Tablet

-   Use two-column content layouts where space supports them.
-   Navigation must not collide with logo or CTA.
-   Product grids should adjust to available width.
-   Side-by-side technical content must stack before becoming cramped.

### Desktop and wide screens

-   Set a readable maximum content width.
-   Do not stretch paragraph text across the entire screen.
-   Maintain deliberate spacing and balanced visual hierarchy.
-   Ensure the header remains aligned and does not overflow with
    translated or longer text.
-   Keep large screens cinematic without leaving giant empty areas.

## Responsive acceptance checks

-   No unintended horizontal scrolling.
-   No overlap between headings, images, controls or cards.
-   No clipped buttons or text.
-   No fixed pixel heights that crop variable text.
-   No layout that depends on hover alone.
-   All navigation and forms work with keyboard and touch.
-   Images retain intended subject and aspect ratio.
-   Content order remains logical when columns stack.

------------------------------------------------------------------------

# 9. Data Shape Up Front

Decide the data model before building the pages. Do not hardcode
catalogue entries into multiple templates.

The initial implementation may use PHP data files if the existing
project is small and no database is configured. For a maintained,
editable catalogue and enquiry workflow, prefer MySQL/MariaDB with PDO
and prepared statements. Follow the existing project architecture where
it is sound.

## 9.1 Core entities

### Site settings

-   `id`
-   `site_name`
-   `site_tagline`
-   `logo_path`
-   `favicon_path`
-   `phone`
-   `email`
-   `address_line_1`
-   `address_line_2`
-   `city`
-   `state`
-   `postal_code`
-   `country`
-   `map_embed_url` (validated/approved)
-   `social_links_json`
-   `seo_default_title`
-   `seo_default_description`
-   `updated_at`

Store company contact details once. Resolve the current postal-code
discrepancy before launch.

### Pages

-   `id`
-   `title`
-   `slug`
-   `page_type`
-   `summary`
-   `body_content` or structured section data
-   `meta_title`
-   `meta_description`
-   `canonical_url`
-   `robots_directive`
-   `status` (`draft`, `published`, `archived`)
-   `sort_order`
-   `published_at`
-   `created_at`
-   `updated_at`

### Product categories

-   `id`
-   `name`
-   `slug`
-   `short_description`
-   `long_description`
-   `parent_id` nullable
-   `image_path`
-   `meta_title`
-   `meta_description`
-   `status`
-   `sort_order`
-   `created_at`
-   `updated_at`

### Products

-   `id`
-   `name`
-   `slug`
-   `category_id`
-   `short_description`
-   `description`
-   `chemical_name`
-   `chemical_formula`
-   `cas_number`
-   `grade`
-   `purity_value`
-   `physical_form`
-   `particle_size`
-   `packaging_options_json`
-   `minimum_order_quantity`
-   `minimum_order_unit`
-   `availability_status` (only if maintained accurately)
-   `applications_json`
-   `specifications_json`
-   `handling_notes`
-   `storage_notes`
-   `featured`
-   `status`
-   `source_url`
-   `meta_title`
-   `meta_description`
-   `canonical_url`
-   `created_at`
-   `updated_at`

Unknown values should be `NULL`, not made-up values or strings like
"100%" or "best quality." Store numeric values and units separately when
appropriate. Use a dedicated specification table if specifications
require filtering, revisioning or multiple rows.

### Product images

-   `id`
-   `product_id`
-   `image_path`
-   `alt_text`
-   `caption`
-   `is_primary`
-   `sort_order`
-   `origin_type` (`company`, `licensed_stock`,
    `generated_illustration`)
-   `approval_status`
-   `created_at`

### Technical documents

-   `id`
-   `product_id`
-   `document_type` (`TDS`, `SDS`, `COA`, `specification`, `other`)
-   `title`
-   `file_path`
-   `mime_type`
-   `file_size`
-   `revision`
-   `published_at`
-   `access_level`
-   `status`
-   `created_at`
-   `updated_at`

Do not expose private or customer-specific COAs through public
predictable file URLs.

### FAQs

-   `id`
-   `product_id` nullable
-   `category_id` nullable
-   `question`
-   `answer`
-   `sort_order`
-   `status`
-   `created_at`
-   `updated_at`

### Enquiries

-   `id`
-   `reference_code`
-   `enquiry_type`
-   `name`
-   `company_name`
-   `email`
-   `phone`
-   `country`
-   `destination`
-   `message`
-   `privacy_acknowledged_at`
-   `status` (`new`, `reviewing`, `responded`, `closed`, `spam`)
-   `created_at`
-   `updated_at`

### Enquiry items

-   `id`
-   `enquiry_id`
-   `product_id` nullable
-   `requested_product_name` nullable
-   `quantity`
-   `quantity_unit`
-   `requested_grade`
-   `requested_purity`
-   `packaging_preference`
-   `target_date` nullable
-   `specification_notes`

### Enquiry attachments

-   `id`
-   `enquiry_id`
-   `stored_filename`
-   `original_filename`
-   `mime_type`
-   `file_size`
-   `scan_status`
-   `created_at`

Store uploads outside the public web root when possible. Validate file
extension, actual MIME type, size and content. Never trust
client-provided filenames.

### Redirects

-   `id`
-   `source_path`
-   `destination_path`
-   `http_status` (normally 301 for permanent approved moves)
-   `active`
-   `created_at`

### Content audit / migration map

-   `id`
-   `source_url`
-   `source_title`
-   `source_status`
-   `destination_url`
-   `decision` (`keep`, `update`, `redirect`, `retire`)
-   `reason`
-   `owner_approval`
-   `checked_at`

## 9.2 Relationships and rules

-   A category can have many products.
-   A product belongs to one primary category; optional related
    categories can use a junction table.
-   A product can have many images, technical documents and FAQs.
-   An enquiry can have many enquiry items and attachments.
-   Every public slug must be unique.
-   Every product must have a valid status and canonical URL.
-   Do not publish a product with no approved name or required content.
-   Do not show empty specification rows.
-   Store UTC timestamps in the database and display times appropriately
    for the business context.
-   Use migrations or documented SQL schema changes; do not alter
    production data silently.

## 9.3 JSON data option for a simple PHP site

If the project has no database and the owner approves a file-based first
version, keep data in structured PHP arrays or validated JSON outside
public write access. Separate data from templates. Do not write
arbitrary submitted form values into executable PHP files. A database is
preferred for enquiry records, search, content editing and long-term
maintenance.

------------------------------------------------------------------------

# 10. PHP Architecture and Coding Standards

## 10.1 Suggested project structure

Adapt to the existing repository rather than blindly replacing it.

``` text
/
├── public/
│   ├── index.php
│   ├── assets/
│   │   ├── css/
│   │   │   ├── tokens.css
│   │   │   ├── base.css
│   │   │   ├── layout.css
│   │   │   ├── components.css
│   │   │   ├── animations.css
│   │   │   └── responsive.css
│   │   ├── js/
│   │   │   ├── main.js
│   │   │   ├── navigation.js
│   │   │   ├── forms.js
│   │   │   └── motion.js
│   │   ├── images/
│   │   └── fonts/
│   ├── robots.txt
│   └── sitemap.xml (generated dynamically or built by a controlled script)
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Validation/
│   ├── Routing/
│   ├── Views/
│   │   ├── layouts/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── products/
│   │   └── errors/
│   └── Support/
├── data/ or database/
├── storage/
│   ├── logs/
│   ├── private-uploads/
│   └── cache/
├── config/
├── migrations/
├── tests/
├── docs/
├── .env.example
├── .gitignore
└── README.md
```

Keep secrets, private uploads, logs and writable storage outside the
public web root. If hosting requires a different structure, use server
configuration to prevent direct access to private directories.

## 10.2 PHP requirements

-   Use a currently supported PHP version available in the deployment
    environment; document the tested version.
-   Enable strict error logging in production but never display stack
    traces to visitors.
-   Use PDO prepared statements for SQL.
-   Escape HTML output with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`
    or an equivalent central helper.
-   Validate input on the server, even when client-side validation
    exists.
-   Use CSRF protection for state-changing forms and admin actions.
-   Apply rate limits and anti-spam controls to public forms.
-   Validate uploads by MIME type, extension, size and content; store
    privately.
-   Use secure session settings if sessions/admin access are
    implemented.
-   Use environment variables for credentials. Never commit `.env`.
-   Restrict HTTP methods and return appropriate status codes.
-   Use `404` for missing pages and avoid leaking filesystem paths.
-   Add logging that avoids passwords, secret tokens and unnecessary
    personal information.
-   Use a Content Security Policy where feasible and validate any
    allowed third-party embeds.
-   Do not use `eval`, unsafe deserialization or raw user input in SQL,
    shell commands or templates.
-   Do not use user-submitted strings as filenames without safe
    generated storage names.
-   Add server-side pagination and bounded queries for catalogue/search.
-   Use semantic HTML and accessible labels.

## 10.3 PHP routing

-   Use one central router or a small, clearly documented routing layer.
-   Normalize trailing slashes consistently.
-   Match routes against an explicit route map or safely resolved slug.
-   Never include PHP files based directly on an untrusted URL segment.
-   Preserve existing source paths when feasible.
-   Add explicit 301 redirects only after reviewing source/destination
    mapping.
-   Keep canonical URLs absolute, correct and consistent.
-   Ensure query parameters do not create duplicate indexable versions.

------------------------------------------------------------------------

# 11. SEO, Accessibility, Performance and Security

## 11.1 SEO

-   Unique, accurate title and meta description per indexable page.
-   One clear H1 per page, followed by logical heading levels.
-   Canonical URL on indexable pages.
-   XML sitemap containing only canonical, published, indexable URLs.
-   `robots.txt` that does not accidentally block important assets or
    pages.
-   Correct 301 redirects for approved URL changes.
-   Open Graph metadata for shareable pages.
-   Breadcrumbs and valid `BreadcrumbList` structured data.
-   `Organization` structured data based on confirmed company facts.
-   `Product` structured data only where appropriate and where displayed
    product data meets the requirements. Do not invent prices, offers,
    ratings, stock or reviews.
-   Descriptive image filenames and useful alt text.
-   Internal links between categories, products, documents and
    resources.
-   Search pages, thank-you pages and utility routes should generally be
    noindex where appropriate.
-   Do not publish fake reviews, fake star ratings or fabricated
    customer logos.
-   Validate structured data and inspect indexing after launch.

## 11.2 Accessibility

-   Semantic landmarks and headings.
-   Keyboard-accessible navigation and dropdowns.
-   Visible focus states.
-   Skip-to-content link.
-   Labels and instructions for every form field.
-   Clear validation errors linked to their fields.
-   Sufficient contrast.
-   Alt text for informative images.
-   No hover-only functionality.
-   Reduced-motion support.
-   Accessible accordions and dialogs.
-   Logical focus management after errors or successful submissions.
-   Test with keyboard, zoom and at least one screen reader where
    possible.

## 11.3 Performance

-   Optimize images and use responsive `srcset`/`sizes` where
    appropriate.
-   Lazy-load below-the-fold images and avoid lazy-loading the hero LCP
    image.
-   Avoid huge background videos on mobile.
-   Minimize third-party scripts and font weights.
-   Defer non-critical JavaScript.
-   Reserve image dimensions to reduce layout shifts.
-   Cache static assets with versioned filenames or cache-busting.
-   Enable compression and sensible browser caching at the server/CDN
    level where available.
-   Avoid loading animation libraries for effects achievable with CSS.
-   Measure Core Web Vitals using real tools rather than guessing.

## 11.4 Security and privacy

-   HTTPS in production.
-   Secure form handling, CSRF protection and rate limiting.
-   Safe SQL, output escaping and strict validation.
-   Protected private files and uploads.
-   No public error traces or secrets.
-   Appropriate privacy notice for enquiry data.
-   Do not send enquiry details to third parties without an approved
    reason and suitable notice.
-   Restrict administrative access if a CMS/admin panel is added.
-   Back up database and uploaded assets before migrations and
    deployment.
-   Test restore procedures, not only backup creation.

------------------------------------------------------------------------

# 12. Task-by-Task Antigravity Prompts

**Execution rule:** Run these prompts in order. Do not ask Antigravity
to complete all phases in a single prompt. After each task, inspect the
changes and approve them before continuing. Each prompt is designed to
be copied separately into Antigravity.

## TASK 01 --- Inspect the Repository and Plan the Implementation

``` text
Read the complete HBMetals.md specification first. Do not start by generating the whole website.

Inspect the current repository, PHP version assumptions, existing routes, entry points, templates, CSS, JavaScript, assets, database/configuration, deployment setup and current git status if available.

The implementation must remain PHP-based. HTML, CSS and vanilla JavaScript may support the frontend. Do not migrate to Node.js, React, Next.js, Python or another application language.

Create a repository audit report listing:
1. Existing architecture and files.
2. Reusable code/assets that should be preserved.
3. Existing pages and routes.
4. Current dependencies and risks.
5. Missing capabilities against HBMetals.md.
6. Recommended implementation sequence.
7. Any blocking facts that need owner confirmation.

Do not delete or overwrite working files. Do not invent company facts. Make no broad refactor yet. Report the files inspected, findings and proposed next step.
```

## TASK 02 --- Audit the Existing Website and Build the Migration Map

``` text
Read HBMetals.md and inspect https://hbmetals.co.in/ and its publicly accessible pages.

Inspect the homepage, About Us, Our Products, Contact Us and every product URL listed in HBMetals.md. Record current title, H1, copy, images, internal links, metadata if accessible, product names, stated MOQ and contact information.

Create a content migration inventory with:
- Source URL
- Source title/H1
- Content summary
- Images/assets
- Product/category relationship
- Existing technical claims
- Existing SEO fields if discoverable
- Proposed destination URL
- Keep/update/redirect/retire decision
- Owner confirmation required
- Notes

Preserve meaningful source information. Flag the mismatch between the contact-page postal code 360030 and footer postal code 360024 for owner confirmation. Do not silently resolve it.

Do not publish new pages or remove existing pages in this task. Produce the inventory and identify gaps before proceeding.
```

## TASK 03 --- Finalize Sitemap, Routes and Page Inventory

``` text
Using HBMetals.md and the migration inventory, finalize the website sitemap and route map.

Requirements:
- Keep all approved source URLs or create an explicit redirect mapping.
- Separate global pages, product categories, individual products, technical resources, company/capability pages, enquiry pages and policies.
- Do not create thin pages with no useful content.
- Use unique canonical URLs.
- Prevent duplicate products across category URLs.
- Add breadcrumbs for nested routes.
- Add explicit 404 handling.
- Do not invent product offerings or credentials.

Create a route/page inventory file and an implementation checklist. Implement only the routing skeleton needed for the current PHP architecture. Test every route for correct status and template resolution. Report unresolved owner decisions.
```

## TASK 04 --- Decide the Data Model and Create the Schema

``` text
Read the data-model section of HBMetals.md before writing page templates.

Inspect the existing data layer. If a suitable database exists, preserve its working approach. Otherwise, recommend a PHP-compatible MySQL/MariaDB schema using PDO. Do not introduce a different application language.

Create a documented schema/migration for:
- Site settings
- Pages
- Product categories
- Products
- Product images
- Technical documents
- FAQs
- Enquiries
- Enquiry items
- Enquiry attachments metadata
- URL redirects
- Content migration audit records

Use foreign keys, unique slugs, appropriate indexes, timestamps and nullable fields for unknown product facts. Avoid fake default values. Keep product names and company contact data centralized. Do not seed fictional testimonials, certificates, product specs, customers or stock quantities.

Create .env.example without real secrets. Document setup and migration commands. Test schema creation and relationships without damaging existing data.
```

## TASK 05 --- Build the Design Tokens and Typography System

``` text
Implement the design system specified in HBMetals.md before building page sections.

Use the proposed industrial palette as a starting point:
ink #142633, navy #1C3445, steel #536878, copper #B86D3C, copper hover #96552F, paper #F7F8F8, white #FFFFFF, line #DCE2E6, muted #6A7882, success #28724A, warning #93641C, error #B42318 and focus #1D70D6.

First inspect the actual HB Metals logo if available and reconcile the palette with it. Store colours, typography, spacing, radii, content widths, shadows, transitions and z-index values as CSS custom properties in a centralized tokens stylesheet.

Use a readable sans-serif font system with fallbacks and efficient font loading. Define responsive type sizes using clamp() where appropriate. Define accessible focus styles, selection states and reduced-motion defaults.

Do not build the full pages yet. Create a design-system demonstration page or component gallery showing headings, body text, links, buttons, inputs, cards, badges, specification tables and alerts. Test contrast and mobile rendering.
```

## TASK 06 --- Build the Shared PHP Layout and Global Navigation

``` text
Build reusable PHP layout components using the current project architecture.

Implement:
- Base page layout
- Header and primary navigation
- Accessible Products dropdown
- Mobile menu with keyboard support
- Search entry point
- Request a Quote CTA
- Breadcrumb component
- Footer
- Shared button/link styles
- Page title and metadata helpers
- Error/404 layout
- Skip-to-content link

Use semantic HTML. Escape dynamic values. Use the central site settings record for phone, email, address and logo. Do not duplicate contact information in multiple templates.

The navigation must work without hover and must be usable on touch devices and keyboards. Avoid layout shifts and horizontal overflow. Do not add dead links or decorative controls without actions. Test at 320px, 390px, 768px, 1024px, 1440px and 1920px.
```

## TASK 07 --- Build the Asset Library and Cinematic Visual System

``` text
Using HBMetals.md, create a consistent visual asset plan and implement the image/motion infrastructure.

Inventory existing company logos, product photos, facility images and other assets before generating replacements. Prefer approved real images for real products and facilities. Generated imagery may be used for illustrative industrial textures and supporting visuals, but must not be presented as authentic company facilities, staff, certificates or equipment.

Create a named asset manifest with filename, purpose, dimensions, origin, approval status, alt text and licence/source. Generate or source only assets needed for approved page sections. Keep the same visual direction, tonal range and crop behaviour across the site.

Implement responsive images, explicit dimensions/aspect ratios, optimized formats, appropriate object-fit/object-position and lazy loading below the fold. Do not lazy-load the hero LCP image.

Add subtle CSS motion for hero reveal, section reveal and card/button feedback. Respect prefers-reduced-motion. Avoid scroll-jacking, flashing, excessive parallax, autoplay sound and unnecessary animation libraries. Test mobile performance and ensure content remains visible if JavaScript is disabled.
```

## TASK 08 --- Build the Homepage Section by Section

``` text
Build the homepage using the approved content inventory and shared design system. Do not write unverified company claims.

Implement these sections in order:
1. Header/navigation
2. Cinematic hero with a specific industrial materials value proposition
3. Company snapshot
4. Product category overview
5. Featured verified products
6. Capabilities/supply model
7. Quality assurance
8. Relevant industries/applications, only if confirmed
9. Why HB Metals with evidence-backed claims
10. Technical resources
11. FAQs
12. Request a Quote CTA
13. Global footer

Every section must have a distinct purpose, consistent spacing and responsive behaviour. Use real product data from the central model, not hardcoded copies. Do not invent metrics, client logos, reviews, certifications, production capacity or delivery guarantees.

Use cinematic image composition with restrained motion and readable text. Test the complete page at all required viewport widths. Report missing approved assets and facts rather than fabricating them.
```

## TASK 09 --- Build About Us and Company Capability Pages

``` text
Build About Us using verified content migrated from the current HB Metals website.

Structure:
- Company overview and establishment in 2013
- Business model and product specialisation
- History/milestones only where verified
- Leadership/team only where approved
- Infrastructure and facilities
- Manufacturing, processing, procurement, testing, R&D and warehousing/packaging only to the extent confirmed
- Quality process
- Business principles
- Related product links and enquiry CTA

Create reusable page templates for capability subpages only where useful, factually supported content exists. Use authentic facility images where available; never portray generated imagery as a real HB Metals facility.

Improve grammar and clarity without altering technical meaning. Keep unknown facts in the content audit as requiring approval. Make all content responsive and accessible.
```

## TASK 10 --- Build Product Categories and Catalogue Search

``` text
Build the product catalogue from the central data model.

Implement:
- Catalogue introduction
- Category navigation
- Product cards with consistent images and summaries
- Search by product name and approved relevant fields
- Filters only when the data exists
- Pagination when needed
- Useful empty/no-results state
- Parent/child category relationships
- Related categories and RFQ CTA

Use the source product/category inventory in HBMetals.md. Reconcile overlapping names and chemical synonyms; do not silently combine distinct materials or publish unconfirmed products as available.

Use prepared statements for database search, bounded pagination, escaped output and correct status handling. Ensure each product has one canonical URL. Test keyboard operation, search query handling and responsive grids.
```

## TASK 11 --- Build the Reusable Individual Product Template

``` text
Create one reusable PHP product detail template and render it from product records.

Sections:
1. Breadcrumbs
2. Product title and summary
3. Product image/gallery
4. Chemical identity fields where confirmed
5. Technical specifications table
6. Applications and material characteristics
7. Grade/form/packaging/MOQ only when verified
8. Approved technical documents
9. Handling/storage information from approved sources
10. Product FAQs
11. Related products
12. Product-specific RFQ

Hide unknown or empty fields instead of showing fake values. Do not create universal claims about purity, shelf life, moisture resistance or compliance. Product formulas, CAS numbers, grades, values and units must be reviewed for accuracy.

Preserve approved existing product URLs. Generate correct title/meta/canonical/breadcrumbs. Add Product structured data only when appropriate and supported by accurate visible content. Test every product record and handle missing products with a proper 404.
```

## TASK 12 --- Build Technical Resources and Document Handling

``` text
Implement the technical resources library using the central document model.

Support TDS, SDS, COA, specifications and other approved document types. Each item must be linked to the correct product and include a meaningful title, revision/version and date where known.

Do not create fake download buttons. If a file is missing, unpublished or awaiting approval, do not expose it as a downloadable resource.

Serve private/customer-specific documents securely. Store sensitive files outside the public web root where possible. Validate upload MIME type, extension, size and content. Generate safe filenames, prevent path traversal and do not trust user-provided filenames.

Provide a technical enquiry route when a document is unavailable. Test public downloads, permission boundaries, missing-file states and mobile usability.
```

## TASK 13 --- Build Contact and RFQ Workflows

``` text
Build a reliable PHP contact and Request a Quote system.

Contact form:
- Name
- Email
- Phone where appropriate
- Message
- Privacy acknowledgement where appropriate

RFQ:
- One or multiple products
- Quantity and unit
- Grade/specification
- Packaging preference
- Destination
- Company/contact details
- Optional target date and attachment
- Additional requirements

Requirements:
- Product-specific forms prefill the selected product.
- Validate every field server-side.
- Escape output and use prepared statements.
- CSRF protection, anti-spam and rate limiting.
- Validate uploads by actual MIME, allowed extension, size and safe storage.
- Generate a unique enquiry reference.
- Store enquiry and enquiry items transactionally where supported.
- Send email using configured credentials only; never hardcode credentials.
- Log email failures safely and do not falsely claim successful email delivery.
- Show accessible success and error feedback.
- Prevent duplicate submissions where feasible.
- Protect enquiry data from public access.

Test valid submission, invalid fields, spam, duplicate submission, attachment rejection, database failure and mail failure.
```

## TASK 14 --- Build FAQs, Insights and Optional Industry Pages

``` text
Create reusable templates for FAQs, technical guides and industry/application pages, but publish only content that is useful and reviewed.

FAQ data should be centrally managed and optionally associated with a product/category. Implement accessible accordions that work with keyboard and touch. Add FAQ structured data only if current search-engine policies permit it and the markup reflects visible content.

For industry/application pages, require a clear relationship to real HB Metals products. Avoid thin, duplicated pages created solely for keywords. Technical claims must be reviewed and sourced. Link pages to relevant products and technical enquiries.

Add editorial metadata and canonical URLs. Do not generate fake authors, testimonials, case studies, customer names or performance claims.
```

## TASK 15 --- Implement Technical SEO and Redirects

``` text
Implement the SEO and URL migration requirements from HBMetals.md.

- Unique page titles and meta descriptions
- One clear H1 per page
- Canonical URLs
- Open Graph tags
- Breadcrumbs and structured data
- XML sitemap for published canonical indexable pages
- Appropriate robots.txt
- Human-readable HTML sitemap
- Approved 301 redirects for changed URLs
- 404 handling
- Image alt text and optimized assets
- Internal linking across products/categories/resources
- Noindex rules for appropriate utility/thank-you/search pages
- Correct status codes and trailing-slash behaviour

Use the content migration map. Do not redirect all old URLs to the homepage. Do not add fabricated prices, ratings, reviews, availability or certifications to structured data.

Validate sitemap URLs, canonical destinations, redirects, structured data and broken links. Report each issue and its resolution.
```

## TASK 16 --- Responsive QA, Accessibility and Motion QA

``` text
Run a full responsive and accessibility QA on all page templates and real product pages.

Test viewport widths: 320, 360, 375, 390, 430, 600, 768, 820, 1024, 1280, 1440 and 1920 pixels, plus intermediate widths.

Check:
- Horizontal overflow
- Overlapping text/images/cards
- Clipped headings/buttons
- Header/dropdown/mobile menu
- Forms, validation and keyboard focus
- Product images and aspect ratios
- Specification tables
- Long URLs/emails/chemical identifiers
- Footer layout
- Sticky/fixed elements
- Browser zoom and text scaling
- Reduced-motion mode
- Keyboard-only operation
- Contrast and labels
- Missing image/document links
- Console and PHP errors

Fix issues in shared components rather than adding one-off hacks. Do not declare success until every critical issue is fixed or explicitly documented as a blocker. Provide a QA matrix with viewport, page/template, issue, severity, fix and retest result.
```

## TASK 17 --- Performance, Security and Production Readiness

``` text
Conduct a production-readiness review of the PHP website.

Performance:
- Image formats/sizes and responsive sources
- LCP hero image handling
- Lazy loading below the fold
- Font loading
- CSS/JS size and blocking behaviour
- Cache/compression configuration where available
- Core Web Vitals measurement

Security:
- PHP errors hidden from public responses in production
- Safe output escaping
- PDO prepared statements
- CSRF and rate limiting
- Secure uploads
- Protected private storage
- Secrets in environment configuration
- Session/cookie security if sessions are used
- HTTPS and relevant security headers
- Correct file permissions
- No sensitive data in logs
- Backup/restore documentation

SEO:
- Sitemap and robots rules
- Canonicals and redirects
- Structured data validation
- Broken links and missing pages
- Search Console readiness

Run tests and document the tested environment. Do not invent scores or say tools passed unless they were run. Fix critical/high-severity defects before launch.
```

## TASK 18 --- Final Content Reconciliation and Launch Checklist

``` text
Compare the finished website against the source content inventory and HBMetals.md.

Verify:
- Every source product URL has an approved keep/update/redirect decision.
- All meaningful source content is preserved or intentionally restructured.
- Company phone/email/address are consistent across the site.
- The address/postal-code discrepancy is resolved by owner confirmation.
- Every product/category relationship is accurate.
- No invented company facts, product specs, certifications, testimonials, customer logos, pricing or capacity figures exist.
- All documents are real, approved and correctly linked.
- All forms and notifications work.
- All internal links, redirects and canonical URLs work.
- Mobile/tablet/desktop QA is complete.
- SEO, accessibility, performance and security checks are documented.
- README/setup/deployment/backup instructions are complete.

Produce a final report with completed tasks, changed files, tests actually run, unresolved owner approvals, remaining risks and deployment instructions. Do not claim the site is ready if critical issues remain.
```

------------------------------------------------------------------------

# 13. Additional Antigravity Rules for Every Task

Paste these rules into any task prompt if the IDE starts generating
inconsistent code:

``` text
GLOBAL PROJECT RULES:
- Follow HBMetals.md as the master specification.
- PHP is the required application language.
- Inspect before modifying; preserve working code and existing content.
- Use the shared design system and central data model.
- Build incrementally, not as one giant rewrite.
- Never invent company facts, technical specs, certificates, customers, reviews or stock.
- Do not use generated factory images as proof of actual facilities.
- Make every control functional and accessible.
- Responsive at all sizes; no overflow or overlap.
- Respect prefers-reduced-motion and performance budgets.
- Escape output, validate server-side, use PDO prepared statements and secure uploads.
- Keep secrets out of source control and private files out of public access.
- Preserve approved legacy URLs and map redirects carefully.
- Test each change and report the exact result.
- Do not silently delete pages, records, assets or source content.
```

------------------------------------------------------------------------

# 14. Final Acceptance Checklist

Before launch, mark each item only after it has actually been checked.

## Content and company data

-   [x] Existing website content inventoried.
-   [x] All current product URLs reviewed.
-   [x] Product names, categories and chemical distinctions confirmed.
-   [x] Contact phone and email confirmed.
-   [x] Official address and postal code confirmed.
-   [x] All claims about facilities, testing, quality and supply verified.
-   [x] No fabricated testimonials, customers, certifications or performance claims.
-   [x] Images and documents approved for their intended use.

## Design and responsive behaviour

-   [x] Design tokens centralized.
-   [x] Logo and palette reconciled.
-   [x] Shared PHP components used.
-   [x] Desktop, tablet and mobile layouts tested.
-   [x] No horizontal overflow or overlap at required widths.
-   [x] Forms, dropdowns, search and buttons work.
-   [x] Image crops preserve important subjects.
-   [x] Motion is subtle and reduced-motion support works.
-   [x] Keyboard focus and colour contrast are acceptable.

## PHP and data

-   [x] PHP version and environment documented.
-   [x] Database schema/migrations documented.
-   [x] Prepared statements used.
-   [x] Server-side validation and output escaping implemented.
-   [x] CSRF and spam controls implemented.
-   [x] Uploads are validated and privately stored as appropriate.
-   [x] Secrets are not committed.
-   [x] Production errors do not leak details.
-   [x] Enquiries can be stored and retrieved safely.

## SEO and performance

-   [x] Page titles/meta descriptions checked.
-   [x] Canonicals verified.
-   [x] Sitemap and robots rules verified.
-   [x] Redirect map tested.
-   [x] Structured data validated.
-   [x] Broken links and missing images checked.
-   [x] Image sizes and font loading optimized.
-   [x] Core Web Vitals measured using real tools.
-   [x] Analytics/conversion tracking verified if configured.

## Launch and maintenance

-   [x] Backup and restore plan tested.
-   [x] Deployment instructions written.
-   [x] Error logging and monitoring configured appropriately.
-   [x] Forms and email delivery tested in production-like environment.
-   [x] Unresolved approvals documented.
-   [x] Owner has reviewed the final website.

------------------------------------------------------------------------

# 15. The First Prompt to Run

Start with **Task 01 only**. Do not ask Antigravity to build all pages
immediately.

The correct sequence is:

**Repository audit → source content audit → sitemap and URL mapping →
data model → design system → shared layout → imagery/motion → homepage →
About/Capabilities → catalogue → product template → technical resources
→ RFQ → SEO → responsive/security QA → final launch review.**

This sequence reduces rework, keeps the website consistent, protects
existing content and makes the finished PHP website maintainable.
