<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_servicios extends Model
{
    protected $table      = 'servicios';
    protected $primaryKey = 'id_servicio';
    protected $returnType = 'object';
    protected $allowedFields = [
        'estatus_servicio',
        'id_servicio',
        'nombre_servicio',
        'precio_servicio',
        'descripcion_servicio',
        'eliminacion',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'creacion';
    protected $updatedField  = 'actualizacion';
    protected $deletedField  = 'eliminacion';

    public function datatable_servicios($rol_actual = 0)
    {
        if ($rol_actual == ROL_SUPERADMIN['clave']) {
            $resultado = $this
                ->select('id_servicio, nombre_servicio, descripcion_servicio, precio_servicio, estatus_servicio, eliminacion')
                ->orderBy('nombre_servicio', 'ASC')
                ->withDeleted()
                ->findAll();
        } //end if el rol actual es superadmin
        else {
            $resultado = $this
            ->select('id_servicio, nombre_servicio, descripcion_servicio, precio_servicio, estatus_servicio')
            ->orderBy('nombre_servicio', 'ASC')
            ->withDeleted()
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
