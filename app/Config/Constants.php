<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code


//************************************************************************
//********************* CONSTANTES SISTEMA *******************************
//************************************************************************
//=================================SISTEMA======================================
define("ACRONIMO_SISTEMA", 'ENNS');
define("NOMBRE_SISTEMA", 'Estilo Naye Nails Studio');
define("BACKGROUND_SISTEMA", '');
define("FAV_ICON_SISTEMA", 'sin-fondo.png');
define("LOGO_SISTEMA", 'logo_naye.svg');
define("BACKGROUND_SISTEMA_LOGIN", '');


define('SMTP_PROTOCOL', 'smtp');
define('SMTP_HOST', 'smtp.ionos.mx');
define('SMTP_USER', 'developer_team@tiamlab.com');
define('SMTP_PASSWORD', 'So&lo.Ti-454M7a8.lbi40');
define('SMTP_PORT', 587);
define('SMTP_CRYPTO', 'tls');
define('SMTP_MAIL_TYPE', 'html');

define('CORREO_EMISOR_SISTEMA', 'developer_team@tiamlab.com');
define('COLOR_SISTEMA_INFO', '#009efb');
define('COLOR_SISTEMA_PRIMARY', '#7460ee');
define('COLOR_SISTEMA_SECONDARY', '#868e96');
define('COLOR_SISTEMA_SUCCESS', '#39c449');
define('COLOR_SISTEMA_WARNING', '#ffbc34');
define('COLOR_SISTEMA_DANGER', '#f62d51');

//ALERTAS
define("SUCCESS_ALERT", 1); //In JS The same
define("DANGER_ALERT", 2);  //In JS The same
define("INFO_ALERT", 3);    //In JS The same
define("WARNING_ALERT", 4); //In JS The same

//RUTAS BASE PANEL
define("RECURSOS_PANEL_CSS", "recursos_panel_monster/css");         //In JS = R_P_C
define("RECURSOS_PANEL_JS", "recursos_panel_monster/js");           //In JS = R_P_J
define("RECURSOS_PANEL_IMAGENES", "recursos_panel_monster/images"); //In JS = R_P_I
define("RECURSOS_PANEL_PLUGINS", "recursos_panel_monster/plugins"); //In JS = R_P_P

//=================================ESTATUS======================================
//Habilitado/Deshabilitado
define("ESTATUS_HABILITADO", 2);     //In JS = E_H
define("ESTATUS_DESHABILITADO", -1); //In JS = E_D

//DIRECTORIOS
define("IMG_DIR_USUARIOS", "recursos_panel_monster/images/profile-images"); //In JS = I_D_O
define("IMG_DIR_SISTEMA", "images/sistema"); //In JS = I_D_S
define("IMG_DIR_ICONOS", "images/iconos"); //In JS = I_D_I

define("_DIR_", ""); //In JS = 

//SEXOS
define("SEXO_FEMENINO", 1); //In JS = S_F
define("SEXO_MASCULINO", 2); //In JS = S_M


define("RECURSOS_CSS", "resource/css");
define("RECURSOS_IMG", "resource/images");
define("RECURSOS_JS", "resource/js");

//ROLES
define("ROL_SUPERADMIN",  array('nombre' => 'Superadmin',           'clave' => '901'));
define("ROL_ADMIN",       array('nombre' => 'Admininistrador',      'clave' => '801'));
define("ROL_TRABAJADOR",   array('nombre' => 'Trabajador',            'clave' => '701'));

define(
    "ROLES",
    array(
        ROL_SUPERADMIN["clave"] => ROL_SUPERADMIN["nombre"],
        ROL_ADMIN["clave"] => ROL_ADMIN["nombre"],
        ROL_TRABAJADOR["clave"] => ROL_TRABAJADOR["nombre"]
    )
);

//******************************************************************************
//***************************** PERMISOS DE LOS ROLES **************************
//******************************************************************************
// TAREA DASHBOARD
define("TAREA_SUPERADMIN_DASHBOARD", "tarea_superadmin_dashboard");

