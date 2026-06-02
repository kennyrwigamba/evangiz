<?php
/**
 * Evangiz Restaurant - Single Blog Post Details
 */

// If router did not pass a slug, redirect to feed list
if (empty($blog_slug)) {
    header("Location: " . url('/blog'));
    exit;
}

// Fetch corresponding blog from database
try {
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE slug = ? LIMIT 1");
    $stmt->execute([$blog_slug]);
    $post = $stmt->fetch();
} catch (PDOException $e) {
    $post = null;
}

// If post is missing, load 404 view
if (!$post) {
    http_response_code(404);
    $page_title = 'Story Not Found - Evangiz Restaurant';
    include_once __DIR__ . '/404.php';
    exit;
}

// Dynamically override page metadata
$page_title = $post['title'] . " - Evangiz Restaurant";
$page_desc = mb_strimwidth(strip_tags($post['content']), 0, 150, '...');
$page_image = !empty($post['image_path']) ? $post['image_path'] : '';

$date = date('F d, Y', strtotime($post['created_at']));
$image = !empty($post['image_path']) ? htmlspecialchars($post['image_path']) : '';
?>

<!-- Blog Header -->
<section class="blog-header-section page-header">
    <div class="container">
        <time class="blog-post-date text-accent"><?php echo $date; ?></time>
        <h1 class="animate-fade-in" style="margin-top: var(--space-sm); font-size: clamp(2rem, 4vw, 3.25rem);"><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="breadcrumb animate-fade-in delay-100" style="margin-top: var(--space-md);">
            <a href="<?php echo url('/'); ?>">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="<?php echo url('/blog'); ?>">Blog</a>
            <span class="breadcrumb-separator">&rarr;</span>
            <span class="breadcrumb-current">Story Details</span>
        </div>
    </div>
</section>

<!-- Blog Content Viewer -->
<section class="section blog-details-wrapper">
    <div class="container blog-details-container">
        <article class="blog-post-full animate-fade-in">
            
            <!-- Blog Visual Banner -->
            <?php if (!empty($image)): ?>
                <div class="blog-post-banner">
                    <img src="<?php echo url($image); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                </div>
            <?php endif; ?>

            <!-- Content Area -->
            <div class="blog-post-body text-justify">
                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
            </div>

            <!-- Footer Navigation -->
            <div class="blog-post-footer">
                <a href="<?php echo url('/blog'); ?>" class="btn btn-secondary">
                    <span class="btn-text-wrapper">
                        <span class="btn-text-main">&larr; Back To Blog</span>
                        <span class="btn-text-hover">&larr; Back To Blog</span>
                    </span>
                </a>
            </div>

        </article>
    </div>
</section>

<!-- Blog Post Detailed Styles -->
<style>
.blog-post-date {
    font-family: var(--font-heading);
    font-size: 0.95rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.blog-details-container {
    max-width: 800px;
}

.blog-post-full {
    background-color: var(--color-bg-cream);
    border-radius: var(--radius-lg);
    border: 1px solid var(--color-border);
    box-shadow: var(--shadow-medium);
    padding: var(--space-xl);
}

.blog-post-banner {
    margin-bottom: var(--space-xl);
    border-radius: var(--radius-md);
    overflow: hidden;
    max-height: 450px;
    background-color: #eee;
}

.blog-post-banner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.blog-post-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--color-text-dark);
}

.blog-post-body p {
    margin-bottom: var(--space-lg);
}

.blog-post-footer {
    border-top: 1px solid var(--color-border);
    margin-top: var(--space-xl);
    padding-top: var(--space-lg);
    display: flex;
    justify-content: flex-start;
}

.text-justify {
    text-align: justify;
}

@media (max-width: 576px) {
    .blog-post-full {
        padding: var(--space-lg);
    }
}
</style>
