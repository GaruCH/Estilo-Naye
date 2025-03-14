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
        <a type="button" class="btn btn-primary" href="<?= route_to('nuevo_categoria') ?>" style="margin-bottom: 15px;">
            <i class="fas fa-lg fa-plus-circle"></i> Agregar nueva categoría
        </a>
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0 text-center">Lista de categorías</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                     <table class="datatable table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th class="special-cell">#</th>
                                <th class="special-cell">Nombre</th>
                                <th class="special-cell">Descripción</th>
                                <th class="special-cell">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $num = 0;
                                foreach ($categorias as $categoria) {
                                    echo '<tr>';
                                    echo '<td class="special-cell text-center">'.
                                            ++$num.
                                         '</td>';
                                    echo '<td class="special-cell text-center">'.
                                            $categoria->nombre_categoria.
                                          '</td>';
                                    echo '<td class="special-cell text-center">'.
                                            $categoria->descripcion_categoria.
                                         '</td>';
                                    echo '<td class="special-cell text-center" nowrap="nowrap">';
                                    if(isset($categoria->eliminacion)){
                    					echo '<button type="button" class="btn btn-light-danger text-danger recover-categoria btn-circle" id="recover-categoria_'.$categoria->id_categoria.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Recuperar el categoria">
                    							<i data-feather="rotate-ccw" class="feather fill-white"></i>
                    						  </button>';
                    				}//end if el categoria ha sido eliminado
                                    else{
                                        if(($categoria->estatus_categoria) == ESTATUS_HABILITADO)
                                            echo '<button type="button" class="btn btn-success estatus btn-circle" id="'.$categoria->id_categoria.'_'.$categoria->estatus_categoria.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Deshabilitar al categoria">
                                                        <i data-feather="toggle-right" class="feather fill-white"></i>
                                                  </button>';
                                        else
                                            echo '<button type="button" class="btn btn-secondary estatus btn-circle" id="'.$categoria->id_categoria.'_'.$categoria->estatus_categoria.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar al categoria">
                                                        <i data-feather="toggle-left" class="feather fill-white"></i>
                                                  </button>';
                                        echo '&nbsp;&nbsp;&nbsp;';
                                        echo '<a type="button" href="'.route_to('detalles_categoria', $categoria->id_categoria).'" class="btn btn-warning btn-circle" id="'.$categoria->id_categoria.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar al categoria">
                                                    <i data-feather="edit-3" class="feather fill-white"></i>
                                              </a>';
                                        echo '&nbsp;&nbsp;&nbsp;';
                                        echo '<button type="button" class="btn btn-danger eliminar-categoria btn-circle" id="'.$categoria->id_categoria.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar al categoria">
                                                    <i data-feather="trash-2" class="feather fill-white"></i>
                                              </button>';
                                    }//end else el categoria ha sido eliminado
                                    echo '</td>';
                                    echo '</tr>';
                                }//end foreach categorias
                                
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
    <script src="<?php echo base_url(RECURSOS_PANEL_JS."/specifics/categorias.js") ?>"></script>
<?= $this->endSection(); ?>
