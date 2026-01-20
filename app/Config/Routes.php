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
    $routes->get('detail/(:any)', 'Kasus::detail/$1');
    $routes->get('ubah/(:any)', 'Kasus::edit/$1'); // Edit/Update Data
    $routes->post('verifikasi-rt/(:any)', 'Kasus::verifikasiRt/$1');
    $routes->post('verifikasi-rw/(:any)', 'Kasus::verifikasiRw/$1');
    $routes->put('(:any)', 'Kasus::update/$1');
    $routes->delete('(:segment)', 'Kasus::delete/$1'); // Delete Data
});

$routes->group('pengguna', ['filter' => 'isAdmin'], static function ($routes) {
    $routes->get('/', 'User::index');  // View
    $routes->get('tambah', 'User::new'); // View Tambah
    $routes->post('save', 'User::create'); // Create Data
    $routes->get('ubah/(:any)', 'User::edit/$1'); // View Edit
    $routes->put('(:any)', 'User::update/$1'); // Edit/Update Data
    $routes->delete('(:segment)', 'User::delete/$1'); // Delete Data
});

// --- AUTH ROUTES ---
$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::login'); // view login
    $routes->post('login', 'Auth::loginProcess'); // login process
    $routes->get('logout', 'Auth::Logout'); // logout
    $routes->get('daftar', 'Auth::register'); // register
    $routes->post('daftar', 'Auth::registerProcess'); // register process
});
