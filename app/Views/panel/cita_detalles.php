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
                <h4 class="card-title">Editar cita</h4>
                <h5 class="card-subtitle mb-3 pb-3 border-bottom">Todos los campos marcados con (<font color="red">*</font>) son obligatorios</h5>
                <?php
                $parametros = array('id' => 'formulario-cita-editar');
                echo form_open_multipart('editar_cita', $parametros);
                ?>

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
                                'placeholder' => 'Fecha de la cita',
                                'value' => $cita->fecha_cita
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-calendar-alt text-dark fill-white me-2"></i>Fecha de la cita</label>
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
                                'placeholder' => 'Hora de la cita',
                                'value' => $cita->hora_cita
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-clock text-dark fill-white me-2"></i>Hora de la cita</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- persona -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Paciente: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <select class="form-control" id="id_persona" name="id_persona">
                                <option value="">-- Seleccionar paciente --</option>
                                <?php foreach ($personas as $persona) : ?>
                                    <option value="<?= $persona->id_persona ?>" <?= ($persona->id_persona == $cita->id_persona) ? 'selected' : '' ?>>
                                    <?= $persona->codigo_persona?>  <?= $persona->nombre ?> <?= $persona->ap_paterno ?> <?= $persona->ap_materno ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-user text-dark fill-white me-2"></i>Paciente</label>
                        </div>
                    </div>


                    <!-- Servicio -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Servicio: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <select class="form-control" id="id_servicio" name="id_servicio">
                                <option value="">-- Seleccionar servicio --</option>
                                <?php foreach ($servicios as $servicio) : ?>
                                    <option value="<?= $servicio->id_servicio ?>" <?= ($servicio->id_servicio == $cita->id_servicio) ? 'selected' : '' ?>>
                                        <?= $servicio->nombre_servicio ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-book text-dark fill-white me-2"></i>Servicio</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Campo oculto para ID de la cita -->
                    <?php
                    $parametros = array(
                        'type' => 'hidden',
                        'id' => 'id_cita',
                        'name' => 'id_cita',
                        'value' => $cita->id_cita
                    );
                    echo form_input($parametros);
                    ?>
                </div>

                <div class="text-center">
                    <a type="button" href="<?= route_to('administracion_citas') ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit" id="btn-guardar">
                        <i class="fa fa-lg fa-save"></i> Guardar cambios
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

<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/cita_detalles.js") ?>"></script>
<?= $this->endSection(); ?>