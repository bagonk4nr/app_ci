<?php
namespace Config;

use Config\AutoRoutes;
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
// $routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
// $routes->setTranslateURIDashes(false);
// $routes->set404Override();
// $routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
		=== 'on' ? "https" : "http") . "://" . (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']
		!== '' ? $_SERVER['HTTP_HOST'] : null)
		. $_SERVER['PHP_SELF'];
$method = (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] !== '' ? $_SERVER['REQUEST_METHOD'] : null);
$uri = (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '' ? $_SERVER['REQUEST_URI'] : null);
$uri = str_replace('/app_ci/public', '', $uri);
// print_r($uri);
// print_r($link);
// print_r($method);
// exit();

$autoroutes = new AutoRoutes($uri, $method);
return $autoroutes->toRoute();
// $autoroutes->toRoutes();


// $routes->get('/', 'Home::index');

/**
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
