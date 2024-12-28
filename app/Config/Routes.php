<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/krs', 'KRSController::index'); // Tampilkan halaman KRS
$routes->post('/krs/simpan', 'KRSController::simpan'); // Simpan KRS
