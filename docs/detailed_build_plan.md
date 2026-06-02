# Evangiz Restaurant Rebuild — Detailed Building Plan

This document provides a detailed, step-by-step execution roadmap for rebuilding the Evangiz Restaurant website. 

---

## 💡 Architectural Question: Straight to PHP or HTML First?
We will go **straight to PHP files**. 
* **Why?** Writing HTML first would require coding header/navigation/footer layouts multiple times, only to slice them apart later. Going straight to PHP components (like `header.php`, `footer.php`, `navbar.php`) lets us write header and footer elements once and immediately load them across every page. This prevents redundant styling, avoids layout mismatch bugs, and builds the SEO-routing architecture from day one.

---

## 📂 Detailed Folder Structure
We will organize the folder structure to separate layout elements, page contents, and configuration:

```
evangiz/
├── index.php               # Front controller / router
├── .htaccess               # URL rewriting for clean SEO URLs
├── detailed_build_plan.md  # This document
├── includes/
│   ├── header.php          # Base HTML, dynamic SEO title/meta injection, styles
│   ├── footer.php          # Footer links, copyright, scripts
│   ├── topbar.php          # Top info banner (contact numbers, opening hours)
│   └── navbar.php          # Logo branding and responsive navigation
├── pages/
│   ├── home.php            # Homepage section content
│   ├── menu.php            # Categories & full food menu items
│   ├── about.php           # Story, ingredient principles
│   ├── services.php        # Dine-in, Takeaway, and Outside catering sections
│   └── contact.php         # Contact info & HTML feedback form
├── css/
│   ├── main.css            # Base stylesheet (variables, fonts, resets, helper utilities)
│   ├── layout.css          # Page headers, footer, columns, spacing grid
│   └── components.css      # Reusable modules (buttons, cards, hero, menu lists)
├── js/
│   └── main.js             # Mobile toggler logic & menu category switching scripts
└── image/                  # Restaurant media assets (kept from previous setup)
```

---

## 📑 Step-by-Step Implementation Roadmap

### Phase 1: Environment & Front Controller Initialization
We begin by configuring how the web server handles incoming requests.

1. **Create the Rewrite configuration (`.htaccess`)**:
   Setup Apache rules to map vanity URLs like `/about` or `/menu` to the controller without visual page refreshes.
   ```apache
   RewriteEngine On
   # If requested path is not a physical file
   RewriteCond %{REQUEST_FILENAME} !-f
   # And is not a physical directory
   RewriteCond %{REQUEST_FILENAME} !-d
   # Rewrite request silently to index.php
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```
2. **Create the Main Entry Router (`index.php`)**:
   Create the front controller to capture requests, evaluate route matches, set page metadata variables, and load the dynamic layouts.
3. **Set Up the Base Partials**:
   - `includes/header.php`: Standardize `<html>`, `<head>`, character sets, responsive viewports, custom fonts stylesheets, and output dynamic variables:
     ```php
     <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : "Evangiz Restaurant"; ?></title>
     <meta name="description" content="<?php echo isset($page_desc) ? htmlspecialchars($page_desc) : ""; ?>">
     ```
   - `includes/footer.php`: Set up page closures, footer copy, and main JS script inclusions.

---

### Phase 2: CSS Layout & Design tokens
Instead of managing a messy stylesheet, we will set up clean CSS files using modern design system tokens.

1. **`css/main.css`**: Define color custom properties (`--primary-color: #051028;`, `--accent-color: #e7562a;`, `--bg-warm: #f9f4ed;`), typography bindings, reset browser styles, and import Google fonts:
   - **Outfit**: Headings and navigational typography.
   - **Cormorant Garamond**: Elegant serif italics for slide headlines and blockquotes.
   - **DM Sans**: Readable body content copy.
