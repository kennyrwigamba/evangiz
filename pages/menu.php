<?php
/**
 * Evangiz Restaurant - Food Menu Page
 */

// Fetch active categories and menu items from database
try {
    $categories_stmt = $conn->query("SELECT * FROM categories ORDER BY sort_order ASC");
    $categories = $categories_stmt->fetchAll();
    
    // Fetch all active menu items
    $menu_items_stmt = $conn->query("SELECT m.*, c.slug as category_slug FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE m.is_active = 1 ORDER BY m.sort_order ASC");
    $all_menu_items = $menu_items_stmt->fetchAll();
    
    // Group menu items by category slug
    $menu_by_category = [];
    foreach ($categories as $cat) {
        $menu_by_category[$cat['slug']] = [];
    }
    foreach ($all_menu_items as $item) {
        $menu_by_category[$item['category_slug']][] = $item;
    }
} catch (PDOException $e) {
    $categories = [];
    $menu_by_category = [];
}

$category_icons = [
    'fast-foods' => '🍔',
    'local-dishes' => '🍲',
    'snacks' => '🥪',
    'drinks' => '🥤'
];

$category_descs = [
    'local-dishes' => 'Freshly prepared authentic local dishes based on Ugandan staples, depending on daily seasonal availability.'
];

$page_header_title = 'Our Culinary Menu';
$page_header_image = '/image/page-header/page-our-menu.jpg';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'Menu'],
];

include __DIR__ . '/../includes/page-header.php';
?>

<!-- Category Selector & Menu Listings -->
<section class="section menu-section-wrapper">
    <div class="container">
        <!-- Interactive Category Tabs -->
        <div class="menu-tabs-container animate-fade-in delay-200">
            <button class="menu-tab active" data-category="all">Full Menu</button>
            <?php foreach ($categories as $cat): ?>
                <button class="menu-tab" data-category="<?php echo htmlspecialchars($cat['slug']); ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Menu Content Sheets -->
        <div class="menu-listings-wrapper mt-xl">
            <?php $is_first = true; ?>
            <?php foreach ($categories as $cat): ?>
                <?php $cat_slug = $cat['slug']; ?>
                <div class="menu-section<?php echo $is_first ? '' : ' mt-xl'; ?>" id="category-<?php echo htmlspecialchars($cat_slug); ?>">
                    <div class="menu-section-header">
                        <h3 class="menu-section-title">
                            <?php 
                            $icon = isset($category_icons[$cat_slug]) ? $category_icons[$cat_slug] . ' ' : '';
                            echo $icon . htmlspecialchars($cat['name']); 
                            ?>
                        </h3>
                        <span class="menu-section-line"></span>
                    </div>
                    <?php if (isset($category_descs[$cat_slug])): ?>
                        <p class="menu-section-desc text-muted"><?php echo htmlspecialchars($category_descs[$cat_slug]); ?></p>
                    <?php endif; ?>
                    <div class="grid-2 stagger-container">
                        <?php
                        if (isset($menu_by_category[$cat_slug])) {
                            foreach ($menu_by_category[$cat_slug] as $item) {
                                $tags = !empty($item['tags']) ? array_map('trim', explode(',', $item['tags'])) : [];
                                echo render_food_item($item['name'], $item['price'], $item['description'], $tags);
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php $is_first = false; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Menu Page Specific Styles -->
<!-- Page styles moved to /css/pages/menu.css for caching & performance -->
