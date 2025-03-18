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
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0 text-center">Historial de productos consumidos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th class="special-cell">#</th>
                                <th class="special-cell">Identificador</th>
                                <th class="special-cell">Paciente</th>
                                <th class="special-cell">Producto</th>
                                <th class="special-cell">Cantidad</th>
                                <th class="special-cell">Fecha cita</th>
                                <th class="special-cell">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            foreach ($citas_productos as $cita) {
                                echo '<tr>';
                                echo '<td class="special-cell text-center">' . ++$num . '</td>';
                                echo '<td class="special-cell text-center">' . $cita->codigo_persona . '</td>';
                                echo '<td class="special-cell text-center">' . $cita->paciente . '</td>';
                                echo '<td class="special-cell text-center">' . $cita->productos . '</td>';
                                echo '<td class="special-cell text-center">' . $cita->cantidades . '</td>';
                                echo '<td class="special-cell text-center">' . $cita->fecha_cita . '</td>';
                                echo '<td class="special-cell text-center" nowrap="nowrap">';
                                echo '<a type="button" href="' . route_to('detalles_citas_producto', $cita->id_cita) . '" class="btn btn-warning btn-circle">
                                <i data-feather="edit-3" class="feather fill-white"></i>
                              </a>';

                                echo '</td>';
                                echo '</tr>';
                            }
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
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/citas_productos.js") ?>"></script>
<?= $this->endSection(); ?>