<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Usuario_nuevo extends BaseController
{
	private $permitido = true;

	public function __construct()
	{
		$session = session();
		if (!Permisos::is_rol_permitido(TAREA_USUARIO_NUEVO, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
			$this->permitido = false;
		} //end if rol no permitido
		else {
			$session->tarea_actual = TAREA_USUARIO_NUEVO;
		} //end else rol permitido
	} //end constructor

	public function index()
	{
		if ($this->permitido) {
			return $this->crear_vista("panel/usuario_nuevo", $this->cargar_datos());
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
		$datos['nombre_pagina'] = 'Nuevo usuario';
		//Cargar modelos
		$tabla_roles = new \App\Models\Tabla_roles;
		$datos['roles'] = $tabla_roles->obtener_roles($session->rol_actual['clave']);

		//Breadcrumb
		$navegacion = array(
			array(
				'tarea' => 'Usuarios',
				'href' => route_to('administracion_usuarios'),
				'extra' => ''
			),
			array(
				'tarea' => 'Nuevo usuario',
				'href' => '#'
			)
		);
		$datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Nuevo usuario');

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
			if ($this->request->getPost('sexo') == NULL) {
				mensaje("Debes seleccionar un sexo para el usuario", WARNING_ALERT, "¡No se pudo registrar!");
				return $this->index();
			}

			$tabla_usuarios = new \App\Models\Tabla_usuarios;
			$tabla_personas = new \App\Models\Tabla_personas;
			$tabla_usuario_roles = new \App\Models\Tabla_usuario_roles;

			$persona = [
				'nombre' => $this->request->getPost('nombre'),
				'ap_paterno' => $this->request->getPost('ap_paterno'),
				'ap_materno' => $this->request->getPost('ap_materno'),
				'sexo' => $this->request->getPost('sexo'),
				'correo' => $this->request->getPost('email'),
				'id_tipo_persona' => 201
			];

			$usuario = [
				'contrasena' => hash('sha256', $this->request->getPost('confirm_password')),
				'estatus' => ESTATUS_HABILITADO
			];

			$usuario_rol = [
				'id_rol' => $this->request->getPost('rol')
			];

			$opcion = $tabla_personas->existe_email($persona['correo']);
			if ($opcion == 2 || $opcion == -100) {
				mensaje("El correo proporcionado ya está en uso.", WARNING_ALERT, "¡Correo en uso!");
				return $this->index();
			} else {
				if (!empty($this->request->getFile('imagen_perfil')) && $this->request->getFile('imagen_perfil')->getSize() > 0) {
					helper('upload_files');
					$archivo = $this->request->getFile('imagen_perfil');
					$persona['imagen'] = upload_image($archivo, '', IMG_DIR_USUARIOS, 512, 512, 2097152);
				}

				try {
					$tabla_personas->insert($persona);
					$idPersona = $tabla_personas->insertID();
					$usuario['id_persona'] = $idPersona;

					$tabla_usuarios->insert($usuario);
					$idUsuario = $tabla_usuarios->insertID();
					$usuario_rol['id_usuario'] = $idUsuario;

					$tabla_usuario_roles->insert($usuario_rol); // Faltaba esta línea

					mensaje("El usuario ha sido registrado exitosamente.", SUCCESS_ALERT, "¡Registro exitoso!");
					return redirect()->to(route_to('administracion_usuarios'));
				} catch (\Exception $e) {
					mensaje("Hubo un error al registrar al usuario. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al registrar!");
					return $this->index();
				}
			}
		} else {
			return $this->index();
		}
	}
}//End Class Usuario_nuevo
