<?php
use App\Support\Helpers;
?>

<!-- =========================================================================
     Section 1: Cinematic Hero with WebGL Noise-Morph Slider
     ========================================================================= -->
<section class="hero-section section-3d-hud" id="hero-slider-section" data-3d-hud="[3D SPATIAL CONTINUUM // SEC 01 // INDUCTION VORTEX]">
    <!-- WebGL Morph Canvas & Dark Industrial Overlays -->
    <div class="hero-bg-morph" id="hero-morph-gallery" aria-hidden="true">
        <canvas class="hero-morph-canvas" width="1920" height="1080"></canvas>
        <div class="hero-bg-overlay"></div>
        <script type="application/json" data-slides-json>
            <?= json_encode([
                [
                    'src' => Helpers::asset('/assets/images/hero/slide-machinery.jpg'),
                    'alt' => 'High-Speed Automatic Machinery - Precision Grinding & Milling'
                ],
                [
                    'src' => Helpers::asset('/assets/images/hero/slide-packaging.jpg'),
                    'alt' => 'Moisture-Proof Barrier Packaging - Heavy-Duty Drums with Dual Polythene Liners'
                ],
                [
                    'src' => Helpers::asset('/assets/images/hero/slide-lab.jpg'),
                    'alt' => 'Lot-Specific Certificate of Analysis (COA) - Laboratory Testing'
                ]
            ], JSON_UNESCAPED_SLASHES) ?>
        </script>

        <!-- Slider Navigation Controls -->
        <div class="hero-morph-controls">
            <button type="button" class="hero-morph-arrow is-prev" aria-label="Previous Slide">‹</button>
            <div class="hero-morph-dots">
                <button type="button" class="hero-morph-dot is-active" data-index="0" aria-label="Go to Slide 1" aria-current="true"></button>
                <button type="button" class="hero-morph-dot" data-index="1" aria-label="Go to Slide 2"></button>
                <button type="button" class="hero-morph-dot" data-index="2" aria-label="Go to Slide 3"></button>
            </div>
            <button type="button" class="hero-morph-arrow is-next" aria-label="Next Slide">›</button>
        </div>
    </div>

    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    <span>Precision Metallurgy &amp; Chemical Synthesis</span>
                </div>

                <h1 class="hero-title">
                    Precision <span class="metallic-shimmer">Metal Powders</span><br>
                    &amp; Tungsten Compounds
                </h1>

                <!-- Hero Slogan Banner -->
                <div class="hero-slogan-wrap">
                    <div class="hero-slogan-pill">
                        <span class="hero-slogan-dot"></span>
                        <span class="hero-slogan-text">“Engineered Purity. Verified Quality. Uncompromising Reliability.”</span>
                    </div>
                    <div class="hero-slogan-tagline">
                        Manufacturing &amp; Supplying High-Purity Metal Powders, Tungsten Oxides &amp; Chemical Compounds
                    </div>
                </div>

                <p class="hero-lead">
                    Established in 2013 in Rajkot, Gujarat, HB Metals processes and supplies high-purity Magnesium Metal Powder, Sodium Tungstate, and Tungsten Oxides for metallurgy, catalysis, pyrotechnics, and specialty chemical synthesis.
                </p>
                <div class="hero-actions">
                    <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-primary btn-lg">Explore Catalogue</a>
                    <a href="<?= Helpers::url('/request-a-quote/') ?>" class="btn btn-outline-white btn-lg" data-open-rfq>Request a Quote</a>
                </div>

                <div style="display:flex; gap:var(--space-8); padding-top:var(--space-6); border-top:1px solid rgba(255,255,255,0.12); flex-wrap:wrap;">
                    <div>
                        <div style="font-size:1.75rem; font-weight:800; color:var(--color-copper-glow); font-family:var(--font-heading);" data-counter="2013">2013</div>
                        <div style="font-size:var(--text-micro); color:#a2b7c7; text-transform:uppercase; letter-spacing:0.06em;">Established Year</div>
                    </div>
                    <div>
                        <div style="font-size:1.75rem; font-weight:800; color:var(--color-copper-glow); font-family:var(--font-heading);" data-counter="25" data-counter-suffix=" Kg">25 Kg</div>
                        <div style="font-size:var(--text-micro); color:#a2b7c7; text-transform:uppercase; letter-spacing:0.06em;">Standard MOQ</div>
                    </div>
                    <div>
                        <div style="font-size:1.75rem; font-weight:800; color:var(--color-copper-glow); font-family:var(--font-heading);" data-counter="100" data-counter-suffix="%">100%</div>
                        <div style="font-size:var(--text-micro); color:#a2b7c7; text-transform:uppercase; letter-spacing:0.06em;">Tested Batches</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual" data-reveal="right" style="transition-delay: 150ms;">
                <div class="hero-visual-card glass-card-dark telemetry-corners">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:var(--space-4);">
                        <span style="font-size:var(--text-micro); color:var(--color-copper); text-transform:uppercase; letter-spacing:0.08em; font-weight:700;">Infrastructure Highlights</span>
                        <span style="font-size:var(--text-micro); color:#a0b4c2; text-transform:uppercase; letter-spacing:0.05em; font-weight:600;">Shapar, Rajkot Facility</span>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:var(--space-4);">
                        <div class="hero-feature-item is-active" data-slide-index="0" role="tab" aria-selected="true" tabindex="0">
                            <h4 style="color:#ffffff; font-size:1rem; margin-bottom:4px;">High-Speed Automatic Machinery</h4>
                            <p style="font-size:0.85rem; color:#b0c2ce; margin:0;">Precision grinding and milling ensuring strict particle size uniformity and grain consistency.</p>
                        </div>

                        <div class="hero-feature-item" data-slide-index="1" role="tab" aria-selected="false" tabindex="0">
                            <h4 style="color:#ffffff; font-size:1rem; margin-bottom:4px;">Moisture-Proof Barrier Packaging</h4>
                            <p style="font-size:0.85rem; color:#b0c2ce; margin:0;">Heavy-duty drums with dual polythene liners protecting sensitive metal powders from humidity and oxidation.</p>
                        </div>

                        <div class="hero-feature-item" data-slide-index="2" role="tab" aria-selected="false" tabindex="0">
                            <h4 style="color:#ffffff; font-size:1rem; margin-bottom:4px;">Lot-Specific Certificate of Analysis</h4>
                            <p style="font-size:0.85rem; color:#b0c2ce; margin:0;">Verified assay, insoluble residues, and trace element testing provided with commercial dispatches.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Section 2: Value Pillars
     ========================================================================= -->
