<?php
/**
 * Evangiz Restaurant - Configuration & Database Initialization
 */

// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
define('DB_DRIVER', 'mysql'); 

// MySQL configuration (loaded from environment with safe local fallbacks)
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'evangiz_db');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Contact Email Configuration
define('CONTACT_RECEIVER_EMAIL', 'info@evangiz.com');
define('CONTACT_SENDER_EMAIL', 'no-reply@evangiz.com');

// Initialize database connection
try {
    $db_driver = DB_DRIVER;

    if ($db_driver !== 'mysql') {
        throw new RuntimeException('Production config requires DB_DRIVER to be mysql.');
    }

    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
    ]);
    
    // Enable PDO exception errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    // If this is an AJAX request, return JSON so client can surface the error
    $is_ajax = !empty($_SERVER['HTTP_X_REQUEST_WITH']) && strtolower($_SERVER['HTTP_X_REQUEST_WITH']) === 'xmlhttprequest';
    if ($is_ajax) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database Connection Error: ' . $e->getMessage()]);
        exit;
    }

    // Non-AJAX fallback: die with the error message (useful for local debugging)
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
