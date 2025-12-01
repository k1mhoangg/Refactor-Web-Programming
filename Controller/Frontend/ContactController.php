<?php

namespace Controller\Frontend;

use Model\Contact;
class ContactController
{
    public function index()
    {
        require_once BASE_PATH . 'view/frontend/contact.php';
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = sanitizeInput($_POST['name'] ?? '');
            $email = sanitizeInput($_POST['email'] ?? '');
            $message = sanitizeInput($_POST['message'] ?? '');

            $contact = new Contact($name, $email, $message);
            if ($contact->save()) {
                if (session_status() === PHP_SESSION_NONE)
                    session_start();
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Contact information saved successfully.'];
            } else {
                if (session_status() === PHP_SESSION_NONE)
                    session_start();
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Failed to save contact information.'];
            }

            header('Location: /contact');
            exit;
        }
    }
}