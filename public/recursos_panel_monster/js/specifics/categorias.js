// DATATABLE
// =================================================================
let table_categorias = instantiateBasicDatatable();


// BOTONES OPCIONES
// =================================================================
$(document).on('click', '.estatus', function() {
	let elemento = $(this).attr('id');
	let id = elemento.split('_')[0];
    let estatus = elemento.split('_')[1];
	let array = ['./estatus_categoria', id, estatus, 'esta categoria', 'estará disponible en el sistema.'];
	let url = './administracion_categorias';
    cambiar_estatus(array,url);
});//end onclick estatus

$(document).on('click', '.eliminar-categoria', function() {
    let url = './administracion_categorias';
    eliminar("./eliminar_categoria", $(this).attr('id'), '¿Estás seguro de eliminar esta categoria?', 'Esta acción es permanente', url);
});//end onclick eliminar

$(document).on('click', '.recover-categoria', function() {
    let titulo = '¿Deseas recuperar esta categoria?';
    let texto = 'Al recuperar esta categoria volverá a estar disponible en la base de datos del sistema y podrá ser visualizado en el panel. ¿Estás seguro de restaurar esta categoria?';
    let texto_confirmar = 'Sí, restaurar categoria';
    let texto_cancelar = 'Cancelar';
    let opciones_form = ['./restaurar_categoria', 'POST'];
	let data = new FormData();
	data.append('id', $(this).attr('id').split('_')[1]);
    mensaje_confirmacion_texto_propio(titulo, texto, texto_confirmar, texto_cancelar, opciones_form, data);
});//end onclick recover-user

//==============================================================================
//==================================ON PAGE LOADED==============================
//==============================================================================
