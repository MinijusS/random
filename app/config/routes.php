<?php

use Core\Router;
Router::add('index', '/', 'App\Controllers\User\CatalogController', 'index');
Router::add('login', '/login', '\App\Controllers\Auth\LoginController', 'index');
Router::add('register', '/register', '\App\Controllers\Auth\RegisterController', 'index');
Router::add('logout', '/logout', '\App\Controllers\Auth\LogoutController', 'index');
Router::add('admin.orders', '/admin/orders/', '\App\Controllers\Admin\OrdersController', 'index');
Router::add('admin.orders.view', '/admin/orders/view', '\App\Controllers\Admin\OrdersController', 'edit');
Router::add('admin.products', '/admin/products/view', '\App\Controllers\Admin\ProductController', 'index');
Router::add('admin.products.create', '/admin/products/create', '\App\Controllers\Admin\ProductController', 'create');
Router::add('admin.products.edit', '/admin/products/edit', '\App\Controllers\Admin\ProductController', 'edit');
Router::add('user.cart', '/cart', '\App\Controllers\User\CartController', 'index');
Router::add('user.orders', '/orders/', '\App\Controllers\User\OrderIndexController', 'index');
Router::add('user.orders.view', '/orders/view', '\App\Controllers\User\OrderViewController', 'index');
