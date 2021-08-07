<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-clock"></i> Informe Mensual</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Informes</li>
                    <li class="breadcrumb-item active">Informe Mensual</li>
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
                	<div class="card-header" data-toggle="collapse" data-target="#informeMensual" aria-expanded="false" aria-controls="informeMensual">
                		<i class="fas fa-clock"></i> Buscar
                	</div>
		            <div class="card-body collapse" id="informeMensual">
		            	<div class="container-fluid">
		            		<form id="form_histPagos" name="form_histPagos" encType="multipart/form-data">
			                    <div class="row">
			                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			                    		<div class="form-group">
			                    			<label class="small mb-1" for="dt_mes_consumo">Mes Consumo</label>
			                                <input type='text' class="form-control" id='dt_mes_consumo' name="dt_mes_consumo" />
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
                		<i class="fas fa-clock"></i> Lista Mensual
                	</div>
		            <div class="card-body">
		            	<div class="container-fluid">
				        	<div class="table-responsive">
			                    <table id="grid_mensual" class="table table-bordered" width="100%">
			                        <thead class="thead-dark">
			                            <tr>
			                            	<th>F. Pago</th>
			                            	<th>Cant. Boletas</th>
			                            	<th>Subtotal</th>
			                            	<th>Subsidio</th>
			                            	<th>Multas</th>
			                            	<th>Servicios</th>
			                            	<th>Total Pagado</th>
			                            </tr>
			                        </thead>
			                        <tfoot>
			                            <tr>
			                            	<th></th>
			                            	<th></th>
			                            	<th></th>
			                            	<th></th>
			                            	<th></th>
			                            	<th></th>
			                            	<th></th>
			                            </tr>
			                        </tfoot>
			                    </table> 
			                </div>
			            </div>
			        </div>
				</div>
            </div>
	    </div>
	</div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Informes/informe_mensualidad.js"></script>