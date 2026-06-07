<?php
/**
 * Evangiz Restaurant - Split Center-Logo Navigation Bar
 */
$current_path = $path ?? '/';
if (!function_exists('is_active')) {
    function is_active($route, $current_path) {
        if ($route === '/blog' && $current_path === '/blog-post') {
            return 'active';
        }
        if ($route === '/' && $current_path === '/home') {
            return 'active';
        }
        return ($route === $current_path) ? 'active' : '';
    }
}
?>
<header class="navbar-wrapper">
    <div class="container navbar-container">
        <!-- Logo Branding for Mobile (Visible on Mobile, Hidden on Desktop) -->
        <a href="<?php echo url('/'); ?>" class="navbar-logo-mobile">
            <img src="<?php echo url('/image/logo/logo.png'); ?>" alt="Evangiz Logo">
            <span class="mobile-logo-text font-serif">Evangiz</span>
        </a>

        <!-- Hamburger Icon for Mobile -->
        <button class="navbar-toggle" id="mobile-menu-toggle" aria-label="Toggle Navigation">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>

        <!-- Split Navigation Menu Links -->
        <nav class="navbar-menu" id="navbar-menu-container">
            <!-- Mobile Menu Brand Logo -->
            <div class="mobile-menu-brand">
                <a href="<?php echo url('/'); ?>" class="mobile-menu-logo font-serif">Evangiz</a>
            </div>

            <!-- Left Side Menu Links -->
            <ul class="nav-list nav-list-left">
                <li class="nav-item">
                    <a href="<?php echo url('/'); ?>" class="nav-link <?php echo is_active('/', $current_path); ?>">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url('/menu'); ?>" class="nav-link <?php echo is_active('/menu', $current_path); ?>">OUR MENU</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url('/contact#booking'); ?>" class="nav-link <?php echo is_active('/contact#booking', $current_path); ?>" id="book-nav-link">BOOK</a>
                </li>
            </ul>

            <!-- Center Logo Badge Wrapper (Desktop Only, Absolute Positioned) -->
            <div class="navbar-logo-desktop-wrapper">
                <a href="<?php echo url('/'); ?>" class="navbar-logo-desktop">
                    <img src="<?php echo url('/image/logo/logo.png'); ?>" alt="Evangiz Logo">
                </a>
            </div>

            <!-- Right Side Menu Links -->
            <ul class="nav-list nav-list-right">
                <li class="nav-item dropdown">
                    <div class="nav-link-row">
                        <a href="<?php echo url('/services'); ?>" class="nav-link <?php echo (is_active('/services', $current_path) || is_active('/about', $current_path)) ? 'active' : ''; ?>" id="services-dropdown-toggle">
                            SERVICES
                        </a>
                        <button class="nav-dropdown-toggle" type="button" aria-label="Toggle Services submenu" aria-expanded="false" aria-controls="services-submenu">
                            <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" d="M18.707 8.293a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 1.414-1.414L12 13.586l5.293-5.293a1 1 0 0 1 1.414 0" />
                            </svg>
                        </button>
                    </div>
                    <ul class="dropdown-menu" id="services-submenu">
                        <li><a href="<?php echo url('/services'); ?>" class="dropdown-item-link">OUR SERVICES</a></li>
                        <li><a href="<?php echo url('/about'); ?>" class="dropdown-item-link">ABOUT US</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url('/blog'); ?>" class="nav-link <?php echo is_active('/blog', $current_path); ?>">BLOG</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url('/contact'); ?>" class="nav-link <?php echo is_active('/contact', $current_path); ?>">CONTACT</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
