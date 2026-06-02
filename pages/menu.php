<?php
/**
 * Evangiz Restaurant - Food Menu Page
 */
?>

<!-- Page Title Banner -->
<section class="page-header" style="background-image: url('<?php echo url("/image/page-header/page-our-menu.jpg"); ?>');">
    <div class="container">
        <h1 class="animate-fade-in">Our Culinary Menu</h1>
        <div class="breadcrumb animate-fade-in delay-100">
            <a href="<?php echo url('/'); ?>">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Menu</span>
        </div>
    </div>
</section>

<!-- Category Selector & Menu Listings -->
<section class="section menu-section-wrapper">
    <div class="container">
        <!-- Interactive Category Tabs -->
        <div class="menu-tabs-container animate-fade-in delay-200">
            <button class="menu-tab active" data-category="all">Full Menu</button>
            <button class="menu-tab" data-category="fast-foods">Fast Foods</button>
            <button class="menu-tab" data-category="local-dishes">Local Dishes</button>
            <button class="menu-tab" data-category="snacks">Snacks & Light Meals</button>
            <button class="menu-tab" data-category="drinks">Soft Drinks</button>
        </div>

        <!-- Menu Content Sheets -->
        <div class="menu-listings-wrapper" style="margin-top: var(--space-xl);">
            
            <!-- Category: Fast Foods -->
            <div class="menu-section" id="category-fast-foods">
                <div class="menu-section-header">
                    <h3 class="menu-section-title">🍔 Fast Foods</h3>
                    <span class="menu-section-line"></span>
                </div>
                <div class="grid-2 stagger-container">
                    <?php
                    echo render_food_item('Classic Beef Burger', 15000, 'Beef patty, lettuce, tomato, house sauce', ['Beef']);
                    echo render_food_item('Chicken Burger', 12000, 'Crispy chicken, mayo, lettuce', ['Chicken']);
                    echo render_food_item('Double Beef Burger', 22000, 'Double beef patty, cheese, pickles, house sauce', ['Beef', 'Large']);
                    echo render_food_item('Grilled Chicken Sandwich', 11000, 'Grilled chicken breast, salad greens, sandwich sauce', ['Chicken']);
                    echo render_food_item('Veggie Burger', 10000, 'House vegetable patty, lettuce, tomato, dressing', ['Vegetarian']);
                    echo render_food_item('Fried Chicken (3 pcs)', 18000, 'Golden fried chicken pieces served crispy and hot', ['Chicken']);
                    echo render_food_item('Chicken Wings (6 pcs)', 14000, 'Spicy house chicken wings tossed in barbecue style sauce', ['Chicken', 'Spicy']);
                    echo render_food_item('Pizza Slice', 10000, 'Cheese & tomato slice with choice of toppings', ['Popular']);
                    echo render_food_item('French Fries', 6000, 'Crispy salted golden french fries', ['Side']);
                    echo render_food_item('Onion Rings', 5000, 'Crispy beer-battered fried onion rings', ['Side']);
                    ?>
                </div>
            </div>

            <!-- Category: Local Dishes -->
            <div class="menu-section" id="category-local-dishes" style="margin-top: var(--space-xl);">
                <div class="menu-section-header">
                    <h3 class="menu-section-title">🍲 Local Dishes (Ugandan Staples)</h3>
                    <span class="menu-section-line"></span>
                </div>
                <p class="menu-section-desc text-muted">Freshly prepared authentic local dishes based on Ugandan staples, depending on daily seasonal availability.</p>
                <div class="grid-2 stagger-container">
                    <?php
                    echo render_food_item('Traditional Beef Luwombo', 22000, 'Slow-cooked beef stew prepared traditionally inside banana leaves with rich spices', ['Staple', 'Beef']);
                    echo render_food_item('Chicken Luwombo', 24000, 'Traditional local chicken stew steamed inside fresh banana leaves', ['Staple', 'Chicken']);
                    echo render_food_item('Matooke & Groundnut Stew', 12000, 'Steamed and mashed plantain (bananas) served with rich peanut/groundnut paste sauce', ['Vegetarian']);
                    echo render_food_item('Fresh Whole Tilapia (Wet or Dry)', 25000, 'Local lake fish prepared to order, served with french fries or local foods', ['Fish']);
                    echo render_food_item('Evangiz Local Platter', 26000, 'Combination of Matooke, sweet potatoes, yams, posho, rice, and beans, served with beef stew', ['Beef', 'Large']);
                    ?>
                </div>
            </div>

            <!-- Category: Snacks -->
            <div class="menu-section" id="category-snacks" style="margin-top: var(--space-xl);">
                <div class="menu-section-header">
                    <h3 class="menu-section-title">🥪 Light Meals & Snacks</h3>
                    <span class="menu-section-line"></span>
                </div>
                <div class="grid-2 stagger-container">
                    <?php
                    echo render_food_item('Ugandan Rolex (2 Eggs, 2 Chapatis)', 5000, 'Famous local street snack consisting of rolled fried eggs and vegetables inside chapati', ['Local', 'Popular']);
                    echo render_food_item('Beef Samosas (3 pcs)', 4000, 'Crispy triangular pastry wrappers stuffed with spiced minced beef filling', ['Snack']);
                    echo render_food_item('Vegetable Spring Rolls (3 pcs)', 3000, 'Crispy rolls stuffed with seasoned fresh garden vegetables', ['Snack', 'Vegetarian']);
                    echo render_food_item('Toasted Sandwich', 8000, 'Cheese and tomato, or ham and cheese fillings toasted to golden perfection', ['Snack']);
                    ?>
                </div>
            </div>

            <!-- Category: Soft Drinks -->
            <div class="menu-section" id="category-drinks" style="margin-top: var(--space-xl);">
                <div class="menu-section-header">
                    <h3 class="menu-section-title">🥤 Soft Drinks & Refreshments</h3>
                    <span class="menu-section-line"></span>
                </div>
                <div class="grid-2 stagger-container">
                    <?php
                    echo render_food_item('Fresh Passion Fruit Juice', 5000, 'Chilled freshly-squeezed organic passion fruit juice', ['Fresh', 'Drinks']);
                    echo render_food_item('Spiced African Tea', 6000, 'Brewed hot milk tea infused with local ginger, tea leaves, and spices', ['Hot', 'Drinks']);
                    echo render_food_item('House Brewed Coffee', 7000, 'Brewed aromatic coffee made from premium Ugandan coffee beans', ['Hot', 'Drinks']);
                    echo render_food_item('Soda (350ml)', 3000, 'Chilled Coca Cola, Fanta, Sprite, or Stoney in classic glass bottles', ['Cold', 'Drinks']);
                    echo render_food_item('Mineral Water (500ml)', 2500, 'Bottled pure mineral drinking water served chilled or room temp', ['Cold', 'Drinks']);
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Menu Page Specific Styles -->
<style>
.menu-tabs-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: var(--space-sm);
    /* border-bottom: 1px solid var(--color-border); */
    padding-bottom: var(--space-md);
}

.menu-tab {
    background: none;
    border: none;
    outline: none;
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 500;
    padding: var(--space-sm) var(--space-lg);
    cursor: pointer;
    border-radius: var(--radius-round);
    color: var(--color-text-muted);
    transition: var(--transition-fast);
}

.menu-tab:hover,
.menu-tab.active {
    color: var(--color-accent);
    background-color: rgba(231, 86, 42, 0.08);
}

.menu-section-header {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    margin-bottom: var(--space-lg);
}

.menu-section-title {
    font-family: var(--font-heading);
    font-weight: 600;
    color: var(--color-primary);
    white-space: nowrap;
}

.menu-section-line {
    flex-grow: 1;
    height: 1px;
    background-color: var(--color-border);
}

.menu-section-desc {
    margin-top: calc(-1 * var(--space-md));
    margin-bottom: var(--space-lg);
    font-size: 0.95rem;
}
</style>
