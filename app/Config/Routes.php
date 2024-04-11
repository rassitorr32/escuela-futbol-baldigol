<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Panel::index');
$routes->get('/panel', 'Panel::index');
$routes->get('/perfil', 'Usuario::perfil');
