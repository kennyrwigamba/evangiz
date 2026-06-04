<?php
/**
 * Evangiz Admin Panel - Category Management CRUD
 */

include_once __DIR__ . '/includes/header.php';

$action = $_GET['action'] ?? 'list';
$category_id = intval($_GET['id'] ?? 0);
$alert_success = '';
$alert_error = '';

if (!function_exists('build_unique_category_slug')) {
    function build_unique_category_slug(PDO $conn, string $base_slug, int $ignore_id = 0): string {
        $candidate = $base_slug;
        $suffix = 2;

        while (true) {
            if ($ignore_id > 0) {
                $check = $conn->prepare('SELECT COUNT(*) FROM categories WHERE slug = ? AND id != ?');
                $check->execute([$candidate, $ignore_id]);
            } else {
                $check = $conn->prepare('SELECT COUNT(*) FROM categories WHERE slug = ?');
                $check->execute([$candidate]);
            }

            if ((int) $check->fetchColumn() === 0) {
                return $candidate;
            }

            $candidate = $base_slug . '-' . $suffix;
            $suffix++;
        }
    }
}

if (!isset($_SESSION['category_flash'])) {
    $_SESSION['category_flash'] = ['success' => '', 'error' => ''];
}

if (!empty($_SESSION['category_flash']['success'])) {
    $alert_success = $_SESSION['category_flash']['success'];
    $_SESSION['category_flash']['success'] = '';
}

if (!empty($_SESSION['category_flash']['error'])) {
    $alert_error = $_SESSION['category_flash']['error'];
    $_SESSION['category_flash']['error'] = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $sort_order = intval($_POST['sort_order'] ?? 0);

    if (empty($name)) {
        $alert_error = 'Please enter a category name.';
    } else {
        if (empty($slug)) {
            $slug = $name;
        }

        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower(str_replace(' ', '-', $slug)));

        if (empty($slug)) {
            $alert_error = 'Please provide a valid category slug.';
        } else {
            if ($action === 'add') {
                try {
                    $slug = build_unique_category_slug($conn, $slug);
                    $stmt = $conn->prepare('INSERT INTO categories (slug, name, sort_order) VALUES (?, ?, ?)');
                    $stmt->execute([$slug, $name, $sort_order]);
                    $_SESSION['category_flash']['success'] = 'Category created successfully!';
                    echo '<script>window.location.href = ' . json_encode(admin_url('/categories.php')) . ';</script>';
                    exit;
                } catch (PDOException $e) {
                    $alert_error = 'Failed to add category: ' . $e->getMessage();
                }
            } elseif ($action === 'edit' && $category_id > 0) {
                try {
                    $slug = build_unique_category_slug($conn, $slug, $category_id);
                    $stmt = $conn->prepare('UPDATE categories SET slug = ?, name = ?, sort_order = ? WHERE id = ?');
                    $stmt->execute([$slug, $name, $sort_order, $category_id]);
                    $_SESSION['category_flash']['success'] = 'Category updated successfully!';
                    echo '<script>window.location.href = ' . json_encode(admin_url('/categories.php')) . ';</script>';
                    exit;
                } catch (PDOException $e) {
                    $alert_error = 'Failed to update category: ' . $e->getMessage();
                }
            }
        }
    }
}

if ($action === 'delete' && $category_id > 0) {
    try {
        $stmt = $conn->prepare('DELETE FROM categories WHERE id = ?');
        $stmt->execute([$category_id]);
        $_SESSION['category_flash']['success'] = 'Category deleted successfully!';
        echo '<script>window.location.href = ' . json_encode(admin_url('/categories.php')) . ';</script>';
        exit;
    } catch (PDOException $e) {
        $alert_error = 'Failed to delete category: ' . $e->getMessage();
    }
}

$categories = [];
$form_category = null;

if ($action === 'list') {
    try {
        $categories = $conn->query('SELECT c.*, COUNT(m.id) AS item_count FROM categories c LEFT JOIN menu_items m ON m.category_id = c.id GROUP BY c.id ORDER BY c.sort_order ASC, c.name ASC')->fetchAll();
    } catch (PDOException $e) {
        $alert_error = 'Database read error: ' . $e->getMessage();
    }
} elseif ($action === 'edit' && $category_id > 0) {
    try {
        $stmt = $conn->prepare('SELECT * FROM categories WHERE id = ? LIMIT 1');
        $stmt->execute([$category_id]);
        $form_category = $stmt->fetch();
        if (!$form_category) {
            $alert_error = 'Category not found.';
            $action = 'list';
        }
    } catch (PDOException $e) {
        $alert_error = 'Database read error: ' . $e->getMessage();
        $action = 'list';
    }
}
?>

