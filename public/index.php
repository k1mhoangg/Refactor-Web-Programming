<?php
// Bootstrap: session, base path and autoloader must run before any output
session_start();

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . 'autoload.php';


// require optional utility functions
if (file_exists(BASE_PATH . 'Core/utils.php')) {
    require_once BASE_PATH . 'Core/utils.php';
}

// Instantiate router if available
$router = new \Core\Router(); // autoloader should handle this
// Register routes
require_once BASE_PATH . 'routes-register.php';

try {
    // $router->test();
    $router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (Error $e) {
    error_log('Router instance is not available: ' . $e->getMessage());
}


?>