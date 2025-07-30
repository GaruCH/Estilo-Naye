<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Permisos;
use App\Models\Tabla_citas;

class Dashboard extends BaseController
{
    private $permitido = true;

    public function __construct()
    {
        $session = session();
        if (!Permisos::is_rol_permitido(TAREA_SUPERADMIN_DASHBOARD, $session->rol_actual['clave'] ?? -1)) {
            $this->permitido = false;
        } else {
            $session->tarea_actual = TAREA_SUPERADMIN_DASHBOARD;
        }
    }

    public function index()
    {
        if (!$this->permitido) {
            return redirect()->to(route_to('login'));
        }

        $datos = $this->cargar_datos();
        $datos['eventos'] = $this->obtener_eventos();

        return $this->crear_vista("panel/dashboard", $datos);
    }

    private function cargar_datos()
    {
        $datos = [];
        $session = session();

        // Datos de sesión
        $datos['nombre_completo_usuario'] = $session->nombre_completo_usuario;
        $datos['email_usuario'] = $session->email_usuario;
        $datos['imagen_usuario'] = $session->imagen_usuario ?? 
            ($session->sexo_usuario == SEXO_MASCULINO ? 'no-image-m.png' : 'no-image-f.png');

        $datos['nombre_pagina'] = 'Dashboard';
        $datos['breadcrumb'] = '';

        $db = \Config\Database::connect();

        // Total de citas activas
        $datos['citas'] = $db->query("SELECT COUNT(*) AS total FROM citas WHERE eliminacion IS NULL")
                             ->getRow()
                             ->total;

        // Servicios más solicitados
        $servicios = $db->query("
            SELECT s.nombre_servicio, COUNT(c.id_cita) AS total
            FROM citas c
            JOIN servicios s ON c.id_servicio = s.id_servicio
            WHERE c.eliminacion IS NULL
            GROUP BY s.nombre_servicio
            ORDER BY total DESC
        ")->getResult();

        $datos['labels'] = [];
        $datos['totales'] = [];

        foreach ($servicios as $s) {
            $datos['labels'][] = $s->nombre_servicio;
            $datos['totales'][] = $s->total;
        }

        // Últimos registros (últimas citas recientes)
        $datos['ultimos_registros'] = $db->query("
            SELECT s.nombre_servicio, 
                   CONCAT(p.nombre, ' ', p.ap_paterno) AS nombre_persona,
                   c.fecha_cita,
                   c.hora_cita
            FROM citas c
            JOIN personas p ON c.id_persona = p.id_persona
            JOIN servicios s ON c.id_servicio = s.id_servicio
            WHERE c.eliminacion IS NULL
            ORDER BY c.fecha_cita DESC
            LIMIT 5
        ")->getResult();

        // Notificaciones
        $datos['notificaciones'] = $db->query("
            SELECT c.estado_cita, 
                   CONCAT(p.nombre, ' ', p.ap_paterno) AS nombre_persona,
                   c.fecha_cita
            FROM citas c
            JOIN personas p ON c.id_persona = p.id_persona
            WHERE c.eliminacion IS NULL
            ORDER BY c.fecha_cita DESC
            LIMIT 5
        ")->getResult();

        foreach ($datos['notificaciones'] as &$n) {
            switch ($n->estado_cita) {
                case 1:
                    $estado = 'Pendiente';
                    break;
                case 2:
                    $estado = 'Confirmada';
                    break;
                case -1:
                    $estado = 'Cancelada';
                    break;
                default:
                    $estado = 'Desconocido';
            }

            $n->mensaje = $n->nombre_persona . ' tiene una cita ' . strtolower($estado);
            $n->fecha = $n->fecha_cita;
        }

        // Eventos para el calendario (extra, por si lo usas en otro lugar)
        $datos['eventos_calendario'] = $db->query("
            SELECT c.fecha_cita,
                   c.hora_cita,
                   CONCAT(p.nombre, ' ', p.ap_paterno) AS title,
                   c.estado_cita 
            FROM citas c
            JOIN personas p ON c.id_persona = p.id_persona
            WHERE c.eliminacion IS NULL AND c.fecha_cita >= NOW()
            ORDER BY c.fecha_cita ASC
        ")->getResult();

        return $datos;
    }

    private function crear_vista($nombre_vista, $contenido = [])
    {
        $contenido['menu'] = crear_menu_panel();
        return view($nombre_vista, $contenido);
    }

    public function obtener_estadisticas_citas()
    {
        $tabla_citas = new Tabla_citas();

        $tabla_citas->resetQuery();
        $pendientes = $tabla_citas->where('estado_cita', 1)->where('eliminacion', null)->countAllResults();

        $tabla_citas->resetQuery();
        $confirmadas = $tabla_citas->where('estado_cita', 2)->where('eliminacion', null)->countAllResults();

        $tabla_citas->resetQuery();
        $canceladas = $tabla_citas->where('estado_cita', -1)->where('eliminacion', null)->countAllResults();

        $datos = [
            'pendientes' => $pendientes,
            'confirmadas' => $confirmadas,
            'canceladas' => $canceladas
        ];

        return $this->response->setJSON($datos);
    }

    private function obtener_eventos()
    {
        $modelo = new Tabla_citas();

        $citas = $modelo
            ->select('citas.fecha_cita, personas.nombre, personas.ap_paterno, servicios.nombre_servicio')
            ->join('personas', 'personas.id_persona = citas.id_persona')
            ->join('servicios', 'servicios.id_servicio = citas.id_servicio')
            ->findAll();

        $eventos = [];
        foreach ($citas as $cita) {
            $eventos[] = [
                'title' => $cita->nombre . ' ' . $cita->ap_paterno . ' - ' . $cita->nombre_servicio,
                'start' => $cita->fecha_cita
            ];
        }

        return json_encode($eventos);
    }
}
