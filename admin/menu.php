<?php
/**
 * Evangiz Admin Panel - Menu Content Management CRUD
 */

// Load security header
include_once __DIR__ . '/includes/header.php';

$action = $_GET['action'] ?? 'list';
$item_id = intval($_GET['id'] ?? 0);
$alert_success = '';
$alert_error = '';

// Fetch all categories for select dropdown
try {
    $categories = $conn->query("SELECT * FROM categories ORDER BY sort_order ASC")->fetchAll();
} catch (PDOException $e) {
    $categories = [];
    $alert_error = "Failed to load categories: " . $e->getMessage();
}

// 1. Process Actions (Create, Update, Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = intval($_POST['price'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $category_id = intval($_POST['category_id'] ?? 0);
    $tags = trim($_POST['tags'] ?? '');
    $is_active = intval($_POST['is_active'] ?? 1);
    $sort_order = intval($_POST['sort_order'] ?? 0);

    // Form validation
    if (empty($name) || $price <= 0 || empty($description) || $category_id <= 0) {
        $alert_error = "Please fill in all required fields (Name, Price, Description, Category).";
    } else {
        if ($action === 'add') {
            try {
                $stmt = $conn->prepare("INSERT INTO menu_items (category_id, name, price, description, tags, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$category_id, $name, $price, $description, $tags, $is_active, $sort_order]);
                $alert_success = "Menu item added successfully!";
                $action = 'list';
            } catch (PDOException $e) {
                $alert_error = "Failed to add menu item: " . $e->getMessage();
            }
        } elseif ($action === 'edit' && $item_id > 0) {
            try {
                $stmt = $conn->prepare("UPDATE menu_items SET category_id = ?, name = ?, price = ?, description = ?, tags = ?, is_active = ?, sort_order = ? WHERE id = ?");
                $stmt->execute([$category_id, $name, $price, $description, $tags, $is_active, $sort_order, $item_id]);
                $alert_success = "Menu item updated successfully!";
                $action = 'list';
            } catch (PDOException $e) {
                $alert_error = "Failed to update menu item: " . $e->getMessage();
            }
        }
    }
}

// Handle Delete Request
if ($action === 'delete' && $item_id > 0) {
    try {
        $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
        $stmt->execute([$item_id]);
        $alert_success = "Menu item deleted successfully!";
        $action = 'list';
    } catch (PDOException $e) {
        $alert_error = "Failed to delete menu item: " . $e->getMessage();
    }
}

// 2. Fetch data based on active view state
$menu_items = [];
$form_item = null;

if ($action === 'list') {
    try {
        $menu_items = $conn->query("SELECT m.*, c.name as category_name FROM menu_items m JOIN categories c ON m.category_id = c.id ORDER BY c.sort_order ASC, m.sort_order ASC")->fetchAll();
    } catch (PDOException $e) {
        $alert_error = "Database read error: " . $e->getMessage();
    }
} elseif ($action === 'edit' && $item_id > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ? LIMIT 1");
        $stmt->execute([$item_id]);
        $form_item = $stmt->fetch();
        if (!$form_item) {
            $alert_error = "Menu item not found.";
            $action = 'list';
        }
    } catch (PDOException $e) {
        $alert_error = "Database read error: " . $e->getMessage();
        $action = 'list';
    }
}
?>

<!-- Alert System Notification -->
<?php if (!empty($alert_success)): ?>
    <div class="alert-admin alert-admin-success"><?php echo htmlspecialchars($alert_success); ?></div>
<?php endif; ?>
<?php if (!empty($alert_error)): ?>
    <div class="alert-admin alert-admin-error"><?php echo htmlspecialchars($alert_error); ?></div>
<?php endif; ?>

