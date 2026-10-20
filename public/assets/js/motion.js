/**
 * HB Metals India - Motion, Kinetic Typography & Telemetry Counters
 * Inspired by Mont-Fort and United Carriers.
 */
document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Reveal on scroll
    const revealElements = document.querySelectorAll('.reveal-on-scroll, .split-mask-inner');
    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealElements.forEach(el => el.classList.add('is-revealed', 'is-active'));
    } else {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed', 'is-active');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px',
        });

        revealElements.forEach(el => observer.observe(el));
    }

    // 2. Telemetry Numeric Counters (United Carriers / Mont-Fort)
    const counters = document.querySelectorAll('[data-counter]');
    if (counters.length > 0) {
        if (prefersReducedMotion) {
            counters.forEach(c => { c.textContent = c.getAttribute('data-counter'); });
            return;
        }

        const counterObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    obs.unobserve(el);

                    const targetVal = parseFloat(el.getAttribute('data-counter') || '0');
                    const prefix = el.getAttribute('data-counter-prefix') || '';
                    const suffix = el.getAttribute('data-counter-suffix') || '';
                    const duration = 1600;
                    const startTime = performance.now();

                    function updateCount(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        // EaseOutExpo curve
                        const easeProgress = (progress === 1) ? 1 : 1 - Math.pow(2, -10 * progress);
                        const current = Math.floor(easeProgress * targetVal);

                        el.textContent = `${prefix}${current}${suffix}`;

                        if (progress < 1) {
                            requestAnimationFrame(updateCount);
                        } else {
                            el.textContent = `${prefix}${targetVal}${suffix}`;
                        }
                    }

                    requestAnimationFrame(updateCount);
                }
            });
        }, { threshold: 0.25 });

        counters.forEach(c => counterObserver.observe(c));
    }
});
