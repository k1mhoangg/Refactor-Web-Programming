<!-- components/header.php -->
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header class="header">
  <div class="container">
    <div class="logo">🏡 <span>HomeDecor</span></div>
    <nav class="main-nav">
      <a href="index.php" <?php echo ($current_page == 'index.php') ? 'class="active"' : ''; ?>>Trang chủ</a>
      <a href="about.php" <?php echo ($current_page == 'about.php') ? 'class="active"' : ''; ?>>Giới thiệu</a>
      <a href="services.php" <?php echo ($current_page == 'services.php') ? 'class="active"' : ''; ?>>Dịch vụ</a>
      <a href="pricing.php" <?php echo ($current_page == 'pricing.php') ? 'class="active"' : ''; ?>>Bảng giá</a>
      <a href="contact.php" <?php echo ($current_page == 'contact.php') ? 'class="active"' : ''; ?>>Liên hệ</a>
      <a href="faq.php" <?php echo ($current_page == 'faq.php') ? 'class="active"' : ''; ?>>Hỏi đáp</a>
      <a href="news.php" <?php echo ($current_page == 'news.php') ? 'class="active"' : ''; ?>>Tin tức</a>
    </nav>
    <div class="others">
      <input type="text" placeholder="Tìm kiếm..." />
      <i class="fas fa-search"></i>
      <a href="login.php"><i class="fa-regular fa-user"></i></a>
      <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
  </div>
</header>
