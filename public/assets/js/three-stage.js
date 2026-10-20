/**
 * HB Metals India - Smooth Scroll & Viewport Sync Engine
 * Powered by Lenis & Native Bi-Directional Auto-Sync.
 * (Procedural stream canvas, spark embers, and 3D wireframe mesh removed per user request)
 */
(function () {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Global scroll state
    let scrollY = window.scrollY || window.pageYOffset || 0;

    // =========================================================================
    // Rock-Solid Scroll Engine (Native + Lenis Bi-Directional Auto-Sync)
    // =========================================================================
    let lenis = null;

    function initScrollEngine() {
        if (typeof Lenis !== 'undefined' && !prefersReducedMotion) {
            try {
                lenis = new Lenis({
                    duration: 1.0,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    orientation: 'vertical',
                    gestureOrientation: 'vertical',
                    smoothWheel: true,
                    smoothTouch: false, // Touch devices use native momentum
                    wheelMultiplier: 1.0,
                    touchMultiplier: 1.0,
                    autoResize: true,
                });

                // Expose globally for modals, sheets, and anchor click handlers
                window.lenis = lenis;

                lenis.on('scroll', (e) => {
                    scrollY = e.scroll;
                });

                function raf(time) {
                    if (lenis) {
                        lenis.raf(time);
                    }
                    requestAnimationFrame(raf);
                }
                requestAnimationFrame(raf);

                // Auto-refresh scroll geometry when images/DOM heights settle
                const refreshLenis = () => {
                    if (lenis) lenis.resize();
                };
                window.addEventListener('load', refreshLenis);
                window.addEventListener('resize', refreshLenis);
                window.addEventListener('orientationchange', refreshLenis);
                document.addEventListener('DOMContentLoaded', refreshLenis);

                setTimeout(refreshLenis, 500);
                setTimeout(refreshLenis, 1500);
                setTimeout(refreshLenis, 3000);

                if (window.ResizeObserver) {
                    const ro = new ResizeObserver(() => refreshLenis());
                    ro.observe(document.body);
                }
            } catch (err) {
                console.warn('Lenis virtual scroll fallback to native:', err);
            }
        }

        // Bi-directional safety sync: if user drags scrollbar, presses PgDn/Space,
        // or clicks an anchor, immediately sync Lenis target to prevent fighting/freezing.
        window.addEventListener('scroll', () => {
            const currentNative = window.scrollY || window.pageYOffset || 0;
            scrollY = currentNative;
            if (lenis && Math.abs(lenis.scroll - currentNative) > 35) {
                lenis.scrollTo(currentNative, { immediate: true });
            }
        }, { passive: true });
    }

    // Initialize Smooth Scroll Engine
    initScrollEngine();
})();
