<?php
/**
 * Evangiz Restaurant - Structured Data (JSON-LD)
 *
 * Emits Schema.org markup that Google uses for rich results / the local
 * Knowledge Panel. Included from the footer so page-level context
 * ($page_header_breadcrumbs, $post) is in scope.
 *
 * Blocks:
 *   1. Restaurant  - sitewide LocalBusiness with address, geo, hours, socials.
 *   2. WebSite     - ties the domain to the brand.
 *   3. BreadcrumbList - when the current page exposes breadcrumbs.
 *   4. BlogPosting - on single blog posts.
 */

$jsonld_flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

/** Promote a possibly-relative URL to the canonical production domain. */
$to_abs = static function ($u) {
    $u = (string) $u;
    if ($u === '') {
        return '';
    }
    if (preg_match('#^https?://#i', $u)) {
        return $u;
    }
    return site_url($u);
};

$graph = [];

// 1. Restaurant (LocalBusiness)
$graph[] = [
    '@type' => 'Restaurant',
    '@id' => SITE_URL . '/#restaurant',
    'name' => 'Evangiz Restaurant',
    'url' => SITE_URL . '/',
    'image' => site_url('/image/page-header/page-header_5.jpg'),
    'logo' => site_url('/image/logo/logo.png'),
    'description' => 'Premium fast food, authentic local Ugandan dishes, and professional outside catering along Kampala-Entebbe Road in Lubowa.',
    'telephone' => '+256705183818',
    'email' => 'info@evangiz.com',
    'priceRange' => '$$',
    'servesCuisine' => ['Ugandan', 'Fast Food'],
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Kampala-Entebbe Road, Lubowa (Opposite Roofings)',
        'addressLocality' => 'Lubowa',
        'addressRegion' => 'Wakiso',
        'addressCountry' => 'UG',
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => 0.243892,
        'longitude' => 32.556929,
    ],
    'hasMap' => 'https://www.google.com/maps/search/?api=1&query=0.243892,32.556929',
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '09:00',
            'closes' => '23:00',
        ],
    ],
    'sameAs' => [
        'https://www.youtube.com/@evangizrestaurant',
        'https://www.instagram.com/evangizrestaurant',
        'https://www.tiktok.com/@evangizrestaurant',
    ],
];

// 2. WebSite
$graph[] = [
    '@type' => 'WebSite',
    '@id' => SITE_URL . '/#website',
    'url' => SITE_URL . '/',
    'name' => 'Evangiz Restaurant',
    'publisher' => ['@id' => SITE_URL . '/#restaurant'],
];

// 3. BreadcrumbList (inner pages only)
if (!empty($page_header_breadcrumbs) && is_array($page_header_breadcrumbs)) {
    $items = [];
    foreach ($page_header_breadcrumbs as $i => $crumb) {
        if (empty($crumb['label'])) {
            continue;
        }
        $entry = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $crumb['label'],
        ];
        // Last crumb (current page) has no href; point it at the canonical URL.
        $entry['item'] = !empty($crumb['href']) ? $to_abs($crumb['href']) : site_url(isset($canonical_path) ? $canonical_path : (isset($path) ? $path : '/'));
        $items[] = $entry;
    }
    if ($items) {
        $graph[] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }
}

// 4. BlogPosting (single blog post only — guard against $post leaking from the
//    blog listing's foreach loop on /blog).
if (isset($path) && $path === '/blog-post' && isset($post) && is_array($post)) {
    $graph[] = [
        '@type' => 'BlogPosting',
        'headline' => $post['title'] ?? '',
        'description' => isset($post['content']) ? mb_strimwidth(strip_tags($post['content']), 0, 200, '...') : '',
        'image' => !empty($post['image_path']) ? $to_abs($post['image_path']) : site_url('/image/page-header/page-header_5.jpg'),
        'datePublished' => !empty($post['created_at']) ? date('c', strtotime($post['created_at'])) : '',
        'dateModified' => !empty($post['updated_at']) ? date('c', strtotime($post['updated_at'])) : (!empty($post['created_at']) ? date('c', strtotime($post['created_at'])) : ''),
        'mainEntityOfPage' => site_url(isset($canonical_path) ? $canonical_path : (isset($path) ? $path : '/')),
        'author' => ['@type' => 'Organization', 'name' => 'Evangiz Team'],
        'publisher' => ['@id' => SITE_URL . '/#restaurant'],
    ];
}

$structured_data = [
    '@context' => 'https://schema.org',
    '@graph' => $graph,
];
?>
<script type="application/ld+json"><?php echo json_encode($structured_data, $jsonld_flags); ?></script>
