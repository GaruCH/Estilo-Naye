$(document).ready(function () {
    $('#agregar-producto').on('click', function () {
        console.log("Botón de agregar producto presionado"); // Depuración

        let nuevoProducto = `
            <div class="producto-item row mb-2">
                <div class="col-md-8">
                    <select class="form-control" name="productos[]">
                        ${opcionesProductos}
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="unidades[]" min="1" required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger eliminar-producto">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

        $('#productos-lista').append(nuevoProducto);
    });

    $('#productos-lista').on('click', '.eliminar-producto', function () {
        $(this).closest('.producto-item').remove();
    });
});