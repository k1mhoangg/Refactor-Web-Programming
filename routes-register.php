<?php

$router->addRoute('GET', '/', function () {
    require_once BASE_PATH . 'view/home.php';
});
$router->addRoute('GET', '/contact', function () {
    require_once BASE_PATH . 'view/contact.php';
});

?>