<?php
// news_detail.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($news['title']) ? htmlspecialchars($news['title']) : 'Chi tiết tin tức'; ?> | HomeDecor</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- HEADER -->
    <?php 
    if (defined('BASE_PATH')) {
        include BASE_PATH . '/components/header.php';
    } else {
        include '../components/header.php'; 
    }
    ?>

    <main class="flex-grow container mx-auto px-4 py-8 max-w-4xl">

        <!-- Flash message -->
        <?php if(!empty($_SESSION['flash'])): ?>
        <div class="mb-4 p-4 rounded <?= $_SESSION['flash']['type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
            <?= $_SESSION['flash']['message']; ?>
        </div>
        <?php unset($_SESSION['flash']); endif; ?>

        <div class="mb-6">
            <a href="/news" class="text-gray-600 hover:text-orange-500 transition-colors duration-300">
                <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại danh sách tin tức
            </a>
        </div>

        <?php if (!empty($news)): ?>
            <article class="bg-white rounded-lg shadow-sm overflow-hidden p-6 md:p-10">

                <header class="mb-8 border-b pb-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3 space-x-4">
                        <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded font-semibold text-xs uppercase">
                            Tin tức
                        </span>
                        <span>
                            <i class="fa-regular fa-calendar mr-1"></i> 
                            <?= date('d/m/Y', strtotime($news['created_at'])); ?>
                        </span>
                        <?php if(!empty($news['author'])): ?>
                        <span>
                            <i class="fa-regular fa-user mr-1"></i> 
                            <?= htmlspecialchars($news['author']); ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-200 leading-tight">
                        <?= htmlspecialchars($news['title']); ?>
                    </h1>
                </header>

                <?php if (!empty($news['image_url'])): ?>
                    <div class="mb-8">
                        <img src="<?= htmlspecialchars($news['image_url']); ?>" 
                             alt="<?= htmlspecialchars($news['title']); ?>" 
                             class="w-full h-auto object-cover rounded-lg shadow-md max-h-[500px]"
                             onerror="this.src='/public/images/no-image.jpg'">
                    </div>
                <?php endif; ?>

                <div class="prose max-w-none text-gray-700 leading-relaxed text-lg space-y-4">
                    <?= $news['content']; ?>
                </div>

                <!-- Tin liên quan -->
                <?php if (!empty($related)): ?>
                    <hr class="my-10 border-gray-200">
                    <h3 class="font-bold text-2xl mb-4">Tin liên quan</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <?php foreach ($related as $r): ?>
                            <li>
                                <a href="/news/<?= htmlspecialchars($r['slug']); ?>" class="text-gray-800 hover:text-orange-500">
                                    <?= htmlspecialchars($r['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- Comment Section -->
                <hr class="my-10 border-gray-200">
                <div class="mt-12">
                    <h3 class="font-bold text-2xl mb-4">Bình luận</h3>

                    <?php 
                    $comments = \Model\Comment::getByNewsId($news['id']); 
                    if(!empty($comments)):
                    ?>
                    <ul class="space-y-4 mb-8">
                        <?php foreach($comments as $c): ?>
                        <li class="p-4 bg-gray-50 rounded">
                            <div class="text-gray-700"><?= nl2br(htmlspecialchars($c['content'])); ?></div>
                            <div class="mt-2 text-sm text-gray-500">— <?= htmlspecialchars($c['name']); ?>, <?= date('d/m/Y H:i', strtotime($c['created_at'])); ?></div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php else: ?>
                        <p class="text-gray-500 mb-8">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                    <?php endif; ?>

                    <!-- Form Comment -->
                    <form action="/comment/add" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
                        <input type="hidden" name="news_id" value="<?= $news['id']; ?>">
                        <input type="hidden" name="slug" value="<?= $news['slug']; ?>">

                        <div>
                            <label class="block mb-1 font-semibold">Tên</label>
                            <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Email</label>
                            <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Nội dung</label>
                            <textarea name="content" required class="w-full border border-gray-300 rounded px-3 py-2" rows="5"></textarea>
                        </div>

                        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition">
                            Gửi bình luận
                        </button>
                    </form>

                </div>

            </article>
        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-lg shadow">
                <div class="text-6xl text-gray-300 mb-4"><i class="fa-regular fa-file-excel"></i></div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Không tìm thấy bài viết!</h2>
                <p class="text-gray-600 mb-6">Kiểm tra lại đường dẫn hoặc bài viết đã bị xóa.</p>
                <a href="/news" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">Về danh sách tin tức</a>
            </div>
        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <?php 
    if (defined('BASE_PATH')) {
        include BASE_PATH . '/components/footer.php';
    } else {
        include '../components/footer.php';
    }
    ?>

</body>
</html>
