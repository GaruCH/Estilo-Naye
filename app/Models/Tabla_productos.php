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
