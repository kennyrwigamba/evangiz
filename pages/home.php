<?php
/**
 * Evangiz Restaurant - Homepage
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
?>

<!-- Hero Slider Section -->
<section class="hero-section">
    <?php
    $hero_slides = [
        '/image/page-header/page-header_1.jpg',
        '/image/page-header/page-header_2.jpg',
        '/image/page-header/page-header_3.jpg',
        '/image/page-header/page-header_4.jpg',
        '/image/page-header/page-header_5.jpg',
    ];
    ?>
    <div class="hero-slider" aria-hidden="true">
        <?php foreach ($hero_slides as $index => $slide): ?>
            <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" style="background-image: url('<?php echo url($slide); ?>');"></div>
        <?php endforeach; ?>
    </div>
    <div class="hero-bg-overlay"></div>
    <div class="container hero-container text-center">
        <div class="hero-content animate-slide-up">
            <h1 class="hero-title">
                <span  style="font-weight: 200;">A Taste You’ll Remember</span><br>
                <span>Where Every Flavor</span> <span class="font-italic" style="color: #e5643d; font-family: Cormorant Garamond; "><i> Tells A Story!</i></span>
            </h1>
            <p class="hero-lead text-muted">
                Experience high-quality, delicious, and affordable local Ugandan staples & fast foods in Lubowa.
            </p>
            <div class="hero-ctas">
                <?php echo render_button('View Our Menu', url('/menu'), 'primary'); ?>
                <?php echo render_button('Book Now', url('/contact#booking'), 'white'); ?>
            </div>
        </div>
    </div>
    <div class="hero-slider-controls" aria-hidden="true">
        <div class="hero-slider-dots">
            <?php foreach ($hero_slides as $index => $slide): ?>
                <button class="hero-slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" type="button" aria-label="Go to hero slide <?php echo $index + 1; ?>" data-slide="<?php echo $index; ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Brush Stroke Divider -->
    <div class="custom-shape-divider-bottom" aria-hidden="true">
        <svg viewBox="0 0 1200 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C80,18 160,38 240,28 C320,18 380,42 460,32 C560,20 620,36 700,26 C780,16 860,40 940,30 C1020,20 1100,38 1200,24 L1200,50 L0,50 Z" class="shape-fill" opacity="0.7"></path>
            <path d="M0,34 C100,22 200,42 300,30 C420,16 500,44 600,30 C720,14 820,44 920,32 C1020,22 1120,40 1200,28 L1200,50 L0,50 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<!-- Quick Menu Promo Cards -->
<section class="section promo-grid-section" style="padding: 2rem 0 var(--space-md); background-color: var(--color-bg-warm);">
    <div class="container">
        <div class="grid-3 menu-promo-grid">
            <!-- Card 1: Special Menu -->
            <a href="<?php echo url('/menu#fast-foods'); ?>" class="menu-promo-card "><!-- animate-scroll-reveal -->
                <div class="promo-card-bg" style="background-image: url('<?php echo url("/image/section/pizza.jpg"); ?>');"></div>
                <div class="promo-card-overlay"></div>
                <div class="promo-card-content">
                    <span class="promo-subtitle">Can not be ignored</span>
                    <h3 class="promo-title">Special Menu</h3>
                </div>
            </a>
            
            <!-- Card 2: Seasonal Food -->
            <a href="<?php echo url('/menu#local-dishes'); ?>" class="menu-promo-card ">
                <div class="promo-card-bg" style="background-image: url('<?php echo url("/image/section/special.jpg"); ?>');"></div>
                <div class="promo-card-overlay"></div>
                <div class="promo-card-content">
                    <span class="promo-subtitle">Enjoy on occasion</span>
                    <h3 class="promo-title">Seasonal Food</h3>
                </div>
            </a>
            
            <!-- Card 3: Soft Drinks -->
            <a href="<?php echo url('/menu#drinks'); ?>" class="menu-promo-card ">
                <div class="promo-card-bg" style="background-image: url('<?php echo url("/image/section/drink.jpg"); ?>');"></div>
                <div class="promo-card-overlay"></div>
                <div class="promo-card-content">
                    <span class="promo-subtitle">New experience</span>
                    <h3 class="promo-title">Soft Drinks</h3>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Slogan & Welcome Section -->
<section class="section welcome-section">
    <div class="container welcome-container">
        <div class="grid-2 align-items-center">
            <!-- Text Content Column -->
            <div class="welcome-text-column animate-scroll-reveal reveal-left">
                <span class="section-label">Culinary Excellence</span>
                <h2 class="welcome-heading">A Culinary Adventure <br>For All The Senses</h2>
                <div class="welcome-paragraphs">
                    <p class="welcome-lead-para">
                        Welcome to Evangiz Restaurant, where we pride ourselves on offering the best of both delicious, locally sourced cuisine and top notch service. We believe that the best meals start with the freshest ingredients. But we know that a great meal is about more than just the food.
                    </p>
                    <p>
                        That's why we also place a premium on providing exceptional service to each and every one of our guests. <!--So if you're looking for a restaurant that offers the best of local cuisine and top-notch service, look no further. We can't wait to welcome you to our table and show you why we're one of the best restaurants in town!-->
                    </p>
                </div>
                <div class="welcome-ctas">
                    <?php echo render_button('Read More About Us', url('/about'), 'primary-outline'); ?>
                </div>
            </div>
            
            <!-- Graphic / Image Panel (Styled Mock Content placeholder) -->
            <div class="welcome-graphic-column animate-scroll-reveal reveal-right">
                <div class="graphic-panel-wrapper">
                    <div class="panel-border-decor"></div>
                    <div class="panel-image-placeholder">
                        <video autoplay loop muted playsinline preload="auto" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            <source src="<?php echo url('/video/evangiz.mp4'); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Partners Logo Strip -->
<section class="section partners-section">
    <div class="container">
        <div class="partners-header text-center animate-scroll-reveal">
            <span class="section-label">Our Partners</span>
            <h2 class="partners-title text-serif">Trusted by Organizations We Value</h2>
        </div>

        <?php
        $partner_logos = [
            '/image/partners/africa2trust.png',
            '/image/partners/CAA-Uganda.png',
            '/image/partners/ugandabaati.png',
            '/image/partners/tecnovia.png',
            '/image/partners/mastermindconsults.jpg',
            '/image/partners/m-kopa.svg',
            '/image/partners/fasttrack.png',
            '/image/partners/eco-trust.png',
        ];
        ?>

        <div class="partners-marquee animate-scroll-reveal" aria-label="Our partners logos">
            <div class="partners-track">
                <?php for ($i = 0; $i < 2; $i++): ?>
                    <?php foreach ($partner_logos as $logo): ?>
                        <div class="partner-logo-card">
                            <img src="<?php echo url($logo); ?>" alt="Partner logo" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>


<!-- Why Choose Us Section -->
<section class="section why-choose-section">
    <div class="container">
        <!-- Top Centered Slogan Banner -->
        <!--<div class="why-choose-slogan-wrapper animate-scroll-reveal text-center">
            <h3 class="why-choose-slogan text-serif">We bring you a culinary experience like no other</h3>
        </div>-->

        <div class="grid-2 why-choose-grid align-items-center" style="margin-top: var(--space-xl);">
            <!-- Left Column: Chef Image & Overlapping Blue Box -->
            <div class="why-choose-image-column animate-scroll-reveal">
                <div class="chef-image-wrapper">
                    <img src="<?php echo url('/image/section/s-why.jpg'); ?>" alt="Evangiz Chef" class="chef-image">
                    
                    <!-- Overlapping Blue Box -->
                    <div class="floating-info-card">
                        <div class="info-card-icon-box hidden">
                            <!-- Seafood / Shrimp Icon -->
                            <img src="<?php echo url('/image/item/shrimp.png'); ?>" alt="Shrimp Icon" class="info-card-icon">
                        </div>
                        <p class="info-card-text">
                            At Evangiz Restaurant we use fresh, locally sourced ingredients to create authentic Ugandan flavours with a modern touch. From comforting local dishes to quick snacks, our kitchen serves food made with care.
                        </p>
                        <a href="<?php echo url('/about'); ?>" class="info-card-btn" aria-label="Read more">
                            <span class="info-card-btn-arrow">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Context & List -->
            <div class="why-choose-content-column animate-scroll-reveal">
                <span class="section-label">Why Choose Evangiz Restaurant</span>
                <h2 class="why-choose-heading text-serif">We bring you a Culinary experience like no other</h2>
                <div class="menu-title-wave" style="margin-bottom: var(--space-md);"></div>
                
                <p class="why-choose-description">
                    Evangiz Restaurant celebrates Ugandan flavours and hospitality. We offer relaxed, family-friendly dining and thoughtfully prepared meals using local ingredients &mdash; perfect for everyday lunches, special dinners, and events.
                </p>
                
                <!-- Why Choose Accordion -->
                <div class="why-choose-accordion" style="margin-top: var(--space-md);">
                    <!-- Item 1: Food is always fresh -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Food is always fresh</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                We prepare our dishes daily using fresh, locally sourced Ugandan ingredients, organic produce, and premium seafood delivered straight to our kitchen.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Item 2: Professional chefs -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Professional chefs</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                Our culinary team consists of highly trained and experienced chefs who cook with passion, bringing you authentic local flavors and high-quality fast foods.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Item 3: Sea view dining table -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Serene Dining Experience</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                Relax and dine in style with our beautifully arranged tables, scenic ambiance, and welcoming spaces perfect for families, couples, or solo guests.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menu Preview Highlight -->
<section class="section menu-preview-section">
    <div class="menu-preview-overlay"></div>
    <div class="container" style="position: relative; z-index: 2;">
        
        <!-- Section Header with View Menu Button -->
        <div class="menu-preview-header-row animate-scroll-reveal">
            <div class="menu-preview-title-box">
                <h2 class="menu-preview-main-title text-serif">Our Menu</h2>
                <div class="menu-title-wave"></div>
            </div>
            <div class="menu-preview-action">
                <?php echo render_button('View Menu', url('/menu'), 'outline', 'btn-view-menu'); ?>
            </div>
        </div>

        <!-- Interactive Category Tabs -->
        <div class="menu-tabs-container animate-scroll-reveal" style="margin-bottom: var(--space-xl);">
            <?php $is_first = true; ?>
            <?php foreach ($categories as $cat): ?>
                <button class="menu-tab <?php echo $is_first ? 'active' : ''; ?>" data-category="<?php echo htmlspecialchars($cat['slug']); ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </button>
                <?php $is_first = false; ?>
            <?php endforeach; ?>
        </div>

        <!-- Menu Listings Sheets -->
        <div class="menu-listings-wrapper">
            <?php $is_first = true; ?>
            <?php foreach ($categories as $cat): ?>
                <?php $cat_slug = $cat['slug']; ?>
                <div class="menu-section" id="category-<?php echo htmlspecialchars($cat_slug); ?>" style="<?php echo $is_first ? '' : 'display: none;'; ?>">
                    <div class="grid-2 text-left stagger-container">
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



<!-- Outside Catering Section -->
<section class="section catering-showcase-section">
    <div class="container">
        <div class="grid-2 catering-showcase-grid align-items-center">
            <!-- Left Column: Context & Accordion -->
            <div class="catering-showcase-content animate-scroll-reveal">
                <span class="section-label">Outside Catering</span>
                <h2 class="catering-showcase-heading text-serif">Outside Catering For Your Event</h2>
                <div class="menu-title-wave" style="margin-bottom: var(--space-md);"></div>
                
                <p class="catering-showcase-description">
                    Evangiz Restaurant brings the delectable flavors of our kitchen to your special events. Experience the perfect blend of culinary expertise and personalized service with our outside catering for gatherings along Kampala–Entebbe Road and beyond.
                </p>
                
                <!-- Interactive Accordion List -->
                <div class="catering-accordion">
                    <!-- Item 1: Corporate gatherings -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Corporate Gatherings</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                We cater office lunches, meetings, workshops, and team events with practical menu options that are easy to serve and enjoy.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Item 2: Private celebrations -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Private Celebrations</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                From birthdays to family occasions, we prepare fresh meals and refreshments that suit your guests, schedule, and budget.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Item 3: Flexible event catering -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Flexible Event Catering</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                Whether you require full-service buffet setups, customized plate service, or simple drop-off platters, we adapt to the unique style of your venue and guest count.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <div class="catering-showcase-action" style="margin-top: var(--space-lg);">
                    <?php echo render_button('Book Outside Catering', url('/contact#catering-inquiry'), 'outline', 'btn-view-menu'); ?>
                </div>
            </div>
            
            <!-- Right Column: Visual Setup and Stats Box -->
            <div class="catering-showcase-visual animate-scroll-reveal">
                <div class="catering-visual-wrapper">
                    <img src="<?php echo url('/image/section/s-private.jpg'); ?>" alt="Evangiz Catering Event Setup" class="catering-visual-image">
                    
                    <!-- Stats Bar overlaying at the bottom -->
                    <div class="catering-stats-bar">
                        <!-- Stat Box 1: Blue -->
                        <div class="catering-stat-box stat-blue">
                            <span class="catering-stat-number">358+</span>
                            <span class="catering-stat-label">The Event Is Held</span>
                        </div>
                        <!-- Stat Box 2: Orange -->
                        <div class="catering-stat-box stat-orange">
                            <span class="catering-stat-number">98%</span>
                            <span class="catering-stat-label">Happy Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Accordion Toggle JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const accHeaders = document.querySelectorAll('.catering-accordion .accordion-header, .why-choose-accordion .accordion-header');
    accHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const icon = header.querySelector('.accordion-toggle-icon');
            
            // Toggle active state
            item.classList.toggle('active');
            
            // Update toggle symbol
            if (item.classList.contains('active')) {
                icon.innerHTML = '&minus;';
            } else {
                icon.innerHTML = '&plus;';
            }
        });
    });
});
</script>

<!-- Testimonials Section -->
<?php
$testimonials = [
    [
        'quote' => "The food at Evangiz is absolutely incredible! The authentic Ugandan Luwombo was steamed to perfection, and their service is fast and friendly. It is our favorite family spot in Lubowa!",
        'author' => "Sarah Nalule",
        'role' => "Regular Guest",
        'rating' => 5
    ],
    [
        'quote' => "I ordered their Classic Beef Burger and French Fries for takeaway. The delivery was fast, the burger was hot and juicy, and the packaging was excellent. Highly recommended!",
        'author' => "Brian Ochieng",
        'role' => "Lubowa Resident",
        'rating' => 5
    ],
    [
        'quote' => "We hired Evangiz Restaurant for our corporate event catering, and they exceeded all expectations. The presentation was gorgeous and the staff was extremely professional.",
        'author' => "Aisha Namurinda",
        'role' => "HR Manager, CAA",
        'rating' => 5
    ]
];
?>
<section class="section testimonial-section">
    <div class="container">
        <div class="grid-2 align-items-center testimonial-grid">
            <!-- Left Column: Visual with overlapping quote badge -->
            <div class="testimonial-visual-column animate-scroll-reveal">
                <div class="testimonial-image-wrapper">
                    <div class="testimonial-border-decor"></div>
                    <img src="<?php echo url('/image/section/testimonial.jpg'); ?>" alt="Happy Guests at Evangiz" class="testimonial-image">
                    <div class="quote-badge">
                        <img src="<?php echo url('/image/item/quote.png'); ?>" alt="Quote Mark" class="quote-badge-icon">
                    </div>
                </div>
            </div>

            <!-- Right Column: Context & Testimonials Slider -->
            <div class="testimonial-content-column animate-scroll-reveal">
                <span class="section-label">Guest Feedback</span>
                <h2 class="testimonial-heading text-serif">What Our Guests Say</h2>
                <div class="menu-title-wave" style="margin-bottom: var(--space-lg);"></div>
                
                <div class="testimonial-slider-container">
                    <div class="testimonial-slides">
                        <?php foreach ($testimonials as $index => $t): ?>
                            <div class="testimonial-slide" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>; opacity: <?php echo $index === 0 ? '1' : '0'; ?>;" data-slide="<?php echo $index; ?>">
                                <div class="testimonial-stars">
                                    <?php for ($i = 0; $i < $t['rating']; $i++): ?>
                                        <svg class="star-icon" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    <?php endfor; ?>
                                </div>
                                <blockquote class="testimonial-quote">
                                    "<?php echo htmlspecialchars($t['quote']); ?>"
                                </blockquote>
                                <div class="testimonial-meta">
                                    <h4 class="testimonial-author"><?php echo htmlspecialchars($t['author']); ?></h4>
                                    <span class="testimonial-role"><?php echo htmlspecialchars($t['role']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Slider Navigation Control Buttons -->
                    <div class="testimonial-nav">
                        <button class="testimonial-nav-btn prev-btn" aria-label="Previous Testimonial">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        </button>
                        <button class="testimonial-nav-btn next-btn" aria-label="Next Testimonial">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Slider JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.testimonial-slide');
    const prevBtn = document.querySelector('.testimonial-nav .prev-btn');
    const nextBtn = document.querySelector('.testimonial-nav .next-btn');
    
    if (slides.length > 0 && prevBtn && nextBtn) {
        let currentSlide = 0;
        
        const showSlide = (index) => {
            slides.forEach(s => {
                s.style.opacity = '0';
                s.style.display = 'none';
            });
            slides[index].style.display = 'block';
            setTimeout(() => {
                slides[index].style.opacity = '1';
            }, 30);
        };
        
        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });
        
        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });
    }
});
</script>

<!-- Hero Slider JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const heroSlides = Array.from(document.querySelectorAll('.hero-slide'));
    const heroDots = Array.from(document.querySelectorAll('.hero-slider-dot'));

    if (!heroSlides.length || !heroDots.length) {
        return;
    }

    let currentHeroSlide = 0;
    let heroTimer = null;

    const showHeroSlide = (index) => {
        currentHeroSlide = (index + heroSlides.length) % heroSlides.length;

        heroSlides.forEach((slide, slideIndex) => {
            slide.classList.toggle('active', slideIndex === currentHeroSlide);
        });

        heroDots.forEach((dot, dotIndex) => {
            dot.classList.toggle('active', dotIndex === currentHeroSlide);
        });
    };

    const startHeroAutoplay = () => {
        heroTimer = window.setInterval(() => {
            showHeroSlide(currentHeroSlide + 1);
        }, 5000);
    };

    const resetHeroAutoplay = () => {
        if (heroTimer) {
            window.clearInterval(heroTimer);
        }

        startHeroAutoplay();
    };

    heroDots.forEach(dot => {
        dot.addEventListener('click', () => {
            showHeroSlide(Number(dot.dataset.slide || 0));
            resetHeroAutoplay();
        });
    });

    showHeroSlide(0);
    startHeroAutoplay();
});
</script>


<!-- Additional Homepage Styles inline for beautiful layout support -->
<style>
/* Hero Styles */
.hero-section {
    position: relative;
    padding: 7rem 0;
    min-height: 65vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--color-primary);
    color: var(--color-white);
    overflow: hidden;
}

