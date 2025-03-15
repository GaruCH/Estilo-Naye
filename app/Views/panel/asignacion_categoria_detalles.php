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
                <h4 class="card-title">Editar asignación</h4>
                <h5 class="card-subtitle mb-3 pb-3 border-bottom">Todos los campos marcados con (<font color="red">*</font>) son obligatorios</h5>
                <?php
                $parametros = array(
                    'id' => 'formulario-asignacion-editar',
                    'class' => 'form-control'
                );
                echo form_open('editar_asignacion', $parametros);
                ?>

                <div class="row">

                    <!-- Mostrar el nombre del producto (solo lectura) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label">Producto: </label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-control',
                                'id' => 'nombre_producto',
                                'name' => 'nombre_producto',
                                'value' => $producto_categoria->nombre_producto,
                                'readonly' => 'readonly'
                            );
                            echo form_input($parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-box text-dark fill-white me-2"></i>Nombre del producto</label>
                        </div>
                    </div>

                    <!-- Selección de categoría mediante dropdown -->
                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Categoría: (<font color="red">*</font>)</label>
                        <div class="form-floating mb-3">
                            <?php
                            $parametros = array(
                                'class' => 'form-select',
                                'id' => 'categoria'
                            );
                            echo form_dropdown('categoria', $categorias, $producto_categoria->id_categoria, $parametros);
                            ?>
                            <div class="invalid-feedback"></div>
                            <label><i class="fas fa-lg fa-address-card text-dark fill-white me-2"></i>Categoría</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Campo oculto para el ID del producto -->
                    <?php
                    $parametros = array(
                        'type' => 'hidden',
                        'id' => 'id_producto',
                        'name' => 'id_producto',
                        'value' => $producto->id_producto
                    );
                    echo form_input($parametros);
                    ?>
                    
                </div>

                <div class="text-center">
                    <a type="button" href="<?= route_to('administracion_productos_categorias') ?>" class="btn btn-danger">
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

<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/asignacion_detalles.js") ?>"></script>
<?= $this->endSection(); ?>