<?php
/**
 * Evangiz Restaurant - 404 Not Found Page
 */
?>

<!-- 404 Content View -->
<section class="section error-404-section flex-center" style="min-height: 70vh;">
    <div class="container text-center animate-scale-in">
        <span class="error-code text-accent">404</span>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-desc text-muted">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        <div class="error-actions" style="margin-top: var(--space-xl);">
            <?php echo render_button('Return to Home', url('/'), 'primary'); ?>
            <?php echo render_button('View Food Menu', url('/menu'), 'secondary'); ?>
        </div>
    </div>
</section>

<!-- 404 Page Custom Styles -->
<style>
.error-404-section {
    background-color: var(--color-bg-warm);
}

.error-code {
    display: block;
    font-family: var(--font-heading);
    font-size: clamp(6rem, 15vw, 10rem);
    font-weight: 700;
    line-height: 1;
    letter-spacing: -0.05em;
    margin-bottom: var(--space-xs);
    text-shadow: 0 10px 30px rgba(231, 86, 42, 0.1);
}

.error-title {
    font-size: clamp(2rem, 5vw, 3rem);
    margin-bottom: var(--space-md);
}

.error-desc {
    max-width: 500px;
    margin: 0 auto;
    font-size: 1.05rem;
}

.error-actions {
    display: flex;
    gap: var(--space-md);
    justify-content: center;
}

@media (max-width: 576px) {
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
}
</style>
