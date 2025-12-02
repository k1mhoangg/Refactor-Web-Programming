<?php
// Lấy current user từ session (nếu chưa có biến $currentUser)
if (!isset($currentUser)) {
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    $currentUser = $_SESSION['user']['username'] ?? 'Admin';
}
?>
<!-- Admin top navbar (Tabler) -->
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
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
                    <a class="dropdown-item text-danger" href="/admin/logout">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
</header>