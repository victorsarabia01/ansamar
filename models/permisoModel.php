<?php
	
	class permiso_model extends conexion_database {
		
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
			if($metodo=="listarPermiso"){ return self::listarPermiso(); }
			if($metodo=="listarPermisos"){ return self::listarPermisos(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			// if($metodo=="listarCondicionMedica"){ return self::listarCondicionMedica(); }
			
			if($metodo=="cargarPermiso" && $param1!=""){ return self::cargarPermiso($param1); }
			if($metodo=="validarId" && $param1!=""){ return self::validarId($param1); }
			if($metodo=="validarNombre" && $param1!=""){ return self::validarNombre($param1); }
			if($metodo=="buscarRegistroPermiso" && $param1!=""){ return self::buscarRegistroPermiso($param1); }

		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarPermiso" && !empty($param1)){ return self::registrarPermiso($param1); }
		}
		public function Editar($metodo, $param1=[]){
			if($metodo=="editarPermiso" && !empty($param1)){ return self::editarPermiso($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="inhabilitarPermiso" && $param1!=""){ return self::inhabilitarPermiso($param1); }
			if($metodo=="habilitarPermiso" && $param1!=""){ return self::habilitarPermiso($param1); }
			if($metodo=="eliminarPermiso" && $param1!=""){ return self::eliminarPermiso($param1); }
		}
		
		private function validarNombre($cedula){
			try {
				$query="SELECT * from permiso where nombre=?";
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
				$query="SELECT * from permiso where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	
		//ACTUALIZAR PACIENTE EN BD
		private function editarPermiso(permiso_model $data){
			try {
				$query="UPDATE permiso set nombre=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->nombre, $data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// FUNCION PARA BUSCAR LOS DATOS DEL PACIENTE A EDITAR
		private function cargarPermiso($id){
			try {
				$query="SELECT * from permiso where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		private function registrarPermiso(permiso_model $data){
			try {
				$query="INSERT into permiso (nombre, status) values (?,?)";
				$this->CNX->prepare($query)->execute(array($data->nombre, '1'));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		private function listarPermiso(){
			try {
				$query="SELECT * from permiso";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarPermisos(){
			try {
				//$arreglo;
				$query="SELECT m.id,m.nombre,s.status as estado from permiso as m INNER JOIN status as s where m.status=s.id order by m.nombre asc";
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
		private function inhabilitarPermiso($id){
			try {
				$query="UPDATE permiso set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarPermiso($id){
			try {
				$query="UPDATE permiso set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarPermiso($id){
			try {
				$query="DELETE FROM permiso WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroPermiso($consultaBusqueda){
			try {
				$query="SELECT * FROM permiso WHERE nombre=?";
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