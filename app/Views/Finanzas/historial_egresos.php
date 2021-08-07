<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-sign-out-alt"></i> Historial de Egresos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Gestión Financiera</li>
                    <li class="breadcrumb-item active">Egresos</li>
                    <li class="breadcrumb-item active">Historial de Egresos</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            	<div class="card">
                	<div class="card-header" data-toggle="collapse" data-target="#listadoArranques" aria-expanded="false" aria-controls="listadoArranques">
                		<i class="fas fa-sign-out-alt"></i> Historial Egresos
                	</div>
		            <div class="card-body">
		            	<div class="container-fluid">
				        	<div class="table-responsive">
				        		<input type="hidden" name="txt_id_egreso" id="txt_id_egreso">
			                    <table id="grid_egresos" class="table table-bordered" width="100%">
			                        <thead class="thead-dark">
			                            <tr>
			                            	<th width="10%">N° Egreso</th>
			                            	<th>Tipo Egreso</th>
			                            	<th>Usuario</th>
			                            	<th>Fecha</th>
			                            	<th>Estado</th>
			                            	<th width="1%">Detalle</th>
			                            	<th width="1%">Anular</th>
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
	</div>
	<div id="dlg_traza_egresos" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Trazabilidad del Egreso</h4>
                </div>
                <div class="modal-body">
                    <div id="divContenedorTrazaEgreso"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="dlg_detalle_egresos" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalle del Egreso</h4>
                </div>
                <div class="modal-body">
                    <div id="divContenedorDetalleEgreso"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Finanzas/historial_egresos.js"></script>