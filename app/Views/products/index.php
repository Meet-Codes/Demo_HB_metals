<?php
use App\Support\Helpers;
?>

<!-- Hero Header -->
<div class="section-3d-hud is-dark" data-3d-hud="[3D CHEMICAL COMPOSITION MATRIX // COMPLETE SPECIFICATION CATALOGUE]">
    <div class="container" data-reveal="left">
        <span class="badge badge-copper" style="margin-bottom: var(--space-3);">Full Catalogue</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-4);">
            <span class="split-mask-inner">Metal Powders &amp; <span class="metallic-shimmer">Tungsten Catalogue</span></span>
        </h1>
        <p style="color: #b8cad6; max-width: 680px; font-size: var(--text-body-lg); margin: 0; line-height: 1.65;">
            Browse our manufactured range of Magnesium Metal Powders, Sodium Tungstate, Tungsten Trioxide Powder, and Precision Metallic Salts.
        </p>
    </div>
</div>

<!-- Main Catalogue Section -->
<section class="section-3d-hud" data-3d-hud="[3D FILTER MATRIX // CAS REGISTRY // DENSITY CRITERIA]" style="padding: var(--space-16) 0;">
    <div class="container">
        <!-- Search and Filter Bar in Liquid-Glass Card -->
        <div class="glass-card" style="padding: var(--space-5) var(--space-6); margin-bottom: var(--space-8); background: var(--color-white); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <form action="<?= Helpers::url('/our-products/') ?>" method="GET" style="display: flex; gap: var(--space-4); flex-wrap: wrap; align-items: flex-end;">
                <div style="flex: 2; min-width: 250px;">
                    <label for="search_input" class="form-label" style="font-weight: 600; color: var(--color-navy); margin-bottom: var(--space-2);">Search Products / CAS / Formula</label>
                    <input type="text" id="search_input" name="q" class="form-control" value="<?= Helpers::e($currentSearch ?? '') ?>" placeholder="e.g. Magnesium, Sodium Tungstate, 7439-95-4, WO3...">
                </div>

                <div style="flex: 1.5; min-width: 210px;">
                    <label for="category_filter" class="form-label" style="font-weight: 600; color: var(--color-navy); margin-bottom: var(--space-2);">Filter by Material Category</label>
                    <select id="category_filter" name="category" class="form-select">
                        <option value="">All Manufacturing Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= Helpers::e($cat['slug']) ?>" <?= ($currentCategorySlug === $cat['slug']) ? 'selected' : '' ?>>
                                <?= Helpers::e($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display: flex; gap: var(--space-2);">
                    <button type="submit" class="btn btn-primary" aria-label="Apply search and category filter">Filter</button>
                    <?php if ($currentSearch || $currentCategorySlug): ?>
                        <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-outline" aria-label="Reset filter to show all products">Reset</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Result Stats Heading -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-6); flex-wrap: wrap; gap: var(--space-2);">
            <h2 style="font-size: 1.35rem; margin: 0; color: var(--color-navy); font-weight: 700;">
                <?php if ($currentSearch && $currentCategorySlug): ?>
                    Showing results for "<?= Helpers::e($currentSearch) ?>" in category <span style="color: var(--color-steel); font-size: 1rem; font-weight: normal;">(<?= count($products) ?> found)</span>
                <?php elseif ($currentSearch): ?>
                    Search results for "<?= Helpers::e($currentSearch) ?>" <span style="color: var(--color-steel); font-size: 1rem; font-weight: normal;">(<?= count($products) ?> found)</span>
                <?php elseif ($currentCategorySlug): ?>
                    Category Results <span style="color: var(--color-steel); font-size: 1rem; font-weight: normal;">(<?= count($products) ?> products)</span>
                <?php else: ?>
                    All Manufactured Products <span style="color: var(--color-steel); font-size: 1rem; font-weight: normal;">(<?= count($products) ?> available)</span>
                <?php endif; ?>
            </h2>
            <span class="cas-tag font-mono">Standard MOQ: 25 Kg</span>
        </div>

        <!-- Products Grid -->
        <?php if (!empty($products)): ?>
            <div class="grid-4" style="gap: var(--space-6);">
                <?php foreach ($products as $product): ?>
                    <?php require __DIR__ . '/../components/product_card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="glass-card telemetry-corners" style="padding: var(--space-12); text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: var(--space-3); color: var(--color-muted);">🔍</div>
                <h3 style="color: var(--color-ink); margin-bottom: var(--space-2);">No Matching Products Found</h3>
                <p style="color: var(--color-steel); margin-bottom: var(--space-6); max-width: 500px; margin-left: auto; margin-right: auto;">
                    We couldn't locate any products matching "<?= Helpers::e($currentSearch) ?>". Try adjusting your search term or view all categories.
                </p>
                <div style="display: flex; justify-content: center; gap: var(--space-4);">
                    <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-primary">Reset Filter</a>
                    <a href="<?= Helpers::url('/request-a-quote/') ?>" class="btn btn-outline" data-open-rfq>Request Custom Formulation</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
