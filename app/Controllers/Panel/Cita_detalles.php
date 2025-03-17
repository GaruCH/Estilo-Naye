<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Cita_detalles extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_CITA_DETALLES, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_CITA_DETALLES;
        } //end else rol permitido
    } //end constructor

    public function index($id_cita = 0)
    {
        if ($this->permitido) {
            $tabla_citas = new \App\Models\Tabla_citas;

            $cita = $tabla_citas->obtener_cita($id_cita);
            if ($cita == NULL) {
                mensaje('No se encuentra la cita proporcionada.', WARNING_ALERT, '¡cita no encontrada!');
                return redirect()->to(route_to('administracion_citas'));
            } else {

                return $this->crear_vista("panel/cita_detalles", $this->cargar_datos($cita));
            }
        } else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        }
    }


    private function cargar_datos($cita = NULL)
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
        $datos['nombre_pagina'] = 'Detalles cita';
        //Cargar modelos
        $datos['cita'] = $cita;
        $tabla_personas = new \App\Models\Tabla_personas;
        $datos['personas'] = $tabla_personas->obtener_personas();

        $tabla_servicios = new \App\Models\Tabla_servicios;
        $datos['servicios'] = $tabla_servicios->obtener_servicios();
        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'Citas',
                'href' => route_to('administracion_citas'),
                'extra' => ''
            ),
            array(
                'tarea' => 'Detalles Cita',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Detalles de la cita: <b>' . $cita->id_cita . '</b>');

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
            $id_cita = $this->request->getPost('id_cita');

            // Validar que los campos requeridos estén presentes
            if ($this->request->getPost('fecha_cita') == NULL || $this->request->getPost('hora_cita') == NULL || $this->request->getPost('id_persona') == NULL || $this->request->getPost('id_servicio') == NULL) {
                mensaje("Todos los campos marcados con * son obligatorios.", DANGER_ALERT, "¡Campos incompletos!");
                return $this->index($id_cita);
            }

            $tabla_citas = new \App\Models\Tabla_citas;

            // Datos para actualizar la cita
            $cita = [
                'fecha_cita'   => $this->request->getPost('fecha_cita'),
                'hora_cita'    => $this->request->getPost('hora_cita'),
                'id_persona'   => $this->request->getPost('id_persona'),
                'id_servicio'  => $this->request->getPost('id_servicio'),
            ];

            try {
                // Actualizar información de la cita
                $tabla_citas->update($id_cita, $cita);

                mensaje("La cita ha sido actualizada exitosamente", SUCCESS_ALERT, "¡Actualización exitosa!");
                return redirect()->to(route_to('detalles_cita', $id_cita));
            } catch (\Exception $e) {
                mensaje("Hubo un error al actualizar la cita. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al actualizar!");
                return redirect()->to(route_to('detalles_cita', $id_cita));
            }
        } else {
            return $this->index();
        }
    }
}//End Class Usuario_detalles
