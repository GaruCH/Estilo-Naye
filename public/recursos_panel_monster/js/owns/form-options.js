const resetear_formulario = (id_form = '', fields_to_clean, has_select = false) => {
    let validator = $("#"+id_form).validate();
    validator.resetForm();
    $("#"+id_form+" .form-control").removeClass("is-valid");
    $("#"+id_form+" .form-control").removeClass("is-invalid");
    if(has_select){
        $("#"+id_form+" .form-select").removeClass("is-valid");
        $("#"+id_form+" .form-select").removeClass("is-invalid");
    }//end if existe algún elemento select
    for(let index in fields_to_clean) {
        document.getElementById(index).value = fields_to_clean[index];
    }//end forin fields_to_clean
};//end resetear_formulario

const resetear_spawnear_elementos_formulario = (id_form = '', fields_to_clean, fields_to_spawn, has_select = false) => {
    let validator = $("#"+id_form).validate();
    validator.resetForm();
    $("#"+id_form+" .form-control").removeClass("is-valid");
    $("#"+id_form+" .form-control").removeClass("is-invalid");
    if(has_select){
        $("#"+id_form+" .form-select").removeClass("is-valid");
        $("#"+id_form+" .form-select").removeClass("is-invalid");
    }//end if existe algún elemento select
    for(let index in fields_to_clean) {
        document.getElementById(index).value = fields_to_clean[index];
    }//end forin fields_to_clean
    for(let index in fields_to_spawn) {
        document.getElementById(index).style.display = fields_to_spawn[index];
    }//end forin fields_to_clean
};//end resetear_spawnear_elementos_formulario


const deshabilitar_habilitar_formulario = (fields_to_block, estatus = 'true', action = 'hidden', btn_form = '') =>{
    let set_style = (action == 'hidden') ?  'none' : 'block';
    document.getElementById(btn_form).style.display = set_style;
    for(let index in fields_to_block) {
        document.getElementById(index).disabled = estatus;
    }//end forin fields_to_clean
}//deshabilitar_formulario
