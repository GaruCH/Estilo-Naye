/* Función para realizar alertas en versión sweetalert, esta funcion recibe 3 parámetros
    título: Será el título principal del modal
    mensaje: Será el cuerpo que desplegará el modal
    tipo: 1 = success 2 = error, 3 = question, 4 = warning
*/
const alerta_modal = (titulo = '', mensaje = '', tipo = 1) => {
    Swal.fire(
        titulo,
        mensaje,
        tipo_alerta_modal(tipo)
    );
}; //end function alerta_modal

/* función para saber que tipo de alerta es*/
const tipo_alerta_modal = (num) => {
    tipo = '';
    switch (num) {
        case 1:
            tipo = 'success';
            break;
        case 2:
            tipo = 'error';
            break;
        case 3:
            tipo = 'question';
            break;
        case 4:
            tipo = 'warning';
            break;

        default:
            tipo = 'success';
            break;
    }//end switch
    return tipo;
}; //end function tipo_alerta_modal

//============================================
//FUNCIÓN PARA COLOCAR EL TIPO DEL ESTATUS
//============================================
/**
* Esta función es parte de cambiar estatus y el retorno es un string revolviendo el tipo de estatus
* que al que se esta cambiando. Como parametro recibe un string con valor "2" o "-1".
*/
const tipo_estatus = (estatus) => {
    if(estatus === "2") {
        return 'deshabilitar';
    }//end if
    else {
        return 'habilitar';
    }//end else
};//end tipo_estatus


//============================================
//FUNCIÓN PARA OBTENER EL ESTATUS
//============================================
/**
* Esta función es parte de cambiar estatus y el retorno es un string revolviendo el tipo de estatus
* que al que se esta cambiando. Como parametro recibe un string con valor "2" o "-1".
*/
const obtener_estatus = (estatus) => {
    if(estatus === "2") {
        return -1;
    }//end if
    else {
        return 2;
    }//end else
};//end tipo_estatus


