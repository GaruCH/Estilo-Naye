$.validator.addMethod("soloLetras", function (value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Solo se permiten letras y espacios.");


$("#formulario-categoria-nuevo").validate({
    rules:{
        nombre_categoria: {
            required: true,
            rangelength: [3, 100],
            soloLetras: true
        },
        descripcion_categoria: {
            required: true,
            rangelength: [10, 500]
        }
    },//end rules
    messages: {
        nombre_categoria: {
            required: 'Se requiere el nombre de la categoría.',
            rangelength: 'El nombre de la categoría debe tener entre 3 y 100 caracteres.',
            soloLetras: "Solo se permiten letras y espacios."
        },
        descripcion_categoria: {
            required: 'Se requiere la descripción de la categoría.',
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
