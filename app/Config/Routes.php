<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */

// Rute Default (Halaman Utama)
$routes->get('/home', 'Home::index');

$routes->get('/', function () {
    return redirect()->to(base_url('auth/login'));
});
// --- PENDUDUK ROUTES ---
$routes->group('kasus', static function ($routes) {
    // View (GET /penduduk)
    $routes->get('/', 'Kasus::index'); // View
    $routes->get('tambah', 'Kasus::new'); // Create Data
    $routes->post('save', 'Kasus::create');
    $routes->get('ubah/(:any)', 'Kasus::edit/$1'); // Edit/Update Data
    $routes->post('verifikasi-rt/(:any)', 'Kasus::verifikasiRt/$1');
    $routes->post('verifikasi-rw/(:any)', 'Kasus::verifikasiRw/$1');
    $routes->put('(:any)', 'Kasus::update/$1');
    $routes->delete('(:segment)', 'Kasus::delete/$1'); // Delete Data
});

// --- AUTH ROUTES ---
$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::login'); // view login
    $routes->post('login', 'Auth::loginProcess'); // login process
    $routes->get('logout', 'Auth::Logout'); // logout
    $routes->get('daftar', 'Auth::register'); // register
    $routes->post('daftar', 'Auth::registerProcess'); // register process
});
