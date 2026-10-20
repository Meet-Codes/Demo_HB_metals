# HB Metals India - Quality Assurance & Verification Report (Tasks 16 & 17)

## 1. Responsive Viewport Testing Matrix

| Viewport Width | Device Category | Horizontal Overflow? | Layout Hierarchy & Behavior | Status |
| :--- | :--- | :--- | :--- | :--- |
| **320px** | Ultra-compact phone (iPhone SE 1st gen) | None (0px) | Single column layout, brand scales gracefully, 44px tap targets | **PASSED** |
| **360px** | Standard Android (Galaxy S8) | None (0px) | Clean stacking, readable technical tables in responsive container | **PASSED** |
| **375px** | iPhone Mini / iPhone X | None (0px) | Balanced typography, comfortable touch targets, modal fits viewport | **PASSED** |
| **390px** | iPhone 14 / 15 / 16 | None (0px) | Fluid clamp() typography scales naturally, buttons full width | **PASSED** |
| **430px** | iPhone Pro Max / Plus | None (0px) | Excellent whitespace, readable specification parameters | **PASSED** |
| **600px** | Small Tablet / Phablet | None (0px) | Grids begin shifting to 2 columns, forms remain well-padded | **PASSED** |
| **768px** | iPad Portrait | None (0px) | 2-column product and category cards, clear navigation toggle | **PASSED** |
| **820px** | iPad Air | None (0px) | Balanced hero section, well-aligned fast facts | **PASSED** |
| **1024px** | iPad Landscape / Small Laptop | None (0px) | Full desktop navigation activates, 3-column category grid | **PASSED** |
| **1280px** | Standard Laptop | None (0px) | 4-column product grid, sticky header with backdrop blur | **PASSED** |
| **1440px** | Desktop Display | None (0px) | Contained to 1280px max-width, balanced margins, cinematic hero | **PASSED** |
| **1920px** | Full HD Ultrawide | None (0px) | Centered layout, no awkward element stretching or clipping | **PASSED** |

## 2. Accessibility & A11y Verification
- **Semantic Landmarks:** `<header role="banner">`, `<nav role="navigation">`, `<main id="main-content" role="main">`, `<footer role="contentinfo">`.
- **Skip Link:** Accessible `.skip-link` immediately jumps keyboard focus to `#main-content`.
- **Keyboard Navigation:** Dropdown menus and modal close with `Escape` key; all interactive controls use semantic `<button>` or `<a>` with visible `:focus-visible` ring (`--color-focus: #1D70D6`).
- **Color Contrast:** Deep ink text (`#142633`) on paper (`#F7F8F8`) exceeds WCAG AAA ratio (14.2:1); copper CTA (`#B86D3C`) exceeds AA standards for large/medium UI elements.
- **Reduced Motion:** Fully integrated `@media (prefers-reduced-motion: reduce)` zeroes out animations, scroll reveals, and transitions.

## 3. Security Hardening
- **Output Escaping:** All user-supplied and dynamic values escaped via `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.
- **SQL Injection Prevention:** 100% of queries use PDO prepared statements with parameterized inputs.
- **CSRF Protection:** Synchronizer token pattern with `Csrf::token()` and strict session hash checking on all POST endpoints.
- **Spam Prevention:** Honeypot field (`website_url_hp`) detects automated bots with zero friction for real users.
- **Private Storage:** File uploads are validated for extension and MIME type and stored in `storage/private-uploads/` outside the public web root.
- **HTTP Security Headers:** `X-Content-Type-Options: nosniff`, `X-Frame-Options: SAMEORIGIN`, `X-XSS-Protection: 1; mode=block`, and `Referrer-Policy: strict-origin-when-cross-origin`.
