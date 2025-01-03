<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/krs', 'KRSController::index'); // Tampilkan halaman KRS
// $routes->post('/krs/simpan', 'KRSController::simpan'); // Simpan KRS

// $routes->get('/login', 'AuthController::login');
// $routes->post('/login', 'AuthController::authenticate');
// $routes->get('/logout', 'AuthController::logout'); 

// $routes->get('/mahasiswa', 'MahasiswaController::index', ['filter' => 'auth']);
// $routes->post('/mahasiswa', 'MahasiswaController::store', ['filter' => 'auth']);



$routes->get('/', 'Home::index');
$routes->get('/krs', 'KRSController::index');
$routes->post('/krs/simpan', 'KRSController::simpan');
$routes->get('/krs/getMataKuliah', 'KRSController::getMataKuliah');
$routes->get('/profile', 'MahasiswaController::profile');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');
});
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');