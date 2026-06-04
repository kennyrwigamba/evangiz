-- Database Schema for Evangiz Restaurant

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Users table (Admin accounts)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Blogs table
CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Bookings table (Table Reservations / Catering)
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    guests INTEGER NOT NULL,
    subject VARCHAR(255) DEFAULT 'Table Booking',
    message TEXT DEFAULT NULL,
    status VARCHAR(20) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Contacts table (General inquiries)
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    sort_order INTEGER DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Menu Items table
CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    price INTEGER NOT NULL,
    description TEXT NOT NULL,
    tags VARCHAR(255) DEFAULT '',
    is_active INTEGER DEFAULT 1,
    sort_order INTEGER DEFAULT 0,
    UNIQUE KEY uniq_category_item (category_id, name),
    FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (slug, name, sort_order) VALUES
    ('fast-foods', 'Fast Foods', 10),
    ('local-dishes', 'Local Dishes', 20),
    ('snacks', 'Snacks & Light Meals', 30),
    ('drinks', 'Soft Drinks', 40)
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Classic Beef Burger', 15000, 'Beef patty, lettuce, tomato, house sauce', 'Beef, Popular', 1, 10
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Chicken Burger', 12000, 'Crispy chicken, mayo, lettuce', 'Chicken', 1, 20
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Double Beef Burger', 22000, 'Double beef patty, cheese, pickles, house sauce', 'Beef, Large', 1, 30
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Grilled Chicken Sandwich', 11000, 'Grilled chicken breast, salad greens, sandwich sauce', 'Chicken', 1, 40
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Veggie Burger', 10000, 'House vegetable patty, lettuce, tomato, dressing', 'Vegetarian', 1, 50
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Fried Chicken (3 pcs)', 18000, 'Golden fried chicken pieces served crispy and hot', 'Chicken', 1, 60
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Chicken Wings (6 pcs)', 14000, 'Spicy house chicken wings tossed in barbecue style sauce', 'Chicken, Spicy', 1, 70
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Pizza Slice', 10000, 'Cheese & tomato slice with choice of toppings', 'Popular', 1, 80
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'French Fries', 6000, 'Crispy salted golden french fries', 'Side', 1, 90
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Onion Rings', 5000, 'Crispy beer-battered fried onion rings', 'Side', 1, 100
FROM categories c WHERE c.slug = 'fast-foods'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Traditional Beef Luwombo', 22000, 'Slow-cooked beef stew prepared traditionally inside banana leaves with rich spices', 'Staple, Beef', 1, 10
FROM categories c WHERE c.slug = 'local-dishes'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Chicken Luwombo', 24000, 'Traditional local chicken stew steamed inside fresh banana leaves', 'Staple, Chicken', 1, 20
FROM categories c WHERE c.slug = 'local-dishes'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Matooke & Groundnut Stew', 12000, 'Steamed and mashed plantain (bananas) served with rich peanut/groundnut paste sauce', 'Vegetarian', 1, 30
FROM categories c WHERE c.slug = 'local-dishes'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Fresh Whole Tilapia (Wet or Dry)', 25000, 'Local lake fish prepared to order, served with french fries or local foods', 'Fish', 1, 40
FROM categories c WHERE c.slug = 'local-dishes'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Evangiz Local Platter', 26000, 'Combination of Matooke, sweet potatoes, yams, posho, rice, and beans, served with beef stew', 'Beef, Large', 1, 50
FROM categories c WHERE c.slug = 'local-dishes'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Ugandan Rolex (2 Eggs, 2 Chapatis)', 5000, 'Famous local street snack consisting of rolled fried eggs and vegetables inside chapati', 'Local, Popular', 1, 10
FROM categories c WHERE c.slug = 'snacks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Beef Samosas (3 pcs)', 4000, 'Crispy triangular pastry wrappers stuffed with spiced minced beef filling', 'Snack', 1, 20
FROM categories c WHERE c.slug = 'snacks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Vegetable Spring Rolls (3 pcs)', 3000, 'Crispy rolls stuffed with seasoned fresh garden vegetables', 'Snack, Vegetarian', 1, 30
FROM categories c WHERE c.slug = 'snacks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Toasted Sandwich', 8000, 'Cheese and tomato, or ham and cheese fillings toasted to golden perfection', 'Snack', 1, 40
FROM categories c WHERE c.slug = 'snacks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Fresh Passion Fruit Juice', 5000, 'Chilled freshly-squeezed organic passion fruit juice', 'Fresh, Drinks', 1, 10
FROM categories c WHERE c.slug = 'drinks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Spiced African Tea', 6000, 'Brewed hot milk tea infused with local ginger, tea leaves, and spices', 'Hot, Drinks', 1, 20
FROM categories c WHERE c.slug = 'drinks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'House Brewed Coffee', 7000, 'Brewed aromatic coffee made from premium Ugandan coffee beans', 'Hot, Drinks', 1, 30
FROM categories c WHERE c.slug = 'drinks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Soda (350ml)', 3000, 'Chilled Coca Cola, Fanta, Sprite, or Stoney in classic glass bottles', 'Cold, Drinks', 1, 40
FROM categories c WHERE c.slug = 'drinks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order)
SELECT c.id, 'Mineral Water (500ml)', 2500, 'Bottled pure mineral drinking water served chilled or room temp', 'Cold, Drinks', 1, 50
FROM categories c WHERE c.slug = 'drinks'
ON DUPLICATE KEY UPDATE
    price = VALUES(price),
    description = VALUES(description),
    tags = VALUES(tags),
    is_active = VALUES(is_active),
    sort_order = VALUES(sort_order);

SET FOREIGN_KEY_CHECKS = 1;
