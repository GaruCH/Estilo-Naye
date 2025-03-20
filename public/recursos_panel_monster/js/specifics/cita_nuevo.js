$.validator.addMethod("soloLetras", function (value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Solo se permiten letras y espacios.");

// FORM CITAS VALIDATION
// =================================================================
$("#formulario-cita-nuevo").validate({
    rules:{
        id_persona: {
            required: true
        },
        id_servicio: {
            required: true
        },
        fecha_cita: {
            required: true,
            date: true
        },
        hora_cita: {
            required: true,
            time: true
        }
    },//end rules
    messages: {
        id_persona: {
            required: 'Debe seleccionar un paciente.'
        },
        id_servicio: {
            required: 'Debe seleccionar un servicio.'
        },
        fecha_cita: {
            required: 'Debe seleccionar una fecha para la cita.',
            date: 'Ingrese una fecha válida.'
        },
        hora_cita: {
            required: 'Debe seleccionar una hora para la cita.',
            time: 'Ingrese una hora válida.'
        }
    },//end messages
    highlight: function (input) {
        $(input).addClass('is-invalid');
        $(input).removeClass('is-valid');
    },//end highlight
    unhighlight: function (input) {
       $(input).removeClass('is-invalid');
       $(input).addClass('is-valid');
   },//end unhighlight
   errorPlacement: function (error, element) {
       $(element).next().append(error);
   }//end errorPlacement
});
