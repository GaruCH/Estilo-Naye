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
                <h4 class="card-title">Registrar nuevo servicio</h4>
                <h5 class="card-subtitle mb-3 pb-3 border-bottom">Todos los campos marcados con (<font color="red">*</font>) son obligatorios</h5>
                <?php
                $parametros = array('id' => 'formulario-servicio-nuevo');
                echo form_open_multipart('registrar_servicio', $parametros);
                ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Nombre del servicio: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'nombre_servicio',
                                'name' => 'nombre_servicio',
                                'placeholder' => 'Nombre del servicio',
                                'value' => ''
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-concierge-bell text-dark fill-white me-2"></i>Nombre del servicio</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Precio del servicio: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'precio_servicio',
                                'name' => 'precio_servicio',
                                'type' => 'number',
                                'step' => '0.01',
                                'placeholder' => '0.00',
                                'value' => ''
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-dollar-sign text-dark fill-white me-2"></i>Precio del servicio</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-control-label">Descripción del servicio: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'descripcion_servicio',
                                'name' => 'descripcion_servicio',
                                'placeholder' => 'Descripción del servicio',
                                'rows' => 4
                            );
                            echo form_textarea($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-info-circle text-dark fill-white me-2"></i>Descripción del servicio</label>
                        </div>
                    </div>
                </div>

                

                <div class="text-center">
                    <a type="button" href="<?= route_to('administracion_servicios') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit" id="btn-guardar"><i class="fa fa-lg fa-save"></i> Registrar servicio</button>
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
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/servicio_nuevo.js") ?>"></script>
<?= $this->endSection(); ?>