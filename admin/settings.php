<?php
/**
 * Evangiz Admin Panel - Settings (Change Email / Password)
 */

// Load admin header (security + layout)
include_once __DIR__ . '/includes/header.php';

$alert_success = '';
$alert_error = '';

$username = $_SESSION['admin_user'] ?? '';

try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    $user = null;
    $alert_error = "Failed to load admin record: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $current = trim($_POST['current_password'] ?? '');
    $new = trim($_POST['new_password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert_error = "Please provide a valid email address.";
    } else {
        $updates = [];
        $params = [];

        // Handle password change if requested
        if (!empty($new) || !empty($confirm)) {
            if (empty($current)) {
                $alert_error = "Enter your current password to change to a new one.";
            } elseif ($new !== $confirm) {
                $alert_error = "New password and confirmation do not match.";
            } elseif (strlen($new) < 8) {
                $alert_error = "New password must be at least 8 characters.";
            } elseif (!password_verify($current, $user['password'])) {
                $alert_error = "Current password is incorrect.";
            } else {
                $hashed = password_hash($new, PASSWORD_DEFAULT);
                $updates[] = "password = ?";
                $params[] = $hashed;
            }
        }

        // If no validation errors so far, prepare email update
        if (empty($alert_error)) {
            // Only add email update if changed
            if ($email !== ($user['email'] ?? '')) {
                $updates[] = "email = ?";
                $params[] = $email;
            }

            if (!empty($updates)) {
                $params[] = $username; // WHERE param
                $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE username = ?";
                try {
                    $stmt = $conn->prepare($sql);
                    $stmt->execute($params);
                    $alert_success = "Account settings updated successfully.";
                    // Refresh session email if changed
                    if (in_array('email = ?', $updates)) {
                        $_SESSION['admin_email'] = $email;
                    }
                    // Refresh loaded user record
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
                    $stmt->execute([$username]);
                    $user = $stmt->fetch();
                } catch (PDOException $e) {
                    $alert_error = "Failed to update settings: " . $e->getMessage();
                }
            } else {
                $alert_success = "No changes detected.";
            }
        }
    }
}
?>

<?php if (!empty($alert_success)): ?>
    <div class="alert-admin alert-admin-success"><?php echo htmlspecialchars($alert_success); ?></div>
<?php endif; ?>
<?php if (!empty($alert_error)): ?>
    <div class="alert-admin alert-admin-error"><?php echo htmlspecialchars($alert_error); ?></div>
<?php endif; ?>

<div class="admin-form-panel">
    <h3 style="margin-bottom: var(--space-lg);">Account Settings</h3>

    <form action="<?php echo admin_url('/settings.php'); ?>" method="POST" id="admin-settings-form">
        <?php
        $email_val = $user['email'] ?? '';
        echo render_form_input('email', 'Email Address', 'email', 'Your administrator contact email', true, $email_val);

        echo '<hr style="margin: var(--space-lg) 0;">';
        echo '<p class="text-muted">To change your password, enter your current password and choose a new one.</p>';
        echo render_form_input('current_password', 'Current Password', 'password', 'Enter current password', false);
        echo render_form_input('new_password', 'New Password', 'password', 'Minimum 8 characters', false);
        echo render_form_input('confirm_password', 'Confirm New Password', 'password', 'Repeat new password', false);
        ?>

        <div style="margin-top: var(--space-lg); display: flex; gap: var(--space-sm);">
            <button type="submit" class="btn btn-primary">
                <span class="btn-text-wrapper">
                    <span class="btn-text-main"><i class="hgi-stroke hgi-tick-01"></i> Save Changes</span>
                    <span class="btn-text-hover"><i class="hgi-stroke hgi-tick-01"></i> Save Changes</span>
                </span>
            </button>
            <a href="<?php echo admin_url('/'); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
