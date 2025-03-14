<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Servicio_detalles extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_SERVICIO_DETALLES, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_SERVICIO_DETALLES;
        } //end else rol permitido
    } //end constructor

    public function index($id_servicio = 0)
    {
        if ($this->permitido) {
            $tabla_servicios = new \App\Models\Tabla_servicios;

            $servicio = $tabla_servicios->obtener_servicio($id_servicio);
            if ($servicio == NULL) {
                mensaje('No se encuentra el servicio proporcionado.', WARNING_ALERT, '¡Servicio no encontrado!');
                return redirect()->to(route_to('administracion_servicios'));
            } else {

                return $this->crear_vista("panel/servicio_detalles", $this->cargar_datos($servicio));
            }
        } else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        }
    }


    private function cargar_datos($servicio = NULL)
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
        $datos['nombre_pagina'] = 'Detalles servicio';
        //Cargar modelos
        $datos['servicio'] = $servicio;

        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'Servicios',
                'href' => route_to('administracion_servicios'),
                'extra' => ''
            ),
            array(
                'tarea' => 'Detalles servicios',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Detalles del servicio: <b>' . $servicio->nombre_servicio . '</b>');

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
            $id_servicio = $this->request->getPost('id_servicio');

            if ($this->request->getPost('nombre_servicio') == NULL) {
                mensaje("Debes proporcionar un nombre para el servicio", DANGER_ALERT, "¡No se pudo actualizar!");
                return $this->index($id_servicio);
            }

            $tabla_servicios = new \App\Models\Tabla_servicios;

            $servicio = [
                'nombre_servicio' => $this->request->getPost('nombre_servicio'),
                'descripcion_servicio' => $this->request->getPost('descripcion'),
                'precio_servicio' => $this->request->getPost('precio')
            ];

            // Verificar si el nombre del servicio ya existe (except o el actual)
            $opcion = $tabla_servicios->existe_nombre_excepto_actual($servicio['nombre_servicio'], $id_servicio);
            if ($opcion == 2 || $opcion == -100) {
                mensaje("El nombre del servicio ya está en uso.", WARNING_ALERT, "¡Nombre en uso!");
                return $this->index($id_servicio);
            }

            try {
                // Actualizar información del servicio
                $tabla_servicios->update($id_servicio, $servicio);

                mensaje("El servicio ha sido actualizado exitosamente", SUCCESS_ALERT, "¡Actualización exitosa!");
                return redirect()->to(route_to('detalles_servicio', $id_servicio));
            } catch (\Exception $e) {
                mensaje("Hubo un error al actualizar el servicio. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al actualizar!");
                return redirect()->to(route_to('detalles_servicio', $id_servicio));
            }
        } else {
            return $this->index();
        }
    }
}//End Class Usuario_detalles