<section id="section-principles" class="section-light section-3d-hud" data-3d-hud="[3D BENCHMARKS // SEC 02 // PURITY MATRIX]">
    <div class="container">
        <div style="text-align:center; max-width:700px; margin:0 auto var(--space-12);">
            <span class="badge badge-copper" style="margin-bottom:var(--space-2);">Quality Framework</span>
            <h2 class="split-mask-wrap"><span class="split-mask-inner">Core <span class="metallic-shimmer">Quality Principles</span></span></h2>
            <p style="color: var(--color-steel); font-size: 1.05rem;">Our processing operations adhere to clear chemical and physical benchmarks to guarantee dependable performance in demanding industrial applications.</p>
        </div>

        <div class="grid-4" style="gap: var(--space-6);">
            <div class="glass-card" style="padding:var(--space-6); text-align:center; background: var(--color-white); border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                <div style="font-size:2rem; margin-bottom:var(--space-3); line-height:1; color: var(--color-copper);">🔬</div>
                <h3 style="font-size:1.15rem; margin-bottom:var(--space-2); color:var(--color-navy); font-weight: 700;">High Quality</h3>
                <p style="font-size:var(--text-small); color:var(--color-steel); margin:0; line-height: 1.55;">Processed using modernized production systems complying with verified industry requirements.</p>
            </div>

            <div class="glass-card" style="padding:var(--space-6); text-align:center; background: var(--color-white); border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                <div style="font-size:2rem; margin-bottom:var(--space-3); line-height:1; color: var(--color-copper);">✨</div>
                <h3 style="font-size:1.15rem; margin-bottom:var(--space-2); color:var(--color-navy); font-weight: 700;">Chemical Purity</h3>
                <p style="font-size:var(--text-small); color:var(--color-steel); margin:0; line-height: 1.55;">Clean elemental assays and low trace-impurity tolerances verified across batch inspections.</p>
            </div>

            <div class="glass-card" style="padding:var(--space-6); text-align:center; background: var(--color-white); border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                <div style="font-size:2rem; margin-bottom:var(--space-3); line-height:1; color: var(--color-copper);">⚖️</div>
                <h3 style="font-size:1.15rem; margin-bottom:var(--space-2); color:var(--color-navy); font-weight: 700;">High Density</h3>
                <p style="font-size:var(--text-small); color:var(--color-steel); margin:0; line-height: 1.55;">High melting points and consistent bulk density parameters essential for refractory materials.</p>
            </div>

            <div class="glass-card" style="padding:var(--space-6); text-align:center; background: var(--color-white); border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
                <div style="font-size:2rem; margin-bottom:var(--space-3); line-height:1; color: var(--color-copper);">📦</div>
                <h3 style="font-size:1.15rem; margin-bottom:var(--space-2); color:var(--color-navy); font-weight: 700;">Long Shelf Life</h3>
                <p style="font-size:var(--text-small); color:var(--color-steel); margin:0; line-height: 1.55;">Hermetically lined packaging ensuring optimal chemical stability throughout warehousing.</p>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Section 3: Featured Products
     ========================================================================= -->
