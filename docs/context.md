# Project Context — Evangiz Restaurant Website Rebuild

This file serves as the source of truth for the Evangiz Restaurant website rebuild project. It details the brand context, exact marketing copy, menu structures, and the chosen technical stack.

---

## 🍽️ About Evangiz Restaurant
Evangiz Restaurant is a casual dining and fast-food establishment located along Kampala–Entebbe Road in Lubowa, Uganda (directly opposite Roofings). It offers a convenient, high-quality, and affordable dining experience for individuals, families, and travelers.

---

## 💻 Technical Stack & Hosting Requirements
1. **Core Backend**: PHP (Version 7.4 or newer).
2. **Hosting Environment**: Standard cPanel shared hosting (requires `.htaccess` clean URL rewrites).
3. **Client-Side Behavior**: Vanilla HTML5, clean CSS (custom design system tokens in variables, resets, layout definitions, and components), and pure JavaScript (interactive category selector, responsive toggles). No heavy frameworks or large external bundles (like jquery, wow.js, or maps.js templates).
4. **SEO Focus**: Title and description metadata must be injected server-side dynamically inside `includes/header.php` according to the active route inside `index.php`. All heading structures (`h1`, `h2`, etc.) must follow strict semantic hierarchies.

---

## 📋 Page Copy & Section Guide

Use the exact texts outlined below to populate each page component.

### 1. Global Components

#### Top Info Bar (`includes/topbar.php`)
* **Location Text**: `Lubowa, Entebbe Road (opposite Roofings)`
* **Phone Numbers**: `+256-705183818` / `+256-784618282`
* **Working Hours**: `Monday - Sunday: 9:00am - 11:00pm`
* **Email Address**: `info@evangiz.com`

#### Footer (`includes/footer.php`)
* Brand details, contact listings, working hours summaries, links to pages (`Home`, `Menu`, `About`, `Services`, `Contact`), and copyright notice.

---

### 2. Individual Pages

#### Home Page (`pages/home.php`)
* **Hero Slider Headline**: 
  > A Taste You’ll Remember  
  > Where Every Flavor Tells A Story!
* **Main Slogan / Introduction Heading**:
  > A Culinary Adventure For All The Senses
* **Welcome Text (Paragraph 1)**:
  > Welcome to Evangiz Restaurant, where we pride ourselves on offering the best of both delicious, locally-sourced cuisine and top-notch service. We believe that the best meals start with the freshest ingredients. But we know that a great meal is about more than just the food.
* **Welcome Text (Paragraph 2)**:
  > That's why we also place a premium on providing exceptional service to each and every one of our guests. So if you're looking for a restaurant that offers the best of local cuisine and top-notch service, look no further. We can't wait to welcome you to our table and show you why we're one of the best restaurants in town!
* **Call to Action Buttons**: "Read More About Us" (links to `/about`) & "View Menu" (links to `/menu`).

#### Menu Page (`pages/menu.php`)
The menu page must support categories and direct item listings:
* **Interactive Navigation Categories**:
  1. `Fast Foods`
  2. `Local Dishes`
  3. `Light Meals & Snacks`
  4. `Soft Drinks`
* **Fast Foods Menu Items (Sample Listing)**:
  * *Classic Beef Burger*: UGX 15,000 (Beef patty, lettuce, tomato, house sauce)
  * *Chicken Burger*: UGX 12,000 (Crispy chicken, mayo, lettuce)
  * *French Fries*: UGX 6,000 (Crispy salted fries)
  * *Fried Chicken (3 pcs)*: UGX 18,000 (Golden fried chicken pieces)
  * *Pizza Slice*: UGX 10,000 (Cheese & tomato slice)
  * *Double Beef Burger*: UGX 22,000 (Double beef, cheese, pickles)
  * *Chicken Wings (6 pcs)*: UGX 14,000 (Spicy house wings)
  * *Onion Rings*: UGX 5,000 (Crispy beer-battered rings)
  * *Grilled Chicken Sandwich*: UGX 11,000 (Grilled chicken, salad, sauce)
  * *Veggie Burger*: UGX 10,000 (House vegetable patty)
* **Local Dishes (Ugandan Staples)**:
  * Freshly prepared local dishes based on Ugandan staples, depending on daily seasonal availability.
* **Light Meals & Snacks / Soft Drinks**:
  * Various snacks and soft drink refreshments.

#### About Page (`pages/about.php`)
* Elaborates on the Evangiz brand mission, our commitment to using locally-sourced, fresh ingredients, and our dedication to maintaining top-tier customer hospitality standards.

#### Services Page (`pages/services.php`)
We focus on four key areas:
1. **Dine-In Services**: Comfortable seating environment for customers who prefer to eat on-site, suitable for both individuals and small groups.
2. **Takeaway / Takeout**: Quick and efficient packaging of meals for customers on the move—ideal for busy schedules.
3. **Food Preparation & Service**: Freshly prepared meals ranging from fast food options to selected local dishes, served daily.
4. **Customer Service**: On-site staff available to assist with orders, inquiries, and general dining support.
5. **Outside Catering**:
   > Evangiz Restaurant brings the delectable flavors of our kitchen to your special events. Experience the perfect blend of culinary expertise and personalized service with our outside catering. From corporate gatherings to private celebrations, we cater to your unique tastes and preferences, ensuring a memorable dining experience for you and your guests. Let us make your event extraordinary with our exquisite cuisine.

#### Contact Page (`pages/contact.php`)
* **Contact details**: Phone numbers, physical address mapping, working hours.
* **Contact Form Fields**: Full Name, Email Address, Phone Number, Inquiry Subject (General, Catering, Table Booking), and Message.
* **Contact Form Engine**:
  * An AJAX submission handler inside `js/main.js` that posts form details to the email submission handler without visual page reloads.
  * A classic form POST fallback that processes the inputs, sends the email, and redirects back to `/contact?status=success` or `/contact?status=error`.
  * Inputs must be sanitized, and emails should be sent using standard HTML layouts.
