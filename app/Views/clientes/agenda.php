<?php include 'includes/header.php'; ?>

<main>
    <section class="mt-16 py-12 font-Outfit">
        <div class="container mx-auto px-6">

            <div class="flex justify-center">
                <div class="text-center w-1/2 mb-12 rounded-lg bg-white py-3">
                    <h2 class="text-4xl font-bold text-letra">Agenda</h2>
                    <p class="text-xl text-gray-700 mt-4">Tu bienestar empieza con una cita. ¡Reserva ahora!</p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row justify-center items-center gap-8">

                <!-- Formulario de Reserva -->
                <div class="max-w-xl bg-white p-8 shadow-lg rounded-lg w-full">
                    <h3 class="text-2xl font-semibold text-center mb-6 text-letra">Reservar Cita - Estilo Naye Nails</h3>

                    <form>
                        <!-- Datos del Cliente -->
                        <fieldset class="mb-6">
                            <!-- Aquí puedes agregar los campos del formulario si es necesario -->
                        </fieldset>

                        <!-- 🔔 Mensaje de advertencia -->
                      <div class="mb-6 flex items-center gap-3 bg-yellow-200 border-l-8 border-yellow-500 p-4 rounded-xl shadow-lg animate-pulse">
                        <svg class="w-7 h-7 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12" y2="17"></line>
                        </svg>
                        <p class="text-yellow-800 font-semibold text-base leading-tight">
                            <strong class="font-bold">¡Importante!</strong> Para poder agendar una cita, primero debes iniciar sesión o registrarte.
                        </p>
                      </div>


                        <!-- Botón de Enviar -->
                        <button
                            type="button"
                            class="w-full bg-letra text-white p-3 rounded-md hover:bg-hover transition-colors duration-300 font-semibold"
                            onclick="window.location.href='<?= route_to('usuario_login') ?>'">
                            Registrarse
                        </button>
                    </form>

                </div>

                <!-- Imagen del Servicio -->
                <div class="w-full lg:w-2/5">
                    <img src="<?= base_url(RECURSOS_IMG . '/agenda-2.png') ?>" class="w-full h-auto rounded-lg shadow-md" alt="Imagen de Nails Art">
                </div>

            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
