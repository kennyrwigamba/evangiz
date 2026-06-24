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

<!-- Vision, Mission and Values Section -->
<section class="section vmv-section">
    <div class="container">
        <div class="text-center animate-scroll-reveal">
            <span class="section-label">Who We Are</span>
            <h2 class="section-heading">Vision, Mission and Values</h2>
        </div>
        <div class="grid-2 mt-lg gap-xl">
            <div class="vision-mission-box animate-scroll-reveal reveal-left">
                <h3 class="mb-sm">Our Vision</h3>
                <p>To deliver quality-assured catering services that satisfy and exceed our clients' needs at all types of events and locations.</p>
                <h3 class="mt-lg mb-sm">Our Mission</h3>
                <p>To deliver quality-assured catering services that satisfy and exceed our clients' needs at all types of events and locations.</p>
            </div>
            <div class="values-box animate-scroll-reveal reveal-right">
                <h3 class="mb-md">Core Values</h3>
                <ul class="values-list" style="list-style: none; padding-left: 0;">
                    <li style="margin-bottom: 1rem;"><strong class="text-accent" style="display: inline-block; width: 180px;">Professionalism:</strong> We uphold the highest standards in our work and conduct.</li>
                    <li style="margin-bottom: 1rem;"><strong class="text-accent" style="display: inline-block; width: 180px;">Reliability:</strong> Our clients can depend on us for consistent and timely service.</li>
                    <li style="margin-bottom: 1rem;"><strong class="text-accent" style="display: inline-block; width: 180px;">Eco-Consciousness:</strong> We prioritize sustainable practices and products.</li>
                    <li style="margin-bottom: 1rem;"><strong class="text-accent" style="display: inline-block; width: 180px;">Customer Focus:</strong> Your satisfaction is our top priority, and we tailor our services to meet your needs.</li>
                    <li style="margin-bottom: 1rem;"><strong class="text-accent" style="display: inline-block; width: 180px;">Food Safety:</strong> We follow strict food hygiene standards and medical requirements.</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- Gallery Section -->
<section class="section gallery-section">
    <div class="container">
        <div class="text-center animate-scroll-reveal">
            <span class="section-label">Visuals</span>
            <h2 class="section-heading">Our Gallery</h2>
        </div>
        <div class="grid-3 mt-lg gap-md animate-scroll-reveal">
            <div class="gallery-item"><img src="<?php echo url('/image/gallery/gal-1.jpg'); ?>" alt="Gallery Image 1" class="img-fluid rounded lightbox-img" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"></div>
            <div class="gallery-item"><img src="<?php echo url('/image/gallery/gal-2.jpg'); ?>" alt="Gallery Image 2" class="img-fluid rounded lightbox-img" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"></div>
            <div class="gallery-item"><img src="<?php echo url('/image/gallery/gal-3.jpg'); ?>" alt="Gallery Image 3" class="img-fluid rounded lightbox-img" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"></div>
            <div class="gallery-item"><img src="<?php echo url('/image/gallery/gal-4.jpg'); ?>" alt="Gallery Image 4" class="img-fluid rounded lightbox-img" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"></div>
            <div class="gallery-item"><img src="<?php echo url('/image/gallery/gal-5.jpg'); ?>" alt="Gallery Image 5" class="img-fluid rounded lightbox-img" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"></div>
            <div class="gallery-item"><img src="<?php echo url('/image/gallery/gal-6.jpg'); ?>" alt="Gallery Image 6" class="img-fluid rounded lightbox-img" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"></div>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-modal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.9); align-items: center; justify-content: center; flex-direction: column;">
    <span id="lightbox-close" style="position: absolute; top: 20px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
    <img id="lightbox-content" style="max-width: 90%; max-height: 80%; object-fit: contain; border-radius: 8px;">
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Lightbox logic
    const lightboxModal = document.getElementById('lightbox-modal');
    const lightboxImg = document.getElementById('lightbox-content');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxImages = document.querySelectorAll('.lightbox-img');

    if (lightboxModal && lightboxImages) {
        lightboxImages.forEach(img => {
            img.addEventListener('click', function() {
                lightboxModal.style.display = 'flex';
                lightboxImg.src = this.src;
            });
        });

        lightboxClose.addEventListener('click', function() {
            lightboxModal.style.display = 'none';
        });

        lightboxModal.addEventListener('click', function(e) {
            if (e.target === lightboxModal) {
                lightboxModal.style.display = 'none';
            }
        });
    }
});
</script>

<!-- Inline styles for About Page layout -->
<!-- Page styles moved to /css/pages/about.css for caching & performance -->
