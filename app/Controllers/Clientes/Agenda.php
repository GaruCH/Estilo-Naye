<?php

namespace App\Controllers\Clientes;
use App\Controllers\BaseController;

class Agenda extends BaseController
{
    public function index(): string
    {
        
        return $this->crear_vista("clientes/agenda.php");
    }

    private function crear_vista($nombre_vista){

        $datos['titulo_pag'] = 'Agenda';
        return view($nombre_vista, $datos);
    }
}