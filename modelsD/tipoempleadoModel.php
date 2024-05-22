<?php
	
	include_once "conexion.php";
    class tipoempleado_model extends conexion_database {

		//public $CNX;

		public $descripcion;
		public $id;
		public $status;
		public $consulta;
		public $consulta1;



		public function Consultar($metodo, $param1=""){
			if($metodo=="listarTipoEmpleado"){ return self::listarTipoEmpleado(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }

			if($metodo=="verificarTipoEmpleado" && $param1!=""){ return self::verificarTipoEmpleado($param1); }
			if($metodo=="verificarTipoEmpleado1" && $param1!=""){ return self::verificarTipoEmpleado1($param1); }
			if($metodo=="buscarRegistroTipoEmpleado" && $param1!=""){ return self::buscarRegistroTipoEmpleado($param1); }
			if($metodo=="cargarTipoEmpleado" && $param1!=""){ return self::cargarTipoEmpleado($param1); }
			
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarTipoEmpleado" && !empty($param1)){ return self::registrarTipoEmpleado($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarTipoEmpleado" && !empty($param1)){ return self::modificarTipoEmpleado($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="inhabilitarTipoEmpleado" && $param1!=""){ return self::inhabilitarTipoEmpleado($param1); }
			if($metodo=="habilitarTipoEmpleado" && $param1!=""){ return self::habilitarTipoEmpleado($param1); }
			if($metodo=="EliminarTipoEmpleado" && $param1!=""){ return self::EliminarTipoEmpleado($param1); }
		}






		// CONSULTAR REGISTRO DE TIPO EMPLEADO
		private function verificarTipoEmpleado($id){
			try {
				$query="SELECT * FROM tipo_empleado WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function verificarTipoEmpleado1($descripcion){
			try {
				$query="SELECT * FROM tipo_empleado WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($descripcion));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// CARGAR REGISTRO DE TIPO EMEPLADO
		private function buscarRegistroTipoEmpleado($consultaBusqueda){
			try {
				$query="SELECT * FROM tipo_empleado WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR TIPO EMPLEADO EN BD
		private function registrarTipoEmpleado(tipoempleado_model $data){
			try {
				$query="INSERT into tipo_empleado (descripcion,status) values (?,?)";
				$this->CNX->prepare($query)->execute(array($data->descripcion,'1'));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//FUNCION PARA LLENAR TABLA TIPO EMPLEADOS
		private function listarTipoEmpleadox(){
			try {
				
				$query="SELECT * from tipo_empleado";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarTipoEmpleado(){
			try {
				
				$query="SELECT t.id,t.descripcion,s.status as estado from tipo_empleado as t inner join status as s where t.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		//ELIMINACION LOGICA DE TIPO EMPLEADO DE LA BD
		private function inhabilitarTipoEmpleado($id){
			try {

				$query="UPDATE tipo_empleado set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarTipoEmpleado($id){
			try {

				$query="UPDATE tipo_empleado set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarTipoEmpleado($id){
			try {

				$query="DELETE from tipo_empleado WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		//ACTUALIZAR TIPO EMPLEADO EN BD
		private function modificarTipoEmpleado(tipoempleado_model $data){
			try {
				$query="UPDATE tipo_empleado set descripcion=?,status=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->descripcion,$data->status,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// CARGAR REGISTRO DE CONSULTORIOS
		private function cargarTipoEmpleado($id){
			try {
				$query="SELECT * FROM tipo_empleado WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//FUNCION PARA COMPARAR STATUS EN LA VISTA EDITAR TIPO DE EMPLEADO
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


    }




?>