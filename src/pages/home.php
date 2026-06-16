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
        '/image/page-header/page-header_5.jpg',
        '/image/page-header/page-header_3_1.jpg',
        '/image/page-header/page-header_1.jpg',
        '/image/page-header/page-header_4.jpg',
        '/image/page-header/page-header_2.jpg',
    ];
    ?>
    <div class="hero-slider" aria-hidden="true">
        <?php foreach ($hero_slides as $index => $slide): ?>
            <?php if ($index === 0): ?>
                <div class="hero-slide active" style="background-image: url('<?php echo url($slide); ?>');"></div>
            <?php else: ?>
                <div class="hero-slide" data-bg="<?php echo url($slide); ?>"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="hero-bg-overlay"></div>
    <div class="container hero-container text-center">
        <div class="hero-content animate-slide-up">
            <h1 class="hero-title">
                <span class="hero-title-thin">A Taste You’ll Remember</span><br>
                <span>Where Every Flavor</span> <span class="font-italic hero-title-accent hero-accent-rotator"><i> Creates A Memory!</i></span>
            </h1>
            <p class="hero-lead text-muted">
                Experience high-quality, delicious, and affordable local Ugandan staples & fast foods in Lubowa.
            </p>
            <div class="hero-ctas">
                <?php echo render_button('View Our Menu', url('/menu'), 'primary'); ?>
                <?php echo render_button('Evangiz Catering', url('/catering'), 'white'); ?>
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
<section class="section promo-grid-section">
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
                        <video class="welcome-video" loop muted playsinline preload="none" poster="<?php echo url('/image/section/about.jpg'); ?>">
                            <source data-src="<?php echo url('/video/evangiz.mp4'); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Partners Logo Strip -->
<section class="section partners-section" style="margin-top: -30px">
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

<!-- Outside Catering Section -->
<section class="section catering-showcase-section" style="background-color: transparent!important; margin-top: 30px;">
    <div class="container">


        <div class="grid-2 catering-showcase-grid align-items-center">

            <!-- Left Column: Visual Setup and Stats Box  -->
             <div class="catering-showcase-visual animate-scroll-reveal">
                <div class="catering-visual-wrapper">
                    <img src="<?php echo url('/image/section/outside-catering-3.jpg'); ?>" alt="Evangiz Catering Event Setup" class="catering-visual-image">
                    
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
            
            
            <!-- Right Column: Context & Accordion-->
             <div class="catering-showcase-content animate-scroll-reveal">
                <span class="section-label">Outside Catering</span>
                <h2 class="catering-showcase-heading text-serif">Outside Catering For Your Event</h2>
                
                <p class="catering-showcase-description">
                    Evangiz Restaurant brings the delectable flavors of our kitchen to your special events. Experience the perfect blend of culinary expertise and personalized service with our outside catering for gatherings along Kampala–Entebbe Road and beyond.
                </p>

                <p class="catering-showcase-description">Our dedicated team handles every detail with professionalism and care, offering customized menus, prompt service, and exceptional food quality to suit events of all sizes. </p>
                
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
                <div class=" catering-showcase-action catering-showcase-action--spaced">
                    <?php echo render_button('Explore Catering Services', url('/catering'), 'outline', 'btn-view-menu'); ?>
                </div>

                
            </div>
            


        </div>


    </div>
</section>

<!-- Menu Preview Highlight -->
<section class="section menu-preview-section menu-preview-section--tight">
    <div class="menu-preview-overlay"></div>
    <div class="container menu-preview-inner">
        
        <!-- Section Header with Category Tabs and View Menu Button -->
        <div class="menu-preview-header-row animate-scroll-reveal">
            <div class="menu-preview-title-box">
                <h2 class="menu-preview-main-title text-serif">Our Menu</h2>
                <div class="menu-title-wave"></div>
            </div>
            <div class="menu-tabs-container menu-tabs-container--inline">
                <?php $is_first = true; ?>
                <?php foreach ($categories as $cat): ?>
                    <button class="menu-tab <?php echo $is_first ? 'active' : ''; ?>" data-category="<?php echo htmlspecialchars($cat['slug']); ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </button>
                    <?php $is_first = false; ?>
                <?php endforeach; ?>
            </div>
            <div class="menu-preview-action">
                <?php echo render_button('View Menu', url('/menu'), 'outline', 'btn-view-menu btn-view-menu-accent'); ?>
            </div>
        </div>

        <!-- Menu Listings Sheets -->
        <div class="menu-listings-wrapper">
            <?php $is_first = true; ?>
            <?php foreach ($categories as $cat): ?>
                <?php $cat_slug = $cat['slug']; ?>
                <?php $category_items = $menu_by_category[$cat_slug] ?? []; ?>
                <?php $has_extra_items = count($category_items) > 4; ?>
                <div class="menu-section<?php echo $has_extra_items ? ' has-extra' : ''; ?>" id="category-<?php echo htmlspecialchars($cat_slug); ?>" style="<?php echo $is_first ? '' : 'display: none;'; ?>">
                    <div class="menu-preview-list-shell">
                        <div class="grid-2 text-left stagger-container menu-preview-grid">
                        <?php
                        foreach ($category_items as $index => $item) {
                            $tags = !empty($item['tags']) ? array_map('trim', explode(',', $item['tags'])) : [];
                            $preview_class = $index >= 4 ? 'menu-preview-extra-item' : '';
                            echo render_food_item($item['name'], $item['price'], $item['description'], $tags, $preview_class);
                        }
                        ?>
                        </div>
                    </div>
                    <?php if ($has_extra_items): ?>
                        <div class="menu-preview-more-row">
                            <button class="menu-preview-more-btn" type="button" aria-label="View more menu items">
                                <span class="menu-preview-more-text">View More</span>
                                <span class="menu-preview-more-arrow" aria-hidden="true"></span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $is_first = false; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Why Choose Us Section -->
