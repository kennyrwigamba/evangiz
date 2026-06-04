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

$page_header_title = $post['title'];
$page_header_image = $image ?: '/image/page-header/slide-index-2.jpg';
$page_header_meta = '<div class="blog-meta animate-fade-in"><span class="blog-meta-item"><i class="hgi-stroke hgi-calendar-01"></i> ' . $date . '</span><span class="blog-meta-divider">•</span><span class="blog-meta-item"><i class="hgi-stroke hgi-user-circle"></i> By Evangiz Team</span></div>';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'Blog', 'href' => url('/blog')],
    ['label' => 'Story Details'],
];
$page_header_extra_classes = 'blog-header-section';
$page_header_title_class = 'animate-fade-in blog-post-title-main';
$page_header_title_style = 'margin-top: var(--space-sm);';
$page_header_breadcrumb_style = 'margin-top: var(--space-md);';

include __DIR__ . '/../includes/page-header.php';
?>

<!-- Blog Content Viewer -->
<section class="section blog-details-wrapper">
    <div class="container blog-details-container">
        <article class="blog-post-full animate-fade-in">
            
            <!-- Content Area -->
            <div class="blog-post-body text-justify">
                <?php 
                $paragraphs = explode("\n\n", $post['content']);
                $first = true;
                foreach ($paragraphs as $para) {
                    $para = trim($para);
                    if (empty($para)) continue;
                    if ($first) {
                        echo '<p class="lead-paragraph">' . nl2br(htmlspecialchars($para)) . '</p>';
                        $first = false;
                    } else {
                        echo '<p>' . nl2br(htmlspecialchars($para)) . '</p>';
                    }
                }
                ?>
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

.blog-meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: var(--space-md);
    margin-bottom: var(--space-sm);
    color: var(--color-white);
    opacity: 0.95;
    font-family: var(--font-heading);
    font-size: 0.9rem;
    font-weight: 500;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.blog-meta-item {
    display: inline-flex;
    align-items: center;
    gap: var(--space-xs);
}

.blog-meta-item i {
    font-size: 1.05rem;
    color: var(--color-secondary);
}

.blog-meta-divider {
    color: var(--color-secondary);
    font-weight: 700;
}

.blog-post-title-main {
    font-size: clamp(2.25rem, 5vw, 3.5rem);
    max-width: 900px;
    margin: var(--space-sm) auto 0;
    line-height: 1.2;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    color: var(--color-white);
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

.blog-post-body {
    font-size: 1.1rem;
    line-height: 1.85;
    color: var(--color-text-dark);
}

.blog-post-body p {
    margin-bottom: var(--space-lg);
}

.lead-paragraph {
    font-size: 1.25rem;
    color: var(--color-primary-light);
    line-height: 1.85;
    font-weight: 500;
    margin-bottom: var(--space-lg);
}

.lead-paragraph::first-letter {
    font-family: var(--font-serif);
    font-size: 4rem;
    font-weight: 700;
    float: left;
    line-height: 0.85;
    margin-right: 12px;
    margin-top: 4px;
    color: var(--color-accent);
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
