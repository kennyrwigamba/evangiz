<?php
/**
 * Evangiz Admin Panel - Header Layout & Security Gate
 */
require_once __DIR__ . '/../../config.php';
require_once SRC_PATH . '/includes/components.php';

// Security Check: Redirect to login if not authenticated
$current_script = basename($_SERVER['SCRIPT_NAME']);
if ($current_script !== 'login.php' && empty($_SESSION['admin_logged_in'])) {
    header("Location: " . url('/admin/login.php'));
    exit;
}

// Function to generate sub-navigation URLs inside admin
if (!function_exists('admin_url')) {
    function admin_url($path = '') {
        return url('/admin/' . ltrim($path, '/'));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Evangiz Admin Dashboard</title>
    
    <!-- Design System Stylesheet Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="https://use.hugeicons.com/font/icons.css">
    
    <link rel="stylesheet" href="<?php echo url('/css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/components.css'); ?>">
    <link rel="shortcut icon" href="<?php echo url('/image/logo/favicon.png'); ?>" type="image/x-icon">

    
    <!-- Admin Custom Layout Rules -->
    <style>
        :root {
            --admin-sidebar-width: 250px;
        }
        body {
            background-color: #f3f4f6; /* Modern light gray bg */
            display: flex;
            min-height: 100vh;
        }
        #admin-wrapper {
            display: flex;
            width: 100%;
        }
        /* Sidebar layout */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background-color: var(--color-primary);
            color: var(--color-white);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 10;
        }
        .sidebar-brand {
            padding: var(--space-md);
            font-size: 1.5rem;
            font-family: var(--font-heading);
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar-brand span {
            color: var(--color-secondary);
        }
        .sidebar-menu {
            list-style: none;
            padding: var(--space-md) 0;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .sidebar-item a {
            display: flex;
            align-items: center;
            padding: var(--space-md) var(--space-lg);
            font-family: var(--font-heading);
            font-weight: 500;
            color: rgba(245, 246, 248, 0.7);
            font-size: 0.95rem;
            border-left: 4px solid transparent;
        }
        .sidebar-item a:hover,
        .sidebar-item.active a {
            color: var(--color-white);
            background-color: rgba(255, 255, 255, 0.05);
            border-left: 4px solid var(--color-accent);
        }
        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: var(--space-md) var(--space-lg);
        }
        .sidebar-logout {
            color: var(--color-error) !important;
            font-family: var(--font-heading);
            font-weight: 600;
        }
        /* Content area */
        .admin-main {
            margin-left: var(--admin-sidebar-width);
            flex-grow: 1;
            padding: var(--space-lg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-xl);
            border-bottom: 1px solid var(--color-border);
            padding-bottom: var(--space-md);
        }
        .admin-page-title {
            font-size: 1.75rem;
        }
        /* Tables styling */
        .admin-table-card {
            background-color: var(--color-bg-cream);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-subtle);
            border: 1px solid var(--color-border);
            overflow: hidden;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .admin-table th, 
        .admin-table td {
            padding: var(--space-md) var(--space-lg);
            border-bottom: 1px solid var(--color-border);
            font-size: 0.95rem;
        }
        .admin-table th {
            background-color: var(--color-primary-light);
            color: var(--color-white);
            font-family: var(--font-heading);
            font-weight: 600;
        }
        .admin-table tbody tr:hover {
            background-color: rgba(11, 19, 37, 0.01);
        }
        /* Forms specifically for admin panel editing */
        .admin-form-panel {
            background-color: var(--color-bg-cream);
            padding: var(--space-xl);
            border-radius: var(--radius-md);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-subtle);
            max-width: 800px;
        }
        /* Dashboard KPI cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--space-lg);
            margin-bottom: var(--space-xl);
        }
        .kpi-card {
            background-color: var(--color-bg-cream);
            padding: var(--space-lg);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-subtle);
            border: 1px solid var(--color-border);
            display: flex;
            flex-direction: column;
        }
        .kpi-val {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--color-primary);
            font-family: var(--font-heading);
        }
        .kpi-lbl {
            font-size: 0.85rem;
            color: var(--color-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: var(--space-xs);
        }
        .sidebar-icon {
            margin-right: 12px;
            font-size: 1.15rem;
            flex-shrink: 0;
            transition: var(--transition-fast);
        }
        .kpi-icon {
            font-size: 1rem;
            color: var(--color-accent);
        }
        /* Custom buttons styling for actions */
        .btn-action {
            padding: 0.4rem 0.85rem;
            font-size: 0.8rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            border: none;
        }
        .btn-action-edit {
            background-color: var(--color-secondary);
            color: var(--color-primary);
        }
        .btn-action-delete {
            background-color: var(--color-error);
            color: var(--color-white);
        }
        .btn-action-approve {
            background-color: var(--color-success);
            color: var(--color-white);
        }
        .btn-action-secondary {
            background-color: var(--color-primary-light);
            color: var(--color-white);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .btn-action-edit:hover,
        .btn-action-delete:hover,
        .btn-action-approve:hover,
        .btn-action-secondary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: var(--color-white);
        }
        .alert-admin {
            padding: var(--space-md) var(--space-lg);
            border-radius: var(--radius-sm);
            margin-bottom: var(--space-lg);
            font-family: var(--font-heading);
            font-weight: 500;
        }
        .alert-admin-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--color-success);
        }
        .alert-admin-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--color-error);
        }
    </style>
