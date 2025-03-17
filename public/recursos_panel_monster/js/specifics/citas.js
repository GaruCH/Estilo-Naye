// DATATABLE
// =================================================================
let table_citas = instantiateBasicDatatable();

// BOTONES OPCIONES
// =================================================================
$(document).on('click', '.confirmar-cita', function() {
	let elemento = $(this).attr('id');
	let id = elemento.split('_')[0];
    let estatus = elemento.split('_')[1];
	let array = ['./confirmar_cita', id, estatus, 'esta cita', 'estará visible en el sistema.'];
	let url = './administracion_citas';
    cambiar_estatus_cita_confirmar(array,url);
});//end onclick estatus

$(document).on('click', '.cancelar-cita', function() {
	let elemento = $(this).attr('id');
	let id = elemento.split('_')[0];
    let estatus = elemento.split('_')[1];
	let array = ['./cancelar_cita', id, estatus, 'esta cita', 'dejará de estar visible en el sistema.'];
	let url = './administracion_citas';
    cambiar_estatus_cita_cancelar(array,url);
});//end onclick estatus


$(document).on('click', '.eliminar-cita', function() {
    let url = './administracion_citas';
    eliminar("./eliminar_cita", $(this).attr('id'), '¿Estás seguro de eliminar esta cita?', 'Esta acción es permanente', url);
});//end onclick eliminar

$(document).on('click', '.recover-cita', function() {
    let titulo = '¿Deseas recuperar esta cita?';
    let texto = 'Al recuperar esta cita volverá a estar disponible en la base de datos del sistema y podrá ser visualizado en el panel. ¿Estás seguro de restaurar esta cita?';
    let texto_confirmar = 'Sí, restaurar cita';
    let texto_cancelar = 'Cancelar';
    let opciones_form = ['./restaurar_cita', 'POST'];
	let data = new FormData();
	data.append('id', $(this).attr('id').split('_')[1]);
    mensaje_confirmacion_texto_propio(titulo, texto, texto_confirmar, texto_cancelar, opciones_form, data);
});//end onclick recover-user
