<?php include __DIR__ . '/../partial/header.php'; ?>

<?php
// Flash message giống Product admin
if (class_exists(\Core\Session::class)) {
    $flash = \Core\Session::getFlash();
} else {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $flash = $_SESSION['flash'] ?? null;
    if ($flash) unset($_SESSION['flash']);
}
?>

<?php include __DIR__ . '/../partial/navbar.php'; ?>

<div class="page">
    <div class="container-xl">

        <!-- Page Header -->
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Quản lý bình luận</h2>
                <div class="text-muted">Danh sách bình luận từ khách</div>
            </div>
        </div>

        <!-- Flash -->
        <?php if (!empty($flash)): ?>
            <div class="alert alert-<?php echo $flash['type'] === 'success' ? 'success' : 'danger'; ?>">
                <?php echo htmlspecialchars($flash['message']); ?>
            </div>
        <?php endif; ?>


        <!-- Card -->
        <div class="card">

            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người gửi</th>
                            <th>Bài viết</th>
                            <th>Nội dung</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $cmt): ?>
                        <tr>
                            <td><?php echo $cmt['id']; ?></td>

                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($cmt['name']); ?></div>
                                <div class="text-muted small"><?php echo htmlspecialchars($cmt['email']); ?></div>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($cmt['news_title'] ?? 'Bài viết đã xóa'); ?>
                            </td>

                            <td class="text-muted">
                                <?php 
                                    echo htmlspecialchars(
                                        mb_strimwidth($cmt['content'], 0, 50, "...", "UTF-8")
                                    ); 
                                ?>
                            </td>

                            <td><?php echo date("d/m/Y H:i", strtotime($cmt['created_at'])); ?></td>

                            <td>
                                <?php if ($cmt['status'] === 'approved'): ?>
                                    <span class="badge bg-success">Đã duyệt</span>
                                <?php elseif ($cmt['status'] === 'rejected'): ?>
                                    <span class="badge bg-secondary">Đã ẩn</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end">

                                <?php if ($cmt['status'] !== 'approved'): ?>
                                    <a href="/admin/comments/approve/<?php echo $cmt['id']; ?>" 
                                       class="btn btn-sm btn-outline-success">
                                        Duyệt
                                    </a>
                                <?php endif; ?>

                                <?php if ($cmt['status'] !== 'rejected'): ?>
                                    <a href="/admin/comments/reject/<?php echo $cmt['id']; ?>" 
                                       class="btn btn-sm btn-outline-warning">
                                        Ẩn
                                    </a>
                                <?php endif; ?>

                                <form action="/admin/comments/delete" method="POST" class="d-inline"
                                      onsubmit="return confirm('Xóa vĩnh viễn bình luận này?');">
                                    <input type="hidden" name="id" value="<?php echo $cmt['id']; ?>">
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </form>

                            </td>

                        </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Không có bình luận nào</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <?php include __DIR__ . '/../partial/pagination.php'; ?>

    </div>
</div>

<?php include __DIR__ . '/../partial/footer.php'; ?>