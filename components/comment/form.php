<?php if (!empty($_SESSION['comment_message'])): ?>
    <div class="p-4 bg-green-100 text-green-700 rounded mb-4">
        <?= $_SESSION['comment_message']; unset($_SESSION['comment_message']); ?>
    </div>
<?php endif; ?>

<h3 class="text-xl font-bold mb-4">Bình luận</h3>

<!-- Form comment -->
<form action="/news/<?= $news['slug'] ?>" method="POST" class="space-y-4 mb-10">
    <input type="text" name="name" placeholder="Tên của bạn" class="w-full p-3 border rounded">
    <input type="email" name="email" placeholder="Email" class="w-full p-3 border rounded">
    <textarea name="content" placeholder="Nội dung bình luận" class="w-full p-3 border rounded h-32"></textarea>
    <button class="px-5 py-2 bg-blue-600 text-white rounded">Gửi bình luận</button>
</form>

<!-- Danh sách bình luận -->
<div class="space-y-6">
    <?php foreach ($comments as $c): ?>
        <div class="p-4 border rounded bg-gray-50">
            <div class="font-bold text-blue-600"><?= htmlspecialchars($c['name']) ?></div>
            <div class="text-sm text-gray-500"><?= $c['created_at'] ?></div>
            <div class="mt-2"><?= nl2br(htmlspecialchars($c['content'])) ?></div>
        </div>
    <?php endforeach; ?>
</div>
