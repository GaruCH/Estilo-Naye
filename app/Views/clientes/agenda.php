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
                                    <select class="w-full p-2 border rounded-md" required>
                                        <option value="">Selecciona un servicio</option>
                                        <option value="Afecciones de los pies">Afecciones de los pies</option>
                                        <option value="Callosidades">Callosidades</option>
                                        <option value="Uñas encarnadas">Uñas encarnadas</option>
                                        <option value="Infecciones por hongos">Infecciones por hongos</option>
                                        <option value="Tratar enfermedades del pie">Tratar enfermedades del pie</option>
                                        <option value="Evitar que las lesiones leves se agraven">Evitar que las lesiones leves se agraven</option>
                                        <option value="Recuperar la salud y comodidad de los pies">Recuperar la salud y comodidad de los pies</option>
                                        <option value="Uñas engrosadas">Uñas engrosadas</option>
                                        <option value="Hiperhidrosis">Hiperhidrosis</option>
                                        <option value="Psoriasis">Psoriasis</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Comentarios (Opcional)</label>
                                    <textarea class="w-full p-2 border rounded-md" placeholder="Ej. Color o diseño deseado"></textarea>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Botón de Enviar -->
                        <button type="submit" class="w-full bg-letra text-white p-2 rounded-md hover:bg-hover">Reservar Cita</button>
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