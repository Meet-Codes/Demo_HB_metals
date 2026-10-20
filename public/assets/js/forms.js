/**
 * HB Metals India - Form Handling, Modal & Accordion Controller
 */

document.addEventListener('DOMContentLoaded', () => {
    // =========================================================================
    // 1. FAQ Accordions
    // =========================================================================
    const accordions = document.querySelectorAll('.accordion-trigger');
    accordions.forEach((btn) => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.accordion-item');
            const isCurrentlyOpen = item.classList.contains('is-open');

            // Optionally close others in the same group
            const group = item.closest('.accordion');
            group?.querySelectorAll('.accordion-item').forEach((other) => {
                other.classList.remove('is-open');
                other.querySelector('.accordion-trigger')?.setAttribute('aria-expanded', 'false');
            });

            if (!isCurrentlyOpen) {
                item.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // =========================================================================
    // 2. Global RFQ Modal Management
    // =========================================================================
    const modalOverlay = document.getElementById('rfqModal');
    const modalCloseBtn = modalOverlay?.querySelector('.modal-close');
    const modalProductInput = document.getElementById('modal_product_name');
    const quoteTriggers = document.querySelectorAll('[data-open-rfq]');

    const openModal = (productName = '') => {
        if (!modalOverlay) return;
        if (modalProductInput && productName) {
            modalProductInput.value = productName;
        }
        modalOverlay.classList.add('is-active');
        document.body.style.overflow = 'hidden';
        if (window.lenis) window.lenis.stop();
        modalOverlay.querySelector('input:not([type="hidden"])')?.focus();
    };

    const closeModal = () => {
        if (!modalOverlay) return;
        modalOverlay.classList.remove('is-active');
        document.body.style.overflow = '';
        if (window.lenis) {
            window.lenis.start();
            window.lenis.resize();
        }
    };

    quoteTriggers.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const product = btn.getAttribute('data-product') || '';
            openModal(product);
        });
    });

    modalCloseBtn?.addEventListener('click', closeModal);
    modalOverlay?.addEventListener('click', (e) => {
        if (e.target === modalOverlay) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalOverlay?.classList.contains('is-active')) {
            closeModal();
        }
    });

    // =========================================================================
    // 3. AJAX Form Submission with Progressive Enhancement
    // =========================================================================
    const ajaxForms = document.querySelectorAll('form[data-ajax="true"]');
    ajaxForms.forEach((form) => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerText : 'Submit';
            const alertBox = form.querySelector('.form-feedback') || document.createElement('div');
            alertBox.className = 'form-feedback';
            form.prepend(alertBox);

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerText = 'Transmitting...';
            }

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alertBox.className = 'form-feedback alert alert-success';
                    alertBox.innerHTML = `<strong>Success!</strong> ${data.message}`;
                    form.reset();
                    if (data.redirect) {
                        setTimeout(() => { window.location.href = data.redirect; }, 1000);
                    }
                } else {
                    alertBox.className = 'form-feedback alert alert-error';
                    alertBox.innerHTML = `<strong>Submission Error:</strong> ${data.message || 'Please check the required fields.'}`;
                }
            } catch (err) {
                alertBox.className = 'form-feedback alert alert-error';
                alertBox.innerHTML = `<strong>Notice:</strong> Network transmission error. Please email us directly at info@hbmetals.co.in or call 9898449394.`;
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerText = originalBtnText;
                }
            }
        });
    });
});
