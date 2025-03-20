$.validator.addMethod("soloLetras", function (value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Solo se permiten letras y espacios.");

$.validator.addMethod("precioValido", function (value, element) {
    return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
}, "Ingrese un precio válido (solo números y hasta dos decimales, ejemplo: 50 o 50.99). ");

// FORM SERVICIOS VALIDATION
// =================================================================
$("#formulario-servicio-editar").validate({
    rules:{
        nombre_servicio: {
            required: true,
            rangelength: [3, 100],
            soloLetras: true
        },
        precio_servicio: {
            required: true,
            precioValido: true
        },
        descripcion_servicio: {
            required: true,
            rangelength: [10, 500]
        }
    },//end rules
    messages: {
        nombre_servicio: {
            required: 'Se requiere el nombre del servicio.',
            rangelength: 'El nombre del servicio debe tener entre 3 y 100 caracteres.',
            soloLetras: "Solo se permiten letras."
        },
        precio_servicio: {
            required: 'Se requiere el precio del servicio.',
            precioValido: 'Ingrese un precio válido (solo números y hasta dos decimales, ejemplo: 50 o 50.99).'
        },
        descripcion_servicio: {
            required: 'Se requiere la descripción del servicio.',
            rangelength: 'La descripción debe tener entre 10 y 500 caracteres.'
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
