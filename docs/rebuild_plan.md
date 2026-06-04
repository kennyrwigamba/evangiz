# Evangiz Restaurant Rebuild Plan (PHP & cPanel Rebuild)

This document outlines our strategy to rebuild the Evangiz Restaurant website from scratch using PHP. This ensures compatibility with standard **cPanel hosting**, allows for easy maintenance, and provides robust **SEO** via server-side rendering (SSR) of metadata.

---


## 📁 Directory Structure
```
evangiz/
├── index.php               # Front controller / router
├── .htaccess               # URL rewriting for clean SEO URLs
├── includes/
│   ├── header.php          # Base HTML, SEO meta tags, Google Fonts
│   ├── footer.php          # Footer HTML
│   ├── topbar.php          # Contact info bar
│   └── navbar.php          # Navigation header
├── pages/
│   ├── home.php            # Home page contents
│   ├── menu.php            # Full menu with interactive categories
│   ├── about.php           # About page details
│   ├── services.php        # Services cards (dine-in, takeaway, catering)
│   └── contact.php         # Contact info & mail form
├── css/
│   ├── main.css            # Base rules, resets, variables
│   ├── layout.css          # Page headers, footer, layout structural styles
│   └── components.css      # Custom UI blocks (buttons, menus, sliders)
├── js/
│   └── main.js             # Mobile toggles, menu filters
└── image/                  # Restaurant media assets
```

---

## 🛠️ Routing Configuration (`.htaccess`)
To keep paths like `/menu`, `/about`, and `/contact` clean for users and search engine crawlers, we configure Apache rewrites to point back to our front controller:
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

---

## ⚡ Task Breakdown

1. **Setup & Base Variables**
   - Initialize routing and rewrite config.
   - Set up core color variables, custom font sizes, and grids.
   - Configure global page layout includes (`header.php`, `footer.php`, `topbar.php`, `navbar.php`).
2. **Page Development**
   - Recreate home page layout with clean CSS.
   - Build responsive food menu page using interactive JS classification tabs.
   - Style about and services pages.
   - Implement the contact page with a form that triggers a PHP mail dispatch.
3. **SEO Integration**
   - Inject relevant titles, descriptions, and OpenGraph tags dynamically per route.
   - Ensure clean HTML headings semantics.
4. **Mobile & Deployment**
   - Perform strict mobile responsive testing.
   - Package all code files in a zip package ready to be uploaded to cPanel `public_html`.
