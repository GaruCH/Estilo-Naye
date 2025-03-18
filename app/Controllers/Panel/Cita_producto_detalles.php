<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;

class Cita_producto_detalles extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_CITA_PRODUCTO_DETALLES, isset($session->rol_actual['clave']) ? $session->rol_actual['clave'] : -1)) {
            $this->permitido = false;
        } //end if rol no permitido
        else {
            $session->tarea_actual = TAREA_CITA_PRODUCTO_DETALLES;
        } //end else rol permitido
    } //end constructor

    public function index($id_cita = 0)
    {
        if ($this->permitido) {
            $tabla_citas_productos = new \App\Models\Tabla_citas_productos;

            $citas_producto = $tabla_citas_productos->obtener_cita_producto($id_cita);
            if ($citas_producto == NULL) {
                mensaje('No se encuentra el historial proporcionado.', WARNING_ALERT, '¡historial no encontrado!');
                return redirect()->to(route_to('administracion_citas_productos'));
            } else {

                return $this->crear_vista("panel/historial_producto_detalles", $this->cargar_datos($citas_producto, $id_cita));
            }
        } else {
            mensaje('No tienes permisos para acceder a esta sección.', DANGER_ALERT, '¡Acceso no autorizado!');
            return redirect()->to(route_to('login'));
        }
    }


    private function cargar_datos($citas_producto = NULL, $id = 0)
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
        $datos['nombre_pagina'] = 'Detalles citas_producto';
        //Cargar modelos
        $datos['cita'] = $citas_producto;

        $tabla_personas = new \App\Models\Tabla_personas;
        $datos['personas'] = $tabla_personas->obtener_personas();

        $tabla_productos = new \App\Models\Tabla_productos;
        $datos['productos'] = $tabla_productos->obtener_productos();

        $tabla_citas = new \App\Models\Tabla_citas_productos;

        $datos['productos_cita'] = $tabla_citas->obtener_productos_cita($id);
        //Breadcrumb
        $navegacion = array(
            array(
                'tarea' => 'Citas_productos',
                'href' => route_to('administracion_citas_productos'),
                'extra' => ''
            ),
            array(
                'tarea' => 'Detalles citas_productos',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb_panel($navegacion, 'Detalles del historial: <b>' . $id . '</b>');

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
            $id_citas_producto = $this->request->getPost('id_citas_productos');
            $id_cita = $this->request->getPost('id_cita'); // Obtener el ID de la cita
            $id_productos = $this->request->getPost('productos'); // Array de IDs de productos
            $unidades = $this->request->getPost('unidades'); // Array de unidades

            // Validar que hay productos y unidades
            if (empty($id_productos) || empty($unidades) || !$id_cita) {
                mensaje("Debes seleccionar al menos un producto y una cantidad válida.", DANGER_ALERT, "¡Datos incompletos!");
                return $this->index($id_citas_producto);
            }

            // Instancia del modelo
            $tabla_citas_productos = new \App\Models\Tabla_citas_productos;
            $db = \Config\Database::connect();
            $db->transStart(); // Iniciar transacción

            try {
                // Primero, eliminar los productos previos de esa cita
                $tabla_citas_productos->where('id_cita', $id_cita)->delete();

                // Insertar los nuevos productos
                foreach ($id_productos as $index => $id_producto) {
                    $unidad = $unidades[$index] ?? 0;

                    // Validar datos
                    if ($id_producto && $unidad > 0) {
                        $citas_producto = [
                            'id_cita' => $id_cita, // Ahora lo asignamos correctamente
                            'id_producto' => $id_producto,
                            'unidad' => $unidad
                        ];

                        $tabla_citas_productos->insert($citas_producto);
                    }
                }

                // Confirmar la transacción
                $db->transComplete();

                if ($db->transStatus() === false) {
                    throw new \Exception("Error al actualizar el historial de productos.");
                }

                mensaje("El historial de productos ha sido actualizado exitosamente.", SUCCESS_ALERT, "¡Actualización exitosa!");
                return redirect()->to(route_to('historial_citas_productos'));
            } catch (\Exception $e) {
                $db->transRollback();
                mensaje("Hubo un error al actualizar el historial de productos. Intente nuevamente.", DANGER_ALERT, "¡Error al actualizar!");
                return redirect()->to(route_to('historial_citas_productos'));
            }
        } else {
            return $this->index();
        }
    }
}//End Class Usuario_detalles
