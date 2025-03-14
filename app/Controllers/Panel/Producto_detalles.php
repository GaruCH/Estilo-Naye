<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Producto_detalles extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_PRODUCTO_DETALLES, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_PRODUCTO_DETALLES;
        } //end else rol permitido
    } //end constructor

    public function index($id_producto = 0)
    {
        if ($this->permitido) {
            $tabla_productos = new \App\Models\Tabla_productos;

            $producto = $tabla_productos->obtener_producto($id_producto);
            if ($producto == NULL) {
                mensaje('No se encuentra el producto proporcionado.', WARNING_ALERT, '¡producto no encontrado!');
                return redirect()->to(route_to('administracion_productos'));
            } else {

                return $this->crear_vista("panel/producto_detalles", $this->cargar_datos($producto));
            }
        } else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        }
    }


    private function cargar_datos($producto = NULL)
    {
        //======================================================================
        //==========================DATOS FUNDAMENTALES=========================
        //======================================================================
        $datos = array();
        $session = session();
        $datos['nombre_completo_usuario'] = $session->nombre_completo_usuario;
        $datos['email_usuario'] = $session->email_usuario;
        $datos['imagen_usuario'] = ($session->imagen_usuario == NULL ?
            ($session->sexo_usuario == SEXO_MASCULINO ? 'no-image-m.png' : 'no-image-f.png') :
            $session->imagen_usuario);

        //======================================================================
        //========================DATOS PROPIOS CONTROLLER======================
        //======================================================================
        $datos['nombre_pagina'] = 'Detalles producto';
        //Cargar modelos
        $datos['producto'] = $producto;

        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'Productos',
                'href' => route_to('administracion_productos'),
                'extra' => ''
            ),
            array(
                'tarea' => 'Detalles productos',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Detalles del producto: <b>' . $producto->nombre_producto . '</b>');

        return $datos;
    } //end cargar_datos

    private function crear_vista($nombre_vista, $contenido = array())
    {
        $contenido['menu'] = crear_menu_panel();
        return view($nombre_vista, $contenido);
    } //end crear_vista

    /*
	private function enviar_editar_usuario($email = NULL, $usuario = array(), $password_usuario = NULL) {
		$configuracion_correo = array();
		$configuracion_correo['asunto'] = 'Información de actualización';
		$configuracion_correo['background_header'] = '#542772;';
		$configuracion_correo['logo'] = base_url(IMG_DIR_SISTEMA.'/'.LOGO_SISTEMA_CJM);
		$configuracion_correo['usuario'] = $usuario;
		$configuracion_correo['password'] = $password_usuario;
		$configuracion_correo['rol_usuario'] = ROLES[$usuario["id_rol"]];
		$configuracion_correo['header'] = 'Datos Generales del Usuario';
		$configuracion_correo['descripcion'] = 'Te proporcionamos tus credenciales de acceso actualizadas para el SiAdCJM.';
		$configuracion_correo['acronimo_sistema'] = ACRONIMO_SISTEMA;
		$plantilla_email = view('plantilla/email_base', $configuracion_correo);
		return enviar_correo_individual(CORREO_EMISOR_SISTEMA, ACRONIMO_SISTEMA , $email, $configuracion_correo['asunto'], $plantilla_email);
	}//end enviar_editar_usuario
	*/

    public function editar()
    {
        if ($this->permitido) {
            $id_producto = $this->request->getPost('id_producto');

            if ($this->request->getPost('nombre_producto') == NULL) {
                mensaje("Debes proporcionar un nombre para el producto", DANGER_ALERT, "¡No se pudo actualizar!");
                return $this->index($id_producto);
            }

            $tabla_productos = new \App\Models\Tabla_productos;

            $producto = [
                'nombre_producto' => $this->request->getPost('nombre_producto'),
                'descripcion_producto' => $this->request->getPost('descripcion_producto'),
                'cantidad_producto' => $this->request->getPost('cantidad_producto'),
                'stock_minimo_producto' => $this->request->getPost('stock_minimo_producto')
            ];

            // Verificar si el nombre del producto ya existe (except o el actual)
            $opcion = $tabla_productos->existe_nombre_excepto_actual($producto['nombre_producto'], $id_producto);
            if ($opcion == 2 || $opcion == -100) {
                mensaje("El nombre del producto ya está en uso.", WARNING_ALERT, "¡Nombre en uso!");
                return $this->index($id_producto);
            }

            try {
                // Actualizar información del producto
                $tabla_productos->update($id_producto, $producto);

                mensaje("El producto ha sido actualizado exitosamente", SUCCESS_ALERT, "¡Actualización exitosa!");
                return redirect()->to(route_to('detalles_producto', $id_producto));
            } catch (\Exception $e) {
                mensaje("Hubo un error al actualizar el producto. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al actualizar!");
                return redirect()->to(route_to('detalles_producto', $id_producto));
            }
        } else {
            return $this->index();
        }
    }
}//End Class Usuario_detalles
