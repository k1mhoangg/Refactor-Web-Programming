<?php
namespace Controller\Admin;

use Model\User;
use Model\Contact;
use Model\Page;
use Core\Pagination;

class AdminController extends BaseAdminController
{
    public function index()
    {
        // BaseAdminController::__construct đã đảm bảo session và quyền admin
        $users = User::all();              // trả về mảng User objects
        $contacts = Contact::getAll();     // trả về mảng assoc
        $pages = Page::all();              // trả về mảng assoc

        $countUsers = User::count();
        $countContacts = Contact::count();

        try {
            $countPages = Page::count();
        } catch (\Throwable $e) {
            $countPages = 0;
        }

        // Lấy users mới nhất (có created_at)
        $recentUsers = User::recent(5);

        // Lấy contacts mới nhất
        $recentContacts = Contact::recent(5);

        // Biến truyền vào view: $countUsers, $countContacts, $countPages, $recentUsers, $recentContacts
        require_once BASE_PATH . 'view/admin/dashboard.php';
    }

    public function listUsers()
    {
        $perPage = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $total = User::count();
        $pagination = new Pagination($total, $perPage, $page);

        $users = User::all($pagination->getLimit(), $pagination->getOffset());

        require_once BASE_PATH . 'view/admin/users.php';
    }

    public function listContacts()
    {
        // Logic to get contacts from the database
        $contacts = Contact::getAll(); // Giả sử lấy từ model Contact

        require_once BASE_PATH . 'view/admin/contacts.php';
    }
}