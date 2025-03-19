<?php

namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;

class Register extends BaseController
{

    public function index()
    {


        $session = session();

        if ($session->has('rol_actual')) {
            $rol_actual = $session->get('rol_actual')['clave'];

            // Redirigir según el rol del usuario
            switch ($rol_actual) {
                case ROL_SUPERADMIN['clave']:
                    $session->set("tarea_actual", TAREA_SUPERADMIN_DASHBOARD);
                    return redirect()->to(route_to('dashboard_superadmin'));
                case ROL_ADMIN['clave']:
                    $session->set("tarea_actual", TAREA_ADMIN_DASHBOARD);
                    return redirect()->to(route_to('dashboard_admin'));
                case ROL_TRABAJADOR['clave']:
                    $session->set("tarea_actual", TAREA_TRABAJADOR_DASHBOARD);
                    return redirect()->to(route_to('dashboard_trabajador'));
                case ROL_PACIENTE['clave']:
                    $session->set("tarea_actual", TAREA_PACIENTE_RESERVAR_CITA);
                    log_message('info', 'Redirigiendo a dashboard para el rol PSICOLOGO');
                    return redirect()->to(route_to('reservar_cita'));
                default:
                    return redirect()->to(route_to('login'))->with('error', 'Acceso no autorizado');
            }
        } else {
            // Si no hay rol definido, mostrar la vista de login
            return $this->crear_vista("usuarios/register");
        }
    }

    private function crear_vista($nombre_vista)
    {

        $datos['titulo_pag'] = 'Register';
        return view($nombre_vista, $datos);
    }

    public function registrar()
    {
        if ($this->request->getPost('sexo') == NULL) {
            mensaje("Debes seleccionar un sexo", WARNING_ALERT, "¡No se pudo registrar!");
            return $this->index();
        }

        $tabla_usuarios = new \App\Models\Tabla_usuarios;
        $tabla_personas = new \App\Models\Tabla_personas;
        $tabla_usuario_roles = new \App\Models\Tabla_usuario_roles;

        $ultimo_codigo = $tabla_personas->obtener_codigo_persona();

        if ($ultimo_codigo) {
            $numero = (int) substr($ultimo_codigo->codigo_persona, 1) + 1;
        } else {
            $numero = 1;
        }

        $codigo_persona = 'P' . str_pad($numero, 4, '0', STR_PAD_LEFT);

        $persona = [
            'nombre' => $this->request->getPost('nombre'),
            'ap_paterno' => $this->request->getPost('ap_paterno'),
            'ap_materno' => $this->request->getPost('ap_materno'),
            'sexo' => $this->request->getPost('sexo'),
            'correo' => $this->request->getPost('correo'),
            'id_tipo_persona' => 101, // Cambiado para usuario
            'codigo_persona' => $codigo_persona
        ];

        $usuario = [
            'contrasena' => hash('sha256', $this->request->getPost('confirm_password')),
            'estatus' => ESTATUS_HABILITADO
        ];

        $usuario_rol = [
            'id_rol' => 601 // Rol específico para usuarios
        ];

        $opcion = $tabla_personas->existe_email($persona['correo']);
        if ($opcion == 2 || $opcion == -100) {
            mensaje("El correo proporcionado ya está en uso.", WARNING_ALERT, "¡Correo en uso!");
            return $this->index();
        } else {

            try {
                $tabla_personas->insert($persona);
                $idPersona = $tabla_personas->insertID();
                $usuario['id_persona'] = $idPersona;

                $tabla_usuarios->insert($usuario);
                $idusuario = $tabla_usuarios->insertID();
                $usuario_rol['id_usuario'] = $idusuario;

                $tabla_usuario_roles->insert($usuario_rol);
                log_message('info', 'Usuario registrado');
                mensaje("Has sido registrado exitosamente.", SUCCESS_ALERT, "¡Registro exitoso!", 4000);
                return redirect()->to(route_to('usuario_login'));
            } catch (\Exception $e) {
                mensaje("Hubo un error al registrarte. Intente nuevamente, por favor", DANGER_ALERT, "¡Error al registrar!");
                return $this->index();
            }
        }
    }
}
