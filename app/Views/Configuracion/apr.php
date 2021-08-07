<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-house-user"></i> APR</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Configuración</li>
                    <li class="breadcrumb-item active">APR</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <center>
                        <button type="button" name="btn_nuevo" id="btn_nuevo" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
                        <button type="button" name="btn_modificar" id="btn_modificar" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar</button>
                        <button type="button" name="btn_aceptar" id="btn_aceptar" class="btn btn-success"><i class="fas fa-check"></i> Aceptar</button>
                        <button type="button" name="btn_cancelar" id="btn_cancelar" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button>
                        <button type="button" name="btn_subir_logo" id="btn_subir_logo" class="btn btn-info"><i class="fas fa-images"></i> Subir Logo</button>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            	<div class="card">
                	<div class="card-header" data-toggle="collapse" data-target="#datosAPR" aria-expanded="false" aria-controls="datosAPR">
                		<i class="fas fa-house-user"></i> Datos APR
                	</div>
		            <div class="card-body collapse" id="datosAPR">
		            	<div class="container-fluid">
		                	<form id="form_APR" name="form_APR" encType="multipart/form-data">
								
		                		<div class="row">
		                			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="txt_id_apr">Identificador</label>
			                                <input type="text" class="form-control" name="txt_id_apr" id="txt_id_apr" />
			                            </div>
			                        </div>
		                			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
			                        	<div class="form-group">
			                                <label class="small mb-1" for="txt_rut_apr">RUT APR</label>
			                                <input type='text' class="form-control" id='txt_rut_apr' name="txt_rut_apr" />
			                            </div>
			                        </div>
		                			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="txt_nombre_apr">Nombre APR</label>
			                                <input type='text' class="form-control" id='txt_nombre_apr' name="txt_nombre_apr" />
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			                        	<div class="form-group">
			                                <label class="small mb-1" for="txt_hash_sii">Hash SII</label>
			                                <input type='text' class="form-control" id='txt_hash_sii' name="txt_hash_sii" />
			                            </div>
			                        </div>
			                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			                        	<div class="form-group">
			                                <label class="small mb-1" for="txt_codigo_comercio">Código Comercio</label>
			                                <input type='text' class="form-control" id='txt_codigo_comercio' name="txt_codigo_comercio" />
			                            </div>
			                        </div>
		                		</div>
		                		<div class="row">
		                			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="cmb_region">Región</label>
			                                <select id="cmb_region" name="cmb_region" class="form-control"></select>
			                            </div>
			                        </div>
			                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
			                            <div class="form-group">
			                                <label class="small mb-1" for="cmb_provincia">Provincia</label>
			                                <select id="cmb_provincia" name="cmb_provincia" class="form-control"></select>
			                            </div>
		                			</div>
		                			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
			                            <div class="form-group">
			                                <label class="small mb-1" for="cmb_comuna">Comuna</label>
			                                <select id="cmb_comuna" name="cmb_comuna" class="form-control"></select>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="txt_tope_subsidio">Tope Subsidio m<sup>3</sup></label>
			                                <input type='text' class="form-control" id='txt_tope_subsidio' name="txt_tope_subsidio" />
			                            </div>
			                        </div>
			                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="txt_fono">Fono</label>
			                                <input type='text' class="form-control" id='txt_fono' name="txt_fono" />
			                            </div>
			                        </div>
		                			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			                            <div class="form-group">
			                                <label class="small mb-1" for="txt_resto_direccion">Dirección</label>
			                                <textarea class="form-control" id="txt_resto_direccion" name="txt_resto_direccion"></textarea>
			                            </div>
		                			</div>
		                		</div>
		                	</form>
		                </div>
		            </div>
			    </div>
		    </div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            	<div class="card">
                	<div class="card-header">
                		<i class="fas fa-house-user"></i> Listado de APR
                	</div>
		            <div class="card-body">
		            	<div class="container-fluid">
		            		<div class="table-responsive">
			                    <table id="grid_apr" class="table table-bordered" width="100%">
			                        <thead class="thead-dark">
			                            <tr>
			                            	<th>id_apr</th>
			                                <th>RUT APR</th>
			                                <th>Nombre APR</th>
			                                <th>hash_sii</th>
			                                <th>codigo_comercio</th>
			                                <th>tope_subsidio</th>
			                                <th>id_region</th>
			                                <th>id_provincia</th>
			                                <th>id_comuna</th>
			                                <th>Comuna</th>
			                                <th>Calle</th>
			                                <th>Número</th>
			                                <th>resto_direccion</th>
			                                <th>Usuarios Reg</th>
			                                <th>Fecha</th>
			                                <th>Traza</th>
			                                <th>Fono</th>
			                            </tr>
			                        </thead>
			                    </table> 
			                </div>
		            	</div>
		            </div>
			    </div>
			</div>
		</div>
        <div id="dlg_traza_apr" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Trazabilidad de la APR</h4>
                    </div>
                    <div class="modal-body">
                        <div id="divContenedorTrazaAPR"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="dlg_importar_logo" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Importar Logo</h4>
                    </div>
                    <div class="modal-body">
                        <div id="divContenedorImportar"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Configuracion/apr.js"></script>