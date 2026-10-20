<?php
use App\Support\Helpers;
?>

<!-- Hero Header -->
<div class="section-3d-hud is-dark" data-3d-hud="[3D SPATIAL ORIGIN // FOUNDATION 2013 // RAJKOT HUB]">
    <div class="container" data-reveal="left">
        <span class="badge badge-copper" style="margin-bottom: var(--space-3);">Corporate Background</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-4);">
            <span class="split-mask-inner">About <span class="metallic-shimmer">HB Metals India</span></span>
        </h1>
        <p style="color: #b8cad6; max-width: 680px; font-size: var(--text-body-lg); margin: 0; line-height: 1.65;">
            Established in 2013 in Rajkot, Gujarat, we process, manufacture, and supply an excellent quality range of Tungsten Oxide, Tungsten Powder, Magnesium Metal Powder, and Ammonium Paratungstate for demanding global industries.
        </p>
    </div>
</div>

<!-- Main Editorial Content -->
<section class="section-3d-hud" data-3d-hud="[3D PRECISION ARCHIVE // PURITY & DENSITY BENCHMARKS]" style="padding: var(--space-20) 0;">
    <div class="container">
        <div class="grid-2" style="align-items: flex-start; gap: var(--space-12);">
            <!-- Narrative Column (Reveal from Left) -->
            <div data-reveal="left">
                <span class="badge badge-navy" style="margin-bottom: var(--space-3);">Who We Are</span>
                <h2 class="split-mask-wrap" style="margin-bottom: var(--space-4);">
                    <span class="split-mask-inner">Dedicated to Chemical <span class="metallic-shimmer">Precision &amp; Purity</span></span>
                </h2>
                <p>
                    Established in the year 2013, in Rajkot (Gujarat, India), <strong>HB Metals</strong> operates as a specialized manufacturer and supplier of Tungsten Oxide, Tungsten Powder, Metal Powder, and Ammonium Paratungstate. Under the experienced leadership of <strong>Mr. Anil Patel (Managing Director)</strong>, the organization has consistently prioritized technical precision, strict quality control, and ethical business conduct.
                </p>
                <p>
                    The offered chemical compounds and metal powders are processed using modern technology and high-grade raw metals in accordance with established industry benchmarks. Our products are recognized for their high melting points, chemical purity, high bulk density, prolonged shelf stability, and moisture-proof packaging.
                </p>
                <p>
                    With the support of our skilled team of professionals, we provide these products in diverse packaging options tailored to specific industrial requirements, working in close coordination with buyers to meet their exact specifications within scheduled timeframes.
                </p>

                <!-- Value Highlights (Staggered) -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4); margin-top: var(--space-8);">
                    <div class="glass-card" style="padding: var(--space-5);" data-reveal="bottom">
                        <div style="color: var(--color-copper); font-size: 1.5rem; margin-bottom: var(--space-2);">🎯</div>
                        <h4 style="font-size: 1rem; margin-bottom: 4px; color: var(--color-ink);">Customer Centric</h4>
                        <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0;">Direct commercial alignment and transparent communication for technical requirements.</p>
                    </div>
                    <div class="glass-card" style="padding: var(--space-5);" data-reveal="bottom" style="transition-delay: 150ms;">
                        <div style="color: var(--color-copper); font-size: 1.5rem; margin-bottom: var(--space-2);">🔬</div>
                        <h4 style="font-size: 1rem; margin-bottom: 4px; color: var(--color-ink);">Quality Tested</h4>
                        <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0;">Rigorous batch inspection covering purity assays, density, and mesh sizing.</p>
                    </div>
                </div>
            </div>

            <!-- Verified Company Facts Specification Table -->
            <div class="glass-card" style="padding: var(--space-8); background: var(--color-white); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--color-line);">
                <span class="badge badge-copper" style="margin-bottom: var(--space-3);">Company Ledger</span>
                <h3 style="margin-bottom: var(--space-4); font-size: 1.35rem; color: var(--color-navy); font-weight: 700;">Company Profile &amp; Key Facts</h3>
                <div class="table-responsive" style="border:none; box-shadow:none;">
                    <table class="spec-table" aria-label="Company Key Facts">
                        <tbody>
                            <tr>
                                <th scope="row">Legal Name</th>
                                <td>HB Metals / HB Metals India</td>
                            </tr>
                            <tr>
                                <th scope="row">Year of Establishment</th>
                                <td><span class="font-mono font-bold" style="color: var(--color-copper);">2013</span></td>
                            </tr>
                            <tr>
                                <th scope="row">Managing Director</th>
                                <td><strong>Mr. Anil Patel</strong></td>
                            </tr>
                            <tr>
                                <th scope="row">Primary Location</th>
                                <td>Shapar (Veraval), Rajkot, Gujarat, India</td>
                            </tr>
                            <tr>
                                <th scope="row">Core Product Families</th>
                                <td>Magnesium Metal Powder, Magnesium Turnings, Sodium Tungstate, Tungsten Trioxide, Cobalt Oxide, Cobalt Acetate</td>
                            </tr>
                            <tr>
                                <th scope="row">Standard MOQ</th>
                                <td><span class="cas-tag">25 Kilogram</span></td>
                            </tr>
                            <tr>
                                <th scope="row">Facility Type</th>
                                <td>Manufacturing Plant, Processing Lines &amp; Quality Inspection Lab</td>
                            </tr>
                            <tr>
                                <th scope="row">Shipment Terms</th>
                                <td>Ex-Works, FOB, CIF (via Mundra / Kandla Ports)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: var(--space-6); padding-top: var(--space-5); border-top: 1px solid var(--color-line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: var(--space-3);">
                    <span style="font-size: var(--text-small); color: var(--color-steel);">Require formal verification or specs?</span>
                    <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-primary btn-sm">Contact Managing Office</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline / Milestones -->
<section class="section-light">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto var(--space-12);">
            <span class="badge badge-copper" style="margin-bottom: var(--space-2);">Growth &amp; Milestones</span>
            <h2 style="font-size: clamp(1.85rem, 3.2vw, 2.5rem); font-weight: 800; color: var(--color-navy); margin: 0 0 var(--space-3);">Our Manufacturing <span class="metallic-shimmer">Journey</span></h2>
            <p style="color: var(--color-steel); font-size: 1.05rem;">From our inception in 2013 to our current multi-product manufacturing capacity in Shapar, Rajkot.</p>
        </div>

        <div class="grid-3" style="gap: var(--space-8);">
            <div class="glass-card" style="padding: var(--space-8); background: var(--color-white); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--color-line);">
                <div style="font-family: var(--font-heading); font-size: 2rem; font-weight: 800; color: var(--color-copper); margin-bottom: var(--space-2);">2013</div>
                <h3 style="font-size: 1.15rem; margin-bottom: var(--space-2); color: var(--color-navy); font-weight: 700;">Foundation in Rajkot</h3>
                <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0; line-height: 1.6;">
                    Established by Mr. Anil Patel with dedicated processing lines for Magnesium Metal Powder and Magnesium Turnings in the Shapar industrial cluster.
                </p>
            </div>

            <div class="glass-card" style="padding: var(--space-8); background: var(--color-white); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--color-line);">
                <div style="font-family: var(--font-heading); font-size: 2rem; font-weight: 800; color: var(--color-copper); margin-bottom: var(--space-2);">2017</div>
                <h3 style="font-size: 1.15rem; margin-bottom: var(--space-2); color: var(--color-navy); font-weight: 700;">Tungsten &amp; Salts Expansion</h3>
                <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0; line-height: 1.6;">
                    Commissioned chemical synthesis reactors for Sodium Tungstate, Tungsten Trioxide (WO3), and Ammonium Paratungstate (APT), serving metallurgy and catalysis sectors.
                </p>
            </div>

            <div class="glass-card" style="padding: var(--space-8); background: var(--color-white); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--color-line);">
                <div style="font-family: var(--font-heading); font-size: 2rem; font-weight: 800; color: var(--color-copper); margin-bottom: var(--space-2);">2023+</div>
                <h3 style="font-size: 1.15rem; margin-bottom: var(--space-2); color: var(--color-navy); font-weight: 700;">Modern QA &amp; Global Supply</h3>
                <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0; line-height: 1.6;">
                    Implemented enhanced moisture-barrier packaging, batch-specific COA protocols, and containerized dispatch coordination for domestic and international buyers.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section-3d-hud is-dark" data-3d-hud="[3D B2B ALLIANCE // COMMERCIAL ENGAGEMENT]" style="text-align: center;">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;" data-reveal="zoom-3d">
            <h2 style="color: var(--color-white); margin-bottom: var(--space-3);">Partner With HB Metals India</h2>
            <p style="color: #b8cad6; margin-bottom: var(--space-6); font-size: var(--text-body-lg);">
                Connect directly with our commercial team in Rajkot for custom mesh grading, technical data sheets, and price quotations.
            </p>
            <div style="display: flex; justify-content: center; gap: var(--space-4); flex-wrap: wrap;">
                <a href="<?= Helpers::url('/request-a-quote/') ?>" class="btn btn-primary btn-lg" data-open-rfq>Request a Quote</a>
                <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-outline-white btn-lg">Browse Catalogue</a>
            </div>
        </div>
    </div>
</section>
