<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Panel::index');
$routes->get('/panel', 'Panel::index');
$routes->get('/perfil', 'Usuario::perfil');

$routes->set404Override(function() {
    return view('404'); // Aquí especifica la vista de la página 404 personalizada
});
