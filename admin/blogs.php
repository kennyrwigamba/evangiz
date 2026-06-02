<?php
/**
 * Evangiz Admin Panel - Blog Content Management CRUD
 */

// Load security header
include_once __DIR__ . '/includes/header.php';

$action = $_GET['action'] ?? 'list';
$post_id = intval($_GET['id'] ?? 0);
$alert_success = '';
$alert_error = '';

// 1. Process Actions (Create, Update, Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $image_path = trim($_POST['image_path'] ?? '');

    // Form validation
    if (empty($title) || empty($slug) || empty($content)) {
        $alert_error = "Please fill in all required fields (Title, Slug, Content).";
    } else {
        // Sanitize slug
        $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower(str_replace(' ', '-', $slug)));
        
        if ($action === 'add') {
            try {
                // Check if slug is unique
                $check = $conn->prepare("SELECT COUNT(*) FROM blogs WHERE slug = ?");
                $check->execute([$slug]);
                if ($check->fetchColumn() > 0) {
                    $alert_error = "A blog post with this URL slug already exists. Please choose a different title or slug.";
                } else {
                    $stmt = $conn->prepare("INSERT INTO blogs (title, slug, content, image_path) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$title, $slug, $content, $image_path]);
                    $alert_success = "Blog post created successfully!";
                    $action = 'list';
                }
            } catch (PDOException $e) {
                $alert_error = "Failed to insert article: " . $e->getMessage();
            }
        } elseif ($action === 'edit' && $post_id > 0) {
            try {
                // Check unique slug on edit
                $check = $conn->prepare("SELECT COUNT(*) FROM blogs WHERE slug = ? AND id != ?");
                $check->execute([$slug, $post_id]);
                if ($check->fetchColumn() > 0) {
                    $alert_error = "A blog post with this URL slug already exists. Please choose a different slug.";
                } else {
                    $stmt = $conn->prepare("UPDATE blogs SET title = ?, slug = ?, content = ?, image_path = ? WHERE id = ?");
                    $stmt->execute([$title, $slug, $content, $image_path, $post_id]);
                    $alert_success = "Blog post updated successfully!";
                    $action = 'list';
                }
            } catch (PDOException $e) {
                $alert_error = "Failed to update article: " . $e->getMessage();
            }
        }
    }
}

// Handle Delete Request
if ($action === 'delete' && $post_id > 0) {
    try {
        $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
        $stmt->execute([$post_id]);
        $alert_success = "Blog post deleted successfully!";
        $action = 'list';
    } catch (PDOException $e) {
        $alert_error = "Failed to delete article: " . $e->getMessage();
    }
}

// 2. Fetch data based on active view state
$blogs = [];
$form_post = null;

if ($action === 'list') {
    try {
        $blogs = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC")->fetchAll();
    } catch (PDOException $e) {
        $alert_error = "Database read error: " . $e->getMessage();
    }
} elseif ($action === 'edit' && $post_id > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ? LIMIT 1");
        $stmt->execute([$post_id]);
        $form_post = $stmt->fetch();
        if (!$form_post) {
            $alert_error = "Article not found.";
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
        <h3 style="margin-bottom: var(--space-lg);"><?php echo $action === 'add' ? 'Write New Blog Post' : 'Edit Blog Post'; ?></h3>
        
        <form action="<?php echo admin_url('/blogs.php?action=' . $action . '&id=' . $post_id); ?>" method="POST" id="blog-editor-form">
            <?php 
            $title_val = $form_post ? $form_post['title'] : '';
            $slug_val = $form_post ? $form_post['slug'] : '';
            $content_val = $form_post ? $form_post['content'] : '';
            $image_val = $form_post ? $form_post['image_path'] : 'image/blog/default.jpg';
            
            echo render_form_input('title', 'Article Title', 'text', 'Enter article headline...', true, $title_val);
            echo render_form_input('slug', 'URL Slug (For SEO)', 'text', 'auto-generated-slug-path', true, $slug_val);
            echo render_form_input('image_path', 'Cover Image Path', 'text', 'e.g. image/blog/banner.jpg', false, $image_val);
            echo render_form_textarea('content', 'Article Body Content', 'Write article text here...', true, $content_val);
            ?>
            
            <div style="margin-top: var(--space-lg); display: flex; gap: var(--space-sm);">
                <button type="submit" class="btn btn-primary">
                    <span class="btn-text-wrapper">
                        <span class="btn-text-main">Save Article</span>
                        <span class="btn-text-hover">Save Article</span>
                    </span>
                </button>
                <a href="<?php echo admin_url('/blogs.php'); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Live Auto-Slug Generation script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        if (titleInput && slugInput && <?php echo $action === 'add' ? 'true' : 'false'; ?>) {
            titleInput.addEventListener('input', () => {
                slugInput.value = titleInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s\-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/\-+/g, '-')
                    .trim();
            });
        }
    });
    </script>

<!-- VIEW STATE: List View -->
<?php else: ?>
    <div style="margin-bottom: var(--space-md); display: flex; justify-content: flex-end;">
        <a href="<?php echo admin_url('/blogs.php?action=add'); ?>" class="btn btn-primary">
            <span class="btn-text-wrapper">
                <span class="btn-text-main">📝 Write New Post</span>
                <span class="btn-text-hover">📝 Write New Post</span>
            </span>
        </a>
    </div>

    <div class="admin-table-card">
        <?php if (empty($blogs)): ?>
            <div style="padding: var(--space-xl);" class="text-center text-muted">
                <p>No blog posts exist in the system yet.</p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Post Title</th>
                        <th>Slug URL</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog): ?>
                        <tr>
                            <td style="width: 80px;">
                                <img src="<?php echo url($blog['image_path'] ?: 'image/blog/default.jpg'); ?>" alt="Cover" style="width: 60px; height: 45px; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
                            </td>
                            <td><strong><?php echo htmlspecialchars($blog['title']); ?></strong></td>
                            <td style="font-family: monospace; color: var(--color-text-muted);">/blog/<?php echo htmlspecialchars($blog['slug']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($blog['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo admin_url('/blogs.php?action=edit&id=' . $blog['id']); ?>" class="btn-action btn-action-edit">✏️ Edit</a>
                                <a href="<?php echo admin_url('/blogs.php?action=delete&id=' . $blog['id']); ?>" class="btn-action btn-action-delete" onclick="return confirm('Are you sure you want to delete this blog post permanently?');">🗑️ Delete</a>
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