.hero-slider {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transform: scale(1.04);
    transition: opacity 900ms ease, transform 4.5s ease;
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
}


.hero-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.9) 100%);
    z-index: 1;
}

.hero-container {
    position: relative;
    z-index: 3;
}

.hero-subtitle {
    display: block;
    font-size: 1.5rem;
    font-weight: 500;
    margin-bottom: var(--space-md);
    letter-spacing: 0.1em;
}

.hero-title {
    color: var(--color-white);
    margin-bottom: var(--space-lg);
    font-family: var(--font-body);
    font-size: 52px;
    line-height: 50px;
}


.hero-lead {
    max-width: 650px;
    margin: 0 auto var(--space-xl);
    font-size: 1.125rem;
    color: rgba(245, 246, 248, 0.85) !important;
}

.hero-ctas {
    display: flex;
    gap: var(--space-md);
    justify-content: center;
}

.hero-slider-controls {
    position: absolute;
    left: 0;
    bottom: 46px;
    width: 100%;
    z-index: 4;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
}

.hero-slider-dots {
    display: flex;
    align-items: center;
    gap: 10px;
}

.hero-slider-dot {
    border: none;
    outline: none;
    cursor: pointer;
    width: 10px;
    height: 10px;
    padding: 0;
    border-radius: 9999px;
    background: rgba(255, 255, 255, 0.4);
    transition: var(--transition-fast);
}

