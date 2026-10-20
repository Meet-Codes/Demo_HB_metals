<?php
use App\Support\Helpers;
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D KNOWLEDGE BASE // SPECIFICATIONS & PROTOCOLS]" style="color: var(--color-white); padding: var(--space-16) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%);">
    <div class="container" data-reveal="left" style="position: relative; z-index: 2;">
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(184, 109, 60, 0.4); background: rgba(184, 109, 60, 0.15); color: #e59f71;">Commercial &amp; Technical Support</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">Frequently Asked <span class="metallic-shimmer">Questions (FAQs)</span></span>
        </h1>
        <p style="color: #b5c8d5; max-width: 680px; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            Review answers to frequently asked commercial, technical, and logistics questions concerning HB Metals operations and chemical supplies.
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: transparent;">
    <div class="container">
        <div class="faq-two-col">
            <!-- Left Column: Image (Reveal from Left) -->
            <div data-reveal="left" class="faq-image-wrap glass-card" style="padding: 0; overflow: hidden; border-radius: var(--radius-lg); background: var(--color-white); box-shadow: var(--shadow-sm);">
                <img
                    src="<?= Helpers::asset('/assets/images/hero/slide-lab.jpg') ?>"
                    alt="HB Metals Laboratory & Testing"
                    class="faq-image"
                    style="width: 100%; height: 100%; object-fit: cover; display: block;"
                    width="420"
                    height="350"
                >
            </div>

            <!-- Right Column: FAQs (Reveal from Right) -->
            <div data-reveal="right" class="faq-content-wrap">
                <span class="glass-pill" style="margin-bottom: var(--space-2); background: rgba(28, 52, 69, 0.08); color: var(--color-navy);">Verified Technical Intelligence</span>
                <h2 style="font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 800; color: var(--color-navy); margin-bottom: var(--space-3); letter-spacing: -0.01em;">
                    Frequently Answered Inquiries
                </h2>
                <p style="color: var(--color-steel); font-size: var(--text-body); line-height: 1.6; margin-bottom: var(--space-6);">
                    Comprehensive verified answers regarding our Minimum Order Quantities (MOQ), packaging drums, Certificates of Analysis (COA), and dispatch schedules.
                </p>

                <div class="accordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="accordion-item glass-card <?= $index === 0 ? 'is-open' : '' ?>" style="margin-bottom: var(--space-3); border-radius: var(--radius-md); background: var(--color-white); padding: 0; overflow: hidden;">
                            <button type="button" class="accordion-trigger" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>">
                                <span style="font-weight: 700; color: var(--color-navy);"><?= Helpers::e($faq['question']) ?></span>
                                <svg class="accordion-chevron" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="accordion-body">
                                <p style="color: var(--color-ink); line-height: 1.65; margin: 0;"><?= Helpers::e($faq['answer']) ?></p>
                                <?php if (!empty($faq['category'])): ?>
                                    <span class="glass-pill" style="margin-top: var(--space-3); background: rgba(28, 52, 69, 0.08); color: var(--color-navy); font-size: 0.72rem;"><?= Helpers::e($faq['category']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="glass-card" style="background: var(--color-white); border-radius: var(--radius-md); padding: var(--space-6); margin-top: var(--space-8); box-shadow: var(--shadow-sm); border-left: 4px solid var(--color-copper);">
                    <h3 style="margin-bottom: var(--space-2); font-size: 1.15rem; color: var(--color-navy); font-weight: 700;">Still Have an Unlisted Inquiry?</h3>
                    <p style="font-size: var(--text-small); color: var(--color-steel); margin-bottom: var(--space-4); line-height: 1.6;">
                        Contact our Shapar plant or sales desk directly. Managing Director Mr. Anil Patel and our technical support desk will provide rapid clarification.
                    </p>
                    <div style="display: flex; gap: var(--space-3); flex-wrap: wrap;">
                        <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-outline btn-sm">Send a Message</a>
                        <a href="tel:<?= Helpers::e($settings['phone']) ?>" class="btn btn-primary btn-sm">Call <?= Helpers::e($settings['phone_display']) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
