/**
 * Evangiz Restaurant - Menu Categorization Filter
 */

document.addEventListener('DOMContentLoaded', () => {
    const menuTabs = document.querySelectorAll('.menu-tab');
    const menuSections = document.querySelectorAll('.menu-section');

    if (menuTabs.length > 0 && menuSections.length > 0) {
        menuTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetCategory = tab.getAttribute('data-category');

                // 1. Remove active state from all tabs and set on clicked
                menuTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // 2. Animate and toggle sections
                menuSections.forEach(section => {
                    // Start fade out transitions
                    section.style.opacity = '0';
                    section.style.transform = 'translateY(10px)';
                    section.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                    
                    setTimeout(() => {
                        if (targetCategory === 'all' || section.getAttribute('id') === `category-${targetCategory}`) {
                            section.style.display = 'block';
                            // Trigger browser reflow to run fade in
                            setTimeout(() => {
                                section.style.opacity = '1';
                                section.style.transform = 'translateY(0)';
                            }, 30);
                        } else {
                            section.style.display = 'none';
                        }
                    }, 250);
                });
            });
        });

        // Check URL hash for category selection on page load
        const checkHash = () => {
            const hash = window.location.hash.substring(1);
            if (hash) {
                const correspondingTab = Array.from(menuTabs).find(t => t.getAttribute('data-category') === hash);
                if (correspondingTab) {
                    correspondingTab.click();
                    setTimeout(() => {
                        correspondingTab.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 300);
                }
            }
        };

        checkHash();
        window.addEventListener('hashchange', checkHash);
    }
});
