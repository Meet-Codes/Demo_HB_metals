<?php
use App\Support\Helpers;

/**
 * Reusable Liquid-Glass Product Card Component
 * Expects $product array
 */
$productUrl = Helpers::url('/' . $product['slug'] . '/');
$categoryName = $product['category_name'] ?? 'Material';
$imagePath = !empty($product['image']) ? Helpers::asset($product['image']) : Helpers::asset('/assets/images/placeholder.svg');
?>

<div class="product-card glass-card tilt-card telemetry-corners">
    <div class="product-card-image-wrap">
        <a href="<?= $productUrl ?>" tabindex="-1" aria-hidden="true">
            <img src="<?= $imagePath ?>"
                 alt="<?= Helpers::e($product['name']) ?>"
                 class="product-card-image"
                 loading="lazy"
                 width="518"
                 height="291">
        </a>
        <?php if (!empty($product['chemical_formula'])): ?>
            <span class="formula-tag cas-tag-dark" style="position: absolute; bottom: 8px; left: 8px; z-index: 3;">
                <?= Helpers::e($product['chemical_formula']) ?>
            </span>
        <?php endif; ?>
    </div>

    <div class="product-card-body">
        <span class="product-card-category"><?= Helpers::e($categoryName) ?></span>
        <h3 class="product-card-title">
            <a href="<?= $productUrl ?>"><?= Helpers::e($product['name']) ?></a>
        </h3>

        <p class="product-card-desc" style="color: #0F1A24;">
            <?= Helpers::e($product['short_description']) ?>
        </p>

        <div class="product-card-meta">
            <span>MOQ: <strong><?= !empty($product['minimum_order_quantity']) ? Helpers::e($product['minimum_order_quantity'] . ' ' . ($product['minimum_order_unit'] ?? 'Kg')) : '25 Kilogram' ?></strong></span>
            <?php if (!empty($product['cas_number'])): ?>
                <span class="cas-tag">CAS: <?= Helpers::e($product['cas_number']) ?></span>
            <?php endif; ?>
        </div>

        <div class="product-card-actions">
            <a href="<?= $productUrl ?>" class="btn btn-outline btn-sm">View Details</a>
            <button type="button" class="btn btn-primary btn-sm" data-open-rfq data-product="<?= Helpers::e($product['name']) ?>">Get Quote</button>
        </div>
    </div>
</div>
