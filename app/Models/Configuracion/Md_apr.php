<?php namespace App\Models\Configuracion;

	use CodeIgniter\Model;

	class Md_apr extends Model {
		protected $table = 'apr';
	    protected $primaryKey = 'id';

	    protected $returnType = 'array';
	    // protected $useSoftDeletes = true;

	    protected $allowedFields = ['id', 'nombre', 'id_comuna', 'calle', 'numero', 'resto_direccion', 'hash_sii', 'codigo_comercio', 'tope_subsidio', 'rut', 'dv', 'id_usuario', 'fecha', 'fono', 'id_tipo_multa', 'tipo_multa_detalle'];

	    public function datatable_apr($db) {
	    	$consulta = "SELECT 
							apr.id as id_apr,
						    concat(apr.rut, '-', apr.dv) as rut_apr,
						    apr.nombre as nombre_apr,
						    apr.hash_sii,
						    apr.codigo_comercio,
						    apr.tope_subsidio,
						    p.id_region,
						    c.id_provincia,
						    apr.id_comuna,
						    c.nombre as comuna,
						    apr.calle,
						    apr.numero,
						    apr.resto_direccion,
						    u.usuario,
						    date_format(apr.fecha, '%d-%m-%Y %H:%i:%s') as fecha,
						    apr.fono,
						    apr.id_tipo_multa,
						    tm.glosa as tipo_multa,
						    apr.tipo_multa_detalle as detalle_multa
						from 
							apr
							inner join usuarios u on u.id = apr.id_usuario
						    inner join comunas c on c.id = apr.id_comuna
						    inner join provincias p on p.id = c.id_provincia
						    inner join tipo_multa tm on apr.id_tipo_multa = tm.id";


			$query = $db->query($consulta);
			$data = $query->getResultArray();
			
			$salida = array("data" => $data);
			return json_encode($salida);
	    }
	}
?>