<?php if (!empty($alert_success)): ?>
    <div class="alert-admin alert-admin-success"><?php echo htmlspecialchars($alert_success); ?></div>
<?php endif; ?>
<?php if (!empty($alert_error)): ?>
    <div class="alert-admin alert-admin-error"><?php echo htmlspecialchars($alert_error); ?></div>
<?php endif; ?>

<?php if ($action === 'add' || $action === 'edit'): ?>
    <div class="admin-form-panel">
        <h3 style="margin-bottom: var(--space-lg);"><?php echo $action === 'add' ? 'Add New Category' : 'Edit Category'; ?></h3>

        <form action="<?php echo admin_url('/categories.php?action=' . $action . '&id=' . $category_id); ?>" method="POST" id="category-editor-form">
            <?php
            $name_val = $form_category ? $form_category['name'] : '';
            $slug_val = $form_category ? $form_category['slug'] : '';
            $sort_order_val = $form_category ? $form_category['sort_order'] : 0;

            echo render_form_input('name', 'Category Name', 'text', 'Enter category name (e.g. Fast Foods)...', true, $name_val);
            echo render_form_input('slug', 'URL Slug', 'text', 'auto-generated-slug-path', false, $slug_val);
            echo render_form_input('sort_order', 'Sort Order', 'number', 'Lower numbers display first (e.g. 10, 20)...', false, $sort_order_val);
            ?>

            <div style="margin-top: var(--space-lg); display: flex; gap: var(--space-sm);">
                <button type="submit" class="btn btn-primary">
                    <span class="btn-text-wrapper">
                        <span class="btn-text-main"><i class="hgi-stroke hgi-tick-01"></i> Save Category</span>
                        <span class="btn-text-hover"><i class="hgi-stroke hgi-tick-01"></i> Save Category</span>
                    </span>
                </button>
                <a href="<?php echo admin_url('/categories.php'); ?>" class="btn btn-secondary">
                    <span class="btn-text-wrapper">
                        <span class="btn-text-main"><i class="hgi-stroke hgi-arrow-left-01"></i> Cancel</span>
                        <span class="btn-text-hover"><i class="hgi-stroke hgi-arrow-left-01"></i> Cancel</span>
                    </span>
                </a>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput && <?php echo $action === 'add' ? 'true' : 'false'; ?>) {
            nameInput.addEventListener('input', () => {
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s\-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/\-+/g, '-')
                    .trim();
            });
        }
    });
    </script>
<?php else: ?>
    <div style="margin-bottom: var(--space-md); display: flex; justify-content: flex-end;">
        <a href="<?php echo admin_url('/categories.php?action=add'); ?>" class="btn btn-primary">
            <span class="btn-text-wrapper">
                <span class="btn-text-main"><i class="hgi-stroke hgi-add-01"></i> Add Category</span>
                <span class="btn-text-hover"><i class="hgi-stroke hgi-add-01"></i> Add Category</span>
            </span>
        </a>
    </div>

    <div class="admin-table-card">
        <?php if (empty($categories)): ?>
            <div style="padding: var(--space-xl);" class="text-center text-muted">
                <p>No categories exist in the database yet.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Items</th>
                        <th>Sort Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($category['name']); ?></strong></td>
                            <td><span class="badge badge-menu" style="font-size: 0.8rem; background-color: var(--color-bg-warm); color: var(--color-primary);">
                                <?php echo htmlspecialchars($category['slug']); ?>
                            </span></td>
                            <td><?php echo intval($category['item_count']); ?></td>
                            <td><?php echo intval($category['sort_order']); ?></td>
                            <td>
                                <a href="<?php echo admin_url('/categories.php?action=edit&id=' . $category['id']); ?>" class="btn-action btn-action-edit" style="white-space: nowrap;"><i class="hgi-stroke hgi-pencil-edit-01"></i> Edit</a>
                                <a href="<?php echo admin_url('/categories.php?action=delete&id=' . $category['id']); ?>" class="btn-action btn-action-delete" style="white-space: nowrap;" onclick="return confirm('Are you sure you want to delete this category? All menu items in it will also be deleted.');"><i class="hgi-stroke hgi-delete-02"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
