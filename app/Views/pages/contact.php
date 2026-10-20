<?php
use App\Support\Helpers;
use App\Support\Csrf;

$formErrors = $_SESSION['form_errors'] ?? [];
$formOld = $_SESSION['form_old'] ?? [];
$formError = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_errors'], $_SESSION['form_old'], $_SESSION['form_error']);
?>

<div class="section-3d-hud is-dark" data-3d-hud="[3D GEO-DISPATCH COMM // SHAPAR INDUSTRIAL NODE]" style="color: var(--color-white); padding: var(--space-16) 0; position: relative; overflow: hidden; background: linear-gradient(135deg, var(--color-ink) 0%, var(--color-navy) 100%);">
    <div class="container" data-reveal="left" style="position: relative; z-index: 2;">
        <span class="glass-pill" style="margin-bottom: var(--space-3); border-color: rgba(184, 109, 60, 0.4); background: rgba(184, 109, 60, 0.15); color: #e59f71;">Direct Works Communication</span>
        <h1 class="split-mask-wrap" style="color: var(--color-white); margin-bottom: var(--space-3); font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.02em;">
            <span class="split-mask-inner">Contact <span class="metallic-shimmer">HB Metals India</span></span>
        </h1>
        <p style="color: #b5c8d5; max-width: 680px; font-size: var(--text-body-lg); line-height: 1.6; margin: 0;">
            Speak directly with our managing office or technical support in Shapar, Rajkot for product inquiries, commercial orders, and dispatch schedules.
        </p>
    </div>
</div>

