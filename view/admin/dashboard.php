<?php include __DIR__ . '/partial/header.php'; ?>

<?php
// $countUsers, $countContacts, $countPages, $recentUsers, $recentContacts
// are provided by Controller\Admin\AdminController::index()
if (session_status() === PHP_SESSION_NONE)
    session_start();
$currentUser = $_SESSION['user']['username'] ?? 'Admin';
?>

<!-- Admin top navbar (Tabler) -->
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <a class="navbar-brand" href="/admin">
            <img src="/favicon.ico" alt="logo" style="width:20px;height:20px;object-fit:contain" class="me-2">
            <span class="navbar-brand-name">HomeDecor Admin</span>
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <form class="d-none d-md-flex" action="/admin/search" method="GET">
                <div class="input-icon">
                    <input type="text" name="q" class="form-control" placeholder="Tìm kiếm..." />
                </div>
            </form>

            <div class="dropdown">
                <a href="#" class="btn btn-outline-secondary d-flex align-items-center" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="me-2"><?php echo htmlspecialchars($currentUser); ?></span>
                    <span class="avatar avatar-sm"
                        style="background:#666;color:#fff;border-radius:6px;padding:6px 8px;"><?php echo strtoupper(substr($currentUser, 0, 1)); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/profile">Hồ sơ</a>
                    <a class="dropdown-item" href="/admin/settings">Cài đặt</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="/logout">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main dashboard content -->
<main class="page-main">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-4">
            <div class="col">
                <h2 class="page-title">Bảng điều khiển</h2>
                <div class="text-muted">Tổng quan hệ thống</div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="/admin/users" class="btn btn-primary">Quản lý người dùng</a>
                    <a href="/admin/contacts" class="btn btn-outline-secondary">Yêu cầu liên hệ</a>
                    <a href="/admin/pages" class="btn btn-outline-secondary">Quản lý Pages</a>
                </div>
            </div>
        </div>

        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-blue-lt me-3"><i class="ti ti-users"></i></span>
                            <div>
                                <h3 class="m-0"><?php echo htmlspecialchars($countUsers ?? 0); ?></h3>
                                <div class="text-muted">Tổng người dùng</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-green-lt me-3"><i class="ti ti-mail"></i></span>
                            <div>
                                <h3 class="m-0"><?php echo htmlspecialchars($countContacts ?? 0); ?></h3>
                                <div class="text-muted">Yêu cầu liên hệ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-yellow-lt me-3"><i class="ti ti-file-text"></i></span>
                            <div>
                                <h3 class="m-0"><?php echo htmlspecialchars($countPages ?? 0); ?></h3>
                                <div class="text-muted">Pages</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-red-lt me-3"><i class="ti ti-activity"></i></span>
                            <div>
                                <h3 class="m-0">—</h3>
                                <div class="text-muted">Hoạt động gần đây</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Người dùng mới</h3>
                        <div class="card-actions">
                            <a href="/admin/users" class="btn btn-sm">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-small mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Ngày</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentUsers)):
                                        foreach ($recentUsers as $u): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($u['id']); ?></td>
                                                <td><?php echo htmlspecialchars($u['username']); ?></td>
                                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                                <td><?php echo htmlspecialchars($u['role']); ?></td>
                                                <td><?php echo htmlspecialchars($u['created_at'] ?? ''); ?></td>
                                            </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="5" class="text-muted">Không có dữ liệu</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Liên hệ mới</h3>
                        <div class="card-actions">
                            <a href="/admin/contacts" class="btn btn-sm">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-small mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Ngày</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentContacts)):
                                        foreach ($recentContacts as $c): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($c['id']); ?></td>
                                                <td><?php echo htmlspecialchars($c['name']); ?></td>
                                                <td><?php echo htmlspecialchars($c['email']); ?></td>
                                                <td><?php echo htmlspecialchars($c['subject'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($c['created_at'] ?? ''); ?></td>
                                            </tr>
                                        <?php endforeach; else: ?>
                                        <tr>
                                            <td colspan="5" class="text-muted">Không có dữ liệu</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

<?php include __DIR__ . '/partial/footer.php'; ?>