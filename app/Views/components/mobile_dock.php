<?php
use App\Support\Helpers;
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
?>

<!-- iPhone iOS Bottom Navigation Dock (Mobile Only) -->
<nav class="ios-tab-bar" id="ios-mobile-dock" role="navigation" aria-label="Mobile Navigation Dock">
    <div class="ios-tab-container">
        <!-- 1. Home Tab -->
        <a href="<?= Helpers::url('/') ?>" class="ios-tab-item <?= $currentUri === '/' ? 'is-active' : '' ?>" aria-label="Home">
            <div class="ios-tab-icon-wrap">
                <svg viewBox="0 0 24 24" class="ios-tab-icon" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10.5L12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1v-9.5z" />
                </svg>
                <?php if ($currentUri === '/'): ?>
                    <span class="ios-active-dot"></span>
                <?php endif; ?>
            </div>
            <span class="ios-tab-label">Home</span>
        </a>

        <!-- 2. Products Tab -->
        <a href="<?= Helpers::url('/our-products/') ?>" class="ios-tab-item <?= (str_starts_with($currentUri, '/our-products') || str_starts_with($currentUri, '/product-category')) ? 'is-active' : '' ?>" aria-label="Products">
            <div class="ios-tab-icon-wrap">
                <svg viewBox="0 0 24 24" class="ios-tab-icon" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1.5" />
                    <rect x="14" y="3" width="7" height="7" rx="1.5" />
                    <rect x="14" y="14" width="7" height="7" rx="1.5" />
                    <rect x="3" y="14" width="7" height="7" rx="1.5" />
                </svg>
                <?php if (str_starts_with($currentUri, '/our-products') || str_starts_with($currentUri, '/product-category')): ?>
                    <span class="ios-active-dot"></span>
                <?php endif; ?>
            </div>
            <span class="ios-tab-label">Products</span>
        </a>

        <!-- 3. Center Action: Instant Quote RFQ -->
        <button type="button" class="ios-tab-item ios-tab-rfq" data-open-rfq aria-label="Request a Quotation">
            <div class="ios-rfq-pill">
                <svg viewBox="0 0 24 24" class="ios-rfq-icon" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                </svg>
            </div>
            <span class="ios-tab-label ios-rfq-label">Get Quote</span>
        </button>

        <!-- 4. About Us Tab -->
        <a href="<?= Helpers::url('/about-us/') ?>" class="ios-tab-item <?= str_starts_with($currentUri, '/about-us') ? 'is-active' : '' ?>" aria-label="About Us">
            <div class="ios-tab-icon-wrap">
                <svg viewBox="0 0 24 24" class="ios-tab-icon" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="16" x2="12" y2="12" />
                    <line x1="12" y1="8" x2="12.01" y2="8" />
                </svg>
                <?php if (str_starts_with($currentUri, '/about-us')): ?>
                    <span class="ios-active-dot"></span>
                <?php endif; ?>
            </div>
            <span class="ios-tab-label">About Us</span>
        </a>

        <!-- 5. More Menu Tab -->
        <button type="button" class="ios-tab-item" id="ios-more-trigger" aria-haspopup="dialog" aria-expanded="false" aria-label="More Menu">
            <div class="ios-tab-icon-wrap">
                <svg viewBox="0 0 24 24" class="ios-tab-icon" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5" cy="12" r="2" />
                    <circle cx="12" cy="12" r="2" />
                    <circle cx="19" cy="12" r="2" />
                </svg>
            </div>
            <span class="ios-tab-label">More</span>
        </button>
    </div>
</nav>

<!-- iPhone iOS Slide-Up Action Sheet ("More" Menu) -->
<div class="ios-sheet-backdrop" id="ios-sheet-backdrop" aria-hidden="true">
    <div class="ios-sheet-panel" id="ios-sheet-panel" role="dialog" aria-modal="true" aria-labelledby="ios-sheet-title">
        <!-- iOS Drag Grabber Bar -->
        <div class="ios-sheet-grabber-wrap" id="ios-sheet-grabber">
            <span class="ios-sheet-grabber"></span>
        </div>

        <div class="ios-sheet-header">
            <div>
                <h3 id="ios-sheet-title" class="ios-sheet-title">HB Metals Menu</h3>
                <p class="ios-sheet-subtitle">All sections &amp; direct factory contacts</p>
            </div>
            <button type="button" class="ios-sheet-close-btn" id="ios-sheet-close" aria-label="Close Menu">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <!-- iPhone App Icons Grid -->
        <div class="ios-app-grid">
            <!-- 1. Capabilities -->
            <a href="<?= Helpers::url('/capabilities/') ?>" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-blue-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                    </svg>
                </div>
                <span class="ios-app-title">Capabilities</span>
            </a>

            <!-- 2. Quality Control -->
            <a href="<?= Helpers::url('/quality/') ?>" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-emerald-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        <polyline points="9 12 11 14 15 10" />
                    </svg>
                </div>
                <span class="ios-app-title">Quality Lab</span>
            </a>

            <!-- 3. Technical Resources -->
            <a href="<?= Helpers::url('/technical-resources/') ?>" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-purple-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                    </svg>
                </div>
                <span class="ios-app-title">Technical</span>
            </a>

            <!-- 4. Commercial FAQs -->
            <a href="<?= Helpers::url('/faq/') ?>" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-amber-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        <circle cx="12" cy="10" r="0.5" fill="currentColor" stroke="none" />
                        <path d="M12 7a2 2 0 0 1 2 2c0 1.2-1.5 1.5-1.5 2.5" />
                    </svg>
                </div>
                <span class="ios-app-title">FAQs</span>
            </a>

            <!-- 5. Contact Works -->
            <a href="<?= Helpers::url('/contact-us/') ?>" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-teal-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                </div>
                <span class="ios-app-title">Contact</span>
            </a>

            <!-- 6. Direct Phone Call -->
            <a href="tel:<?= Helpers::e($settings['phone'] ?? '9898449394') ?>" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-green-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                </div>
                <span class="ios-app-title">Call Works</span>
            </a>

            <!-- 7. Direct WhatsApp -->
            <a href="https://wa.me/91<?= Helpers::e($settings['phone'] ?? '9898449394') ?>?text=Hello%20HB%20Metals,%20I%20would%20like%20to%20inquire%20about%20your%20products" target="_blank" rel="noopener noreferrer" class="ios-app-icon-item">
                <div class="ios-app-squircle bg-whatsapp-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </div>
                <span class="ios-app-title">WhatsApp</span>
            </a>

            <!-- 8. Request a Quote -->
            <button type="button" class="ios-app-icon-item" data-open-rfq>
                <div class="ios-app-squircle bg-orange-grad">
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                    </svg>
                </div>
                <span class="ios-app-title">RFQ Modal</span>
            </button>
        </div>

        <!-- Direct Contact Footer Banner -->
        <div class="ios-sheet-footer-info">
            <div class="ios-sheet-info-pill">
                <span>📍</span>
                <span>Works: Shapar, Rajkot · <?= Helpers::e($settings['phone_display'] ?? '+91 98984 49394') ?></span>
            </div>
        </div>
    </div>
</div>
