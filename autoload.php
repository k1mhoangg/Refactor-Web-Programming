<?php
// Dynamic PSR-4 autoloader cho Core, Controller, Model
spl_autoload_register(function (string $class) {
    // Định nghĩa các namespace mappings
    $namespaces = [
        'Core\\' => BASE_PATH . 'Core/',
        'Controller\\' => BASE_PATH . 'Controller/',
        'Model\\' => BASE_PATH . 'Model/',
    ];

    // Duyệt qua từng namespace để tìm match
    foreach ($namespaces as $prefix => $base_dir) {
        $len = strlen($prefix);

        // Kiểm tra class có bắt đầu với prefix không
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Lấy phần relative class name
        $relative_class = substr($class, $len);

        // Build file path
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Nếu file tồn tại thì require
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});