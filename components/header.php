<!-- components/header.php -->
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_user = $_SESSION['user'] ?? null;
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>
<header class="bg-gray-900 text-white shadow-md sticky top-0 z-50">
  <div class="w-full flex items-center justify-between py-3 px-4 md:px-10">
    <!-- Logo sát trái -->
    <div class="flex items-center gap-2">
      <img src="/favicon.ico" alt="HomeDecor Logo" class="w-8 h-8 object-contain">
      <span class="font-bold text-yellow-400 text-xl whitespace-nowrap">HomeDecor</span>
    </div>

    <!-- Nav links: nằm ngang, canh giữa -->
    <nav class="hidden md:flex flex-1 justify-center gap-6 font-medium whitespace-nowrap">
      <a href="/" class="<?= ($current_path === '/' || $current_path === '') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Trang chủ</a>
      <a href="/about" class="<?= ($current_path === '/about') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Giới thiệu</a>
      <a href="/services" class="<?= ($current_path === '/services') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Dịch vụ</a>
      <a href="/pricing" class="<?= ($current_path === '/pricing') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Bảng giá</a>
      <a href="/contact" class="<?= ($current_path === '/contact') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Liên hệ</a>
      <a href="/faq" class="<?= ($current_path === '/faq') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Hỏi đáp</a>
      <a href="/news" class="<?= ($current_path === '/news') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Tin tức</a>
    </nav>

    <!-- Right side -->
    <div class="flex items-center gap-4 flex-shrink-0">
      <div class="relative">
        <input type="text" placeholder="Tìm kiếm..." class="pl-10 pr-3 py-1 rounded-md bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
      </div>

      <?php if ($current_user): ?>
        <div class="flex items-center gap-2">
          <span class="text-gray-200">Xin chào, <span class="font-semibold"><?= htmlspecialchars($current_user['username']); ?></span></span>
          <a href="/profile" class="hover:text-yellow-400"><i class="fa-regular fa-user"></i></a>
          <a href="/logout" class="hover:text-yellow-400"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
      <?php else: ?>
        <div class="flex items-center gap-2">
          <a href="/login" class="hover:text-yellow-400"><i class="fa-regular fa-user"></i></a>
          <a href="/register" class="hover:text-yellow-400 font-medium">Đăng ký</a>
        </div>
      <?php endif; ?>

      <a href="/cart" class="hover:text-yellow-400 relative">
        <i class="fa-solid fa-cart-shopping"></i>
      </a>
    </div>

    <!-- Mobile menu button -->
    <button class="md:hidden ml-2 text-gray-300 focus:outline-none" id="mobile-menu-btn">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <!-- Mobile menu -->
  <div class="md:hidden hidden" id="mobile-menu">
    <nav class="flex flex-col bg-gray-800 px-4 py-3 gap-2">
      <a href="/" class="<?= ($current_path === '/' || $current_path === '') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Trang chủ</a>
      <a href="/about" class="<?= ($current_path === '/about') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Giới thiệu</a>
      <a href="/services" class="<?= ($current_path === '/services') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Dịch vụ</a>
      <a href="/pricing" class="<?= ($current_path === '/pricing') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Bảng giá</a>
      <a href="/contact" class="<?= ($current_path === '/contact') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Liên hệ</a>
      <a href="/faq" class="<?= ($current_path === '/faq') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Hỏi đáp</a>
      <a href="/news" class="<?= ($current_path === '/news') ? 'text-yellow-400' : 'hover:text-yellow-400' ?>">Tin tức</a>
    </nav>
  </div>

  <script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</header>
