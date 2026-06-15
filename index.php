<?php
/**
 * Evangiz Restaurant - Front Controller Router
 */

// Load core configuration and database setup
require_once __DIR__ . '/config.php';

// Parse standard URI requests
$request = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($request);
$path = $parsed_url['path'] ?? '/';

// Support running in subdirectory on local or production servers
$base_dir = dirname($_SERVER['SCRIPT_NAME']);
$base_dir = str_replace('\\', '/', $base_dir); // Normalize windows separators
if ($base_dir !== '/') {
    if (strpos($path, $base_dir) === 0) {
        $path = substr($path, strlen($base_dir));
    }
}

// Normalize trailing slashes (except root)
$path = '/' . trim($path, '/');

// Public-facing URL path for canonical/OG/sitemap. This stays the real request
// URL even when $path is later rewritten to an internal routing key (e.g. blog
// posts route to '/blog-post'). '/home' collapses to '/' to avoid duplicates.
$canonical_path = ($path === '/home') ? '/' : $path;

// Serve the XML sitemap dynamically so newly published blog posts are included
// automatically. Reachable at /sitemap.xml (referenced from robots.txt).
if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');

    $urls = [
        ['loc' => '/',        'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => '/menu',    'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => '/catering','priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => '/services','priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => '/about',   'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => '/contact', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => '/blog',    'priority' => '0.7', 'changefreq' => 'weekly'],
    ];

    // Append published blog posts (most recent first).
    try {
        $blog_stmt = $conn->query("SELECT slug, updated_at, created_at FROM blogs ORDER BY created_at DESC");
        foreach ($blog_stmt->fetchAll() as $b) {
            if (empty($b['slug'])) {
                continue;
            }
            $ts = !empty($b['updated_at']) ? $b['updated_at'] : ($b['created_at'] ?? null);
            $urls[] = [
                'loc' => '/blog/' . $b['slug'],
                'priority' => '0.5',
                'changefreq' => 'monthly',
                'lastmod' => $ts ? date('Y-m-d', strtotime($ts)) : null,
            ];
        }
    } catch (PDOException $e) {
        // If the blogs table is unavailable, still emit the static URLs.
    }

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        echo "  <url>\n";
        echo '    <loc>' . htmlspecialchars(site_url($u['loc'])) . "</loc>\n";
        if (!empty($u['lastmod'])) {
            echo '    <lastmod>' . $u['lastmod'] . "</lastmod>\n";
        }
        echo '    <changefreq>' . $u['changefreq'] . "</changefreq>\n";
        echo '    <priority>' . $u['priority'] . "</priority>\n";
        echo "  </url>\n";
    }
    echo '</urlset>' . "\n";
    exit;
}

// Handle contact form submissions before rendering layout HTML.
// This prevents "headers already sent" warnings and ensures AJAX gets pure JSON.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $path === '/contact') {
    include __DIR__ . '/pages/contact.php';
    exit;
}

// Extract slugs for blog posts (e.g. /blog/post-slug -> route to blog-post page)
$blog_slug = null;
if (strpos($path, '/blog/') === 0 && strlen($path) > 6) {
    $blog_slug = substr($path, 6);
    $path = '/blog-post';
}

