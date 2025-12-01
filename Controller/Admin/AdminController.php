<?php
namespace Controller\Admin;

use Model\Contact;
use Model\User;

class AdminController
{
    public function index()
    {
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
        $contacts = []; // Giả sử lấy từ model Contact

        require_once BASE_PATH . 'view/admin/contacts.php';
    }
}