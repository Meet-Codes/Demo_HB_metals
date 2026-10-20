<?php
use App\Support\Helpers;
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D SITEMAP // COMPLETE PORTFOLIO HIERARCHY]" style="color: var(--color-white); padding: var(--space-16) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%);">
    <div class="container" style="position: relative; z-index: 2;">
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(184, 109, 60, 0.4); background: rgba(184, 109, 60, 0.15); color: #e59f71;">Directory Index</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">HTML <span class="metallic-shimmer">Sitemap</span></span>
        </h1>
        <p style="color: #b5c8d5; max-width: 680px; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            A complete human-readable navigation index of all published pages, product categories, and individual material specifications on HB Metals India.
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: var(--color-paper);">
    <div class="container">
        <div class="grid-3" style="gap: var(--space-8);">
            <!-- Col 1: Main Pages -->
            <div class="glass-card reveal-on-scroll" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm);">
                <h2 style="font-size: 1.25rem; color: var(--color-navy); font-weight: 700; margin-bottom: var(--space-4); border-bottom: 2px solid var(--color-copper); padding-bottom: var(--space-2);">Corporate &amp; Services</h2>
                <ul style="display: flex; flex-direction: column; gap: var(--space-3); font-size: var(--text-small); padding: 0; list-style: none; margin: 0;">
                    <li><a href="<?= Helpers::url('/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Homepage</a></li>
                    <li><a href="<?= Helpers::url('/about-us/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">About Us</a></li>
                    <li><a href="<?= Helpers::url('/our-products/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Product Catalogue</a></li>
                    <li><a href="<?= Helpers::url('/capabilities/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Capabilities &amp; Processing</a></li>
                    <li><a href="<?= Helpers::url('/quality/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Quality Control &amp; Standards</a></li>
                    <li><a href="<?= Helpers::url('/technical-resources/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Technical Resources &amp; TDS</a></li>
                    <li><a href="<?= Helpers::url('/faq/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Commercial FAQs</a></li>
                    <li><a href="<?= Helpers::url('/contact-us/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Contact Us</a></li>
                    <li><a href="<?= Helpers::url('/request-a-quote/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Request a Commercial Quote</a></li>
                    <li><a href="<?= Helpers::url('/privacy-policy/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Privacy Policy</a></li>
                    <li><a href="<?= Helpers::url('/terms-and-conditions/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">Terms &amp; Conditions</a></li>
                </ul>
            </div>

            <!-- Col 2: Product Categories -->
            <div class="glass-card reveal-on-scroll delay-1" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm);">
                <h2 style="font-size: 1.25rem; color: var(--color-navy); font-weight: 700; margin-bottom: var(--space-4); border-bottom: 2px solid var(--color-copper); padding-bottom: var(--space-2);">Product Families</h2>
                <ul style="display: flex; flex-direction: column; gap: var(--space-3); font-size: var(--text-small); padding: 0; list-style: none; margin: 0;">
                    <?php foreach ($categories as $cat): ?>
                        <li>
                            <a href="<?= Helpers::url('/product-category/' . $cat['slug'] . '/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">
                                <?= Helpers::e($cat['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Col 3: Products -->
            <div class="glass-card reveal-on-scroll delay-2" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm);">
                <h2 style="font-size: 1.25rem; color: var(--color-navy); font-weight: 700; margin-bottom: var(--space-4); border-bottom: 2px solid var(--color-copper); padding-bottom: var(--space-2);">Verified Chemical Catalog</h2>
                <ul style="display: flex; flex-direction: column; gap: var(--space-3); font-size: var(--text-small); padding: 0; list-style: none; margin: 0;">
                    <?php foreach ($products as $prod): ?>
                        <li>
                            <a href="<?= Helpers::url('/' . $prod['slug'] . '/') ?>" style="color: var(--color-ink); text-decoration: none; font-weight: 500;">
                                <?= Helpers::e($prod['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
