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

// Check path in routing table
if (array_key_exists($path, $routes)) {
    $route = $routes[$path];
    $page_title = $route['title'];
    $page_desc = $route['desc'];
    $page_content = __DIR__ . '/' . $route['file'];
} else {
    // Graceful 404 handler
    http_response_code(404);
    $page_title = 'Page Not Found - Evangiz Restaurant';
    $page_desc = 'The requested page was not found.';
    $page_content = __DIR__ . '/pages/404.php';
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
