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
                <h4 class="card-title">Editar historial_producto</h4>
                <h5 class="card-subtitle mb-3 pb-3 border-bottom">Todos los campos marcados con (<font color="red">*</font>) son obligatorios</h5>
                <?php
                $parametros = array('id' => 'formulario-citas_producto-editar');
                echo form_open_multipart('editar_citas_producto', $parametros);
                ?>

                <div class="row">
                    <!-- ID de la persona -->
                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">ID de la persona:</label>
                        <div class="form-floating mb-3">
                            <?= form_input([
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'id_persona',
                                'name' => 'id_persona',
                                'value' => $cita->codigo_persona,
                                'readonly' => true
                            ]); ?>
                            <label><i class="fas fa-id-badge text-dark me-2"></i>ID de la persona</label>
                        </div>
                    </div>

                    <!-- Fecha de la cita -->
                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Fecha de la cita:</label>
                        <div class="form-floating mb-3">
                            <?= form_input([
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'fecha_cita',
                                'name' => 'fecha_cita',
                                'value' => $cita->fecha_cita,
                                'readonly' => true
                            ]); ?>
                            <label><i class="fas fa-calendar-alt text-dark me-2"></i>Fecha de la cita</label>
                        </div>
                    </div>

                    <!-- Paciente -->
                    <div class="col-md-4 mb-3">
                        <label class="form-control-label">Paciente:</label>
                        <div class="form-floating mb-3">
                            <?= form_input([
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'paciente',
                                'name' => 'paciente',
                                'value' => $cita->nombre . ' ' . $cita->ap_paterno . ' ' . $cita->ap_materno,
                                'readonly' => true
                            ]); ?>
                            <label><i class="fas fa-user text-dark me-2"></i>Paciente</label>
                        </div>
                    </div>
                </div>

                <!-- Lista dinámica de productos -->
                <div id="productos-lista">
                    <?php
                    if (!empty($productos_cita)) {
                        foreach ($productos_cita as $producto) {
                    ?>
                            <div class="producto-item row mb-2">
                                <div class="col-md-8">
                                    <select class="form-control" name="productos[]">
                                        <option value="">-- Seleccionar producto --</option>
                                        <?php foreach ($productos as $producto_opcion) : ?>
                                            <option value="<?= $producto_opcion->id_producto ?>" <?= $producto_opcion->id_producto == $producto->id_producto ? 'selected' : '' ?>>
                                                <?= $producto_opcion->nombre_producto ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="unidades[]" min="1" value="<?= $producto->unidad ?>" required>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger eliminar-producto">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="producto-item row mb-2">
                            <div class="col-md-8">
                                <select class="form-control" name="productos[]">
                                    <option value="">-- Seleccionar producto --</option>
                                    <?php foreach ($productos as $producto) : ?>
                                        <option value="<?= $producto->id_producto ?>"><?= $producto->nombre_producto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="unidades[]" min="1" required>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger eliminar-producto">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Botón para agregar productos -->
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-success" id="agregar-producto">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </button>
                </div>


                <!-- Campo oculto para ID de la cita -->
                <?= form_hidden('id_cita', $cita->id_cita) ?>

                <div class="text-center">
                    <a href="<?= route_to('historial_citas_productos') ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancelar
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Guardar Cambios
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

<script>
    let opcionesProductos = <?php
                            $html = '<option value="">-- Seleccionar producto --</option>';
                            foreach ($productos as $producto) {
                                $html .= '<option value="' . $producto->id_producto . '">' . $producto->nombre_producto . '</option>';
                            }
                            echo json_encode($html);
                            ?>;
</script>


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

<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/historial_producto_detalles.js") ?>"></script>
<?= $this->endSection(); ?>