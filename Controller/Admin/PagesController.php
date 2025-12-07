<?php
namespace Controller\Admin;

use Model\Page;
use Core\Session;
use Core\Pagination;

class PagesController extends BaseAdminController
{
    public function index()
    {
        $perPage = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $total = Page::count();
        $pagination = new Pagination($total, $perPage, $page);

        $pages = Page::all($pagination->getLimit(), $pagination->getOffset());

        require_once BASE_PATH . 'view/admin/pages.php';
    }

    public function edit()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $page = $id ? Page::findById($id) : null;
        require_once BASE_PATH . 'view/admin/page_edit.php';
    }

    public function save()
    {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $slug = trim($_POST['slug'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $content = $_POST['content'] ?? '';
        $meta = $_POST['meta'] ?? null;

        if ($id) {
            $ok = Page::updateById($id, ['slug' => $slug, 'title' => $title, 'content' => $content, 'meta' => $meta]);
            Session::setFlash($ok ? 'success' : 'error', $ok ? 'Cập nhật trang thành công.' : 'Cập nhật thất bại.');
            header('Location: /admin/pages');
            exit;
        } else {
            $ok = Page::create(['slug' => $slug, 'title' => $title, 'content' => $content, 'meta' => $meta]);
            Session::setFlash($ok ? 'success' : 'error', $ok ? 'Tạo trang thành công.' : 'Tạo thất bại.');
            header('Location: /admin/pages');
            exit;
        }
    }

    public function delete()
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id && Page::deleteById($id)) {
            Session::setFlash('success', 'Xóa trang thành công.');
        } else {
            Session::setFlash('error', 'Xóa trang thất bại.');
        }
        header('Location: /admin/pages');
        exit;
    }
}
