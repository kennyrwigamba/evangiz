<?php
/**
 * Evangiz Restaurant - Services Page
 */

$page_header_title = 'Our Services';
$page_header_image = '/image/page-header/page-private-event.jpg';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'Services'],
];

include __DIR__ . '/../includes/page-header.php';
?>

<!-- Core Services Grid -->
<section class="section core-services-section">
    <div class="container">
        <div class="text-center">
            <span class="section-label">What We Offer</span>
            <h2 class="section-heading">Exquisite Dining Solutions</h2>
            <p class="section-desc text-muted">We provide a range of tailored food service options to fit your schedule, group size, and event requirements.</p>
        </div>

        <div class="grid-2 stagger-container mt-xl">
            <?php
            // Card 1: Dine-In
            $dine_in_icon = '
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>';
            echo render_service_card($dine_in_icon, 'Dine-In Services', 'We offer a comfortable, family-friendly seating environment for guests who prefer to enjoy their meals hot right out of the kitchen. Ideal for individuals, families, and small business lunch groups.');

            // Card 2: Takeaway
            $takeaway_icon = '
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <line x1="9" y1="3" x2="9" y2="21"/>
            </svg>';
            echo render_service_card($takeaway_icon, 'Takeaway & Takeout', 'On the move? Our quick and efficient packaging systems ensure your food remains hot and fresh, ready for collection or quick transit. Ideal for busy work schedules.');

            // Card 3: Food Preparation
            $prep_icon = '
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                <path d="M12 6v6l4 2"/>
            </svg>';
            echo render_service_card($prep_icon, 'Food Prep & Quality', 'Every meal is prepared under strict hygiene guidelines using fresh local ingredients. We balance speed and meticulous preparation to deliver top-tier plates every single day.');

            // Card 4: Customer Support
            $support_icon = '
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>';
            echo render_service_card($support_icon, 'Exceptional Service', 'Our highly trained on-site team is always available to assist with meal selections, order custom modifications, and answer quick inquiries to support your dining comfort.');
            ?>
        </div>
    </div>
</section>

<!-- Premium Outside Catering Feature Panel -->
<section class="section catering-section dark-section">
    <div class="container">
        <div class="grid-2 align-items-center">
            <div class="catering-text animate-scroll-reveal reveal-left">
                <span class="section-label text-accent">Event Bookings</span>
                <h2>Outside Catering Services</h2>
                <p class="welcome-lead-para opacity-95">
                    Evangiz Restaurant brings the delectable flavors of our kitchen to your special events. Experience the perfect blend of culinary expertise and personalized service with our outside catering.
                </p>
                <p >
                    From corporate gatherings to private celebrations, we cater to your unique tastes and preferences, ensuring a memorable dining experience for you and your guests. Let us make your event extraordinary with our exquisite cuisine.
                </p>
                <div class="catering-ctas mt-lg">
                    <?php echo render_button('Explore Catering Services', url('/catering'), 'primary'); ?>
                </div>
            </div>
            
            <div class="catering-visual animate-scroll-reveal reveal-right">
                <div class="graphic-panel-wrapper">
                    <div class="panel-border-decor"></div>
                    <div class="panel-image-placeholder">
                        <video class="welcome-video" loop muted playsinline preload="none" poster="<?php echo url('/image/section/s-private.jpg'); ?>">
                            <source data-src="<?php echo url('/video/evangiz.mp4'); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
