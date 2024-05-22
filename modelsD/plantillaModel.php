<?php
	
	class plantilla_model extends conexion {
		
		private $db;
		private $cita;
		public $CNX;
		public $cedula;
		public $nombres;
		public $apellidos;
		public $tlfn;
		public $cedula_cliente;
		public $usuario;
		public function __construct(){
			try {
				$this->CNX = parent::conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}




		public function listarCitas(){
			try {
				//$fecha = date('Y-m-d');
				date_default_timezone_set("America/Caracas");
				$fecha = date('Y-m-d');
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha) = MONTH(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.fecha='$fecha' and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		/*public function listarCitasGarabatal(){
			try {
				$fecha = date('Y-m-d');
				$fecha1= '2023-07-11';
				$query="SELECT c.id_consultorio, p.nombres,p.apellidos,p.tlfn,t.descripcion AS turno,d.nombre AS doctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN doctor AS d INNER JOIN turno AS t WHERE c.fecha='$fecha' and c.id_consultorio=1 and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_doctor=d.id ORDER BY c.id_turno";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}*/


















		
		
		
		//FUNCION PARA LLENAR LISTA PLEGABLE EN AGENDAR CITA CONSULTORIOS
		public function listarTodosConsultorios(){
			try {
				
				$query="SELECT * from consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
			//FUNCION PARA LLENAR LISTA PLEGABLE EN AGENDAR CITA TURNOS
		public function listarTodosTurnos(){
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
		public function listarTodosDoctores(){
			try {
				
				$query="SELECT * from empleado where id_tipo_empleado=3";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		//FUNCION PARA REGISTRAR CLIENTE EN BD

		public function registrar(cita_model $data){
			try {
				$query="INSERT into paciente (cedula,nombres,apellidos,fechaNacimiento,direccion,email,tlfn,status) values (?,?,?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre,$data->apellido,'1994-04-12','direccion','ejemplo@gmail.com',$data->telefono,'1'));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// FUNCION PARA VERIFICAR QUE SI NO EXISTA LA CEDULA EN BD HACER REGISTRO DEL CLIENTE
		public function cargarCedula($cedula){
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
		public function cargarIdPaciente($cedula){
			try {
				$query="SELECT id FROM paciente WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		public function contadorCitas($fecha,$turno,$consultorio){
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

		public function registrarCita(cita_model $data){
			try {
				$query="INSERT into cita (id_paciente,id_consultorio,id_turno,id_doctor,fecha) values (?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_paciente,$data->id_consultorio,$data->id_turno,$data->id_doctor,$data->fechaCita));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		public function get_paciente(){
			try {
				$query="SELECT * from paciente";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		public function insertar($placa, $marca, $modelo, $anio, $color){
			
			$resultado = $this->db->query("INSERT INTO vehiculos (placa, marca, modelo, anio, color) VALUES ('$placa', '$marca', '$modelo', '$anio', '$color')");
			
		}
		
		public function modificar($id, $placa, $marca, $modelo, $anio, $color){
			
			$resultado = $this->db->query("UPDATE vehiculos SET placa='$placa', marca='$marca', modelo='$modelo', anio='$anio', color='$color' WHERE id = '$id'");			
		}
		
		public function eliminar($id){
			
			$resultado = $this->db->query("DELETE FROM vehiculos WHERE id = '$id'");
			
		}
		
		public function get_vehiculo($id)
		{
			$sql = "SELECT * FROM vehiculos WHERE id='$id' LIMIT 1";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();

			return $row;
		}
	} 
?>