//TAREAS PROPIAS DEL USUARIO
define("TAREA_PERFIL", "tarea_perfil");
define("TAREA_PASSWORD", "tarea_password");

//TAREAS DE USUARIOS
define("TAREA_USUARIOS", "tarea_usuarios");
define("TAREA_USUARIO_NUEVO", "tarea_usuario_nuevo");
define("TAREA_USUARIO_DETALLES", "tarea_usuario_detalles");
define("TAREA_EJEMPLO", "tarea_ejemplo");


// TAREA DASHBOARD
define("TAREA_ADMIN_DASHBOARD", "tarea_admin_dashboard");

// TAREA SERVICIO

define("TAREA_SERVICIOS", "tarea_servicios");
define("TAREA_SERVICIO_NUEVO", "tarea_servicio_nuevo");
define("TAREA_SERVICIO_DETALLES", "tarea_servicio_detalles");

// TAREA CATEGORIAS

define("TAREA_CATEGORIAS", "tarea_categorias");
define("TAREA_CATEGORIA_NUEVO", "tarea_categoria_nuevo");
define("TAREA_CATEGORIA_DETALLES", "tarea_categoria_detalles");

// TAREA ASIGNACION CATEGORIAS

define("TAREA_PRODUCTOS_CATEGORIAS", "tarea_productos_categorias");
define("TAREA_PRODUCTOS_CATEGORIAS_DETALLES", "tarea_productos_categorias_detalles");
// TAREA PRODUCTOS

define("TAREA_PRODUCTOS", "tarea_productos");
define("TAREA_PRODUCTO_NUEVO", "tarea_producto_nuevo");
define("TAREA_PRODUCTO_DETALLES", "tarea_producto_detalles");

// TAREA CITAS

define("TAREA_CITAS", "tarea_citas");
define("TAREA_CITA_NUEVO", "tarea_citas_nuevo");
define("TAREA_CITA_DETALLES", "tarea_citas_detalles");

// TAREA CITAS_PRODUCTOS

define("TAREA_CITAS_PRODUCTOS", "tarea_cita_productos");
define("TAREA_CITA_PRODUCTO_NUEVO", "tarea_cita_producto_nuevo");
define("TAREA_CITA_PRODUCTO_DETALLES", "tarea_cita_producto_detalles");

// TAREA DASHBOARD
define("TAREA_TRABAJADOR_DASHBOARD", "tarea_trabajador_dashboard");

//******************************************************************************
//***************************** PERMISOS DE LOS ROLES **************************
//******************************************************************************
//PERMISOS SUPERADMIN
define(
    "PERMISOS_SUPERADMIN",
    array(
        TAREA_SUPERADMIN_DASHBOARD,
        TAREA_PERFIL,
        TAREA_PASSWORD,
        TAREA_USUARIOS,
        TAREA_USUARIO_NUEVO,
        TAREA_USUARIO_DETALLES,
        TAREA_EJEMPLO,
        TAREA_SERVICIOS,
        TAREA_SERVICIO_NUEVO,
        TAREA_SERVICIO_DETALLES,
        TAREA_CITAS,
        TAREA_CATEGORIAS,
        TAREA_CATEGORIA_NUEVO,
        TAREA_CATEGORIA_DETALLES,
        TAREA_PRODUCTOS,
        TAREA_PRODUCTO_NUEVO,
        TAREA_PRODUCTO_DETALLES,
        TAREA_CITAS_PRODUCTOS,
        TAREA_PRODUCTOS_CATEGORIAS,
        TAREA_PRODUCTOS_CATEGORIAS_DETALLES
    )
);

//PERMISOS SUPERADMIN
define(
    "PERMISOS_ADMIN",
    array(
        TAREA_ADMIN_DASHBOARD,
        TAREA_PERFIL,
        TAREA_PASSWORD,
        TAREA_USUARIOS,
        TAREA_USUARIO_NUEVO,
        TAREA_USUARIO_DETALLES,
        TAREA_EJEMPLO

    )
);

define(
    "PERMISOS_TRABAJADOR",
    array(TAREA_TRABAJADOR_DASHBOARD,
    )
);
