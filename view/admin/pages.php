<?php include __DIR__ . '/partial/header.php'; ?>

<?php if (class_exists(\Core\Session::class))
    $flash = \Core\Session::getFlash();
else {
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    $flash = $_SESSION['flash'] ?? null;
    if ($flash)
        unset($_SESSION['flash']);
} ?>

<div class="page">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-4">
            <div class="col">
                <h2 class="page-title">Quản lý trang (Pages)</h2>
                <div class="text-muted">Sửa nội dung giới thiệu, thông tin liên hệ, logo, ...</div>
            </div>
            <div class="col-auto ms-auto">
                <a href="/admin/pages/edit" class="btn btn-primary">Tạo trang mới</a>
            </div>
        </div>

        <?php if (!empty($flash)): ?>
            <div class="<?php echo ($flash['type'] === 'success') ? 'alert alert-success' : 'alert alert-danger'; ?>">
                <?php echo htmlspecialchars($flash['message']); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Slug</th>
                            <th>Title</th>
                            <th>Updated</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pages)):
                            foreach ($pages as $p): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['id']); ?></td>
                                    <td><?php echo htmlspecialchars($p['slug']); ?></td>
                                    <td><?php echo htmlspecialchars($p['title']); ?></td>
                                    <td><?php echo htmlspecialchars($p['updated_at'] ?? $p['created_at'] ?? ''); ?></td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-outline-secondary"
                                            href="/admin/pages/edit?id=<?php echo urlencode($p['id']); ?>">Sửa</a>
                                        <form method="POST" action="/admin/pages/delete" style="display:inline-block"
                                            onsubmit="return confirm('Xóa trang?');">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($p['id']); ?>">
                                            <button class="btn btn-sm btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Không có trang</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include __DIR__ . '/partial/footer.php'; ?>