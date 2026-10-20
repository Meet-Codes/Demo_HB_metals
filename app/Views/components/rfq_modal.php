<?php
use App\Support\Helpers;
use App\Support\Csrf;
?>

<!-- Global Request for Quotation (RFQ) Modal -->
<div class="modal-overlay" id="rfqModal" role="dialog" aria-modal="true" aria-labelledby="modalRfqTitle">
    <div class="modal-box liquid-glass">
        <div class="modal-header">
            <div>
                <span class="badge badge-copper" style="margin-bottom: 4px; font-size: 0.7rem;">Official RFQ Desk</span>
                <h3 class="modal-title" id="modalRfqTitle">Request Commercial Quotation</h3>
            </div>
            <button type="button" class="modal-close" aria-label="Close quotation dialog">✕</button>
        </div>
        <div class="modal-body">
            <form action="<?= Helpers::url('/rfq-submit/') ?>" method="POST" enctype="multipart/form-data" data-ajax="true">
                <?= Csrf::field() ?>
                <!-- Anti-spam honeypot -->
                <input type="text" name="website_url_hp" style="display:none !important;" tabindex="-1" autocomplete="off">
                <input type="hidden" name="return_url" value="<?= Helpers::e($_SERVER['REQUEST_URI'] ?? '/request-a-quote/') ?>">

                <div class="form-group">
                    <label for="modal_product_name" class="form-label">Material / Product Required <span class="required">*</span></label>
                    <input type="text" id="modal_product_name" name="product_name" class="form-control" required placeholder="e.g. Magnesium Metal Powder, Sodium Tungstate, WO3">
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:var(--space-4);">
                    <div class="form-group">
                        <label for="modal_quantity" class="form-label">Quantity</label>
                        <input type="number" step="any" min="1" id="modal_quantity" name="quantity" class="form-control" placeholder="e.g. 50">
                    </div>
                    <div class="form-group">
                        <label for="modal_quantity_unit" class="form-label">Unit</label>
                        <select id="modal_quantity_unit" name="quantity_unit" class="form-select">
                            <option value="Kilogram">Kilogram (Kg) [MOQ: 25 Kg]</option>
                            <option value="Metric Ton">Metric Ton (MT)</option>
                            <option value="Drums">Drums (Heavy Duty)</option>
                        </select>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:var(--space-4);">
                    <div class="form-group">
                        <label for="modal_name" class="form-label">Your Name <span class="required">*</span></label>
                        <input type="text" id="modal_name" name="name" class="form-control" required placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="modal_company" class="form-label">Company Name</label>
                        <input type="text" id="modal_company" name="company_name" class="form-control" placeholder="Organization / Industry">
                    </div>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:var(--space-4);">
                    <div class="form-group">
                        <label for="modal_email" class="form-label">Email Address <span class="required">*</span></label>
                        <input type="email" id="modal_email" name="email" class="form-control" required placeholder="procurement@company.com">
                    </div>
                    <div class="form-group">
                        <label for="modal_phone" class="form-label">Phone / WhatsApp <span class="required">*</span></label>
                        <input type="tel" id="modal_phone" name="phone" class="form-control" required placeholder="+91 98984 49394">
                    </div>
                </div>

                <div class="form-group">
                    <label for="modal_destination" class="form-label">Delivery Destination / Port</label>
                    <input type="text" id="modal_destination" name="destination" class="form-control" placeholder="e.g. Mundra Port, Mumbai, Ahmedabad, Export destination">
                </div>

                <div class="form-group">
                    <label for="modal_message" class="form-label">Specifications &amp; Target Mesh/Grade <span class="required">*</span></label>
                    <textarea id="modal_message" name="message" class="form-textarea" required placeholder="Specify purity requirements, particle sizing, mesh size, application, target schedule or custom packaging..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-checkbox-label">
                        <input type="checkbox" name="privacy" value="1" required checked>
                        <span>I confirm that this is a genuine commercial inquiry and authorize HB Metals India to provide formal price and dispatch terms.</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width:100%;">Transmit Commercial RFQ</button>
            </form>
        </div>
    </div>
</div>
