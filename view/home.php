<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HomeDecor | Trang chủ</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Optional local CSS (kept) -->
  <link rel="stylesheet" href="/../assets/css/style.css" />

  <!-- Use official Tailwind CDN for utility classes -->
  <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>
  <!-- HEADER -->
  <?php include 'components/header.php'; ?>
  <!-- CAROUSEL -->
  <?php require('components/index/carousel.php'); ?>
  <!-- BANNER -->
  <?php require('components/index/banner.php'); ?>
  <!-- FEATURED CATEGORIES -->
  <?php require('components/index/feature.php'); ?>
  <!-- FOOTER -->
  <?php require('components/footer.php'); ?>


  <!-- HERO -->
  <!-- <section class="hero">
    <h1>Chào mừng đến với HomeDecor</h1>
    <p>Thiết kế - Trang trí - Thi công nội thất trọn gói</p>
  </section> -->

  <!-- <div style="height: 1500px;"></div> Test cuộn -->

  <script src="./assets/js/carousel.js"></script>

  <script src="assets/js/main.js"></script>
</body>

</html>