.hero-slider-dot.active {
    width: 28px;
    background: var(--color-accent);
}

@media (max-width: 576px) {
    .hero-ctas {
        flex-direction: column;
        align-items: center;
    }

    .hero-slider-controls {
        bottom: 34px;
    }
}

/* Slogan & Welcome section */
.section-label {
    display: block;
    font-family: var(--font-heading);
    font-size: 0.725rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-accent);
    margin-bottom: var(--space-sm);
}

.welcome-heading {
    margin-bottom: var(--space-lg);
    font-family: var(--font-serif);
}

.welcome-lead-para {
    line-height: 1.7;
    color: var(--color-primary);
}

.welcome-paragraphs p {
    color: var(--color-text-muted);
}

.welcome-ctas {
    margin-top: var(--space-lg);
}

.tagline-overlay {
    position: absolute;
    bottom: var(--space-lg);
    left: var(--space-lg);
    background-color: var(--color-accent);
    color: var(--color-white);
    padding: var(--space-xs) var(--space-md);
    font-family: var(--font-heading);
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 0;
    letter-spacing: 0.05em;
}

/* Menu Preview Section Styling */
.menu-preview-section {
    position: relative;
    z-index: 1;
}

.menu-preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(252, 249, 245, 0.94);
    z-index: 1;
}

