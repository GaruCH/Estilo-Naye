<?php

namespace App\Controllers\Clientes;
use App\Controllers\BaseController;

class Catalogo extends BaseController
{
    public function index(): string
    {
        
        return $this->crear_vista("clientes/catalogo.php");
    }

    private function crear_vista($nombre_vista){

        $datos['titulo_pag'] = 'Catálogo';
        return view($nombre_vista, $datos);
    }
}