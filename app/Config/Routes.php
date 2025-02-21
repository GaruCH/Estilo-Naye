<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//******************************************************************************
//********************         RUTAS DEL CLIENTE         ***********************
//******************************************************************************

$routes->get('/', 'Clientes\Inicio::index', ['as' => 'cliente_inicio']);
$routes->get('/catalogo', 'Clientes\Catalogo::index', ['as' => 'cliente_catalogo']);
$routes->get('/servicios', 'Clientes\Servicios::index', ['as' => 'cliente_servicios']);
$routes->get('/agenda', 'Clientes\Agenda::index', ['as' => 'cliente_agenda']);
$routes->get('/contacto', 'Clientes\Contacto::index', ['as' => 'cliente_contacto']);

//******************************************************************************
//******************** RUTAS DEL PANEL DE ADMINISTRACIÓN ***********************
//******************************************************************************

$routes->get('/login', 'Usuarios\Login::index', ['as' => 'usuario_login']);
$routes->post('/validar_usuario', 'Usuarios\Login::comprobar', ['as' => 'validar_usuario']);
$routes->get('/logout', 'Usuarios\Logout::index', ['as' => 'logout']);

//Propios del perfil
$routes->get('/mi_perfil', 'Panel\Perfil::index', ['as' => 'mi_perfil']);
$routes->post('/editar_mi_perfil', 'Panel\Perfil::actualizar', ['as' => 'editar_mi_perfil']);
$routes->get('/cambiar_password', 'Panel\Password::index', ['as' => 'cambiar_password']);
$routes->post('/editar_password', 'Panel\Password::actualizar', ['as' => 'editar_password']);

//******************************************************************************
//********************   RUTAS DEL PANEL DE SUPERADMIN   ***********************
//******************************************************************************

//Dashboard
$routes->get('/dashboard', 'Panel\Dashboard::index', ['as' => 'dashboard_superadmin']);

//Usuarios
$routes->get('/administracion_usuarios', 'Panel\Usuarios::index', ['as' => 'administracion_usuarios']);
	$routes->post('/estatus_usuario', 'Panel\Usuarios::estatus', ['as' => 'estatus_usuario']);
	$routes->post('/eliminar_usuario', 'Panel\Usuarios::eliminar', ['as' => 'eliminar_usuario']);
	$routes->post('/restaurar_usuario', 'Panel\Usuarios::recuperar_usuario', ['as' => 'restaurar_usuario']);
	$routes->post('/actualizar_password', 'Panel\Usuarios::actualizar_password', ['as' => 'actualizar_password']);
$routes->get('/nuevo_usuario', 'Panel\Usuario_nuevo::index', ['as' => 'nuevo_usuario']);
$routes->post('/registrar_usuario', 'Panel\Usuario_nuevo::registrar', ['as' => 'registrar_usuario']);
$routes->get('/detalles_usuario/(:num)', 'Panel\Usuario_detalles::index/$1', ['as' => 'detalles_usuario']);
	$routes->post('/editar_usuario', 'Panel\Usuario_detalles::editar', ['as' => 'editar_usuario']);
	//ejemplo
	$routes->get('/ejemplo', 'Panel\Ejemplo::index', ['as' => 'ejemplo']);


