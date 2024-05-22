<?php
	include_once "conexion.php";
	class bitacora_model extends conexion_database {
		
		public function AnexarBitacora($accion="", $modulo=""){
			$data['id_usuario']=$_SESSION[NAME.'_cuenta']['id'];
			// $data['id_usuario']=2;
			$data['fecha']=date('Y-m-d');
			$data['hora']=date('H:i');
			if(!empty($_GET['c'])){ $data['modulo']=ucwords(mb_strtolower($_GET['c'])); } else { $data['modulo']=ucwords(mb_strtolower("Home")); }
			if(!empty($_GET['a'])){ $data['accion']=ucwords(mb_strtolower($_GET['a'])); } else { $data['accion']=ucwords(mb_strtolower("Consultar")); }
			if($data['modulo']==ucwords(mb_strtolower("Home"))){ $data['modulo']="Inicio"; }
			if($data['modulo']==ucwords(mb_strtolower("Login"))){ $data['modulo']="Sistema"; }
			if($accion!=""){ $data['accion']=ucwords(mb_strtolower($accion)); }
			if($modulo!=""){ $data['modulo']=ucwords(mb_strtolower($modulo)); }

			$buscar = self::Consultar("verificarBitacora", $data['id_usuario']);
			$continuar = false;
			if(count($buscar)>0){
				$result = $buscar[0];
				if(mb_strtolower($result->modulo)==mb_strtolower($data['modulo']) && mb_strtolower($result->accion)==mb_strtolower($data['accion']) ){
					$continuar=false;
				}else{
					$continuar=true;
				}
			}else{
				$continuar=true;
			}
			if($continuar){
				self::Registrar("registrarBitacora",$data);
			}
		}

		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="verificarBitacora"){ return self::verificarBitacora($param1); }
			if($metodo=="listarBitacora"){ return self::listarBitacora(); }
			// if($metodo=="extraerEvolucionCita" && $param1!="" && $param2!=""){ return self::extraerEvolucionCita($param1, $param2); }
			// if($metodo=="verificarPago" && $param1!=""){ return self::verificarPago($param1); }
			// if($metodo=="listarStatus"){ return self::listarStatus(); }
			// if($metodo=="listarPagosPaciente" && $param1!=""){ return self::listarPagosPaciente($param1); }
			// if($metodo=="cargarPagos" && $param1!=""){ return self::cargarPagos($param1); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarBitacora" && !empty($param1)){ return self::registrarBitacora($param1); }
		}
		// public function Modificar($metodo, $param1=[]){
		// 	if($metodo=="modificarPagos" && !empty($param1)){ return self::modificarPagos($param1); }
		// }
		// public function Eliminar($metodo, $param1=""){
		// 	if($metodo=="deletePagos" && $param1!=""){ return self::deletePagos($param1); }
		// 	if($metodo=="inhabilitarPagos" && $param1!=""){ return self::inhabilitarPagos($param1); }
		// 	if($metodo=="habilitarPagos" && $param1!=""){ return self::habilitarPagos($param1); }
			
		// }
		
		
		private function verificarBitacora($id){
			try {
				$varSQL = "";
				if($id!=""){
					$varSQL .= " and u.id=".$id;
				}
				$query="SELECT b.id, b.modulo, b.accion, b.fecha, b.hora, u.id as id_usuario, u.id_rol, u.usuario, e.cedula, concat(e.nombres, ' ', e.apellidos) as nombre FROM bitacora as b, usuario as u, empleado as e WHERE b.id_usuario=u.id and u.id_empleado=e.id ".$varSQL." ORDER BY b.id DESC";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//RESGISTRAR EMPLEADO EN BD
		private function registrarBitacora($data){
			try {
				$query="INSERT INTO bitacora (id, id_usuario, modulo, accion, fecha, hora) values (DEFAULT,?,?,?,?,?)";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($data['id_usuario'], $data['modulo'], $data['accion'], $data['fecha'], $data['hora']));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		private function listarBitacora(){
			try {
				$varSQL = "";
				if(!empty($_GET['fechaa']) && !empty($_GET['fechac'])){
					$varSQL .= " and b.fecha BETWEEN '".$_GET['fechaa']."' and '".$_GET['fechac']."'";
				}
				$query="SELECT b.id, b.modulo, b.accion, b.fecha, b.hora, u.id as id_usuario, u.id_rol, u.usuario, e.cedula, concat(e.nombres, ' ', e.apellidos) as nombre FROM bitacora as b, usuario as u, empleado as e WHERE b.id_usuario=u.id and u.id_empleado=e.id ".$varSQL." ORDER BY b.id DESC";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				// $data->tasaM = number_format($data->tasa, 2, ',','.');
				for ($i=0; $i < count($data); $i++) {
					$data[$i]['fechas'] = $data[$i]['fecha']." ".$data[$i]['hora'];
					$data[$i]['user'] = $data[$i]['cedula']." ".$data[$i]['nombre'];
				// 	if($data[$i]['referencia']==""){
				// 		$data[$i]['referencia'] = " - ";
				// 	}
				// 	if($data[$i]['tasa']!=""){
				// 		$data[$i]['tasaM'] = "Bs.".number_format($data[$i]['tasa'], 2, ',','.');
				// 	} else {
				// 		$data[$i]['tasaM'] = " - ";
				// 	}
				// 	if($data[$i]['monto']!=""){
				// 		$data[$i]['montoM'] = "Bs.".number_format($data[$i]['monto'], 2, ',','.');
				// 	}else{
				// 		$data[$i]['montoM'] = " - ";
				// 	}
				// 	if($data[$i]['equivalente']!=""){
				// 		$data[$i]['equivalenteM'] = "$".number_format($data[$i]['equivalente'], 2, ',','.');
				// 	}else{
				// 		$data[$i]['equivalenteM'] = " - ";
				// 	}
				// 	if($data[$i]['status']=="1"){
				// 		$data[$i]['estado']="Activo";
				// 	}else if($data[$i]['status']=="2"){
				// 		$data[$i]['estado']="Inactivo";
				// 	}else if($data[$i]['status']=="0"){
				// 		$data[$i]['estado']="Borrado";
				// 	}
				}
				print json_encode($data,JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
		private function extraerEvolucionCita($opcion, $id){
			try {
				if($opcion=="evolucion"){
					$query="SELECT *, e.id as id_evolucion FROM paciente as p, cita as c, historia as h, evolucion as e WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and c.id=?";
				}
				if($opcion=="cita"){
					$query="SELECT *, c.id as id_cita FROM paciente as p, cita as c, historia as h, evolucion as e WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and e.id=?";
				}
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function verificarPago(bitacora_model $data){
			try {
				if($data->id_tipo=="1" || $data->id_tipo=="4"){
					// Transferencia o Pago movil // Efectivo (Bolivares)
					$query="SELECT * FROM pagos WHERE fecha_pago=? and tipo_pago=? and monto=? and referencia=?";
					$smt = $this->CNX->prepare($query);
					$smt->execute(array($data->fecha, $data->tipo, $data->monto, $data->referencia));
				}
				if($data->id_tipo=="2" || $data->id_tipo=="3"){
					// Divisas (Dolares) // Divisas (Euros)
					// $query="SELECT * FROM pagos WHERE fecha_pago=? and tipo_pago=? and referencia=? and equivalente=?";
					$query="SELECT * FROM pagos WHERE fecha_pago=? and tipo_pago=? and referencia=?";
					$smt = $this->CNX->prepare($query);
					// $smt->execute(array($data->fecha, $data->tipo, $data->referencia, $data->equivalente));
					$smt->execute(array($data->fecha, $data->tipo, $data->referencia));
				}
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
	
		private function cargarPagos($id){
			try {
				$query="SELECT * FROM pagos WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//ACTUALIZAR CONSULTORIO EN BD
		private function modificarPagos(bitacora_model $data){
			try {
				$query="UPDATE pagos set fecha_pago=?, tasa=?, referencia=?, monto=?, equivalente=?, leyenda=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->fecha, $data->tasa, $data->referencia, $data->monto, $data->equivalente, $data->leyenda, $data->id));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarStatus(){
			try {
				$query="SELECT * from status";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		private function listarPagosPaciente($cedula){
			try {
				$query="SELECT * FROM paciente as p, cita as c, historia as h, evolucion as e, pagos as pg WHERE p.id=c.id_paciente and c.id=h.id_cita and h.id=e.id_historia and e.id=pg.id_evolucion and p.cedula=? and pg.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		//ELIMINAR PACIENTE DE LA BD
		private function deletePagos($id){
			try {
				// $query="DELETE from pagos WHERE id=?";
				$query="UPDATE pagos set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function inhabilitarPagos($id){
			try {
				$query="UPDATE pagos set status='2' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function habilitarPagos($id){
			try {
				$query="UPDATE pagos set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
				
		
		
		
	}
	
?>