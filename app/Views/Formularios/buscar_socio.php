<main>
    <div class="container-fluid">
        <div class="alert alerta-fijo hidden" role="alert" id="alerta_busca_socio"></div>
        <input type="hidden" name="txt_origen" id="txt_origen" value="<?php echo $origen; ?>">
		<div class="table-responsive">
            <table id="grid_buscar_socio" class="table table-bordered" width="100%">
                <thead class="thead-dark">
                    <tr>
                    	<th width="10%">Id Socio</th>
                    	<th width="10%">RUT Socio</th>
                        <th width="10%">ROL Socio</th>
                        <th width="50%">Nombre Socio</th>
                        <th width="20%">Fecha Entrada</th>
                    <?php if ($origen ==  "Ctrl_metros") { ?>
                        <th width="0%">id_arranque</th>
                        <th width="0%">id_diametro</th>
                        <th width="0%">diametro</th>
                        <th width="0%">Sector</th>
                        <th width="0%">Subsidio</th>
                        <th width="0%">tope_subsidio</th>
                        <th width="0%">consumo_anterior</th>
                        <th width="0%">cargo_fijo</th>
                        <th width="0%">abono</th>
                    <?php } ?>
                    </tr>
                </thead>
            </table> 
        </div>
	</div>
</main>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/Formularios/buscar_socio.js"></script>