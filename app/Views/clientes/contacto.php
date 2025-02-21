<?php include 'includes/header.php'; ?>

<main>
    <section class="min-h-screen flex justify-center flex-col items-center font-Outfit">
    
        <div class="flex justify-center">
            <div class="text-center mb-12 rounded-lg bg-white py-3 px-2 mt-2">
                <h2 class="text-4xl font-bold text-letra">¡Ponte en contacto con nosotros!</h2>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-center gap-10 items-center px-6">
            <!-- Mapa -->
            <div class="w-full md:w-[500px] h-[400px] shadow-lg rounded-lg overflow-hidden">
                <iframe class="w-full h-full border-none rounded-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3786.427635067771!2d-95.75962262414275!3d18.37337857365256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c3b510d8691bbf%3A0x3eecfb6bb7d38c52!2sConalep%20157%2C%20Francisco%20Villa%2C%2095344%20Carlos%20A.%20Carrillo%2C%20Ver.!5e0!3m2!1ses!2smx!4v1738978854628!5m2!1ses!2smx"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Tarjeta de contacto con banner -->
            <div class="w-full md:w-[500px] bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidde">
                <!-- Banner -->
                <div class="h-40 w-full bg-cover bg-center" style="background-image: url('<?= base_url(RECURSOS_IMG . '/contacto-1.jpg') ?>');"></div>

                <div class="p-6 text-center font-Outfit">
                    <h3 class="text-2xl font-bold text-letra dark:text-white">¡Contáctanos ahora!</h3>
                    <p class="text-gray-700 dark:text-gray-400 mt-2 mb-5">Agenda tu cita o haznos cualquier consulta.</p>

                    <div class="flex flex-col gap-4">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/2881154048" target="_blank" class="flex items-center justify-center gap-3 text-lg text-green-600 hover:text-green-700 font-semibold">
                            <i class="fa-brands fa-whatsapp text-2xl"></i>
                            <span>+52 28 811 5404</span>
                        </a>

                        <!-- Correo -->
                        <a href="mailto:estilonayenails@gmail.com" class="flex items-center justify-center gap-3 text-lg text-blue-600 hover:text-blue-700 font-semibold">
                            <i class="fa-solid fa-envelope text-2xl"></i>
                            <span>estilonayenails@gmail.com</span>
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/estilonayenails._?igsh=ZGcwdTd2bXN1b25u" target="_blank" class="flex items-center justify-center gap-3 text-lg text-pink-600 hover:text-pink-700 font-semibold">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                            <span>@estilonayenails</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>