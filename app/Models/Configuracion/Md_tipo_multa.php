<?php namespace App\Models\Configuracion;

	use CodeIgniter\Model;

	class Md_tipo_multa extends Model {
		protected $table = 'tipo_multa';
	    protected $primaryKey = 'id';

	    protected $returnType = 'array';
	    // protected $useSoftDeletes = true;

	    protected $allowedFields = ['id', 'glosa', 'estado'];
	}
?>