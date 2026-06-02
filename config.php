<?php
/**
 * Evangiz Restaurant - Configuration & Database Initialization
 */

// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
// Set to 'sqlite' for local development or 'mysql' for production hosting
define('DB_DRIVER', 'sqlite'); 

// MySQL configuration (used if DB_DRIVER is 'mysql')
define('DB_HOST', 'localhost');
define('DB_NAME', 'evangiz_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// SQLite configuration (used if DB_DRIVER is 'sqlite')
define('DB_SQLITE_PATH', __DIR__ . '/database/evangiz.sqlite');

// Contact Email Configuration
define('CONTACT_RECEIVER_EMAIL', 'info@evangiz.com');
define('CONTACT_SENDER_EMAIL', 'no-reply@evangiz.com');

// Initialize database connection
try {
    $db_driver = DB_DRIVER;
    
    if ($db_driver === 'sqlite') {
        // Ensure database directory exists and database file is writable
        $db_dir = dirname(DB_SQLITE_PATH);
        if (!is_dir($db_dir)) {
            mkdir($db_dir, 0755, true);
        }
        $conn = new PDO("sqlite:" . DB_SQLITE_PATH);
    } else {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    }
    
    // Enable PDO exception errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Auto-initialize tables if not present
    $tables_exist = true;
    try {
        $conn->query("SELECT 1 FROM users LIMIT 1");
    } catch (PDOException $e) {
        $tables_exist = false;
    }
    
    if (!$tables_exist) {
        $schema_file = __DIR__ . '/database/schema.sql';
        if (file_exists($schema_file)) {
            $schema = file_get_contents($schema_file);
            
            // Adapt SQLite auto-increment schema to MySQL if needed
            if ($db_driver === 'mysql') {
                $schema = str_replace('INTEGER PRIMARY KEY AUTOINCREMENT', 'INT AUTO_INCREMENT PRIMARY KEY', $schema);
            }
            
            // Execute schema
            $conn->exec($schema);
            
            // Seed default admin account
            $default_user = 'admin';
            $default_pass = password_hash('admin123', PASSWORD_DEFAULT);
            $default_email = 'admin@evangiz.com';
            
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->execute([$default_user, $default_pass, $default_email]);

            // Seed default blogs
            $blog_stmt = $conn->prepare("INSERT INTO blogs (title, slug, content, image_path) VALUES (?, ?, ?, ?)");
            $blog_stmt->execute([
                "Sourcing Locally: Why Fresh Ingredients Matter",
                "sourcing-locally-fresh-ingredients",
                "At Evangiz Restaurant, we pride ourselves on offering the best of both delicious, locally-sourced cuisine and top-notch service. We believe that the best meals start with the freshest ingredients. Our veggies, herbs, and staple foods are sourced directly from Ugandan farmers daily. Sourcing locally not only supports the community, but ensures that every flavor remains vibrant and rich.",
                "image/blog/blog1.jpg"
            ]);
            $blog_stmt->execute([
                "Traditional Ugandan Luwombo: A Culinary Legacy",
                "traditional-ugandan-luwombo",
                "Ugandan cuisine is rich in flavor and history. One of the most celebrated dishes is Luwombo, a slow-steamed stew of chicken, beef, or groundnut paste cooked inside banana leaves. First created for the royal court of the Buganda Kingdom in the late 19th century, Luwombo remains an iconic staple served on special occasions. At Evangiz, we prepare it daily with fresh ingredients so you can experience this royal culinary art.",
                "image/blog/blog2.jpg"
            ]);
        }
    }
    
} catch (PDOException $e) {
    // In production, log error and show generic message. For dev/debugging, display the error.
    die("Database Connection Error: " . $e->getMessage());
}

/**
 * Helper to generate clean URLs matching the installation path (handles subdirectories)
 */
function url($path = '') {
    $project_root = str_replace('\\', '/', __DIR__);
    $script_filename = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME'] ?? '');
    $script_name = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    
    $base_url = '';
    if (!empty($script_filename) && !empty($script_name)) {
        if (strpos($script_filename, $project_root) === 0) {
            $suffix = substr($script_filename, strlen($project_root));
            if (substr($script_name, -strlen($suffix)) === $suffix) {
                $base_url = substr($script_name, 0, strlen($script_name) - strlen($suffix));
            } else {
                $base_url = dirname($script_name);
                if ($base_url === '\\' || $base_url === '/') {
                    $base_url = '';
                }
            }
        }
    }
    
    $base_url = rtrim(str_replace('\\', '/', $base_url), '/');
    return $base_url . '/' . ltrim($path, '/');
}
?>