.menu-preview-header-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: var(--space-xl);
    position: relative;
    z-index: 3;
}

@media (max-width: 576px) {
    .menu-preview-header-row {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-md);
    }
}

.menu-preview-main-title {
    font-size: clamp(2rem, 4vw, 2.75rem);
    color: var(--color-primary);
    margin-bottom: 0;
    line-height: 1.1;
}

.menu-title-wave {
    width: 48px;
    height: 6px;
    background-image: url('<?php echo url("/image/item/curved-item.svg"); ?>');
    background-size: cover;
    background-repeat: repeat-x;
    margin-top: 8px;
}

.btn-view-menu {
    background-color: transparent;
    color: var(--color-primary);
    border: 1px solid var(--color-primary);
    text-decoration: none !important;
    /* Isolate compositing layer to prevent GPU trails during scroll reveals */
    transform: translate3d(0, 0, 0);
    backface-visibility: hidden;
    will-change: transform;
}

.btn-view-menu * {
    text-decoration: none !important;
}

.btn-view-menu .btn-text-main,
.btn-view-menu .btn-text-hover {
    padding: 0.75rem 1.85rem;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.12em;
}

.btn-view-menu:hover {
    background-color: var(--color-primary);
    color: var(--color-white);
    transform: translateY(-2px);
}

