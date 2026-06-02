<?php
/**
 * Evangiz Admin Panel - Table Reservation Management
 */

// Load security header
include_once __DIR__ . '/includes/header.php';

$action = $_GET['action'] ?? 'list';
$booking_id = intval($_GET['id'] ?? 0);
$alert_success = '';
$alert_error = '';

// 1. Process Reservation Status Changes
if ($action === 'approve' && $booking_id > 0) {
    try {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Confirmed' WHERE id = ?");
        $stmt->execute([$booking_id]);
        $alert_success = "Booking request has been approved and confirmed!";
        $action = 'list';
    } catch (PDOException $e) {
        $alert_error = "Failed to update reservation status: " . $e->getMessage();
    }
} elseif ($action === 'cancel' && $booking_id > 0) {
    try {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ?");
        $stmt->execute([$booking_id]);
        $alert_success = "Booking request has been cancelled.";
        $action = 'list';
    } catch (PDOException $e) {
        $alert_error = "Failed to update reservation status: " . $e->getMessage();
    }
}

// 2. Fetch data based on active view state
$bookings = [];
$view_booking = null;

if ($action === 'list') {
    try {
        $bookings = $conn->query("SELECT * FROM bookings ORDER BY booking_date DESC, booking_time DESC")->fetchAll();
    } catch (PDOException $e) {
        $alert_error = "Database read error: " . $e->getMessage();
    }
} elseif ($action === 'view' && $booking_id > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? LIMIT 1");
        $stmt->execute([$booking_id]);
        $view_booking = $stmt->fetch();
        if (!$view_booking) {
            $alert_error = "Reservation record not found.";
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

<!-- VIEW STATE: Detailed Booking View -->
<?php if ($action === 'view' && $view_booking): ?>
    <div class="admin-form-panel" style="max-width: 900px; width: 100%;">
        <h3 style="margin-bottom: var(--space-lg); color: var(--color-primary);">Reservation Details</h3>
        
        <table class="admin-table" style="margin-bottom: var(--space-lg);">
            <tr>
                <th style="width: 35%;">Field</th>
                <th>Details</th>
            </tr>
            <tr>
                <td><strong>Guest Name</strong></td>
                <td><?php echo htmlspecialchars($view_booking['name']); ?></td>
            </tr>
            <tr>
                <td><strong>Email Address</strong></td>
                <td><a href="mailto:<?php echo htmlspecialchars($view_booking['email']); ?>"><?php echo htmlspecialchars($view_booking['email']); ?></a></td>
            </tr>
            <tr>
                <td><strong>Phone Number</strong></td>
                <td><a href="tel:<?php echo htmlspecialchars($view_booking['phone']); ?>"><?php echo htmlspecialchars($view_booking['phone']); ?></a></td>
            </tr>
            <tr>
                <td><strong>Reservation Date</strong></td>
                <td><?php echo date('F d, Y', strtotime($view_booking['booking_date'])); ?></td>
            </tr>
            <tr>
                <td><strong>Reservation Time</strong></td>
                <td><?php echo date('h:i A', strtotime($view_booking['booking_time'])); ?></td>
            </tr>
            <tr>
                <td><strong>Guests count</strong></td>
                <td><?php echo intval($view_booking['guests']); ?> guests</td>
            </tr>
            <tr>
                <td><strong>Inquiry Subject</strong></td>
                <td><?php echo htmlspecialchars($view_booking['subject']); ?></td>
            </tr>
            <tr>
                <td><strong>Special Request Msg</strong></td>
                <td><?php echo nl2br(htmlspecialchars($view_booking['message'] ?: 'None')); ?></td>
            </tr>
            <tr>
                <td><strong>Current Status</strong></td>
                <td>
                    <span class="badge badge-status-<?php echo strtolower($view_booking['status']); ?>">
                        <?php echo htmlspecialchars($view_booking['status']); ?>
                    </span>
                </td>
            </tr>
        </table>
        
        <div style="display: flex; gap: var(--space-sm); flex-wrap: wrap;">
            <?php if ($view_booking['status'] === 'Pending'): ?>
                <a href="<?php echo admin_url('/bookings.php?action=approve&id=' . $view_booking['id']); ?>" class="btn-action btn-action-approve" style="padding: 0.65rem 1.25rem; font-size: 0.9rem; white-space: nowrap;"><i class="hgi-stroke hgi-tick-01"></i> Approve Booking</a>
                <a href="<?php echo admin_url('/bookings.php?action=cancel&id=' . $view_booking['id']); ?>" class="btn-action btn-action-delete" style="padding: 0.65rem 1.25rem; font-size: 0.9rem; white-space: nowrap;"><i class="hgi-stroke hgi-cancel-01"></i> Cancel Booking</a>
            <?php endif; ?>
            <a href="<?php echo admin_url('/bookings.php'); ?>" class="btn-action btn-action-secondary" style="padding: 0.65rem 1.25rem; font-size: 0.9rem; white-space: nowrap;"><i class="hgi-stroke hgi-arrow-left-01"></i> Back to List</a>
        </div>
    </div>

<!-- VIEW STATE: List View -->
<?php else: ?>
    <div class="admin-table-card">
        <?php if (empty($bookings)): ?>
            <div style="padding: var(--space-xl);" class="text-center text-muted">
                <p>No table bookings registered in the system.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Phone</th>
                        <th>Date & Time</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($booking['name']); ?></strong><br>
                                <span class="text-muted" style="font-size: 0.8rem;"><?php echo htmlspecialchars($booking['email']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($booking['phone']); ?></td>
                            <td>
                                <strong><?php echo date('M d, Y', strtotime($booking['booking_date'])); ?></strong> at 
                                <?php echo date('h:i A', strtotime($booking['booking_time'])); ?>
                            </td>
                            <td><?php echo intval($booking['guests']); ?></td>
                            <td>
                                <span class="badge badge-status-<?php echo strtolower($booking['status']); ?>">
                                    <?php echo htmlspecialchars($booking['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo admin_url('/bookings.php?action=view&id=' . $booking['id']); ?>" class="btn-action btn-action-edit" style="white-space: nowrap;"><i class="hgi-stroke hgi-search-01"></i> View</a>
                                <?php if ($booking['status'] === 'Pending'): ?>
                                    <a href="<?php echo admin_url('/bookings.php?action=approve&id=' . $booking['id']); ?>" class="btn-action btn-action-approve" onclick="return confirm('Confirm and approve this reservation?');" title="Approve"><i class="hgi-stroke hgi-tick-01"></i></a>
                                    <a href="<?php echo admin_url('/bookings.php?action=cancel&id=' . $booking['id']); ?>" class="btn-action btn-action-delete" onclick="return confirm('Cancel this reservation?');" title="Cancel"><i class="hgi-stroke hgi-cancel-01"></i></a>
                                <?php endif; ?>
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
