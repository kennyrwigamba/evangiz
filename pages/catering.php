<?php
/**
 * Evangiz Restaurant - Outside Catering Page
 */

$page_header_title = 'Outside Catering';
$page_header_image = '/image/page-header/page-private-event.jpg';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'Catering'],
];

include __DIR__ . '/../includes/page-header.php';
?>

<!-- Intro Showcase Section -->
<section class="section catering-intro-section">
    <div class="container">
        <div class="grid-2 align-items-center">
            <div class="catering-intro-text animate-scroll-reveal reveal-left">
                <span class="section-label text-accent">Tailored Event Dining</span>
                <h2>Exceptional Flavor, Wherever You Are</h2>
                <div class="menu-title-wave mb-md mt-xs"></div>
                <p class="welcome-lead-para">
                    Evangiz Restaurant brings the celebrated culinary artistry of our kitchen directly to your corporate venues, private properties, and events across Kampala and Entebbe Road.
                </p>
                <p>
                    Whether you are planning a professional lunch for corporate stakeholders, a lively graduation celebration, or an elegant wedding banquet, our culinary squad handles the details. We customize menus that balance authentic Ugandan heritage and modern comfort fast foods.
                </p>
                <p>
                    From initial food prep to site setup, our teams ensure exceptional hygiene, stunning presentation, and premium hospitality that leaves your guests thoroughly impressed.
                </p>
                <div class="mt-lg">
                    <a href="#catering-packages" class="btn btn-secondary">
                        <span class="btn-text-wrapper">
                            <span class="btn-text-main">Explore Packages</span>
                            <span class="btn-text-hover">Explore Packages</span>
                        </span>
                    </a>
                </div>
            </div>
            
            <div class="catering-intro-visual animate-scroll-reveal reveal-right">
                <div class="graphic-panel-wrapper">
                    <div class="panel-border-decor"></div>
                    <div class="panel-image-placeholder">
                        <img src="<?php echo url('/image/section/s-private.jpg'); ?>" alt="Evangiz Catering Event Setup" class="media-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catering Types Section -->
<section class="section catering-types-section dark-section">
    <div class="container">
        <div class="text-center">
            <span class="section-label text-accent">Solutions for Every Occasion</span>
            <h2 class="section-heading text-white">Catering Services We Provide</h2>
            <p class="section-desc text-muted">We design bespoke catering layouts suited for any group size, theme, and taste preferences.</p>
        </div>

        <div class="grid-3 stagger-container mt-xl">
            <!-- Solution 1: Corporate Events -->
            <div class="type-card animate-scroll-reveal">
                <div class="type-icon-box">
                    <i class="hgi hgi-stroke hgi-rounded hgi-briefcase-09"></i>
                </div>
                <h3>Corporate Gatherings</h3>
                <p>Office luncheons, networking events, conferences, and stakeholder board meetings. We deliver neat, fresh, and professional buffet spreads with minimal disruption.</p>
            </div>

            <!-- Solution 2: Social Celebrations -->
            <div class="type-card animate-scroll-reveal">
                <div class="type-icon-box">
                    <i class="hgi hgi-stroke hgi-rounded hgi-party"></i>
                </div>
                <h3>Social Celebrations</h3>
                <p>Birthdays, graduations, family anniversaries, and house-warming parties. Delight your friends and relatives with hearty local stews, tasty rolex rolls, and fresh fast food bars.</p>
            </div>

            <!-- Solution 3: Weddings & Banquets -->
            <div class="type-card animate-scroll-reveal">
                <div class="type-icon-box">
                    <i class="hgi hgi-stroke hgi-rounded hgi-wedding"></i>
                </div>
                <h3>Weddings & Galas</h3>
                <p>From intimate traditional ceremonies to lavish wedding receptions. We plan full-service buffet lines, premium carving tables, drink bars, and professional service staff.</p>
            </div>
        </div>
    </div>
</section>

