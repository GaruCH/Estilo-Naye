<?php include 'includes/header.php'; ?>

<main>
    <section class="relative">
        <!-- 🌈 Banner Principal -->
        <div class="bg-cover bg-center h-[500px] border-b-8 border-letra md:h-[700px] w-full flex justify-center items-center" style="background-image: url('<?= base_url(RECURSOS_IMG . '/fondo-3.png') ?>');">
            <div class="w-3/4 md:w-1/2 text-center bg-white/80 py-6 px-4 rounded-xl shadow-lg">
                <h1 class="text-[#0F97A6] text-5xl font-Outfit font-semibold">¡Belleza y bienestar para tus pies!</h1>
            </div>
        </div>

        <!-- 🏆 Quién Soy -->
        <div class="max-w-4xl mx-auto my-16  px-6 py-2 rounded-lg bg-white">
            <h2 class="text-center text-3xl font-Outfit font-bold text-[#0F97A6]">¿Quién soy?</h2>
            <p class="mt-4 text-gray-600 text-xl font-Outfit text-justify">
                Soy una estilista apasionada por el cuidado de los pies, porque sé que cuando
                nuestros pies están bien, todo nuestro cuerpo lo siente. Disfruto ayudar a mis
                clientes a aliviar sus molestias, brindándoles no solo bienestar físico, sino también
                un momento de relajación y cuidado personal. Cada sesión es más que un
                tratamiento; es una oportunidad para que se sientan mejor, más ligeros y renovados.
                Mi compromiso es ofrecer un servicio cálido y personalizado, donde cada persona
                sepa que sus pies están en las mejores manos.
            </p>
        </div>

        <!-- 🎯 Visión & Misión -->
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 px-6 font-Outfit">
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <h3 class="text-3xl font-bold text-letra">Nuestra Visión</h3>
                <div class="flex justify-center my-4">
                    <img src="<?= base_url(RECURSOS_IMG . '/vision.svg') ?>" class="w-2/4" alt="">
                </div>
                <p class="mt-3 text-gray-600 text-xl">
                    Ser reconocida en el mercado por mi excelencia e innovación en tendencias, comprometida con el cuidado integral de cada cliente.
                </p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <h3 class="text-3xl font-bold text-letra">Nuestra Misión</h3>
                <div class="flex justify-center my-4">
                    <img src="<?= base_url(RECURSOS_IMG . '/mision.svg') ?>" class="w-2/4" alt="">
                </div>
                <p class="mt-3 text-gray-600 text-xl">
                Ofrezco servicios de pedicura clínica y diseño de uñas de alta calidad, enfocados en creatividad, cuidado y satisfacción. Utilizo productos de primera categoría y técnicas innovadoras para garantizar resultados excepcionales y una experiencia personalizada y relajante.
                </p>
            </div>
        </div>

        <!-- ⭐ Recomendaciones para el cuidado de las uñas -->
        <div class="max-w-7xl mx-auto my-16 px-6 font-Outfit">
            <h2 class="text-3xl font-Outfit font-bold text-center text-[#0F97A6]">Recomendaciones para el cuidado de las uñas</h2>
            <p class="text-gray-600 text-xl text-center mt-4">
                Es fundamental mantener los pies limpios y secos, además de cortar las uñas adecuadamente para evitar problemas como uñas encarnadas o infecciones.
            </p>
            <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6 text-xl">
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6]">
                    <p class="text-gray-600 font-semibold">1. Lavar los pies con agua y jabón, prestando especial atención entre los dedos.</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6]">
                    <p class="text-gray-600 font-semibold">2. Secar bien los pies, incluyendo los espacios entre los dedos.</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6]">
                    <p class="text-gray-600 font-semibold">3. Cortar las uñas de forma cuadrada para evitar que se encarnen en los laterales.</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6]">
                    <p class="text-gray-600 font-semibold">4. Limarlas correctamente para darles una forma adecuada.</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6]">
                    <p class="text-gray-600 font-semibold">5. Aplicar crema hidratante para evitar la resequedad y las grietas en la piel.</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6]">
                    <p class="text-gray-600 font-semibold">6. Usar calzado cómodo que no apriete los dedos para prevenir uñas encarnadas.</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md text-center border border-[#0F97A6] md:col-span-2 lg:col-span-3">
                    <p class="text-gray-600 font-semibold">7. Acudir a un profesional para una pedicura adecuada o en caso de cambios en la coloración de las uñas, ya que esto podría indicar la presencia de hongos o bacterias.</p>
                </div>
            </div>
        </div>
    </section>

</main>


<?php include 'includes/footer.php'; ?>