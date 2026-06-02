<?php
/**
 * Evangiz Restaurant - Homepage
 */
?>

<!-- Hero Slider Section -->
<section class="hero-section">
    <div class="hero-bg-overlay"></div>
    <div class="container hero-container text-center">
        <div class="hero-content animate-slide-up">
            <h1 class="hero-title">
                <span class="text-serif">A Taste You’ll Remember</span><br>
                <span class="text-serif text-accent font-italic">Where Every Flavor Tells A Story!</span>
            </h1>
            <p class="hero-lead text-muted">
                Experience high-quality, delicious, and affordable local Ugandan staples & fast foods in Lubowa.
            </p>
            <div class="hero-ctas">
                <?php echo render_button('View Our Menu', url('/menu'), 'primary'); ?>
            </div>
        </div>
    </div>
    <!-- Curved Wave Divider -->
    <div class="hero-waves"></div>
</section>

<!-- Slogan & Welcome Section -->
<section class="section welcome-section">
    <div class="container welcome-container">
        <div class="grid-2 align-items-center">
            <!-- Text Content Column -->
            <div class="welcome-text-column animate-scroll-reveal reveal-left">
                <span class="section-label">Culinary Excellence</span>
                <h2 class="welcome-heading">A Culinary Adventure For All The Senses</h2>
                <div class="welcome-paragraphs">
                    <p class="welcome-lead-para">
                        Welcome to Evangiz Restaurant, where we pride ourselves on offering the best of both delicious, locally-sourced cuisine and top-notch service. We believe that the best meals start with the freshest ingredients. But we know that a great meal is about more than just the food.
                    </p>
                    <p>
                        That's why we also place a premium on providing exceptional service to each and every one of our guests. So if you're looking for a restaurant that offers the best of local cuisine and top-notch service, look no further. We can't wait to welcome you to our table and show you why we're one of the best restaurants in town!
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