//============================================
//FUNCIÓN PARA CAMBIAR ESTATUS
//============================================
/*
* Función global para cambiar el estatus de algún registro.
* Esta función funciona para cambiar un estatus de algún registro
* que maneje dos estatus solamente y se hace por consulta ajax.
* Esta función recibe dos argumentos, el primero es un arreglo que
* contiene 6 indices y el segundo es un objeto DataTable
* [0] -> URL
* [1] -> ID
* [2] -> ESTATUS
* [3] -> COMPLEMENTO DE PREGUNTA EJEMP. ¿Estás seguro de habilitar "este registro/este campo/este usuario"?
* Lo que va entre comillas es el complemento de la pregunta.
* [4] -> TEXTO EJEMP. Al habilitar/deshabilitar "se mostrara en las listas/tendrá permiso para acceder al sistema"
* El texto sería lo que va entre las comillas
* [5] -> Objeto dataTable. El objeto datatable funciona para actualizar el contenido de la misma dataTable
*/
const cambiar_estatus = (array, url=null) => {
    Swal.fire({
        title: "¿Estás seguro de " + tipo_estatus(array[2]) + " " + array[3] + "?",
        text: "Al "+tipo_estatus(array[2])+" "+array[3]+" "+(array[2] === "2" ? 'no ' :'')+array[4],
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#7bb13c',
        cancelButtonColor: '#e84646',
        confirmButtonText: 'Sí, ' + tipo_estatus(array[2]),
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((result) => {
        if(result.isConfirmed) {
            let data = new FormData();
            data.append('id', array[1]);
            data.append('estatus', obtener_estatus(array[2]));

            fetch(array[0], {
                method: 'POST',
                body: data
            })
            .then(res => {
                if(!res.ok) {
                    throw new Error('Ocurrió un error');
                }//end if
                return res.json();
            })
            .then(respuesta => {
                if(respuesta.error == 0){
                    alerta_modal('¡Estatus Actualizado!', '¡El estatus ha sido actualizado exitosamente!', 1);
                    window.location = url;
                }//end if se actualiza
                else{
                    alerta_modal('¡Error!', 'Ocurrió un error al actualizar el estatus', 2);
                }//end else se actualiza
            })
            .catch(error => {
                alerta_modal('¡Error!', 'Ocurrió un error al actualizar el estatus', 2);
            });
        }//end if se actualiza estatus
    });
};//end cambiar_estatus

const cambiar_estatus_datatable = (array, table) => {
    Swal.fire({
        title: "¿Estás seguro de " + tipo_estatus(array[2]) + " " + array[3] + "?",
        text: "Al "+tipo_estatus(array[2])+" "+array[3]+" "+(array[2] === "2" ? 'no ' :'')+array[4],
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#7bb13c',
        cancelButtonColor: '#e84646',
        confirmButtonText: 'Sí, ' + tipo_estatus(array[2]),
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((result) => {
        if(result.isConfirmed) {
            let data = new FormData();
            data.append('id', array[1]);
            data.append('estatus', obtener_estatus(array[2]));

            fetch(array[0], {
                method: 'POST',
                body: data
            })
            .then(res => {
                if(!res.ok) {
                    throw new Error('Ocurrió un error');
                }//end if
                return res.json();
            })
            .then(respuesta => {
                if(respuesta.error == 0){
                    alerta_modal('¡Estatus Actualizado!', '¡El estatus ha sido actualizado exitosamente!', 1);
                    table.ajax.reload(null, false);
                }//end if se actualiza
                else{
                    alerta_modal('¡Error!', 'Ocurrió un error al actualizar el estatus', 2);
                }//end else se actualiza
            })
            .catch(error => {
                alerta_modal('¡Error!', 'Ocurrió un error al actualizar el estatus', 2);
            });
        }//end if se actualiza estatus
    });
};//end cambiar_estatus_datatable




//============================================
//FUNCIÓN PARA ELIMINAR
//============================================
/*
* Esta función elimina cualquier registro de manera global, esta función recibe los parámetros:
    ruta: la ruta en donde se encuentra la función para eliminar el registro
    id: id del registro a borrar
    titulo: título del modal
    mensaje: mensaje del modal
    url: url de a donde dirigir una vez finalizada la operación
*/
const eliminar = (ruta = "", id=0, titulo='', mensaje='', url) => {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#7bb13c',
        cancelButtonColor: '#e84646',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((result) => {
        if(result.isConfirmed) {
            let data = new FormData();
            data.append('id', id);

            fetch(ruta, {
                method: 'POST',
                body: data
            })
            .then(res => {
                if(!res.ok) {
                    throw new Error('Ocurrió un error');
                }//end if
                return res.json();
            })
            .then(respuesta => {
                if(respuesta.error == 0){
                    alerta_modal('¡Registro Eliminado!', '¡El registro ha sido eliminado exitosamente!', 1);
                    window.location = url;
                }//end if se actualiza
                else{
                    alerta_modal('¡Error!', 'Ocurrió un error al eliminar el registro', 2);
                }//end else se actualiza
            })
            .catch(error => {
                alerta_modal('¡Error!', 'Ocurrió un error al eliminar el registro', 2);
            });
        }//end if sí elimina
    });
}; //end eliminar

const eliminar_datatable = (ruta = "", id=0, titulo='', mensaje='', table) => {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#7bb13c',
        cancelButtonColor: '#e84646',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    })
    .then((result) => {
        if(result.isConfirmed) {
            let data = new FormData();
            data.append('id', id);

            fetch(ruta, {
                method: 'POST',
                body: data
            })
            .then(res => {
                if(!res.ok) {
                    throw new Error('Ocurrió un error');
                }//end if
                return res.json();
            })
            .then(respuesta => {
                if(respuesta.error == 0){
                    alerta_modal('¡Registro Eliminado!', '¡El registro ha sido eliminado exitosamente!', 1);
                    table.ajax.reload(null, false);
                }//end if se actualiza
                else{
                    alerta_modal('¡Error!', 'Ocurrió un error al eliminar el registro', 2);
                }//end else se actualiza
            })
            .catch(error => {
                alerta_modal('¡Error!', 'Ocurrió un error al eliminar el registro', 2);
            });
        }//end if sí elimina
    });
}; //end eliminar_datatable




//====================================================
//FUNCIÓN PARA REALIZAR UNA CONFIRMACIÓN PERSONALIZADA
//====================================================
/*
* Función global para preguntar algo y luego realizar una acción
* Esta función funciona para realizar una petición al servidor pero antes de realizarlo preguntar.
* Esta función recibe 7 parámetros, los cuales son:
* titulo = Título para el mensaje que salga del SweetAlert
* body = Texto para el cuerpo del mensaje del sweetalert
* confirmText = Texto para el botón de confirmación
* cancelText = Texto para el botón de cancelación
* formOptions = Es un arreglo de 2 posiciones, que incluye: [0] = ruta para la solicitud; [1] = Método para el form (POST o GET)
* formData = Los elementos del formulario a enviar, puede ser vacío o no.
* icon = El tipo de SweetAlert a solicitar, puede ser success, warning, question o danger.
*/
const mensaje_confirmacion_texto_propio = (titulo = '', body = '', confirmText = '', cancelText = '', formOptions, formData, icon = 'warning') => {
    Swal.fire({
        title: titulo,
        text: body,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#7bb13c',
        cancelButtonColor: '#e84646',
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        reverseButtons: true
    })
    .then((result) => {
        if(result.isConfirmed) {
            fetch(formOptions[0], {
                method: formOptions[1],
                body: formData
            })
            .then(res => {
                if(!res.ok) {
                    throw new Error('Ocurrió un error');
                }//end if
                return res.json();
            })
            .then(respuesta => {
                alerta_modal(respuesta.mensaje.titulo, respuesta.mensaje.mensaje, respuesta.mensaje.tipo_mensaje);
                if(respuesta.error == 0){
                    if(respuesta.actions.length > 0){
                        for(let i = 0; i < respuesta.actions.length; i++){
                            eval(respuesta.actions[i]);
                        }//end for recorrer acciones a ejecutar
                    }//end if hay acciones a realizar
                }//end if la respuesta es correcta
                else{
                    if(respuesta.actions.length > 0){
                        for(let i = 0; i < respuesta.actions.length; i++){
                            eval(respuesta.actions[i]);
                        }//end for recorrer acciones a ejecutar
                    }//end if hay acciones a realizar
                }//end else la respuesta es correcta
            })
            .catch(error => {
                alerta_modal('¡Error!', 'Ocurrió un error al ejecutar la acción solicitada', 2);
            });
        }//end if se acepta la acción
    });
};//end mensaje_confirmacion_texto_propio
