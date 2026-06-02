/**
 * Evangiz Restaurant - Viewport Scroll Reveal animations
 */

document.addEventListener('DOMContentLoaded', () => {
    const scrollRevealItems = document.querySelectorAll('.animate-scroll-reveal');

    if (scrollRevealItems.length > 0) {
        const checkScrollReveal = () => {
            // Trigger animation when the element is 85% from the top of the viewport
            const triggerPoint = window.innerHeight * 0.85;

            scrollRevealItems.forEach(item => {
                const elementTop = item.getBoundingClientRect().top;

                if (elementTop < triggerPoint) {
                    item.classList.add('active-fade');
                }
            });
        };

        // Execute once immediately to reveal above-the-fold content
        checkScrollReveal();

        // Attach lightweight scroll event listener
        window.addEventListener('scroll', checkScrollReveal);
    }
});
