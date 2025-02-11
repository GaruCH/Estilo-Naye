<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo_pag ?></title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(RECURSOS_CSS . '/principal.css') ?>">
</head>

<body class="bg-primario">

    <nav class="bg-white/80 fixed w-full z-20 top-0 start-0 border-b-2 border-letra">
        <div class="flex justify-between items-center py-3 px-16">
            <!-- Logo -->
            <a href="<?= route_to('cliente_inicio') ?>">
                <div class="flex items-center gap-4">
                    <div class="w-16"><img src="<?= base_url(RECURSOS_IMG . '/sin-fondo.png') ?>" alt=""></div>
                    <div class="flex flex-col items-center">
                        <span class="self-center text-xl font-Tan whitespace-nowrap text-letra">ESTILO NAYE NAILS</span>
                        <h2 class="tracking-[7px] text-xl font-Lexend text-letra">STUDIO</h2>
                    </div>
                </div>
            </a>

            <!-- Menú -->
            <div>
                <ul class="flex gap-8 font-Outfit font-bold text-xl text-letra">
                    <li><a href="<?= route_to('cliente_inicio') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">INICIO</a></li>
                    <li><a href="<?= route_to('cliente_catalogo') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">CATÁLOGO</a></li>
                    <li><a href="<?= route_to('cliente_servicios') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">SERVICIOS</a></li>
                    <li><a href="<?= route_to('cliente_agenda') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">AGENDA</a></li>
                    <li><a href="<?= route_to('cliente_contacto') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">CONTACTO</a></li>
                </ul>
            </div>

            <!-- Botón de sesión -->
            <div>
                <a href="#" class="font-Outfit text-xl text-letra font-bold relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">INICIAR SESIÓN</a>
            </div>
        </div>
    </nav>