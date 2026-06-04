/**
 * Evangiz Restaurant - Global Scripts (Main)
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggler
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const navMenu = document.getElementById('navbar-menu-container');
    const dropdownParent = document.querySelector('.nav-item.dropdown');
    const dropdownToggle = document.querySelector('.nav-dropdown-toggle');

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
});
