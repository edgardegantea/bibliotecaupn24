<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'Auth::login', ['filter' => 'noauth']);
    $routes->post('login', 'Auth::loginProcess');
    $routes->get('logout', 'Auth::logout');

    $routes->get('forgot-password', 'Auth::forgotPassword', ['filter' => 'noauth']);
    $routes->post('forgot-password', 'Auth::processForgotPassword');
    $routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1', ['filter' => 'noauth']);
    $routes->post('reset-password', 'Auth::processResetPassword');
});

$routes->get('reglamento', 'Home::reglamento');
$routes->get('servicios', 'Home::servicios');
$routes->get('acercade', 'Home::acercade');



$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');

    // $routes->get('dashboard', 'Auth::dashboard');

    $routes->resource('users', ['controller' => 'UserController']);
    $routes->resource('editoriales', ['controller' => 'Editoriales']);
    $routes->resource('autores', ['controller' => 'Autores']);
    $routes->resource('generos', ['controller' => 'Generos']);
    $routes->resource('recursos', ['controller' => 'Recursos']);
    $routes->resource('publicaciones', ['controller' => 'Publicaciones']);

    $routes->get('carousel', 'CarouselController::index');
    $routes->get('carousel/create', 'CarouselController::create');
    $routes->post('carousel/store', 'CarouselController::store');
    $routes->get('carousel/edit/(:num)', 'CarouselController::edit/$1');
    $routes->put('carousel/update/(:num)', 'CarouselController::update/$1');
    $routes->get('carousel/delete/(:num)', 'CarouselController::delete/$1');




    $routes->get('/descarga/(:num)', 'ArchivoController::descargar/$1');

    $routes->get('archivos/visualizar/(:num)', 'ArchivoController::visualizar/$1');



    $routes->get('archivos', 'ArchivoController::index');
    $routes->get('archivos/create', 'ArchivoController::create');
    $routes->post('archivos/store', 'ArchivoController::store');
    $routes->get('archivos/edit/(:num)', 'ArchivoController::edit/$1');
    $routes->post('archivos/update/(:num)', 'ArchivoController::update/$1');
    $routes->get('archivos/delete/(:num)', 'ArchivoController::delete/$1');

    $routes->get('clasificaciones', 'ClasificacionController::index');
    $routes->get('clasificaciones/create', 'ClasificacionController::create');
    $routes->post('clasificaciones/store', 'ClasificacionController::store');
    $routes->get('clasificaciones/edit/(:num)', 'ClasificacionController::edit/$1');
    $routes->post('clasificaciones/update/(:num)', 'ClasificacionController::update/$1');
    $routes->get('clasificaciones/delete/(:num)', 'ClasificacionController::delete/$1');
});



$routes->group('usuario', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Usuario\UsuarioController::index');
    $routes->get('archivos/visualizar/(:num)', 'ArchivoController::visualizar/$1');
});