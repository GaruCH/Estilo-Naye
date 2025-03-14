<?= $this->extend("plantilla/panel_base") ?>

<?= $this->section("css") ?>
<!-- Datatables JS -->
<link href="<?= base_url(RECURSOS_PANEL_PLUGINS . '/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">

<!-- SweetAlert 2 -->
<link href="<?= base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/sweetalert2.min.css") ?>" rel="stylesheet">

<!-- Special Style -->
<link href="<?= base_url(RECURSOS_PANEL_CSS . "/style_owns.css") ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section("contenido") ?>

<div class="row">
    <div class="col-12">
        <a type="button" class="btn btn-primary" href="<?= route_to('nuevo_producto') ?>" style="margin-bottom: 15px;">
            <i class="fas fa-lg fa-plus-circle"></i> Agregar nuevo producto
        </a>
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0 text-center">Lista de productos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th class="special-cell">#</th>
                                <th class="special-cell">Nombre</th>
                                <th class="special-cell">Descripción</th>
                                <th class="special-cell">Cantidad</th>
                                <th class="special-cell">Stock Minimo</th>
                                <th class="special-cell">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            foreach ($productos as $producto) {
                                echo '<tr>';
                                echo '<td class="special-cell text-center">' .
                                    ++$num .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $producto->nombre_producto .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $producto->descripcion_producto .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $producto->cantidad_producto .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $producto->stock_minimo_producto .
                                    '</td>';
                                echo '<td class="special-cell text-center" nowrap="nowrap">';
                                if (isset($producto->eliminacion)) {
                                    echo '<button type="button" class="btn btn-light-danger text-danger recover-producto btn-circle" id="recover-producto_' . $producto->id_producto . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Recuperar el producto">
                    							<i data-feather="rotate-ccw" class="feather fill-white"></i>
                    						  </button>';
                                } //end if el producto ha sido eliminado
                                else {
                                    if (($producto->estatus_producto) == ESTATUS_HABILITADO)
                                        echo '<button type="button" class="btn btn-success estatus btn-circle" id="' . $producto->id_producto . '_' . $producto->estatus_producto . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Deshabilitar al producto">
                                                        <i data-feather="toggle-right" class="feather fill-white"></i>
                                                  </button>';
                                    else
                                        echo '<button type="button" class="btn btn-secondary estatus btn-circle" id="' . $producto->id_producto . '_' . $producto->estatus_producto . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar al producto">
                                                        <i data-feather="toggle-left" class="feather fill-white"></i>
                                                  </button>';
                                    echo '&nbsp;&nbsp;&nbsp;';
                                    echo '<a type="button" href="' . route_to('detalles_producto', $producto->id_producto) . '" class="btn btn-warning btn-circle" id="' . $producto->id_producto . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar al producto">
                                                    <i data-feather="edit-3" class="feather fill-white"></i>
                                              </a>';
                                    echo '&nbsp;&nbsp;&nbsp;';
                                    echo '<button type="button" class="btn btn-danger eliminar-producto btn-circle" id="' . $producto->id_producto . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar al producto">
                                                    <i data-feather="trash-2" class="feather fill-white"></i>
                                              </button>';
                                } //end else el producto ha sido eliminado
                                echo '</td>';
                                echo '</tr>';
                            } //end foreach productos

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
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/datatables/media/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/datatables/media/js/custom-datatable.js") ?>"></script>
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/datatables/media/js/managerDataTables.js") ?>"></script>

<!-- SweetAlert 2 -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/sweetalert2.all.min.js") ?>"></script>
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/manager-sweetalert2.js") ?>"></script>

<!-- jquery-validation Js -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/jquery-validation/dist/jquery.validate.min.js") ?>"></script>

<!-- Form-options JS -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/form-options.js") ?>"></script>

<!-- JS específico -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/productos.js") ?>"></script>
<?= $this->endSection(); ?>