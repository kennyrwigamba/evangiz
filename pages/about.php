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
                        <img src="<?php echo url('/image/section/about.jpg'); ?>" alt="Evangiz Kitchen and Bakery Preparation" style="width: 100%; height: 100%; object-fit: cover; display: block;">
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
            <h2 class="section-heading text-white">What Guides Evangiz</h2>
            <p class="section-desc text-muted">The core guidelines that drive our kitchen, staff, and restaurant environment daily.</p>
        </div>

        <div class="grid-3 stagger-container" style="margin-top: var(--space-xl);">
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
<style>
.about-decor-text {
    position: absolute;
    top: var(--space-md);
    left: var(--space-md);
    font-family: var(--font-heading);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    background-color: var(--color-secondary);
    color: var(--color-primary);
    padding: var(--space-xs) var(--space-sm);
    border-radius: var(--radius-sm);
    z-index: 3;
    letter-spacing: 0.05em;
}

/* Principle Cards */
.principle-card {
    position: relative;
    padding: var(--space-xl) var(--space-lg);
    border-radius: 0;
    border: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
    transition: var(--transition-smooth);
    overflow: hidden;
}

.principle-card-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 0;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.principle-card:hover .principle-card-bg {
    transform: scale(1.08);
}

.principle-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(11, 19, 37, 0.6) 0%, rgba(11, 19, 37, 0.88) 100%);
    z-index: 1;
    transition: var(--transition-smooth);
}

.principle-card:hover .principle-card-overlay {
    background: linear-gradient(to bottom, rgba(11, 19, 37, 0.7) 0%, rgba(11, 19, 37, 0.94) 100%);
}

.principle-card-content {
    position: relative;
    z-index: 2;
}

.principle-card:hover {
    transform: translateY(-5px);
    border-color: var(--color-secondary);
    box-shadow: var(--shadow-premium);
}

.principle-icon {
    font-size: 2.5rem;
    margin-bottom: var(--space-md);
    display: inline-block;
}


.principle-card h4 {
    color: var(--color-white);
    font-size: 1.625rem;
    margin-bottom: var(--space-sm);
}

.principle-card p {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.875rem;
    margin-bottom: 0;
    line-height: 1.6;
}
</style>
