<?php include __DIR__ . '/partial/header.php'; ?>

<?php
if (class_exists(\Core\Session::class))
    $flash = \Core\Session::getFlash();
else {
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    $flash = $_SESSION['flash'] ?? null;
    if ($flash)
        unset($_SESSION['flash']);
}

$id = $page['id'] ?? null;
$slug = $page['slug'] ?? '';
$title = $page['title'] ?? '';
$content = $page['content'] ?? '';
$meta = $page['meta'] ?? '';
?>

<div class="page">
    <div class="container-xl">
        <div class="row mb-3">
            <div class="col">
                <h2 class="page-title"><?php echo $id ? 'Chỉnh sửa trang' : 'Tạo trang mới'; ?></h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/admin/pages" class="btn btn-outline-secondary">Quay lại</a>
            </div>
        </div>

        <?php if (!empty($flash)): ?>
            <div class="<?php echo ($flash['type'] === 'success') ? 'alert alert-success' : 'alert alert-danger'; ?>">
                <?php echo htmlspecialchars($flash['message']); ?></div>
        <?php endif; ?>

        <form method="POST" action="/admin/pages/save">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="mb-3">
                <label class="form-label">Slug (unique)</label>
                <input name="slug" value="<?php echo htmlspecialchars($slug); ?>" class="form-control" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input name="title" value="<?php echo htmlspecialchars($title); ?>" class="form-control" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" rows="10"
                    class="form-control"><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Meta (JSON hoặc text)</label>
                <textarea name="meta" rows="3" class="form-control"><?php echo htmlspecialchars($meta); ?></textarea>
            </div>
            <div>
                <button class="btn btn-primary"><?php echo $id ? 'Lưu' : 'Tạo mới'; ?></button>
            </div>
        </form>

    </div>
</div>

<?php include __DIR__ . '/partial/footer.php'; ?>