<?php
// Simple PSR-4-ish autoloader for the "Core\" namespace -> BASE_PATH . 'Core/'
spl_autoload_register(function (string $class) {
    $prefix = 'Core\\';
    $base_dir = BASE_PATH . 'Core/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // not a Core class — let other autoloaders handle it
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});