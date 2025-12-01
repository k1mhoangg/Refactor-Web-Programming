<!-- components/header.php -->
<?php
if (session_status() === PHP_SESSION_NONE)
  session_start();
$current_user = $_SESSION['user'] ?? null;
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header class="header">
  <div class="container">
    <div class="logo flex items-center gap-2">
      <img src="/favicon.ico" alt="HomeDecor Logo" class="w-5 h-5 object-contain">
      <span class=" font-bold text-yellow-400">HomeDecor</span>
    </div>

    <nav class="main-nav">
      <a href="/" <?php echo ($current_page == 'index.php') ? 'class="active"' : ''; ?>>Trang chủ</a>
      <a href="/about" <?php echo ($current_page == 'about.php') ? 'class="active"' : ''; ?>>Giới thiệu</a>
      <a href="/services" <?php echo ($current_page == 'services.php') ? 'class="active"' : ''; ?>>Dịch vụ</a>
      <a href="/pricing" <?php echo ($current_page == 'pricing.php') ? 'class="active"' : ''; ?>>Bảng giá</a>
      <a href="/contact" <?php echo ($current_page == 'contact.php') ? 'class="active"' : ''; ?>>Liên hệ</a>
      <a href="faq.php" <?php echo ($current_page == 'faq.php') ? 'class="active"' : ''; ?>>Hỏi đáp</a>
      <a href="news.php" <?php echo ($current_page == 'news.php') ? 'class="active"' : ''; ?>>Tin tức</a>
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
      <a href="/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
  </div>
</header>