<!-- VIEW STATE: Form Panel (Add / Edit) -->
<?php if ($action === 'add' || $action === 'edit'): ?>
    <div class="admin-form-panel">
        <h3 style="margin-bottom: var(--space-lg);"><?php echo $action === 'add' ? 'Add New Menu Item' : 'Edit Menu Item'; ?></h3>
        
        <form action="<?php echo admin_url('/menu.php?action=' . $action . '&id=' . $item_id); ?>" method="POST" id="menu-editor-form">
            <?php 
            $name_val = $form_item ? $form_item['name'] : '';
            $price_val = $form_item ? $form_item['price'] : '';
            $desc_val = $form_item ? $form_item['description'] : '';
            $cat_id_val = $form_item ? $form_item['category_id'] : '';
            $tags_val = $form_item ? $form_item['tags'] : '';
            $is_active_val = $form_item ? $form_item['is_active'] : 1;
            $sort_order_val = $form_item ? $form_item['sort_order'] : 0;
            
            echo render_form_input('name', 'Item Name', 'text', 'Enter item name (e.g. Traditional Beef Luwombo)...', true, $name_val);
            echo render_form_input('price', 'Price (UGX)', 'number', 'Price in Ugandan Shillings (e.g. 15000)...', true, $price_val);
            
            // Build categories list for select helper
            $cat_options = ['' => '-- Select Category --'];
            foreach ($categories as $cat) {
                $cat_options[$cat['id']] = $cat['name'];
            }
            echo render_form_select('category_id', 'Category', $cat_options, true, $cat_id_val);
            ?>

            <?php
            echo render_form_input('tags', 'Sub-tags / Labels (Comma-separated)', 'text', 'e.g. Beef, Large, Spicy...', false, $tags_val);
            echo render_form_textarea('description', 'Description', 'Write item details and ingredients here...', true, $desc_val);
            
            $status_options = [
                '1' => 'Active (Visible on Menu)',
                '0' => 'Inactive (Hidden)'
            ];
            echo render_form_select('is_active', 'Status', $status_options, true, $is_active_val);
            echo render_form_input('sort_order', 'Sort Order', 'number', 'Lower numbers display first (e.g. 10, 20)...', false, $sort_order_val);
            ?>
            
            <div style="margin-top: var(--space-lg); display: flex; gap: var(--space-sm);">
                <button type="submit" class="btn btn-primary">
                    <span class="btn-text-wrapper">
                        <span class="btn-text-main"><i class="hgi-stroke hgi-tick-01"></i> Save Menu Item</span>
                        <span class="btn-text-hover"><i class="hgi-stroke hgi-tick-01"></i> Save Menu Item</span>
                    </span>
                </button>
                <a href="<?php echo admin_url('/menu.php'); ?>" class="btn btn-secondary">
                    <span class="btn-text-wrapper">
                        <span class="btn-text-main"><i class="hgi-stroke hgi-arrow-left-01"></i> Cancel</span>
                        <span class="btn-text-hover"><i class="hgi-stroke hgi-arrow-left-01"></i> Cancel</span>
                    </span>
                </a>
            </div>
        </form>
    </div>

<!-- VIEW STATE: List View -->
<?php else: ?>
    <div style="margin-bottom: var(--space-md); display: flex; justify-content: flex-end; gap: var(--space-sm); flex-wrap: wrap;">
        <a href="<?php echo admin_url('/categories.php'); ?>" class="btn btn-secondary">
            <span class="btn-text-wrapper">
                <span class="btn-text-main"><i class="hgi-stroke hgi-category-01"></i> Manage Categories</span>
                <span class="btn-text-hover"><i class="hgi-stroke hgi-category-01"></i> Manage Categories</span>
            </span>
        </a>
        <a href="<?php echo admin_url('/menu.php?action=add'); ?>" class="btn btn-primary">
            <span class="btn-text-wrapper">
                <span class="btn-text-main"><i class="hgi-stroke hgi-add-01"></i> Add Menu Item</span>
                <span class="btn-text-hover"><i class="hgi-stroke hgi-add-01"></i> Add Menu Item</span>
            </span>
        </a>
    </div>

    <div class="admin-table-card">
        <?php if (empty($menu_items)): ?>
            <div style="padding: var(--space-xl);" class="text-center text-muted">
                <p>No menu items exist in the database yet.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Tags</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menu_items as $item): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($item['name']); ?></strong><br><span class="text-muted" style="font-size: 0.8rem;"><?php echo htmlspecialchars(mb_strimwidth($item['description'], 0, 70, '...')); ?></span></td>
                            <td><span class="badge badge-menu" style="font-size: 0.8rem; background-color: var(--color-bg-warm); color: var(--color-primary);"><?php echo htmlspecialchars($item['category_name']); ?></span></td>
                            <td><strong>UGX <?php echo number_format($item['price']); ?></strong></td>
                            <td>
                                <?php 
                                $tags = !empty($item['tags']) ? array_map('trim', explode(',', $item['tags'])) : [];
                                foreach ($tags as $tag): ?>
                                    <span class="badge" style="background-color: rgba(231, 86, 42, 0.1); color: var(--color-accent); font-size: 0.75rem; margin-right: 2px; padding: 2px 6px; border-radius: var(--radius-sm);"><?php echo htmlspecialchars($tag); ?></span>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <span class="badge" style="background-color: <?php echo $item['is_active'] ? 'rgba(16, 185, 129, 0.15); color: #047857;' : 'rgba(239, 68, 68, 0.15); color: #b91c1c;'; ?>; font-size: 0.8rem;">
                                    <?php echo $item['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td><?php echo intval($item['sort_order']); ?></td>
                            <td>
                                <a href="<?php echo admin_url('/menu.php?action=edit&id=' . $item['id']); ?>" class="btn-action btn-action-edit" style="white-space: nowrap;"><i class="hgi-stroke hgi-pencil-edit-01"></i> Edit</a>
                                <a href="<?php echo admin_url('/menu.php?action=delete&id=' . $item['id']); ?>" class="btn-action btn-action-delete" style="white-space: nowrap;" onclick="return confirm('Are you sure you want to delete this menu item permanently?');"><i class="hgi-stroke hgi-delete-02"></i> Delete</a>
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
