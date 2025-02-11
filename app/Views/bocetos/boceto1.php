<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(RECURSOS_CSS . '/principal.css') ?>">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Inicio</title>
</head>

<body class="">

    <nav class="bg-black/40 fixed w-full z-20 top-0 start-0 border-bborder-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">

                <div class="flex flex-col items-center">
                    <span class="self-center text-2xl font-Tan whitespace-nowrap text-white">ESTILO NAYE NAILS</span>
                    <h2 class="tracking-[7px] text-2xl font-Lexend text-white">STUDIO</h2>
                </div>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="#" class="text-white text-lg font-Outfit bg-black border-4 border-white hover:bg-gray-300 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-4 py-2 text-center">Iniciar sesión</a>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col font-Outfit text-xl p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 max-sm:dark:bg-gray-800  dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-white/30" aria-current="page">Inicio</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-white/30">Catálogo</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-white/30">Agenda</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-white/30">Contacto</a>

            </div>
    </nav>

    <main>

        <section>
            <div class=" bg-cover bg-center h-[500px] md:h-[700px] w-full py-64" style="background-image: url('<?= base_url(RECURSOS_IMG . '/fondo-3.png') ?>');">
                <div class="w-2/4 mx-auto  py-3 px-2 rounded-xl bg-black/40">
                    <h1 class=" text-white text-5xl font-Tan font-semibold text-center">
                        Tus uñas, tu mejor accesorio.
                        <h1 class=" text-white text-5xl font-Tan font-semibold text-center mt-3">
                            ¡Déjalas brillar con estilo!
                        </h1>
                </div>
            </div>
        </section>

        <section class="bg-black py-5 px-56">

            <div>
                <h2 class="text-4xl text-white text-center font-Outfit font-semibold my-6">Nuestro Catálogo</h2>
            </div>



            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-9.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-7.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-8.png') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-1.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-2.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-3.png') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-4.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-5.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-6.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-10.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-11.jpg') ?>" alt="">
                </div>
                <div>
                    <img class="h-auto max-w-full rounded-lg" src="<?= base_url(RECURSOS_IMG . '/diseño-12.jpg') ?>" alt="">
                </div>
            </div>

        </section>

        <section>
            <div>
                <h2 class="text-4xl text-center font-Outfit font-semibold my-6">Agenda</h2>

                <div class="flex justify-center gap-6 items-center font-Outfit bg-black/850 border-t-2 border-b-2 py-2">

                    <div class="max-w-lg bg-white p-6 shadow-lg rounded-lg">
                        <h2 class="text-2xl font-semibold text-center mb-4">Reservar Cita - Art Nails</h2>

                        <form>
                            <!-- Datos del Cliente -->
                            <fieldset class="mb-6">
                                <legend class="text-lg font-medium text-gray-900 mb-2">Datos del Cliente</legend>
                                <div class="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nombre</label>
                                        <input type="text" class="w-full p-2 border rounded-md" placeholder="John" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Paterno</label>
                                        <input type="text" class="w-full p-2 border rounded-md" placeholder="Doe" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Materno</label>
                                        <input type="text" class="w-full p-2 border rounded-md" placeholder="Smith" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Teléfono</label>
                                        <input type="tel" class="w-full p-2 border rounded-md" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Información de la Cita -->
                            <fieldset class="mb-6">
                                <legend class="text-lg font-medium text-gray-900 mb-2">Información de la Cita</legend>
                                <div class="grid gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Fecha y Hora</label>
                                        <input type="datetime-local" class="w-full p-2 border rounded-md" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Tipo de Servicio</label>
                                        <select class="w-full p-2 border rounded-md">
                                            <option>Manicure</option>
                                            <option>Pedicure</option>
                                            <option>Uñas Acrílicas</option>
                                            <option>Gel</option>
                                            <option>Decoraciones</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Comentarios (Opcional)</label>
                                        <textarea class="w-full p-2 border rounded-md" placeholder="Ej. Color o diseño deseado"></textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Botón de Enviar -->
                            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Reservar Cita</button>
                        </form>
                    </div>


                    <div class="w-1/5">
                        <img src="<?= base_url(RECURSOS_IMG . '/nai-1.png') ?>" class="h-auto max-w-full rounded-full border-8" alt="">
                    </div>

                </div>
                </divc>
        </section>

        <section class="bg-black pb-10">
            <div>
                <h2 class="text-4xl text-white text-center font-Outfit font-semibold my-10 py-4">Contacto</h2>
            </div>

            <div class="flex flex-col md:flex-row justify-center gap-10 items-center">
                <!-- Mapa -->
                <div class="w-full md:w-[500px] h-[400px]">
                    <iframe class="w-full h-full border-8 rounded-lg border-white"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3786.427635067771!2d-95.75962262414275!3d18.37337857365256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c3b510d8691bbf%3A0x3eecfb6bb7d38c52!2sConalep%20157%2C%20Francisco%20Villa%2C%2095344%20Carlos%20A.%20Carrillo%2C%20Ver.!5e0!3m2!1ses!2smx!4v1738978854628!5m2!1ses!2smx"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Tarjeta de contacto con banner -->
                <div class="w-full md:w-[500px] h-[400px] bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                    <!-- Banner -->
                    <div class="h-40 w-full bg-cover bg-center" style="background-image: url('<?= base_url(RECURSOS_IMG . '/contacto-1.jpg') ?>');">
                    </div>

                    <div class="p-6  font-Outfit">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center">¡Contáctanos!</h3>
                        <p class="text-gray-700 dark:text-gray-400 text-center mb-4">Estamos disponibles para resolver tus dudas y agendar tu cita.</p>

                        <div class="flex flex-col gap-4">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/521234567890" target="_blank" class="flex items-center gap-3 text-lg text-green-600 hover:text-green-700">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                                <span>WhatsApp: +52 123 456 7890</span>
                            </a>

                            <!-- Correo -->
                            <a href="mailto:contacto@artnails.com" class="flex items-center gap-3 text-lg text-blue-600 hover:text-blue-700">
                                <i class="fa-solid fa-envelope text-2xl"></i>
                                <span>Email: contacto@artnails.com</span>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/artnails" target="_blank" class="flex items-center gap-3 text-lg text-pink-600 hover:text-pink-700">
                                <i class="fa-brands fa-instagram text-2xl"></i>
                                <span>Instagram: @artnails</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Agrega Font Awesome para los iconos -->
        <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>



    </main>

    <footer>
        <h1 class="text-center py-4">
            <div class="flex flex-col items-center">
                <span class="self-center text-2xl font-Tan whitespace-nowrap text-black">ESTILO NAYE NAILS</span>
                <h2 class="tracking-[7px] text-2xl font-Lexend text-black">STUDIO</h2>
            </div>
            <span class="text-sm font-medium tracking-tight text-gray-900 dark:text-white">Todos los derechos reservados</span>
            <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> &copy; 2023</span>
        </h1>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script src="https://kit.fontawesome.com/3674f7580b.js" crossorigin="anonymous"></script>
</body>

</html>