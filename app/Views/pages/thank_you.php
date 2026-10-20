<?php
use App\Support\Helpers;
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D TRANSACTION CONFIRMATION // INGESTION COMPLETE]" style="color: var(--color-white); padding: var(--space-16) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%); text-align: center;">
    <div class="container" style="max-width: 720px; position: relative; z-index: 2;">
        <div style="width: 64px; height: 64px; border-radius: 50%; background: #2e7d32; color: var(--color-white); display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto var(--space-4); box-shadow: 0 0 30px rgba(46, 125, 50, 0.5); border: 2px solid rgba(255, 255, 255, 0.2);">✓</div>
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(46, 125, 50, 0.4); background: rgba(46, 125, 50, 0.2); color: #81c784;">Dispatch Desk Acknowledged</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">Enquiry <span class="metallic-shimmer">Successfully Received</span></span>
        </h1>
        <p style="color: #b5c8d5; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            Thank you for contacting HB Metals India. Your commercial inquiry has been logged in our sales registry.
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: var(--color-paper);">
    <div class="container" style="max-width: 700px;">
        <div class="glass-card reveal-on-scroll" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--space-8); box-shadow: var(--shadow-md); text-align: center;">
            <span class="glass-pill" style="margin-bottom: var(--space-2); background: rgba(184, 109, 60, 0.1); color: var(--color-copper); font-weight: 700;">Reference Tracking Code</span>
            <div style="font-size: 2rem; font-weight: 800; font-family: var(--font-mono); color: var(--color-navy); letter-spacing: 0.05em; margin: var(--space-2) 0 var(--space-4);">
                <?= Helpers::e($reference) ?>
            </div>

            <p style="color: var(--color-steel); font-size: var(--text-body); margin-bottom: var(--space-6); line-height: 1.6;">
                Please save this reference code for your records. A representative from our Rajkot commercial desk will review your specifications and contact you shortly with formal pricing and schedule details.
            </p>

            <div style="background: var(--color-paper); border-radius: var(--radius-md); padding: var(--space-5); margin-bottom: var(--space-8); font-size: var(--text-small); text-align: left; border: 1px solid var(--color-line);">
                <div style="font-weight: 700; color: var(--color-navy); margin-bottom: var(--space-3); font-size: var(--text-body);">What Happens Next?</div>
                <ol style="margin-left: var(--space-4); color: var(--color-ink); display: flex; flex-direction: column; gap: var(--space-2); line-height: 1.5;">
                    <li>Our technical team verifies raw material inventory and target purity parameters.</li>
                    <li>A formal commercial quotation with MOQ and shipping lead times is generated.</li>
                    <li>You will receive an official email confirmation and/or call from Managing Director Mr. Anil Patel or sales desk.</li>
                </ol>
            </div>

            <div style="display: flex; justify-content: center; gap: var(--space-4); flex-wrap: wrap;">
                <a href="<?= Helpers::url('/') ?>" class="btn btn-primary">Return to Homepage</a>
                <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-outline">Explore Product Catalogue</a>
            </div>
        </div>
    </div>
</section>