<section style="padding: var(--space-16) 0; background: transparent;">
    <div class="container">
        <div class="grid-2" style="gap: var(--space-10); align-items: flex-start;">
            <!-- Left: Contact Details (Reveal from Left) -->
            <div data-reveal="left">
                <span class="glass-pill" style="margin-bottom: var(--space-3); background: rgba(255, 255, 255, 0.12); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.2);">Plant &amp; Sales Desk</span>
                <h2 style="font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 800; color: #ffffff; margin-bottom: var(--space-3); letter-spacing: -0.01em;">
                    Works &amp; Administrative Contacts
                </h2>
                <p style="color: #ffffff; font-size: var(--text-body); line-height: 1.6; margin-bottom: var(--space-6); opacity: 0.95;">
                    Whether you require analytical specifications, delivery timelines, or containerized export terms, our executive team is readily accessible.
                </p>

                <div style="display: flex; flex-direction: column; gap: var(--space-4);">
                    <div class="glass-card" style="background: var(--color-white); padding: var(--space-5); border-radius: var(--radius-md); display: flex; gap: var(--space-4); align-items: flex-start;">
                        <div style="width: 46px; height: 46px; border-radius: var(--radius-sm); background: rgba(184, 109, 60, 0.12); color: var(--color-copper); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">👤</div>
                        <div>
                            <div style="font-size: var(--text-micro); text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--font-mono); color: var(--color-muted); font-weight: 600;">Executive Leadership</div>
                            <h4 style="font-size: 1.15rem; margin: 2px 0 4px; color: var(--color-navy); font-weight: 700;">Mr. Anil Patel</h4>
                            <p style="margin: 0; font-size: var(--text-small); color: var(--color-steel);">Managing Director • Commercial Operations &amp; Strategy</p>
                        </div>
                    </div>

                    <div class="glass-card" style="background: var(--color-white); padding: var(--space-5); border-radius: var(--radius-md); display: flex; gap: var(--space-4); align-items: flex-start;">
                        <div style="width: 46px; height: 46px; border-radius: var(--radius-sm); background: rgba(184, 109, 60, 0.12); color: var(--color-copper); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📞</div>
                        <div>
                            <div style="font-size: var(--text-micro); text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--font-mono); color: var(--color-muted); font-weight: 600;">Telephone / WhatsApp</div>
                            <p style="margin: 2px 0 4px;">
                                <a href="tel:<?= Helpers::e($settings['phone']) ?>" style="font-size: 1.2rem; font-weight: 800; color: var(--color-copper); text-decoration: none; font-family: var(--font-mono);">
                                    <?= Helpers::e($settings['phone_display']) ?>
                                </a>
                            </p>
                            <p style="margin: 0; font-size: var(--text-small); color: var(--color-muted);">Operating Mon–Sat, 09:00 to 18:30 IST</p>
                        </div>
                    </div>

                    <div class="glass-card" style="background: var(--color-white); padding: var(--space-5); border-radius: var(--radius-md); display: flex; gap: var(--space-4); align-items: flex-start;">
                        <div style="width: 46px; height: 46px; border-radius: var(--radius-sm); background: rgba(184, 109, 60, 0.12); color: var(--color-copper); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">✉️</div>
                        <div>
                            <div style="font-size: var(--text-micro); text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--font-mono); color: var(--color-muted); font-weight: 600;">Electronic Dispatch</div>
                            <p style="margin: 2px 0 4px;">
                                <a href="mailto:<?= Helpers::e($settings['email']) ?>" style="font-size: 1.05rem; font-weight: 700; color: var(--color-navy); text-decoration: none; font-family: var(--font-mono);">
                                    <?= Helpers::e($settings['email']) ?>
                                </a>
                            </p>
                            <p style="margin: 0; font-size: var(--text-small); color: var(--color-muted);">Formal quotation requests, purchase orders &amp; COA verifications</p>
                        </div>
                    </div>

                    <div class="glass-card" style="background: var(--color-white); padding: var(--space-5); border-radius: var(--radius-md); display: flex; gap: var(--space-4); align-items: flex-start;">
                        <div style="width: 46px; height: 46px; border-radius: var(--radius-sm); background: rgba(184, 109, 60, 0.12); color: var(--color-copper); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">📍</div>
                        <div>
                            <div style="font-size: var(--text-micro); text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--font-mono); color: var(--color-muted); font-weight: 600;">Works &amp; Registered Facility</div>
                            <p style="margin: 2px 0 0; color: var(--color-ink); line-height: 1.6; font-size: var(--text-small);">
                                <strong><?= Helpers::e($settings['address_line_1']) ?></strong><br>
                                <?= Helpers::e($settings['address_line_2']) ?><br>
                                <?= Helpers::e($settings['city']) ?> - <?= Helpers::e($settings['postal_code']) ?>, <?= Helpers::e($settings['state']) ?>, India.
                            </p>
                            <div style="font-size: 0.76rem; color: var(--color-muted); margin-top: 6px; font-family: var(--font-mono);">
                                PIN Code: 360030 (Shapar, Tal. Lodhika)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form (Reveal from Right) -->
            <div data-reveal="right" class="glass-card" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--space-8); box-shadow: var(--shadow-md);">
                <div style="border-bottom: 1px solid var(--color-line); padding-bottom: var(--space-4); margin-bottom: var(--space-6);">
                    <h3 style="margin: 0 0 var(--space-2); font-size: 1.35rem; color: var(--color-navy); font-weight: 700;">Submit an Online Enquiry</h3>
                    <p style="font-size: var(--text-small); color: var(--color-steel); margin: 0;">
                        Submit your technical or commercial inquiry below. Our sales desk acknowledges all requests within 24 business hours.
                    </p>
                </div>

                <?php if ($formError): ?>
                    <div class="alert alert-error" style="margin-bottom: var(--space-4);"><?= Helpers::e($formError) ?></div>
                <?php endif; ?>

                <form action="<?= Helpers::url('/contact-submit/') ?>" method="POST" data-ajax="true">
                    <?= Csrf::field() ?>
                    <!-- Anti-spam honeypot -->
                    <input type="text" name="website_url_hp" style="display:none !important;" tabindex="-1" autocomplete="off">

                    <div class="form-group" style="margin-bottom: var(--space-4);">
                        <label for="contact_name" class="form-label" style="font-weight: 600; color: var(--color-navy);">Full Name <span class="required" style="color: var(--color-error);">*</span></label>
                        <input type="text" id="contact_name" name="name" class="form-control" required value="<?= Helpers::e($formOld['name'] ?? '') ?>" placeholder="e.g. Rajesh Kumar">
                        <?php if (!empty($formErrors['name'])): ?>
                            <div class="form-error"><?= Helpers::e($formErrors['name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="grid-2" style="gap: var(--space-4); margin-bottom: var(--space-4);">
                        <div class="form-group" style="margin: 0;">
                            <label for="contact_email" class="form-label" style="font-weight: 600; color: var(--color-navy);">Email Address <span class="required" style="color: var(--color-error);">*</span></label>
                            <input type="email" id="contact_email" name="email" class="form-control" required value="<?= Helpers::e($formOld['email'] ?? '') ?>" placeholder="name@domain.com">
                            <?php if (!empty($formErrors['email'])): ?>
                                <div class="form-error"><?= Helpers::e($formErrors['email']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group" style="margin: 0;">
                            <label for="contact_phone" class="form-label" style="font-weight: 600; color: var(--color-navy);">Phone Number <span class="required" style="color: var(--color-error);">*</span></label>
                            <input type="tel" id="contact_phone" name="phone" class="form-control" required value="<?= Helpers::e($formOld['phone'] ?? '') ?>" placeholder="+91 98984 49394">
                            <?php if (!empty($formErrors['phone'])): ?>
                                <div class="form-error"><?= Helpers::e($formErrors['phone']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: var(--space-4);">
                        <label for="contact_message" class="form-label" style="font-weight: 600; color: var(--color-navy);">Message / Specification Requirement <span class="required" style="color: var(--color-error);">*</span></label>
                        <textarea id="contact_message" name="message" class="form-textarea" rows="4" required placeholder="Describe your product requirement, target purity, volume, or delivery timeline..."><?= Helpers::e($formOld['message'] ?? '') ?></textarea>
                        <?php if (!empty($formErrors['message'])): ?>
                            <div class="form-error"><?= Helpers::e($formErrors['message']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group" style="margin-bottom: var(--space-6);">
                        <label class="form-checkbox-label" style="font-size: var(--text-small); color: var(--color-steel); display: flex; align-items: flex-start; gap: var(--space-2);">
                            <input type="checkbox" name="privacy" value="1" required style="margin-top: 3px;">
                            <span>I acknowledge that my contact data will be used to process this commercial enquiry.</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Send Commercial Inquiry</button>
                </form>
            </div>
        </div>

        <!-- Google Map Embed Section -->
        <div class="glass-card reveal-on-scroll" style="margin-top: var(--space-16); border-radius: var(--radius-lg); overflow: hidden; padding: 0; background: var(--color-white); box-shadow: var(--shadow-sm);">
            <div style="padding: var(--space-4) var(--space-6); background: var(--color-white); border-bottom: 1px solid var(--color-line); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 700; color: var(--color-navy); font-size: var(--text-small);">📍 Shapar Industrial Area, Rajkot — Works Facility</span>
                <a href="https://maps.google.com/?q=HB+Metals+India+Shapar+Rajkot" target="_blank" rel="noopener noreferrer" style="color: var(--color-copper); font-size: var(--text-micro); font-weight: 700; text-decoration: none; text-transform: uppercase;">Open in Google Maps &rarr;</a>
            </div>
            <iframe src="<?= Helpers::e($settings['map_embed_url']) ?>"
                    width="100%"
                    height="420"
                    style="border:0; display:block;"
                    allowfullscreen=""
                    loading="lazy"
                    title="HB Metals Rajkot Facility Map Location">
            </iframe>
        </div>
    </div>
</section>
