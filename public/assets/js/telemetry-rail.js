/**
 * HB Metals - Sticky Chapter Telemetry Rail
 * Inspired by Mont-Fort: vertical chapter tracker with active dot and smooth scroll.
 */
document.addEventListener('DOMContentLoaded', function () {
    if (window.innerWidth <= 1024) return;

    const chapters = [
        { id: 'hero-slider-section', label: '01 // Overview' },
        { id: 'section-principles', label: '02 // Quality Pillars' },
        { id: 'section-featured', label: '03 // Products' },
        { id: 'section-categories', label: '04 // Squeeze Carousel' },
        { id: 'section-setup', label: '05 // Manufacturing' },
        { id: 'section-faq', label: '06 // Technical FAQ' },
    ];

    // Check if at least 3 chapters exist on this page
    const validChapters = chapters.filter(c => document.getElementById(c.id));
    if (validChapters.length < 3) return;

    // Create Rail DOM
    const rail = document.createElement('nav');
    rail.className = 'chapter-rail';
    rail.setAttribute('aria-label', 'Section Chapters Navigation');

    validChapters.forEach((chapter, index) => {
        const item = document.createElement('button');
        item.type = 'button';
        item.className = `chapter-rail-item ${index === 0 ? 'is-active' : ''}`;
        item.setAttribute('aria-label', `Navigate to ${chapter.label}`);
        item.setAttribute('data-target-id', chapter.id);

        item.innerHTML = `
            <span class="chapter-rail-dot"></span>
            <span class="chapter-rail-tooltip">${chapter.label}</span>
        `;

        item.addEventListener('click', () => {
            const target = document.getElementById(chapter.id);
            if (target) {
                if (window.lenis) {
                    window.lenis.scrollTo(target, { duration: 1.2 });
                } else {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });

        rail.appendChild(item);
    });

    document.body.appendChild(rail);

    // Fade rail in after scrolling past first 100px
    function updateRailVisibility() {
        if (window.scrollY > 150) {
            rail.classList.add('is-visible');
        } else {
            rail.classList.remove('is-visible');
        }
    }
    window.addEventListener('scroll', updateRailVisibility, { passive: true });
    updateRailVisibility();

    // IntersectionObserver to highlight active chapter
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.id;
                rail.querySelectorAll('.chapter-rail-item').forEach(btn => {
                    if (btn.getAttribute('data-target-id') === id) {
                        btn.classList.add('is-active');
                    } else {
                        btn.classList.remove('is-active');
                    }
                });
            }
        });
    }, {
        threshold: 0.35,
        rootMargin: '-10% 0px -40% 0px'
    });

    validChapters.forEach(c => {
        const el = document.getElementById(c.id);
        if (el) observer.observe(el);
    });
});