</head>
<body>
    <div id="admin-wrapper">
        
        <?php if ($current_script !== 'login.php'): ?>
        <!-- Admin Panel Navigation Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                Evangiz<span> Admin</span>
            </div>
            
            <ul class="sidebar-menu">
                <li class="sidebar-item <?php echo $current_script === 'index.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/'); ?>"><i class="hgi-stroke hgi-dashboard-square-01 sidebar-icon"></i>Dashboard</a>
                </li>
                <li class="sidebar-item <?php echo $current_script === 'bookings.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/bookings.php'); ?>"><i class="hgi-stroke hgi-calendar-01 sidebar-icon"></i>Catering Bookings</a>
                </li>
                <li class="sidebar-item <?php echo $current_script === 'menu.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/menu.php'); ?>"><i class="hgi hgi-stroke hgi-rounded hgi-menu-02 sidebar-icon"></i>Manage Menu</a>
                </li>
                <li class="sidebar-item <?php echo $current_script === 'categories.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/categories.php'); ?>"><i class="hgi hgi-stroke hgi-rounded hgi-dashboard-square-edit sidebar-icon"></i>Manage Categories</a>
                </li>
                <li class="sidebar-item <?php echo $current_script === 'blogs.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/blogs.php'); ?>"><i class="hgi-stroke hgi-pencil-edit-01 sidebar-icon"></i>Manage Blogs</a>
                </li>
                <li class="sidebar-item <?php echo $current_script === 'inquiries.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/inquiries.php'); ?>"><i class="hgi-stroke hgi-mail-01 sidebar-icon"></i>Inquiries</a>
                </li>
                <li class="sidebar-item <?php echo $current_script === 'settings.php' ? 'active' : ''; ?>">
                    <a href="<?php echo admin_url('/settings.php'); ?>"><i class="hgi hgi-stroke hgi-rounded hgi-settings-01 sidebar-icon"></i>Settings</a>
                </li>
            </ul>
            
            <div class="sidebar-footer">
                <a href="<?php echo admin_url('/logout.php'); ?>" class="sidebar-logout"><i class="hgi-stroke hgi-logout-01 sidebar-icon"></i>Log Out</a>
            </div>
        </aside>
        <?php endif; ?>

        <!-- Admin Main Content Column -->
        <main class="admin-main" <?php echo $current_script === 'login.php' ? 'style="margin-left: 0; justify-content: center; align-items: center;"' : ''; ?>>
            
            <?php if ($current_script !== 'login.php'): ?>
            <header class="admin-header">
                <h1 class="admin-page-title">
                    <?php 
                    switch ($current_script) {
                        case 'index.php': echo 'Dashboard Overview'; break;
                        case 'bookings.php': echo 'Catering Bookings'; break;
                        case 'menu.php': echo 'Manage Menu'; break;
                        case 'categories.php': echo 'Manage Categories'; break;
                        case 'blogs.php': echo 'Manage Blogs'; break;
                        case 'inquiries.php': echo 'Contact Inquiries'; break;
                        case 'settings.php': echo 'Account Settings'; break;
                        default: echo 'Admin Center';
                    }
                    ?>
                </h1>
                <div class="admin-user-info text-muted">
                    Logged in as <strong><?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Administrator'); ?></strong>
                </div>
            </header>
            <?php endif; ?>