/* Promo Cards Grid */
.menu-promo-grid {
    position: relative;
    z-index: 3;
}

.menu-promo-card {
    position: relative;
    height: 190px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: var(--space-md) var(--space-lg);
    box-shadow: var(--shadow-medium);
    transition: var(--transition-smooth);
    cursor: pointer;
    text-decoration: none !important;
}

.menu-promo-card:hover {
    text-decoration: none !important;
}

.menu-promo-card * {
    text-decoration: none !important;
}

.promo-card-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    z-index: 1;
}

.menu-promo-card:hover .promo-card-bg {
    transform: scale(1.08);
}

.promo-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(11, 19, 37, 0) 50%, rgba(11, 19, 37, 0.8) 100%);
    z-index: 2;
    transition: var(--transition-smooth);
}

.menu-promo-card:hover .promo-card-overlay {
    background: linear-gradient(to bottom, rgba(11, 19, 37, 0.1) 40%, rgba(11, 19, 37, 0.9) 100%);
}

.promo-card-content {
    position: relative;
    z-index: 3;
    color: var(--color-white);
    pointer-events: none;
}

.promo-subtitle {
    display: block;
    font-size: 0.625rem;
    font-family: var(--font-heading);
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 4px;
}

.promo-title {
    font-size: 1.5rem;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--color-white);
    margin-bottom: 0;
    letter-spacing: 0.02em;
    font-family: var(--font-serif);
    line-height: 1.2;
}

