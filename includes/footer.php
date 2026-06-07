<?php
/**
 * Evangiz Restaurant - Global Footer Layout
 */
$current_path = $path ?? '/';
?>
    </div> <!-- Close #site-wrapper -->

    <footer class="footer-wrapper">
        <div class="container footer-container">
            <!-- Brand Column -->
            <div class="footer-col footer-col-brand">
                <a href="<?php echo url('/'); ?>" class="footer-logo">
                    <img src="image/logo/logo-footer.png" alt="" style="max-height: 100px;">
                </a>
                <p class="footer-brand-desc">
                    Where every flavor tells a story. We serve Premium Fast Food, Authentic Local Ugandan dishes, and professional outside catering services along Kampala–Entebbe Road opposite Roofings Lubowa.
                </p>
                <div class="footer-socials">
                    <!-- Custom mock social links with simple SVG icons -->
                    <a href="https://www.youtube.com/@evangizrestaurant" aria-label="YouTube" class="social-link" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="4"></rect><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>
                    </a>
                    <a href="https://www.instagram.com/evangizrestaurant" aria-label="Instagram" class="social-link" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="https://www.tiktok.com/@evangizrestaurant" aria-label="TikTok" class="social-link" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor" aria-hidden="true"><path d="M448 209.9a210.1 210.1 0 0 1-122.8-39.3v178.7a162.6 162.6 0 1 1-140.2-161v89.9a74.6 74.6 0 1 0 52.2 71.2V0h88a122.2 122.2 0 0 0 55.8 102.4 121.4 121.4 0 0 0 67 20.1z"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Links Column -->
            <div class="footer-col footer-col-links">
                <h4 class="footer-title">Explore</h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo url('/menu'); ?>">Food Menu</a></li>
                    <li><a href="<?php echo url('/about'); ?>">About Us</a></li>
                    <li><a href="<?php echo url('/services'); ?>">Our Services</a></li>
                    <li><a href="<?php echo url('/blog'); ?>">Blog & News</a></li>
                    <li><a href="<?php echo url('/contact'); ?>">Contact Us</a></li>
                </ul>
            </div>

            <!-- Working Hours Column -->
            <div class="footer-col footer-col-hours">
                <h4 class="footer-title">Opening Hours</h4>
                <ul class="footer-hours-list">
                    <li>
                        <span class="day">Monday - Friday</span>
                        <span class="time">9:00am - 11:00pm</span>
                    </li>
                    <li>
                        <span class="day">Saturday</span>
                        <span class="time">9:00am - 11:00pm</span>
                    </li>
                    <li>
                        <span class="day">Sunday</span>
                        <span class="time">9:00am - 11:00pm</span>
                    </li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="footer-col footer-col-contact">
                <h4 class="footer-title">Get In Touch</h4>
                <address class="footer-address">
                    <p class="footer-contact-item">
                        <strong>Location:</strong> Lubowa, Kampala-Entebbe Road (directly Opposite Roofings)
                    </p>
                    <p class="footer-contact-item">
                        <strong>Tel:</strong> <a href="tel:+256705183818">+256-705183818</a>
                    </p>
                    <p class="footer-contact-item">
                        <strong>Tel 2:</strong> <a href="tel:+256784618282">+256-784618282</a>
                    </p>
                    <p class="footer-contact-item">
                        <strong>Email:</strong> <a href="mailto:info@evangiz.com">info@evangiz.com</a>
                    </p>
                </address>
            </div>
        </div>

        <!-- Copyright Info -->
        <div class="footer-bottom">
            <div class="container footer-bottom-container">
                <p class="copyright-text">
                    &copy; <?php echo date('Y'); ?> Evangiz Restaurant. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Global Scripts -->
    <script src="<?php echo url('/js/main.js'); ?>?v=<?php echo filemtime(__DIR__ . '/../js/main.js'); ?>"></script>
    <script src="<?php echo url('/js/animations.js'); ?>?v=<?php echo filemtime(__DIR__ . '/../js/animations.js'); ?>"></script>
    
    <!-- Conditional Page-Specific Scripts -->
    <?php if ($current_path === '/menu' || $current_path === '/' || $current_path === '/home'): ?>
        <script src="<?php echo url('/js/menu-filter.js'); ?>?v=<?php echo filemtime(__DIR__ . '/../js/menu-filter.js'); ?>"></script>
    <?php elseif ($current_path === '/contact'): ?>
        <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
        <script src="<?php echo url('/js/contact-form.js'); ?>?v=<?php echo filemtime(__DIR__ . '/../js/contact-form.js'); ?>"></script>
    <?php endif; ?>
</body>
</html>
