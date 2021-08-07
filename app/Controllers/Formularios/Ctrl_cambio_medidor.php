<?php 
	namespace App\Controllers\Formularios;

	use App\Controllers\BaseController;
	use App\Models\Formularios\Md_cambio_medidor;
	use App\Models\Formularios\Md_cambio_medidor_traza;
	use App\Models\Formularios\Md_arranques;
	use App\Models\Formularios\Md_arranque_traza;

	class Ctrl_cambio_medidor extends BaseController {
		protected $cambio_medidor;
		protected $cambio_medidor_traza;
		protected $arranques;
		protected $arranques_traza;
		protected $sesión;
		protected $db;

		public function __construct() {
			$this->cambio_medidor = new Md_cambio_medidor();
			$this->cambio_medidor_traza = new Md_cambio_medidor_traza();
			$this->arranques = new Md_arranques();
			$this->arranques_traza = new Md_arranque_traza();
			$this->sesión = session();
			$this->db = \Config\Database::connect();
		}

		public function validar_sesion() {
			if (!$this->sesión->has("id_usuario_ses")) {
				echo "La sesión expiró, actualice el sitio web con F5";
				exit();
	    	}
		}

		public function datatable_cambio_medidor() {
			$this->validar_sesion();
			define("ACTIVO", 1);

			$data = $this->cambio_medidor
			->select("cambio_medidor.id as id_cambio")
		    ->select("cambio_medidor.id_socio")
		    ->select("concat(s.rut, '-', s.dv) as rut_socio")
		    ->select("s.rol as rol_socio")
		    ->select("concat(s.nombres, ' ', s.ape_pat, ' ', s.ape_mat) as nombre_socio")
		    ->select("f.id as id_funcionario")
		    ->select("concat(f.rut, '-', f.dv) as rut_funcionario")
		    ->select("concat(f.nombres, ' ', f.ape_pat, ' ', f.ape_mat) as nombre_funcionario")
		    ->select("cambio_medidor.id_medidor")
		    ->select("m.numero as numero_medidor")
		    ->select("cambio_medidor.motivo_cambio")
		    ->select("date_format(cambio_medidor.fecha_cambio, '%d-%m-%Y') as fecha_cambio")
		    ->select("u.usuario")
		    ->select("date_format(cambio_medidor.fecha, '%d-%m-%Y %H:%i:%s') as fecha")
		    ->join("socios s", "cambio_medidor.id_socio = s.id")
		    ->join("funcionarios f", "cambio_medidor.id_funcionario = f.id")
		    ->join("usuarios u", "cambio_medidor.id_usuario = u.id")
		    ->join("apr", "cambio_medidor.id_apr = apr.id")
		    ->join("medidores m", "cambio_medidor.id_medidor = m.id")
			->where("cambio_medidor.id_apr", $this->sesión->id_apr_ses)
		    ->where("cambio_medidor.estado", ACTIVO)
		    ->findAll();

		    $salida = array('data' => $data);
		    return json_encode($salida);
		}

		public function guardar_cambio_medidor() {
			$this->validar_sesion();
	    	define("CREAR_CAMBIO_MEDIDOR", 1);
	    	define("MODIFICAR_CAMBIO_MEDIDOR", 2);

			define("OK", 1);
			define("ACTIVO", 1);
			define("CAMBIO_MEDIDOR", 5);

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;
			$id_apr = $this->sesión->id_apr_ses;

			$id_cambio = $this->request->getPost("id_cambio");
			$id_socio = $this->request->getPost("id_socio");
			$id_funcionario = $this->request->getPost("id_funcionario");
			$motivo_cambio = $this->request->getPost("motivo_cambio");
			$id_medidor = $this->request->getPost("id_medidor");
			$fecha_cambio = $this->request->getPost("fecha_cambio");

			$this->db->transStart();

			$datosCambioMedidor = [
				"id_socio" => $id_socio,
				"id_funcionario" => $id_funcionario,
				"id_medidor" => $id_medidor,
				"motivo_cambio" => $motivo_cambio,
				"fecha_cambio" => date_format(date_create($fecha_cambio), 'Y-m-d'),
				"id_usuario" => $id_usuario,
				"fecha" => $fecha,
				"id_apr" => $id_apr
			];

			if ($id_cambio != "") {
				$estado_traza = MODIFICAR_CAMBIO_MEDIDOR;
				$datosCambioMedidor["id"] = $id_cambio;
			} else {
				$estado_traza = CREAR_CAMBIO_MEDIDOR;
			}

			$this->cambio_medidor->save($datosCambioMedidor);
				
			if ($id_cambio == "") {
				$obtener_id = $this->cambio_medidor->select("max(id) as id_cambio")->first();
				$id_cambio = $obtener_id["id_cambio"];
			}
					
			$datosTraza = [
				"id_cambio" => $id_cambio,
				"estado" => $estado_traza,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha
			];

			$this->cambio_medidor_traza->save($datosTraza);

			$datosArranque = $this->arranques->select("id")->where("id_socio", $id_socio)->first();

			$datosArranqueSave = [
				"id" => $datosArranque["id"],
				"id_medidor" => $id_medidor
			];

			$this->arranques->save($datosArranqueSave);

			$datosArranqueTraza = [
				"id" => $datosArranque["id"],
				"id_usuario" => $id_usuario,
				"fecha" => $fecha,
				"estado" => CAMBIO_MEDIDOR,
			];

			$this->arranques_traza->save($datosArranqueTraza);
			
			$this->db->transComplete();

			if ($this->db->transStatus()) {
				echo OK;
			} else {
				echo "Error al guardar los datos del arranque";
			}
		}

		public function anular_cambio_medidor() {
			define("ELIMINAR_CAMBIO_MEDIDOR", 3);
			define("OK", 1);

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;

			$id_cambio = $this->request->getPost("id_cambio");
			$estado = $this->request->getPost("estado");
			$observacion = $this->request->getPost("observacion");

			$this->db->transStart();

			$datosCambioMedidor = [
				"id" => $id_cambio,
				"id_usuario" => $id_usuario,
				"observacion" => $observacion,
				"fecha" => $fecha,
				"estado" => $estado,
			];

			$this->cambio_medidor->save($datosCambioMedidor);
				
			$estado_traza = ELIMINAR_CAMBIO_MEDIDOR;

			$datosTraza = [
				"id_cambio" => $id_cambio,
				"estado" => $estado_traza,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha
			];

			$this->cambio_medidor_traza->save($datosTraza);
			
			$this->db->transComplete();

			if ($this->db->transStatus()) {
				echo OK;
			} else {
				echo "Error al actualizar el cambio medidor";
			}
		}

		public function guardar_traza($id_cambio, $estado, $observacion) {
			$this->validar_sesion();

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;

			$datosTraza = [
				"id_cambio" => $id_cambio,
				"estado" => $estado,
				"observacion" => $observacion,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha
			];

			if (!$this->cambio_medidor_traza->save($datosTraza)) {
				echo "Falló al guardar la traza";
			}
		}

		public function v_cambio_medidor_traza() {
			$this->validar_sesion();
			echo view("Formularios/cambio_medidor_traza");
		}

		public function datatable_cambio_medidor_traza($id_cambio) {
			$this->validar_sesion();
			echo $this->cambio_medidor_traza->datatable_cambio_medidor_traza($this->db, $id_cambio);
		}
	}
?>