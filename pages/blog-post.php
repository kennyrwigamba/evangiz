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
<!-- Page styles moved to /css/pages/blog-post.css for caching & performance -->
