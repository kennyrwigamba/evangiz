<?php
/**
 * Evangiz Restaurant - 404 Not Found Page
 */
?>

<!-- 404 Content View -->
<section class="section error-404-section flex-center">
    <div class="container text-center animate-scale-in">
        <span class="error-code text-accent">404</span>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-desc text-muted">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        <div class="error-actions mt-xl">
            <?php echo render_button('Return to Home', url('/'), 'primary'); ?>
            <?php echo render_button('View Food Menu', url('/menu'), 'secondary'); ?>
        </div>
    </div>
</section>

<!-- 404 Page Custom Styles -->
<!-- Page styles moved to /css/pages/404.css for caching & performance -->
