<?= $this->extend("plantilla/panel_base") ?>

<?= $this->section("css") ?>
    <!-- Datatables JS -->
    <link href="<?= base_url(RECURSOS_PANEL_PLUGINS.'/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">

    <!-- SweetAlert 2 -->
    <link href="<?= base_url(RECURSOS_PANEL_PLUGINS."/sweetalert2/dist/sweetalert2.min.css") ?>" rel="stylesheet">

    <!-- Special Style -->
    <link href="<?= base_url(RECURSOS_PANEL_CSS."/style_owns.css") ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section("contenido") ?>

<div class="row">
    <div class="col-12">
        <a type="button" class="btn btn-primary" href="<?= route_to('nueva_cita') ?>" style="margin-bottom: 15px;">
            <i class="fas fa-lg fa-plus-circle"></i> Agregar nueva cita
        </a>
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0 text-center">Lista de citas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                     <table class="datatable table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th class="special-cell">#</th>
                                <th class="special-cell">Nombre</th>
                                <th class="special-cell">Fecha</th>
                                <th class="special-cell">Hora</th>
                                <th class="special-cell">Servicio</th>
                                <th class="special-cell">Estado</th>
                                <th class="special-cell">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               /* $num = 0;
                                foreach ($usuarios as $usuario) {
                                    echo '<tr>';
                                    echo '<td class="special-cell text-center">'.
                                            ++$num.
                                         '</td>';
                                    echo '<td class="special-cell text-center">'.
                                            $usuario->nombre.' '.$usuario->ap_paterno.' '.$usuario->ap_materno.
                                          '</td>';
                                    echo '<td class="special-cell text-center">'.
                                            $usuario->correo.
                                         '</td>';
                                    echo '<td class="special-cell text-center">'.
                                            $usuario->nombre_rol.
                                         '</td>';
                                    echo '<td class="special-cell text-center" nowrap="nowrap">';
                                    if(isset($usuario->eliminacion)){
                    					echo '<button type="button" class="btn btn-light-danger text-danger recover-user btn-circle" id="recover-user_'.$usuario->id_persona.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Recuperar el usuario">
                    							<i data-feather="rotate-ccw" class="feather fill-white"></i>
                    						  </button>';
                    				}//end if el usuario ha sido eliminado
                                    else{
                                        if(($usuario->estatus_usuario) == ESTATUS_HABILITADO)
                                            echo '<button type="button" class="btn btn-success estatus btn-circle" id="'.$usuario->id_usuario.'_'.$usuario->estatus_usuario.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Deshabilitar al usuario">
                                                        <i data-feather="toggle-right" class="feather fill-white"></i>
                                                  </button>';
                                        else
                                            echo '<button type="button" class="btn btn-secondary estatus btn-circle" id="'.$usuario->id_usuario.'_'.$usuario->estatus_usuario.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar al usuario">
                                                        <i data-feather="toggle-left" class="feather fill-white"></i>
                                                  </button>';
                                        echo '&nbsp;&nbsp;&nbsp;';
                                        echo '<a type="button" href="'.route_to('detalles_usuario', $usuario->id_usuario).'" class="btn btn-warning btn-circle" id="'.$usuario->id_usuario.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar al usuario">
                                                    <i data-feather="edit-3" class="feather fill-white"></i>
                                              </a>';
                                        echo '&nbsp;&nbsp;&nbsp;';
                                        echo '<button type="button" class="btn btn-info change-password btn-circle" id="p_'.$usuario->id_usuario.'" data-bs-toggle="tooltip" data-bs-target="#editar-seccion" data-bs-placement="top" title="Cambiar contraseña del usuario">
                                                    <i data-feather="unlock" class="feather feather-sm fill-white"></i><i data-feather="rotate-ccw" class="feather feather-sm fill-white" style="width: 12px; height: 12px;"></i>
                                              </button>';
                                        echo '&nbsp;&nbsp;&nbsp;';
                                        echo '<button type="button" class="btn btn-danger eliminar btn-circle" id="'.$usuario->id_persona.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar al usuario">
                                                    <i data-feather="trash-2" class="feather fill-white"></i>
                                              </button>';
                                    }//end else el usuario ha sido eliminado
                                    echo '</td>';
                                    echo '</tr>';
                                }//end foreach usuarios
                                */
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>

<?= $this->section("js") ?>
    <!-- Datatables JS -->
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS."/datatables/media/js/jquery.dataTables.min.js") ?>"></script>
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS."/datatables/media/js/custom-datatable.js") ?>"></script>
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS."/datatables/media/js/managerDataTables.js") ?>"></script>

    <!-- SweetAlert 2 -->
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS."/sweetalert2/dist/sweetalert2.all.min.js") ?>"></script>
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS."/sweetalert2/dist/manager-sweetalert2.js") ?>"></script>

    <!-- jquery-validation Js -->
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS."/jquery-validation/dist/jquery.validate.min.js") ?>"></script>

    <!-- Form-options JS -->
    <script src="<?php echo base_url(RECURSOS_PANEL_JS."/owns/form-options.js") ?>"></script>

    <!-- JS específico -->
    <script src="<?php echo base_url(RECURSOS_PANEL_JS."/specifics/citas.js") ?>"></script>
<?= $this->endSection(); ?>
