<?php
/**
 * Evangiz Restaurant - Blog Feed Page
 */

$page_header_title = 'Evangiz Blog';
$page_header_image = '/image/page-header/page-header_7.jpg';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'Blog'],
];

include __DIR__ . '/../includes/page-header.php';

// Retrieve all blog posts from database
try {
    $stmt = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
    $blog_posts = $stmt->fetchAll();
} catch (PDOException $e) {
    $blog_posts = [];
}
?>

<!-- Blog List Feed -->
<section class="section blog-feed-section">
    <div class="container">
        <?php if (empty($blog_posts)): ?>
            <div class="no-posts-alert text-center">
                <h3>No Blog Stories Yet</h3>
                <p class="text-muted">We are preparing delicious content for you. Check back shortly!</p>
                <div class="mt-md">
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
<!-- Page styles moved to /css/pages/blog.css for caching & performance -->
