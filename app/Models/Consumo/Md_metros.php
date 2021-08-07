<?php namespace App\Models\Consumo;

	use CodeIgniter\Model;

	class Md_metros extends Model {
		protected $table = 'metros';
	    protected $primaryKey = 'id';

	    protected $returnType = 'array';
	    // protected $useSoftDeletes = true;

	    protected $allowedFields = ['id', 'folio_bolect', 'id_socio', 'monto_subsidio', 'fecha_ingreso', 'fecha_vencimiento', 'consumo_anterior', 'consumo_actual', 'metros', 'subtotal', 'multa', 'total_servicios', 'total_mes', 'id_usuario', 'fecha', 'estado', 'id_apr', 'cargo_fijo', 'monto_facturable', 'cuota_repactacion'];

	    public function datatable_metros($db, $id_apr) {
	    	define("ELIMINADO", 0);
	    	$estado = ELIMINADO;

	    	$consulta = "SELECT 
							m.id as id_metros,
							m.id_socio,
							concat(soc.rut, '-', soc.dv) as rut_socio,
							soc.rol as rol_socio,
							concat(soc.nombres, ' ', soc.ape_pat, ' ', soc.ape_mat) as nombre_socio,
							a.id as id_arranque,
						    ifnull(p.glosa, '0%') as subsidio,
						    (select tope_subsidio from apr where id = m.id_apr) as tope_subsidio,
						    ifnull(m.monto_subsidio, 0) as monto_subsidio,
							sec.nombre as sector,
							med.id_diametro,
							d.glosa as diametro,
							date_format(m.fecha_ingreso, '%d-%m-%Y') as fecha_ingreso,
							date_format(m.fecha_vencimiento, '%d-%m-%Y') as fecha_vencimiento,
							m.consumo_anterior,
							m.consumo_actual,
							m.metros,
							ifnull(m.subtotal, 0) as subtotal,
							ifnull(m.multa, 0) as multa,
							ifnull(m.total_servicios, 0) as total_servicios,
							ifnull(m.cuota_repactacion, 0) as cuota_repactacion,
							ifnull(m.total_mes, 0) as total_mes,
							ifnull(m.cargo_fijo, 0) as cargo_fijo,
                            ifnull(m.monto_facturable, 0) as monto_facturable,
							u.usuario,
							date_format(m.fecha, '%d-%m-%Y') as fecha
						from 
							metros m
							inner join socios soc on m.id_socio = soc.id
							inner join arranques a on a.id_socio = soc.id
							inner join sectores sec on a.id_sector = sec.id
							left join subsidios sub on sub.id_socio = soc.id
							left join porcentajes p on sub.id_porcentaje = p.id
							inner join usuarios u on m.id_usuario = u.id
						    inner join medidores med on a.id_medidor = med.id
						    inner join diametro d on med.id_diametro = d.id
						where 
							m.estado <> ? and
							m.id_apr = ?
						order by m.fecha_vencimiento asc
						limit 10000";

			$query = $db->query($consulta, [$estado, $id_apr]);
			$data = $query->getResultArray();

			$salida = array("data" => $data);
			return json_encode($salida);
	    }

	    public function datatable_buscar_socio($db, $id_apr) {
	    	$consulta = "SELECT 
							s.id as id_socio,
							concat(s.rut, '-', s.dv) as rut,
							s.rol,
							concat(s.nombres, ' ', s.ape_pat, ' ', s.ape_mat) as nombre,
							date_format(s.fecha_entrada, '%d-%m-%Y') as fecha_entrada,
							a.id as id_arranque,
						    m.id_diametro,
						    d.glosa as diametro,
							sec.nombre as sector,
							case when sub.estado = 1 then p.glosa else '0%' end as subsidio,
							(select tope_subsidio from apr where id = s.id_apr) as tope_subsidio,
							ifnull((select consumo_actual from metros m where m.id = (select max(m2.id) from metros m2 where m2.id_socio = a.id_socio and estado <> 0)), 0) as consumo_anterior,
						    cf.cargo_fijo,
						    s.abono
						from 
							arranques a
						    inner join medidores m on a.id_medidor = m.id
						    inner join diametro d on m.id_diametro = d.id
							inner join socios s on a.id_socio = s.id
							inner join sectores sec on a.id_sector = sec.id
							left join subsidios sub on sub.id_socio = s.id
							left join porcentajes p on sub.id_porcentaje = p.id
						    inner join apr_cargo_fijo cf on cf.id_apr = s.id_apr and cf.id_diametro = m.id_diametro
						where 
							s.id_apr = $id_apr and
							s.estado = 1";


			$query = $db->query($consulta);
			$data = $query->getResultArray();

			$salida = array("data" => $data);
			return json_encode($salida);
	    }

	    public function datatable_boleta_electronica($db, $id_apr, $datosBusqueda) {
	    	define("ELIMINADO", 0);
	    	$estado = ELIMINADO;

	    	$consulta = "SELECT 
							m.id as id_metros,
							m.folio_bolect,
							m.id_socio,
							soc.rut as rut_socio,
							soc.rol as rol_socio,
							concat(soc.nombres, ' ', soc.ape_pat, ' ', soc.ape_mat) as nombre_socio,
							a.id as id_arranque,
						    ifnull(p.glosa, '0%') as subsidio,
						    (select tope_subsidio from apr where id = m.id_apr) as tope_subsidio,
						    ifnull(m.monto_subsidio, 0) as monto_subsidio,
							sec.nombre as sector,
							med.id_diametro,
							d.glosa as diametro,
							date_format(m.fecha_ingreso, '%d-%m-%Y') as fecha_ingreso,
							date_format(m.fecha_vencimiento, '%d-%m-%Y') as fecha_vencimiento,
							m.consumo_anterior,
							m.consumo_actual,
							m.metros,
							ifnull(m.subtotal, 0) as subtotal,
							ifnull(m.multa, 0) as multa,
							ifnull(m.total_servicios, 0) as total_servicios,
							ifnull(m.total_mes, 0) as total_mes,
							case when soc.ruta = '' then 0 else ifnull(soc.ruta, 0) end as ruta
						from 
							metros m
							inner join socios soc on m.id_socio = soc.id
							inner join arranques a on a.id_socio = soc.id
							inner join sectores sec on a.id_sector = sec.id
							left join subsidios sub on sub.id_socio = soc.id
							left join porcentajes p on sub.id_porcentaje = p.id
							inner join usuarios u on m.id_usuario = u.id
						    inner join medidores med on a.id_medidor = med.id
						    inner join diametro d on med.id_diametro = d.id
						where 
							m.estado <> ? and
							m.id_apr = ?";
            
            $bind = [$estado, $id_apr];

			if ($datosBusqueda != "") {
				$datos = explode(",", $datosBusqueda);

				$id_socio = $datos[0];
				$mes_año = $datos[1];
				$id_sector = $datos[2];

				if ($id_socio != "") {
					$consulta .= " and m.id_socio = ?";
					array_push($bind, $id_socio);
				}

				if ($mes_año != "") {
					$consulta .= " and date_format(m.fecha_ingreso, '%m-%Y') = ?";
					array_push($bind, $mes_año);
				}

				if ($id_sector != "") {
					$consulta .= " and a.id_sector = ?";
					array_push($bind, $id_sector);
				}
			}
			
			$consulta .= " order by m.fecha_vencimiento asc";

			$query = $db->query($consulta, $bind);
			$data = $query->getResultArray();

			$salida = array("data" => $data);
			return json_encode($salida);
	    }

	    public function datatable_informe_municipal($db, $id_apr, $mes_consumo) {
	    	define("ELIMINADO", 0);
	    	$estado = ELIMINADO;

	    	$consulta = "SELECT 
							m.id as id_metros,
						    concat(s.rut, '-', s.dv) as rut_socio,
						    concat(s.nombres, ' ', s.ape_pat, ' ', s.ape_mat) as nombre_socio,
						    date_format(m.fecha_ingreso, '%m-%Y') as mes_cubierto,
						    case when sub.id_porcentaje = 1 then m.monto_subsidio else 0 end as subsidio_50,
                            case when sub.id_porcentaje = 2 then m.monto_subsidio else 0 end as subsidio_100,
						    m.monto_subsidio as subsidio
						from 
							metros m
						    inner join socios s on m.id_socio = s.id
						    inner join subsidios sub on sub.id_socio = s.id
						where
							date_format(m.fecha_ingreso, '%m-%Y') = ? and
						    m.monto_subsidio > ? and
						    m.estado <> ? and
						    m.id_apr = ?";

			$query = $db->query($consulta, [$mes_consumo, 0, $estado, $id_apr]);
			$data = $query->getResultArray();

			$salida = array("data" => $data);
			return json_encode($salida);
	    }

	    public function datatable_informe_balance($db, $id_apr, $mes_consumo) {
	    	define("ELIMINADO", 0);
	    	$estado = ELIMINADO;

	    	$consulta = "SELECT 
							m.id as id_metros,
						    s.rol as rol_socio,
						    concat(s.rut, '-', dv) as rut,
						    concat(s.nombres, ' ', s.ape_pat) as nombre_socio,
						    m.consumo_anterior,
						    m.consumo_actual,
						    m.metros,
						    m.subtotal,
						    m.multa,
						    m.total_servicios,
						    m.monto_subsidio,
						    m.total_mes,
						    me.glosa as estado
						from 
							metros m 
						    inner join socios s on m.id_socio = s.id
						    inner join metros_estados me on m.estado = me.id
						where 
							date_format(m.fecha_ingreso, '%m-%Y') = ? and
						    m.estado <> ? and
						    m.id_apr = ?";

			$query = $db->query($consulta, [$mes_consumo, $estado, $id_apr]);
			$metros = $query->getResultArray();

			foreach ($metros as $key) {
				$row = array(
					"id_metros" => $key["id_metros"],
					"rol_socio" => $key["rol_socio"],
					"rut" => $key["rut"],
					"nombre_socio" => $key["nombre_socio"],
					"consumo_anterior" => $key["consumo_anterior"],
					"consumo_actual" => $key["consumo_actual"],
					"metros" => $key["metros"],
					"subtotal" => $key["subtotal"],
					"multa" => $key["multa"],
					"total_servicios" => $key["total_servicios"],
					"monto_subsidio" => $key["monto_subsidio"],
					"total_mes" => $key["total_mes"],
					"estado" => $key["estado"]
				);

				$data[] = $row;
			}

			if (isset($data)) {
				$salida = array("data" => $data);
				return json_encode($salida);
			} else {
				return "{ \"data\": []}";
			}
	    }

	    public function datatable_informe_consumo_agua($db, $id_apr, $datosBusqueda) {
	    	define("ELIMINADO", 0);
	    	$estado = ELIMINADO;
			
			$datosBusqueda = json_decode($datosBusqueda, true);
			$fecha_desde = $datosBusqueda["fecha_desde"];
			$fecha_hasta = $datosBusqueda["fecha_hasta"];
			$id_socio = $datosBusqueda["id_socio"];
			$id_conversion = $datosBusqueda["id_conversion"];
			$conversion = $datosBusqueda["conversion"];
			$id_sector = $datosBusqueda["id_sector"];

	    	$consulta = "SELECT 
							m.id as id_metros,
						    concat(s.rut, '-', dv) as rut_socio,
						    s.rol as rol_socio,
						    concat(s.nombres, ' ', s.ape_pat, ' ', s.ape_mat) as nombre_socio,
						    sec.nombre as sector,
						";

			if ($id_conversion == 1) {
				$consulta .= "  m.metros as consumo,";
			} else {
				$consulta .= " round(m.metros * 1000) as consumo,";
			}

				$consulta .= " '$conversion' as um_agua
								from 
									metros m
								    inner join socios s on m.id_socio = s.id
								    inner join arranques a on a.id_socio = s.id
								    inner join sectores sec on a.id_sector = sec.id
								where
									m.id_apr = $id_apr and
								    m.estado <> $estado";


			if ($fecha_desde != "" and $fecha_hasta != "") {
				$consulta .= " and date_format(m.fecha_ingreso, '%m-%Y') between '$fecha_desde' and '$fecha_hasta'";
			}

			if ($id_socio != "") {
				$consulta .= " and m.id_socio = $id_socio";
			}

			if ($id_sector != "") {
				$consulta .= " and a.id_sector = $id_sector";
			}

			$query = $db->query($consulta);
			$data = $query->getResultArray();

			$salida = array("data" => $data);
			return json_encode($salida);
	    }

	    public function llenar_grafico_consumo_agua($db, $id_apr, $datosBusqueda) {
	    	define("ELIMINADO", 0);
	    	$estado = ELIMINADO;
			
			$datosBusqueda = json_decode($datosBusqueda, true);
			$fecha_desde = $datosBusqueda["fecha_desde"];
			$fecha_hasta = $datosBusqueda["fecha_hasta"];
			$id_socio = $datosBusqueda["id_socio"];
			$id_conversion = $datosBusqueda["id_conversion"];
			$conversion = $datosBusqueda["conversion"];
			$id_sector = $datosBusqueda["id_sector"];

	    	$consulta = "SELECT ";

			if ($id_conversion == 1) {
				$consulta .= "  sum(m.metros) as consumo,";
			} else {
				$consulta .= " sum(round(m.metros * 1000)) as consumo,";
			}

				$consulta .= " sec.nombre as sector
								from 
									metros m
								    inner join socios s on m.id_socio = s.id
								    inner join arranques a on a.id_socio = s.id
								    inner join sectores sec on a.id_sector = sec.id
								where
									m.id_apr = $id_apr and
								    m.estado <> $estado";


			if ($fecha_desde != "" and $fecha_hasta != "") {
				$consulta .= " and date_format(m.fecha_ingreso, '%m-%Y') between '$fecha_desde' and '$fecha_hasta'";
			}

			if ($id_socio != "") {
				$consulta .= " and m.id_socio = $id_socio";
			}

			if ($id_sector != "") {
				$consulta .= " and a.id_sector = $id_sector";
			}

			$consulta .= " group by sec.nombre";

			$query = $db->query($consulta);
			$data = $query->getResultArray();

			return json_encode($data);
	    }

	    public function llenar_grafico_cuadratura_agua($db, $id_apr, $datosBusqueda) {
	    	define("ELIMINADO", 0);
	    	define("ACTIVO", 1);
			
			$datosBusqueda = json_decode($datosBusqueda, true);
			$fecha_desde = $datosBusqueda["fecha_desde"];
			$fecha_hasta = $datosBusqueda["fecha_hasta"];
			$id_conversion = $datosBusqueda["id_conversion"];

			if ($id_conversion == 1) {
				$consulta = "SELECT 'Consumo' as tipo, round(sum(metros)) as agua from metros where date_format(fecha_ingreso, '%m-%Y') between '$fecha_desde' and '$fecha_hasta' and id_apr = $id_apr and estado <> " . ELIMINADO . "
							union
								select 'Llenado' as tipo, case when um_agua = 1 then round(sum(cantidad_agua)) else round(sum(cantidad_agua/1000)) end as agua from llenado_agua where date_format(fecha_hora, '%m-%Y') between '$fecha_desde' and '$fecha_hasta' and id_apr = $id_apr and estado = " . ACTIVO;

			} else {
				$consulta = "SELECT 'Consumo' as tipo, round(sum(metros*1000)) as agua from metros where date_format(fecha_ingreso, '%m-%Y') between '$fecha_desde' and '$fecha_hasta' and id_apr = $id_apr and estado <> " . ELIMINADO . "
							union
								select 'Llenado' as tipo, case when um_agua = 1 then round(sum(cantidad_agua*1000)) else round(sum(cantidad_agua)) end as agua from llenado_agua where date_format(fecha_hora, '%m-%Y') between '$fecha_desde' and '$fecha_hasta' and id_apr = $id_apr and estado = " . ACTIVO;
			}

			$query = $db->query($consulta);
			$data = $query->getResultArray();

			return json_encode($data);
	    }

	    public function datatable_informe_lecturas_sector($db, $id_apr, $id_sector) {
	    	define("ELIMINADO", 0);
			$estado = ELIMINADO;

			$consulta = "SELECT
							ifnull(s.ruta, 'No registrada') as ruta,
						    s.rol as rol_socio,
						    concat(s.nombres, ' ', s.ape_pat, ' ', s.ape_mat) as socio,
						    med.numero as n_medidor,
						    m.consumo_actual as lectura_anterior,
						    ' ' as lectura_actual
						from 
							metros m
						    inner join socios s on m.id_socio = s.id
						    inner join arranques a on a.id_socio = s.id
						    inner join medidores med on a.id_medidor = med.id
						where
							date_format(m.fecha_ingreso, '%m-%Y') = date_format(DATE_SUB(NOW(), INTERVAL '1' MONTH), '%m-%Y') and
						    m.id_apr = $id_apr and
						    m.estado != $estado and
    						a.id_sector = $id_sector";

			$query = $db->query($consulta);
			$data = $query->getResultArray();

			$salida = array('data' => $data);
			return json_encode($salida);
		}
	}
?>