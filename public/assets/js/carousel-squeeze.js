/**
 * HB Metals - Interactive Squeeze Carousel
 * High-performance Vanilla JS implementation of SqueezeCarousel.
 * Geometry: 4 columns + slat tail, 16:9 hero card, fluid hover stretch & spring slide.
 */
document.addEventListener('DOMContentLoaded', function () {
    const root = document.getElementById('category-squeeze-carousel');
    if (!root) return;

    const dataEl = root.querySelector('[data-squeeze-slides-json]');
    if (!dataEl) return;

    let slides = [];
    try {
        slides = JSON.parse(dataEl.textContent);
    } catch (e) {
        console.error('Failed to parse squeeze slides', e);
        return;
    }

    const count = slides.length;
    if (count === 0) return;

    const wrap = (i) => ((i % count) + count) % count;
    const clamp = (val, min, max) => Math.max(min, Math.min(max, val));

    const slats = clamp(count - 4, 1, 3);
    const visible = 4 + slats;

    const SHARES = [-0.06, 0.61, 0.3, 0.15];
    const STRETCHED = [0, 0.71, 0.4, 0.25];
    const SQUEEZED = [-0.12, 0.59, 0.28, 0.13];

    let seed = 0;
    let defaultIndex = 0;
    let forward = true;
    let column = 0;
    let slid = 0;
    let still = false;
    let hover = -1;
    let paused = false;
    let ms = 900;
    let timers = [];

    const reducedQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    let reduced = reducedQuery.matches;
    reducedQuery.addEventListener('change', () => {
        reduced = reducedQuery.matches;
        ms = reduced ? 0 : 900;
    });
    if (reduced) ms = 0;

    let cards = Array.from({ length: visible }, (_, p) => ({
        key: seed++,
        slide: wrap(defaultIndex + p)
    }));

    const strip = root.querySelector('.squeeze-strip');
    const panelWrap = root.querySelector('.squeeze-panel');
    const btnPrev = root.querySelector('.squeeze-arrow-prev');
    const btnNext = root.querySelector('.squeeze-arrow-next');
    const currBadge = root.querySelector('#squeeze-curr');
    const totalBadge = root.querySelector('#squeeze-total');

    if (totalBadge) totalBadge.textContent = count;

    function shareOf(col) {
        const shares = (hover >= 0 && hover <= 3 && !reduced) ? null : SHARES;
        if (shares) return SHARES[col];
        return hover === col ? STRETCHED[col] : SQUEEZED[col];
    }

    function widthOf(col) {
        if (col < 0 || col > 3) return 'var(--sq-slat-width)';
        if (col === 0) return `calc(var(--sq-hero) + var(--sq-room) * ${shareOf(0)})`;
        return `calc(var(--sq-room) * ${shareOf(col)})`;
    }

    function getOpenIndex() {
        const card = cards[-column];
        return card ? card.slide : defaultIndex;
    }

    function updateCardsDOM() {
        if (!strip) return;
        strip.innerHTML = '';
        cards.forEach((card, place) => {
            const col = place + column;
            const slide = slides[card.slide];
            const front = (col === 0);

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.role = 'tab';
            btn.className = `squeeze-card ${front ? 'is-front' : ''}`;
            btn.setAttribute('aria-selected', front ? 'true' : 'false');
            btn.setAttribute('aria-label', slide.title || 'Slide');
            btn.tabIndex = front ? 0 : -1;

            // Geometry styling
            const w = widthOf(col);
            btn.style.width = w;
            btn.style.marginLeft = (place === 0) ? '0' : (col < 4 ? 'var(--sq-gap)' : 'var(--sq-slat-gap)');
            btn.style.borderRadius = `min(var(--sq-radius), calc(${w} / 2))`;
            btn.style.transitionDuration = still ? '0s' : `${ms}ms`;

            // Inner image
            const img = document.createElement('img');
            img.src = slide.image;
            img.alt = slide.imageAlt || slide.title;
            img.className = 'squeeze-card-img';
            img.draggable = false;
            btn.appendChild(img);

            // Overlay watermark/badge
            const overlay = document.createElement('div');
            overlay.className = 'squeeze-card-overlay';
            overlay.style.opacity = front ? '1' : '0';
            overlay.style.transition = `opacity ${ms}ms var(--sq-ease)`;
            overlay.innerHTML = `
                <span class="squeeze-tag" style="background-color: ${slide.badgeColor || '#ea580c'}">${slide.badgeText || 'Manufacturing Family'}</span>
                <span class="squeeze-overlay-title">${slide.title}</span>
            `;
            btn.appendChild(overlay);

            // Events
            btn.addEventListener('mousemove', () => {
                if (hover !== col) {
                    hover = col;
                    renderWidths();
                }
            });

            btn.addEventListener('click', () => {
                if (col > 0) {
                    step(col);
                } else if (front && slide.href) {
                    window.location.href = slide.href;
                }
            });

            strip.appendChild(btn);
        });

        // Strip transform
        const slatAndGap = 'calc(var(--sq-slat-width) + var(--sq-gap))';
        strip.style.transform = `translateX(calc(${slid} * ${slatAndGap}))`;
        strip.style.transition = still ? 'none' : `transform ${ms}ms var(--sq-ease)`;

        // Update Panel
        updatePanel(getOpenIndex());
    }

    function renderWidths() {
        const buttons = strip.querySelectorAll('.squeeze-card');
        buttons.forEach((btn, place) => {
            const col = place + column;
            const w = widthOf(col);
            btn.style.width = w;
            btn.style.borderRadius = `min(var(--sq-radius), calc(${w} / 2))`;
        });
    }

    function updatePanel(openIdx) {
        if (currBadge) currBadge.textContent = openIdx + 1;
        if (!panelWrap) return;
        const items = panelWrap.querySelectorAll('.squeeze-panel-item');
        items.forEach((item, idx) => {
            const shown = (idx === openIdx);
            item.setAttribute('aria-hidden', shown ? 'false' : 'true');
            item.style.opacity = shown ? '1' : '0';
            item.style.visibility = shown ? 'visible' : 'hidden';
            item.style.pointerEvents = shown ? 'auto' : 'none';
        });
    }

    function settle() {
        cards = forward ? cards.slice(-visible) : cards.slice(0, visible);
        column = 0;
        slid = 0;
        still = true;
        updateCardsDOM();
        requestAnimationFrame(() => {
            still = false;
        });
    }

    function step(by) {
        if (count < 2 || by === 0) return;

        timers.forEach(clearTimeout);
        timers = [];
        forward = (by > 0);

        if (by > 0) {
            const newCards = Array.from({ length: by }, (_, k) => ({
                key: seed++,
                slide: wrap(cards[cards.length - 1].slide + 1 + k)
            }));
            cards = [...cards, ...newCards];
            column -= by;
            slid -= by;
            updateCardsDOM();
        } else {
            const newCards = Array.from({ length: -by }, (_, k) => ({
                key: seed++,
                slide: wrap(cards[0].slide - (-by - k))
            }));
            cards = [...newCards, ...cards];
            slid += by;
            still = true;
            updateCardsDOM();
            timers.push(window.setTimeout(() => {
                slid = 0;
                still = false;
                updateCardsDOM();
            }, 20));
        }

        timers.push(window.setTimeout(settle, ms + 25));
    }

    // Prev / Next Buttons
    if (btnPrev) {
        btnPrev.addEventListener('click', () => step(-1));
    }
    if (btnNext) {
        btnNext.addEventListener('click', () => step(1));
    }

    // Keyboard support
    root.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') {
            e.preventDefault();
            step(1);
        } else if (e.key === 'ArrowLeft') {
            e.preventDefault();
            step(-1);
        }
    });

    // Hover container pauses autoplay and restores regular widths on leave
    root.addEventListener('mouseenter', () => { paused = true; });
    root.addEventListener('mouseleave', () => {
        paused = false;
        hover = -1;
        renderWidths();
    });

    // Autoplay timer
    setInterval(() => {
        if (!paused && !reduced && count > 1) {
            step(1);
        }
    }, 6000);

    // Initial render
    updateCardsDOM();
});
