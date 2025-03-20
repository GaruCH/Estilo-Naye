$(document).ready(function () {
    let form = $("#formulario-citas_producto-editar");

    // Inicializar validación en el formulario
    form.validate({
        rules: {
            "productos[]": { required: true },
            "unidades[]": { required: true, min: 1, number: true }
        },
        messages: {
            "productos[]": { required: "Debe seleccionar un producto." },
            "unidades[]": { 
                required: "Debe ingresar la cantidad.", 
                min: "La cantidad debe ser mayor a 0.", 
                number: "Ingrese un número válido." 
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        errorPlacement: function (error, element) {
            $(element).closest(".col-md-3, .col-md-8").find(".invalid-feedback").html(error);
        }
    });

    // ✅ Agregar productos dinámicamente con validación
    $('#agregar-producto').on('click', function () {
        console.log("Botón de agregar producto presionado");

        let nuevoProducto = `
            <div class="producto-item row mb-2">
                <div class="col-md-8">
                    <select class="form-control" name="productos[]">
                        ${opcionesProductos}
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="unidades[]" min="1">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger eliminar-producto">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

        let nuevoElemento = $(nuevoProducto).appendTo('#productos-lista');

        // ✅ Agregar reglas de validación a los nuevos elementos
        nuevoElemento.find("select[name='productos[]']").rules("add", {
            required: true,
            messages: { required: "Debe seleccionar un producto." }
        });

        nuevoElemento.find("input[name='unidades[]']").rules("add", {
            required: true,
            min: 1,
            number: true,
            messages: {
                required: "Debe ingresar la cantidad.",
                min: "La cantidad debe ser mayor a 0.",
                number: "Ingrese un número válido."
            }
        });
    });

    // 🗑 Eliminar producto dinámicamente
    $('#productos-lista').on('click', '.eliminar-producto', function () {
        $(this).closest('.producto-item').remove();
    });
});