<!-- Why Choose Us Section -->
<section class="section why-choose-section">
    <div class="container">
        <!-- Top Centered Slogan Banner -->
        <div class="why-choose-slogan-wrapper animate-scroll-reveal text-center">
            <h3 class="why-choose-slogan text-serif">We bring you a culinary experience like no other</h3>
        </div>

        <div class="grid-2 why-choose-grid align-items-center" style="margin-top: var(--space-xl);">
            <!-- Left Column: Chef Image & Overlapping Blue Box -->
            <div class="why-choose-image-column animate-scroll-reveal">
                <div class="chef-image-wrapper">
                    <img src="<?php echo url('/image/section/s-why.jpg'); ?>" alt="Evangiz Chef" class="chef-image">
                    
                    <!-- Overlapping Blue Box -->
                    <div class="floating-info-card">
                        <div class="info-card-icon-box">
                            <!-- Seafood / Shrimp Icon -->
                            <img src="<?php echo url('/image/item/shrimp.png'); ?>" alt="Shrimp Icon" class="info-card-icon">
                        </div>
                        <p class="info-card-text">
                            At Evangiz Restaurant we use fresh, locally sourced ingredients to create authentic Ugandan flavours with a modern touch. From comforting local dishes to quick snacks, our kitchen serves food made with care for every occasion.
                        </p>
                        <a href="<?php echo url('/about'); ?>" class="info-card-btn" aria-label="Read more">
                            <span class="info-card-btn-arrow">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Context & List -->
            <div class="why-choose-content-column animate-scroll-reveal">
                <span class="section-label">Why Choose Restaurant</span>
                <h2 class="why-choose-heading text-serif">Your Perfect Choice To Enjoy Seafood</h2>
                <div class="menu-title-wave" style="margin-bottom: var(--space-md);"></div>
                
                <p class="why-choose-description">
                    Evangiz Restaurant celebrates Ugandan flavours and hospitality. We offer relaxed, family-friendly dining and thoughtfully prepared meals using local ingredients &mdash; perfect for everyday lunches, special dinners, and events.
                </p>
                
                <ul class="why-choose-features-list">
                    <li class="feature-item">
                        <span class="feature-marker"></span>
                        <span class="feature-text">Food is always fresh</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-marker"></span>
                        <span class="feature-text">Professional chefs</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-marker"></span>
                        <span class="feature-text">Sea view dining table</span>
                    </li>
                </ul>
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
        
        <!-- Promo Cards Grid -->
        <div class="grid-3 menu-promo-grid" style="margin-top: var(--space-xl); margin-bottom: var(--space-xl);">
            <!-- Card 1: Special Menu -->
            <div class="menu-promo-card animate-scroll-reveal">
                <div class="promo-card-bg" style="background-image: url('<?php echo url("/image/section/menu_special.png"); ?>');"></div>
                <div class="promo-card-overlay"></div>
                <div class="promo-card-content">
                    <span class="promo-subtitle">Can not be ignored</span>
                    <h3 class="promo-title">Special Menu</h3>
                </div>
            </div>
            
            <!-- Card 2: Seasonal Food -->
            <div class="menu-promo-card animate-scroll-reveal">
                <div class="promo-card-bg" style="background-image: url('<?php echo url("/image/section/menu_seasonal.png"); ?>');"></div>
                <div class="promo-card-overlay"></div>
                <div class="promo-card-content">
                    <span class="promo-subtitle">Enjoy on occasion</span>
                    <h3 class="promo-title">Seasonal Food</h3>
                </div>
            </div>
            
            <!-- Card 3: Wine List -->
            <div class="menu-promo-card animate-scroll-reveal">
                <div class="promo-card-bg" style="background-image: url('<?php echo url("/image/section/menu_wine.png"); ?>');"></div>
                <div class="promo-card-overlay"></div>
                <div class="promo-card-content">
                    <span class="promo-subtitle">New experience</span>
                    <h3 class="promo-title">Wine List</h3>
                </div>
            </div>
        </div>

        <!-- Interactive Category Tabs -->
        <div class="menu-tabs-container animate-scroll-reveal" style="margin-bottom: var(--space-xl);">
            <button class="menu-tab active" data-category="fast-foods">Fast Foods</button>
            <button class="menu-tab" data-category="local-dishes">Local Dishes</button>
            <button class="menu-tab" data-category="snacks">Light Meals & Snacks</button>
            <button class="menu-tab" data-category="drinks">Soft Drinks</button>
        </div>

        <!-- Menu Listings Sheets -->
        <div class="menu-listings-wrapper">
            
            <!-- Category: Fast Foods -->
            <div class="menu-section" id="category-fast-foods">
                <div class="grid-2 text-left stagger-container">
                    <?php
                    echo render_food_item('Classic Beef Burger', 15000, 'Beef patty, lettuce, tomato, house sauce', ['Fast Foods']);
                    echo render_food_item('Beef Burger (Double)', 22000, 'Double beef, cheese, pickles', ['Fast Foods']);
                    echo render_food_item('Chicken Burger', 12000, 'Crispy chicken, mayo, lettuce', ['Fast Foods']);
                    echo render_food_item('Chicken Wings (6 pcs)', 14000, 'Spicy house wings', ['Fast Foods']);
                    echo render_food_item('French Fries', 6000, 'Crispy salted fries', ['Fast Foods']);
                    echo render_food_item('Onion Rings', 5000, 'Crispy beer-battered rings', ['Fast Foods']);
                    echo render_food_item('Fried Chicken (3 pcs)', 18000, 'Golden fried chicken pieces', ['Fast Foods']);
                    echo render_food_item('Grilled Chicken Sandwich', 11000, 'Grilled chicken, salad, sauce', ['Fast Foods']);
                    echo render_food_item('Pizza Slice', 10000, 'Cheese & tomato slice', ['Fast Foods']);
                    echo render_food_item('Veggie Burger', 10000, 'House vegetable patty', ['Fast Foods']);
                    ?>
                </div>
            </div>

            <!-- Category: Local Dishes -->
            <div class="menu-section" id="category-local-dishes" style="display: none;">
                <div class="grid-2 text-left stagger-container">
                    <?php
                    echo render_food_item('Traditional Beef Luwombo', 22000, 'Slow-cooked beef stew prepared traditionally inside banana leaves with rich spices', ['Local Dishes']);
                    echo render_food_item('Chicken Luwombo', 24000, 'Traditional local chicken stew steamed inside fresh banana leaves', ['Local Dishes']);
                    echo render_food_item('Matooke & Groundnut Stew', 12000, 'Steamed and mashed plantain served with rich peanut/groundnut paste sauce', ['Local Dishes']);
                    echo render_food_item('Fresh Whole Tilapia (Wet or Dry)', 25000, 'Local lake fish prepared to order, served with french fries or local foods', ['Local Dishes']);
                    echo render_food_item('Evangiz Local Platter', 26000, 'Combination of Matooke, sweet potatoes, yams, posho, rice, and beans, served with beef stew', ['Local Dishes']);
                    ?>
                </div>
            </div>

            <!-- Category: Snacks -->
            <div class="menu-section" id="category-snacks" style="display: none;">
                <div class="grid-2 text-left stagger-container">
                    <?php
                    echo render_food_item('Ugandan Rolex (2 Eggs, 2 Chapatis)', 5000, 'Famous local street snack consisting of rolled fried eggs and vegetables inside chapati', ['Snacks']);
                    echo render_food_item('Beef Samosas (3 pcs)', 4000, 'Crispy triangular pastry wrappers stuffed with spiced minced beef filling', ['Snacks']);
                    echo render_food_item('Vegetable Spring Rolls (3 pcs)', 3000, 'Crispy rolls stuffed with seasoned fresh garden vegetables', ['Snacks']);
                    echo render_food_item('Toasted Sandwich', 8000, 'Cheese and tomato, or ham and cheese fillings toasted to golden perfection', ['Snacks']);
                    ?>
                </div>
            </div>

            <!-- Category: Soft Drinks -->
            <div class="menu-section" id="category-drinks" style="display: none;">
                <div class="grid-2 text-left stagger-container">
                    <?php
                    echo render_food_item('Fresh Passion Fruit Juice', 5000, 'Chilled freshly-squeezed organic passion fruit juice', ['Soft Drinks']);
                    echo render_food_item('Spiced African Tea', 6000, 'Brewed hot milk tea infused with local ginger, tea leaves, and spices', ['Soft Drinks']);
                    echo render_food_item('House Brewed Coffee', 7000, 'Brewed aromatic coffee made from premium Ugandan coffee beans', ['Soft Drinks']);
                    echo render_food_item('Soda (350ml)', 3000, 'Chilled Coca Cola, Fanta, Sprite, or Stoney in classic glass bottles', ['Soft Drinks']);
                    echo render_food_item('Mineral Water (500ml)', 2500, 'Bottled pure mineral drinking water served chilled or room temp', ['Soft Drinks']);
                    ?>
                </div>
            </div>

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
                            <span class="accordion-title">Corporate gatherings</span>
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
                            <span class="accordion-title">Private celebrations</span>
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
                            <span class="accordion-title">Flexible event catering</span>
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
    const accHeaders = document.querySelectorAll('.catering-accordion .accordion-header');
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
        'quote' => "We hired Evangiz Restaurant for our corporate event catering, and they exceeded all expectations. The presentation was gorgeous, the food was delicious, and the staff was extremely professional.",
        'author' => "Aisha Namurinda",
        'role' => "HR Manager",
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


