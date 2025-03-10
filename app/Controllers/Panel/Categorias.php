<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Categorias extends BaseController
{
	private $permitido = true;

	public function __construct()
	{
		$session = session();
		if (!Permisos::is_rol_permitido(TAREA_CATEGORIAS, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
			$this->permitido = false;
		} //end if rol no permitido
		else {
			$session->tarea_actual = TAREA_CATEGORIAS;
		} //end else rol permitido
	} //end constructor

	public function index()
	{
		if ($this->permitido) {
			return $this->crear_vista("panel/categorias", $this->cargar_datos());
		} //end if rol permitido
		else {
			mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso No Autorizado!');
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
		$datos['nombre_pagina'] = 'Categorías';

		//Cargar modelos
		$tabla_categorias = new \App\Models\Tabla_categorias;
		$datos['categorias'] = $tabla_categorias->datatable_categorias($session->rol_actual['clave']);

		//Breadcrumb
		$navegacion = array(
			array(
				'tarea' => 'Categorías',
				'href' => '#'
			)
		);
		$datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Categorías');

		return $datos;
	} //end cargar_datos

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
	private function crear_vista($nombre_vista, $contenido = array())
	{
		$contenido['menu'] = crear_menu_panel();
		return view($nombre_vista, $contenido);
	} //end crear_vista

	public function estatus_categoria()
	{
		if ($this->permitido) {
			$tabla_categorias = new \App\Models\Tabla_categorias;
			if ($tabla_categorias->update($this->request->getPost('id'), array('estatus_categoria' => $this->request->getPost('estatus')))) {
				mensaje("Estatus actualizado exitosamente", SUCCESS_ALERT, "¡Estatus actualizado!");
				return $this->response->setJSON(['error' => 0]);
			} //end if se actualiza estatus
			else {
				mensaje("Hubo un error al actualizar el estatus, intenta nuevamente", DANGER_ALERT, "¡Error al actualizar el estatus!");
				return $this->response->setJSON(['error' => 1]);
			} //end else
		} //end if es un usuario permitido
		else {
			mensaje("Hubo un error al actualizar el estatus, intenta nuevamente", DANGER_ALERT, "¡Error al actualizar el estatus!");
			return $this->response->setJSON(['error' => 1]);
		} //end else es un usuario permitido
	} //end estatus

	public function eliminar_categoria()
	{
		if ($this->permitido) {
			$tabla_categorias = new \App\Models\Tabla_categorias;
			if ($tabla_categorias->delete($this->request->getPost('id'))) {
				mensaje("La categoría ha sido eliminada exitosamente", SUCCESS_ALERT, "¡Categoría eliminada!");
				return $this->response->setJSON(['error' => 0]);
			} //end if elimina
			else {
				mensaje("Hubo un error al eliminar la categoría, intenta nuevamente", DANGER_ALERT, "¡Error al eliminar!");
				return $this->response->setJSON(['error' => 1]);
			} //end else
		} //end if es un usuario permitido
		else {
			mensaje("Hubo un error al eliminar la categoría, intenta nuevamente", DANGER_ALERT, "¡Error al eliminar!");
			return $this->response->setJSON(['error' => 1]);
		} //end else es un usuario permitido
	} //end eliminar

	public function recuperar_categoria()
	{
		if ($this->permitido && (session()->rol_actual['clave'] == ROL_SUPERADMIN['clave'])) {
			$mensaje = array();
			$tabla_categorias = new \App\Models\Tabla_categorias();
			if ($tabla_categorias->update($this->request->getPost('id'), array('eliminacion' => NULL))) {
				$mensaje['mensaje'] = 'La categoría se encuentra de nuevo en los registros de la base de datos.';
				$mensaje['tipo_mensaje'] = SUCCESS_ALERT;
				$mensaje['titulo'] = '¡Registro recuperado!';

				$acciones = array();
				$acciones[] = 'window.location = "./administracion_categorias";';

				mensaje("La categoría ha sido recuperada exitosamente", SUCCESS_ALERT, "¡Categoría recuperada!");
				return $this->response->setJSON(['error' => 0, 'mensaje' => $mensaje, 'actions' => $acciones]);
			} //end if se recupera el registro
			else {
				$mensaje['mensaje'] = 'Hubo un error al intentar recuperar el registro, checa tu conexión a internet o intente nuevamente, por favor.';
				$mensaje['tipo_mensaje'] = DANGER_ALERT;
				$mensaje['titulo'] = '¡Error al recuperar el registro!';

				$acciones = array();
				mensaje("Hubo un error al intentar recuperar la categoría, intente de nuevo, por favor.", DANGER_ALERT, "¡Categoría no recuperada!");
				return $this->response->setJSON(['error' => -1, 'mensaje' => $mensaje, 'actions' => $acciones]);
			} //end else se recupera el registro
		} //end if es un usuario permitido
		else {
			return $this->response->setJSON(['error' => -1, 'mensaje' => array(), 'actions' => array()]);
		} //end else es un usuario permitido
	} //end recuperar_usuario
	
}//End Class Usuarios
