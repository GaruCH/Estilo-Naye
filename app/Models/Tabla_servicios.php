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

    public function obtener_servicio($id_servicio = 0)
    {
        $resultado = $this
            ->select('id_servicio, nombre_servicio, descripcion_servicio, precio_servicio')
            ->where('id_servicio', $id_servicio)
            ->first();
        return $resultado;
    } //end obtener_servicio

    public function existe_nombre_excepto_actual($nombre = NULL, $id_servicio = 0)
    {
        $resultado = $this
            ->select('id_servicio, nombre_servicio, eliminacion')
            ->where('nombre_servicio', $nombre)
            ->withDeleted()
            ->first();
        $opcion = -1;
        if ($resultado != NULL) {
            if ($resultado->id_servicio == $id_servicio) {
                $opcion = -1;
            } //end if servicio encontrado es el actual
            else {
                if ($resultado->eliminacion == null) {
                    $opcion = 2;
                } //end if nombre no eliminado
                else {
                    $opcion = -100;
                } //end else
            } //end else servicio encontrado es el actual
        } //end if existe registro

        return $opcion;
    } //end existe_nombre_excepto_actual


}//End Model servicios
