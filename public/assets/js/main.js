/**
 * HB Metals India - Main Application JS
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Dithered Footer Interactive Spotlight
    const band = document.getElementById('footer-df-band');
    const field = document.getElementById('footer-df-field');

    if (band && field) {
        let frame = 0;
        band.addEventListener('pointermove', (e) => {
            if (e.pointerType !== 'mouse') return;
            const r = field.getBoundingClientRect();
            const x = e.clientX - r.left;
            const y = e.clientY - r.top;
            cancelAnimationFrame(frame);
            frame = requestAnimationFrame(() => {
                field.style.setProperty('--df-x', `${x}px`);
                field.style.setProperty('--df-y', `${y}px`);
                field.classList.add('df-lit');
            });
        });

        band.addEventListener('pointerleave', () => {
            cancelAnimationFrame(frame);
            field.classList.remove('df-lit');
        });
    }

    console.log('HB Metals India application initialized.');
});

/**
 * Handle Footer Newsletter Subscribe
 */
function handleFooterSubscribe(e) {
    e.preventDefault();
    const input = document.getElementById('df-email');
    const btn = document.getElementById('df-btn-submit');
    const msg = document.getElementById('df-status-msg');

    if (!input || !input.value) return;

    btn.disabled = true;
    btn.textContent = 'Subscribing…';

    setTimeout(() => {
        btn.disabled = false;
        btn.textContent = 'Subscribed ✓';
        if (msg) {
            msg.textContent = "Thank you. You will receive technical lot bulletins and specification updates.";
        }
        input.value = '';

        setTimeout(() => {
            btn.textContent = 'Subscribe';
        }, 3500);
    }, 600);
}

window.handleFooterSubscribe = handleFooterSubscribe;
