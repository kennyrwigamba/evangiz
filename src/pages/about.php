<?php
/**
 * Evangiz Restaurant - About Page
 */

$page_header_title = 'Our Story';
$page_header_image = '/image/page-header/about-res.jpg';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'About Us'],
];

include __DIR__ . '/../includes/page-header.php';
?>

<!-- Brand Story Section -->
<section class="section story-section">
    <div class="container">
        <div class="grid-2 align-items-center">
            <div class="story-graphic animate-scroll-reveal reveal-left">
                <div class="graphic-panel-wrapper decor-left">
                    <div class="panel-border-decor"></div>
                    <div class="panel-image-placeholder">
                        <img src="<?php echo url('/image/section/about.jpg'); ?>" alt="Evangiz Kitchen and Bakery Preparation" class="media-cover">
                        <span class="about-decor-text">Established in 2019</span>
                    </div>
                </div>
            </div>
            
            <div class="story-text animate-scroll-reveal reveal-right">
                <span class="section-label">Our Story</span>
                <h2>Sourcing Freshness, Serving Community</h2>
                <p class="welcome-lead-para">
                    At Evangiz Restaurant, we believe that dining is more than just eating; it is an experience that brings people together. Located along Kampala–Entebbe Road in Lubowa, we have grown to become a local favorite for families, travelers, and food lovers alike.
                </p>
                <p>
                    Our kitchen specializes in marrying the convenience of high-quality fast foods with the rich, authentic flavors of local Ugandan staples. From crispy fried chicken to slow-steamed Luwombos, each dish is handled by experienced chefs who prioritize cleanliness, nutrition, and taste.
                </p>
                <p>
                    We place a premium on hospitality. From the moment you step through our doors, our dedicated team is committed to making you feel welcome. Our goal is to provide top-notch service that makes every visit memorable.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Core Principles Section -->
<section class="section principles-section dark-section">
    <div class="container">
        <div class="text-center">
            <span class="section-label text-accent">Our Philosophy</span>
            <h2 class="section-heading text-accent">What Guides Evangiz</h2>
            <p class="section-desc text-muted">The core guidelines that drive our kitchen, staff, and restaurant environment daily.</p>
        </div>

        <div class="grid-3 stagger-container mt-xl">
            <div class="principle-card animate-scroll-reveal">
                <div class="principle-card-bg" style="background-image: url('<?php echo url('/image/section/about_2.jpg'); ?>');"></div>
                <div class="principle-card-overlay"></div>
                <div class="principle-card-content">
                    <div class="principle-icon">🥬</div>
                    <h4>100% Fresh Ingredients</h4>
                    <p>We source all our vegetables, meats, and spices locally from nearby farmers every morning, ensuring maximum freshness in every bite.</p>
                </div>
            </div>
            <div class="principle-card animate-scroll-reveal">
                <div class="principle-card-bg" style="background-image: url('<?php echo url('/image/section/about-1.jpg'); ?>');"></div>
                <div class="principle-card-overlay"></div>
                <div class="principle-card-content">
                    <div class="principle-icon">🤝</div>
                    <h4>Premium Hospitality</h4>
                    <p>We train our service staff to be friendly, swift, and highly attentive to your preferences, creating a comfortable home-like vibe.</p>
                </div>
            </div>
            <div class="principle-card animate-scroll-reveal">
                <div class="principle-card-bg" style="background-image: url('<?php echo url('/image/section/s-private-about.jpg'); ?>');"></div>
                <div class="principle-card-overlay"></div>
                <div class="principle-card-content">
                    <div class="principle-icon">👨‍🌾</div>
                    <h4>Community First</h4>
                    <p>We take pride in our Ugandan roots, supporting sustainable agricultural suppliers and offering meals that respect traditional culinary values.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inline styles for About Page layout -->
<!-- Page styles moved to /css/pages/about.css for caching & performance -->
