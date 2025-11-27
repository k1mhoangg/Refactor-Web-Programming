<?php
// Bootstrap: session, base path and autoloader must run before any output
session_start();

const BASE_PATH = __DIR__ . '/';

require_once BASE_PATH . 'autoload.php';


// require optional utility functions
if (file_exists(BASE_PATH . 'Core/utils.php')) {
    require_once BASE_PATH . 'Core/utils.php';
}


$BASE_URL = getBaseUrl();

/**
 * Normalize URI for routing
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

pprint($uri);

// Remove folder prefix for Apache
if ($BASE_URL !== '' && $BASE_URL !== '/') {
    $uri = preg_replace('#^' . $BASE_URL . '#', '', $uri);
}

// Normalize empty uri
if ($uri === '' || $uri === false) {
    $uri = '/';
}

$router = new \Core\Router(); // autoloader handle
require_once BASE_PATH . 'routes-register.php';

try {
    pprint($uri);
    $router->dispatch($_SERVER['REQUEST_METHOD'], $uri);

} catch (Error $e) {
    error_log('Router instance is not available: ' . $e->getMessage());
}


?>