// Global Routing Table
$routes = [
    '/' => [
        'file' => 'pages/home.php',
        'title' => 'Evangiz Restaurant - A Taste You\'ll Remember',
        'desc' => 'Evangiz Restaurant offers delicious locally-sourced Ugandan cuisine and premium fast foods in Lubowa, Kampala-Entebbe Road.'
    ],
    '/home' => [
        'file' => 'pages/home.php',
        'title' => 'Evangiz Restaurant - A Taste You\'ll Remember',
        'desc' => 'Evangiz Restaurant offers delicious locally-sourced Ugandan cuisine and premium fast foods in Lubowa, Kampala-Entebbe Road.'
    ],
    '/menu' => [
        'file' => 'pages/menu.php',
        'title' => 'Menu - Evangiz Restaurant Lubowa',
        'desc' => 'Explore the Evangiz Restaurant menu: fresh fast foods, burgers, fried chicken, local Ugandan staples, snacks, and soft drinks.'
    ],
    '/about' => [
        'file' => 'pages/about.php',
        'title' => 'About Us - Evangiz Restaurant',
        'desc' => 'Learn more about Evangiz Restaurant, our mission, commitment to fresh ingredients, and exceptional customer service.'
    ],
    '/services' => [
        'file' => 'pages/services.php',
        'title' => 'Our Services - Evangiz Restaurant',
        'desc' => 'Discover our premium services: Dine-in, Takeaway, Food Preparation, and Outside Catering for your events.'
    ],
    '/catering' => [
        'file' => 'pages/catering.php',
        'title' => 'Outside Catering Services - Evangiz Restaurant',
        'desc' => 'Premium outside catering services for corporate events, private celebrations, weddings, and gatherings along Kampala-Entebbe Road.'
    ],
    '/contact' => [
        'file' => 'pages/contact.php',
        'title' => 'Contact Us - Evangiz Restaurant',
        'desc' => 'Get in touch with Evangiz Restaurant. Make a booking, inquire about catering, or visit us along Entebbe Road.'
    ],
    '/blog' => [
        'file' => 'pages/blog.php',
        'title' => 'Blog - Evangiz Restaurant',
        'desc' => 'Stay updated with culinary stories, food recipes, and news from Evangiz Restaurant.'
    ],
    '/blog-post' => [
        'file' => 'pages/blog-post.php',
        'title' => 'Read Our Blog - Evangiz Restaurant',
        'desc' => 'Read our latest culinary posts.'
    ]
];

// Map each route to its extracted per-page stylesheet (in /css/pages/).
// Pages not listed here simply load no extra stylesheet.
$page_css_map = [
    '/'          => 'home',
    '/home'      => 'home',
    '/menu'      => 'menu',
    '/about'     => 'about',
    '/catering'  => 'catering',
    '/contact'   => 'contact',
    '/blog'      => 'blog',
    '/blog-post' => 'blog-post',
];

// Largest Contentful Paint image per route (preloaded with high priority in
// header.php). These mirror each page's hero/page-header background image.
$page_lcp_map = [
    '/'         => '/image/page-header/page-header_5.jpg',
    '/home'     => '/image/page-header/page-header_5.jpg',
    '/menu'     => '/image/page-header/page-our-menu.jpg',
    '/about'    => '/image/page-header/about-res.jpg',
    '/services' => '/image/page-header/page-private-event.jpg',
    '/catering' => '/image/page-header/page-private-event.jpg',
    '/contact'  => '/image/page-header/page-contact.jpg',
    '/blog'     => '/image/page-header/page-header_7.jpg',
];

// Check path in routing table
if (array_key_exists($path, $routes)) {
    $route = $routes[$path];
    $page_title = $route['title'];
    $page_desc = $route['desc'];
    $page_content = __DIR__ . '/' . $route['file'];
    $page_css = $page_css_map[$path] ?? null;
    $page_lcp_image = $page_lcp_map[$path] ?? null;
} else {
    // Graceful 404 handler
    http_response_code(404);
    $page_title = 'Page Not Found - Evangiz Restaurant';
    $page_desc = 'The requested page was not found.';
    $page_content = __DIR__ . '/pages/404.php';
    $page_css = '404';
    $page_noindex = true; // Don't let search engines index the 404 page.
}

// Global Components Helpers for component-based rendering
require_once __DIR__ . '/includes/components.php';

// Assemble Page Template
include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/topbar.php';
include_once __DIR__ . '/includes/navbar.php';

// Load page layout content
include $page_content;

include_once __DIR__ . '/includes/footer.php';
?>
