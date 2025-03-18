<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_citas_productos extends Model
{
    protected $table      = 'citas_productos';
    protected $primaryKey = 'id_citas_productos';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_citas_productos',
        'id_cita',
        'id_producto',
        'unidad'
    ];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;

    //protected $createdField  = 'creacion';
    //protected $updatedField  = 'actualizacion';
    //protected $deletedField  = 'eliminacion';

    public function datatable_citas_productos()
    {
        $resultado = $this
            ->select([
                'citas.id_cita',
                'citas_productos.id_citas_productos',
                'personas.codigo_persona',
                'CONCAT(personas.nombre, " ", personas.ap_paterno, " ", personas.ap_materno) AS paciente',
                'GROUP_CONCAT(productos.nombre_producto ORDER BY productos.nombre_producto SEPARATOR ", ") AS productos',
                'GROUP_CONCAT(citas_productos.unidad ORDER BY productos.nombre_producto SEPARATOR ", ") AS cantidades',
                'citas.fecha_cita'
            ])
            ->join('citas', 'citas_productos.id_cita = citas.id_cita')
            ->join('personas', 'citas.id_persona = personas.id_persona')
            ->join('productos', 'citas_productos.id_producto = productos.id_producto', 'left')
            ->groupBy('citas.id_cita, personas.codigo_persona, paciente, citas.fecha_cita')
            ->orderBy('citas.fecha_cita', 'DESC')
            ->findAll();

        return $resultado;
    }


    public function obtener_cita_producto($id_cita = 0)
    {
        $resultado = $this
            ->select('
        citas.id_cita,
        citas.fecha_cita,
        personas.nombre,
        personas.ap_paterno,
        personas.ap_materno,
        personas.codigo_persona')
            ->join('citas', 'citas.id_cita = citas.id_cita')
            ->join('personas', 'citas.id_persona = personas.id_persona')
            ->where('citas.id_cita', $id_cita)
            ->first(); // Solo un resultado, ya que estamos buscando una cita específica
        return $resultado;
    }

    public function obtener_productos_cita($id_cita)
{
    $resultado = $this
        ->select('citas_productos.id_citas_productos,
                 citas_productos.unidad,
                 productos.nombre_producto,
                 citas_productos.id_producto')
        ->join('productos', 'citas_productos.id_producto = productos.id_producto', 'left')
        ->where('citas_productos.id_cita', $id_cita) 
        ->findAll();  // Obtener todos los productos asociados con la cita
    return $resultado;
}

}//End Model cita_productos
