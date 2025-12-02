<!-- components/header.php -->
<?php
if (session_status() === PHP_SESSION_NONE)
  session_start();
$current_user = $_SESSION['user'] ?? null;
$current_uri = $_SERVER['REQUEST_URI'];
$current_path = parse_url($current_uri, PHP_URL_PATH);
?>
<header class="header">
  <div class="container">
    <div class="logo flex items-center gap-2">
      <img src="/favicon.ico" alt="HomeDecor Logo" class="w-5 h-5 object-contain">
      <span class="font-bold text-yellow-400">HomeDecor</span>
    </div>

    <nav class="main-nav">
      <a href="/" class="<?php echo ($current_path === '/' || $current_path === '') ? 'active' : ''; ?>">Trang chủ</a>
      <a href="/about" class="<?php echo ($current_path === '/about') ? 'active' : ''; ?>">Giới thiệu</a>
      <a href="/services" class="<?php echo ($current_path === '/services') ? 'active' : ''; ?>">Dịch vụ</a>
      <a href="/pricing" class="<?php echo ($current_path === '/pricing') ? 'active' : ''; ?>">Bảng giá</a>
      <a href="/contact" class="<?php echo ($current_path === '/contact') ? 'active' : ''; ?>">Liên hệ</a>
      <a href="/faq" class="<?php echo ($current_path === '/faq') ? 'active' : ''; ?>">Hỏi đáp</a>
      <a href="/news" class="<?php echo ($current_path === '/news') ? 'active' : ''; ?>">Tin tức</a>
    </nav>
    <div class="others">
      <input type="text" placeholder="Tìm kiếm..." />
      <i class="fas fa-search"></i>
      <?php if ($current_user): ?>
        <span class="text-white mr-2">Xin chào, <?php echo htmlspecialchars($current_user['username']); ?></span>
        <a href="/profile"><i class="fa-regular fa-user text-white"></i></a>
        <a href="/logout" class="text-white"><i class="fa-solid fa-right-from-bracket"></i></a>
      <?php else: ?>
        <a href="/login"><i class="fa-regular fa-user text-white"></i></a>
        <a href="/register" class="ml-2 text-white">Đăng ký</a>
      <?php endif; ?>
      <a href="/cart"><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
  </div>
</header>