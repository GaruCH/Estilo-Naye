// DATATABLE
// =================================================================
let table_productos = instantiateBasicDatatable();


// BOTONES OPCIONES
// =================================================================
$(document).on('click', '.estatus', function() {
	let elemento = $(this).attr('id');
	let id = elemento.split('_')[0];
    let estatus = elemento.split('_')[1];
	let array = ['./estatus_producto', id, estatus, 'este producto', 'estará disponible en el sistema.'];
	let url = './administracion_productos';
    cambiar_estatus(array,url);
});//end onclick estatus

$(document).on('click', '.eliminar-producto', function() {
    let url = './administracion_productos';
    eliminar("./eliminar_producto", $(this).attr('id'), '¿Estás seguro de eliminar este producto?', 'Esta acción es permanente', url);
});//end onclick eliminar

$(document).on('click', '.recover-producto', function() {
    let titulo = '¿Deseas recuperar este producto?';
    let texto = 'Al recuperar este producto volverá a estar disponible en la base de datos del sistema y podrá ser visualizado en el panel. ¿Estás seguro de restaurar este producto?';
    let texto_confirmar = 'Sí, restaurar producto';
    let texto_cancelar = 'Cancelar';
    let opciones_form = ['./restaurar_producto', 'POST'];
	let data = new FormData();
	data.append('id', $(this).attr('id').split('_')[1]);
    mensaje_confirmacion_texto_propio(titulo, texto, texto_confirmar, texto_cancelar, opciones_form, data);
});//end onclick recover-user

//==============================================================================
//==================================ON PAGE LOADED==============================
//==============================================================================
