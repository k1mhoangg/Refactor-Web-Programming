<?php include __DIR__ . '/../partial/header.php'; ?>

<?php
if (class_exists(\Core\Session::class)) {
    $flash = \Core\Session::getFlash();
} else {
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    $flash = $_SESSION['flash'] ?? null;
    if ($flash)
        unset($_SESSION['flash']);
}
?>

<?php include __DIR__ . '/../partial/navbar.php'; ?>

<div class="page">
    <div class="container-xl">

        <div class="row g-2 align-items-center page-header pl-2">
            <div class="col">
                <h2 class="page-title">Quản lý Tin tức</h2>
                <div class="text-muted">Danh sách bài viết</div>
            </div>

            <div class="col-auto ms-auto">
                <a href="/admin/news/create" class="btn btn-primary">+ Thêm bài viết</a>
            </div>
        </div>

        <?php if (!empty($flash)): ?>
            <div class="alert <?php echo ($flash['type'] === 'success') ? 'alert-success' : 'alert-danger'; ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Form tìm kiếm -->
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input 
                    type="text" 
                    name="keyword" 
                    class="form-control" 
                    placeholder="Tìm kiếm bài viết..." 
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                >
                <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Slug</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($newsList)): foreach ($newsList as $n): ?>
                            <tr>
                                <td><?= $n['id'] ?></td>
                                <td><?= htmlspecialchars($n['title']) ?></td>
                                <td><?= htmlspecialchars($n['slug']) ?></td>
                                <td style="width:80px">
                                    <?php if (!empty($n['image_url'])): ?>
                                        <img src="<?= htmlspecialchars($n['image_url']) ?>" 
                                             style="width:64px;height:64px;object-fit:cover;border-radius:6px">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= !empty($n['is_published']) 
                                        ? '<span class="badge bg-success">Đã đăng</span>' 
                                        : '<span class="badge bg-secondary">Nháp</span>' ?>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/news/edit?id=<?= $n['id'] ?>"
                                       class="btn btn-sm btn-outline-secondary">Sửa</a>
                                    <form method="POST" 
                                          action="/admin/news/delete?id=<?= $n['id'] ?>" 
                                          style="display:inline-block"
                                          onsubmit="return confirm('Xác nhận xoá bài viết này?');">
                                        <button class="btn btn-sm btn-danger">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Không có bài viết</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Phân trang -->
        <?php if (!empty($pagination) && $pagination->getTotalPages() > 1): ?>
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $pagination->getTotalPages(); $i++): ?>
                        <li class="page-item <?= ($i == $pagination->getCurrentPage()) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&keyword=<?= urlencode($_GET['keyword'] ?? '') ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>

<?php include __DIR__ . '/../partial/footer.php'; ?>
