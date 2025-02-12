<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo_pag ?></title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(RECURSOS_CSS . '/principal.css') ?>">
    <link rel="shortcut icon" href="<?= base_url(RECURSOS_IMG . '/sin-fondo.png') ?>" type="image/x-icon">
</head>

<body class="bg-primario">

    <nav class="bg-white/80 fixed w-full z-20 top-0 start-0 border-b-2 border-letra">
        <div class="flex justify-between items-center py-3 px-6 lg:px-16">
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

            <!-- Menú Hamburguesa (Móvil) -->
            <div class="lg:hidden flex items-center">
                <button id="toggleOpen">
                    <svg class="w-7 h-7 text-letra" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Menú de Navegación -->
            <div id="collapseMenu"
                class="max-lg:hidden lg:flex lg:gap-x-8 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[250px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:z-50">
                <!-- Botón Cerrar (Móvil) -->
                <button id="toggleClose" class="lg:hidden absolute top-4 right-4 w-9 h-9 flex items-center justify-center border bg-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black" viewBox="0 0 320.591 320.591">
                        <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"></path>
                        <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"></path>
                    </svg>
                </button>

                <!-- Links del Menú -->
                <ul class="lg:flex lg:gap-8 font-Outfit font-bold text-xl text-letra space-y-4 lg:space-y-0">
                    <li><a href="<?= route_to('cliente_inicio') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">INICIO</a></li>
                    <li><a href="<?= route_to('cliente_catalogo') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">CATÁLOGO</a></li>
                    <li><a href="<?= route_to('cliente_servicios') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">SERVICIOS</a></li>
                    <li><a href="<?= route_to('cliente_agenda') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">AGENDA</a></li>
                    <li><a href="<?= route_to('cliente_contacto') ?>" class="relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">CONTACTO</a></li>
                </ul>
            </div>

            <!-- Botón de Sesión -->
            <div class="hidden lg:block">
                <a href="<?= route_to('usuario_login') ?>" class="font-Outfit text-xl text-letra font-bold relative pb-1 after:absolute after:left-1/2 after:-bottom-0.5 after:w-0 after:h-[2px] after:bg-letra after:transition-all after:duration-300 hover:after:w-full hover:after:left-0">INICIAR SESIÓN</a>
            </div>
        </div>
    </nav>