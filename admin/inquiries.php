<?php
/**
 * Evangiz Admin Panel - General Inquiries View
 */

// Load security header
include_once __DIR__ . '/includes/header.php';

$action = $_GET['action'] ?? 'list';
$inquiry_id = intval($_GET['id'] ?? 0);
$alert_success = '';
$alert_error = '';

// Process Delete Action
if ($action === 'delete' && $inquiry_id > 0) {
    try {
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$inquiry_id]);
        $alert_success = "Inquiry message deleted successfully.";
        $action = 'list';
    } catch (PDOException $e) {
        $alert_error = "Failed to delete message: " . $e->getMessage();
    }
}

// Fetch inquiries logs
$inquiries = [];
$view_inquiry = null;

if ($action === 'list') {
    try {
        $inquiries = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
    } catch (PDOException $e) {
        $alert_error = "Database read error: " . $e->getMessage();
    }
} elseif ($action === 'view' && $inquiry_id > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ? LIMIT 1");
        $stmt->execute([$inquiry_id]);
        $view_inquiry = $stmt->fetch();
        if (!$view_inquiry) {
            $alert_error = "Inquiry record not found.";
            $action = 'list';
        }
    } catch (PDOException $e) {
        $alert_error = "Database read error: " . $e->getMessage();
        $action = 'list';
    }
}
?>

<!-- Alert Notification System -->
<?php if (!empty($alert_success)): ?>
    <div class="alert-admin alert-admin-success"><?php echo htmlspecialchars($alert_success); ?></div>
<?php endif; ?>
<?php if (!empty($alert_error)): ?>
    <div class="alert-admin alert-admin-error"><?php echo htmlspecialchars($alert_error); ?></div>
<?php endif; ?>

<!-- VIEW STATE: Detailed Inquiry View -->
<?php if ($action === 'view' && $view_inquiry): ?>
    <div class="admin-form-panel" style="max-width: 900px; width: 100%;">
        <h3 style="margin-bottom: var(--space-lg); color: var(--color-primary);">Inquiry Message details</h3>
        
        <table class="admin-table" style="margin-bottom: var(--space-lg);">
            <tr>
                <th style="width: 35%;">Field</th>
                <th>Details</th>
            </tr>
            <tr>
                <td><strong>Sender Name</strong></td>
                <td><?php echo htmlspecialchars($view_inquiry['name']); ?></td>
            </tr>
            <tr>
                <td><strong>Email Address</strong></td>
                <td><a href="mailto:<?php echo htmlspecialchars($view_inquiry['email']); ?>"><?php echo htmlspecialchars($view_inquiry['email']); ?></a></td>
            </tr>
            <tr>
                <td><strong>Phone Number</strong></td>
                <td><a href="tel:<?php echo htmlspecialchars($view_inquiry['phone']); ?>"><?php echo htmlspecialchars($view_inquiry['phone']); ?></a></td>
            </tr>
            <tr>
                <td><strong>Subject Line</strong></td>
                <td><?php echo htmlspecialchars($view_inquiry['subject']); ?></td>
            </tr>
            <tr>
                <td><strong>Date Received</strong></td>
                <td><?php echo date('F d, Y - h:i A', strtotime($view_inquiry['created_at'])); ?></td>
            </tr>
            <tr>
                <td><strong>Message Text</strong></td>
                <td><?php echo nl2br(htmlspecialchars($view_inquiry['message'])); ?></td>
            </tr>
        </table>
        
        <div style="display: flex; gap: var(--space-sm); flex-wrap: wrap;">
            <a href="mailto:<?php echo htmlspecialchars($view_inquiry['email']); ?>?subject=Re: <?php echo urlencode($view_inquiry['subject']); ?>" class="btn-action btn-action-approve" style="padding: 0.65rem 1.25rem; font-size: 0.9rem; white-space: nowrap;"><i class="hgi-stroke hgi-mail-01"></i> Reply via Email</a>
            <a href="<?php echo admin_url('/inquiries.php?action=delete&id=' . $view_inquiry['id']); ?>" class="btn-action btn-action-delete" style="padding: 0.65rem 1.25rem; font-size: 0.9rem; white-space: nowrap;" onclick="return confirm('Are you sure you want to delete this message?');"><i class="hgi-stroke hgi-delete-02"></i> Delete message</a>
            <a href="<?php echo admin_url('/inquiries.php'); ?>" class="btn-action btn-action-secondary" style="padding: 0.65rem 1.25rem; font-size: 0.9rem; white-space: nowrap;"><i class="hgi-stroke hgi-arrow-left-01"></i> Back to List</a>
        </div>
    </div>

<!-- VIEW STATE: List View -->
<?php else: ?>
    <div class="admin-table-card">
        <?php if (empty($inquiries)): ?>
            <div style="padding: var(--space-xl);" class="text-center text-muted">
                <p>No customer inquiries logged yet.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Phone</th>
                        <th>Subject Line</th>
                        <th>Date Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inquiry): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($inquiry['name']); ?></strong><br>
                                <span class="text-muted" style="font-size: 0.8rem;"><?php echo htmlspecialchars($inquiry['email']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($inquiry['phone']); ?></td>
                            <td><strong><?php echo htmlspecialchars($inquiry['subject']); ?></strong></td>
                            <td><?php echo date('M d, Y - h:i A', strtotime($inquiry['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo admin_url('/inquiries.php?action=view&id=' . $inquiry['id']); ?>" class="btn-action btn-action-edit" style="white-space: nowrap;"><i class="hgi-stroke hgi-search-01"></i> View</a>
                                <a href="<?php echo admin_url('/inquiries.php?action=delete&id=' . $inquiry['id']); ?>" class="btn-action btn-action-delete" style="white-space: nowrap;" onclick="return confirm('Confirm permanent deletion of this message?');"><i class="hgi-stroke hgi-delete-02"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php 
// Load layout footer
include_once __DIR__ . '/includes/footer.php';
?>
