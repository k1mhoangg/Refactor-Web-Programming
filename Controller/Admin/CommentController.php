<?php

namespace Controller\Admin;

use Core\Pagination;
use Model\Comment;

class CommentController extends BaseAdminController
{
    public function index()
    {
        $perPage = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $total = Comment::count();
        $pagination = new Pagination($total, $perPage, $page);

        $comments = Comment::getAll($pagination->getLimit(), $pagination->getOffset());

        require_once BASE_PATH . "view/admin/comments/index.php";
    }

    public function approve($id)
    {
        $id = (int)$id;

        if ($id > 0) {
            Comment::approve($id);
        }

        header("Location: /admin/comments");
        exit;
    }

    public function reject($id)
    {
        $id = (int)$id;

        if ($id > 0) {
            Comment::reject($id);
        }

        header("Location: /admin/comments");
        exit;
    }

    // ✅ Delete nhận id từ router GET delete/123
    public function delete($id)
    {
        $id = (int)$id;

        if ($id > 0) {
            Comment::delete($id);
        }

        header("Location: /admin/comments");
        exit;
    }
}
