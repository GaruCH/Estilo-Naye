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
        <a type="button" class="btn btn-primary" href="<?= route_to('nuevo_cita') ?>" style="margin-bottom: 15px;">
            <i class="fas fa-lg fa-plus-circle"></i> Agregar nueva cita
        </a>
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0 text-center">Lista de citas pendientes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th class="special-cell">#</th>
                                <th class="special-cell">Identificador</th>
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
                            $num = 0;
                            $estado = '';
                            foreach ($citas as $cita) {

                                switch ($cita->estado_cita) {
                                    case 1:
                                        $estado = 'PENDIENTE';
                                        break;
                                    case 2:
                                        $estado = 'CONFIRMADA';
                                        break;
                                    case -1:
                                        $estado = 'CANCELADA';
                                        break;
                                    default:
                                        $estado = 'ERROR';
                                        break;
                                }

                                echo '<tr>';
                                echo '<td class="special-cell text-center">' .
                                    ++$num .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $cita->codigo_persona .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $cita->nombre . ' ' . $cita->ap_paterno . ' ' . $cita->ap_materno .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $cita->fecha_cita .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $cita->hora_cita .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $cita->nombre_servicio .
                                    '</td>';
                                echo '<td class="special-cell text-center">' .
                                    $estado
                                    .
                                    '</td>';
                                echo '<td class="special-cell text-center" nowrap="nowrap">';
                                if (isset($cita->eliminacion)) {
                                    echo '<button type="button" class="btn btn-light-danger text-danger recover-cita btn-circle" id="recover-cita_' . $cita->id_cita . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Recuperar el cita">
                    							<i data-feather="rotate-ccw" class="feather fill-white"></i>
                    						  </button>';
                                } //end if el cita ha sido eliminado
                                else {
                                    if ($cita->estado_cita == 1) {
                                        echo '<button type="button" class="btn btn-success confirmar-cita btn-circle" id="' . $cita->id_cita . '_' . $cita->estado_cita . '" 
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Confirmar cita">
                                                <i data-feather="check" class="feather fill-white"></i>
                                              </button>';
                                        echo '&nbsp;&nbsp;&nbsp;';
                                        echo '<button type="button" class="btn btn-danger cancelar-cita btn-circle" id="' . $cita->id_cita . '_' . $cita->estado_cita . '" 
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar cita">
                                                <i data-feather="x" class="feather fill-white"></i>
                                              </button>';
                                    }

                                    echo '&nbsp;&nbsp;&nbsp;';
                                    echo '<a type="button" href="' . route_to('detalles_cita', $cita->id_cita) . '" class="btn btn-warning btn-circle" 
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Editar cita">
                                            <i data-feather="edit-3" class="feather fill-white"></i>
                                          </a>';

                                    echo '&nbsp;&nbsp;&nbsp;';
                                    echo '<button type="button" class="btn btn-danger eliminar-cita btn-circle" id="' . $cita->id_cita . '" 
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar cita">
                                            <i data-feather="trash-2" class="feather fill-white"></i>
                                          </button>';
                                } //end else el cita ha sido eliminado
                                echo '</td>';
                                echo '</tr>';
                            } //end foreach citas

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
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/citas.js") ?>"></script>
<?= $this->endSection(); ?>