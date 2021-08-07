        <div id="dlg_actualizar_clave" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Actualizar Clave</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="form_actualizar_clave" name="form_actualizar_clave" encType="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small mb-1" for="txt_clave_actual">Clave Actual</label>
                                            <input type='password' class="form-control" id='txt_clave_actual' name="txt_clave_actual" />
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small mb-1" for="txt_clave_nueva">Clave Nueva</label>
                                            <input type='password' class="form-control" id='txt_clave_nueva' name="txt_clave_nueva" />
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small mb-1" for="txt_repetir">Repetir Clave Nueva</label>
                                            <input type='password' class="form-control" id='txt_repetir' name="txt_repetir" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn_actualizar" name="btn_actualizar">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
	  	<footer class="main-footer">
	    	<strong>Copyright &copy; 2021 <a href="#">Sociedad de Inversiones y Servicios Informáticos MPS SpA</a>.</strong>
	    	Todos los Derechos Reservados.
	    	<div class="float-right d-none d-sm-inline-block">
	      		<b>Versión</b> 1.0
	    	</div>
	  	</footer>
	</div>
	<script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script>
	  $.widget.bridge('uibutton', $.ui.button)
	</script>
	<script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/sparklines/sparkline.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/moment/locales.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/summernote/summernote-bs4.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables/jquery.dataTables.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables/sum().js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables/dataTables.bootstrap4.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables/fnReloadAjax.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-select/js/dataTables.select.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/jszip/jszip.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/pdfmake/pdfmake.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/pdfmake/vfs_fonts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/plugins/bootstrap-toaster/js/bootstrap-toaster.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.all.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js" type="text/javascript" ></script>
	<script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>
	<script src="<?php echo base_url(); ?>/dist/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/personalizados/formato-peso.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/personalizados/valida-rut.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/personalizados/convertir-mayusculas.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>/plugins/loader-screen-bar/js/JQLoader.js" type="text/javascript" ></script>
	<script src="<?php echo base_url(); ?>/js/menu.js"></script>
</body>
</html>