<?php include __DIR__ . '/../partial/header.php'; ?>
<?php include __DIR__ . '/../partial/navbar.php'; ?>

<?php
$item = $news ?? null;

if (!$item) {
    echo '<div class="container-xl mt-3"><div class="alert alert-danger">Lỗi: Không tìm thấy dữ liệu bài viết!</div></div>';
    require __DIR__ . '/../partial/footer.php';
    exit;
}

$image_url = $item['image_url'] ?? '';
?>

<div class="page">
    <div class="container-xl">

        <div class="row g-2 align-items-center page-header pl-2 mb-3">
            <div class="col">
                <h2 class="page-title">Sửa bài viết</h2>
                <div class="text-muted">Cập nhật thông tin bài viết</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="/admin/news/update?id=<?= $item['id'] ?>" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control"
                               value="<?= htmlspecialchars($item['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control"
                               value="<?= htmlspecialchars($item['slug']) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tóm tắt</label>
                        <textarea name="summary" class="form-control" rows="3"><?= htmlspecialchars($item['summary']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" class="form-control" rows="8"><?= htmlspecialchars($item['content']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh minh họa</label>

                        <?php if ($image_url): ?>
                            <div class="mb-2 d-flex align-items-center" id="image-preview">
                                <img src="<?= htmlspecialchars($image_url) ?>"
                                     style="width:150px;height:100px;object-fit:cover;border-radius:6px;margin-right:10px;">
                                <button type="button" class="btn btn-sm btn-danger" id="remove-image">Xóa</button>
                            </div>
                        <?php endif; ?>

                        <input type="text" name="image_url" class="form-control mb-2"
                               id="image-url-input"
                               value="<?= htmlspecialchars($image_url) ?>" placeholder="Nhập URL ảnh nếu có">

                        <input type="file" name="image_file" class="form-control" id="image-file-input">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_published" value="1"
                               class="form-check-input" id="publishedCheck"
                               <?= $item['is_published'] ? "checked" : "" ?>>
                        <label for="publishedCheck" class="form-check-label">Xuất bản bài viết</label>
                    </div>

                    <div class="form-footer mt-3">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="/admin/news" class="btn btn-outline-secondary ms-2">Quay lại</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const removeBtn = document.getElementById('remove-image');
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            const preview = document.getElementById('image-preview');
            if (preview) preview.remove();

            const urlInput = document.getElementById('image-url-input');
            if (urlInput) urlInput.value = '';

            const fileInput = document.getElementById('image-file-input');
            if (fileInput) fileInput.value = '';
        });
    }
});
</script>

<?php include __DIR__ . '/../partial/footer.php'; ?>