<section id="section-featured" class="section-3d-hud" style="background: rgba(255, 255, 255, 0.10); backdrop-filter: blur(14px) saturate(160%); -webkit-backdrop-filter: blur(14px) saturate(160%); border-top: 1px solid rgba(255, 255, 255, 0.10); border-bottom: 1px solid rgba(255, 255, 255, 0.10);">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:var(--space-4); margin-bottom:var(--space-10);">
            <div>
                <span class="badge badge-copper" style="margin-bottom:var(--space-2);">Core Manufacturing</span>
                <h2 style="font-size:clamp(1.85rem, 3.2vw, 2.5rem); font-weight:800; color:#ffffff; margin: 0 0 6px;">Featured <span class="metallic-shimmer">Products</span></h2>
                <p style="margin:0; color: #ffffff; opacity: 0.90; font-size: 1.05rem;">Core manufactured lines available for immediate inquiry and bulk scheduling.</p>
            </div>
            <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-primary">View Full Catalogue →</a>
        </div>

        <?php if (!empty($featuredProducts)): ?>
            <div class="grid-4" style="gap:var(--space-6);">
                <?php foreach ($featuredProducts as $product): ?>
                    <?php require __DIR__ . '/../components/product_card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="glass-card" style="padding:var(--space-10); text-align:center; background:var(--color-white); border-radius:var(--radius-lg);">
                <p style="color:var(--color-steel); margin-bottom:var(--space-4);">Core manufactured lines are undergoing catalog synchronization.</p>
                <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-primary">Browse Full Product Catalogue</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- =========================================================================
     Section 4: Product Categories
     ========================================================================= -->
<section id="section-categories" class="section-light section-3d-hud" data-3d-hud="[3D CATEGORIES // SEC 04 // MATERIAL FAMILIES]">
    <div class="container">
        <div style="text-align:center; max-width:700px; margin:0 auto var(--space-12);">
            <span class="badge badge-copper" style="margin-bottom:var(--space-2);">Manufacturing Families</span>
            <h2 style="font-size:clamp(1.8rem, 3.5vw, 2.5rem); font-weight:800; color:var(--color-ink); margin-bottom:10px;" class="split-mask-wrap"><span class="split-mask-inner">Product Families &amp; <span class="metallic-shimmer">Categories</span></span></h2>
            <p style="color:var(--color-steel); font-size:1.05rem;">Explore our specialized material families spanning magnesium derivatives, tungsten salts, oxides, and cobalt reagents.</p>
        </div>

        <?php
        $categoryThemes = [
            'magnesium-products' => [
                'gradient' => 'gradient-orange',
                'badgeText' => 'High-Speed Milling',
                'badgeColor' => '#ea580c',
            ],
            'sodium-tungstate' => [
                'gradient' => 'gradient-blue',
                'badgeText' => 'Catalytic Reagents',
                'badgeColor' => '#0284c7',
            ],
            'tungsten-powder' => [
                'gradient' => 'gradient-gray',
                'badgeText' => 'High Thermal Density',
                'badgeColor' => '#475569',
            ],
            'tungsten-oxide' => [
                'gradient' => 'gradient-purple',
                'badgeText' => 'WO3 Purity 99.5%',
                'badgeColor' => '#9333ea',
            ],
            'ammonium-paratungstate' => [
                'gradient' => 'gradient-green',
                'badgeText' => 'Crystalline Precursor',
                'badgeColor' => '#059669',
            ],
            'metal-oxides' => [
                'gradient' => 'gradient-amber',
                'badgeText' => 'Cobalt & Transition',
                'badgeColor' => '#d97706',
            ],
            'metallic-salts' => [
                'gradient' => 'gradient-teal',
                'badgeText' => 'Specialty Catalysts',
                'badgeColor' => '#4f46e5',
            ],
        ];
        ?>

        <!-- Product Families Grid -->
        <div class="grid-3" style="gap: var(--space-8);">
            <?php foreach ($categories as $slug => $cat): 
                $theme = $categoryThemes[$slug] ?? [
                    'gradient' => 'gradient-gray',
                    'badgeText' => 'HB Metals Standard',
                    'badgeColor' => '#475569',
                ];
                $imageUrl = !empty($cat['image']) ? Helpers::asset($cat['image']) : Helpers::asset('/assets/images/hero/slide-machinery.jpg');
            ?>
                <a href="<?= Helpers::url('/product-category/' . $cat['slug'] . '/') ?>" class="gradient-card <?= $theme['gradient'] ?> reveal-on-scroll">
                    <div class="gradient-card-image-wrap">
                        <img src="<?= $imageUrl ?>" alt="<?= Helpers::e($cat['name']) ?>" class="gradient-card-bg-img" loading="lazy" />
                    </div>

                    <div class="gradient-card-content">
                        <div class="gradient-card-badge">
                            <span class="gradient-card-badge-dot" style="background-color: <?= $theme['badgeColor'] ?>;"></span>
                            <?= Helpers::e($theme['badgeText']) ?>
                        </div>

                        <h3 class="gradient-card-title"><?= Helpers::e($cat['name']) ?></h3>
                        <p class="gradient-card-description"><?= Helpers::e($cat['short_description']) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =========================================================================
     Section 5: Operational Capabilities
     ========================================================================= -->
