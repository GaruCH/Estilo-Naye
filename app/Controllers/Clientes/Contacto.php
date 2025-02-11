<?php

namespace App\Controllers\Clientes;
use App\Controllers\BaseController;

class Contacto extends BaseController
{
    public function index(): string
    {
        
        return $this->crear_vista("clientes/contacto");
    }

    private function crear_vista($nombre_vista){

        $datos['titulo_pag'] = 'Contacto';
        return view($nombre_vista, $datos);
    }
}