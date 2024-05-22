<?php
	include_once "conexion.php";
	class serviciodental_model extends conexion_database {
		
		//public $CNX;
		public $id;
		public $nombre;
		public $descripcion;
		public $status;
		public $precio;
		public $consulta;
		public $consulta1;

		public function Consultar($metodo, $param1=""){
			if($metodo=="listarServicioDental"){ return self::listarServicioDental(); }
			
			if($metodo=="listarStatus"){ return self::listarStatus(); }

			if($metodo=="verificarServicioDental" && $param1!=""){ return self::verificarServicioDental($param1); }
			if($metodo=="buscarRegistroServicioDental" && $param1!=""){ return self::buscarRegistroServicioDental($param1); }
			if($metodo=="cargarServicioDental" && $param1!=""){ return self::cargarServicioDental($param1); }
			if($metodo=="verificarServicioId" && $param1!=""){ return self::verificarServicioId($param1); }
			if($metodo=="verificarServicioNombre" && $param1!=""){ return self::verificarServicioNombre($param1); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarServicioDental" && !empty($param1)){ return self::registrarServicioDental($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarServicioDental" && !empty($param1)){ return self::modificarServicioDental($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="inhabilitarServicioDental" && $param1!=""){ return self::inhabilitarServicioDental($param1); }
			if($metodo=="habilitarServicioDental" && $param1!=""){ return self::habilitarServicioDental($param1); }
			if($metodo=="eliminarServicioDental" && $param1!=""){ return self::eliminarServicioDental($param1); }
		}

		//FUNCION PARA LLENAR TABLA SERVICIOS
		private function listarServicioDentalx(){
			try {
				
				$query="SELECT * from servicio_dental";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarServicioDental(){
			try {
				
				$query="SELECT t.id,t.nombre,t.descripcion,t.precio,s.status as estado from servicio_dental as t inner join status as s where t.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	
		private function verificarServicioDental($nombre){
			try {
				$query="SELECT * FROM servicio_dental WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($nombre));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function buscarRegistroServicioDental($consultaBusqueda){
			try {
				$query="SELECT * FROM servicio_dental WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR SERVICIO EN BD
		private function registrarServicioDental(serviciodental_model $data){
			try {
				$query="INSERT into servicio_dental (nombre,descripcion,precio,status) values (?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->nombre,$data->descripcion,$data->precio,'1'));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function inhabilitarServicioDental($id){
			try {

				$query="UPDATE servicio_dental set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarServicioDental($id){
			try {

				$query="UPDATE servicio_dental set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarServicioDental($id){
			try {

				$query="DELETE FROM servicio_dental WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarServicioDental($id){
			try {
				$query="SELECT * FROM servicio_dental WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
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

		private function verificarServicioId($id){
			try {
				$query="SELECT * FROM servicio_dental WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function verificarServicioNombre($nombre){
			try {
				$query="SELECT * FROM servicio_dental WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($nombre));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function modificarServicioDental(serviciodental_model $data){
			try {
				$query="UPDATE servicio_dental set nombre=?,descripcion=?,precio=?,status=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->nombre,$data->descripcion,$data->precio,$data->status,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


















		



		// CONSULTAR REGISTRO DE CONSULTORIOS
		

		// CONSULTAR REGISTRO DE CONSULTORIOS
		
		

		// CARGAR REGISTRO DE CONSULTORIOS
		
		// CARGAR REGISTRO DE CONSULTORIOS
		
		
		

		//FUNCION PARA LLENAR TABLA CONSULTORIOS
		// public function listarConsultorios1(){
		// 	try {
		// 		$query="SELECT c.id, c.descripcion,c.direccion,c.tlfno,s.status from consultorio as c inner join status as s where c.id_status=s.id";
		// 		$smt = $this->CNX->prepare($query);
		// 		$smt->execute();
		// 		return $smt->fetchAll(PDO::FETCH_OBJ);
		// 	} catch (Exception $e) {
		// 		die($e->getMessage());
		// 	}
		// }
		// //FUNCION PARA LLENAR TABLA CONSULTORIOS
		// public function listarConsultoriosAjax(){
		// 	try {
		// 		$query="SELECT descripcion, direccion, tlfno, sillas, status, id from consultorio";
		// 		$smt = $this->CNX->prepare($query);
		// 		$smt->execute();
		// 		return $smt->fetchAll(PDO::FETCH_FUNC, fn($descripcion, $direccion,$tlfno,$sillas,$status,$id) => [$descripcion, $direccion,$tlfno,$sillas,$status,$id] );
		// 	} catch (Exception $e) {
		// 		die($e->getMessage());
		// 	}
		// }

		

		//FUNCION PARA COMPARAR STATUS EN LA VISTA EDITAR CONSULTORIO
		

		//ELIMINACION LOGICA DE CONSULTORIO DE LA BD
		

		//ACTUALIZAR CONSULTORIO EN BD
		

		
		
	} 
?>