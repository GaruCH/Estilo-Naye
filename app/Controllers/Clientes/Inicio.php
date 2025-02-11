<?php

namespace App\Controllers\Clientes;
use App\Controllers\BaseController;

class Inicio extends BaseController
{
    public function index(): string
    {
        
        return $this->crear_vista("clientes/index");
    }

    private function crear_vista($nombre_vista){

        $datos['titulo_pag'] = 'Inicio';
        return view($nombre_vista, $datos);
    }
}