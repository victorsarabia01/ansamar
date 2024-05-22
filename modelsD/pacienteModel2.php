<?php
	// Herencia de la base de datos en el modelo
include_once "conexion.php";
	class paciente_model extends conexion_database {
		
		public $CNX;
		public $consulta;
		public $descripcion;
		public $direccion;
		public $cedula;
		public $tlfno;
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
		public $arreglo=array();
		public $resultado;
				
		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="listarTodosConsultorios"){ return self::listarTodosConsultorios(); }
			if($metodo=="listarPaciente"){ return self::listarPaciente(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			if($metodo=="listarCondicionMedica"){ return self::listarCondicionMedica(); }
			
			if($metodo=="validarCedula" && $param1!=""){ return self::validarCedula($param1); }
			if($metodo=="validarCedulax" && $param1!=""){ return self::validarCedulax($param1); }
			if($metodo=="validarCedula1" && $param1!=""){ return self::validarCedula1($param1); }
			if($metodo=="cargarPaciente" && $param1!=""){ return self::cargarPaciente($param1); }
			if($metodo=="listarCondicionMedicaPaciente" && $param1!=""){ return self::listarCondicionMedicaPaciente($param1); }
			if($metodo=="buscarRegistroPaciente" && $param1!=""){ return self::buscarRegistroPaciente($param1); }

			if($metodo=="validarCondicionMedica" && $param1!="" && $param2!=""){ return self::validarCondicionMedica($param1, $param2); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarPaciente" &&$param1!=""){ return self::registrarPaciente($param1); }
			if($metodo=="registrarCondicionMedicaPaciente" && $param1!=""){ return self::registrarCondicionMedicaPaciente($param1); }
			if($metodo=="registrarCondicionMedicaPaciente1" && $param1!=""){ return self::registrarCondicionMedicaPaciente1($param1); }
		}
		public function Editar($metodo, $param1=[]){
			if($metodo=="editarPaciente" &&$param1!=""){ return self::editarPaciente($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="deletePaciente" && $param1!=""){ return self::deletePaciente($param1); }
			if($metodo=="eliminarCondicionMedica" && $param1!=""){ return self::eliminarCondicionMedica($param1); }
		}
		
		private function listarTodosConsultorios(){
			try {
				$query="SELECT * from consultorio where status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
		private function validarCedula($cedula){
			try {
				$query="SELECT id as consulta from paciente where cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function validarCedulax($cedula){
			try {
				$query="SELECT * from paciente where cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
		private function validarCedula1($id){
			try {
				$query="SELECT * from paciente where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function validarCondicionMedica($id,$condicion){
			try {
				$query="SELECT * from detalles_condicion_medica where id_paciente=? and id_condicion_medica=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id,$condicion));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//ACTUALIZAR PACIENTE EN BD
		private function editarPaciente(paciente_model $data){
			try {
				$query="UPDATE paciente set cedula=?,nombres=?,apellidos=?,fechaNacimiento=?,direccion=?,email=?,tlfno=?,sexo=?,status=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombres,$data->apellidos,$data->fechaNacimiento,$data->direccion,$data->correo,$data->telefono,$data->sexo,$data->status,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA BUSCAR LOS DATOS DEL PACIENTE A EDITAR
		private function cargarPaciente($id){
			try {
				$query="SELECT * from paciente where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		private function registrarPaciente(paciente_model $data){
			try {
				$query="INSERT into paciente (cedula,nombres,apellidos,fechaNacimiento,direccion,email,tlfno,sexo,status) values (?,?,?,?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombres,$data->apellidos,$data->fechaNacimiento,$data->direccion,$data->correo,$data->telefono,$data->sexo,'1'));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function registrarCondicionMedicaPaciente1($dato){
			try {
				$query="INSERT into detalles_condicion_medica (id_condicion_medica,id_paciente) values (?,?)";
				$this->CNX->prepare($query)->execute(array($dato,'2'));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function registrarCondicionMedicaPaciente(paciente_model $data){
			try {
				$query="INSERT into detalles_condicion_medica (id_condicion_medica,id_paciente) values (?,?)";
				$this->CNX->prepare($query)->execute(array($data->condicion,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarPaciente(){
			try {
				//$arreglo;
				$query="SELECT p.id, p.cedula, CONCAT(p.nombres, ' ', p.apellidos) AS full_name,p.tlfno,p.email,s.status as estado from paciente as p INNER JOIN status as s where p.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarPaciente1(){
			try {
		
				$query="SELECT * from paciente";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
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
		
		private function listarCondicionMedica(){
			try {
				
				$query="SELECT * from condicion_medica where status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarCondicionMedicaPaciente($id){
			try {
				
				$query="SELECT d.id,c.descripcion,c.observacion from condicion_medica as c inner join detalles_condicion_medica as d where d.id_condicion_medica=c.id and d.id_paciente=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//ELIMINAR PACIENTE DE LA BD
		private function deletePaciente($id){
			try {

				$query="UPDATE paciente set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarCondicionMedica($id){
			try {

				$query="DELETE from detalles_condicion_medica WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroPaciente($consultaBusqueda){
			try {
				$query="SELECT * FROM paciente WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		
















		public function listarTodosTipoEmpleados(){
			try {
		
				$query="SELECT * FROM tipo_empleado";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	
		// CONSULTAR REGISTRO DE CONSULTORIOS
		public function cargarConsultorio($id){
			try {
				$query="SELECT * FROM consultorio WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		//RESGISTRAR CONSULTORIO EN BD
		public function registrarConsultorio(consultorio_model $data){
			try {
				$query="INSERT into consultorio (descripcion,direccion) values (?,?)";
				$this->CNX->prepare($query)->execute(array($data->descripcion,$data->direccion));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


	} 
?>