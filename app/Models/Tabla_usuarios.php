<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_usuarios extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $returnType = 'object';
    protected $allowedFields = [
        'estatus_usuario',
        'id_usuario',
        'id_persona',
        'contrasena'
    ];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;

    //protected $createdField  = 'creacion';
    // protected $updatedField  = 'actualizacion';
    //protected $deletedField  = 'eliminacion';

    public function login($email = NULL, $password = NULL)
    {
        $resultado = $this
            ->select('usuarios.estatus_usuario, usuarios.id_usuario, personas.nombre, personas.ap_paterno,
        personas.ap_materno, personas.sexo, personas.correo, personas.imagen,
        usuario_roles.id_rol AS clave_rol, roles.nombre_rol')
            ->join('personas', 'usuarios.id_persona = personas.id_persona')
            ->join('usuario_roles', 'usuarios.id_usuario = usuario_roles.id_usuario')
            ->join('roles', 'usuario_roles.id_rol = roles.id_rol')
            ->where('personas.correo', $email)
            ->where('usuarios.contrasena', $password) // Ya encriptada antes de enviarla
            ->first();
        return $resultado;
    } //end login

    public function datatable_usuarios($id_usuario_actual = 0, $rol_actual = 0)
    {
        if ($rol_actual == ROL_SUPERADMIN['clave']) {
            $resultado = $this
                ->select('usuarios.estatus_usuario, usuarios.id_usuario, personas.nombre, personas.ap_paterno,
        personas.ap_materno, personas.sexo, personas.correo, personas.imagen, roles.nombre_rol, personas.eliminacion, usuarios.id_persona')
                ->join('personas', 'usuarios.id_persona = personas.id_persona')
                ->join('usuario_roles', 'usuarios.id_usuario = usuario_roles.id_usuario')
                ->join('roles', 'usuario_roles.id_rol = roles.id_rol')
                ->where('usuarios.id_usuario !=', $id_usuario_actual)
                ->orderBy('personas.nombre', 'ASC')
                ->withDeleted()
                ->findAll();
        } //end if el rol actual es superadmin
        else {
            $resultado = $this
                ->select('usuarios.estatus_usuario, usuarios.id_usuario, personas.nombre, personas.ap_paterno,
        personas.ap_materno, personas.sexo, personas.correo, personas.imagen, roles.nombre_rol, usuarios.id_persona')
                ->join('personas', 'usuarios.id_persona = personas.id_persona')
                ->join('usuario_roles', 'usuarios.id_usuario = usuario_roles.id_usuario')
                ->join('roles', 'usuario_roles.id_rol = roles.id_rol')
                ->where('usuarios.id_usuario !=', $id_usuario_actual)
                ->where('roles.id_rol !=', ROL_SUPERADMIN['clave'])
                ->where('roles.id_rol !=', ROL_ADMIN['clave'])
                ->orderBy('nombre', 'ASC')
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
