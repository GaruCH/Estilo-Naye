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
                <h4 class="card-title mb-0 text-center">Lista de asignaciones</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-striped table-bordered" style="width:100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th class="special-cell">#</th>
                                <th class="special-cell">Producto</th>
                                <th class="special-cell">Descripción</th>
                                <th class="special-cell">Categorías</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            $productos_agrupados = [];

                            // Agrupar productos por ID
                            foreach ($productos_categorias as $producto_categoria) {
                                $productos_agrupados[$producto_categoria->id_producto]['nombre_producto'] = $producto_categoria->nombre_producto;
                                $productos_agrupados[$producto_categoria->id_producto]['descripcion_producto'] = $producto_categoria->descripcion_producto;
                                $productos_agrupados[$producto_categoria->id_producto]['categorias'][] = $producto_categoria->nombre_categoria;
                            }

                            foreach ($productos_agrupados as $id_producto => $producto) {
                                echo '<tr>';
                                echo '<td class="special-cell text-center">' . ++$num . '</td>';
                                echo '<td class="special-cell text-center">' . $producto['nombre_producto'] . '</td>';
                                echo '<td class="special-cell text-center">' . $producto['descripcion_producto'] . '</td>';
                                echo '<td class="special-cell text-center">';

                                // Mostrar categorías como lista o separadas por comas
                                echo '<ul class="list-unstyled mb-0">';
                                foreach ($producto['categorias'] as $categoria) {
                                    echo '<li><span class="badge bg-info">' . $categoria . '</span></li>';
                                }
                                echo '</ul>';

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
<script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/asignaciones.js") ?>"></script>
<?= $this->endSection(); ?>