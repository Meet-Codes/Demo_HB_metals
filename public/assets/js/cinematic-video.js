/**
 * HB Metals India - Cinematic Video Motion Background & Multi-Sided 3D Reveal Engine
 * Features:
 * - Dynamic scroll-scrubbed & velocity-accelerated video playback
 * - 3D Camera tilt & perspective zoom synced with scroll progression
 * - Multi-sided directional reveal engine (Left, Right, Top, Bottom, Split, 3D Zoom, Stagger)
 * - Cinema Focus Mode with background showcase
 * - Live HUD telemetry, timecode generator, and scroll gauge
 */
(function () {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Scroll state tracking
    let scrollY = window.scrollY || window.pageYOffset || 0;
    let lastScrollY = scrollY;
    let scrollVelocity = 0;
    let smoothVelocity = 0;
    let ticking = false;

    // Mouse coordinates for 3D gyro tilt
    let mouseX = 0;
    let mouseY = 0;
    let targetTiltX = 0;
    let targetTiltY = 0;
    let currentTiltX = 0;
    let currentTiltY = 0;

    document.addEventListener('DOMContentLoaded', () => {
        initVideoBackdrop();
        initMultiSidedReveals();
        initCinematicHud();
        initInteractiveControls();
        initMouseTracking();
        initScrollLoop();
    });

    // =========================================================================
    // 1. Video Backdrop & Scroll-Driven Velocity Engine
    // =========================================================================
    let videoEl = null;
    let flareEl = null;
    let scrollFillEl = null;
    let reelPercentEl = null;

    function initVideoBackdrop() {
        videoEl = document.querySelector('.cinematic-video-player');
        flareEl = document.querySelector('.cinematic-horizon-flare');
        scrollFillEl = document.querySelector('.cinematic-scroll-fill');
        reelPercentEl = document.querySelector('[data-hud-reel]');

        if (!videoEl) return;

        // Ensure proper attributes for uninterrupted video background
        videoEl.muted = true;
        videoEl.playsInline = true;
        videoEl.loop = true;
        videoEl.autoplay = true;

        // Try playing immediately
        const startPlayback = () => {
            if (videoEl && videoEl.paused) {
                videoEl.play().catch(() => {});
            }
        };

        const playPromise = videoEl.play();
        if (playPromise !== undefined) {
            playPromise.catch(() => {
                // Autoplay blocked by browser policy: play on first user interaction
                const onFirstInteraction = () => {
                    startPlayback();
                    window.removeEventListener('scroll', onFirstInteraction);
                    window.removeEventListener('click', onFirstInteraction);
                    window.removeEventListener('touchstart', onFirstInteraction);
                    window.removeEventListener('pointerdown', onFirstInteraction);
                };
                window.addEventListener('scroll', onFirstInteraction, { passive: true });
                window.addEventListener('click', onFirstInteraction, { passive: true });
                window.addEventListener('touchstart', onFirstInteraction, { passive: true });
                window.addEventListener('pointerdown', onFirstInteraction, { passive: true });
            });
        }

        // Resume video when returning to foreground
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                startPlayback();
            }
        });

    // =========================================================================
    // 2. Continuous Animation & 3D Perspective Loop
    // =========================================================================
    function initScrollLoop() {
        function updateMotion() {
            scrollY = window.scrollY || window.pageYOffset || 0;
            scrollVelocity = scrollY - lastScrollY;
            lastScrollY = scrollY;

            // Smooth linear interpolation for velocity
            smoothVelocity += (scrollVelocity - smoothVelocity) * 0.12;

            const docHeight = Math.max(document.body.scrollHeight - window.innerHeight, 1);
            const scrollProgress = Math.min(Math.max(scrollY / docHeight, 0), 1);

            // 1. Modulate Video Playback Rate based on scroll momentum
            if (videoEl && !prefersReducedMotion && !videoEl.paused) {
                const baseRate = 1.0;
                const dynamicRate = baseRate + Math.min(Math.abs(smoothVelocity) * 0.05, 1.8);
                videoEl.playbackRate = dynamicRate;

                // 2. 3D Camera Perspective Pan & Scale
                currentTiltX += (targetTiltX - currentTiltX) * 0.08;
                currentTiltY += (targetTiltY - currentTiltY) * 0.08;

                const scale = 1.05 + scrollProgress * 0.14;
                const translateY = (scrollProgress * -25);

                videoEl.style.transform = `translate(-50%, -50%) perspective(1200px) rotateX(${currentTiltX.toFixed(2)}deg) rotateY(${currentTiltY.toFixed(2)}deg) scale(${scale.toFixed(3)}) translateY(${translateY.toFixed(1)}px)`;
            }

            // 3. Update Flare position
            if (flareEl && !prefersReducedMotion) {
                const flareY = (0.2 + scrollProgress * 0.6) * 100;
                flareEl.style.top = `${flareY}%`;
                flareEl.style.opacity = `${0.45 + Math.min(Math.abs(smoothVelocity) * 0.03, 0.5)}`;
            }

            // 4. Update Scroll Telemetry Gauge
            if (scrollFillEl) {
                scrollFillEl.style.height = `${(scrollProgress * 100).toFixed(1)}%`;
            }
            if (reelPercentEl) {
                reelPercentEl.textContent = `${Math.round(scrollProgress * 100)}%`;
            }

            requestAnimationFrame(updateMotion);
        }

        requestAnimationFrame(updateMotion);
    }

    // Track mouse for subtle 3D cinematic camera parallax
    function initMouseTracking() {
        if (prefersReducedMotion) return;

        window.addEventListener('mousemove', (e) => {
            const normX = (e.clientX / window.innerWidth) * 2 - 1;
            const normY = (e.clientY / window.innerHeight) * 2 - 1;

            targetTiltX = -normY * 4.5; // Max 4.5deg tilt
            targetTiltY = normX * 4.5;
        }, { passive: true });
    }

    // =========================================================================
    // 3. Multi-Sided 3D Scroll Reveal Engine
    // =========================================================================
    function initMultiSidedReveals() {
        const revealElements = document.querySelectorAll('[data-reveal]');

        if (prefersReducedMotion || !('IntersectionObserver' in window)) {
            revealElements.forEach(el => el.classList.add('is-revealed'));
            return;
        }

        const revealObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.14,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));

        // Automatic side-alternating for standard grid sections if not explicitly assigned
        const autoSplitGrids = document.querySelectorAll('.grid-2:not([data-reveal]), .grid-3:not([data-reveal]), .features-grid:not([data-reveal])');
        autoSplitGrids.forEach(grid => {
            const children = Array.from(grid.children);
            children.forEach((child, idx) => {
                if (!child.hasAttribute('data-reveal')) {
                    const side = idx % 2 === 0 ? 'left' : 'right';
                    child.setAttribute('data-reveal', side);
                    revealObserver.observe(child);
                }
            });
        });
    }

    // =========================================================================
    // 4. Cinematic Live Telemetry & Timecode
    // =========================================================================
    function initCinematicHud() {
        const timecodeEl = document.querySelector('[data-hud-timecode]');
        if (!timecodeEl) return;

        let frame = 0;
        let seconds = 12;
        let minutes = 4;

        setInterval(() => {
            frame++;
            if (frame >= 30) {
                frame = 0;
                seconds++;
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                }
            }
            const mm = String(minutes).padStart(2, '0');
            const ss = String(seconds).padStart(2, '0');
            const ff = String(frame).padStart(2, '0');
            timecodeEl.textContent = `REC 00:${mm}:${ss}:${ff}`;
        }, 1000 / 30);
    }

    // =========================================================================
    // 5. Interactive Cinematic Controls Widget
    // =========================================================================
    function initInteractiveControls() {
        const playBtn = document.querySelector('[data-ctrl-play]');
        const cinemaBtn = document.querySelector('[data-ctrl-cinema]');
        const hudToggleBtn = document.querySelector('[data-ctrl-hud]');
        const hudLayer = document.querySelector('.cinematic-hud-layer');
        const exitHint = document.querySelector('.cinema-exit-hint');

        // Play/Pause Video
        if (playBtn && videoEl) {
            playBtn.addEventListener('click', () => {
                if (videoEl.paused) {
                    videoEl.play();
                    playBtn.innerHTML = `<span>⏸</span> PAUSE`;
                    playBtn.classList.remove('is-active');
                } else {
                    videoEl.pause();
                    playBtn.innerHTML = `<span>▶</span> PLAY`;
                    playBtn.classList.add('is-active');
                }
            });
        }

        // Cinema Focus Mode (Dims text to appreciate 4K background video)
        function toggleCinemaMode() {
            const isCinema = document.body.classList.toggle('cinema-focus-mode');
            if (cinemaBtn) {
                cinemaBtn.classList.toggle('is-active', isCinema);
                cinemaBtn.innerHTML = isCinema ? `<span>👁</span> EXIT FOCUS` : `<span>👁</span> CINEMA`;
            }
        }

        if (cinemaBtn) {
            cinemaBtn.addEventListener('click', toggleCinemaMode);
        }

        if (exitHint) {
            exitHint.addEventListener('click', toggleCinemaMode);
        }

        // Exit cinema mode on Escape key
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && document.body.classList.contains('cinema-focus-mode')) {
                toggleCinemaMode();
            }
        });

        // Toggle Telemetry HUD
        if (hudToggleBtn && hudLayer) {
            hudToggleBtn.addEventListener('click', () => {
                const isHidden = hudLayer.style.display === 'none';
                hudLayer.style.display = isHidden ? 'flex' : 'none';
                hudToggleBtn.classList.toggle('is-active', !isHidden);
            });
        }
    }
})();
