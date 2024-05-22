<?php
	include_once "conexion.php";

	class cita_model extends conexion_database {
		
		private $db;
		private $cita;
		//public $CNX;

		public $cedula;
		public $nombres;
		public $apellidos;
		public $tlfn;
		public $tlfno;
		public $cedula_cliente;
		public $alertify;
		public $verificarDia;
		public $mensaje;
		public $nombresDoctor;
		public $apellidosDoctor;
		public $telefono;
		public $id;
		public $consultorio;
		public $turno;
		public $email;
		public $odontologo;


		public function Consultar($metodo, $param1="", $param2="", $param3="", $param4=""){
			if($metodo=="listarTodosConsultorios"){ return self::listarTodosConsultorios(); }
			if($metodo=="listarTodosTurnos"){ return self::listarTodosTurnos(); }
			if($metodo=="listarTodosDoctores"){ return self::listarTodosDoctores(); }
			if($metodo=="listarCitas"){ return self::listarCitas($param1); }
			if($metodo=="listarCitasParaHoy"){ return self::listarCitasParaHoy($param1); }

			if($metodo=="cargarCita" && $param1!=""){ return self::cargarCita($param1); }
			if($metodo=="cargarInformacionCita" && $param1!=""){ return self::cargarInformacionCita($param1); }
			if($metodo=="cargarCedula" && $param1!=""){ return self::cargarCedula($param1); }
			if($metodo=="cargarIdPaciente" && $param1!=""){ return self::cargarIdPaciente($param1); }
			if($metodo=="consultarOdontologo" && $param1!=""){ return self::consultarOdontologo($param1); }
			if($metodo=="buscarRegistroPaciente" && $param1!=""){ return self::buscarRegistroPaciente($param1); }
			if($metodo=="buscarRegistroCita" && $param1!=""){ return self::buscarRegistroCita($param1); }

			if($metodo=="consultarOdontologos" && $param1!="" && $param2!=""){  return self::consultarOdontologos($param1, $param2);  }

			if($metodo=="contadorCitas" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::contadorCitas($param1, $param2, $param3); 
			}
			if($metodo=="consultarOdontologos1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::consultarOdontologos1($param1, $param2, $param3); 
			}
			

			if($metodo=="verificarDiaSemana" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::verificarDiaSemana($param1, $param2, $param3, $param4); 
			}
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarC" && !empty($param1)){ return self::registrarC($param1); }
			if($metodo=="registrarCita" && !empty($param1)){ return self::registrarCita($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarCita" && !empty($param1)){ return self::modificarCita($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="eliminar" && $param1!=""){ return self::eliminarC($param1); }
		}
		
		
		//FUNCION PARA LLENAR LISTA PLEGABLE EN AGENDAR CITA CONSULTORIOS
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
		private function cargarCita($id){
			try {
				$query="SELECT c.fecha, p.cedula,p.cedula, p.nombres,p.apellidos,p.tlfno FROM cita as c inner join paciente as p WHERE c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarInformacionCita($id){
			try {
				$query="SELECT c.id,c.fecha,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,c.id_consultorio as consultorio, c.id_turno as turno, c.id_empleado as odontologo FROM cita as c inner join paciente as p inner join turno as t inner join consultorio as co WHERE c.id_turno=t.id and c.id_paciente=p.id and c.id_consultorio=co.id and c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function modificarCita(cita_model $data){
			try {
				$query="UPDATE cita set fecha=?,id_consultorio=?,id_turno=?,id_empleado=?,id_paciente=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->fechaCita,$data->id_consultorio,$data->id_turno,$data->id_doctor,$data->id_paciente,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
			
			
			//FUNCION PARA LLENAR LISTA PLEGABLE EN AGENDAR CITA TURNOS
		private function listarTodosTurnos(){
			try {
				
				$query="SELECT * from turno";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//FUNCION PARA LLENAR LISTA PLEGABLE EN AGENDAR CITA DOCTORES
		private function listarTodosDoctores(){
			try {
				
				$query="SELECT e.id,e.nombres,e.apellidos from empleado as e inner join tipo_empleado as t where e.id_tipo_empleado=t.id and t.descripcion='odontologo' and e.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		
		//FUNCION PARA REGISTRAR CLIENTE EN BD

		private function registrarC(cita_model $data){
			try {
				$query="INSERT into paciente (cedula,nombres,apellidos,fechaNacimiento,direccion,email,tlfno,status) values (?,?,?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre,$data->apellido,'1994-04-12','direccion',$data->correo,$data->telefono,'1'));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// FUNCION PARA VERIFICAR QUE SI NO EXISTA LA CEDULA EN BD HACER REGISTRO DEL CLIENTE
		private function cargarCedula($cedula){
			try {
				$query="SELECT cedula FROM paciente WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// FUNCION PARA VERIFICAR EL ID DEL CLIENTE PARA ALMACENARLO EN LA TABLA CITA
		private function cargarIdPaciente($cedula){
			try {
				$query="SELECT id FROM paciente WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		private function contadorCitas($fecha,$turno,$consultorio){
			try {
				$query="SELECT COUNT(id) as contador FROM cita WHERE fecha=? and id_turno=? and id_consultorio=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($fecha,$turno,$consultorio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		//FUNCION PARA REGISTRAR CITA

		private function registrarCita(cita_model $data){
			try {
				$query="INSERT into cita (fecha,id_consultorio,id_turno,id_empleado,id_paciente) values (?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->fechaCita,$data->id_consultorio,$data->id_turno,$data->id_doctor,$data->id_paciente));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// FUNCION PARA ODONTOLOGOS
		private function consultarOdontologo($cedula){
			try {
				$query="SELECT * FROM empleado WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// FUNCION PARA ODONTOLOGOS
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

		// FUNCION PARA ODONTOLOGOS
		private function consultarOdontologos($id,$turno){
			try {
				$query="SELECT DISTINCT e.id, e.nombres, e.apellidos from planificacion as p INNER JOIN empleado as e where p.id_empleado=e.id and p.id_consultorio=? and p.id_turno=? and p.status='1'";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id,$turno));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA ODONTOLOGOS
		private function consultarOdontologos1($id,$turno,$empleado){
			try {
				$query="SELECT DISTINCT e.id, e.nombres, e.apellidos, d.nombre as dia from planificacion as p INNER JOIN empleado as e INNER JOIN dia_semana as d where p.id_dia_semana=d.id and p.id_empleado=e.id and p.id_consultorio=? and p.id_turno=? and p.id_empleado=? and p.status='1'";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id,$turno,$empleado));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}



		// FUNCION PARA DIASEMANA
		private function verificarDiaSemana($consultorio,$turno,$cargarOdontologos,$diaSemana){
			try {
				$query="SELECT d.nombre as verificarDia from planificacion as p INNER JOIN dia_semana as d where p.id_dia_semana=d.id and p.id_consultorio=? and p.id_turno=? and p.id_empleado=? and p.id_dia_semana=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$cargarOdontologos,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//ELIMINAR CITA DE LA BD
		private function eliminarC($id){
			try {

				$query="DELETE FROM cita WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// CARGAR REGISTRO DE CITAS
		private function buscarRegistroCita($consultaBusqueda){
			try {
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha) = MONTH(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id and p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarCitas($id_consultorio){
			try {
				$fecha = date('Y-m-d');
				
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha) = MONTH(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
				if($id_consultorio!=""){
					$query .= " and c.id = ".$id_consultorio;
				}
				$query .= " ORDER BY c.fecha desc,c.id_consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarCitasParaHoy($id_consultorio){
			try {
				//$fecha = date('Y-m-d');
				date_default_timezone_set("America/Caracas");
				$fecha = date('Y-m-d');
			
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.fecha='$fecha' and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
				if($id_consultorio!=""){
					$query .= " and c.id = ".$id_consultorio;
				}
				$query .= " ORDER BY c.fecha desc,c.id_consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
	} 
?>