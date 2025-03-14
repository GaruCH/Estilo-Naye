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
            ->select('citas_productos.id_citas_productos, citas_productos.unidad, productos.nombre_producto, citas.fecha_cita
            , personas.nombre')
            ->join('citas','citas_productos.id_cita = citas.id_cita')
            ->join('productos','citas_productos.id_producto = productos.id_producto')
            ->join('personas','citas.id_persona = personas.id_persona')
            ->orderBy('citas.fecha_cita', 'DESC')
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
