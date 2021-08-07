<?php namespace App\Models\Formularios;

	use CodeIgniter\Model;

	class Md_medidor_traza extends Model {
		protected $table = 'medidor_traza';
	    protected $primaryKey = 'id';

	    protected $returnType = 'array';
	    // protected $useSoftDeletes = true;

	    protected $allowedFields = ['id', 'id_medidor', 'estado', 'observacion', 'id_usuario', 'fecha'];
	}
?>