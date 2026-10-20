/**
 * HB Metals India - Accessible Navigation & Menu Controller
 */

document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.site-header');
    const menuToggle = document.querySelector('.menu-toggle-btn');
    const primaryNav = document.querySelector('.primary-nav');
    const dropdownTriggers = document.querySelectorAll('.has-dropdown');

    // iPhone iOS Action Sheet Elements
    const moreTrigger = document.getElementById('ios-more-trigger');
    const sheetBackdrop = document.getElementById('ios-sheet-backdrop');
    const sheetPanel = document.getElementById('ios-sheet-panel');
    const sheetCloseBtn = document.getElementById('ios-sheet-close');
    const sheetGrabber = document.getElementById('ios-sheet-grabber');

    // 1. Sticky header background transition on scroll
    const handleScroll = () => {
        if (window.scrollY > 30) {
            header?.classList.add('is-scrolled');
        } else {
            header?.classList.remove('is-scrolled');
        }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    // 2. iPhone iOS Action Sheet Open / Close Handlers
    const openIosSheet = () => {
        if (!sheetBackdrop) return;
        sheetBackdrop.classList.add('is-open');
        sheetBackdrop.setAttribute('aria-hidden', 'false');
        moreTrigger?.setAttribute('aria-expanded', 'true');
        menuToggle?.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        if (window.lenis) window.lenis.stop();
    };

    const closeIosSheet = () => {
        if (!sheetBackdrop) return;
        sheetBackdrop.classList.remove('is-open');
        sheetBackdrop.setAttribute('aria-hidden', 'true');
        moreTrigger?.setAttribute('aria-expanded', 'false');
        menuToggle?.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        if (window.lenis) {
            window.lenis.start();
            window.lenis.resize();
        }
    };

    if (moreTrigger) {
        moreTrigger.addEventListener('click', openIosSheet);
    }

    if (sheetCloseBtn) {
        sheetCloseBtn.addEventListener('click', closeIosSheet);
    }

    if (sheetBackdrop) {
        // Tap backdrop to dismiss
        sheetBackdrop.addEventListener('click', (e) => {
            if (e.target === sheetBackdrop) {
                closeIosSheet();
            }
        });
    }

    // Swipe down to dismiss on grabber
    if (sheetGrabber && sheetPanel) {
        let startY = 0;
        let currentY = 0;

        sheetGrabber.addEventListener('touchstart', (e) => {
            startY = e.touches[0].clientY;
        }, { passive: true });

        sheetGrabber.addEventListener('touchmove', (e) => {
            currentY = e.touches[0].clientY;
            const diff = currentY - startY;
            if (diff > 0) {
                sheetPanel.style.transform = `translateY(${diff}px)`;
            }
        }, { passive: true });

        sheetGrabber.addEventListener('touchend', () => {
            const diff = currentY - startY;
            if (diff > 80) {
                closeIosSheet();
            }
            sheetPanel.style.transform = '';
            startY = 0;
            currentY = 0;
        });
    }

    // 3. Mobile & Tablet Header Menu Toggle -> Opens iOS Sheet on touch devices
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            if (window.innerWidth < 1024 && sheetBackdrop) {
                openIosSheet();
            } else if (primaryNav) {
                const isOpen = primaryNav.classList.toggle('is-open');
                menuToggle.setAttribute('aria-expanded', String(isOpen));
                menuToggle.innerHTML = isOpen ? '✕' : '☰';
                document.body.style.overflow = isOpen ? 'hidden' : '';
            }
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (sheetBackdrop && sheetBackdrop.classList.contains('is-open')) {
                closeIosSheet();
            } else if (primaryNav && primaryNav.classList.contains('is-open')) {
                primaryNav.classList.remove('is-open');
                menuToggle?.setAttribute('aria-expanded', 'false');
                if (menuToggle) menuToggle.innerHTML = '☰';
                document.body.style.overflow = '';
            }
        }
    });

    // 4. Mobile & Tablet Submenu Toggle
    dropdownTriggers.forEach((item) => {
        const link = item.querySelector('.nav-link');
        link?.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                e.preventDefault();
                const isExpanded = item.classList.toggle('is-expanded');
                link.setAttribute('aria-expanded', String(isExpanded));
            }
        });
    });
});
