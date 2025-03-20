$.validator.addMethod("soloLetras", function (value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Solo se permiten letras y espacios.");

$.validator.addMethod("numeroEntero", function (value, element) {
    return this.optional(element) || /^\d+$/.test(value);
}, "Solo se permiten números enteros.");

// FORM PRODUCTOS VALIDATION
// =================================================================
$("#formulario-producto-editar").validate({
    rules:{
        nombre_producto: {
            required: true,
            rangelength: [3, 100],
            soloLetras: true
        },
        descripcion_producto: {
            required: true,
            rangelength: [10, 500]
        },
        cantidad_producto: {
            required: true,
            numeroEntero: true,
            min: 1
        },
        stock_minimo_producto: {
            required: true,
            numeroEntero: true,
            min: 0
        },
        categorias: {
            required: true
        }
    },//end rules
    messages: {
        nombre_producto: {
            required: 'Se requiere el nombre del producto.',
            rangelength: 'El nombre del producto debe tener entre 3 y 100 caracteres.',
            soloLetras: "Solo se permiten letras y espacios."
        },
        descripcion_producto: {
            required: 'Se requiere la descripción del producto.',
            rangelength: 'La descripción debe tener entre 10 y 500 caracteres.'
        },
        cantidad_producto: {
            required: 'Se requiere la cantidad del producto.',
            numeroEntero: 'Solo se permiten números enteros.',
            min: 'La cantidad debe ser al menos 1.'
        },
        stock_minimo_producto: {
            required: 'Se requiere el stock mínimo del producto.',
            numeroEntero: 'Solo se permiten números enteros.',
            min: 'El stock mínimo debe ser al menos 0.'
        },
        categorias: {
            required: 'Debe seleccionar al menos una categoría para el producto.'
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
       if (element.attr("id") === "categorias") {
           $("#categorias-error").html(error);
       } else {
           $(element).next().append(error);
       }
   }//end errorPlacement
});

$(document).ready(function () {
    $('#categorias').select2({
        placeholder: 'Selecciona las categorías',
        allowClear: true,
        width: '100%'
    });
});

// VALIDACIÓN DE CATEGORÍAS SELECT2
$("#formulario-producto-editar").submit(function(event){
    if($('#categorias').val() === null || $('#categorias').val().length === 0) {
        event.preventDefault();
		mensaje_notificacion('Selecciona al menos una categoría para el producto.', WARNING_ALERT, '¡Faltan campos!', 4000, 'toast-bottom-left');
    }
});
