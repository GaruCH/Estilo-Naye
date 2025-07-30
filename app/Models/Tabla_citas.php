<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_citas extends Model
{
    protected $table      = 'citas';
    protected $primaryKey = 'id_cita';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_cita',
        'id_persona',
        'id_servicio',
        'fecha_cita',
        'hora_cita',
        'estado_cita',
        'eliminacion',
        'creacion',
        'actualizacion',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'creacion';
    protected $updatedField  = 'actualizacion';
    protected $deletedField  = 'eliminacion';

    public function datatable_citas($rol_actual = 0)
    {
        if ($rol_actual == ROL_SUPERADMIN['clave']) {
            $resultado = $this
                ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, citas.estado_cita, personas.codigo_persona, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio, citas.eliminacion')
                ->join('personas', 'citas.id_persona = personas.id_persona')
                ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
                ->where('citas.estado_cita', 1)
                ->orderBy('citas.fecha_cita', 'DESC')
                ->withDeleted()
                ->findAll();
        } //end if el rol actual es superadmin
        else {
            $resultado = $this
                ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, citas.estado_cita, personas.codigo_persona, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio')
                ->join('personas', 'citas.id_persona = personas.id_persona')
                ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
                ->where('citas.estado_cita', 1)
                ->orderBy('citas.fecha_cita', 'DESC')
                ->findAll();
        } //end else el rol actual es superadmin
        return $resultado;
    } //end datatable_citas

    public function obtener_cita($id_cita = 0)
    {
        $resultado = $this
            ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, personas.id_persona, personas.codigo_persona, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio, servicios.id_servicio')
            ->join('personas', 'citas.id_persona = personas.id_persona')
            ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
            ->where('citas.id_cita', $id_cita)
            ->first();
        return $resultado;
    } //end obtener_cita


    public function datatable_citas_canceladas()
    {

        $resultado = $this
            ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, citas.estado_cita, personas.codigo_persona, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio')
            ->join('personas', 'citas.id_persona = personas.id_persona')
            ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
            ->where('citas.estado_cita', value: -1)
            ->orderBy('citas.fecha_cita', 'DESC')
            ->findAll();

        return $resultado;
    } //end datatable_citas

    public function datatable_citas_confirmadas()
    {

        $resultado = $this
            ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, citas.estado_cita, personas.codigo_persona, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio')
            ->join('personas', 'citas.id_persona = personas.id_persona')
            ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
            ->where('citas.estado_cita', 2)
            ->orderBy('citas.fecha_cita', 'DESC')
            ->findAll();

        return $resultado;
    } //end datatable_citas

}//End Model citas
