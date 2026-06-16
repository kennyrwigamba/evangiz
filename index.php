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
    $static_lastmod = date('Y-m-d', filemtime(__FILE__));

    $urls = [
        ['loc' => '/',         'priority' => '1.0', 'changefreq' => 'weekly', 'lastmod' => $static_lastmod],
        ['loc' => '/menu',     'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $static_lastmod],
        ['loc' => '/catering', 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $static_lastmod],
        ['loc' => '/services', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $static_lastmod],
        ['loc' => '/about',    'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $static_lastmod],
        ['loc' => '/contact',  'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $static_lastmod],
        ['loc' => '/blog',     'priority' => '0.6', 'changefreq' => 'weekly', 'lastmod' => $static_lastmod],
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
    include SRC_PATH . '/pages/contact.php';
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
        'title' => 'Evangiz Restaurant Lubowa | Ugandan Food & Catering on Entebbe Road',
        'desc' => 'Visit Evangiz Restaurant in Lubowa on Kampala-Entebbe Road for Ugandan food, fast foods, family dining, takeaway, and outside catering services in Uganda.',
        'keywords' => 'Evangiz Restaurant, restaurant along Kampala-Entebbe Road, Ugandan food, restaurant in Uganda, family dining, outside catering',
        'image' => '/image/page-header/page-header_5.jpg',
    ],
    '/home' => [
        'file' => 'pages/home.php',
        'title' => 'Evangiz Restaurant Lubowa | Ugandan Food & Catering on Entebbe Road',
        'desc' => 'Visit Evangiz Restaurant in Lubowa on Kampala-Entebbe Road for Ugandan food, fast foods, family dining, takeaway, and outside catering services in Uganda.',
        'keywords' => 'Evangiz Restaurant, restaurant along Kampala-Entebbe Road, Ugandan food, restaurant in Uganda, family dining, outside catering',
        'image' => '/image/page-header/page-header_5.jpg',
    ],
    '/menu' => [
        'file' => 'pages/menu.php',
        'title' => 'Evangiz Menu | Ugandan Food, Fast Foods & Drinks in Lubowa',
        'desc' => 'Explore the Evangiz Restaurant menu with local Ugandan dishes, burgers, fried chicken, snacks, light meals, soft drinks, and family dining near Entebbe Road.',
        'keywords' => 'Evangiz menu, Ugandan food menu, fast foods Lubowa, local dishes Entebbe Road, restaurant menu Uganda',
        'image' => '/image/page-header/page-our-menu.jpg',
    ],
    '/about' => [
        'file' => 'pages/about.php',
        'title' => 'About Evangiz Restaurant | Fresh Ugandan Dining in Lubowa',
        'desc' => 'Learn about Evangiz Restaurant, our fresh ingredients, Ugandan food heritage, family dining experience, and hospitality along Kampala-Entebbe Road in Lubowa.',
        'keywords' => 'about Evangiz Restaurant, Ugandan restaurant Lubowa, family dining Uganda, restaurant along Kampala-Entebbe Road',
        'image' => '/image/page-header/about-res.jpg',
    ],
    '/services' => [
        'file' => 'pages/services.php',
        'title' => 'Restaurant Services in Lubowa | Dine-In, Takeaway & Catering',
        'desc' => 'Discover Evangiz Restaurant services including dine-in meals, takeaway food, food preparation, customer support, and outside catering in Uganda.',
        'keywords' => 'restaurant services Uganda, dine-in Lubowa, takeaway Entebbe Road, catering services in Uganda, Evangiz services',
        'image' => '/image/page-header/page-private-event.jpg',
    ],
    '/catering' => [
        'file' => 'pages/catering.php',
        'title' => 'Outside Catering in Uganda | Corporate & Private Events | Evangiz',
        'desc' => 'Book Evangiz outside catering for corporate catering, private events, weddings, graduations, buffet packages, local foods, fruit displays, and juice service.',
        'keywords' => 'outside catering Uganda, corporate catering, private events catering, catering services in Uganda, buffet packages Kampala',
        'image' => '/image/page-header/page-private-event.jpg',
    ],
    '/contact' => [
        'file' => 'pages/contact.php',
        'title' => 'Contact Evangiz Restaurant | Visit Lubowa on Entebbe Road',
        'desc' => 'Contact Evangiz Restaurant in Lubowa for reservations, takeaway, outside catering inquiries, directions, phone numbers, and email support.',
        'keywords' => 'contact Evangiz Restaurant, restaurant Lubowa contact, catering inquiries Uganda, restaurant near Entebbe Road',
        'image' => '/image/page-header/page-contact.jpg',
    ],
    '/blog' => [
        'file' => 'pages/blog.php',
        'title' => 'Evangiz Blog | Ugandan Food, Restaurant News & Catering Tips',
        'desc' => 'Read Evangiz Restaurant stories, Ugandan food updates, restaurant news, catering ideas, and dining tips from our Lubowa team.',
        'keywords' => 'Evangiz blog, Ugandan food blog, restaurant news Uganda, catering tips Uganda',
        'image' => '/image/page-header/page-header_7.jpg',
    ],
    '/blog-post' => [
        'file' => 'pages/blog-post.php',
        'title' => 'Read Our Blog - Evangiz Restaurant',
        'desc' => 'Read the latest Evangiz Restaurant article about Ugandan food, dining, catering, and restaurant stories.',
        'keywords' => 'Evangiz Restaurant blog post, Ugandan food article, restaurant story',
        'image' => '/image/page-header/page-header_7.jpg',
    ]
];

// Map each route to its extracted per-page stylesheet (in /css/pages/).
// Pages not listed here simply load no extra stylesheet.
$page_css_map = [
    '/'          => 'home',
    '/home'      => 'home',
    '/menu'      => 'menu',
    '/about'     => 'about',
    '/services'  => 'services',
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
    $page_keywords = $route['keywords'] ?? '';
    $page_image = $route['image'] ?? null;
    $page_content = SRC_PATH . '/' . $route['file'];
    $page_css = $page_css_map[$path] ?? null;
    $page_lcp_image = $page_lcp_map[$path] ?? null;
} else {
    // Graceful 404 handler
    http_response_code(404);
    $page_title = 'Page Not Found - Evangiz Restaurant';
    $page_desc = 'The requested page was not found.';
    $page_content = SRC_PATH . '/pages/404.php';
    $page_css = '404';
    $page_noindex = true; // Don't let search engines index the 404 page.
}

// Global Components Helpers for component-based rendering
require_once SRC_PATH . '/includes/components.php';

// Assemble Page Template
include_once SRC_PATH . '/includes/header.php';
include_once SRC_PATH . '/includes/topbar.php';
include_once SRC_PATH . '/includes/navbar.php';

// Load page layout content
include $page_content;

include_once SRC_PATH . '/includes/footer.php';
?>
