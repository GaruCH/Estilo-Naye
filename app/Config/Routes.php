<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//??????????????????????????????????????????????????????????????????????????????
//????????????????????         RUTAS DEL CLIENTE         ???????????????????????
//??????????????????????????????????????????????????????????????????????????????

$routes->get('/', 'Clientes\Inicio::index', ['as' => 'cliente_inicio']);
$routes->get('/catalogo', 'Clientes\Catalogo::index', ['as' => 'cliente_catalogo']);
$routes->get('/servicios', 'Clientes\Servicios::index', ['as' => 'cliente_servicios']);
$routes->get('/agenda', 'Clientes\Agenda::index', ['as' => 'cliente_agenda']);
$routes->get('/contacto', 'Clientes\Contacto::index', ['as' => 'cliente_contacto']);

//??????????????????????????????????????????????????????????????????????????????
//???????????????????? RUTAS DEL PANEL DE ADMINISTRACIÓN ???????????????????????
//??????????????????????????????????????????????????????????????????????????????

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

// Servicios
$routes->get('/administracion_servicios', 'Panel\Servicios::index', ['as' => 'administracion_servicios']);
$routes->post('/estatus_servicio', 'Panel\Servicios::estatus_servicio', ['as' => 'estatus_servicio']);
$routes->post('/eliminar_servicio', 'Panel\Servicios::eliminar_servicio', ['as' => 'eliminar_servicio']);
$routes->post('/restaurar_servicio', 'Panel\Servicios::recuperar_servicio', ['as' => 'restaurar_servicio']);
$routes->get('/nuevo_servicio', 'Panel\Servicio_nuevo::index', ['as' => 'nuevo_servicio']);
$routes->post('/registrar_servicio', 'Panel\Servicio_nuevo::registrar', ['as' => 'registrar_servicio']);
$routes->get('/detalles_servicio/(:num)', 'Panel\Servicio_detalles::index/$1', ['as' => 'detalles_servicio']);
$routes->post('/editar_servicio', 'Panel\Servicio_detalles::editar', ['as' => 'editar_servicio']);

// Categorías
$routes->get('/administracion_categorias', 'Panel\Categorias::index', ['as' => 'administracion_categorias']);
$routes->post('/estatus_categoria', 'Panel\Categorias::estatus_categoria', ['as' => 'estatus_categoria']);
$routes->post('/eliminar_categoria', 'Panel\Categorias::eliminar_categoria', ['as' => 'eliminar_categoria']);
$routes->post('/restaurar_categoria', 'Panel\Categorias::recuperar_categoria', ['as' => 'restaurar_categoria']);
$routes->get('/nuevo_categoria', 'Panel\Categoria_nuevo::index', ['as' => 'nuevo_categoria']);
$routes->post('/registrar_categoria', 'Panel\Categoria_nuevo::registrar', ['as' => 'registrar_categoria']);
$routes->get('/detalles_categoria/(:num)', 'Panel\Categoria_detalles::index/$1', ['as' => 'detalles_categoria']);
$routes->post('/editar_categoria', 'Panel\Categoria_detalles::editar', ['as' => 'editar_categoria']);
// Productos
$routes->get('/administracion_productos', 'Panel\Productos::index', ['as' => 'administracion_productos']);
$routes->post('/estatus_producto', 'Panel\Productos::estatus_producto', ['as' => 'estatus_producto']);
$routes->post('/eliminar_producto', 'Panel\Productos::eliminar_producto', ['as' => 'eliminar_producto']);
$routes->post('/restaurar_producto', 'Panel\Productos::recuperar_producto', ['as' => 'restaurar_producto']);
$routes->get('/nuevo_producto', 'Panel\Producto_nuevo::index', ['as' => 'nuevo_producto']);
$routes->post('/registrar_producto', 'Panel\Producto_nuevo::registrar', ['as' => 'registrar_producto']);
$routes->get('/detalles_producto/(:num)', 'Panel\Producto_detalles::index/$1', ['as' => 'detalles_producto']);
$routes->post('/editar_producto', 'Panel\Producto_detalles::editar', ['as' => 'editar_producto']);

// Citas
$routes->get('/administracion_citas', 'Panel\Citas::index', ['as' => 'administracion_citas']);
$routes->post('/eliminar_cita', 'Panel\Citas::eliminar_cita', ['as' => 'eliminar_cita']);
$routes->post('/restaurar_cita', 'Panel\Citas::recuperar_cita', ['as' => 'restaurar_cita']);

// Productos_Categoria
$routes->get('/administracion_productos_categorias', 'Panel\Productos_categorias::index', ['as' => 'administracion_productos_categorias']);

// Historial Productos
$routes->get('/historial_citas_productos', 'Panel\Citas_productos::index', ['as' => 'historial_citas_productos']);

//ejemplo
$routes->get('/ejemplo', 'Panel\Ejemplo::index', ['as' => 'ejemplo']);
