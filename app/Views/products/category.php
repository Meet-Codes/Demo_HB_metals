<?php
use App\Support\Helpers;
?>

<!-- Hero Header -->
<div class="section-3d-hud is-dark" data-3d-hud="[3D CATEGORY CORRIDOR // <?= strtoupper(Helpers::e($category['slug'])) ?> // MATERIAL CLUSTER]">
    <div class="container">
        <span class="badge badge-copper" style="margin-bottom: var(--space-3);">Product Family</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-4);">
            <span class="split-mask-inner"><?= Helpers::e($category['name']) ?></span>
        </h1>
        <p style="color: #b8cad6; max-width: 720px; font-size: var(--text-body-lg); margin: 0; line-height: 1.65;">
            <?= Helpers::e($category['long_description'] ?? $category['short_description']) ?>
        </p>
    </div>
</div>

<!-- Main Category View with Sidebar -->
<section class="section-3d-hud" data-3d-hud="[3D FAMILY MATRIX // CERTIFIED MATERIAL INVENTORY]" style="padding: var(--space-16) 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 290px 1fr; gap: var(--space-10); align-items: flex-start;">
            <!-- Category Sidebar -->
            <aside class="glass-card telemetry-corners reveal-on-scroll" style="padding: var(--space-6);">
                <h3 style="font-size: 1.15rem; margin-bottom: var(--space-4); border-bottom: 2px solid var(--color-copper); padding-bottom: var(--space-2); color: var(--color-ink);">
                    Product Categories
                </h3>
                <ul style="display: flex; flex-direction: column; gap: var(--space-2); font-size: var(--text-small);">
                    <?php foreach ($allCategories as $c): ?>
                        <li>
                            <a href="<?= Helpers::url('/product-category/' . $c['slug'] . '/') ?>"
                               style="display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; border-radius: var(--radius-sm); text-decoration: none; transition: all var(--transition-fast); color: <?= $c['slug'] === $category['slug'] ? 'var(--color-copper); font-weight:700; background:rgba(184,109,60,0.12); border-left:3px solid var(--color-copper);' : 'var(--color-ink);' ?>">
                               <span><?= Helpers::e($c['name']) ?></span>
                               <?php if ($c['slug'] === $category['slug']): ?>
                                   <span style="font-size: 0.8rem;">●</span>
                               <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div style="margin-top: var(--space-8); padding-top: var(--space-6); border-top: 1px solid var(--color-line); text-align: center;">
                    <span class="badge badge-copper" style="margin-bottom: var(--space-2); font-size: 0.7rem;">Custom Orders</span>
                    <p style="font-size: var(--text-small); color: var(--color-steel); margin-bottom: var(--space-4);">Need a custom formulation, non-standard mesh, or bulk lot?</p>
                    <a href="<?= Helpers::url('/request-a-quote/') ?>" class="btn btn-primary btn-sm" style="width: 100%;" data-open-rfq>Request Quotation</a>
                </div>
            </aside>

            <!-- Products Grid for Category -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-6); flex-wrap: wrap; gap: var(--space-2);">
                    <h2 style="font-size: 1.35rem; margin: 0; color: var(--color-ink);">Products in <?= Helpers::e($category['name']) ?> <span style="font-size: 1rem; color: var(--color-steel); font-weight: normal;">(<?= count($products) ?> items)</span></h2>
                    <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-outline btn-sm">← All Categories</a>
                </div>

                <?php if (!empty($products)): ?>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: var(--space-6);">
                        <?php foreach ($products as $product): ?>
                            <?php require __DIR__ . '/../components/product_card.php'; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="glass-card telemetry-corners" style="padding: var(--space-12); text-align: center;">
                        <p style="color: var(--color-steel); margin-bottom: var(--space-4);">No active products are currently published under this category.</p>
                        <a href="<?= Helpers::url('/our-products/') ?>" class="btn btn-outline">Return to Catalogue</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
