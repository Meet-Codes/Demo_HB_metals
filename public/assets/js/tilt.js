/**
 * HB Metals - 3D Gyro Perspective Tilt & Specular Glare
 * Inspired by United Carriers telemetry cards.
 */
document.addEventListener('DOMContentLoaded', function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    if (window.matchMedia('(hover: none) or (pointer: coarse)').matches) return;

    // Apply 3D tilt to featured product cards, quality pillars, and gradient cards
    const tiltElements = document.querySelectorAll('.product-card, .gradient-card, .tilt-card, .hero-visual-card');

    tiltElements.forEach((el) => {
        el.classList.add('tilt-card', 'telemetry-corners');

        // Create specular glare overlay if missing
        let glare = el.querySelector('.tilt-glare');
        if (!glare) {
            glare = document.createElement('div');
            glare.className = 'tilt-glare';
            el.appendChild(glare);
        }

        let rect = el.getBoundingClientRect();

        el.addEventListener('mouseenter', () => {
            rect = el.getBoundingClientRect();
            el.style.transition = 'transform 0.1s ease-out, box-shadow 0.25s ease';
            glare.style.setProperty('--glare-opacity', '1');
        });

        el.addEventListener('mousemove', (e) => {
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            // Rotate angles max ±7 degrees for subtle luxury industrial feel
            const rotateX = ((y - centerY) / centerY) * -6;
            const rotateY = ((x - centerX) / centerX) * 6;

            el.style.transform = `perspective(1000px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) translateZ(6px)`;

            // Position glare
            glare.style.setProperty('--glare-x', `${x}px`);
            glare.style.setProperty('--glare-y', `${y}px`);
        });

        el.addEventListener('mouseleave', () => {
            el.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease';
            el.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0)';
            glare.style.setProperty('--glare-opacity', '0');
        });
    });
});
