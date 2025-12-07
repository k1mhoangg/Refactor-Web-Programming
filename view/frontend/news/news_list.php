<?php require BASE_PATH . "/components/header.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ | HomeDecor</title>

    <!-- External stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>


<div style="max-width:1150px;margin:auto;padding:30px 0;">

    <h2 style="font-size:28px;font-weight:bold;margin-bottom:20px;">Tin tức</h2>

    <!-- SEARCH BOX -->
    <form method="GET" action="/news" style="margin-bottom:25px;display:flex;gap:10px;">
        <input 
            type="text" 
            name="q" 
            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
            placeholder="Tìm kiếm bài viết..."
            style="flex:1;padding:10px 15px;border:1px solid #ccc;border-radius:6px;"
        >
        <button type="submit" style="padding:10px 20px;background:#333;color:white;border:none;border-radius:6px;">
            Tìm kiếm
        </button>
    </form>

    <div style="display:flex;gap:30px;">

        <!-- LEFT LIST -->
        <div style="width:70%;">
            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">
                <?php foreach ($news as $item): ?>
                    <div style="border:1px solid #eee;border-radius:8px;overflow:hidden;">
                        <a href="/news/<?= $item['slug'] ?>">
                            <img src="<?= $item['image_url'] ?>" style="width:100%;height:180px;object-fit:cover;">
                        </a>

                        <div style="padding:15px;">
                            <a href="/news/<?= $item['slug'] ?>" style="font-size:18px;font-weight:bold;color:#333;">
                                <?= $item['title'] ?>
                            </a>

                            <p style="font-size:14px;color:#777;margin-top:8px;">
                                <?= $item['summary'] ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($news)): ?>
                    <p>⚠ Không tìm thấy bài viết nào.</p>
                <?php endif; ?>
            </div>

            <!-- PAGINATION -->
            <div style="margin-top:25px;text-align:center;">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="/news?page=<?= $i ?>&q=<?= urlencode($_GET['q'] ?? '') ?>"
                       style="padding:8px 14px;border:1px solid #333;margin:0 5px;
                              <?= $i == $page ? 'background:#333;color:#fff;' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>

        <!-- RIGHT HIGHLIGHT -->
        <div style="width:30%;">
            <h3 style="margin-bottom:10px;">Tin nổi bật</h3>
            <ul style="list-style:none;padding:0;">
                <?php foreach ($highlight as $h): ?>
                    <li style="margin-bottom:12px;">
                        <a href="/news/<?= $h['slug'] ?>" style="color:#333;">
                            • <?= $h['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>

<form method="GET" action="/news" class="mb-6 flex">
    <input type="text" name="q" placeholder="Tìm kiếm tin tức..." 
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" 
           class="flex-grow border border-gray-300 rounded-l px-4 py-2">
    <button type="submit" class="bg-orange-500 text-white px-4 rounded-r hover:bg-orange-600">
        Tìm
    </button>
</form>


<?php require BASE_PATH . "/components/footer.php"; ?>
