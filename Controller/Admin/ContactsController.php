<?php
namespace Controller\Admin;

use Model\Contact;
use Core\Session;
use Core\Pagination;

class ContactsController extends BaseAdminController
{
    public function index()
    {
        $perPage = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $total = Contact::count();
        $pagination = new Pagination($total, $perPage, $page);

        $contacts = Contact::getAll('created_at DESC', $pagination->getLimit(), $pagination->getOffset());

        require_once BASE_PATH . 'view/admin/contacts.php';
    }

    public function view()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $contact = Contact::findById($id);
        if (!$contact) {
            Session::setFlash('error', 'Liên hệ không tồn tại.');
            header('Location: /admin/contacts');
            exit;
        }
        require_once BASE_PATH . 'view/admin/contact_view.php';
    }

    public function updateStatus()
    {
        $id = (int) ($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        if ($id && in_array($status, ['pending', 'replied', 'closed', 'read', 'unread'])) {
            Contact::updateStatus($id, $status);
            Session::setFlash('success', 'Cập nhật trạng thái thành công.');
        } else {
            Session::setFlash('error', 'Dữ liệu không hợp lệ.');
        }
        header('Location: /admin/contacts');
        exit;
    }

    public function delete()
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id && Contact::deleteById($id)) {
            Session::setFlash('success', 'Xóa liên hệ thành công.');
        } else {
            Session::setFlash('error', 'Xóa thất bại.');
        }
        header('Location: /admin/contacts');
        exit;
    }
}
