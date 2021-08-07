<?php namespace App\Models\Formularios;

	use CodeIgniter\Model;

	class Md_medidores extends Model {
		protected $table = 'medidores';
	    protected $primaryKey = 'id';

	    protected $returnType = 'array';
	    // protected $useSoftDeletes = true;

	    protected $allowedFields = ['id', 'numero', 'id_diametro', 'marca', 'tipo', 'consumo', 'estado', 'id_usuario', 'fecha', 'id_apr'];

	    public function llenar_cmb_medidores($db, $id_apr, $opcion) {
	    	$consulta = "SELECT 
							id,
						    numero
						from 
							medidores
						where
							id_apr = $id_apr and
						    estado = 1";
							
			if ($opcion ==  "FILTRADO") {
				$consulta .= " and id NOT IN(select id_medidor from arranques where id_medidor is not null and id_apr = $id_apr and estado = 1)";
			}

			$query = $db->query($consulta);
			$data = $query->getResultArray();

			return json_encode($data);
	    }
	}
?>