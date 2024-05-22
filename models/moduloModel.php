<?php
	
	class modulo_model extends conexion_database {
		
		public $CNX;
		public $consulta;
		public $nombre;
		public $status;
		public $id;
		public $consulta1;
		public $ulListado1;
		public $ulListado;
		public $condicion;
		public $condicion1;
		public $prueba;
		public $elementos_array;
		public $observacion;


		
		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="listarModulo"){ return self::listarModulo(); }
			if($metodo=="listarModulos"){ return self::listarModulos(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			// if($metodo=="listarCondicionMedica"){ return self::listarCondicionMedica(); }
			
			if($metodo=="cargarModulo" && $param1!=""){ return self::cargarModulo($param1); }
			if($metodo=="validarId" && $param1!=""){ return self::validarId($param1); }
			if($metodo=="validarNombre" && $param1!=""){ return self::validarNombre($param1); }
			if($metodo=="buscarRegistroModulo" && $param1!=""){ return self::buscarRegistroModulo($param1); }

		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarModulo" && !empty($param1)){ return self::registrarModulo($param1); }
		}
		public function Editar($metodo, $param1=[]){
			if($metodo=="editarModulo" && !empty($param1)){ return self::editarModulo($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="inhabilitarModulo" && $param1!=""){ return self::inhabilitarModulo($param1); }
			if($metodo=="habilitarModulo" && $param1!=""){ return self::habilitarModulo($param1); }
			if($metodo=="eliminarModulo" && $param1!=""){ return self::eliminarModulo($param1); }
		}
		
		private function validarNombre($cedula){
			try {
				$query="SELECT * from modulo where nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
		private function validarId($id){
			try {
				$query="SELECT * from modulo where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	
		//ACTUALIZAR PACIENTE EN BD
		private function editarModulo(modulo_model $data){
			try {
				$query="UPDATE modulo set nombre=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->nombre, $data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// FUNCION PARA BUSCAR LOS DATOS DEL PACIENTE A EDITAR
		private function cargarModulo($id){
			try {
				$query="SELECT * from modulo where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		private function registrarModulo(modulo_model $data){
			try {
				$query="INSERT into modulo (nombre, status) values (?,?)";
				$this->CNX->prepare($query)->execute(array($data->nombre, '1'));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		private function listarModulo(){
			try {
		
				$query="SELECT * from modulo order by nombre asc";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarModulos(){
			try {
				//$arreglo;
				$query="SELECT m.id,m.nombre,s.status as estado from modulo as m INNER JOIN status as s where m.status=s.id order by m.nombre asc";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
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
		
		
		//ELIMINAR PACIENTE DE LA BD
		private function inhabilitarModulo($id){
			try {

				$query="UPDATE modulo set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarModulo($id){
			try {

				$query="UPDATE modulo set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarModulo($id){
			try {

				$query="DELETE FROM modulo WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroModulo($consultaBusqueda){
			try {
				$query="SELECT * FROM modulo WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		
















		// public function listarTodosTipoEmpleados(){
		// 	try {
		
		// 		$query="SELECT * FROM tipo_empleado";
		// 		$smt = $this->CNX->prepare($query);
		// 		$smt->execute();
		// 		return $smt->fetchAll(PDO::FETCH_OBJ);
		// 	} catch (Exception $e) {
		// 		die($e->getMessage());
		// 	}
		// }
	
		// // CONSULTAR REGISTRO DE CONSULTORIOS
		// public function cargarConsultorio($id){
		// 	try {
		// 		$query="SELECT * FROM consultorio WHERE id=?";
		// 		$smt = $this->CNX->prepare($query);
		// 		$smt->execute(array($id));
		// 		return $smt->fetchAll(PDO::FETCH_OBJ);
		// 	} catch (Exception $e) {
		// 		die($e->getMessage());
		// 	}
		// }
		
		// //RESGISTRAR CONSULTORIO EN BD
		// public function registrarConsultorio(consultorio_model $data){
		// 	try {
		// 		$query="INSERT into consultorio (descripcion,direccion) values (?,?)";
		// 		$this->CNX->prepare($query)->execute(array($data->descripcion,$data->direccion));
				
		// 	} catch (Exception $e) {
		// 		die($e->getMessage());
		// 	}
		// }


	} 
?>