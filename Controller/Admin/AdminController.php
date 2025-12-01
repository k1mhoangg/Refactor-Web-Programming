<?php
namespace Controller\Admin;

use Core\Database;
use Model\User;
use Model\Contact;
use Model\Page;

class AdminController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        $countUsers = $countContacts = $countPages = 0;
        $recentUsers = [];
        $recentContacts = [];

        try {
            $db = Database::getInstance()->getConnection();

            $countUsers = (int) $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
            $countContacts = (int) $db->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
            // pages table may not exist yet — guard with try/catch
            try {
                $countPages = (int) $db->query("SELECT COUNT(*) FROM pages")->fetchColumn();
            } catch (\Throwable $e) {
                $countPages = 0;
            }

            $recentUsers = $db->query("SELECT id, username, display_name, email, role, created_at FROM users ORDER BY created_at DESC LIMIT 5")->fetchAll();
            $recentContacts = $db->query("SELECT id, name, email, subject, status, created_at FROM contacts ORDER BY created_at DESC LIMIT 5")->fetchAll();
        } catch (\Throwable $e) {
            error_log('AdminController::index DB error: ' . $e->getMessage());
            // keep defaults
        }

        // biến: $countUsers, $countContacts, $countPages, $recentUsers, $recentContacts
        require_once BASE_PATH . 'view/admin/dashboard.php';
    }

    public function listUsers()
    {
        // Logic to get users from the database

        $users = User::all(); // Giả sử lấy từ model User

        require_once BASE_PATH . 'view/admin/users.php';
    }

    public function listContacts()
    {
        // Logic to get contacts from the database
        $contacts = Contact::getAll(); // Giả sử lấy từ model Contact

        require_once BASE_PATH . 'view/admin/contacts.php';
    }
}