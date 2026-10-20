/**
 * HB Metals - Adaptive Magnetic Cursor System
 * Inspired by Mont-Fort: micro-dot, spring-lag outer ring, magnetic snap, carousel pill mode.
 */
(function () {
    if (window.matchMedia('(hover: none) or (pointer: coarse)').matches) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    let mouseX = -100;
    let mouseY = -100;
    let ringX = -100;
    let ringY = -100;
    let isHovering = false;
    let isCarousel = false;

    // Create cursor elements
    const dot = document.createElement('div');
    dot.className = 'custom-cursor-dot is-hidden';

    const ring = document.createElement('div');
    ring.className = 'custom-cursor-ring is-hidden';

    document.body.appendChild(dot);
    document.body.appendChild(ring);

    // Track mouse
    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        dot.classList.remove('is-hidden');
        ring.classList.remove('is-hidden');

        dot.style.left = `${mouseX}px`;
        dot.style.top = `${mouseY}px`;
    });

    // Detect leave window
    document.addEventListener('mouseleave', () => {
        dot.classList.add('is-hidden');
        ring.classList.add('is-hidden');
    });

    // Animation Loop with fluid spring lerp
    function render() {
        const lerpFactor = isHovering ? 0.22 : 0.16;
        ringX += (mouseX - ringX) * lerpFactor;
        ringY += (mouseY - ringY) * lerpFactor;

        ring.style.left = `${ringX}px`;
        ring.style.top = `${ringY}px`;

        requestAnimationFrame(render);
    }
    requestAnimationFrame(render);

    // Event delegation for hover states and magnetic targets
    document.addEventListener('mouseover', (e) => {
        const target = e.target;
        
        // Squeeze Carousel drag state
        const carousel = target.closest('#category-squeeze-carousel, .squeeze-viewport');
        if (carousel) {
            isCarousel = true;
            ring.classList.add('is-carousel');
            return;
        }

        // Interactive links, buttons, and cards
        const interactive = target.closest('a, button, [role="button"], input, select, textarea, .btn, .product-card, .gradient-card, .hero-feature-item');
        if (interactive) {
            isHovering = true;
            ring.classList.add('is-hovering');
        }
    });

    document.addEventListener('mouseout', (e) => {
        const target = e.target;
        const carousel = target.closest('#category-squeeze-carousel, .squeeze-viewport');
        if (carousel && !e.relatedTarget?.closest('#category-squeeze-carousel, .squeeze-viewport')) {
            isCarousel = false;
            ring.classList.remove('is-carousel');
        }

        const interactive = target.closest('a, button, [role="button"], input, select, textarea, .btn, .product-card, .gradient-card, .hero-feature-item');
        if (interactive && !e.relatedTarget?.closest('a, button, [role="button"], input, select, textarea, .btn, .product-card, .gradient-card, .hero-feature-item')) {
            isHovering = false;
            ring.classList.remove('is-hovering');
        }
    });
})();