<!-- Catering Packages Section -->
<section id="catering-packages" class="section packages-section">
    <div class="container">
        <div class="text-center animate-scroll-reveal">
            <span class="section-label">Bespoke Dining Menus</span>
            <h2 class="section-heading">Curated Catering Packages</h2>
            <p class="section-desc text-muted">Select one of our popular predefined menus or choose a custom option in the inquiry form below.</p>
        </div>

        <div class="grid-3 packages-grid mt-xl">
            <!-- Package 1: Bronze -->
            <div class="package-card animate-scroll-reveal">
                <div class="package-header">
                    <span class="package-badge bronze-badge">Local Staple</span>
                    <h3 class="package-title">Bronze Local Buffet</h3>
                    <div class="package-price">
                        <span class="currency">UGX</span>
                        <span class="amount">6,000</span>
                        <span class="per">/ Plate</span>
                    </div>
                </div>
                <ul class="package-features">
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Traditional Beef Luwombo</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Steamed Matooke & Sweet Potatoes</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Steamed Rice, Posho & Beans</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Creamy Groundnut Stew paste</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Fresh Garden Salad</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Fresh Passion Fruit Juice</li>
                </ul>
                <div class="package-action">
                    <a href="#catering-inquiry-section" class="btn btn-primary-outline select-pkg-btn" data-package="Bronze Local Buffet">
                        <span class="btn-text-wrapper">
                            <span class="btn-text-main">Select Bronze</span>
                            <span class="btn-text-hover">Select Bronze</span>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Package 2: Silver (Highlighted) -->
            <div class="package-card highlighted animate-scroll-reveal">
                <div class="package-highlight-label">Most Popular</div>
                <div class="package-header">
                    <span class="package-badge silver-badge">Evangiz Signature</span>
                    <h3 class="package-title">Silver Fusion Feast</h3>
                    <div class="package-price">
                        <span class="currency">UGX</span>
                        <span class="amount">10,000</span>
                        <span class="per">/ Plate</span>
                    </div>
                </div>
                <ul class="package-features">
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Spiced Grilled Chicken Skewers</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Chicken / Beef Luwombo</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Fresh Fried Crispy Tilapia pieces</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Steamed Matooke & Rice</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Vegetable Rolls & Beef Samosas</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Fresh Juice / Bottled Sodas</li>
                </ul>
                <div class="package-action">
                    <a href="#catering-inquiry-section" class="btn btn-primary select-pkg-btn" data-package="Silver Fusion Feast">
                        <span class="btn-text-wrapper">
                            <span class="btn-text-main">Select Silver</span>
                            <span class="btn-text-hover">Select Silver</span>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Package 3: Gold -->
            <div class="package-card animate-scroll-reveal">
                <div class="package-header">
                    <span class="package-badge gold-badge">Gourmet Luxury</span>
                    <h3 class="package-title">Gold Royal Banquet</h3>
                    <div class="package-price">
                        <span class="currency">UGX</span>
                        <span class="amount">15,000</span>
                        <span class="per">/ Plate</span>
                    </div>
                </div>
                <ul class="package-features">
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Custom Burger & Pizza bar setup</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Traditional Luwombos (All styles)</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Whole Tilapia and Fried Fish cuts</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Premium Dessert & Pastry platter</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Coffee, Spiced Tea & Soda bar</li>
                    <li><i class="hgi-stroke hgi-tick-01 text-accent"></i> Dedicated servers & table decor</li>
                </ul>
                <div class="package-action">
                    <a href="#catering-inquiry-section" class="btn btn-primary-outline select-pkg-btn" data-package="Gold Royal Banquet">
                        <span class="btn-text-wrapper">
                            <span class="btn-text-main">Select Gold</span>
                            <span class="btn-text-hover">Select Gold</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catering Inquiry Form Section -->
