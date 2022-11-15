<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Dashboard
$routes->get('/', 'Dashboard::index');

$routes->get('/datapajak', 'Pajak::getpajak');

/*
 * --------------------------------------------------------------------
 * Kelola Role
 * --------------------------------------------------------------------
 */
$routes->group('role', ['filter' => 'role:Super admin,Owner'], function ($routes) {
	$routes->get('edit/(:num)', 'Role::edit/$1');
	$routes->post('save', 'Role::save');
	$routes->post('save/(:num)', 'Role::save');
	$routes->post('update/(:num)', 'Role::update/$1');
	$routes->delete('(:num)', 'Role::delete/$1');
	$routes->addRedirect('(:any)', 'role');
});

/*
 * --------------------------------------------------------------------
 * Kelola User
 * --------------------------------------------------------------------
 */
$routes->group('user', function ($routes) {
	// Kelola profil
	$routes->get('', 'User::index');
	$routes->get('edit/(:segment)', 'User::edit/$1');
	$routes->post('update', 'User::update');
	$routes->addRedirect('(:any)', 'user');
});

$routes->group('users', ['filter' => 'role:Super admin,Owner'], function ($routes) {
	// Kelola user
	$routes->get('', 'Users::index');
	$routes->get('(:num)', 'Users::detail/$1');
	$routes->post('editrole', 'Users::editrole');
	$routes->addRedirect('(:any)', 'users');
});

/*
 * --------------------------------------------------------------------
 * Kelola Jenis Pembayaran
 * --------------------------------------------------------------------
 */
$routes->group('pembayaran', ['filter' => 'role:Super admin,Owner'], function ($routes) {
	$routes->get('', 'Pembayaran::index');
	$routes->get('add', 'Pembayaran::add');
	$routes->get('detail/(:num)', 'Pembayaran::detail/$1');
	$routes->get('edit/(:num)', 'Pembayaran::edit/$1');
	$routes->post('insert', 'Pembayaran::insert');
	$routes->post('update', 'Pembayaran::update');
	$routes->post('delete', 'Pembayaran::delete');
	$routes->addRedirect('(:any)', 'pembayaran');
});

/*
 * --------------------------------------------------------------------
 * Kelola Pajak
 * --------------------------------------------------------------------
 */
$routes->group('pajak', ['filter' => 'role:Super admin,Owner'], function ($routes) {
	$routes->get('', 'Pajak::index');
	$routes->get('add', 'Pajak::add');
	$routes->get('detail/(:num)', 'Pajak::detail/$1');
	$routes->get('edit/(:num)', 'Pajak::edit/$1');
	$routes->post('insert', 'Pajak::insert');
	$routes->post('update', 'Pajak::update');
	$routes->post('delete', 'Pajak::delete');
	$routes->addRedirect('(:any)', 'pajak');
});

/*
 * --------------------------------------------------------------------
 * Kelola Akun
 * --------------------------------------------------------------------
 */
$routes->group('akun', ['filter' => 'role:Super admin,Owner'], function ($routes) {
	// Akun
	$routes->get('', 'Akun::index');
	$routes->get('add', 'Akun::add');
	$routes->get('edit/(:num)', 'Akun::edit/$1');
	$routes->post('insert', 'Akun::insert');
	$routes->post('update', 'Akun::update');
	$routes->post('delete', 'Akun::delete');
	// Kategori akun
	$routes->get('category', 'Akun::category');
	$routes->post('addcategory', 'Akun::addcategory');
	$routes->post('editcategory', 'Akun::editcategory');
	$routes->post('deletecategory', 'Akun::deletecategory');
	$routes->addRedirect('(:any)', 'akun');
});

/*
 * --------------------------------------------------------------------
 * Kelola Kas
 * --------------------------------------------------------------------
 */
$routes->group('kas', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	$routes->get('', 'Kas::index');
	$routes->get('add', 'Kas::add');
	$routes->get('editkaskeluar/(:num)', 'Kas::editkaskeluar/$1');
	$routes->get('editkasmasuk/(:num)', 'Kas::editkasmasuk/$1');
	$routes->get('detailkasmasuk/(:num)', 'Kas::detailkasmasuk/$1');
	$routes->get('detailkaskeluar/(:num)', 'Kas::detailkaskeluar/$1');
	$routes->post('insert', 'Kas::insert');
	$routes->post('update', 'Kas::update');
	$routes->post('delete', 'Kas::delete');
	$routes->addRedirect('(:any)', 'kas');
});


/*
 * --------------------------------------------------------------------
 * Kelola Penjualan, Produk, Diskon
 * --------------------------------------------------------------------
 */
$routes->group('penjualan', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Penjualan
	$routes->get('', 'Penjualan::index');
	$routes->get('add', 'Penjualan::add');
	$routes->get('detail/(:num)', 'Penjualan::detail/$1');
	$routes->get('laporan', 'Penjualan::laporan');
	$routes->post('insert', 'Penjualan::insert');
	$routes->post('bayarorder', 'Penjualan::bayarorder');
	$routes->post('delete', 'Penjualan::delete');
	$routes->addRedirect('(:any)', 'penjualan');
});

$routes->group('produk', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Produk
	$routes->get('', 'Produk::index');
	$routes->get('add', 'Produk::add');
	$routes->get('detail/(:num)', 'Produk::detail/$1');
	$routes->get('edit/(:num)', 'Produk::edit/$1');
	$routes->post('insert', 'Produk::insert');
	$routes->post('update', 'Produk::update');
	$routes->post('delete', 'Produk::delete');
	// Kategori produk
	$routes->get('category', 'Produk::category');
	$routes->get('addcategory', 'Produk::addcategory');
	$routes->get('editcategory/(:num)', 'Produk::editcategory/$1');
	$routes->post('insertcategory', 'Produk::insertcategory');
	$routes->post('updatecategory', 'Produk::updatecategory');
	$routes->post('deletecategory', 'Produk::deletecategory');
	$routes->addRedirect('(:any)', 'produk');
});

