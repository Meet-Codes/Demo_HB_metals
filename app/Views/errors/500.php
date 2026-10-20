<?php
use App\Support\Helpers;
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D PROTOCOL 500 // SERVER ANOMALY]" style="color: var(--color-white); padding: var(--space-20) 0; text-align: center; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%); min-height: 60vh; display: flex; align-items: center;">
    <div class="container" style="max-width: 680px; position: relative; z-index: 2;">
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(198, 40, 40, 0.4); background: rgba(198, 40, 40, 0.15); color: #ef9a9a; font-family: var(--font-mono);">HTTP Error 500</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); font-size: clamp(2.5rem, 5vw, 3.5rem); margin-bottom: var(--space-4); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">Internal Server <span class="metallic-shimmer">Incident</span></span>
        </h1>
        <p style="color: #b5c8d5; font-size: var(--text-body-lg); line-height: 1.6; margin-bottom: var(--space-8);">
            A server incident occurred while processing your request. Our technical staff has logged the event. Please try refreshing or reach out to our commercial desk directly.
        </p>
        <div style="display: flex; justify-content: center; gap: var(--space-4); flex-wrap: wrap;">
            <a href="<?= Helpers::url('/') ?>" class="btn btn-primary btn-lg">Return to Homepage</a>
            <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-outline-white btn-lg">Contact Sales Desk</a>
        </div>
    </div>
</div>
