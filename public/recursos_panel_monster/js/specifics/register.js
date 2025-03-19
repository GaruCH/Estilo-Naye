$.validator.addMethod("passRegex", function (value, element) {
    return this.optional(element) || /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/.test(value);
}, "Debe escoger una contraseña segura");

$.validator.addMethod("emailRegex", function (value, element) {
    return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
}, "No corresponde a una ruta de email");

$.validator.addMethod("soloLetras", function (value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value);
}, "Solo se permiten letras y espacios.");

$.validator.addMethod("telefonoValido", function (value, element) {
    return this.optional(element) || /^[0-9]{10}$/.test(value);
}, "Ingrese un número de 10 dígitos.");


// FORM paciente_NUEVO VALIDATION
// =================================================================
$("#formulario-registro").validate({
    rules: {
        nombre: {
            required: true,
            rangelength: [3, 50],
            soloLetras: true
        },
        ap_paterno: {
            required: true,
            rangelength: [3, 50],
            soloLetras: true
        },
        ap_materno: {
            required: true,
            rangelength: [3, 50],
            soloLetras: true
        },
        telefono: {
            required: true,
            telefonoValido: true
        },
        correo: {
            required: true,
            emailRegex: true,
            email: true,
            rangelength: [5, 70]
        },
        password: {
            required: true,
            rangelength: [8, 16],
            passRegex: true
        },
        confirm_password: {
            required: true,
            equalTo: '#password',
            rangelength: [8, 16],
            passRegex: true
        }
    },//end rules
    messages: {
        nombre: {
            required: 'Se requiere el nombre.',
            rangelength: 'El nombre debe tener entre 3 y 50 caracteres.',
            soloLetras: "Solo se permiten letras."
        },
        ap_paterno: {
            required: 'Se requiere el apellido paterno.',
            rangelength: 'El apellido paterno debe tener entre 3 y 50 caracteres.',
            soloLetras: "Solo se permiten letras."
        },
        ap_materno: {
            required: 'Se requiere el apellido materno.',
            rangelength: 'El apellido materno debe tener entre 3 y 50 caracteres.',
            soloLetras: "Solo se permiten letras."
        },
        telefono: {
            required: 'Se requiere el teléfono.',
            telefonoValido: "Debe ingresar un número de 10 dígitos."
        },
        correo: {
            required: 'Se requiere el correo electrónico.',
            emailRegex: 'El correo electrónico debe tener el siguiente formato: ejemplo@dominio.com',
            email: 'El correo electrónico debe tener el siguiente formato: ejemplo@dominio.com',
            rangelength: 'El correo electrónico no debe exceder los 70 caracteres.'
        },
        password: {
            required: 'Se requiere la contraseña.',
            rangelength: 'La contraseña debe tener de 8 a 16 caracteres.',
            passRegex: 'La contraseña debe tener por lo menos un dígito, una mayúscula, una minúscula y un símbolo especial (&, %, $, #, etc..).'
        },
        confirm_password: {
            required: 'Se requiere confirmar la contraseña.',
            equalTo: 'Las contraseñas no coinciden.',
            rangelength: 'La contraseña debe tener de 8 a 16 caracteres.',
            passRegex: 'La contraseña debe tener por lo menos un dígito, una mayúscula, una minúscula y un símbolo especial (&, %, $, #, etc..).'
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
});//end validation

//FUNCIONES JS QUE SIRVEN PARA VALIDAR EL CHECKBOX Y RADIO BUTTON
$("#formulario-registro").submit(function (event) {
    if ($('.radio-item:checked').length <= 0) {
        event.preventDefault();
        mensaje_notificacion('Se requiere seleccionar el sexo para el paciente.', WARNING_ALERT, '¡Faltan campos!', 3500, 'toast-bottom-left');
    }//end if no hay ningun radiobutton activo
});
