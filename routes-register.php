<?php

/**
 * FRONTEND ROUTES
 * PLEASE ADD YOUR FRONTEND ROUTES HERE
 */
// Frontend routes (controller namespace: Controller\Frontend)
$router->addRoute('GET', '/', 'Frontend/HomeController');
$router->addRoute('GET', '/contact', 'Frontend/ContactController');
$router->addRoute('GET', '/pricing', 'Frontend/PricingController@index');
$router->addRoute('GET', '/product/{id}', 'Frontend/ProductController@detail');
$router->addRoute('GET', '/cart', 'Frontend/CartController@view');
$router->addRoute('POST', '/cart/add', 'Frontend/CartController@add');
$router->addRoute('POST', '/contact', 'Frontend/ContactController@submit');
$router->addRoute('POST', '/cart/checkout', 'Frontend/CartController@checkout');


$router->addRoute('GET', '/about', 'Frontend/AboutController');

$router->addRoute('GET', '/faq', 'Frontend/FaqController');
$router->addRoute('POST', '/faq', 'Frontend/FaqController@submit');
$router->addRoute('GET', '/search', 'Frontend/ProductController@search');

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


// Admin about management
$router->addRoute('GET', '/admin/about', 'Admin/AboutController@index');
$router->addRoute('GET', '/admin/about/decor/create', 'Admin/AboutController@createDecor');
$router->addRoute('GET', '/admin/about/decor/edit', 'Admin/AboutController@editDecor');
$router->addRoute('GET', '/admin/about/advantages/create', 'Admin/AboutController@createAdvantage');
$router->addRoute('GET', '/admin/about/advantages/edit', 'Admin/AboutController@editAdvantage');
$router->addRoute('POST', '/admin/about/save-settings', 'Admin/AboutController@saveSettings');
$router->addRoute('POST', '/admin/about/save-decor-image', 'Admin/AboutController@saveDecorImage');
$router->addRoute('POST', '/admin/about/delete-decor-image', 'Admin/AboutController@deleteDecorImage');
$router->addRoute('POST', '/admin/about/save-advantage', 'Admin/AboutController@saveAdvantage');
$router->addRoute('POST', '/admin/about/delete-advantage', 'Admin/AboutController@deleteAdvantage');

// Admin FAQ management
$router->addRoute('GET', '/admin/faqs', 'Admin/FaqsController@index');
$router->addRoute('GET', '/admin/faqs/edit', 'Admin/FaqsController@edit');
$router->addRoute('POST', '/admin/faqs/save', 'Admin/FaqsController@save');
$router->addRoute('POST', '/admin/faqs/publish', 'Admin/FaqsController@publish');
$router->addRoute('POST', '/admin/faqs/unpublish', 'Admin/FaqsController@unpublish');
$router->addRoute('POST', '/admin/faqs/delete', 'Admin/FaqsController@delete');

// Admin order management
$router->addRoute('GET', '/admin/orders', 'Admin/OrdersController@listOrders');
$router->addRoute('GET', '/admin/orders/view', 'Admin/OrdersController@viewOrder');
$router->addRoute('POST', '/admin/orders/confirm', 'Admin/OrdersController@confirmOrder');
$router->addRoute('POST', '/admin/orders/delete', 'Admin/OrdersController@deleteOrder');

$router->addRoute('GET', '/admin/products/search', 'Admin/ProductsController@search');


