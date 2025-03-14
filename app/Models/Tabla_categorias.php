<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_categorias extends Model
{
    protected $table      = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_categoria',
        'nombre_categoria',
        'descripcion_categoria',
        'estatus_categoria',
        'eliminacion',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'creacion';
    protected $updatedField  = 'actualizacion';
    protected $deletedField  = 'eliminacion';

    public function datatable_categorias($rol_actual = 0)
    {
        if ($rol_actual == ROL_SUPERADMIN['clave']) {
            $resultado = $this
                ->select('id_categoria, nombre_categoria, descripcion_categoria, estatus_categoria, eliminacion')
                ->orderBy('nombre_categoria', 'ASC')
                ->withDeleted()
                ->findAll();
        } //end if el rol actual es superadmin
        else {
            $resultado = $this
            ->select('id_categoria, nombre_categoria, descripcion_categoria, estatus_categoria')
            ->orderBy('nombre_categoria', 'ASC')
            ->withDeleted()
            ->findAll();
        } //end else el rol actual es superadmin
        return $resultado;
    } //end datatable_categorias

    public function obtener_categoria($id_categoria = 0)
    {
        $resultado = $this
            ->select('id_categoria, nombre_categoria, descripcion_categoria')
            ->where('categorias.id_categoria', $id_categoria)
            ->first();
        return $resultado;
    } //end obtener_categoria

    public function existe_nombre_excepto_actual($nombre = NULL, $id_categoria = 0)
    {
        $resultado = $this
            ->select('id_categoria, nombre_categoria, eliminacion')
            ->where('nombre_categoria', $nombre)
            ->withDeleted()
            ->first();
        $opcion = -1;
        if ($resultado != NULL) {
            if ($resultado->id_categoria == $id_categoria) {
                $opcion = -1;
            } //end if categoria encontrada es la actual
            else {
                if ($resultado->eliminacion == null) {
                    $opcion = 2;
                } //end if nombre no eliminado
                else {
                    $opcion = -100;
                } //end else
            } //end else categoria encontrada es la actual
        } //end if existe registro

        return $opcion;
    } //end existe_nombre_excepto_actual


}//End Model categorias
