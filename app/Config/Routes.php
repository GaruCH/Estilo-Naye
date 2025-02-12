<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Clientes\Inicio::index', ['as' => 'cliente_inicio']);
$routes->get('/catalogo', 'Clientes\Catalogo::index', ['as' => 'cliente_catalogo']);
$routes->get('/servicios', 'Clientes\Servicios::index', ['as' => 'cliente_servicios']);
$routes->get('/agenda', 'Clientes\Agenda::index', ['as' => 'cliente_agenda']);
$routes->get('/contacto', 'Clientes\Contacto::index', ['as' => 'cliente_contacto']);


$routes->get('/login', 'Usuarios\Login::index', ['as' => 'usuario_login']);


$routes->get('/dashboard', 'Panel\Dashboard::index', ['as' => 'panel_dashboard']);