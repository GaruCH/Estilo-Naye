$(document).ready(function () {
    let form = $("#formulario-cita-nuevo");

    // Inicializa jQuery Validate
    form.validate({
        rules: {
            fecha_cita: {
                required: true,
                date: true
            },
            hora_cita: {
                required: true
            },
            id_servicio: {
                required: true
            },
            correo_paciente: {
                required: true,
                email: true
            }
        },
        messages: {
            fecha_cita: {
                required: "Debe seleccionar una fecha.",
                date: "Ingrese una fecha válida."
            },
            hora_cita: {
                required: "Debe seleccionar una hora."
            },
            id_servicio: {
                required: "Debe seleccionar un servicio."
            },
            correo_paciente: {
                required: "Debe ingresar un correo.",
                email: "Ingrese un correo válido."
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        errorPlacement: function (error, element) {
            $(element).closest(".mb-3").find(".invalid-feedback").html(error);
        }
    });

    // Inicializar EmailJS
    emailjs.init("LrAJb84ZT1J4daVJw");

    // Manejo del envío del formulario
    form.on("submit", function (event) {
        event.preventDefault(); // Evita el envío normal

        if (!form.valid()) {
            return; // No ejecutar EmailJS si hay errores
        }

        // Capturar los datos del formulario
        let params = {
            fecha_cita: $("#fecha_cita").val(),
            hora_cita: $("#hora_cita").val(),
            servicio: $("#id_servicio option:selected").text(),
            nombre_paciente: $("input[name='nombre_paciente']").val(),
            correo_paciente: $("input[name='correo_paciente']").val()
        };

        // Enviar correo con EmailJS
        emailjs.send("service_occslgv", "template_pqyp76q", params)
            .then(function (response) {
                console.log("Correo enviado con éxito", response);
                alert("Cita reservada. Se ha enviado un correo de confirmación.");
                form[0].reset(); // Resetear formulario
            }, function (error) {
                console.log("Error al enviar correo", error);
                alert("Hubo un error al enviar el correo.");
            });
    });
});