<section class="section why-choose-section" style="background-color: white;">
    <div class="container">
        <!-- Top Centered Slogan Banner -->
        <!--<div class="why-choose-slogan-wrapper animate-scroll-reveal text-center">
            <h3 class="why-choose-slogan text-serif">We bring you a culinary experience like no other</h3>
        </div>-->

        <div class="grid-2 why-choose-grid align-items-center why-choose-grid--spaced">


            <!-- Left Column: Context & List -->
            <div class="why-choose-content-column animate-scroll-reveal">
                <span class="section-label">Why Choose Evangiz Restaurant</span>
                <h2 class="why-choose-heading text-serif">We bring you a Culinary experience like no other</h2>
                
                <p class="why-choose-description">
                    Evangiz Restaurant celebrates Ugandan flavours and hospitality. We offer relaxed, family-friendly dining and thoughtfully prepared meals using local ingredients &mdash; perfect for everyday lunches, special dinners, and events.
                </p>
                
                <!-- Why Choose Accordion -->
                <div class="why-choose-accordion why-choose-accordion--spaced">
                    <!-- Item 1: Food is always fresh -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Food is always fresh</span>
                        </button>
                        <div class="accordion-panel">
                            <p class="accordion-desc">
                                We prepare our dishes daily using fresh, locally sourced Ugandan ingredients, organic produce, and premium food delivered straight from our kitchen.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Item 2: Professional chefs -->
                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="accordion-toggle-icon">&plus;</span>
                            <span class="accordion-title">Professional Chefs</span>
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

              
                <div class="catering-ctas mt-lg" style="margin-top: 60px!important;">
                    <?php echo render_button('View Our Services', url('/services'), 'primary'); ?>
                </div>
            </div>

            <!-- Right Column: Chef Image & Overlapping Blue Box -->
            <div class="why-choose-image-column animate-scroll-reveal">
                <div class="chef-image-wrapper">
                    <img src="<?php echo url('/image/section/s-why.jpg'); ?>" alt="Evangiz Chef" class="chef-image">
                    
                    <!-- Overlapping Blue Box -->
                    <div class="floating-info-card">
                        
                        <p class="info-card-text info-card-text--flush">
                            At Evangiz Restaurant we use fresh, locally sourced ingredients to create authentic Ugandan flavours with a modern touch. From comforting local dishes to quick snacks, our kitchen serves food made with care.
                        </p>
                        <a href="<?php echo url('/about'); ?>" class="info-card-btn hidden" aria-label="Read more">
                            <span class="info-card-btn-arrow"> &rarr;</span>
                        </a>
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
                <div class="menu-title-wave menu-title-wave--mb-lg"></div>
                
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
    const heroAccent = document.querySelector('.hero-accent-rotator');
    const heroAccentText = heroAccent ? heroAccent.querySelector('i') : null;

    if (heroAccent && heroAccentText) {
        const phrases = [' Creates A Memory!', ' Feels Like Home!', ' Inspires Moments!'];
        let phraseIndex = 0;

        const rotateAccent = () => {
            heroAccent.classList.add('is-changing');
            window.setTimeout(() => {
                phraseIndex = (phraseIndex + 1) % phrases.length;
                heroAccentText.textContent = phrases[phraseIndex];
            }, 280);

            window.setTimeout(() => {
                heroAccent.classList.remove('is-changing');
            }, 720);
        };

        const flipTimer = window.setInterval(() => {
            rotateAccent();
        }, 3200);
    }

    if (!heroSlides.length || !heroDots.length) {
        return;
    }

    let currentHeroSlide = 0;
    let heroTimer = null;

    // Swap a slide's deferred background-image into place the first time it is needed.
    const ensureSlideBg = (slide) => {
        if (slide && slide.dataset.bg) {
            slide.style.backgroundImage = "url('" + slide.dataset.bg + "')";
            delete slide.dataset.bg;
        }
    };

    const showHeroSlide = (index) => {
        currentHeroSlide = (index + heroSlides.length) % heroSlides.length;

        // Load the slide we are about to show (and the next one) before transitioning.
        ensureSlideBg(heroSlides[currentHeroSlide]);
        ensureSlideBg(heroSlides[(currentHeroSlide + 1) % heroSlides.length]);

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

    // Warm the remaining slide backgrounds during browser idle time so later
    // transitions are instant without competing with the initial paint (LCP).
    const warmRemaining = () => heroSlides.forEach(ensureSlideBg);
    if ('requestIdleCallback' in window) {
        requestIdleCallback(warmRemaining, { timeout: 3000 });
    } else {
        window.addEventListener('load', () => window.setTimeout(warmRemaining, 1500));
    }
});
</script>


<!-- Additional Homepage Styles inline for beautiful layout support -->
<!-- Page styles moved to /css/pages/home.css for caching & performance -->
