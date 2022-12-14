<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'User::isLogin');
$routes->get('/dashboard', 'Home::dashboard');


$routes->group('profile', function($routes){
	$routes->get('', 'Profile::getProfile');
	$routes->get('(:segment)/preview', 'Profile::preview/$1');
    $routes->add('create', 'Profile::create');
	$routes->add('(:segment)/edit', 'Profile::edit/$1');
	$routes->post('(:segment)/update', 'Profile::update/$1');
	$routes->get('(:segment)/delete', 'Profile::delete/$1');
});

$routes->group('outlet', function($routes){
	$routes->get('', 'Outlet::index');
	$routes->get('user', 'Outlet::getLocation');
	$routes->get('(:segment)/preview', 'Outlet::preview/$1');
    $routes->add('create', 'Outlet::create');
	$routes->add('(:segment)/edit', 'Outlet::edit/$1');
	$routes->post('(:segment)/update', 'Outlet::update/$1');
	$routes->get('(:segment)/delete', 'Outlet::delete/$1');
});

$routes->group('address', function($routes){
	$routes->get('', 'Address::getAddress');
	$routes->get('(:segment)/preview', 'Address::preview/$1');
    $routes->add('create', 'Address::create');
	$routes->add('(:segment)/edit', 'Address::edit/$1');
	$routes->post('(:segment)/update', 'Address::update/$1');
	$routes->get('(:segment)/delete', 'Address::delete/$1');
});

$routes->group('customer', function($routes){
	$routes->get('', 'Customer::index');
	$routes->get('(:segment)/preview', 'Customer::preview/$1');
    $routes->add('create', 'Customer::create');
	$routes->add('(:segment)/edit', 'Customer::edit/$1');
	$routes->get('(:segment)/delete', 'Customer::delete/$1');
});
$routes->group('package', function($routes){
	$routes->get('', 'Package::index');
	$routes->get('(:segment)/preview', 'Package::preview/$1');
    $routes->add('create', 'Package::create');
	$routes->post('store', 'Package::store');
	$routes->add('(:segment)/edit', 'Package::edit/$1');
	$routes->post('(:segment)/update', 'Package::update/$1');
	$routes->get('(:segment)/delete', 'Package::delete/$1');
});

$routes->group('report', function($routes){
	$routes->get('', 'Report::index');
	$routes->add('print', 'Report::printReport');
	$routes->get('(:segment)/preview', 'Outlet::preview/$1');
    $routes->add('create', 'Outlet::create');
	$routes->add('(:segment)/edit', 'Outlet::edit/$1');
	$routes->get('(:segment)/delete', 'Outlet::delete/$1');
});

$routes->group('user', function($routes){
	$routes->get('', 'User::index');
	$routes->get('(:segment)/preview', 'User::preview/$1');
    $routes->add('create', 'User::create');
	$routes->add('(:segment)/edit', 'User::edit/$1');
	$routes->get('(:segment)/delete', 'User::delete/$1');
});

$routes->group('transaction', function($routes){
	$routes->get('', 'Transaction::index');
	$routes->get('(:segment)/preview', 'Transaction::preview/$1');
	$routes->get('(:segment)/print', 'Transaction::print/$1');
    $routes->add('create', 'Transaction::create');
	$routes->post('store', 'Transaction::store');
	$routes->add('(:segment)/edit', 'Transaction::edit/$1');
	$routes->get('(:segment)/delete', 'Transaction::delete/$1');
	$routes->get('history', 'Transaction::history');
	$routes->get('topickup', 'Transaction::toPickUp');
	$routes->get('todelivery', 'Transaction::toDelivery');
});

$routes->group('tracking', function($routes){
	$routes->get('', 'Tracking::index');
	$routes->get('(:segment)/preview', 'Tracking::preview/$1');
    $routes->add('create', 'Tracking::create');
	$routes->get('(:num)/(:num)/status', 'Tracking::status/$1/$2');
	$routes->add('(:segment)/edit', 'Tracking::edit/$1');
	$routes->get('(:segment)/delete', 'Tracking::delete/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
