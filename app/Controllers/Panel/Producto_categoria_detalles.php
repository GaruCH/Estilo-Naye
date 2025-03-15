<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Producto_categoria_detalles extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_PRODUCTOS_CATEGORIAS_DETALLES, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_PRODUCTOS_CATEGORIAS_DETALLES;
        } //end else rol permitido
    } //end constructor

    public function index($id_producto = 0, $id_categoria = 0)
    {
        if ($this->permitido) {
            $tabla_producto_categoria = new \App\Models\Tabla_producto_categoria;

            $producto_categoria = $tabla_producto_categoria->obtener_producto_categoria($id_producto, $id_categoria);
            if ($producto_categoria == NULL) {
                mensaje('No se encuentra la asignación proporcionada.', WARNING_ALERT, '¡Asignación no encontrada!');
                return redirect()->to(route_to('administracion_producto_categorias'));
            } else {

                return $this->crear_vista("panel/asigancion_categoria_detalles", $this->cargar_datos($producto_categoria));
            }
        } else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        }
    }


    private function cargar_datos($producto_categoria = NULL)
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
        $datos['nombre_pagina'] = 'Detalles producto_categoria';
        //Cargar modelos
        $datos['producto_categoria'] = $producto_categoria;

        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'producto_categorias',
                'href' => route_to('administracion_producto_categorias'),
                'extra' => ''
            ),
            array(
                'tarea' => 'Detalles producto_categorias',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Detalles del producto_categoria: <b>' . $producto_categoria->nombre_producto_categoria . '</b>');

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
            $id_producto_categoria = $this->request->getPost('id_producto_categoria');

            if ($this->request->getPost('nombre_producto_categoria') == NULL) {
                mensaje("Debes proporcionar un nombre para el producto_categoria", DANGER_ALERT, "¡No se pudo actualizar!");
                return $this->index($id_producto_categoria);
            }

            $tabla_producto_categoria = new \App\Models\Tabla_producto_categoria;

            $producto_categoria = [
                'nombre_producto_categoria' => $this->request->getPost('nombre_producto_categoria'),
                'descripcion_producto_categoria' => $this->request->getPost('descripcion_producto_categoria'),
                'cantidad_producto_categoria' => $this->request->getPost('cantidad_producto_categoria'),
                'stock_minimo_producto_categoria' => $this->request->getPost('stock_minimo_producto_categoria')
            ];

            // Verificar si el nombre del producto_categoria ya existe (except o el actual)
            $opcion = $tabla_producto_categoria->existe_nombre_excepto_actual($producto_categoria['nombre_producto_categoria'], $id_producto_categoria);
            if ($opcion == 2 || $opcion == -100) {
                mensaje("El nombre del producto_categoria ya está en uso.", WARNING_ALERT, "¡Nombre en uso!");
                return $this->index($id_producto_categoria);
            }

            try {
                // Actualizar información del producto_categoria
                $tabla_producto_categoria->update($id_producto_categoria, $producto_categoria);

                mensaje("El producto_categoria ha sido actualizado exitosamente", SUCCESS_ALERT, "¡Actualización exitosa!");
                return redirect()->to(route_to('detalles_producto_categoria', $id_producto_categoria));
            } catch (\Exception $e) {
                mensaje("Hubo un error al actualizar el producto_categoria. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al actualizar!");
                return redirect()->to(route_to('detalles_producto_categoria', $id_producto_categoria));
            }
        } else {
            return $this->index();
        }
    }
}//End Class Usuario_detalles