$routes->group('diskon', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Diskon
	$routes->get('', 'Diskon::index');
	$routes->get('add', 'Diskon::add');
	$routes->get('detail/(:num)', 'Diskon::detail/$1');
	$routes->get('edit/(:num)', 'Diskon::edit/$1');
	$routes->post('insert', 'Diskon::insert');
	$routes->post('update', 'Diskon::update');
	$routes->post('delete', 'Diskon::delete');
	$routes->addRedirect('(:any)', 'diskon');
});

/*
 * --------------------------------------------------------------------
 * Kelola Aset
 * --------------------------------------------------------------------
 */
$routes->group('aset', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Aset
	$routes->get('', 'Aset::index');
	$routes->get('add', 'Aset::add');
	$routes->get('detail/(:num)', 'Aset::detail/$1');
	$routes->get('edit/(:num)', 'Aset::edit/$1');
	$routes->post('insert', 'Aset::insert');
	$routes->post('update', 'Aset::update');
	$routes->post('delete', 'Aset::delete');
	$routes->addRedirect('(:any)', 'aset');
});

$routes->group('pembelianaset', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Pembelian aset
	$routes->get('add', 'PembelianAset::add');
	$routes->get('detail/(:num)', 'PembelianAset::detail/$1');
	$routes->get('edit/(:num)', 'PembelianAset::edit/$1');
	$routes->post('insert', 'PembelianAset::insert');
	$routes->post('update', 'PembelianAset::update');
	$routes->post('accept', 'PembelianAset::accept');
	$routes->post('delete', 'PembelianAset::delete');
	$routes->addRedirect('(:any)', 'aset');
});

$routes->group('penjualanaset', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Penjualan aset
	$routes->get('add/(:num)', 'PenjualanAset::add/$1');
	$routes->get('detail/(:num)', 'PenjualanAset::detail/$1');
	$routes->post('insert', 'PenjualanAset::insert');
	$routes->addRedirect('(:any)', 'aset');
});

/*
 * --------------------------------------------------------------------
 * Payroll
 * --------------------------------------------------------------------
 */
$routes->group('gaji', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Gaji
	$routes->get('', 'Gaji::index');
	$routes->get('add', 'Gaji::add');
	$routes->get('detail/(:num)', 'Gaji::detail/$1');
	$routes->get('edit/(:num)', 'Gaji::edit/$1');
	$routes->post('insert', 'Gaji::insert');
	$routes->post('update', 'Gaji::update');
	$routes->post('delete', 'Gaji::delete');
	$routes->addRedirect('(:any)', 'gaji');
});

$routes->group('pembayarangaji', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Pembayaran gaji
	$routes->post('insert', 'PembayaranGaji::insert');
	$routes->post('delete', 'PembayaranGaji::delete');
	$routes->addRedirect('(:any)', 'gaji');
});

$routes->group('tunjangan', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Tunjangan
	$routes->get('', 'Tunjangan::index');
	$routes->get('detail/(:num)', 'Tunjangan::detail/$1');
	$routes->post('insert', 'Tunjangan::insert');
	$routes->post('delete', 'Tunjangan::delete');
	// Jenis tunjangan
	$routes->get('jenis', 'Tunjangan::jenis');
	$routes->get('addjenis', 'Tunjangan::addjenis');
	$routes->get('detailjenis/(:num)', 'Tunjangan::detailjenis/$1');
	$routes->get('editjenis/(:num)', 'Tunjangan::editjenis/$1');
	$routes->post('deactivate', 'Tunjangan::deactivate');
	$routes->post('activate', 'Tunjangan::activate');
	$routes->post('insertjenis', 'Tunjangan::insertjenis');
	$routes->post('updatejenis', 'Tunjangan::updatejenis');
	$routes->post('deletejenis', 'Tunjangan::deletejenis');
	$routes->addRedirect('(:any)', 'tunjangan');
});

$routes->group('pembayarantunjangan', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Pembayaran tunjangan
	$routes->post('insert', 'PembayaranTunjangan::insert');
	$routes->addRedirect('(:any)', 'tunjangan');
});

/*
 * --------------------------------------------------------------------
 * Kelola Pengeluaran, Pengajuan
 * --------------------------------------------------------------------
 */
$routes->get('/pengeluaran', 'Pengeluaran::index');
$routes->group('pengeluaran', ['filter' => 'role:Super admin,Owner,Manajer,Kasir'], function ($routes) {
	// Pengeluaran
	$routes->get('add', 'Pengeluaran::add');
	$routes->get('laporan', 'Pengeluaran::laporan');
	$routes->get('detail/(:num)', 'Pengeluaran::detail/$1');
	$routes->get('edit/(:num)', 'Pengeluaran::edit/$1');
	$routes->post('insert', 'Pengeluaran::insert');
	$routes->post('update', 'Pengeluaran::update');
	$routes->post('delete', 'Pengeluaran::delete');
	$routes->addRedirect('(:any)', 'pengeluaran');
});

$routes->group('pengajuan', function ($routes) {
	// Pengajuan
	$routes->get('add', 'Pengajuan::add');
	$routes->get('detail/(:num)', 'Pengajuan::detail/$1');
	$routes->get('edit/(:num)', 'Pengajuan::edit/$1');
	$routes->post('insert', 'Pengajuan::insert');
	$routes->post('update', 'Pengajuan::update');
	$routes->post('delete', 'Pengajuan::delete');
	$routes->post('submit', 'Pengajuan::submit');
	$routes->addRedirect('(:any)', 'pengeluaran');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
