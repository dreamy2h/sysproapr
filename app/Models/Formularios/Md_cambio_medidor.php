<?php namespace App\Models\Formularios;

	use CodeIgniter\Model;

	class Md_cambio_medidor extends Model {
		protected $table = 'cambio_medidor';
	    protected $primaryKey = 'id';

	    protected $returnType = 'array';
	    // protected $useSoftDeletes = true;

	    protected $allowedFields = ['id', 'id_socio', 'id_funcionario', 'id_medidor', 'motivo_cambio', 'fecha_cambio', 'estado', 'id_usuario', 'fecha', 'id_apr'];
	}