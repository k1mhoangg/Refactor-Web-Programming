<?php

namespace Core;
class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            // tùy chỉnh cookie params nếu cần, ví dụ:
            // session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'httponly' => true]);
            session_start();
        }
    }

    public static function setFlash($type, $message)
    {
        self::start();
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    public static function getFlash()
    {
        self::start();
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}