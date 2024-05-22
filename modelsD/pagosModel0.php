<?php
include_once "conexion.php";
class pagos_model extends conexion
{

	public $CNX;

	public $consulta;
	public $descripcion;
	public $direccion;
	public $cedula;
	public $tlfno;
	public $nombres;
	public $apellidos;
	public $fecha;
	public $email;
	public $telefono;
	public $status;
	public $id_tipo_empleado;
	public $id;
	public $consulta1;
	public $full_name;
	public $id_evolucion;
	public $tipo;
	public $tasa;
	public $referencia;
	public $monto;
	public $equivalente;
	public $leyenda;

	public function __construct(array $data)
	{
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
		try {
			$this->CNX = parent::conectar();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Consultar($metodo, $param1 = "", $param2 = "")
	{
		if ($metodo == "listarPagos") {
			return self::listarPagos();
		}
		if ($metodo == "extraerEvolucionCita" && $param1 != "" && $param2 != "") {
			return self::extraerEvolucionCita($param1, $param2);
		}
		if ($metodo == "verificarPago" && $param1 != "") {
			return self::verificarPago($param1);
		}
		if ($metodo == "listarStatus") {
			return self::listarStatus();
		}
		if ($metodo == "listarPagosPaciente" && $param1 != "") {
			return self::listarPagosPaciente($param1);
		}
		if ($metodo == "cargarPagos" && $param1 != "") {
			return self::cargarPagos($param1);
		}
	}
	public function Registrar($metodo, $param1 = [])
	{
		if ($metodo == "registrarPagos" && !empty($param1)) {
			return self::registrarPagos($param1);
		}
	}
	public function Modificar($metodo, $param1 = [])
	{
		if ($metodo == "modificarPagos" && !empty($param1)) {
			return self::modificarPagos($param1);
		}
	}
	public function Eliminar($metodo, $param1 = "")
	{
		if ($metodo == "deletePagos" && $param1 != "") {
			return self::deletePagos($param1);
		}
		if ($metodo == "inhabilitarPagos" && $param1 != "") {
			return self::inhabilitarPagos($param1);
		}
		if ($metodo == "habilitarPagos" && $param1 != "") {
			return self::habilitarPagos($param1);
		}
	}

	// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
	private function extraerEvolucionCita($opcion, $id)
	{
		try {
			if ($opcion == "evolucion") {
				$query = "SELECT *, e.id as id_evolucion FROM paciente as p, cita as c, historia as h, evolucion as e WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and c.id=?";
			}
			if ($opcion == "cita") {
				$query = "SELECT *, c.id as id_cita FROM paciente as p, cita as c, historia as h, evolucion as e WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and e.id=?";
			}
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function verificarPago(pagos_model $data)
	{
		try {
			if ($data->id_tipo == "1" || $data->id_tipo == "4") {
				// Transferencia o Pago movil // Efectivo (Bolivares)
				$query = "SELECT * FROM pagos WHERE fecha_pago=? and tipo_pago=? and monto=? and referencia=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($data->fecha, $data->tipo, $data->monto, $data->referencia));
			}
			if ($data->id_tipo == "2" || $data->id_tipo == "3") {
				// Divisas (Dolares) // Divisas (Euros)
				// $query="SELECT * FROM pagos WHERE fecha_pago=? and tipo_pago=? and referencia=? and equivalente=?";
				$query = "SELECT * FROM pagos WHERE fecha_pago=? and tipo_pago=? and referencia=?";
				$smt = $this->CNX->prepare($query);
				// $smt->execute(array($data->fecha, $data->tipo, $data->referencia, $data->equivalente));
				$smt->execute(array($data->fecha, $data->tipo, $data->referencia));
			}
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//RESGISTRAR EMPLEADO EN BD
	private function registrarPagos(pagos_model $data)
	{
		try {
			$query = "INSERT INTO pagos (id_evolucion, fecha_pago, tipo_pago, tasa, referencia, monto, equivalente, leyenda, status) values (?,?,?,?,?,?,?,?,?)";
			$result = $this->CNX->prepare($query)->execute(array($data->id_evolucion, $data->fecha, $data->tipo, $data->tasa, $data->referencia, $data->monto, $data->equivalente, $data->leyenda, '1'));
			return $result;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function listarPagos()
	{
		try {
			// $query = "SELECT pg.id, ROW_NUMBER() OVER () AS numero,  pg.fecha_pago, concat(p.nombres, ' ', p.apellidos) as nombre_paciente, pg.tipo_pago, pg.referencia, pg.tasa, pg.monto, pg.equivalente, pg.leyenda, pg.status FROM paciente as p, cita as c, historia as h, evolucion as e, pagos as pg WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and e.id=pg.id_evolucion and pg.status=1 ORDER BY pg.fecha_pago";
			$varSQL = "";
			if (!empty($_GET['fechaa']) && !empty($_GET['fechac'])) {
				$varSQL .= " and pg.fecha_pago BETWEEN '" . $_GET['fechaa'] . "' and '" . $_GET['fechac'] . "'";
			}
			$query = "SELECT pg.id, ROW_NUMBER() OVER () AS numero,  pg.fecha_pago, concat(p.nombres, ' ', p.apellidos) as nombre_paciente, pg.tipo_pago, pg.referencia, pg.tasa, pg.monto, pg.equivalente, pg.leyenda, pg.status FROM paciente as p, cita as c, historia as h, evolucion as e, pagos as pg WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and e.id=pg.id_evolucion and pg.status=1 " . $varSQL . " ORDER BY pg.fecha_pago";
			$smt = $this->CNX->prepare($query);
			$smt->execute();
			$data = $smt->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($data);
			// $data->tasaM = number_format($data->tasa, 2, ',','.');
			for ($i = 0; $i < count($data); $i++) {
				if ($data[$i]['referencia'] == "") {
					$data[$i]['referencia'] = " - ";
				}
				if ($data[$i]['tasa'] != "") {
					$data[$i]['tasaM'] = "Bs." . number_format($data[$i]['tasa'], 2, ',', '.');
				} else {
					$data[$i]['tasaM'] = " - ";
				}
				if ($data[$i]['monto'] != "") {
					$data[$i]['montoM'] = "Bs." . number_format($data[$i]['monto'], 2, ',', '.');
				} else {
					$data[$i]['montoM'] = " - ";
				}
				if ($data[$i]['equivalente'] != "") {
					$data[$i]['equivalenteM'] = "$" . number_format($data[$i]['equivalente'], 2, ',', '.');
				} else {
					$data[$i]['equivalenteM'] = " - ";
				}
				if ($data[$i]['status'] == "1") {
					$data[$i]['estado'] = "Activo";
				} else if ($data[$i]['status'] == "2") {
					$data[$i]['estado'] = "Inactivo";
				} else if ($data[$i]['status'] == "0") {
					$data[$i]['estado'] = "Borrado";
				}
			}
			// print json_encode($data,JSON_UNESCAPED_UNICODE);
			return $data;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function cargarPagos($id)
	{
		try {
			$query = "SELECT * FROM pagos WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			return $smt->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//ACTUALIZAR CONSULTORIO EN BD
	private function modificarPagos(pagos_model $data)
	{
		try {
			$query = "UPDATE pagos set fecha_pago=?, tasa=?, referencia=?, monto=?, equivalente=?, leyenda=? where id=?";
			$result = $this->CNX->prepare($query)->execute(array($data->fecha, $data->tasa, $data->referencia, $data->monto, $data->equivalente, $data->leyenda, $data->id));
			return $result;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function listarStatus()
	{
		try {
			$query = "SELECT * from status";
			$smt = $this->CNX->prepare($query);
			$smt->execute();
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function listarPagosPaciente($cedula)
	{
		try {
			$query = "SELECT * FROM paciente as p, cita as c, historia as h, evolucion as e, pagos as pg WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and e.id=pg.id_evolucion and p.cedula=? and pg.status=1";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($cedula));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	//ELIMINAR PACIENTE DE LA BD
	private function deletePagos($id)
	{
		try {
			// $query="DELETE from pagos WHERE id=?";
			$query = "UPDATE pagos set status='0' WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			// return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function inhabilitarPagos($id)
	{
		try {
			$query = "UPDATE pagos set status='2' WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$result = $smt->execute(array($id));
			// return $smt->fetchAll(PDO::FETCH_OBJ);
			return $result;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function habilitarPagos($id)
	{
		try {
			$query = "UPDATE pagos set status='1' WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			// return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
