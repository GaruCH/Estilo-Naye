// DATATABLE
// =================================================================
let table_servicios = instantiateBasicDatatable();


// BOTONES OPCIONES
// =================================================================
$(document).on('click', '.estatus', function() {
	let elemento = $(this).attr('id');
	let id = elemento.split('_')[0];
    let estatus = elemento.split('_')[1];
	let array = ['./estatus_servicio', id, estatus, 'este servicio', 'estará disponible en el sistema.'];
	let url = './administracion_servicios';
    cambiar_estatus(array,url);
});//end onclick estatus

$(document).on('click', '.eliminar-servicio', function() {
    let url = './administracion_servicios';
    eliminar("./eliminar_servicio", $(this).attr('id'), '¿Estás seguro de eliminar este servicio?', 'Esta acción es permanente', url);
});//end onclick eliminar

$(document).on('click', '.recover-servicio', function() {
    let titulo = '¿Deseas recuperar este servicio?';
    let texto = 'Al recuperar este servicio volverá a estar disponible en la base de datos del sistema y podrá ser visualizado en el panel. ¿Estás seguro de restaurar este servicio?';
    let texto_confirmar = 'Sí, restaurar servicio';
    let texto_cancelar = 'Cancelar';
    let opciones_form = ['./restaurar_servicio', 'POST'];
	let data = new FormData();
	data.append('id', $(this).attr('id').split('_')[1]);
    mensaje_confirmacion_texto_propio(titulo, texto, texto_confirmar, texto_cancelar, opciones_form, data);
});//end onclick recover-user

//==============================================================================
//==================================ON PAGE LOADED==============================
//==============================================================================
