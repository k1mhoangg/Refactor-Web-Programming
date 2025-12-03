<?php

/**
 * FRONTEND ROUTES
 * PLEASE ADD YOUR FRONTEND ROUTES HERE
 */
// Frontend routes (controller namespace: Controller\Frontend)
$router->addRoute('GET', '/', 'Frontend/HomeController');
$router->addRoute('GET', '/contact', 'Frontend/ContactController');
$router->addRoute('POST', '/contact', 'Frontend/ContactController@submit');

$router->addRoute('GET', '/about', 'Frontend/AboutController');
$router->addRoute('GET', '/faq', 'Frontend/FaqController');
$router->addRoute('POST', '/faq', 'Frontend/FaqController@submit');

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



/**
 * ADMIN ROUTES
 * PLEASE ADD YOUR ADMIN ROUTES HERE
 */
// Admin login/logout
$router->addRoute('GET', '/admin/login', 'Admin/AuthController@loginForm');
$router->addRoute('POST', '/admin/login', 'Admin/AuthController@login');
$router->addRoute('GET', '/admin/logout', 'Admin/AuthController@logout');

// Admin routes (Controller\Admin)
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

// Admin product management
$router->addRoute('GET', '/admin/products', 'Admin/ProductsController@index');
$router->addRoute('GET', '/admin/products/edit', 'Admin/ProductsController@edit'); // ?id=
$router->addRoute('POST', '/admin/products/save', 'Admin/ProductsController@save');
$router->addRoute('POST', '/admin/products/delete', 'Admin/ProductsController@delete');

// Admin profile
$router->addRoute('GET', '/admin/profile', 'Admin/ProfileController@edit');
$router->addRoute('POST', '/admin/profile', 'Admin/ProfileController@update');
$router->addRoute('POST', '/admin/profile/password', 'Admin/ProfileController@changePassword');

