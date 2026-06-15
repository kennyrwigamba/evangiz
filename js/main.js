/**
 * Evangiz Restaurant - Global Scripts (Main)
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggler
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const navMenu = document.getElementById('navbar-menu-container');
    const dropdownParent = document.querySelector('.nav-item.dropdown');
    const dropdownToggle = document.querySelector('.nav-dropdown-toggle');
    const bookNavLink = document.getElementById('book-nav-link');

    const syncBookingNavState = () => {
        if (!bookNavLink || window.location.hash !== '#booking') {
            return;
        }

        document.querySelectorAll('.navbar-menu .nav-link.active').forEach((link) => {
            link.classList.remove('active');
        });
        bookNavLink.classList.add('active');
    };

    syncBookingNavState();
    window.addEventListener('hashchange', syncBookingNavState);

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu if clicking outside of the navigation wrapper
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });

        // Close menu when resizing beyond mobile viewports
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
                if (dropdownParent) {
                    dropdownParent.classList.remove('open');
                }
                if (dropdownToggle) {
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                }
            }
        });
    }

    if (dropdownToggle && dropdownParent) {
        dropdownToggle.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                e.stopPropagation();
                const isOpen = dropdownParent.classList.toggle('open');
                dropdownToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            }
        });
    }

    // 3. Lazy-load <video> elements only when they scroll into view.
    //    Markup uses <source data-src="..."> + preload="none" so the (heavy)
    //    video file is never fetched during the initial page load.
    const lazyVideos = document.querySelectorAll('video.welcome-video, video[data-lazy]');
    if (lazyVideos.length) {
        const loadVideo = (video) => {
            video.querySelectorAll('source[data-src]').forEach((source) => {
                source.src = source.dataset.src;
                source.removeAttribute('data-src');
            });
            video.load();
            const playAttempt = video.play();
            if (playAttempt && typeof playAttempt.catch === 'function') {
                playAttempt.catch(() => {}); // ignore autoplay rejection
            }
        };

        if ('IntersectionObserver' in window) {
            const vObserver = new IntersectionObserver((entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        loadVideo(entry.target);
                        obs.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '200px' });
            lazyVideos.forEach((v) => vObserver.observe(v));
        } else {
            lazyVideos.forEach(loadVideo); // fallback: load immediately
        }
    }
});
