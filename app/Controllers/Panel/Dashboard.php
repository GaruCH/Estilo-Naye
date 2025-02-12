<?php

namespace App\Controllers\Panel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        
        return $this->crear_vista("panel/plantilla/plantilla");
    }

    private function crear_vista($nombre_vista){

        $datos['titulo_pag'] = 'plantilla';
        return view($nombre_vista, $datos);
    }
}