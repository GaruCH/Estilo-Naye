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
                <h4 class="card-title">Registrar nuevo producto</h4>
                <h5 class="card-subtitle mb-3 pb-3 border-bottom">Todos los campos marcados con (<font color="red">*</font>) son obligatorios</h5>
                <?php
                $parametros = array('id' => 'formulario-producto-nuevo');
                echo form_open_multipart('registrar_producto', $parametros);
                ?>

                <div class="row">
                    <!-- Nombre del producto -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Nombre del producto: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'nombre_producto',
                                'name' => 'nombre_producto',
                                'placeholder' => 'Nombre del producto',
                                'value' => ''
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-concierge-bell text-dark fill-white me-2"></i>Nombre del producto</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Descripción del producto: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'descripcion_producto',
                                'name' => 'descripcion_producto',
                                'placeholder' => 'Descripción del producto',
                                'rows' => 4
                            );
                            echo form_textarea($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-info-circle text-dark fill-white me-2"></i>Descripción del producto</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Cantidad de producto -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Cantidad del producto: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'cantidad_producto',
                                'name' => 'cantidad_producto',
                                'type' => 'number',
                                'placeholder' => '0',
                                'value' => '',
                                'min' => 0
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-boxes text-dark fill-white me-2"></i>Cantidad del producto</label>
                        </div>
                    </div>

                    <!-- Stock mínimo -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Stock mínimo: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'stock_minimo_producto',
                                'name' => 'stock_minimo_producto',
                                'type' => 'number',
                                'placeholder' => '0',
                                'value' => '',
                                'min' => 0
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-layer-group text-dark fill-white me-2"></i>Stock mínimo</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Categorías del producto: (<font color="red">*</font>)</label>
                        <select class="form-control" id="categorias" name="categorias[]" multiple="multiple">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?= $categoria->id_categoria ?>">
                                    <?= $categoria->nombre_categoria ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


            </div>

            <div class="text-center">
                <a type="button" href="<?= route_to('administracion_productos') ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> Cancelar
                </a>
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary" type="submit" id="btn-guardar">
                    <i class="fa fa-lg fa-save"></i> Registrar producto
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


<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<!-- SweetAlert 2 -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/sweetalert2.all.min.js") ?>"></script>
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/sweetalert2/dist/manager-sweetalert2.js") ?>"></script>

<!-- jquery-validation Js -->
<script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/jquery-validation/dist/jquery.validate.min.js") ?>"></script>

<!-- Message Notification -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/message-notification.js") ?>"></script>

<!-- JS específico -->
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/producto_nuevo.js") ?>"></script>
<?= $this->endSection(); ?>