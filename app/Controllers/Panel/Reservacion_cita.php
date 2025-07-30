<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Reservacion_cita extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_PACIENTE_RESERVAR_CITA, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_PACIENTE_RESERVAR_CITA;
        } //end else rol permitido
    } //end constructor

    public function index()
    {
        if ($this->permitido) {
            return $this->crear_vista("panel/reservar_cita", $this->cargar_datos());
        } //end if rol permitido
        else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        } //end else rol no permitido
    } //end index

    private function cargar_datos()
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
        $datos['nombre_pagina'] = 'Nueva Cita';
        //Cargar modelos

        $tabla_servicios = new \App\Models\Tabla_servicios;
        $datos['servicios'] = $tabla_servicios->obtener_servicios();

        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'Reservar cita',
                'href' => route_to('reservar_cita'),
                'extra' => ''
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Reservar cita');

        return $datos;
    } //end cargar_datos

    /*
	private function enviar_registro_usuario($email = NULL, $usuario = array(), $password_usuario = NULL) {
		$configuracion_correo = array();
		$configuracion_correo['asunto'] = 'Información de registro';
		$configuracion_correo['background_header'] = '#542772;';
		$configuracion_correo['logo'] = base_url(IMG_DIR_SISTEMA.'/'.LOGO_SISTEMA);
		$configuracion_correo['usuario'] = $usuario;
		$configuracion_correo['password'] = $password_usuario;
		$configuracion_correo['rol_usuario'] = ROLES[$usuario["id_rol"]];
		$configuracion_correo['header'] = 'Datos Generales del Usuario';
		$configuracion_correo['descripcion'] = 'Te proporcionamos tus credenciales de acceso al SiAdCJM.';
		$configuracion_correo['acronimo_sistema'] = ACRONIMO_SISTEMA;
		$plantilla_email = view('plantilla/email_base', $configuracion_correo);
		return enviar_correo_individual(CORREO_EMISOR_SISTEMA, ACRONIMO_SISTEMA , $email, $configuracion_correo['asunto'], $plantilla_email);
	}//end enviar_registro_usuario
		*/
    private function crear_vista($nombre_vista, $contenido = array())
    {
        $contenido['menu'] = crear_menu_panel();
        return view($nombre_vista, $contenido);
    } //end crear_vista


     public function registrar()
    {
        if ($this->permitido) {
            $tabla_citas = new \App\Models\Tabla_citas;

            // Validar que los campos obligatorios no estén vacíos
           $session = session();
            if (
                
                $this->request->getPost('id_servicio') == NULL ||
                $this->request->getPost('fecha_cita') == NULL ||
                $this->request->getPost('hora_cita') == NULL
            ) {
                mensaje("Todos los campos son obligatorios", DANGER_ALERT, "¡Campos incompletos!");
                return $this->index();
            }

            $cita = [
                'id_persona'   =>  $session -> id_persona,
                'id_servicio'   => $this->request->getPost('id_servicio'),
                'fecha_cita'    => $this->request->getPost('fecha_cita'),
                'hora_cita'     => $this->request->getPost('hora_cita'),
                'estado_cita'   => 1,
            ];
            try {

                $tabla_citas->insert($cita);

                mensaje("La cita ha sido registrada exitosamente.", SUCCESS_ALERT, "¡Registro exitoso!");
                return redirect()->to(route_to('reservar_cita'));
            } catch (\Exception $e) {
                mensaje("Hubo un error al registrar la cita. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al registrar!");
                return $this->index();
            }
        } else {
            return $this->index();
        }
    }
}//End Class Cita_nuevo
