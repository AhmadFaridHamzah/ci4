<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Home::index');
$routes->get('/test', 'Admin\Management::index');
$routes->get('/about',function(){
	// echo " Ini page about";

	return view('welcome_message');
});


$routes->group('admin',function($routes){
	$routes->get('hello', 'Home::hello');

	
});

$routes->group('user',function($routes){

	
});

$routes->get('message/(:any)/(:any)','Home::message/$1/$2');


$routes->get('film-management','FilmManagement::index');
$routes->get('film-management/create','FilmManagement::create');
$routes->post('film-management/store','FilmManagement::store');
$routes->get('film-management/edit/(:num)','FilmManagement::edit/$1');
$routes->post('film-management/update/(:num)','FilmManagement::update/$1');

$routes->delete('film-management/delete/(:num)','FilmManagement::delete/$1')
//(:any)- semua value terima
//(:num) - nombor sahaja
//(:alpha) - alphabet sahaja
//(:segment) - sama mcm any,kecuali /
//(:alphanum) - combination aplphabet dan number

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
