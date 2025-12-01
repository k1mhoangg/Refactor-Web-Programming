<?php

namespace Controller\Frontend;

use Model\User;

class AuthController
{
    public function test()
    {
        echo "<div>AuthController from CONTROLLER.</div>";
    }
    public function index()
    {
        // ...existing behavior (auth-test)...
        echo "<div>Please give the class method a proper name.</div>";
    }

    // Hiển thị form đăng ký
    public function registerForm()
    {
        require_once BASE_PATH . 'view/frontend/auth/register.php';
    }

    // Xử lý POST đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        // sanitize
        $username = sanitizeInput($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $password_confirm = trim($_POST['password_confirm'] ?? '');

        if ($username === '' || $password === '') {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Vui lòng nhập username và password.'];
            header('Location: /register');
            exit;
        }

        if ($password !== $password_confirm) {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Xác nhận mật khẩu không khớp.'];
            header('Location: /register');
            exit;
        }

        try {
            $user = new User($username, $password, 'customer');
            $user->save();
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Đăng ký thành công. Vui lòng đăng nhập.'];
            header('Location: /login');
            exit;
        } catch (\Exception $e) {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Đăng ký thất bại: ' . $e->getMessage()];
            header('Location: /register');
            exit;
        }
    }

    // Hiển thị form đăng nhập
    public function loginForm()
    {
        require_once BASE_PATH . 'view/frontend/auth/login.php';
    }

    // Xử lý POST đăng nhập
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $username = sanitizeInput($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Vui lòng nhập username và password.'];
            header('Location: /login');
            exit;
        }

        $user = User::findByUsername($username);
        if (!$user || !$user->verifyPassword($password)) {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.'];
            header('Location: /login');
            exit;
        }

        // set session user
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'role' => $user->getRole()
        ];
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Đăng nhập thành công.'];

        header('Location: /');
        exit;
    }

    // Logout
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        unset($_SESSION['user']);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Bạn đã đăng xuất.'];
        header('Location: /');
        exit;
    }
}