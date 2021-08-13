<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SISPRO APR</title>
        <link rel="icon" href="<?php echo base_url(); ?>/imagenes/icono.png" type="image/png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/jqvmap/jqvmap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/estilo_extra.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/bootstrap-toaster/css/bootstrap-toaster.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>
    <body class="bg-primary">
        <input type="hidden" name="txt_base_url" id="txt_base_url" value="<?php echo base_url(); ?>">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h2 class="text-center font-weight-light my-4 text-dark">SysProAPR</h2>
                            </div>
                            <div class="card-body">
                                <form id="form_login">
                                    <div class="form-group">
                                        <label class="small mb-1" for="txt_usuario">Usuario</label>
                                        <input class="form-control py-4" id="txt_usuario" name="txt_usuario" placeholder="Ingresar usuario" />
                                    </div>
                                    <div class="form-group" id="divClave">
                                        <label class="small mb-1" for="txt_clave">Clave</label>
                                        <input class="form-control py-4" id="txt_clave" name="txt_clave" type="password" placeholder="Ingresar clave" />
                                    </div>
                                    <div class="form-group d-none" id="divClaveActivar">
                                        <label class="small mb-1" for="txt_clave_activar">Ingrese su clave</label>
                                        <input class="form-control py-4" id="txt_clave_activar" name="txt_clave_activar" type="password" placeholder="Ingresar clave para activar" />
                                    </div>
                                    <div class="form-group d-none" id="divClaveRepetir">
                                        <label class="small mb-1" for="txt_clave_repetir">Repita su clave</label>
                                        <input class="form-control py-4" id="txt_clave_repetir" name="txt_clave_repetir" type="password" placeholder="Ingresar clave" />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href=""></a>
                                        <button class="btn btn-primary" type="button" id="btn_login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <h5 class="text-center font-weight-light my-4 text-dark">Sociedad de Inversiones y Servicios Informáticos MPS SpA</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
        <script src="<?php echo base_url(); ?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript" ></script>
        <script src="<?php echo base_url(); ?>/plugins/bootstrap-toaster/js/bootstrap-toaster.min.js" type="text/javascript" ></script>
        <script src="<?php echo base_url(); ?>/js/login.js" type="text/javascript" ></script>
    </body>
</html>
