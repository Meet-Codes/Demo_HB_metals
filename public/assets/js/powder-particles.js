/**
 * HB Metals - Ambient Powder Particle Simulation
 * Inspired by Mont-Fort WebGL atmosphere & GTA VI particle floaters.
 * Simulates micro-fined metallic dust (copper & tungsten flecks) drifting in light.
 */
document.addEventListener('DOMContentLoaded', function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const hero = document.getElementById('hero-slider-section');
    if (!hero) return;

    const bgMorph = hero.querySelector('.hero-bg-morph') || hero;
    const canvas = document.createElement('canvas');
    canvas.className = 'powder-particles-canvas';
    bgMorph.appendChild(canvas);

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let width = (canvas.width = hero.offsetWidth);
    let height = (canvas.height = hero.offsetHeight);

    window.addEventListener('resize', () => {
        width = canvas.width = hero.offsetWidth;
        height = canvas.height = hero.offsetHeight;
    });

    const particleCount = Math.min(Math.floor(width / 24), 55);
    const particles = [];

    let mouseX = width / 2;
    let mouseY = height / 2;

    hero.addEventListener('mousemove', (e) => {
        const rect = hero.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
    });

    // Particle colors: Magnesium silver, Tungsten white, Copper gold
    const colors = [
        'rgba(184, 109, 60, ',   // Copper
        'rgba(244, 232, 225, ',  // White-copper
        'rgba(160, 180, 194, ',  // Steel-tungsten
        'rgba(255, 215, 170, '   // Bright shimmer
    ];

    for (let i = 0; i < particleCount; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 2.2 + 0.8,
            color: colors[Math.floor(Math.random() * colors.length)],
            alpha: Math.random() * 0.6 + 0.2,
            baseAlpha: Math.random() * 0.6 + 0.2,
            vx: (Math.random() - 0.5) * 0.45,
            vy: -Math.random() * 0.5 - 0.15, // upward gentle drift
            pulseSpeed: Math.random() * 0.02 + 0.01
        });
    }

    let pulse = 0;

    function animate() {
        ctx.clearRect(0, 0, width, height);
        pulse += 0.02;

        particles.forEach((p) => {
            p.x += p.vx;
            p.y += p.vy;

            // Repulsion from mouse pointer
            const dx = p.x - mouseX;
            const dy = p.y - mouseY;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 120 && dist > 0) {
                const force = (120 - dist) / 120;
                p.x += (dx / dist) * force * 1.5;
                p.y += (dy / dist) * force * 1.5;
            }

            // Wrap around edges
            if (p.y < 0) p.y = height;
            if (p.x < 0) p.x = width;
            if (p.x > width) p.x = 0;

            const alpha = p.baseAlpha + Math.sin(pulse * p.pulseSpeed * 10) * 0.2;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = p.color + Math.max(0.05, Math.min(1, alpha)) + ')';
            ctx.shadowBlur = 8;
            ctx.shadowColor = p.color + '0.6)';
            ctx.fill();
        });

        requestAnimationFrame(animate);
    }

    animate();
});