2. **`css/layout.css`**: Establish core margins, layout grids, columns, section paddings, and header/footer wrapper flexboxes.
3. **`css/components.css`**: Build reusable layout blocks:
   - Modern, responsive double-text buttons with micro-animations.
   - Food price menu list items with connecting dotted-line spans.
   - Elegant, clean content cards.

---

### Phase 3: Global Layout Component Implementation
Here we create elements that appear on every page of the website.

1. **`includes/topbar.php`**:
   - Left side: Restaurant physical location info ("Lubowa, Entebbe Road (opposite Roofings)").
   - Right side: Call numbers (`+256-705183818`, `+256-784618282`) and operating hours.
2. **`includes/navbar.php`**:
   - Left side: Evangiz logo/text branding.
   - Center: Nav links (`/`, `/menu`, `/about`, `/services`, `/contact`).
   - Right side: Quick "Order Now" action button.
   - Mobile: Responsive SVG Hamburger icon that switches styles on click.
3. **`js/main.js`**:
   - Simple responsive hamburger toggle toggle function class manipulation.

---

### Phase 4: Core Page Implementation
We build out the primary pages within the `pages/` directory.

1. **Home Page (`pages/home.php`)**:
   - Minimalist text slider block showcasing Evangiz slogan ("A Taste You'll Remember...").
   - Summary introduction card routing visitors to the About page.
   - Brief highlights of the fast foods menu categories.
2. **About Page (`pages/about.php`)**:
   - Details of the Evangiz brand mission, locally-sourced ingredient details, and welcoming customer service values.
3. **Services Page (`pages/services.php`)**:
   - Clean column layout cards illustrating Dine-in comfort, fast takeaway packaging, and outdoor catering options.
4. **Menu Page (`pages/menu.php`)**:
   - Category navigation tabs: `Fast Foods`, `Local Dishes`, `Light Meals & Snacks`, `Soft Drinks`.
   - JavaScript filtering system (`js/main.js`) to show/hide corresponding item sections dynamically without visual page reloads.
   - Stylized lists with prices (UGX) and item descriptions.

---

### Phase 5: Form Handling & Email Delivery System
To handle customer bookings, inquiries, and catering requests reliably, we implement a secure contact form submission system.

1. **Contact Page Layout (`pages/contact.php`)**:
   - Left column: Map location directions, phone numbers, email address.
   - Right column: Clean contact form (Name, Email, Phone, Message, Subject selector).
2. **Form Submission Engine (`pages/contact.php` or a dedicated script)**:
   We will support a clean fallback system:
   - **Modern AJAX Flow**: JavaScript captures form submission, sends a POST request asynchronously to the email handler, and displays success/error states on the page without reloads.
   - **Server-Side Fallback**: If JavaScript is disabled, the standard form POST redirects smoothly back to the contact page with clean query parameters to display the status.
3. **Safe Email Handling**:
   - Sanitize all input values to prevent email injection headers attacks.
   - Build a stylized email template using CSS tables so that incoming catering/contact leads appear readable in Outlook, Gmail, or mobile inbox clients.
   - Utilize standard PHP `mail()` function with appropriate headers (`Reply-To`, `From`, content type HTML).

---

### Phase 6: SEO Audit & Performance Validation
Before pushing changes live, we perform standard search engine optimization checks:

1. **HTML Validation**: Check headings structure (only one `<h1>` per page matching standard SEO guidelines).
2. **Metadata Integrity**: Ensure OpenGraph properties (e.g. `og:title`, `og:image`) exist for social sharing preview.
3. **Page Weight Check**: Verify no unused assets or bloated libraries are being loaded.

---

### Phase 7: Deployment to cPanel
Once verified locally, deployment to standard host configurations is simple:

1. **Compile Files**: Group all folders and files into a single `.zip` file.
2. **Upload & Extract**: Upload the ZIP file inside cPanel's File Manager into the public web root directory (`public_html`).
3. **Configure Settings**: Make any adjustment to PHP configurations (such as ensuring your server email addresses match your domain configuration to prevent mail delivery flagging).
