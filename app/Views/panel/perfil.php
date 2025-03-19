<?= $this->extend("plantilla/panel_base") ?>

<?= $this->section("css") ?>

<?= $this->endSection(); ?>

<?= $this->section("contenido") ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <center>
                    <?php
                    // Definir la imagen por defecto basada en el sexo
                    $imagen_default = ($usuario->sexo === SEXO_FEMENINO) ? 'no-image-f.png' : 'no-image-m.png';

                    // Verificar si la imagen del usuario está disponible
                    $imagen_user = !empty($usuario->imagen) ? base_url(IMG_DIR_USUARIOS . '/' . $usuario->imagen) : base_url(IMG_DIR_USUARIOS . '/' . $imagen_default);
                    ?>
                    <img src="<?= $imagen_user ?>" alt="imagen_usuario" class="avatar-img rounded-circle" width="150px" id="img" style="margin-bottom: 15px;" data-default-src="<?= base_url(IMG_DIR_USUARIOS . '/' . $imagen_default); ?>">
                </center>

                <?php
                $parametros = array('id' => 'formulario-imagen-nueva');
                echo form_open_multipart('cambiar_imagen', $parametros);
                ?>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Nombre(s):</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario->nombre ?>" readonly>
                            <label><i data-feather="user" class="feather-sm text-dark fill-white me-2"></i>Nombre(s)</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Apellido paterno:</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" value="<?= $usuario->ap_paterno ?>" readonly>
                            <label><i data-feather="user" class="feather-sm text-dark fill-white me-2"></i>Apellido paterno</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Apellido materno:</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="ap_materno" name="ap_materno" value="<?= $usuario->ap_materno ?>" readonly>
                            <label><i data-feather="user" class="feather-sm text-dark fill-white me-2"></i>Apellido materno</label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Sexo:</label><br>
                        <div class="form-check form-check-inline mb-3">
                            <input type="radio" id="masculino" name="sexo" class="form-check-input radio-item" value="masculino" <?= $usuario->sexo == SEXO_MASCULINO ? 'checked' : '' ?> disabled>
                            <label class="form-check-label" for="masculino"><i class="fas fa-mars text-dark fill-white me-2"></i>Masculino</label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input type="radio" id="femenino" name="sexo" class="form-check-input radio-item" value="femenino" <?= $usuario->sexo == SEXO_FEMENINO ? 'checked' : '' ?> disabled>
                            <label class="form-check-label" for="femenino"><i class="fas fa-venus text-dark fill-white me-2"></i>Femenino</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Correo:</label>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="correo" name="email" value="<?= $usuario->correo ?>" readonly>
                            <label><i data-feather="at-sign" class="feather-sm text-dark fill-white me-2"></i>E-mail</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Imagen de perfil: </label>
                        <div class="input-group">
                            <?php
                            $parametros = array(
                                'type' => 'file',
                                'class' => 'form-control',
                                'name' => 'imagen_perfil',
                                'id' => 'imagen_perfil',
                                'onchange' => "validate_image(this, 'img', 'btn-guardar', '../recursos_panel_monster/images/profile-images/no-image-m.png', 512, 512);",
                                'accept' => '.png, .jpeg, .jpg'
                            );
                            echo form_input($parametros);
                            ?>
                        </div>
                    </div>

                </div>

                <div class="text-center">
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit" id="btn-guardar"><i class="fa fa-lg fa-save">

                            <?php
                            $parametros = array(
                                'type' => 'hidden',
                                'id' => 'id_usuario',
                                'name' => 'id_usuario',
                                'value' => $usuario->id_persona
                            );
                            echo form_input($parametros);
                            ?>
                        </i> Guardar cambios</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal loading -->
<div id="loader"></div>

<?= $this->endSection(); ?>

<?= $this->section("js") ?>

<!-- Preview Image -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/preview-image.js") ?>"></script>

<!-- SweetAlert 2 -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/sweetalert2.all.min.js") ?>"></script>
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/manager-sweetalert2.js") ?>"></script>

<!-- Message Notification -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/message-notification.js") ?>"></script>

<!-- Loader Generator -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/loader-generator.js") ?>"></script>

<!-- Form-options JS -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/form-options.js") ?>"></script>

<!-- JS específico -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/perfil.js") ?>"></script>


<?= $this->endSection(); ?>