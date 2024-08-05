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
    $routes->get('dashboard', 'Auth::dashboard', ['filter' => 'auth']);

    $routes->get('forgot-password', 'Auth::forgotPassword', ['filter' => 'noauth']);
    $routes->post('forgot-password', 'Auth::processForgotPassword');
    $routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1', ['filter' => 'noauth']);
    $routes->post('reset-password', 'Auth::processResetPassword');
});


$routes->resource('users', ['filter' => 'auth', 'controller' => 'UserController']);
$routes->resource('editoriales', ['filter' => 'auth', 'controller' => 'Editoriales']);
$routes->resource('autores', ['filter' => 'auth', 'controller' => 'Autores']);
$routes->resource('generos', ['filter' => 'auth', 'controller' => 'Generos']);
$routes->resource('recursos', ['filter' => 'auth', 'controller' => 'Recursos']);
$routes->resource('publicaciones', ['filter' => 'auth', 'controller' => 'Publicaciones']);

$routes->get('carousel', 'CarouselController::index');
$routes->get('carousel/create', 'CarouselController::create');
$routes->post('carousel/store', 'CarouselController::store');
$routes->get('carousel/edit/(:num)', 'CarouselController::edit/$1');
$routes->put('carousel/update/(:num)', 'CarouselController::update/$1');
$routes->get('carousel/delete/(:num)', 'CarouselController::delete/$1');

$routes->get('reglamento', 'Home::reglamento');
$routes->get('servicios', 'Home::servicios');
$routes->get('acercade', 'Home::acercade');


