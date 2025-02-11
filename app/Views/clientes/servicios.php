<?php include 'includes/header.php'; ?>

<main>
    <section class="mt-16 py-12 px-8  font-Outfit">
        <div class="flex justify-center">
            <div class="text-center w-1/2 mb-12 rounded-lg bg-white py-3">
                <h2 class="text-4xl font-bold text-letra">Nuestros Servicios</h2>
                <p class="text-xl text-gray-700 mt-4">Ofrecemos tratamientos especializados para garantizar la salud y comodidad de tus pies.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Servicio 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-1.jpg') ?>" alt="Afecciones de los pies">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Afecciones de los pies</h3>
            </div>

            <!-- Servicio 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-2.jpg') ?>" alt="Callosidades">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Callosidades</h3>
            </div>

            <!-- Servicio 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-3.jpg') ?>" alt="Uñas encarnadas">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Uñas Encarnadas</h3>
            </div>

            <!-- Servicio 4 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-4.jpg') ?>" alt="Infecciones por hongos">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Infecciones por Hongos</h3>
            </div>

            <!-- Servicio 5 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-5.jpg') ?>" alt="Enfermedades del pie">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Enfermedades del Pie</h3>
            </div>

            <!-- Servicio 6 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-6.jpg') ?>" alt="Lesiones leves">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Prevención de Lesiones Leves</h3>
            </div>

            <!-- Servicio 7 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-7.jpg') ?>" alt="Recuperación de salud">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Recuperación de Salud</h3>
            </div>

            <!-- Servicio 8 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-8.jpg') ?>" alt="Uñas engrosadas">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Uñas Engrosadas</h3>
            </div>

            <!-- Servicio 9 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-9.jpg') ?>" alt="Hiperhidrosis">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Hiperhidrosis</h3>
            </div>

            <!-- Servicio 10 -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img class="h-48 w-full object-cover rounded-t-lg" src="<?= base_url(RECURSOS_IMG . '/servicio-10.jpg') ?>" alt="Psoriasis en los pies">
                <h3 class="text-xl font-semibold text-center text-letra mt-4">Psoriasis en los Pies</h3>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>