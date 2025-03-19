<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Perfil extends BaseController
{
	private $permitido = true;

	public function __construct()
	{
		$session = session();
		if (!Permisos::is_rol_permitido(TAREA_PERFIL, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
			$this->permitido = false;
		} //end if rol no permitido
		else {
			$session->tarea_actual = TAREA_PERFIL;
		} //end else rol permitido
	} //end constructor

	public function index()
	{
		if ($this->permitido) {
			return $this->crear_vista("panel/perfil", $this->cargar_datos());
		} //end if rol permitido
		else {
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
		$datos['nombre_pagina'] = 'Mi Perfil';
		//Cargar Modelos
		$tabla_personas = new \App\Models\Tabla_usuarios;
		$datos['usuario'] = $tabla_personas->obtener_usuario($session->id_usuario);

		//Breadcrumb
		$navegacion = array(
			array(
				'tarea' => 'Mi Perfil',
				'href' => '#'
			)
		);
		$datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Mi Perfil: <b>' . $session->nombre_completo_usuario . '</b>');

		return $datos;
	} //end cargar_datos

	private function crear_vista($nombre_vista, $contenido = array())
	{
		$contenido['menu'] = crear_menu_panel();
		return view($nombre_vista, $contenido);
	} //end crear_vista

	public function actualizar()
	{
		if ($this->permitido) {
			$tabla_personas = new \App\Models\Tabla_personas;
			$id_persona = session()->id_usuario;
			$persona = array();

			$persona_in_db = $tabla_personas->select('imagen')->find($id_persona);
			if (!empty($this->request->getFile('imagen_perfil')) && $this->request->getFile('imagen_perfil')->getSize() > 0) {
				helper('upload_files');
				$archivo = $this->request->getFile('imagen_perfil');

				if ($persona_in_db->imagen != NULL) {
					erase_file($persona_in_db->imagen, IMG_DIR_USUARIOS);
				} //end if se debe eliminar imagen

				$persona['imagen'] = upload_image($archivo, '', IMG_DIR_USUARIOS, 512, 512, 2097152);
			} //end if existe imagen
			if ($tabla_personas->update($id_persona, $persona)) {

				$session = session();
				if (isset($persona['imagen'])) {
					$session->imagen_usuario = $persona['imagen'];
				} //end if se cambia la foto de perfil
				$session = null;
				mensaje("Tus datos han sido actualizados exitosamente", SUCCESS_ALERT, "¡Actualización Del Perfil Exitosa!");
				return redirect()->to(route_to('mi_perfil'));
			} //end if se actualiza el perfil
			else {
				mensaje("Hubo un error al actualizar tu perfil. Intente nuevamente, por favor", DANGER_ALERT, "¡Error Al Actualizar Perfil!");
				return redirect()->to(route_to('mi_perfil'));
			} //end else se actualiza el perfil

		} //end if es un persona permitido
		else {
			return $this->index();
		} //end else es un persona permitido
	} //end actualizar

}//end Class Perfil
