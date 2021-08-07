<?php 
	namespace App\Controllers\Formularios;

	use App\Controllers\BaseController;
	use App\Models\Formularios\Md_medidores;
	use App\Models\Formularios\Md_medidor_traza;
	use App\Models\Formularios\Md_diametro;

	class Ctrl_medidores extends BaseController {
		protected $medidores;
		protected $medidor_traza;
		protected $diametro;
		protected $sesión;
		protected $db;

		public function __construct() {
			$this->medidores = new Md_medidores();
			$this->medidor_traza = new Md_medidor_traza();
			$this->diametro = new Md_diametro();
			$this->sesión = session();
			$this->db = \Config\Database::connect();
		}

		public function validar_sesion() {
			if (!$this->sesión->has("id_usuario_ses")) {
				echo "La sesión expiró, actualice el sitio web con F5";
				exit();
	    	}
		}

		public function datatable_medidores() {
			$this->validar_sesion();
			define("ACTIVO", 1);

			$data = $this->medidores
			->select("medidores.id as id_medidor")
		    ->select("medidores.numero")
		    ->select("medidores.id_diametro")
		    ->select("d.glosa as diametro")
		    ->select("medidores.marca")
		    ->select("medidores.tipo")
		    ->select("medidores.consumo")
		    ->select("IFNULL(ELT(FIELD(medidores.estado, 0, 1), 'Eliminado', 'Activo'),'Sin registro') as estado")
		    ->select("u.usuario")
		    ->select("date_format(medidores.fecha, '%d-%m-%Y %H:%m') as fecha")
		    ->join("diametro d",  "medidores.id_diametro = d.id")
		    ->join("usuarios u",  "medidores.id_usuario = u.id")
			->where("medidores.estado", ACTIVO)
			->where("medidores.id_apr", $this->sesión->id_apr_ses)
			->findAll();

			$salida = array('data' => $data);
			return json_encode($salida);
		}

		public function guardar_medidor() {
			$this->validar_sesion();
	    	define("CREAR_MEDIDOR", 1);
	    	define("MODIFICAR_MEDIDOR", 2);

			define("OK", 1);
			define("ACTIVO", 1);

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;
			$id_apr = $this->sesión->id_apr_ses;
			$estado = ACTIVO;

			$id_medidor = $this->request->getPost("id_medidor");
			$numero = $this->request->getPost("numero");
			$id_diametro = $this->request->getPost("id_diametro");
			$marca = $this->request->getPost("marca");
			$tipo = $this->request->getPost("tipo");
			$consumo = $this->request->getPost("consumo");

			$this->db->transStart();

			$datosMedidor = [
				"numero" => $numero,
				"id_diametro" => $id_diametro,
				"marca" => $marca,
				"tipo" => $tipo,
				"consumo" => $consumo,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha,
				"id_apr" => $id_apr
			];

			if ($id_medidor != "") {
				$estado_traza = MODIFICAR_MEDIDOR;
				$datosMedidor["id"] = $id_medidor;
			} else {
				$estado_traza = CREAR_MEDIDOR;
			}
			
			$this->medidores->save($datosMedidor);
				
			if ($id_medidor == "") {
				$obtener_id = $this->medidores->select("max(id) as id_medidor")->first();
				$id_medidor = $obtener_id["id_medidor"];
			}
					
			$datosTraza = [
				"id_medidor" => $id_medidor,
				"estado" => $estado,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha
			];

			$this->medidor_traza->save($datosTraza);
			
			$this->db->transComplete();

			if ($this->db->transStatus()) {
				echo OK;
			} else {
				echo "Error al registrar el medidor";
			}
		}

		public function eliminar_medidor() {
			define("ELIMINAR_MEDIDOR", 3);
			define("RECICLAR_MEDIDOR", 4);
			define("ELIMINAR", 0);
			define("RECICLAR", 1);
			define("OK", 1);

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;

			$id_medidor = $this->request->getPost("id_medidor");
			$estado = $this->request->getPost("estado");
			$observacion = $this->request->getPost("observacion");

			$this->db->transStart();

			$datosMedidor = [
				"id" => $id_medidor,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha,
				"estado" => $estado
			];

			$this->medidores->save($datosMedidor);
				
			if ($estado == ELIMINAR) {
				$estado_traza = ELIMINAR_MEDIDOR;
			} else {
				$estado_traza = RECICLAR_MEDIDOR;
			}

			$datosTraza = [
				"id_medidor" => $id_medidor,
				"estado" => $estado_traza,
				"observacion" => $observacion,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha
			];

			$this->medidor_traza->save($datosTraza);
			
			$this->db->transComplete();

			if ($this->db->transStatus()) {
				echo OK;
			} else {
				echo "Error al registrar cambiar de estado el medidor";
			}
		}

		public function v_medidor_traza() {
			$this->validar_sesion();
			echo view("Formularios/medidor_traza");
		}

		public function datatable_medidor_traza($id_medidor) {
			$this->validar_sesion();
			
			$data = $this->medidor_traza
			->select("mte.glosa as estado")
		    ->select("ifnull(medidor_traza.observacion, 'No registrado') as observacion")
		    ->select("u.usuario")
		    ->select("date_format(medidor_traza.fecha, '%d-%m-%Y %H:%i:%s') as fecha")
		    ->join("usuarios u", "u.id = medidor_traza.id_usuario")
		    ->join("medidor_traza_estados mte", "mte.id = medidor_traza.estado")
			->where("medidor_traza.id_medidor", $id_medidor)
			->findAll();
			
			$salida = array('data' => $data);
			return json_encode($salida);
		}

		public function v_medidor_reciclar() {
			$this->validar_sesion();
			echo view("Formularios/medidor_reciclar");
		}

		public function datatable_medidor_reciclar() {
			$this->validar_sesion();
			define("DESACTIVADO", 0);

			$data = $this->medidores
			->select("medidores.id as id_medidor")
		    ->select("medidores.numero")
		    ->select("medidores.id_diametro")
		    ->select("d.glosa as diametro")
		    ->select("IFNULL(ELT(FIELD(medidores.estado, 0, 1), 'Eliminado', 'Activo'),'Sin registro') as estado")
		    ->select("u.usuario")
		    ->select("date_format(medidores.fecha, '%d-%m-%Y %H:%m') as fecha")
		    ->join("diametro d", "medidores.id_diametro = d.id")
		    ->join("usuarios u", "medidores.id_usuario = u.id")
			->where("medidores.estado", DESACTIVADO)
			->where("medidores.id_apr", $this->sesión->id_apr_ses)
			->findAll();

			$salida = array('data' => $data);
			return json_encode($salida);
		}

		public function llenar_cmb_diametro() {
			$this->validar_sesion();
			$datosDiametro = $this->diametro->select("id")->select("glosa as diametro")->where("estado", 1)->findAll();
			echo json_encode($datosDiametro);
		}
	}
?>