/* Category Tabs homepage customization */
.menu-preview-section .menu-tabs-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: var(--space-sm);
    border-bottom: 2px solid var(--color-border);
    padding-bottom: var(--space-md);
    position: relative;
    z-index: 3;
}

.menu-preview-section .menu-tab {
    background: none;
    border: none;
    outline: none;
    font-family: var(--font-heading);
    font-size: 0.95rem;
    font-weight: 600;
    padding: var(--space-sm) var(--space-lg);
    cursor: pointer;
    border-radius: var(--radius-round);
    color: var(--color-text-muted);
    transition: var(--transition-fast);
}

.menu-preview-section .menu-tab:hover,
.menu-preview-section .menu-tab.active {
    color: var(--color-accent);
    background-color: rgba(231, 86, 42, 0.08);
}

/* Menu sections placement */
.menu-preview-section .menu-listings-wrapper {
    position: relative;
    z-index: 3;
}

.menu-preview-section .menu-section {
    transition: opacity 0.25s ease, transform 0.25s ease;
}

.text-left {
    text-align: left;
}
.menu-preview-section .menu-section {
    transition: opacity 0.25s ease, transform 0.25s ease;
}

/* Partners Strip */
.partners-section {
    background-color: var(--color-bg-warm);
    padding-top: 1rem;
    padding-bottom: 1rem;
    overflow: hidden;
}

.partners-header {
    margin-bottom: var(--space-lg);
}

.partners-title {
    margin-bottom: 0;
    font-size: clamp(1.8rem, 4vw, 2.5rem);
}

.partners-marquee {
    position: relative;
    overflow: hidden;
    mask-image: linear-gradient(to right, transparent 0%, #000 8%, #000 92%, transparent 100%);
    -webkit-mask-image: linear-gradient(to right, transparent 0%, #000 8%, #000 92%, transparent 100%);
}

.partners-track {
    display: flex;
    align-items: center;
    gap: var(--space-xl);
    width: max-content;
    animation: partners-scroll 26s linear infinite;
}

.partner-logo-card {
    flex: 0 0 auto;
    min-width: 140px;
    height: 74px;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    background: rgba(252, 249, 245, 0.7);
    border: 1px solid rgba(235, 220, 208, 0.55);
    box-shadow: var(--shadow-subtle);
    display: flex;
    align-items: center;
    justify-content: center;
}

.partner-logo-card img {
    max-width: 110px;
    max-height: 42px;
    width: auto;
    height: auto;
    object-fit: contain;
    filter: saturate(0.95);
    transition: var(--transition-fast);
}

.partner-logo-card:hover img {
    transform: scale(1.05);
}

@keyframes partners-scroll {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-50%);
    }
}

@media (max-width: 768px) {
    .partners-track {
        gap: var(--space-md);
        animation-duration: 18s;
    }

    .partner-logo-card {
        min-width: 120px;
        height: 68px;
        padding: 0.6rem 0.85rem;
    }

    .partner-logo-card img {
        max-width: 96px;
        max-height: 36px;
    }
}

