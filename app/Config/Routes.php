<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::signIn');
$routes->get('/logout', 'AuthController::signOut');

$routes->get('/data-barang', 'DataBarangController::index');
$routes->post('/tambah-barang', 'DataBarangController::addBarang');
$routes->post('/update-barang', 'DataBarangController::updateBarang');
$routes->get('/detail-barang/(:num)', 'DataBarangController::detailBarang/$1');
$routes->get('/hapus-barang/(:num)', 'DataBarangController::removeBarang/$1');
$routes->get('/data-barang/report', 'DataBarangController::getReport');

$routes->get('/barang-masuk', 'barangMasukController::index');
$routes->post('/tambah-barang-masuk', 'barangMasukController::addBarangMasuk');
$routes->post('/update-barang-masuk', 'barangMasukController::updateBarangMasuk');
$routes->get('/hapus-barang-masuk/(:num)', 'barangMasukController::removeBarangMasuk/$1');
$routes->get('/detail-barang-masuk/(:num)', 'barangMasukController::detailBarangMasuk/$1');
$routes->get('/barang-masuk/report', 'barangMasukController::getReport');

$routes->get('/barang-keluar', 'barangKeluarController::index');
$routes->post('/tambah-barang-keluar', 'barangKeluarController::addBarangKeluar');
$routes->post('/update-barang-keluar', 'barangKeluarController::updateBarangKeluar');
$routes->get('/hapus-barang-keluar/(:num)', 'barangKeluarController::removeBarangKeluar/$1');
$routes->get('/detail-barang-keluar/(:num)', 'barangKeluarController::detailBarangKeluar/$1');
$routes->get('/barang-keluar/report', 'barangKeluarController::getReport');

$routes->get('/data-pelanggan', 'PelangganController::index');
$routes->post('/tambah-pelanggan', 'PelangganController::addPelanggan');
$routes->post('/update-pelanggan', 'PelangganController::updatePelanggan');
$routes->get('/hapus-pelanggan/(:num)', 'PelangganController::removePelanggan/$1');
$routes->get('/detail-pelanggan/(:num)', 'PelangganController::detailPelanggan/$1');

$routes->get('/data-supplier', 'SupplierController::index');
$routes->post('/tambah-supplier', 'SupplierController::addSupplier');
$routes->post('/update-supplier', 'SupplierController::updateSupplier');
$routes->get('/hapus-supplier/(:num)', 'SupplierController::removeSupplier/$1');
$routes->get('/detail-supplier/(:num)', 'SupplierController::detailSupplier/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
