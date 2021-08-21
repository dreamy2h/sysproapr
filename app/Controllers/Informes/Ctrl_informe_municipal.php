<?php 
	namespace App\Controllers\Informes;

	use App\Controllers\BaseController;
	use App\Models\Consumo\Md_metros;
	use App\Models\Finanzas\Md_proveedores;
	use App\Models\Finanzas\Md_facturas_municipalidad;
	use \Mpdf\Mpdf;

	class Ctrl_informe_municipal extends BaseController {
		protected $metros;
		protected $proveedores;
		protected $facturas_municipalidad;
		protected $sesión;
		protected $db;

		public function __construct() {
			$this->metros = new Md_metros();
			$this->proveedores = new Md_proveedores();
			$this->facturas_municipalidad = new Md_facturas_municipalidad();
			$this->sesión = session();
			$this->db = \Config\Database::connect();
		}

		public function validar_sesion() {
			if (!$this->sesión->has("id_usuario_ses")) {
				echo "La sesión expiró, actualice el sitio web con F5";
				exit();
	    	}
		}

		public function datatable_informe_municipal($mes_consumo) {
			$this->validar_sesion();
			echo $this->metros->datatable_informe_municipal($this->db, $this->sesión->id_apr_ses, $mes_consumo);
		}

		public function emitir_factura() {
			$this->validar_sesion();
			
			$validaDatosFactura = [
				"id_proveedor" => "required|numeric",
				"sub50" => "required|numeric",
				"sub100" => "required|numeric",
				"mes_facturado"	=> "required"
			];

			if ($this->request->getMethod() == "post" && $this->validate($validaDatosFactura)) {
				$url = 'https://libredte.cl';
				$hash = $this->sesión->hash_apr_ses;
				$rut_apr = $this->sesión->rut_apr_ses . "-" . $this->sesión->dv_apr_ses;

				define("FACTURA_EXENTA", 34);
				define("ACTIVO", 1);
				define("ERROR", 0);
				define("OK", 1);

				$id_proveedor = $this->request->getPost("id_proveedor");
				$sub50 = $this->request->getPost("sub50");
				$sub100 = $this->request->getPost("sub100");
				$mes_facturado = $this->request->getPost("mes_facturado");

				$fecha = date("Y-m-d H:i:s");
				$id_usuario = $this->sesión->id_usuario_ses;
				$id_apr = $this->sesión->id_apr_ses;

				$datosFacturaMuni = $this->facturas_municipalidad
				->select("count(*) as filas")
				->where("date_format(mes_facturado, '%m-%Y')", $mes_facturado)
				->where("id_apr", $id_apr)
				->where("estado", ACTIVO)
				->first();

				if ($datosFacturaMuni["filas"] > 0) {
					$respuesta = [
						"estado" => ERROR,
						"mensaje" => "El mes consultado, ya se encuentra facturado"
					];

					echo json_encode($respuesta);
					exit();
				}

				$datosMuni = $this->proveedores
				->select("concat(proveedores.rut, '-', proveedores.dv) as rut")
			    ->select("proveedores.razon_social")
			    ->select("proveedores.giro")
			    ->select("proveedores.direccion")
			    ->select("c.nombre as comuna")
				->join("comunas c", "proveedores.id_comuna = c.id")
				->where("proveedores.id", $id_proveedor)
				->first();

				$dte = [
	                'Encabezado' => [
	                    'IdDoc' => [
	                        'TipoDTE' => FACTURA_EXENTA,
	                    ],
	                    'Emisor' => [
	                        'RUTEmisor' => $rut_apr,
	                    ],
	                    'Receptor' => [
	                        'RUTRecep' => $datosMuni["rut"],
	                        'RznSocRecep' => $datosMuni["razon_social"],
	                        'GiroRecep' => $datosMuni["giro"],
	                        'DirRecep' => $datosMuni["direccion"],
	                        'CmnaRecep' => $datosMuni["comuna"]
	                    ],
	                ],
	                'Detalle' => [
						[
							'IndExe' => 1,
	                        'NmbItem' => 'Subsidios 100%',
	                        'QtyItem' => 1,
	                        'PrcItem' => $sub100,
						],
						[
							'IndExe' => 1,
	                        'NmbItem' => 'Subsidios 50%',
	                        'QtyItem' => 1,
	                        'PrcItem' => $sub50,
						]
					]
	            ];
	            
	            $LibreDTE = new \sasco\LibreDTE\SDK\LibreDTE($hash, $url);

	            $emitir = $LibreDTE->post('/dte/documentos/emitir', $dte);
	            if ($emitir['status']['code']!=200) {
	                $respuesta = [
						"estado" => ERROR,
						"mensaje" => "Error al emitir DTE temporal: " . $emitir['body']
					];

					echo json_encode($respuesta);
					exit();
	            }

	            // crear DTE real
	            $generar = $LibreDTE->post('/dte/documentos/generar', $emitir['body']);
	            if ($generar['status']['code']!=200) {
	                $respuesta = [
						"estado" => ERROR,
						"mensaje" => "Error al generar DTE real: ".$generar['body']
					];

					echo json_encode($respuesta);
					exit();
	            } else {
	            	$datosFacturaMuniSave = [
	            		"mes_facturado" => date_format(date_create("01-" . $mes_facturado), 'Y-m-d'),
	            		"id_usuario" => $id_usuario,
	            		"fecha" => $fecha,
	            		"id_apr" => $id_apr,
	            		"folio_factura" => $generar['body']['folio']
	            	];

	            	$this->facturas_municipalidad->save($datosFacturaMuniSave);

	            	$respuesta = [
						"estado" => OK,
						"mensaje" => "Factura emitida con éxito",
						"folio" => $generar['body']['folio']
					];

					echo json_encode($respuesta);
	            }
			}
		}

		public function imprimir_factura($folio_sii) {
			$this->validar_sesion();
			$mpdf = new \Mpdf\Mpdf();

			define("FACTURA_EXENTA", 34);

			$url = 'https://libredte.cl';
			$hash = $this->sesión->hash_apr_ses;
			$rut_apr = $this->sesión->rut_apr_ses;
			$LibreDTE = new \sasco\LibreDTE\SDK\LibreDTE($hash, $url);

			// obtener el PDF del DTE
            $pdf = $LibreDTE->get('/dte/dte_emitidos/pdf/' . FACTURA_EXENTA . '/' . $folio_sii . '/' . $rut_apr);
            if ($pdf['status']['code']!=200) {
                die('Error al generar PDF del DTE: '.$pdf['body']."\n");
            }

            file_put_contents($folio_sii . ".pdf", $pdf['body']);

			$pagecount = $mpdf->SetSourceFile($folio_sii . ".pdf");
			$tplId = $mpdf->ImportPage($pagecount);
            $mpdf->AddPage();
			$mpdf->UseTemplate($tplId);

			unlink($folio_sii . ".pdf");

			return redirect()->to($mpdf->Output());
		}
	}
?>