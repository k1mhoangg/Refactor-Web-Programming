<?php

$router->addRoute('GET', '/', function () {
    require_once BASE_PATH . 'home.php';
});
$router->addRoute('GET', '/contact', function () {
    require_once BASE_PATH . 'contact.php';
});

?>