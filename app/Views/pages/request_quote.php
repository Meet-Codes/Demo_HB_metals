<?php
use App\Support\Helpers;
use App\Support\Csrf;

$formErrors = $_SESSION['form_errors'] ?? [];
$formOld = $_SESSION['form_old'] ?? [];
$formError = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_errors'], $_SESSION['form_old'], $_SESSION['form_error']);
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D CONTRACT ENGINE // B2B COMMERCIAL ALLOCATION]" style="color: var(--color-white); padding: var(--space-16) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%);">
    <div class="container" data-reveal="left" style="position: relative; z-index: 2;">
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(184, 109, 60, 0.4); background: rgba(184, 109, 60, 0.15); color: #e59f71;">Commercial Quotation</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">Request a <span class="metallic-shimmer">Commercial Quotation</span></span>
        </h1>
        <p style="color: #b5c8d5; max-width: 680px; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            Provide your required product, quantity, target specification, and delivery destination. Our commercial team will prepare a formal price offer with delivery lead time.
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: transparent;">
    <div class="container" style="max-width: 880px;">
        <div class="glass-card" data-reveal="bottom" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--space-8); box-shadow: var(--shadow-md);">
            <div style="margin-bottom: var(--space-6); border-bottom: 1px solid var(--color-line); padding-bottom: var(--space-4); display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: var(--space-2);">
                <div>
                    <h2 style="font-size: 1.45rem; margin: 0 0 4px; color: var(--color-navy); font-weight: 700;">Formal Request for Quotation (RFQ)</h2>
                    <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0;">Standard Minimum Order Quantity (MOQ) is 25 Kilogram for most chemical powders and salts.</p>
                </div>
                <span class="glass-pill" style="background: rgba(184, 109, 60, 0.1); color: var(--color-copper); font-size: 0.75rem; font-weight: 700;">MOQ: 25 Kg</span>
            </div>

            <?php if ($formError): ?>
                <div class="alert alert-error" style="margin-bottom: var(--space-4);"><?= Helpers::e($formError) ?></div>
            <?php endif; ?>

            <form action="<?= Helpers::url('/rfq-submit/') ?>" method="POST" enctype="multipart/form-data" data-ajax="true">
                <?= Csrf::field() ?>
                <!-- Anti-spam honeypot -->
                <input type="text" name="website_url_hp" style="display:none !important;" tabindex="-1" autocomplete="off">
                <input type="hidden" name="return_url" value="/request-a-quote/">

                <div style="background: var(--color-paper); padding: var(--space-3) var(--space-4); border-radius: var(--radius-sm); border-left: 3px solid var(--color-copper); margin-bottom: var(--space-4);">
                    <h3 style="font-size: 1.05rem; color: var(--color-navy); margin: 0; font-weight: 700;">1. Material &amp; Specification Parameters</h3>
                </div>

                <div class="grid-2" style="gap: var(--space-4); margin-bottom: var(--space-4);">
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_product_name" class="form-label" style="font-weight: 600; color: var(--color-navy);">Product Selection <span class="required" style="color: var(--color-error);">*</span></label>
                        <select id="rfq_product_name" name="product_name" class="form-select" required>
                            <option value="">-- Select Product From Portfolio --</option>
                            <?php foreach ($products as $p): ?>
                                <option value="<?= Helpers::e($p['name']) ?>" <?= ($preselectedProduct === $p['name'] || ($formOld['product_name'] ?? '') === $p['name']) ? 'selected' : '' ?>>
                                    <?= Helpers::e($p['name']) ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="Custom Chemical Compound / Unlisted">Custom Chemical Compound / Unlisted</option>
                        </select>
                        <?php if (!empty($formErrors['product_name'])): ?>
                            <div class="form-error"><?= Helpers::e($formErrors['product_name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: var(--space-2);">
                        <div class="form-group" style="margin: 0;">
                            <label for="rfq_quantity" class="form-label" style="font-weight: 600; color: var(--color-navy);">Required Volume</label>
                            <input type="number" step="any" min="1" id="rfq_quantity" name="quantity" class="form-control" value="<?= Helpers::e($formOld['quantity'] ?? '') ?>" placeholder="e.g. 500">
                        </div>
                        <div class="form-group" style="margin: 0;">
                            <label for="rfq_quantity_unit" class="form-label" style="font-weight: 600; color: var(--color-navy);">Unit</label>
                            <select id="rfq_quantity_unit" name="quantity_unit" class="form-select">
                                <option value="Kilogram">Kilogram (Kg)</option>
                                <option value="Metric Ton">Metric Ton</option>
                                <option value="Drums">Drums (25Kg)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid-2" style="gap: var(--space-4); margin-bottom: var(--space-4);">
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_grade" class="form-label" style="font-weight: 600; color: var(--color-navy);">Requested Purity / Grade</label>
                        <input type="text" id="rfq_grade" name="grade" class="form-control" value="<?= Helpers::e($formOld['grade'] ?? '') ?>" placeholder="e.g. 99.5% Min, Analytical Grade">
                    </div>
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_packaging" class="form-label" style="font-weight: 600; color: var(--color-navy);">Packaging Standard</label>
                        <select id="rfq_packaging" name="packaging" class="form-select">
                            <option value="25 Kg Standard Sealed Drum">25 Kg Standard Sealed Drum (Recommended)</option>
                            <option value="50 Kg Iron / Fiber Drum">50 Kg Iron / Fiber Drum</option>
                            <option value="Custom Palletized Drums">Custom Palletized Drums</option>
                            <option value="Specialized Small Packaging">Specialized Small Packaging</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label for="rfq_destination" class="form-label" style="font-weight: 600; color: var(--color-navy);">Delivery Destination (City / Port / CIF Port of Entry)</label>
                    <input type="text" id="rfq_destination" name="destination" class="form-control" value="<?= Helpers::e($formOld['destination'] ?? '') ?>" placeholder="e.g. Mundra Port / JNPT / Nhava Sheva / Ahmedabad Works">
                </div>

                <div class="form-group" style="margin-bottom: var(--space-6);">
                    <label for="rfq_attachment" class="form-label" style="font-weight: 600; color: var(--color-navy);">Specification Sheet / Purchase Tender Document (Optional, Max 10MB)</label>
                    <input type="file" id="rfq_attachment" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png,.txt">
                    <div class="form-hint" style="font-size: var(--text-micro); color: var(--color-muted); margin-top: 4px;">Accepted formats: PDF, Word, JPG, PNG, TXT. Attach your specific chemical parameter targets.</div>
                    <?php if (!empty($formErrors['attachment'])): ?>
                        <div class="form-error"><?= Helpers::e($formErrors['attachment']) ?></div>
                    <?php endif; ?>
                </div>

                <div style="background: var(--color-paper); padding: var(--space-3) var(--space-4); border-radius: var(--radius-sm); border-left: 3px solid var(--color-navy); margin-bottom: var(--space-4);">
                    <h3 style="font-size: 1.05rem; color: var(--color-navy); margin: 0; font-weight: 700;">2. Commercial Contact Details</h3>
                </div>

                <div class="grid-2" style="gap: var(--space-4); margin-bottom: var(--space-4);">
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_name" class="form-label" style="font-weight: 600; color: var(--color-navy);">Contact Person <span class="required" style="color: var(--color-error);">*</span></label>
                        <input type="text" id="rfq_name" name="name" class="form-control" required value="<?= Helpers::e($formOld['name'] ?? '') ?>" placeholder="Full Name">
                        <?php if (!empty($formErrors['name'])): ?>
                            <div class="form-error"><?= Helpers::e($formErrors['name']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_company" class="form-label" style="font-weight: 600; color: var(--color-navy);">Company / Corporate Entity</label>
                        <input type="text" id="rfq_company" name="company_name" class="form-control" value="<?= Helpers::e($formOld['company_name'] ?? '') ?>" placeholder="Organization / Factory Name">
                    </div>
                </div>

                <div class="grid-2" style="gap: var(--space-4); margin-bottom: var(--space-4);">
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_email" class="form-label" style="font-weight: 600; color: var(--color-navy);">Corporate Email <span class="required" style="color: var(--color-error);">*</span></label>
                        <input type="email" id="rfq_email" name="email" class="form-control" required value="<?= Helpers::e($formOld['email'] ?? '') ?>" placeholder="purchasing@company.com">
                        <?php if (!empty($formErrors['email'])): ?>
                            <div class="form-error"><?= Helpers::e($formErrors['email']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group" style="margin: 0;">
                        <label for="rfq_phone" class="form-label" style="font-weight: 600; color: var(--color-navy);">Phone / Mobile / WhatsApp <span class="required" style="color: var(--color-error);">*</span></label>
                        <input type="tel" id="rfq_phone" name="phone" class="form-control" required value="<?= Helpers::e($formOld['phone'] ?? '') ?>" placeholder="+91 98984 49394">
                        <?php if (!empty($formErrors['phone'])): ?>
                            <div class="form-error"><?= Helpers::e($formErrors['phone']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label for="rfq_message" class="form-label" style="font-weight: 600; color: var(--color-navy);">Specific Requirements, Mesh Size or Delivery Timeline <span class="required" style="color: var(--color-error);">*</span></label>
                    <textarea id="rfq_message" name="message" class="form-textarea" rows="4" required placeholder="Specify any requirements regarding mesh size, analytical limits, delivery deadlines, or payment terms..."><?= Helpers::e($formOld['message'] ?? '') ?></textarea>
                    <?php if (!empty($formErrors['message'])): ?>
                        <div class="form-error"><?= Helpers::e($formErrors['message']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: var(--space-6);">
                    <label class="form-checkbox-label" style="font-size: var(--text-small); color: var(--color-steel); display: flex; align-items: flex-start; gap: var(--space-2);">
                        <input type="checkbox" name="privacy" value="1" required style="margin-top: 3px;">
                        <span>I confirm that the submitted commercial requirements are genuine and authorize HB Metals India to provide formal price and dispatch estimates.</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Submit Commercial RFQ</button>
            </form>
        </div>
    </div>
</section>
