<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_productos extends Model
{
    protected $table      = 'productos';
    protected $primaryKey = 'id_producto';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_producto',
        'nombre_producto',
        'descripcion_producto',
        'estatus_producto',
        'cantidad_producto',
        'stock_minimo_producto',
        'eliminacion'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'creacion';
    protected $updatedField  = 'actualizacion';
    protected $deletedField  = 'eliminacion';

    public function datatable_productos($rol_actual = 0)
    {
        if ($rol_actual == ROL_SUPERADMIN['clave']) {
            $resultado = $this
                ->select('id_producto, nombre_producto, descripcion_producto, estatus_producto, cantidad_producto, stock_minimo_producto, eliminacion')
                ->orderBy('nombre_producto', 'ASC')
                ->withDeleted()
                ->findAll();
        } //end if el rol actual es superadmin
        else {
            $resultado = $this
            ->select('id_producto, nombre_producto, descripcion_producto, estatus_producto, cantidad_producto, stock_minimo_producto')
            ->orderBy('nombre_producto', 'ASC')
            ->withDeleted()
            ->findAll();
        } //end else el rol actual es superadmin
        return $resultado;
    } //end datatable_productos

    public function obtener_producto($id_producto = 0)
    {
        $resultado = $this
            ->select('id_producto, nombre_producto, descripcion_producto, cantidad_producto, stock_minimo_producto')
            ->where('id_producto', $id_producto)
            ->first();
        return $resultado;
    } //end obtener_producto


    public function existe_nombre_excepto_actual($nombre = NULL, $id_producto = 0)
    {
        $resultado = $this
            ->select('id_producto, nombre_producto, eliminacion')
            ->where('nombre_producto', $nombre)
            ->withDeleted()
            ->first();
        $opcion = -1;
        if ($resultado != NULL) {
            if ($resultado->id_producto == $id_producto) {
                $opcion = -1;
            } //end if producto encontrado es el actual
            else {
                if ($resultado->eliminacion == null) {
                    $opcion = 2;
                } //end if nombre no eliminado
                else {
                    $opcion = -100;
                } //end else
            } //end else producto encontrado es el actual
        } //end if existe registro

        return $opcion;
    } //end existe_nombre_excepto_actual

}//End Model productos
