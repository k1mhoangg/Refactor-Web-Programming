<?php

namespace Controller\Admin;

use Core\Database;
use Core\Pagination;
use Model\News;

class NewsAdminController extends BaseAdminController
{
    public function index()
    {
        $perPage = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $keyword = $_GET['keyword'] ?? '';

        // Đếm bài viết có keyword
        $total = News::countPublished($keyword); // dùng hàm countPublished có search
        $pagination = new Pagination($total, $perPage, $page);

        $newsList = News::getPublished($pagination->getLimit(), $pagination->getOffset(), $keyword);

        require_once BASE_PATH . "view/admin/news/index.php";
    }

    public function create()
    {
        require_once BASE_PATH . "view/admin/news/create.php";
    }

    public function store()
    {
        $title = trim($_POST['title']);
        if (empty($title)) {
            $_SESSION['error'] = "Vui lòng nhập tiêu đề!";
            header("Location: /admin/news/create");
            exit;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO news (title, slug, summary, content, image_url, is_published)
            VALUES (:title, :slug, :summary, :content, :image_url, :is_published)
        ");

        $stmt->execute([
            ':title' => $title,
            ':slug' => strtolower(preg_replace('/[^a-z0-9]+/i', '-', $title)),
            ':summary' => $_POST['summary'] ?? "",
            ':content' => $_POST['content'] ?? "",
            ':image_url' => $_POST['image_url'] ?? "",
            ':is_published' => isset($_POST['is_published']) ? 1 : 0
        ]);

        header("Location: /admin/news");
        exit;
    }

    // ĐÃ SỬA: Bỏ tham số $id, lấy id từ $_GET
    public function edit()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $news = News::findById($id);
        if (!$news) {
            // Có thể redirect về trang list hoặc báo lỗi
            $_SESSION['error'] = "Bài viết không tồn tại!";
            header("Location: /admin/news");
            exit;
        }

        require_once BASE_PATH . "view/admin/news/edit.php";
    }


    // ĐÃ SỬA: Bỏ tham số $id, lấy id từ query string URL (action form)
    public function update()
    {
        // Lấy ID từ URL (vì form action sẽ là .../update?id=...)
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if (!$id) {
             die("Thiếu ID bài viết cần sửa!");
        }

        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("
            UPDATE news
            SET title = :title,
                summary = :summary,
                content = :content,
                image_url = :image_url,
                is_published = :is_published
            WHERE id = :id
        ");

        $stmt->execute([
            ':title' => $_POST['title'],
            ':summary' => $_POST['summary'],
            ':content' => $_POST['content'],
            ':image_url' => $_POST['image_url'],
            ':is_published' => isset($_POST['is_published']) ? 1 : 0,
            ':id' => $id
        ]);

        header("Location: /admin/news");
        exit;
    }

    // ĐÃ SỬA: Lấy id từ $_POST hoặc $_GET tùy cách bạn gửi form
    public function delete()
    {
        // Ưu tiên lấy từ POST (nếu dùng form ẩn), nếu không thì lấy GET
        $id = $_POST['id'] ?? ($_GET['id'] ?? 0);
        
        if ($id) {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE FROM news WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }

        header("Location: /admin/news");
        exit;
    }
}