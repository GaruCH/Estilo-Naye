<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_producto_categoria extends Model
{
    protected $table      = 'producto_categoria';
    protected $primaryKey = 'id_producto';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_producto',
        'id_categoria'
    ];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;

    //protected $createdField  = 'creacion';
    //protected $updatedField  = 'actualizacion';
    //protected $deletedField  = 'eliminacion';

    public function datatable_producto_categoria()
    {

        $resultado = $this
            ->select('productos.nombre_producto, productos.descripcion_producto, categorias.nombre_categoria, categorias.descripcion_categoria')
            ->join('categorias', 'producto_categoria.id_categoria = categorias.id_categoria')
            ->join('productos', 'producto_categoria.id_producto = productos.id_producto')
            ->orderBy('productos.nombre_producto', 'ASC')
            ->findAll();

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
