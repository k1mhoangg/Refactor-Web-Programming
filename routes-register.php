<?php

// Frontend routes (controller namespace: Controller\Frontend)
$router->addRoute('GET', '/', 'Frontend/HomeController');
$router->addRoute('GET', '/contact', 'Frontend/ContactController');
$router->addRoute('POST', '/contact', 'Frontend/ContactController@submit');

// Profile routes (chỉ customer hoặc admin) -> Controller\Frontend\UserController
$router->addRoute('GET', '/profile', 'Frontend/UserController@edit')->assignUser('customer');
$router->addRoute('POST', '/profile', 'Frontend/UserController@update')->assignUser('customer');
$router->addRoute('POST', '/profile/password', 'Frontend/UserController@changePassword')->assignUser('customer');

// Auth / user routes (Controller\Frontend\AuthController)
$router->addRoute('GET', '/register', 'Frontend/AuthController@registerForm')->assignUser('guest');
$router->addRoute('POST', '/register', 'Frontend/AuthController@register')->assignUser('guest');

$router->addRoute('GET', '/login', 'Frontend/AuthController@loginForm')->assignUser('guest');
$router->addRoute('POST', '/login', 'Frontend/AuthController@login')->assignUser('guest');

// Logout requires authenticated user (customer or admin)
$router->addRoute('GET', '/logout', 'Frontend/AuthController@logout')->assignUser('customer');

// Admin routes (expected namespace: Controller\Admin)
$router->addRoute('GET', '/admin', 'Admin/AdminController@index')->assignUser('admin');
$router->addRoute('GET', '/admin/users', 'Admin/AdminController@listUsers')->assignUser('admin');
$router->addRoute('GET', '/admin/contacts', 'Admin/AdminController@listContacts')->assignUser('admin');
