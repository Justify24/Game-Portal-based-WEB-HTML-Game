<?php

// Default route
$routes->get('/', 'Home::index');

// Routes untuk Admin
$routes->group('admin', function($routes) {
    // Auth routes (tidak perlu filter auth)
    $routes->get('login', 'AdminController::login');
    $routes->post('authenticate', 'AdminController::authenticate');
    $routes->get('register', 'AdminController::register');
    $routes->get('logout', 'AdminController::logout');
    
    // Routes yang membutuhkan auth
    $routes->group('', ['filter' => 'auth'], function($routes) {
        // Dashboard route
        $routes->get('/', 'AdminController::index');
        
        // Admin management routes
        $routes->group('admins', function($routes) {
            $routes->get('/', 'AdminController::admins');
            $routes->post('create', 'AdminController::createAdmin');
            $routes->get('delete/(:num)', 'AdminController::deleteAdmin/$1');
            $routes->get('edit/(:num)', 'AdminController::editAdmin/$1');
            $routes->post('update/(:num)', 'AdminController::updateAdmin/$1');
        });
        
        // Game management routes
        $routes->group('games', function($routes) {
            $routes->get('/', 'GameController::index');
            $routes->get('new', 'GameController::new');
            $routes->post('create', 'GameController::create');
            $routes->get('edit/(:segment)', 'GameController::edit/$1');
            $routes->post('update/(:segment)', 'GameController::update/$1');
            $routes->get('delete/(:segment)', 'GameController::delete/$1');
        });

        // Profile routes
        $routes->get('profile', 'AdminController::profile');
        $routes->post('profile/update', 'AdminController::updateProfile');
    });
});

// Jika ada route 404, arahkan ke halaman default
$routes->set404Override(function() {
    return view('errors/404');
});
