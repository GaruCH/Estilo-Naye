<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Categoria_detalles extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_CATEGORIA_DETALLES, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_CATEGORIA_DETALLES;
        } //end else rol permitido
    } //end constructor

    public function index($id_categoria = 0)
    {
        if ($this->permitido) {
            $tabla_categorias = new \App\Models\Tabla_categorias;

            $categoria = $tabla_categorias->obtener_categoria($id_categoria);
            if ($categoria == NULL) {
                mensaje('No se encuentra la categoría proporcionada.', WARNING_ALERT, '¡categoría no encontrada!');
                return redirect()->to(route_to('administracion_categorias'));
            } else {

                return $this->crear_vista("panel/categoria_detalles", $this->cargar_datos($categoria));
            }
        } else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        }
    }


    private function cargar_datos($categoria = NULL)
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
        $datos['nombre_pagina'] = 'Detalles Categoría';
        //Cargar modelos
        $datos['categoria'] = $categoria;

        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'Categorías',
                'href' => route_to('administracion_categorias'),
                'extra' => ''
            ),
            array(
                'tarea' => 'Detalles Categoría',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Detalles de la categoría: <b>' . $categoria->nombre_categoria . '</b>');

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
            $id_categoria = $this->request->getPost('id_categoria');

            if ($this->request->getPost('nombre_categoria') == NULL) {
                mensaje("Debes proporcionar un nombre para la categoría", DANGER_ALERT, "¡No se pudo actualizar!");
                return $this->index($id_categoria);
            }

            $tabla_categorias = new \App\Models\Tabla_categorias;

            $categoria = [
                'nombre_categoria' => $this->request->getPost('nombre_categoria'),
                'descripcion_categoria' => $this->request->getPost('descripcion'),
            ];

            // Verificar si el nombre de la categoria ya existe (except o el actual)
            $opcion = $tabla_categorias->existe_nombre_excepto_actual($categoria['nombre_categoria'], $id_categoria);
            if ($opcion == 2 || $opcion == -100) {
                mensaje("El nombre de la categoría ya está en uso.", WARNING_ALERT, "¡Nombre en uso!");
                return $this->index($id_categoria);
            }

            try {
                // Actualizar información de la categoria
                $tabla_categorias->update($id_categoria, $categoria);

                mensaje("La categoría ha sido actualizada exitosamente", SUCCESS_ALERT, "¡Actualización exitosa!");
                return redirect()->to(route_to('detalles_categoria', $id_categoria));
            } catch (\Exception $e) {
                mensaje("Hubo un error al actualizar la categoría. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al actualizar!");
                return redirect()->to(route_to('detalles_categoria', $id_categoria));
            }
        } else {
            return $this->index();
        }
    }
}//End Class Usuario_detalles
