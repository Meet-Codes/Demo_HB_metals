<?php
use App\Support\Helpers;

if (!empty($breadcrumbs) && is_array($breadcrumbs)):
?>
<nav class="breadcrumbs-bar" aria-label="Breadcrumb Navigation">
    <div class="container">
        <ol class="breadcrumbs-list" itemscope itemtype="https://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbs as $index => $item): ?>
                <li class="breadcrumbs-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" <?= $index === count($breadcrumbs) - 1 ? 'aria-current="page"' : '' ?>>
                    <?php if ($index < count($breadcrumbs) - 1): ?>
                        <a href="<?= Helpers::url($item['url']) ?>" itemprop="item">
                            <span itemprop="name"><?= Helpers::e($item['label']) ?></span>
                        </a>
                        <meta itemprop="position" content="<?= $index + 1 ?>" />
                        <span class="breadcrumbs-separator" aria-hidden="true">/</span>
                    <?php else: ?>
                        <span itemprop="name"><?= Helpers::e($item['label']) ?></span>
                        <meta itemprop="position" content="<?= $index + 1 ?>" />
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
<?php endif; ?>
