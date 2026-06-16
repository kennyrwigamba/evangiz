<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // --- Resolve SEO values (single source of truth for the tags below) ---
    $seo_title = isset($page_title) ? $page_title : "Evangiz Restaurant - A Taste You'll Remember";
    $seo_desc  = isset($page_desc) ? $page_desc : "Welcome to Evangiz Restaurant along Kampala-Entebbe Road in Lubowa. We serve premium fast food, local dishes, and professional catering services.";
    $seo_keywords = !empty($page_keywords) ? $page_keywords : 'Evangiz Restaurant, Ugandan food, restaurant along Kampala-Entebbe Road, outside catering, catering services in Uganda';

    // Absolute canonical URL on the production domain (uses the public request
    // path, not the internal routing key).
    $seo_canonical = site_url(isset($canonical_path) ? $canonical_path : (isset($path) ? $path : '/'));

    // OpenGraph/Twitter image must be an absolute URL. Fall back to a real hero.
    $seo_image_raw = !empty($page_image) ? $page_image : '/image/page-header/page-header_5.jpg';
    $seo_image = preg_match('#^https?://#i', $seo_image_raw) ? $seo_image_raw : site_url($seo_image_raw);

    // Blog posts are articles; everything else is a website.
    $seo_og_type = (isset($path) && $path === '/blog-post') ? 'article' : 'website';
    ?>

    <!-- Dynamic Server-Side SEO Tags -->
    <title><?php echo htmlspecialchars($seo_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($seo_keywords); ?>">
    <meta name="author" content="Evangiz Restaurant">
    <link rel="canonical" href="<?php echo htmlspecialchars($seo_canonical); ?>">
    <?php if (!empty($page_noindex)): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <?php endif; ?>

    <!-- OpenGraph Tags for Social Previews -->
    <meta property="og:site_name" content="Evangiz Restaurant">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <meta property="og:type" content="<?php echo $seo_og_type; ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($seo_canonical); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($seo_image); ?>">
    <meta property="og:image:alt" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo_desc); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($seo_image); ?>">
    <meta name="twitter:image:alt" content="<?php echo htmlspecialchars($seo_title); ?>">

    <meta name="theme-color" content="#0b1325">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-19ZYWVPNZB"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-19ZYWVPNZB');
    </script>

    <?php if (!empty($page_lcp_image)): ?>
    <!-- Preload the Largest Contentful Paint image to speed up first render -->
    <link rel="preload" as="image" href="<?php echo url($page_lcp_image); ?>" fetchpriority="high">
    <?php endif; ?>

    <!-- Google Fonts: preconnect + non-render-blocking load (print-media swap) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;700&family=Outfit:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;700&family=Outfit:wght@300;400;500;600;700&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;700&family=Outfit:wght@300;400;500;600;700&display=swap"></noscript>

    <!-- Icon font: loaded non-render-blocking -->
    <link rel="stylesheet" href="https://use.hugeicons.com/font/icons.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://use.hugeicons.com/font/icons.css"></noscript>

    <!-- CSS Design System and Stylesheets -->
    <link rel="stylesheet" href="<?php echo url('/css/main.css'); ?>?v=<?php echo filemtime(__DIR__ . '/../css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/layout.css'); ?>?v=<?php echo filemtime(__DIR__ . '/../css/layout.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/components.css'); ?>?v=<?php echo filemtime(__DIR__ . '/../css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/animations.css'); ?>?v=<?php echo filemtime(__DIR__ . '/../css/animations.css'); ?>">

    <?php
    // Per-page stylesheet extracted from inline <style> blocks (cached separately).
    if (!empty($page_css)):
        $page_css_path = __DIR__ . '/../css/pages/' . $page_css . '.css';
        if (is_file($page_css_path)):
    ?>
    <link rel="stylesheet" href="<?php echo url('/css/pages/' . $page_css . '.css'); ?>?v=<?php echo filemtime($page_css_path); ?>">
    <?php endif; endif; ?>

    <link rel="shortcut icon" href="<?php echo url('/image/logo/favicon.png'); ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo url('/image/logo/favicon.png'); ?>">
</head>
<body>
    <div id="site-wrapper">
