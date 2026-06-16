<?php
/**
 * Evangiz Admin Panel - Authentication Login Gate
 */

// Load core configuration and helper components before any HTML output
require_once __DIR__ . '/../config.php';
require_once SRC_PATH . '/includes/components.php';

// Function to generate sub-navigation URLs inside admin
if (!function_exists('admin_url')) {
    function admin_url($path = '') {
        return url('/admin/' . ltrim($path, '/'));
    }
}

// Redirect if already authenticated
if (!empty($_SESSION['admin_logged_in'])) {
    header("Location: " . admin_url('/'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($username) || empty($password)) {
        $error = "Please fill in both fields.";
    } else {
        try {
            // Find administrator record
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Initialize session logs
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user'] = $user['username'];
                $_SESSION['admin_email'] = $user['email'];
                
                header("Location: " . admin_url('/'));
                exit;
            } else {
                $error = "Invalid username or password credentials.";
            }
        } catch (PDOException $e) {
            $error = "Database query failure: " . $e->getMessage();
        }
    }
}

// Load partial header which outputs standard HTML wrappers and sidebar
include_once __DIR__ . '/includes/header.php';
?>

<!-- Centered Login Layout Panel -->
<div class="admin-form-panel animate-scale-in" style="width: 100%; max-width: 400px; margin: 0 auto;">
    <div class="text-center" style="margin-bottom: var(--space-lg);">
        <h3 style="font-weight: 600; color: var(--color-primary);">Evangiz Login</h3>
        <p class="text-muted" style="font-size: 0.9rem;">Sign in to manage bookings, blogs, and inquiries.</p>
    </div>

    <!-- Error Alert Box -->
    <?php if (!empty($error)): ?>
        <div class="alert-admin alert-admin-error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo admin_url('/login.php'); ?>" method="POST">
        <?php 
        echo render_form_input('username', 'Username / Username Email', 'text', 'Enter administrator username', true);
        echo render_form_input('password', 'Password Key', 'password', 'Enter password key', true);
        ?>
        
        <div style="margin-top: var(--space-lg);">
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="btn-text-wrapper">
                    <span class="btn-text-main">Log In</span>
                    <span class="btn-text-hover">Log In</span>
                </span>
            </button>
        </div>
    </form>
    
    <div class="text-center" style="margin-top: var(--space-md);">
        <a href="<?php echo url('/'); ?>" style="font-size: 0.85rem; color: var(--color-accent); font-weight: 500;">&larr; Return to Main Website</a>
    </div>
</div>

<?php 
include_once __DIR__ . '/includes/footer.php';
?>
