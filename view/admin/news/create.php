<?php include __DIR__ . '/../partial/header.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Flash message
if (!empty($_SESSION['flash'])) {
    $f = $_SESSION['flash'];
    echo '<div class="' . (($f['type'] === 'success') ? 'alert alert-success' : 'alert alert-danger') . '">' 
        . htmlspecialchars($f['message']) . '</div>';
    unset($_SESSION['flash']);
}

// Biến chung cho thêm/sửa
$item = $news ?? []; 

$id = $item['id'] ?? null;
$title = $item['title'] ?? '';
$slug = $item['slug'] ?? '';
$summary = $item['summary'] ?? '';
$content = $item['content'] ?? '';
$image_url = $item['image_url'] ?? '';
$is_published = !empty($item['is_published']);
?>

<?php include __DIR__ . '/../partial/navbar.php'; ?>

<div class="page">
    <div class="container-xl">

        <div class="row mb-3 page-header">
            <div class="col">
                <h2 class="page-title"><?= $id ? "Chỉnh sửa bài viết" : "Thêm bài viết" ?></h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="/admin/news" class="btn btn-outline-secondary">Quay lại</a>
            </div>
        </div>

        <form method="POST" action="<?= $id ? '/admin/news/update?id=' . $id : '/admin/news/store' ?>" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input name="title" class="form-control" 
                       value="<?= htmlspecialchars($title) ?>" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input name="slug" class="form-control" 
                       value="<?= htmlspecialchars($slug) ?>" placeholder="Tự sinh nếu để trống" />
            </div>

            <div class="mb-3">
                <label class="form-label">Tóm tắt</label>
                <textarea name="summary" rows="3" class="form-control"><?= htmlspecialchars($summary) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" rows="8" class="form-control"><?= htmlspecialchars($content) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh minh họa</label>

                <?php if ($image_url): ?>
                    <div class="mb-2" id="image-preview">
                        <img src="<?= htmlspecialchars($image_url) ?>" 
                             style="width:150px;height:100px;object-fit:cover;border-radius:6px">
                        <button type="button" class="btn btn-sm btn-danger" id="remove-image">Xóa</button>
                    </div>
                <?php endif; ?>

                <!-- Nhập URL -->
                <input type="text" name="image_url" class="form-control mb-2"
                       id="image-url-input"
                       value="<?= htmlspecialchars($image_url) ?>" placeholder="Nhập URL ảnh nếu có">

                <!-- Upload từ máy tính -->
                <input type="file" name="image_file" class="form-control" id="image-file-input">
            </div>

            <div class="mb-3 form-check">
                <label class="form-check-label">
                    <input type="checkbox" name="is_published" class="form-check-input"
                        <?= $is_published ? 'checked' : '' ?>>
                    Xuất bản bài viết
                </label>
            </div>

            <div>
                <button class="btn btn-primary"><?= $id ? "Lưu bài viết" : "Tạo mới" ?></button>
            </div>

        </form>
    </div>
</div>

<?php include __DIR__ . '/../partial/pagination.php'; ?>

<!-- JS để Xóa ảnh -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const removeBtn = document.getElementById('remove-image');
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            // Xóa preview ảnh
            const preview = document.getElementById('image-preview');
            if (preview) preview.remove();

            // Reset input URL và file
            const urlInput = document.getElementById('image-url-input');
            if (urlInput) urlInput.value = '';

            const fileInput = document.getElementById('image-file-input');
            if (fileInput) fileInput.value = '';
        });
    }
});
</script>
