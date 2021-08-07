<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-hammer"></i> Servicios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Formularios</li>
                    <li class="breadcrumb-item active">Servicios</li>
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
                	<div class="card-header" data-toggle="collapse" data-target="#datosServicio" aria-expanded="false" aria-controls="datosServicio">
                		<i class="fas fa-hammer"></i> Datos Servicio
                	</div>
		            <div class="card-body collapse" id="datosServicio">
		            	<div class="container-fluid">
		                	<form id="form_servicio" name="form_servicio" encType="multipart/form-data">
		                		<div class="row">
		                			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
		                				<div class="form-group">
			                                <label class="small mb-1" for="txt_id_servicio">Identificador</label>
			                                <input type="text" class="form-control" name="txt_id_servicio" id="txt_id_servicio" />
			                            </div>
			                        </div>
		                			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			                        	<div class="form-group">
			                                <label class="small mb-1" for="txt_servicio">Servicio</label>
			                                <input type='text' class="form-control" id='txt_servicio' name="txt_servicio" />
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
                		<i class="fas fa-hammer"></i> Listado de Servicios
                	</div>
		            <div class="card-body">
		            	<div class="container-fluid">
		            		<div class="table-responsive">
			                    <table id="grid_servicios" class="table table-bordered" width="100%">
			                        <thead class="thead-dark">
			                            <tr>
			                            	<th>Id.</th>
			                                <th>Servicio</th>
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
        <div id="dlg_traza_servicios" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Trazabilidad del Servicio</h4>
                    </div>
                    <div class="modal-body">
                        <div id="divContenedorTrazaServicios"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="dlg_reciclar_servicios" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reciclar Servicios</h4>
                    </div>
                    <div class="modal-body">
                        <div id="divContenedorReciclarServicios"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Formularios/servicios.js"></script>