<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');
$routes->get('/logout', 'Auth::logout');

$routes->group('/employe', ['filter' => 'auth:employe'], static function ($routes) {
    $routes->get('/', 'Employe::index');
});

$routes->group('/rh', ['filter' => 'auth:rh'], static function ($routes) {
    $routes->get('/', 'Rh::index');
});

$routes->group('/admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('/', 'Admin::index');
});