/* Why Choose Us Section Styling */
.why-choose-section {
    padding: var(--space-xl) 0;
    position: relative;
    background-color: var(--color-bg-warm);
    overflow: hidden;
}

.why-choose-slogan-wrapper {
    margin-bottom: var(--space-xl);
}

.why-choose-slogan {
    font-family: var(--font-serif);
    font-style: italic;
    font-size: clamp(1.2rem, 3.5vw, 1.85rem);
    font-weight: 700;
    color: var(--color-primary);
    letter-spacing: -0.01em;
    margin: 0;
}

.chef-image-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 50px;
}

.chef-image {
    width: 85%;
    height: 480px;
    object-fit: cover;
    box-shadow: var(--shadow-medium);
    border-radius: 0;
}

.floating-info-card {
    position: absolute;
    bottom: 0;
    right: 5%;
    width: 55%;
    background-color: #0084f7;
    padding: var(--space-lg);
    box-shadow: var(--shadow-premium);
    color: var(--color-white);
    z-index: 5;
    display: flex;
    flex-direction: column;
}

.info-card-icon-box {
    margin-bottom: var(--space-md);
}

.info-card-icon {
    width: 44px;
    height: auto;
    filter: brightness(0) invert(1);
}

.info-card-text {
    font-size: 0.85rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.95);
    margin-bottom: var(--space-lg);
}

.info-card-btn {
    width: 40px;
    height: 40px;
    background-color: var(--color-accent);
    color: var(--color-white);
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: flex-start;
    transition: var(--transition-smooth);
    border-radius: 0;
}

.info-card-btn:hover {
    background-color: var(--color-accent-hover);
    transform: translateX(4px);
}

.info-card-btn-arrow {
    font-size: 1.2rem;
    font-weight: 700;
}

.why-choose-heading {
    font-size: clamp(1.8rem, 4vw, 2.65rem);
    line-height: 1.25;
    margin-top: var(--space-xs);
    margin-bottom: var(--space-md);
    color: var(--color-primary);
}

.why-choose-description {
    font-size: 0.95rem;
    color: var(--color-text-muted);
    margin-bottom: var(--space-lg);
    line-height: 1.7;
}

.why-choose-features-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    padding: 0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.feature-marker {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: rgba(231, 86, 42, 0.1);
    border: 1px solid var(--color-accent);
    position: relative;
    flex-shrink: 0;
}

.feature-marker::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background-color: var(--color-accent);
    border-radius: 50%;
    transform: translate(-50%, -50%);
}

.feature-text {
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: 1rem;
    color: var(--color-primary);
    letter-spacing: -0.01em;
}

@media (max-width: 992px) {
    .chef-image {
        width: 100%;
        height: 380px;
    }
    .floating-info-card {
        position: relative;
        right: 0;
        width: 100%;
        margin-top: -40px;
        z-index: 5;
    }
    .chef-image-wrapper {
        padding-bottom: 0;
    }
    .why-choose-grid {
        gap: var(--space-xl);
    }
}

/* Outside Catering Showcase Section Styling */
.catering-showcase-section {
    padding: var(--space-xl) 0;
    background-color: var(--color-bg-cream);
    position: relative;
}

.catering-showcase-heading {
    font-size: clamp(1.8rem, 4vw, 2.65rem);
    line-height: 1.25;
    margin-top: var(--space-xs);
    margin-bottom: var(--space-md);
    color: var(--color-primary);
}

.catering-showcase-description {
    font-size: 0.95rem;
    color: var(--color-text-muted);
    margin-bottom: var(--space-lg);
    line-height: 1.7;
}

.catering-accordion, .why-choose-accordion {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    margin-bottom: var(--space-lg);
}

.catering-accordion .accordion-item, .why-choose-accordion .accordion-item {
    border-bottom: 1px solid rgba(235, 220, 208, 0.4);
    padding-bottom: var(--space-sm);
}

.catering-accordion .accordion-item:last-child, .why-choose-accordion .accordion-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.catering-accordion .accordion-header, .why-choose-accordion .accordion-header {
    background: none;
    border: none;
    outline: none;
    padding: 0;
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    cursor: pointer;
    width: 100%;
    text-align: left;
}

.catering-accordion .accordion-toggle-icon, .why-choose-accordion .accordion-toggle-icon {
    color: var(--color-accent);
    font-size: 1.275rem;
    font-weight: 400;
    line-height: 1;
    width: 20px;
    display: inline-flex;
    justify-content: center;
    flex-shrink: 0;
}

