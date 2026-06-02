<?php
/**
 * Evangiz Restaurant - Blog Feed Page
 */

// Retrieve all blog posts from database
try {
    $stmt = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
    $blog_posts = $stmt->fetchAll();
} catch (PDOException $e) {
    $blog_posts = [];
}
?>

<!-- Page Header -->
<section class="page-header" style="background-image: url('<?php echo url("/image/page-header/slide-index-2.jpg"); ?>');">
    <div class="container">
        <h1 class="animate-fade-in">Evangiz Culinary Blog</h1>
        <div class="breadcrumb animate-fade-in delay-100">
            <a href="<?php echo url('/'); ?>">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Blog</span>
        </div>
    </div>
</section>

<!-- Blog List Feed -->
<section class="section blog-feed-section">
    <div class="container">
        <?php if (empty($blog_posts)): ?>
            <div class="no-posts-alert text-center">
                <h3>No Blog Stories Yet</h3>
                <p class="text-muted">We are preparing delicious content for you. Check back shortly!</p>
                <div style="margin-top: var(--space-md);">
                    <?php echo render_button('Back to Home', url('/'), 'primary'); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="grid-3 stagger-container">
                <?php
                foreach ($blog_posts as $post) {
                    echo render_blog_card($post);
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Inline styles for Blog layout page -->
<style>
.no-posts-alert {
    background-color: var(--color-bg-cream);
    padding: var(--space-xxl) var(--space-lg);
    border-radius: var(--radius-lg);
    border: 1px solid var(--color-border);
    max-width: 600px;
    margin: 0 auto;
    box-shadow: var(--shadow-medium);
}

.no-posts-alert h3 {
    margin-bottom: var(--space-sm);
}

.blog-feed-section {
    background-color: var(--color-bg-warm);
}
</style>
