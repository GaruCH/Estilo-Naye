<?= $this->extend("plantilla/panel_base") ?>

<?= $this->section("css") ?>
<!-- SweetAlert 2 -->
<link rel="stylesheet" href="<?= base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/sweetalert2.min.css") ?>">
<?= $this->endSection(); ?>

<?= $this->section("contenido") ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar nueva cita</h4>
                <h5 class="card-subtitle mb-3 pb-3 border-bottom">Todos los campos marcados con (<font color="red">*</font>) son obligatorios</h5>
                <?php
                $parametros = array('id' => 'formulario-cita-nuevo');
                echo form_open_multipart('registrar_cita', $parametros);
                ?>

                <div class="row">
                    <!-- persona -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Paciente: (<font color="red">*</font>)</label>
                        <?php
                        $parametros = array('class' => 'form-select', 'id' => 'id_persona');
                        $opciones_personas = ['' => 'Seleccione un persona...'];
                        foreach ($personas as $persona) {
                            $opciones_personas[$persona->id_persona] = $persona->codigo_persona. ' - '. $persona->nombre . ' ' . $persona->ap_paterno . ' ' . $persona->ap_materno;
                        }
                        echo form_dropdown('id_persona', $opciones_personas, null, $parametros);
                        ?>
                    </div>

                    <!-- Servicio -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Servicio: (<font color="red">*</font>)</label>
                        <?php
                        $parametros = array('class' => 'form-select', 'id' => 'id_servicio');
                        $opciones_servicios = ['' => 'Seleccione un servicio...'];
                        foreach ($servicios as $servicio) {
                            $opciones_servicios[$servicio->id_servicio] = $servicio->nombre_servicio;
                        }
                        echo form_dropdown('id_servicio', $opciones_servicios, null, $parametros);
                        ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Fecha de la cita -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Fecha de la cita: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'type' => 'date',
                                'class' => 'form-control',
                                'id' => 'fecha_cita',
                                'name' => 'fecha_cita',
                                'placeholder' => 'Seleccione una fecha'
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-calendar-alt text-dark fill-white me-2"></i> Fecha de la cita</label>
                        </div>
                    </div>

                    <!-- Hora de la cita -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Hora de la cita: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'type' => 'time',
                                'class' => 'form-control',
                                'id' => 'hora_cita',
                                'name' => 'hora_cita',
                                'placeholder' => 'Seleccione una hora'
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-clock text-dark fill-white me-2"></i> Hora de la cita</label>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a type="button" href="<?= route_to('administracion_citas') ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit" id="btn-guardar">
                        <i class="fa fa-lg fa-save"></i> Registrar cita
                    </button>
                </div>

                <?= form_close() ?>



            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("js") ?>
<!-- Preview Image -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/preview-image.js") ?>"></script>

<!-- SweetAlert 2 -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/sweetalert2.all.min.js") ?>"></script>
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/manager-sweetalert2.js") ?>"></script>

<!-- jquery-validation Js -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/jquery-validation/dist/jquery.validate.min.js") ?>"></script>

<!-- Message Notification -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/message-notification.js") ?>"></script>

<!-- JS específico -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/cita_nuevo.js") ?>"></script>
<?= $this->endSection(); ?>