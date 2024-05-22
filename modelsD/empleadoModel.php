<?php
	include_once "conexion.php";
	class empleado_model extends conexion_database {
		
		//public $CNX;

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


		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="listarEmpleado"){ return self::listarEmpleado(); }
			if($metodo=="listarEmpleadoUsuario"){ return self::listarEmpleadoUsuario(); }
			if($metodo=="listarEmpleadoUsuario1"){ return self::listarEmpleadoUsuario1(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			if($metodo=="listarTodosTipoEmpleados"){ return self::listarTodosTipoEmpleados(); }
			if($metodo=="validarCedula" && $param1!=""){ return self::validarCedula($param1); }
			if($metodo=="verificarEmpleado" && $param1!=""){ return self::verificarEmpleado($param1); }
			if($metodo=="verificarEmpleado1" && $param1!=""){ return self::verificarEmpleado1($param1); }
			if($metodo=="verificarEmpleadoCedula" && $param1!=""){ return self::verificarEmpleadoCedula($param1); }
			if($metodo=="cargarEmpleado" && $param1!=""){ return self::cargarEmpleado($param1); }
			if($metodo=="buscarRegistroEmpleado" && $param1!=""){ return self::buscarRegistroEmpleado($param1); }
			if($metodo=="consultarRegistroEmpleado" && $param1!=""){ return self::consultarRegistroEmpleado($param1); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarEmpleado" && !empty($param1)){ return self::registrarEmpleado($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarEmpleado" && !empty($param1)){ return self::modificarEmpleado($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="deleteEmpleado" && $param1!=""){ return self::deleteEmpleado($param1); }
			if($metodo=="inhabilitarEmpleado" && $param1!=""){ return self::inhabilitarEmpleado($param1); }
			if($metodo=="habilitarEmpleado" && $param1!=""){ return self::habilitarEmpleado($param1); }
			
		}
		
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
		private function validarCedula($cedula){
			try {
				$query="SELECT id as consulta from empleado where cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// CONSULTAR REGISTRO DE EMPLEADO
		private function verificarEmpleado($id){
			try {
				$query="SELECT * FROM empleado WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function verificarEmpleado1($cedula){
			try {
				$query="SELECT * FROM empleado WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function verificarEmpleadoCedula($cedula){
			try {
				$query="SELECT * FROM empleado WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		private function registrarEmpleado(empleado_model $data){
			try {
				$query="INSERT into empleado (cedula,nombres,apellidos,fechaNacimiento,email,tlfno,direccion,status,id_tipo_empleado) values (?,?,?,?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombres,$data->apellidos,$data->fechaNacimiento,$data->correo,$data->telefono,$data->direccion,'1',$data->tipo_empleado));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarEmpleado(){
			try {
		
				$query="SELECT p.id,t.descripcion as cargo,p.cedula,CONCAT(p.apellidos,p.nombres) as full_name,p.tlfno,p.email,p.direccion ,es.status as estado FROM empleado AS p INNER JOIN tipo_empleado as t INNER JOIN status as es where p.id_tipo_empleado=t.id and p.status=es.id order by t.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarEmpleadoUsuario(){
			try {
		
				$query="SELECT p.cedula,CONCAT(p.apellidos,p.nombres) as full_name FROM empleado AS p INNER JOIN tipo_empleado as t INNER JOIN status as es where p.id_tipo_empleado=t.id and p.status=es.id order by t.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetch(PDO::FETCH_OBJ);
				//$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				//print json_encode($data,JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarEmpleadoUsuario1(){
			try {
		
				$query="SELECT DISTINCT p.id,p.cedula,p.nombres,p.apellidos FROM empleado AS p INNER JOIN tipo_empleado as t INNER JOIN usuario as u where p.id_tipo_empleado=t.id and p.id NOT IN (SELECT id_empleado from usuario) and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//ELIMINAR PACIENTE DE LA BD
		private function deleteEmpleado($id){
			try {

				$query="DELETE from empleado WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	
		private function cargarEmpleado($id){
			try {
				$query="SELECT * FROM empleado WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	

		//ACTUALIZAR CONSULTORIO EN BD
		private function modificarEmpleado(empleado_model $data){
			try {
				$query="UPDATE empleado set cedula=?,nombres=?,apellidos=?,fechaNacimiento=?,email=?,tlfno=?,direccion=?,id_tipo_empleado=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombres,$data->apellidos,$data->fechaNacimiento,$data->correo,$data->telefono,$data->direccion,$data->tipo_empleado,$data->id));
				
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

		
		private function listarTodosTipoEmpleados(){
			try {
		
				$query="SELECT * FROM tipo_empleado WHERE status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	

		private function buscarRegistroEmpleado($consultaBusqueda){
			try {
				$query="SELECT e.id,e.cedula, e.nombres, e.apellidos, e.fechaNacimiento, e.email, e.tlfno, e.direccion, e.status, t.descripcion as tipo_empleado FROM empleado as e INNER JOIN tipo_empleado as t where e.cedula=?";
				
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// CONSULTAR REGISTRO DE EMPLEADOS
		private function consultarRegistroEmpleado($cedula){
			try {
				$query="SELECT * FROM empleado WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function inhabilitarEmpleado($id){
			try {

				$query="UPDATE empleado set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarEmpleado($id){
			try {

				$query="UPDATE empleado set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
				
		
		
		
		}
		
		
		
		
		
		
		
		
	
?>