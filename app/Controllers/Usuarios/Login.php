<?php

namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;

class Login extends BaseController
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
                    return redirect()->to( route_to('dashboard_superadmin'));
                case ROL_ADMIN['clave']:
                    $session->set("tarea_actual", TAREA_ADMIN_DASHBOARD);
                    return redirect()->to(route_to('dashboard_admin'));
                case ROL_TRABAJADOR['clave']:
                    $session->set("tarea_actual", TAREA_TRABAJADOR_DASHBOARD);
                    return redirect()->to(route_to('dashboard_trabajador'));
                default:
                    return redirect()->to(route_to('usuario_login'))->with('error', 'Acceso no autorizado');
            }
        } else {
            // Si no hay rol definido, mostrar la vista de login
            return $this->crear_vista("usuarios/login");
        }

    }

    private function crear_vista($nombre_vista)
    {

        $datos['titulo_pag'] = 'Login';
        return view($nombre_vista, $datos);
    }


    public function comprobar()
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $tabla_usuarios = new \App\Models\Tabla_usuarios;
        $usuario = $tabla_usuarios->login($email, hash("sha256", $password));


        if ($usuario != null) {
            log_message('info', 'Usuario encontrado: ' . $usuario->nombre);

            if ($usuario->estatus_usuario == ESTATUS_DESHABILITADO) {
                mensaje('El usuario no está habilitado, por favor contacte al administrador.', WARNING_ALERT, '¡Usuario inhabilitado!');
                log_message('info', 'Usuario deshabilitado: ' . $email);
                return redirect()->to(route_to('login'));
            }

            $session = session();
            $session->set("sesion_iniciada", TRUE);
            $session->set("id_usuario", $usuario->id_usuario);
            $session->set("nombre_usuario", $usuario->nombre);
            $session->set("nombre_completo_usuario", $usuario->nombre . ' ' . $usuario->ap_paterno . ' ' . $usuario->ap_materno);
            $session->set("sexo_usuario", $usuario->sexo);
            $session->set("email_usuario", $usuario->correo);
            $session->set("imagen_usuario", $usuario->imagen);
            $session->set("rol_actual", array('nombre' => $usuario->nombre_rol, 'clave' => $usuario->clave_rol));

            // Redirigir según el rol del usuario
            switch ($usuario->clave_rol) {
                case ROL_SUPERADMIN['clave']:
                    $session->set("tarea_actual", TAREA_SUPERADMIN_DASHBOARD);
                    log_message('info', 'Redirigiendo a dashboard para el rol SUPERADMIN');
                    return redirect()->to(route_to('dashboard_superadmin'));
                case ROL_ADMIN['clave']:
                    $session->set("tarea_actual", TAREA_ADMIN_DASHBOARD);
                    log_message('info', 'Redirigiendo a dashboard para el rol ADMIN');
                    return redirect()->to(route_to('dashboard_admin'));
                case ROL_TRABAJADOR['clave']:
                    $session->set("tarea_actual", TAREA_TRABAJADOR_DASHBOARD);
                    log_message('info', 'Redirigiendo a dashboard_psicologo para el rol PSICOLOGO');
                    return redirect()->to(route_to('dashboard_trabajador'));
                default:
                    log_message('info', 'Redirigiendo al login');
                    return redirect()->to(route_to('usuario_login'));
            }

            if ($usuario->sexo == SEXO_MASCULINO)
                mensaje('Bienvenido a la ' . NOMBRE_SISTEMA, INFO_ALERT, '¡Hola ' . $session->nombre . '!', 3500);
            else
                mensaje('Bienvenida a la ' . NOMBRE_SISTEMA, INFO_ALERT, '¡Hola ' . $session->nombre . '!', 3500);

            log_message('info', 'Redirigiendo según el rol del usuario: ' . $usuario->clave_rol);
        } else {
            mensaje('Tu correo y/o contraseña son incorrectos. Intenta nuevamente, por favor.', DANGER_ALERT, '¡Credenciales incorrectas!', 3500);
            log_message('info', 'Credenciales incorrectas para el email: ' . $email);
            return redirect()->to(route_to('usuario_login'));
        }
    }
}
