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
        'eliminacion'
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
                ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, citas.estado_cita, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio, citas.eliminacion')
                ->join('personas', 'citas.id_persona = personas.id_persona')
                ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
                ->orderBy('citas.fecha_cita', 'DESC')
                ->withDeleted()
                ->findAll();
        } //end if el rol actual es superadmin
        else {
            $resultado = $this
                ->select('citas.id_cita, citas.fecha_cita, citas.hora_cita, citas.estado_cita, personas.nombre, personas.ap_paterno,
                personas.ap_materno, servicios.nombre_servicio')
                ->join('personas', 'citas.id_persona = personas.id_persona')
                ->join('servicios', 'citas.id_servicio = servicios.id_servicio')
                ->orderBy('citas.fecha_cita', 'DESC')
                ->findAll();
        } //end else el rol actual es superadmin
        return $resultado;
    } //end datatable_usuarios

    public function obtener_usuario($id_usuario = 0)
    {
        $resultado = $this
            ->select('usuarios.id_usuario, personas.id_persona, personas.nombre, personas.ap_paterno, personas.ap_materno,
                            personas.sexo, personas.correo, personas.imagen, usuario_roles.id_rol')
            ->join('personas', 'usuarios.id_persona = personas.id_persona')
            ->join('usuario_roles', 'usuarios.id_usuario = usuario_roles.id_usuario')
            ->where('usuarios.id_usuario', $id_usuario)
            ->first();
        return $resultado;
    } //end obtener_usuario


}//End Model usuarios
