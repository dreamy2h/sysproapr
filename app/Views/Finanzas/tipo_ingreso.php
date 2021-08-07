<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-layer-group"></i> Tipos de Ingreso</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Gestión Financiera</li>
                    <li class="breadcrumb-item active">Tipos de Ingreso</li>
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
                        <button type="button" name="btn_eliminar" id="btn_eliminar" class="btn btn-primary"><i class="fas fa-trash"></i> Eliminar</button>
                        <button type="button" name="btn_aceptar" id="btn_aceptar" class="btn btn-success"><i class="fas fa-check"></i> Aceptar</button>
                        <button type="button" name="btn_cancelar" id="btn_cancelar" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button>
                        <button type="button" name="btn_reciclar" id="btn_reciclar" class="btn btn-warning"><i class="fas fa-recycle"></i> Reciclar</button>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            	<div class="card">
                	<div class="card-header" data-toggle="collapse" data-target="#datosTipoIngreso" aria-expanded="false" aria-controls="datosTipoIngreso">
                		<i class="fas fa-layer-group"></i> Datos Tipo de Ingreso
                	</div>
		            <div class="card-body collapse" id="datosTipoIngreso">
		            	<div class="container-fluid">
		                	<form id="form_tipo_ingreso" name="form_tipo_ingreso" encType="multipart/form-data">
								
		                		<div class="row">
		                			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="txt_id_tipo">Identificador</label>
			                                <input type="text" class="form-control" name="txt_id_tipo" id="txt_id_tipo" />
			                            </div>
			                        </div>
		                			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			                        	<div class="form-group">
			                                <label class="small mb-1" for="txt_tipo_ingreso">Tipo de Ingreso</label>
			                                <input type='text' class="form-control" id='txt_tipo_ingreso' name="txt_tipo_ingreso" />
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
                		<i class="fas fa-layer-group"></i> Listado de Tipos de Ingreso
                	</div>
		            <div class="card-body">
		            	<div class="container-fluid">
		            		<div class="table-responsive">
			                    <table id="grid_tipos_ingreso" class="table table-bordered" width="100%">
			                        <thead class="thead-dark">
			                            <tr>
			                            	<th>Id.</th>
			                                <th>Tipo de Ingreso</th>
			                                <th>Usuario</th>
			                                <th>Fecha</th>
			                                <th width="1%">Traza</th>
			                            </tr>
			                        </thead>
			                    </table> 
			                </div>
		            	</div>
		            </div>
			    </div>
			</div>
		</div>
        <div id="dlg_traza_tipo_ingreso" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Trazabilidad del Tipo de Ingreso</h4>
                    </div>
                    <div class="modal-body">
                        <div id="divContenedorTrazaTipoIngreso"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="dlg_reciclar_tipo_ingreso" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reciclar Tipo de Ingreso</h4>
                    </div>
                    <div class="modal-body">
                        <div id="divContenedorReciclarTipoIngreso"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Finanzas/tipo_ingreso.js"></script>