<?php
use App\Support\Helpers;

$imagePath = !empty($product['image']) ? Helpers::asset($product['image']) : Helpers::asset('/assets/images/placeholder.svg');
$categoryUrl = !empty($product['category_slug']) ? Helpers::url("/product-category/{$product['category_slug']}/") : Helpers::url('/our-products/');
$categoryLabel = $product['category_name'] ?? 'Product Portfolio';
?>

<!-- Schema.org Product Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "<?= Helpers::e($product['name']) ?>",
    "image": "<?= Helpers::e(Helpers::url($product['image'] ?? '/assets/images/placeholder.svg')) ?>",
    "description": "<?= Helpers::e($product['short_description']) ?>",
    "brand": {
        "@type": "Brand",
        "name": "HB Metals India"
    },
    <?php if (!empty($product['cas_number'])): ?>
    "identifier": "CAS: <?= Helpers::e($product['cas_number']) ?>",
    <?php endif; ?>
    "category": "<?= Helpers::e($categoryLabel) ?>",
    "offers": {
        "@type": "Offer",
        "priceCurrency": "INR",
        "price": "Upon Request",
        "availability": "https://schema.org/InStock",
        "seller": {
            "@type": "Organization",
            "name": "HB Metals India"
        }
    }
}
</script>

<div class="section-3d-hud is-dark" data-3d-hud="[3D CHEMICAL PROFILE // SPECTRAL ASSAY]" style="color: var(--color-white); padding: var(--space-12) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%);">
    <div class="container" data-reveal="left" style="position: relative; z-index: 2;">
        <div style="display: flex; align-items: center; gap: var(--space-3); flex-wrap: wrap; margin-bottom: var(--space-3);">
            <span class="glass-pill" style="border-color: rgba(184, 109, 60, 0.4); background: rgba(184, 109, 60, 0.15); color: #e59f71;">
                <a href="<?= $categoryUrl ?>" style="color: inherit; text-decoration: none;"><?= Helpers::e($categoryLabel) ?></a>
            </span>
            <?php if (!empty($product['chemical_formula'])): ?>
                <span class="formula-tag" style="background: rgba(255, 255, 255, 0.1); color: var(--color-white); border-color: rgba(255, 255, 255, 0.2);"><?= Helpers::e($product['chemical_formula']) ?></span>
            <?php endif; ?>
            <?php if (!empty($product['cas_number'])): ?>
                <span class="cas-tag" style="background: rgba(255, 255, 255, 0.08); color: #d0dde5; border-color: rgba(255, 255, 255, 0.15);">CAS: <?= Helpers::e($product['cas_number']) ?></span>
            <?php endif; ?>
        </div>
        <h1 style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 800; letter-spacing: -0.02em;"><?= Helpers::e($product['name']) ?></h1>
        <p style="color: #b5c8d5; max-width: 760px; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            <?= Helpers::e($product['short_description']) ?>
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: transparent;">
    <div class="container">
        <!-- Top Section: Visuals & Fast Facts (Opposite-Side Split Reveals) -->
        <div class="grid-2" style="gap: var(--space-10); align-items: flex-start; margin-bottom: var(--space-16);">
            <!-- Product Image & Interactive 3D Molecular Lattice (Reveal from Left) -->
            <div data-reveal="left">
                <div class="glass-card telemetry-corners tilt-card" style="padding: 0; overflow: hidden; border-radius: var(--radius-lg); background: var(--color-white);">
                    <img src="<?= $imagePath ?>"
                         alt="<?= Helpers::e($product['name']) ?>"
                         style="width: 100%; aspect-ratio: 16/10; object-fit: cover; display: block;"
                         width="600"
                         height="375">
                </div>

                <!-- Interactive 3D Molecular Chemistry Viewer -->
                <div class="molecule-3d-wrap glass-card-dark" style="margin-top: var(--space-6); border-radius: var(--radius-md);" data-3d-molecule="<?= Helpers::e($product['slug'] ?? $product['category_slug'] ?? 'tungsten-oxide') ?>">
                    <div style="position: absolute; top: 12px; left: 14px; font-size: 0.72rem; font-family: var(--font-mono); font-weight: 700; color: #ffffff; background: rgba(15, 30, 41, 0.88); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(184, 109, 60, 0.4); z-index: 5;">
                        ⚛ 3D Atomic Structure Viewer
                    </div>
                    <span class="molecule-3d-hint">Click &amp; Drag to Orbit 3D</span>
                </div>
            </div>

            <!-- Fast Facts & Summary (Reveal from Right) -->
            <div data-reveal="right">
                <div class="glass-card" style="background: var(--color-white); padding: var(--space-8); border-radius: var(--radius-lg);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4); border-bottom: 1px solid var(--color-line); padding-bottom: var(--space-3);">
                        <h2 style="font-size: 1.35rem; margin: 0; color: var(--color-navy); font-weight: 700;">Material Parameters &amp; Commercial Terms</h2>
                        <?php if (!empty($product['purity_value'])): ?>
                            <span class="glass-pill" style="background: rgba(46, 125, 50, 0.1); color: #2e7d32; border-color: rgba(46, 125, 50, 0.25); font-weight: 700;">
                                <?= Helpers::e($product['purity_value']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="table-responsive" style="border:none; margin-bottom: var(--space-6);">
                        <table class="spec-table" style="background: transparent;">
                            <tbody>
                                <?php if (!empty($product['chemical_name'])): ?>
                                    <tr>
                                        <th style="width: 40%;">Chemical Name</th>
                                        <td><strong><?= Helpers::e($product['chemical_name']) ?></strong></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($product['chemical_formula'])): ?>
                                    <tr>
                                        <th>Formula</th>
                                        <td><span class="formula-tag"><?= Helpers::e($product['chemical_formula']) ?></span></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($product['cas_number'])): ?>
                                    <tr>
                                        <th>CAS Registry Number</th>
                                        <td><span class="cas-tag"><?= Helpers::e($product['cas_number']) ?></span></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($product['grade'])): ?>
                                    <tr>
                                        <th>Commercial Grade</th>
                                        <td><?= Helpers::e($product['grade']) ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Minimum Order Quantity</th>
                                    <td><strong><?= !empty($product['minimum_order_quantity']) ? Helpers::e($product['minimum_order_quantity'] . ' ' . $product['minimum_order_unit']) : '25 Kilogram' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Standard Packaging</th>
                                    <td>
                                        <?php if (!empty($product['packaging_options']) && is_array($product['packaging_options'])): ?>
                                            <?= Helpers::e(implode(' / ', $product['packaging_options'])) ?>
                                        <?php else: ?>
                                            25 Kg Moisture-Proof Sealed Drum
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="display: flex; gap: var(--space-4); flex-wrap: wrap;">
                        <button type="button" class="btn btn-primary btn-lg" data-open-rfq data-product="<?= Helpers::e($product['name']) ?>" style="flex: 1;">
                            Request Quotation
                        </button>
                        <a href="tel:<?= Helpers::e($settings['phone']) ?>" class="btn btn-outline btn-lg">
                            Call Sales Desk
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Section: Detailed Specifications & Applications (Opposite-Side Reveals) -->
        <div class="grid-2" style="gap: var(--space-10); align-items: flex-start; margin-bottom: var(--space-16);">
            <!-- Detailed Specifications (Reveal from Left) -->
            <div data-reveal="left">
                <h3 style="font-size: 1.35rem; margin-bottom: var(--space-4); color: var(--color-navy); font-weight: 700;">Technical Parameters</h3>
                <?php if (!empty($product['specifications']) && is_array($product['specifications'])): ?>
                    <div class="glass-card" style="padding: 0; overflow: hidden; background: var(--color-white); border-radius: var(--radius-md);">
                        <table class="spec-table" style="margin: 0;">
                            <thead>
                                <tr>
                                    <th style="background: var(--color-paper); border-bottom: 2px solid var(--color-line);">Test Parameter</th>
                                    <th style="background: var(--color-paper); border-bottom: 2px solid var(--color-line);">Specification Standard</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product['specifications'] as $spec): ?>
                                    <tr>
                                        <th style="color: var(--color-navy); font-weight: 600;"><?= Helpers::e($spec['parameter']) ?></th>
                                        <td style="font-family: var(--font-mono); font-size: 0.88rem; color: var(--color-ink);"><?= Helpers::e($spec['value']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="glass-card" style="padding: var(--space-6); background: var(--color-white);">
                        <p style="color: var(--color-steel); margin: 0;">Standard batch parameters provided with quotation. Batch Certificate of Analysis (COA) furnished with each dispatch.</p>
                    </div>
                <?php endif; ?>

                <!-- Handling & Storage Notes -->
                <?php if (!empty($product['handling_notes']) || !empty($product['storage_notes'])): ?>
                    <div class="glass-card" style="background: #fdfaf7; border-left: 4px solid var(--color-copper); padding: var(--space-6); border-radius: var(--radius-md); margin-top: var(--space-6);">
                        <h4 style="font-size: 1.05rem; margin-bottom: var(--space-2); color: var(--color-copper-hover); font-weight: 700;">Handling &amp; Storage Guidelines</h4>
                        <?php if (!empty($product['handling_notes'])): ?>
                            <p style="font-size: var(--text-small); margin-bottom: var(--space-2); color: var(--color-ink);"><strong>Handling:</strong> <?= Helpers::e($product['handling_notes']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($product['storage_notes'])): ?>
                            <p style="font-size: var(--text-small); margin: 0; color: var(--color-ink);"><strong>Storage:</strong> <?= Helpers::e($product['storage_notes']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Overview & Industrial Applications (Reveal from Right) -->
            <div data-reveal="right">
                <h3 style="font-size: 1.35rem; margin-bottom: var(--space-4); color: var(--color-navy); font-weight: 700;">Description &amp; Industrial Uses</h3>
                <div class="glass-card" style="background: var(--color-white); border-radius: var(--radius-md); padding: var(--space-6); margin-bottom: var(--space-6);">
                    <p style="color: var(--color-ink); line-height: 1.7; margin: 0;"><?= Helpers::e($product['description'] ?? $product['short_description']) ?></p>
                </div>

                <?php if (!empty($product['applications']) && is_array($product['applications'])): ?>
                    <div class="glass-card" style="background: var(--color-white); border-radius: var(--radius-md); padding: var(--space-6); margin-bottom: var(--space-6);">
                        <h4 style="font-size: 1.1rem; margin-bottom: var(--space-3); color: var(--color-navy); font-weight: 700;">Key Industrial Applications</h4>
                        <ul style="display: flex; flex-direction: column; gap: var(--space-2); font-size: var(--text-small); color: var(--color-steel); padding: 0; list-style: none; margin: 0;">
                            <?php foreach ($product['applications'] as $app): ?>
                                <li style="display: flex; align-items: flex-start; gap: var(--space-3);">
                                    <span style="color: var(--color-copper); font-weight: bold; line-height: 1.4;">✓</span>
                                    <span style="color: var(--color-ink);"><?= Helpers::e($app) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Technical Document Request -->
                <?php if (!empty($documents)): ?>
                    <div class="glass-card" style="background: var(--color-white); border-radius: var(--radius-md); padding: var(--space-6);">
                        <h4 style="font-size: 1.1rem; margin-bottom: var(--space-2); color: var(--color-navy); font-weight: 700;">Technical Documentation</h4>
                        <p style="font-size: var(--text-small); color: var(--color-steel); margin-bottom: var(--space-4);">Request the official Technical Data Sheet (TDS) or Material Safety Data Sheet (MSDS).</p>
                        <?php foreach ($documents as $doc): ?>
                            <div style="display: flex; justify-content: space-between; align-items: center; background: var(--color-paper); padding: var(--space-3) var(--space-4); border-radius: var(--radius-sm); border: 1px solid var(--color-line); margin-bottom: var(--space-2);">
                                <div>
                                    <strong style="font-size: var(--text-small); color: var(--color-navy);"><?= Helpers::e($doc['title']) ?></strong>
                                    <div style="font-size: var(--text-micro); color: var(--color-muted); font-family: var(--font-mono);"><?= Helpers::e($doc['revision']) ?> • <?= Helpers::e($doc['file_size']) ?></div>
                                </div>
                                <button type="button" class="btn btn-outline btn-sm" data-open-rfq data-product="<?= Helpers::e($product['name']) ?> TDS">Request TDS</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Related Products Grid (Staggered Multi-Sided Entrance) -->
        <?php if (!empty($relatedProducts)): ?>
            <div style="border-top: 1px solid var(--color-line); padding-top: var(--space-12);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-6);">
                    <h3 style="font-size: 1.35rem; color: var(--color-navy); font-weight: 700; margin: 0;">Related Products in this Category</h3>
                    <a href="<?= $categoryUrl ?>" style="color: var(--color-copper); font-size: var(--text-small); font-weight: 600; text-decoration: none;">View Category &rarr;</a>
                </div>
                <div class="grid-3" data-reveal="stagger-cards" style="gap: var(--space-6);">
                    <?php foreach ($relatedProducts as $product): ?>
                        <?php require __DIR__ . '/../components/product_card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