<section id="catering-inquiry-section" class="section catering-inquiry-section">
    <div class="container">
        <div class="grid-2 contact-grid">
            <!-- Column 1: Details & Address -->
            <div class="contact-info-column animate-scroll-reveal reveal-left">
                <h2 class="contact-main-heading">Let's Plan Your Event!</h2>
                <p class="contact-lead-desc">
                    Tell us about your event and catering requirements, and our team will get back to you with a personalized quotation within 24 hours.
                </p>
                
                <!-- Orange wave divider -->
                <div class="menu-title-wave mb-lg mt-sm"></div>


                <div class="contact-links-box mb-lg">
                    <p class="contact-link-item">Mail: <a href="mailto:info@evangiz.com">info@evangiz.com</a></p>
                    <p class="contact-link-item">Call for inquiries: <a href="tel:+256705183818">+256-705183818</a> / <a href="tel:+256784618282">+256-784618282</a></p>
                </div>
                
                <!-- Social links circle badges -->
                <div class="contact-social-row">
                    <a href="https://www.tiktok.com/@evangizrestaurant" aria-label="TikTok" class="contact-social-circle" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor" aria-hidden="true"><path d="M448 209.9a210.1 210.1 0 0 1-122.8-39.3v178.7a162.6 162.6 0 1 1-140.2-161v89.9a74.6 74.6 0 1 0 52.2 71.2V0h88a122.2 122.2 0 0 0 55.8 102.4 121.4 121.4 0 0 0 67 20.1z"></path></svg>
                    </a>
                    <a href="mailto:info@evangiz.com" aria-label="Mail" class="contact-social-circle" target="_blank">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </a>
                    <a href="https://www.instagram.com/evangizrestaurant" aria-label="Instagram" class="contact-social-circle" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="https://www.youtube.com/@evangizrestaurant" aria-label="YouTube" class="contact-social-circle" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="5" width="20" height="14" rx="4"></rect><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Catering Inquiry Form -->
            <div class="contact-forms-column animate-scroll-reveal reveal-right">
                <form action="<?php echo url('/contact'); ?>" method="POST" id="catering-form" class="clean-form" novalidate>
                    <!-- Required routing parameters -->
                    <input type="hidden" name="form_type" value="booking">
                    <input type="hidden" name="subject" value="Catering Inquiry">

                    <div class="form-group">
                        <label class="form-label hidden">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name*" required>
                        <span class="form-error-msg"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label hidden">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email*" required>
                        <span class="form-error-msg"></span>
                    </div>

                    <div class="grid-2 gap-x-md">
                        <div class="form-group">
                            <label class="form-label hidden">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number*" required>
                            <span class="form-error-msg"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label hidden">Estimated Guests</label>
                            <input type="number" name="guests" class="form-control" placeholder="Guests (Number)*" min="1" required>
                            <span class="form-error-msg"></span>
                        </div>
                    </div>

                    <div class="grid-2 gap-x-md">
                        <div class="form-group">
                            <label class="form-label hidden">Event Date</label>
                            <input type="date" name="booking_date" class="form-control" required>
                            <span class="form-error-msg"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label hidden">Setup Time</label>
                            <input type="time" name="booking_time" class="form-control" required>
                            <span class="form-error-msg"></span>
                        </div>
                    </div>

                    <div class="grid-2 gap-x-md">
                        <div class="form-group">
                            <label class="form-label hidden">Event Type</label>
                            <select name="event_type" id="event_type" class="form-control form-select">
                                <option value="" disabled selected>Select Event Type</option>
                                <option value="Corporate Event">Corporate Event</option>
                                <option value="Birthday Party">Birthday Party</option>
                                <option value="Wedding Reception">Wedding Reception</option>
                                <option value="Graduation Ceremony">Graduation Ceremony</option>
                                <option value="Family Gathering">Family Gathering</option>
                                <option value="Other">Other Occasion</option>
                            </select>
                            <span class="form-error-msg"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label hidden">Preferred Package</label>
                            <select name="preferred_package" id="preferred_package" class="form-control form-select">
                                <option value="" disabled selected>Select Preferred Package</option>
                                <option value="Bronze Local Buffet">Bronze Local Buffet (UGX 6K/plate)</option>
                                <option value="Silver Fusion Feast">Silver Fusion Feast (UGX 10K/plate)</option>
                                <option value="Gold Royal Banquet">Gold Royal Banquet (UGX 15K/plate)</option>
                                <option value="Custom Menu / Package">Bespoke / Custom Menu</option>
                            </select>
                            <span class="form-error-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label hidden">Menu & Venue Details</label>
                        <textarea name="message" id="catering_details" class="form-control form-textarea" placeholder="Menu preferences, venue location details, or special requests..." rows="5"></textarea>
                        <span class="form-error-msg"></span>
                    </div>

                    <div class="form-action-row mt-md">
                        <button type="submit" class="btn-send-message btn-send-message-accent">SUBMIT INQUIRY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Package Selector and Form Interactivity Scripts -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectPkgBtns = document.querySelectorAll('.select-pkg-btn');
    const preferredPkgDropdown = document.getElementById('preferred_package');
    const cateringDetailsText = document.getElementById('catering_details');
    const inquirySection = document.getElementById('catering-inquiry-section');

    selectPkgBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const pkgName = btn.getAttribute('data-package');
            
            // Set package dropdown value
            if (preferredPkgDropdown) {
                preferredPkgDropdown.value = pkgName;
            }
            
            // Append note to special requests textarea
            if (cateringDetailsText) {
                cateringDetailsText.value = `I would like to inquire about the "${pkgName}" package for our event. Please provide options and details.`;
            }

            // Scroll smoothly to form section
            if (inquirySection) {
                inquirySection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
</script>

<!-- Inline styles for Catering Page Layout -->
<!-- Page styles moved to /css/pages/catering.css for caching & performance -->