<section id="section-setup" class="section-3d-hud" style="background: rgba(255, 255, 255, 0.10); backdrop-filter: blur(14px) saturate(160%); -webkit-backdrop-filter: blur(14px) saturate(160%); border-top: 1px solid rgba(255, 255, 255, 0.10); border-bottom: 1px solid rgba(255, 255, 255, 0.10);">
    <div class="container">
        <div class="grid-2" style="align-items:center; gap:var(--space-12);">
            <div>
                <span class="badge badge-copper" style="margin-bottom:var(--space-2);">Infrastructure</span>
                <h2 style="font-size: clamp(1.85rem, 3.2vw, 2.5rem); font-weight: 800; color: #ffffff; margin: 0 0 var(--space-3);">Infrastructural &amp; <span class="metallic-shimmer">Manufacturing Setup</span></h2>
                <p style="color: #ffffff; opacity: 0.90; font-size: 1.05rem; line-height: 1.65; margin-bottom: var(--space-6);">
                    Our facility in Shapar, Rajkot is organized into specialized functional departments—processing, production, procurement, testing, and warehousing—to coordinate consistent supply schedules.
                </p>
                <div style="display:flex; flex-direction:column; gap:var(--space-4);">
                    <?php foreach (array_slice($capabilities, 0, 3) as $cap): ?>
                        <div style="display:flex; gap:var(--space-4); align-items:flex-start;">
                            <div style="width:36px; height:36px; border-radius:50%; background: rgba(184, 109, 60, 0.25); color: #f59e0b; border: 1px solid rgba(184, 109, 60, 0.45); display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0;">✓</div>
                            <div>
                                <h3 style="font-size:1.05rem; margin-bottom:2px; color: #ffffff; font-weight: 700;"><?= Helpers::e($cap['title']) ?></h3>
                                <p style="font-size:var(--text-small); margin:0; color: #ffffff; opacity: 0.88; line-height: 1.5;"><?= Helpers::e($cap['description']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top:var(--space-8);">
                    <a href="<?= Helpers::url('/capabilities/') ?>" class="btn btn-primary">Learn More About Our Setup →</a>
                </div>
            </div>

            <div class="glass-card-dark" style="padding:var(--space-8); border-radius: var(--radius-lg); background: rgba(14, 28, 38, 0.96); border: 1px solid rgba(255, 255, 255, 0.14); box-shadow: var(--shadow-lg);">
                <span class="badge badge-copper" style="margin-bottom:var(--space-3);">Operational Strengths</span>
                <h3 style="color:#ffffff; margin-bottom:var(--space-4); font-size:1.45rem; font-weight: 700;">Why Partner With HB Metals?</h3>
                <ul style="display:flex; flex-direction:column; gap:var(--space-4); font-size:var(--text-small); padding: 0; list-style: none; margin: 0;">
                    <li style="display:flex; gap:var(--space-3); align-items: flex-start;">
                        <span style="color:var(--color-copper); font-weight:700; line-height: 1.4;">•</span>
                        <span style="color: #d1dde6; line-height: 1.6;"><strong style="color: #ffffff;">Ethical Business Policies:</strong> Transparent pricing, direct commercial communication, and straightforward quotation terms.</span>
                    </li>
                    <li style="display:flex; gap:var(--space-3); align-items: flex-start;">
                        <span style="color:var(--color-copper); font-weight:700; line-height: 1.4;">•</span>
                        <span style="color: #d1dde6; line-height: 1.6;"><strong style="color: #ffffff;">Modern Infrastructure:</strong> Automatic machinery ensuring high processing efficiency and prompt delivery timelines.</span>
                    </li>
                    <li style="display:flex; gap:var(--space-3); align-items: flex-start;">
                        <span style="color:var(--color-copper); font-weight:700; line-height: 1.4;">•</span>
                        <span style="color: #d1dde6; line-height: 1.6;"><strong style="color: #ffffff;">Dependable Chemical Quality:</strong> Products tested for accurate composition, density, and moisture resistance.</span>
                    </li>
                    <li style="display:flex; gap:var(--space-3); align-items: flex-start;">
                        <span style="color:var(--color-copper); font-weight:700; line-height: 1.4;">•</span>
                        <span style="color: #d1dde6; line-height: 1.6;"><strong style="color: #ffffff;">Flexible Packaging Options:</strong> 25 Kg sealed drums or custom containerized packing according to buyer requirements.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Section 6: Commercial & Technical FAQs (Modern Two-Column Layout)
     ========================================================================= -->
<section id="section-faq" class="section-light section-3d-hud" data-3d-hud="[3D VERIFICATION DESK // SEC 06 // TECHNICAL KNOWLEDGE]">
    <div class="container">
        <div class="faq-two-col">
            <!-- Left Column: Industrial Lab / Testing Visual -->
            <div class="faq-image-wrap tilt-card telemetry-corners" data-reveal="left">
                <img
                    src="<?= Helpers::asset('/assets/images/hero/slide-lab.jpg') ?>"
                    alt="HB Metals Laboratory & Quality Inspection"
                    class="faq-image"
                    width="420"
                    height="350"
                    loading="lazy"
                >
            </div>

            <!-- Right Column: Accordion Content -->
            <div class="faq-content-wrap" data-reveal="right" style="transition-delay: 150ms;">
                <p class="faq-badge-label">FAQ's</p>
                <h2 class="faq-title split-mask-wrap"><span class="split-mask-inner">Looking for <span class="metallic-shimmer">answers?</span></span></h2>
                <p class="faq-subtitle">
                    Verified commercial, chemical specifications, packaging standards, and analytical documentation directly from HB Metals technical operations.
                </p>

                <div class="accordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="accordion-item <?= $index === 0 ? 'is-open' : '' ?>">
                            <button type="button" class="accordion-trigger" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>">
                                <span><?= Helpers::e($faq['question']) ?></span>
                                <svg class="accordion-chevron" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="accordion-body">
                                <p><?= Helpers::e($faq['answer']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: var(--space-8); display: flex; align-items: center; gap: var(--space-4); flex-wrap: wrap;">
                    <span style="font-size: var(--text-small); color: var(--color-steel);">Have a specific inquiry not listed?</span>
                    <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-outline btn-sm">Contact Our Technical Team →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Section 7: Call to Action Banner
     ========================================================================= -->
<section class="section-3d-hud is-dark" data-3d-hud="[3D PROCUREMENT DOCK // SEC 07 // DIRECT DISPATCH DESK]" style="text-align: center;">
    <div class="container">
        <div style="max-width: 740px; margin: 0 auto;" data-reveal="zoom-3d">
            <span class="badge badge-copper" style="margin-bottom:var(--space-3);">Immediate Procurement</span>
            <h2 style="color: var(--color-white); margin-bottom: var(--space-4); font-size: clamp(1.85rem, 3.2vw, 2.75rem);">Ready to Discuss Your Chemical &amp; Metal Requirements?</h2>
            <p style="color: #b5c7d5; margin-bottom: var(--space-8); font-size: var(--text-body-lg);">
                Connect with Mr. Anil Patel or our Rajkot sales desk for confirmed lot availability, custom particle grading, and commercial quotations.
            </p>
            <div style="display:flex; justify-content:center; gap:var(--space-4); flex-wrap:wrap;">
                <a href="<?= Helpers::url('/request-a-quote/') ?>" class="btn btn-primary btn-lg" data-open-rfq>Request a Quote</a>
                <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-outline-white btn-lg">Contact Technical Desk</a>
            </div>
        </div>
    </div>
</section>
