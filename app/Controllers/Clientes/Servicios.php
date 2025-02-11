<?php

namespace App\Controllers\Clientes;
use App\Controllers\BaseController;

class Servicios extends BaseController
{
    public function index(): string
    {
        
        return $this->crear_vista("clientes/servicios");
    }

    private function crear_vista($nombre_vista){

        $datos['titulo_pag'] = 'Servicios';
        return view($nombre_vista, $datos);
    }
}