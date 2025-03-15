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
            ->select('productos.nombre_producto, productos.descripcion_producto, categorias.nombre_categoria, categorias.descripcion_categoria,
            producto_categoria.id_producto,  producto_categoria.id_categoria ')
            ->join('categorias', 'producto_categoria.id_categoria = categorias.id_categoria')
            ->join('productos', 'producto_categoria.id_producto = productos.id_producto')
            ->orderBy('productos.nombre_producto', 'ASC')
            ->findAll();

        return $resultado;
    } //end datatable_producto_categoria

    public function obtener_producto_categoria($id_producto = 0, $id_categoria = 0)
    {
        $resultado = $this
            ->select('productos.nombre_productos, productos.id_producto, categorias.id_categoria')
            ->join('categorias', 'producto_categoria.id_categoria = categorias.id_categoria')
            ->join('productos', 'producto_categoria.id_producto = productos.id_producto')
            ->where('producto_categoria.id_producto', $id_producto)
            ->where('producto_categoria.id_categoria', $id_categoria)
            ->first();
        return $resultado;
    } //end obtener_producto_categoria

    public function obtener_categorias_asignadas($id_producto = 0)
    {
        $resultado = $this
            ->select('categorias.id_categoria')
            ->join('categorias', 'producto_categoria.id_categoria = categorias.id_categoria')
            ->where('producto_categoria.id_producto', $id_producto)
            ->findAll();
            return $resultado;
    }
}//End Model producto_categorias
