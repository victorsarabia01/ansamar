<?php
	include_once "conexion.php";
	class rol_model extends conexion_database {
		
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
		public $id_rol;
		public $id_modulo;
		public $id_permiso;

		
		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="listarRol"){ return self::listarRol(); }
			if($metodo=="listarRoles"){ return self::listarRoles(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			// if($metodo=="listarCondicionMedica"){ return self::listarCondicionMedica(); }
			
			if($metodo=="cargarRol" && $param1!=""){ return self::cargarRol($param1); }
			if($metodo=="cargarAccesos" && $param1!=""){ return self::cargarAccesos($param1); }
			if($metodo=="validarId" && $param1!=""){ return self::validarId($param1); }
			if($metodo=="validarNombre" && $param1!=""){ return self::validarNombre($param1); }
			if($metodo=="buscarRegistroRol" && $param1!=""){ return self::buscarRegistroRol($param1); }

			if($metodo=="getLastId" && $param1!="" && $param2!=""){ return self::getLastId($param1, $param2); }

		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarRol" && !empty($param1)){ return self::registrarRol($param1); }
			if($metodo=="registrarAcceso" && !empty($param1)){ return self::registrarAcceso($param1); }
		}
		public function Editar($metodo, $param1=[]){
			if($metodo=="editarRol" && !empty($param1)){ return self::editarRol($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="habilitarRol" && $param1!=""){ return self::habilitarRol($param1); }
			if($metodo=="inhabilitarRol" && $param1!=""){ return self::inhabilitarRol($param1); }
			if($metodo=="eliminarRol" && $param1!=""){ return self::eliminarRol($param1); }
			if($metodo=="deleteRol" && $param1!=""){ return self::deleteRol($param1); }
			if($metodo=="deleteAccesos" && $param1!=""){ return self::deleteAccesos($param1); }
		}
		
		private function validarNombre($cedula){
			try {
				$query="SELECT * from rol where nombre=?";
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
				$query="SELECT * from rol where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	
		//ACTUALIZAR PACIENTE EN BD
		private function editarRol(rol_model $data){
			try {
				$query="UPDATE rol set nombre=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->nombre, $data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// FUNCION PARA BUSCAR LOS DATOS DEL PACIENTE A EDITAR
		private function cargarRol($id){
			try {
				$query="SELECT * from rol where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarAccesos($id){
			try {
				$query="SELECT accesos.id as id_acceso, rol.id as id_rol, rol.nombre as nombre_rol, permiso.id as id_permiso, permiso.nombre as nombre_permiso, modulo.id as id_modulo, modulo.nombre as nombre_modulo FROM rol, permiso, modulo, accesos WHERE rol.id=accesos.id_rol and permiso.id=accesos.id_permiso and modulo.id=accesos.id_modulo and modulo.status=1 and permiso.status=1 and accesos.id_rol=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		private function registrarRol(rol_model $data){
			try {
				$query="INSERT into rol (nombre, status) values (?,?)";
				$this->CNX->prepare($query)->execute(array($data->nombre, '1'));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function registrarAcceso(rol_model $data){
			try {
				$query="INSERT into accesos (id_rol, id_permiso, id_modulo) values (?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_rol, $data->id_permiso, $data->id_modulo));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		private function listarRol(){
			try {
				$query="SELECT * from rol";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarRoles(){
			try {
				//$arreglo;
				$query="SELECT r.id,r.nombre,s.status as estado from rol as r INNER JOIN status as s where r.status=s.id";
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
		private function inhabilitarRol($id){
			try {
				$query="UPDATE rol SET status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarRol($id){
			try {
				$query="UPDATE rol SET status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarRol($id){
			try {
				$query="DELETE FROM rol WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function deleteAccesos($id){
			try {
				$query="DELETE FROM accesos WHERE id_rol=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroRol($consultaBusqueda){
			try {
				$query="SELECT * FROM rol WHERE nombre=?";
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

		private function getLastId($tabla, $id)
		{
			//$sql='SELECT '.$id.' FROM '.$tabla.' ORDER BY '.$id.' desc';
			$query = 'SELECT MAX(' . $id . ') as id FROM ' . $tabla;
			try {
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$result = $smt->fetchAll();
				return $result[0]['id'];
			} catch (PDOException $e) {
				echo "Error al consultar el Id de la tabla $tabla <br>";
				echo $e;
			}
		}


	} 
?>