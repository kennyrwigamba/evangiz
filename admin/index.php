<?php
/**
 * Evangiz Admin Panel - Landing Dashboard Overview
 */

// Load security layout header
include_once __DIR__ . '/includes/header.php';

// Fetch summary metrics
try {
    // 1. Total bookings count
    $bookings_count = $conn->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
    
    // 2. Total blog posts count
    $blogs_count = $conn->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
    
    // 3. Total general inquiries count
    $inquiries_count = $conn->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
    
    // 4. Retrieve 3 recent bookings
    $stmt = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC LIMIT 3");
    $recent_bookings = $stmt->fetchAll();
    
} catch (PDOException $e) {
    $bookings_count = 0;
    $blogs_count = 0;
    $inquiries_count = 0;
    $recent_bookings = [];
}
?>

<!-- Metric KPI Grid -->
<div class="kpi-grid">
    <div class="kpi-card">
        <span class="kpi-lbl"><i class="hgi-stroke hgi-calendar-01 kpi-icon"></i>Catering Bookings</span>
        <span class="kpi-val"><?php echo $bookings_count; ?></span>
        <a href="<?php echo admin_url('/bookings.php'); ?>" style="font-size: 0.85rem; color: var(--color-accent); margin-top: var(--space-xs); font-weight: 500;">View all bookings &rarr;</a>
    </div>
    <div class="kpi-card">
        <span class="kpi-lbl"><i class="hgi-stroke hgi-pencil-edit-01 kpi-icon"></i>Blog Stories</span>
        <span class="kpi-val"><?php echo $blogs_count; ?></span>
        <a href="<?php echo admin_url('/blogs.php'); ?>" style="font-size: 0.85rem; color: var(--color-accent); margin-top: var(--space-xs); font-weight: 500;">Manage stories &rarr;</a>
    </div>
    <div class="kpi-card">
        <span class="kpi-lbl"><i class="hgi-stroke hgi-mail-01 kpi-icon"></i>Contact Messages</span>
        <span class="kpi-val"><?php echo $inquiries_count; ?></span>
        <a href="<?php echo admin_url('/inquiries.php'); ?>" style="font-size: 0.85rem; color: var(--color-accent); margin-top: var(--space-xs); font-weight: 500;">Read inquiries &rarr;</a>
    </div>
</div>

<!-- Recent Reservations Panel -->
<div style="margin-top: var(--space-lg);">
    <h3 style="margin-bottom: var(--space-md); color: var(--color-primary); font-family: var(--font-heading);">Recent Catering Bookings</h3>
    
    <div class="admin-table-card">
        <?php if (empty($recent_bookings)): ?>
            <div style="padding: var(--space-lg);" class="text-center text-muted">
                <p>No catering bookings registered yet.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_bookings as $booking): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($booking['name']); ?></strong><br><span class="text-muted" style="font-size: 0.8rem;"><?php echo htmlspecialchars($booking['email']); ?></span></td>
                            <td><?php echo htmlspecialchars($booking['phone']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($booking['booking_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($booking['booking_time'])); ?></td>
                            <td><?php echo intval($booking['guests']); ?></td>
                            <td>
                                <span class="badge badge-status-<?php echo strtolower($booking['status']); ?>">
                                    <?php echo htmlspecialchars($booking['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo admin_url('/bookings.php?action=view&id=' . $booking['id']); ?>" class="btn-action btn-action-edit">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php 
// Load layout footer
include_once __DIR__ . '/includes/footer.php';
?>
