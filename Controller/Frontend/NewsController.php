<?php

namespace Controller\Frontend;

use Model\News; 
use Model\Comment;

class NewsController
{
    // Trang danh sách (/news)
    public function index()
    {
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

        // Phân trang
        $limit = 6;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $offset = ($page - 1) * $limit;

        // Gọi Model (Hàm mới đã sửa ở bước trước)
        $news = News::getPublished($limit, $offset, $keyword);
        
        $total = News::countPublished($keyword);
        $total_pages = ceil($total / $limit);

        $highlight = News::getHighlight(3);

        // Gọi View danh sách
        require BASE_PATH . "/view/frontend/news/news_list.php";
    }

    // Trang chi tiết (/news/{slug})
    public function detail($slug)
    {
        $slug = trim(strip_tags($slug));
        // 1. Gọi Model tìm bài viết
        $news = News::findBySlug($slug); 

        // 2. Kiểm tra 404
        if (!$news) {
            // Hiển thị giao diện 404 đơn giản hoặc load view 404 riêng
            require BASE_PATH . "/components/header.php";
            echo '<div class="container mx-auto py-20 text-center font-bold text-2xl">404 - Bài viết không tồn tại</div>';
            require BASE_PATH . "/components/footer.php";
            return;
        }

        // 3. Lấy tin liên quan
        $related = News::getRelated($slug, 4);

        // 4. Gọi View chi tiết (đường dẫn view phải chính xác với thư mục của bạn)
        // Đảm bảo file ở Bước 2 nằm đúng vị trí này:
        require BASE_PATH . "/view/frontend/news/news_detail.php";
    }
    public function addComment()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /");
        exit;
    }

    $news_id = $_POST['news_id'] ?? null;
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (!$news_id || $name === '' || $email === '' || $content === '') {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Vui lòng nhập đầy đủ thông tin!'
        ];
        header("Location: /news/" . $_POST['slug']);
        exit;
    }

    \Model\Comment::create([
        'news_id' => $news_id,
        'name' => $name,
        'email' => $email,
        'content' => $content
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Bình luận của bạn đã được gửi, đang chờ duyệt!'
    ];

    header("Location: /news/" . $_POST['slug']);
    exit;
}

}