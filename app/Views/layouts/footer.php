<?php
use App\Support\Helpers;
?>

<footer class="site-footer dithered-site-footer" role="contentinfo" style="--df-accent: #ea580c;">
    <div class="container">
        <!-- Main Footer Navigation & Brand Row -->
        <div class="footer-grid">
            <!-- Col 1: Brand & Newsletter Subscription -->
            <div class="footer-col brand-col">
                <div class="site-brand" style="margin-bottom:var(--space-4);">
                    <a href="<?= Helpers::url('/') ?>" aria-label="HB Metals Home">
                        <img src="<?= Helpers::asset('/assets/images/logo.png') ?>" alt="HB Metals India" class="brand-logo" width="160" height="49">
                    </a>
                </div>
                <p class="footer-tagline">
                    Manufacturers &amp; Exporters of Magnesium Metal Powder, Sodium Tungstate, and Precision Metallic Salts since 2013.
                </p>

                <!-- Newsletter Subscription Form -->
                <form class="df-subscribe-form" id="footer-subscribe-form" onsubmit="handleFooterSubscribe(event)">
                    <label for="df-email" class="df-subscribe-label">Get product specifications &amp; technical updates</label>
                    <div class="df-input-group">
                        <input
                            id="df-email"
                            type="email"
                            required
                            placeholder="Enter your work email"
                            class="df-input"
                        />
                        <button type="submit" class="df-btn-submit" id="df-btn-submit">
                            Subscribe
                        </button>
                    </div>
                    <p id="df-status-msg" class="df-status-msg" aria-live="polite"></p>
                </form>
            </div>

            <!-- Col 2: Navigation -->
            <div class="footer-col">
                <h4>Navigation</h4>
                <div class="footer-links">
                    <a href="<?= Helpers::url('/') ?>">Home</a>
                    <a href="<?= Helpers::url('/about-us/') ?>">About Us</a>
                    <a href="<?= Helpers::url('/our-products/') ?>">Product Catalogue</a>
                    <a href="<?= Helpers::url('/capabilities/') ?>">Capabilities</a>
                    <a href="<?= Helpers::url('/quality/') ?>">Quality Control</a>
                    <a href="<?= Helpers::url('/technical-resources/') ?>">Technical Resources</a>
                    <a href="<?= Helpers::url('/faq/') ?>">Commercial FAQs</a>
                    <a href="<?= Helpers::url('/contact-us/') ?>">Contact Us</a>
                </div>
            </div>

            <!-- Col 3: Core Products -->
            <div class="footer-col">
                <h4>Product Families</h4>
                <div class="footer-links">
                    <a href="<?= Helpers::url('/magnesium-metal-powder/') ?>">Magnesium Metal Powder</a>
                    <a href="<?= Helpers::url('/magnesium-metal-turning/') ?>">Magnesium Metal Turning</a>
                    <a href="<?= Helpers::url('/sodium-tungstate/') ?>">Sodium Tungstate</a>
                    <a href="<?= Helpers::url('/tungsten-trioxide-powder/') ?>">Tungsten Trioxide Powder</a>
                    <a href="<?= Helpers::url('/tungstic-acid/') ?>">Tungstic Acid</a>
                    <a href="<?= Helpers::url('/cobalt-oxide/') ?>">Cobalt Oxide</a>
                    <a href="<?= Helpers::url('/cobalt-acetate/') ?>">Cobalt Acetate</a>
                    <a href="<?= Helpers::url('/ammonium-paratungstate/') ?>">Ammonium Paratungstate</a>
                </div>
            </div>

            <!-- Col 4: Contact & Facilities -->
            <div class="footer-col">
                <h4>Works &amp; Facilities</h4>
                <div class="footer-contact-list">
                    <div class="footer-contact-item">
                        <span>📞</span>
                        <div>
                            <a href="tel:<?= Helpers::e($settings['phone']) ?>" style="color:#ffffff; font-weight:700;"><?= Helpers::e($settings['phone_display']) ?></a>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <span>✉️</span>
                        <div>
                            <a href="mailto:<?= Helpers::e($settings['email']) ?>" style="color:#ffffff;"><?= Helpers::e($settings['email']) ?></a>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <span>📍</span>
                        <div>
                            <strong>Works Address:</strong><br>
                            <?= Helpers::e($settings['address_line_1']) ?>,<br>
                            <?= Helpers::e($settings['address_line_2']) ?>,<br>
                            <?= Helpers::e($settings['city']) ?> - <?= Helpers::e($settings['postal_code']) ?>, <?= Helpers::e($settings['state']) ?>, India.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dithered Noise Band with Floating Giant Wordmark -->
    <div aria-hidden="true" class="df-band" id="footer-df-band">
        <div class="df-field" id="footer-df-field">
            <div class="df-dots"></div>
        </div>
        <p class="df-mark">HB METALS</p>
    </div>

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-left">
                <span>&copy; <?= date('Y') ?> <strong>HB Metals India</strong>. All Rights Reserved.</span>
                <span class="footer-divider-dot">•</span>
                <a href="<?= Helpers::url('/capabilities/') ?>" class="df-status-badge">
                    <span class="df-status-dot" aria-hidden="true"></span>
                    Manufacturing Facility Active · Rajkot
                </a>
            </div>

            <div class="footer-legal-links">
                <a href="<?= Helpers::url('/privacy-policy/') ?>">Privacy Policy</a>
                <a href="<?= Helpers::url('/terms-and-conditions/') ?>">Terms &amp; Conditions</a>
                <a href="<?= Helpers::url('/sitemap/') ?>">HTML Sitemap</a>
                <button type="button" class="df-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" aria-label="Back to top">
                    Back to top
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true"><path d="M12 19V5m-6 6 6-6 6 6" /></svg>
                </button>
            </div>
        </div>
    </div>
</footer>
