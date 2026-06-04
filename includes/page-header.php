<?php
$page_header_title = $page_header_title ?? '';
$page_header_image = $page_header_image ?? '';
$page_header_breadcrumbs = $page_header_breadcrumbs ?? [];
$page_header_meta = $page_header_meta ?? '';
$page_header_extra_classes = $page_header_extra_classes ?? '';
$page_header_title_class = $page_header_title_class ?? 'animate-fade-in';
$page_header_title_style = $page_header_title_style ?? '';
$page_header_breadcrumb_style = $page_header_breadcrumb_style ?? '';
?>

<section class="page-header <?php echo htmlspecialchars($page_header_extra_classes); ?>" style="background-image: url('<?php echo url($page_header_image); ?>');">
    <div class="container">
        <?php echo $page_header_meta; ?>
        <h1 class="<?php echo htmlspecialchars($page_header_title_class); ?>" style="<?php echo htmlspecialchars($page_header_title_style); ?>"><?php echo htmlspecialchars($page_header_title); ?></h1>
        <?php if (!empty($page_header_breadcrumbs)): ?>
            <div class="breadcrumb animate-fade-in delay-100" style="<?php echo htmlspecialchars($page_header_breadcrumb_style); ?>">
                <?php foreach ($page_header_breadcrumbs as $index => $crumb): ?>
                    <?php if ($index > 0): ?>
                        <span class="breadcrumb-separator">/</span>
                    <?php endif; ?>
                    <?php if (!empty($crumb['href'])): ?>
                        <a href="<?php echo $crumb['href']; ?>"><?php echo htmlspecialchars($crumb['label']); ?></a>
                    <?php else: ?>
                        <span class="breadcrumb-current"><?php echo htmlspecialchars($crumb['label']); ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- Brush Stroke Divider -->
    <div class="custom-shape-divider-bottom" aria-hidden="true">
        <svg viewBox="0 0 1200 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C80,18 160,38 240,28 C320,18 380,42 460,32 C560,20 620,36 700,26 C780,16 860,40 940,30 C1020,20 1100,38 1200,24 L1200,50 L0,50 Z" class="shape-fill" opacity="0.7"></path>
            <path d="M0,34 C100,22 200,42 300,30 C420,16 500,44 600,30 C720,14 820,44 920,32 C1020,22 1120,40 1200,28 L1200,50 L0,50 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>