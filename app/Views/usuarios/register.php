<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, monster admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, ">
    <meta name="description" content="Monster is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title><?= $titulo_pag ?></title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(IMG_DIR_SISTEMA . '/' . FAV_ICON_SISTEMA) ?>">
    <!-- Custom CSS -->
    <link href="<?= base_url(RECURSOS_PANEL_CSS . '/style.min.css') ?>" rel="stylesheet">
    <!-- Notification css (Toastr) -->
    <link href="<?= base_url(RECURSOS_PANEL_PLUGINS . '/toastr/dist/build/toastr.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url(RECURSOS_PANEL_PLUGINS . '/toastr/dist/build/toastr_manager.css'); ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#009efb" stroke-width="2"></path>
                <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#009efb" stroke-width="2"></path>
                <path id="teabag" fill="#009efb" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
                <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#009efb"></path>
                <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#009efb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="row shadow-lg rounded-lg overflow-hidden bg-white" style="max-width: 900px; width: 100%; height: 600px;">
                <!-- Sección de Imagen -->
                <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-primary p-4">
                    <img src="<?= base_url(RECURSOS_IMG . '/login-1.jpg'); ?>" class="img-fluid border border-white rounded" alt="login-image" />
                </div>

                <!-- Sección de Formulario -->
                <div class="col-md-6 p-5" style="overflow-y: auto; max-height: 600px;">
                    <!-- Encabezado del formulario -->
                    <div class="mb-4 text-center">
                        <img src="<?= base_url(IMG_DIR_SISTEMA . '/logo_color.svg') ?>" alt="logo" class="img-fluid mb-3" style="max-height: 300px;">
                        <h3 class="fw-bold">Registro</h3>
                        <p class="text-muted">Crea una cuenta para continuar</p>
                    </div>

                    <h5 class="card-subtitle mb-3 pb-3 border-bottom text-center">
                        Todos los campos marcados con (<font color="red">*</font>) son obligatorios
                    </h5>

                    <?php
                    $parametros = array('id' => 'formulario-registro');
                    echo form_open('registrar_paciente', $parametros);
                    ?>

                    <div class="row">
                        <!-- Nombre -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Nombre: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'nombre',
                                    'name' => 'nombre',
                                    'placeholder' => 'Nombre',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="nombre"><i class="fas fa-user me-2"></i>Nombre</label>
                            </div>
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Apellido Paterno: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'ap_paterno',
                                    'name' => 'ap_paterno',
                                    'placeholder' => 'Apellido Paterno',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="ap_paterno"><i class="fas fa-user me-2"></i>Apellido Paterno</label>
                            </div>
                        </div>

                        <!-- Apellido Materno -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Apellido Materno: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'ap_materno',
                                    'name' => 'ap_materno',
                                    'placeholder' => 'Apellido Materno',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="ap_materno"><i class="fas fa-user me-2"></i>Apellido Materno</label>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Teléfono: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'telefono',
                                    'name' => 'telefono',
                                    'placeholder' => 'Teléfono',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="telefono"><i class="fas fa-phone me-2"></i>Teléfono</label>
                            </div>
                        </div>

                        <!-- Sexo -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Sexo: (<font color="red">*</font>)</label><br>
                            <div class="form-check form-check-inline mb-3">
                                <?php
                                $parametros = array(
                                    'id' => 'masculino',
                                    'name' => 'sexo',
                                    'class' => 'form-check-input radio-item'
                                );
                                echo form_radio($parametros, SEXO_MASCULINO);
                                ?>
                                <label class="form-check-label" for="masculino"><i class="fas fa-mars text-dark fill-white me-2"></i>Masculino</label>
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <?php
                                $parametros = array(
                                    'id' => 'femenino',
                                    'name' => 'sexo',
                                    'class' => 'form-check-input radio-item'
                                );
                                echo form_radio($parametros, SEXO_FEMENINO);
                                ?>
                                <label class="form-check-label" for="femenino"><i class="fas fa-venus text-dark fill-white me-2"></i>Femenino</label>
                            </div>
                        </div>

                        <!-- Correo -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Correo: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'correo',
                                    'name' => 'correo',
                                    'placeholder' => 'Correo electrónico',
                                    'type' => 'email',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="correo"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Contraseña: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'password',
                                    'name' => 'password',
                                    'placeholder' => 'Contraseña',
                                    'type' => 'password',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="password"><i class="fas fa-lock me-2"></i>Contraseña</label>
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="col-12 mb-3">
                            <label class="form-control-label">Confirmar Contraseña: (<font color="red">*</font>)</label>
                            <div class="form-floating">
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'confirm_password',
                                    'name' => 'confirm_password',
                                    'placeholder' => 'Confirmar contraseña',
                                    'type' => 'password',
                                    'required' => 'required'
                                );
                                echo form_input($parametros);
                                ?>
                                <div class="invalid-feedback"></div>
                                <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirmar Contraseña</label>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="text-center mt-4">
                        <a href="<?= route_to('usuario_login') ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Cancelar
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check"></i> Enviar datos
                        </button>
                    </div>

                    <?= form_close() ?>

                </div>
            </div>
        </div>


        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url(RECURSOS_PANEL_PLUGINS . '/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(RECURSOS_PANEL_PLUGINS . '/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url(RECURSOS_PANEL_JS . '/constants.js'); ?>"></script>

    <script src="<?= base_url(RECURSOS_PANEL_PLUGINS . '/toastr/dist/build/toastr.min.js'); ?>"></script>

    <!-- jquery-validation Js -->
    <script src="<?php echo base_url(RECURSOS_PANEL_PLUGINS . "/jquery-validation/dist/jquery.validate.min.js") ?>"></script>

    <!-- Message Notification -->
    <script src="<?php echo base_url(RECURSOS_PANEL_JS . "/owns/message-notification.js") ?>"></script>

    <!-- JS específico -->
    <script src="<?php echo base_url(RECURSOS_PANEL_JS . "/specifics/register.js") ?>"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>

    <?= mostrar_mensaje(); ?>
</body>

</html>