<!-- Additional Homepage Styles inline for beautiful layout support -->
<style>
/* Hero Styles */
.hero-section {
    position: relative;
    padding: var(--space-xxl) 0;
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--color-primary);
    color: var(--color-white);
    background-image: url('<?php echo url("/image/page-header/slide-index-1.jpg"); ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
}

.hero-waves {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 20px;
    background-color: var(--color-bg-warm);
    z-index: 2;
    -webkit-mask: url('<?php echo url("/image/item/page-title-wave.png"); ?>') repeat-x bottom / auto 20px;
    mask: url('<?php echo url("/image/item/page-title-wave.png"); ?>') repeat-x bottom / auto 20px;
}

.hero-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(11, 19, 37, 0.4) 0%, rgba(11, 19, 37, 0.8) 100%);
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

@media (max-width: 576px) {
    .hero-ctas {
        flex-direction: column;
        align-items: center;
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
    height: 380px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: var(--space-lg);
    box-shadow: var(--shadow-medium);
    transition: var(--transition-smooth);
    cursor: pointer;
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
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: rgba(231, 86, 42, 0.1);
    border: 2px solid var(--color-accent);
    position: relative;
    flex-shrink: 0;
}

.feature-marker::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 6px;
    height: 6px;
    background-color: var(--color-accent);
    border-radius: 50%;
    transform: translate(-50%, -50%);
}

.feature-text {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 1.15rem;
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

.catering-accordion {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    margin-bottom: var(--space-lg);
}

.catering-accordion .accordion-item {
    border-bottom: 1px solid rgba(235, 220, 208, 0.4);
    padding-bottom: var(--space-sm);
}

.catering-accordion .accordion-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.catering-accordion .accordion-header {
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

.catering-accordion .accordion-toggle-icon {
    color: var(--color-accent);
    font-size: 1.275rem;
    font-weight: 400;
    line-height: 1;
    width: 20px;
    display: inline-flex;
    justify-content: center;
    flex-shrink: 0;
}

.catering-accordion .accordion-title {
    font-family: var(--font-heading);
    font-weight: 500;
    font-size: 1rem;
    color: var(--color-primary);
    letter-spacing: -0.01em;
}

.catering-accordion .accordion-panel {
    padding-left: 28px;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.22s ease-out, opacity 0.2s ease;
}

.catering-accordion .accordion-item.active .accordion-panel {
    max-height: 80px;
    opacity: 1;
    margin-top: var(--space-xs);
}

.catering-accordion .accordion-desc {
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

