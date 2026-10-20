<?php
use App\Support\Helpers;
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D TECHNICAL ARCHIVE // TDS & CHEMICAL REAGENTS LIBRARY]" style="color: var(--color-white); padding: var(--space-16) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%);">
    <div class="container" data-reveal="left" style="position: relative; z-index: 2;">
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(184, 109, 60, 0.4); background: rgba(184, 109, 60, 0.15); color: #e59f71;">Technical Library</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">Technical Resources &amp; <span class="metallic-shimmer">Data Sheets</span></span>
        </h1>
        <p style="color: #b5c8d5; max-width: 680px; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            Access verified Technical Data Sheets (TDS), chemical parameters, and material handling guidelines across our manufacturing catalog.
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: transparent;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto var(--space-10); text-align: center;" data-reveal="top">
            <span class="glass-pill" style="margin-bottom: var(--space-3); background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.24); color: #ffffff;">Analytical Index</span>
            <h2 style="font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 800; color: #ffffff; margin-bottom: var(--space-3); letter-spacing: -0.01em;">
                Available Technical Data Sheets (TDS)
            </h2>
            <p style="color: #ffffff; opacity: 0.92; font-size: var(--text-body); line-height: 1.6; margin: 0;">
                The technical documents below contain verified chemical assays, Loss on Ignition (LOI) maximum limits, bulk density measurements, and moisture storage protocols.
            </p>
        </div>

        <div style="max-width: 960px; margin: 0 auto;">
            <div class="glass-card" style="background: var(--color-white); border-radius: var(--radius-lg); overflow: hidden; padding: 0; box-shadow: var(--shadow-sm);">
                <?php if (!empty($documents)): ?>
                    <div style="padding: 8px 18px; background: #f8fafc; border-bottom: 1px solid var(--color-line); font-size: 0.78rem; color: var(--color-muted); display: flex; justify-content: space-between; align-items: center;">
                        <span>Showing <?= count($documents) ?> active Technical Data Sheets (TDS)</span>
                        <span class="mobile-only" style="color: var(--color-copper); font-weight: 600;">← Scroll horizontally on mobile →</span>
                    </div>
                    <div class="table-responsive" style="border:none; margin: 0;">
                        <table class="data-table" style="margin: 0;" aria-label="Technical Data Sheets Index">
                            <thead>
                                <tr>
                                    <th scope="col" style="min-width: 260px;">Document Title</th>
                                    <th scope="col" style="min-width: 170px;">Product Line</th>
                                    <th scope="col" style="min-width: 110px;">Classification</th>
                                    <th scope="col" style="min-width: 100px;">Revision</th>
                                    <th scope="col" style="text-align: right; min-width: 140px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($documents as $doc): 
                                    $docTitle = !empty($doc['title']) ? $doc['title'] : 'Technical Data Sheet';
                                    $prodName = !empty($doc['product_name']) ? $doc['product_name'] : 'HB Metals Material';
                                    $docType = !empty($doc['document_type']) ? $doc['document_type'] : 'TDS';
                                    $revision = !empty($doc['revision']) ? $doc['revision'] : 'Rev 2026.1';
                                    $fileSize = !empty($doc['file_size']) ? $doc['file_size'] : 'PDF File';
                                    $publishedAt = !empty($doc['published_at']) ? $doc['published_at'] : '';
                                ?>
                                    <tr>
                                        <td>
                                            <strong style="color: var(--color-navy); font-size: var(--text-body);"><?= Helpers::e($docTitle) ?></strong>
                                            <div style="font-size: var(--text-micro); color: var(--color-muted); font-family: var(--font-mono); margin-top: 2px;">
                                                Size: <?= Helpers::e($fileSize) ?><?= $publishedAt ? ' • Published: ' . Helpers::e($publishedAt) : '' ?>
                                            </div>
                                        </td>
                                        <td style="color: var(--color-ink); font-weight: 600; font-size: var(--text-small);"><?= Helpers::e($prodName) ?></td>
                                        <td><span class="glass-pill" style="background: rgba(28, 52, 69, 0.08); color: var(--color-navy); font-size: 0.72rem;"><?= Helpers::e($docType) ?></span></td>
                                        <td style="font-family: var(--font-mono); font-size: var(--text-small); color: var(--color-steel);"><?= Helpers::e($revision) ?></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn btn-outline btn-sm" data-open-rfq data-product="<?= Helpers::e($prodName) ?> TDS" aria-label="Request <?= Helpers::e($docTitle) ?>">
                                                Request TDS File
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div style="padding: var(--space-12); text-align: center;">
                        <p style="color: var(--color-steel); margin-bottom: var(--space-4);">No public technical data sheets are currently indexed.</p>
                        <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-primary btn-sm">Request Product Specifications</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Notice on SDS & COA (Reveal from Right) -->
            <div data-reveal="right" class="glass-card" style="margin-top: var(--space-8); background: var(--color-white); border-radius: var(--radius-md); padding: var(--space-6); border-left: 4px solid var(--color-copper); box-shadow: var(--shadow-sm);">
                <div style="display: flex; gap: var(--space-4); align-items: flex-start;">
                    <div style="width: 44px; height: 44px; border-radius: var(--radius-sm); background: rgba(184, 109, 60, 0.12); color: var(--color-copper); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">ℹ️</div>
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.2rem; margin: 0 0 var(--space-2); color: var(--color-navy); font-weight: 700;">Safety Data Sheets (SDS) &amp; Batch Certificates of Analysis (COA)</h3>
                        <p style="font-size: var(--text-small); color: var(--color-steel); line-height: 1.6; margin: 0 0 var(--space-4);">
                            In compliance with chemical safety handling regulations and commercial privacy, Certificates of Analysis (COA) are issued per individual commercial dispatch batch. Safety Data Sheets (SDS) are provided directly to verified corporate procurement and analytical laboratory contacts.
                        </p>
                        <div>
                            <a href="<?= Helpers::url('/contact-us/') ?>" class="btn btn-primary btn-sm">Request Batch COA / SDS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