.catering-accordion .accordion-title, .why-choose-accordion .accordion-title {
    font-family: var(--font-heading);
    font-weight: 500;
    font-size: 1rem;
    color: var(--color-primary);
    letter-spacing: -0.01em;
}

.catering-accordion .accordion-panel, .why-choose-accordion .accordion-panel {
    padding-left: 28px;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.22s ease-out, opacity 0.2s ease;
}

.catering-accordion .accordion-item.active .accordion-panel, .why-choose-accordion .accordion-item.active .accordion-panel {
    max-height: 80px;
    opacity: 1;
    margin-top: var(--space-xs);
}

.catering-accordion .accordion-desc, .why-choose-accordion .accordion-desc {
    font-size: 0.925rem;
    color: var(--color-text-muted);
    line-height: 1.6;
    margin: 0;
}

.catering-visual-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 60px;
}

.catering-visual-image {
    width: 100%;
    height: 480px;
    object-fit: cover;
    box-shadow: var(--shadow-medium);
}

.catering-stats-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    z-index: 5;
    box-shadow: var(--shadow-premium);
}

.catering-stat-box {
    width: 50%;
    padding: var(--space-md) var(--space-lg);
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.catering-stat-box.stat-blue {
    background-color: #0084f7;
}

.catering-stat-box.stat-orange {
    background-color: var(--color-accent);
}

.catering-stat-number {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 700;
    color: var(--color-white);
    line-height: 1.1;
    margin-bottom: 2px;
    font-family: var(--font-heading);
}

.catering-stat-label {
    font-size: 0.725rem;
    font-family: var(--font-heading);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255, 255, 255, 0.9);
}

@media (max-width: 992px) {
    .catering-visual-image {
        height: 380px;
    }
    .catering-visual-wrapper {
        padding-bottom: 0;
        margin-top: var(--space-xl);
    }
    .catering-stats-bar {
        position: relative;
        margin-top: 0;
    }
    .catering-showcase-grid {
        gap: var(--space-xl);
    }
}

/* Testimonials Section Styling */
.testimonial-section {
    padding: var(--space-xl) 0;
    background-color: var(--color-bg-warm);
    position: relative;
}

.testimonial-grid {
    position: relative;
}

.testimonial-image-wrapper {
    position: relative;
    width: 90%;
}

.testimonial-border-decor {
    position: absolute;
    top: var(--space-md);
    left: var(--space-md);
    width: 100%;
    height: 100%;
    border: 3px solid var(--color-secondary);
    z-index: 1;
}

.testimonial-image {
    width: 100%;
    height: 480px;
    object-fit: cover;
    box-shadow: var(--shadow-medium);
    position: relative;
    z-index: 2;
}

.quote-badge {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 60px;
    height: 60px;
    background-color: var(--color-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-subtle);
    z-index: 3;
}

.quote-badge-icon {
    width: 24px;
    height: auto;
    filter: brightness(0) invert(1);
}

.testimonial-heading {
    font-size: clamp(1.8rem, 4vw, 2.65rem);
    line-height: 1.25;
    margin-top: var(--space-xs);
    margin-bottom: var(--space-md);
    color: var(--color-primary);
}

.testimonial-slider-container {
    margin-top: var(--space-lg);
    position: relative;
    min-height: 250px;
}

.testimonial-slide {
    transition: opacity 0.4s ease;
}

.testimonial-stars {
    color: var(--color-secondary);
    margin-bottom: var(--space-md);
    display: flex;
    gap: 2px;
}

.testimonial-quote {
    font-family: var(--font-serif);
    font-style: italic;
    font-size: clamp(1.1rem, 2.5vw, 1.45rem);
    line-height: 1.6;
    color: var(--color-primary);
    margin-bottom: var(--space-lg);
}

.testimonial-author {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 1.15rem;
    color: var(--color-primary);
    margin-bottom: 2px;
}

.testimonial-role {
    font-size: 0.85rem;
    color: var(--color-text-muted);
}

.testimonial-nav {
    display: flex;
    gap: var(--space-sm);
    margin-top: var(--space-lg);
}

.testimonial-nav-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid var(--color-border);
    background-color: transparent;
    color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition-fast);
}

.testimonial-nav-btn:hover {
    background-color: var(--color-primary);
    color: var(--color-white);
    border-color: var(--color-primary);
}

@media (max-width: 992px) {
    .testimonial-image-wrapper {
        width: 100%;
        margin-bottom: var(--space-xl);
    }
    .testimonial-image {
        height: 380px;
    }
    .testimonial-grid {
        gap: var(--space-xl);
    }
}
</style>

