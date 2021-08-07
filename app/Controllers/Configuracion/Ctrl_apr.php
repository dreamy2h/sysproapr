<?php 
	namespace App\Controllers\Configuracion;

	use App\Controllers\BaseController;
	use App\Models\Configuracion\Md_apr;
	use App\Models\Configuracion\Md_apr_traza;

	class Ctrl_apr extends BaseController {
		protected $apr;
		protected $apr_traza;
		protected $sesión;
		protected $db;

		public function __construct() {
			$this->apr = new Md_apr();
			$this->apr_traza = new Md_apr_traza();
			$this->sesión = session();
			$this->db = \Config\Database::connect();
		}

		public function validar_sesion() {
			if (!$this->sesión->has("id_usuario_ses")) {
				echo "La sesión expiró, actualice el sitio web con F5";
				exit();
	    	}
		}

		public function datatable_apr() {
			$this->validar_sesion();
			echo $this->apr->datatable_apr($this->db);
		}

		public function guardar_apr() {
			$this->validar_sesion();
	    	define("CREAR_APR", 1);
	    	define("MODIFICAR_APR", 2);

			define("OK", 1);

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;

			$id_apr = $this->request->getPost("id_apr");
			$rut_apr = $this->request->getPost("rut_apr");
			$nombre_apr = $this->request->getPost("nombre_apr");
			$hash_sii = $this->request->getPost("hash_sii");
			$codigo_comercio = $this->request->getPost("codigo_comercio");
			$id_comuna = $this->request->getPost("id_comuna");
			$resto_direccion = $this->request->getPost("resto_direccion");
			$tope_subsidio = $this->request->getPost("tope_subsidio");
			$fono = $this->request->getPost("fono");

			$rut_completo = explode("-", $rut_apr);
			$rut = $rut_completo[0];
			$dv = $rut_completo[1];

			$datosAPR = [
				"nombre" => $nombre_apr,
				"id_comuna" => $id_comuna,
				"resto_direccion" => $resto_direccion,
				"hash_sii" => $hash_sii,
				"codigo_comercio" => $codigo_comercio,
				"tope_subsidio" => $tope_subsidio,
				"rut" => $rut,
				"dv" => $dv,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha,
				"fono" => $fono
			];

			if ($id_apr != "") {
				$estado_traza = MODIFICAR_APR;
				$datosAPR["id"] = $id_apr;
			} else {
				$estado_traza = CREAR_APR;
			}

			if ($this->apr->save($datosAPR)) {
				echo OK;
				
				if ($id_apr == "") {
					$obtener_id = $this->apr->select("max(id) as id_apr")->first();
					$id_apr = $obtener_id["id_apr"];
				}
					
				$this->guardar_traza($id_apr, $estado_traza, "");
			} else {
				echo "Error al guardar los datos de la APR";
			}
		}

		public function guardar_traza($id_apr, $estado, $observacion) {
			$this->validar_sesion();

			$fecha = date("Y-m-d H:i:s");
			$id_usuario = $this->sesión->id_usuario_ses;

			$datosTraza = [
				"id_apr" => $id_apr,
				"estado" => $estado,
				"observacion" => $observacion,
				"id_usuario" => $id_usuario,
				"fecha" => $fecha
			];

			if (!$this->apr_traza->save($datosTraza)) {
				echo "Falló al guardar la traza";
			}
		}

		public function v_apr_traza() {
			$this->validar_sesion();
			echo view("Configuracion/apr_traza");
		}

		public function datatable_apr_traza($id_apr) {
			$this->validar_sesion();
			echo $this->apr_traza->datatable_apr_traza($this->db, $id_apr);
		}

		public function v_importar_logo() {
			$this->validar_sesion();
			echo view("Configuracion/apr_importar_logo");
		}
	}
?>