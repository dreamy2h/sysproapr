<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-cut"></i> Informe Afecto a Corte</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Informes</li>
                    <li class="breadcrumb-item active">Informe Afecto a Corte</li>
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
                	<div class="card-header" data-toggle="collapse" data-target="#informeAfectoCorte" aria-expanded="false" aria-controls="informeAfectoCorte">
                		<i class="fas fa-cut"></i> Buscar (ENTER para buscar)
                	</div>
		            <div class="card-body collapse" id="informeAfectoCorte">
		            	<div class="container-fluid">
		                    <div class="row">
		                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
		                    		<div class="form-group">
		                    			<label class="small mb-1" for="txt_n_meses">N° de Meses Deudores</label>
		                                <input type='text' class="form-control" id='txt_n_meses' name="txt_n_meses" />
		                    		</div>
		                    	</div>
		                    </div>
		            	</div>
		            </div>
			    </div>
			</div>
		</div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            	<div class="card">
                	<div class="card-header">
                		<i class="fas fa-cut"></i> Afecto a Corte
                	</div>
		            <div class="card-body">
		            	<div class="container-fluid">
				        	<div class="table-responsive">
			                    <table id="grid_afecto_corte" class="table table-bordered" width="100%">
			                        <thead class="thead-dark">
			                            <tr>
			                            	<th>ROL</th>
			                            	<th>RUT</th>
			                            	<th>Nombre</th>
			                            	<th>Meses Pend.</th>
			                            	<th>Total Deuda $</th>
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
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Informes/informe_afecto_corte.js"></script>