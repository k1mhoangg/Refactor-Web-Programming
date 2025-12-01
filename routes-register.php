<?php

// Frontend routes (controller namespace: Controller\Frontend)
$router->addRoute('GET', '/', 'Frontend/HomeController');
$router->addRoute('GET', '/contact', 'Frontend/ContactController');
$router->addRoute('POST', '/contact', 'Frontend/ContactController@submit');

// Profile routes (chỉ customer hoặc admin) -> Controller\Frontend\UserController
$router->addRoute('GET', '/profile', 'Frontend/UserController@edit');
$router->addRoute('POST', '/profile', 'Frontend/UserController@update');
$router->addRoute('POST', '/profile/password', 'Frontend/UserController@changePassword');

// Auth / user routes (Controller\Frontend\AuthController)
$router->addRoute('GET', '/register', 'Frontend/AuthController@registerForm');
$router->addRoute('POST', '/register', 'Frontend/AuthController@register');

$router->addRoute('GET', '/login', 'Frontend/AuthController@loginForm');
$router->addRoute('POST', '/login', 'Frontend/AuthController@login');
// Logout requires authenticated user (customer or admin)
$router->addRoute('GET', '/logout', 'Frontend/AuthController@logout');

// Admin routes (expected namespace: Controller\Admin)
$router->addRoute('GET', '/admin', 'Admin/AdminController@index');
$router->addRoute('GET', '/admin/users', 'Admin/AdminController@listUsers');

// Contacts management
$router->addRoute('GET', '/admin/contacts', 'Admin/ContactsController@index');
$router->addRoute('GET', '/admin/contacts/view', 'Admin/ContactsController@view'); // ?id=
$router->addRoute('POST', '/admin/contacts/status', 'Admin/ContactsController@updateStatus');
$router->addRoute('POST', '/admin/contacts/delete', 'Admin/ContactsController@delete');

// Pages/content management
$router->addRoute('GET', '/admin/pages', 'Admin/PagesController@index');
$router->addRoute('GET', '/admin/pages/edit', 'Admin/PagesController@edit');
$router->addRoute('POST', '/admin/pages/save', 'Admin/PagesController@save');
$router->addRoute('POST', '/admin/pages/delete', 'Admin/PagesController@delete');