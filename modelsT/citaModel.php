<?php
	// include_once "conexion.php";
	require_once('./config/database.php');
	class cita_model extends conexion {
		
		// private $db;
		// private $cita;
		// public $mode;
		// public $alm;
		//public $pdf;
		public $CNX;
		public $pdf;
		public $cedula;
		public $nombre;
		public $apellido;
		public $correo;
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
		public $contador;
		public $id_paciente;
		public $id_consultorio;
		public $id_turno;
		public $fechaCita;
		public $id_doctor;
		public $mesRegistro;
		public $verificarExistenciaCita;
		public $idPlanificacion;
		public $sexo;

		public function __construct(array $data){
			foreach ($data as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
			try {
				$this->CNX = parent::conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Consultar($metodo, $param1="", $param2="", $param3="", $param4=""){
			if($metodo=="listarTodosConsultorios"){ return self::listarTodosConsultorios(); }
			if($metodo=="listarTodosTurnos"){ return self::listarTodosTurnos(); }
			if($metodo=="listarTodosDoctores"){ return self::listarTodosDoctores(); }
			if($metodo=="listarCitas"){ return self::listarCitas($param1); }
			if($metodo=="listarCitasParaHoy"){ return self::listarCitasParaHoy($param1); }

			if($metodo=="cargarCita" && $param1!=""){ return self::cargarCita($param1); }
			if($metodo=="cargarInformacionCita" && $param1!=""){ return self::cargarInformacionCita($param1); }
			if($metodo=="pdfCita" && $param1!=""){ return self::pdfCita($param1); }
			if($metodo=="cargarCedula" && $param1!=""){ return self::cargarCedula($param1); }
			if($metodo=="cargarIdPaciente" && $param1!=""){ return self::cargarIdPaciente($param1); }
			if($metodo=="consultarOdontologo" && $param1!=""){ return self::consultarOdontologo($param1); }
			if($metodo=="buscarRegistroPaciente" && $param1!=""){ return self::buscarRegistroPaciente($param1); }
			if($metodo=="buscarRegistroCita" && $param1!=""){ return self::buscarRegistroCita($param1); }

			if($metodo=="consultarOdontologos" && $param1!="" && $param2!=""){  return self::consultarOdontologos($param1, $param2);  }

			if($metodo=="contadorCitas" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::contadorCitas($param1, $param2, $param3); 
			}
			if($metodo=="verificarIdPlanificacion" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::verificarIdPlanificacion($param1, $param2, $param3); 
			}
			if($metodo=="consultarOdontologos1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::consultarOdontologos1($param1, $param2, $param3); 
			}
			if($metodo=="verificarExistenciaCita" && $param1!="" && $param2!=""){ 
				return self::verificarExistenciaCita($param1, $param2); 
			}
			if($metodo=="verificarDiaSemana" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::verificarDiaSemana($param1, $param2, $param3, $param4); 
			}
		}
		public function Registrarx($metodo, $param1="", $param2="", $param3="", $param4=""){
			// var_dump('Yeshua');
			if($metodo=="registrarCita"  && $param1!=""){ return self::registrarCita($param1); }
		}

		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarC" && !empty($param1)){ return self::registrarC($param1); }
			// if($metodo=="registrarPrueba" && !empty($param1)){ return self::registrarPrueba($param1); }
			// if($metodo=="registrarCitass" && !empty($param1)){ return self::registrarCitass($param1); }
			// if($metodo=="registrarCita"  && !empty($param1)){ return self::registrarCita($param1); }
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
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarInformacionCita($id){
			try {
				$query="SELECT c.id,c.fecha,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,l.id_consultorio as consultorio, l.id_turno as turno, l.id_empleado as odontologo FROM cita as c inner JOIN planificacion as l INNER join paciente as p WHERE c.id_planificacion=l.id and c.id_paciente=p.id and c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function cargarInformacionCitassssssssss($id){
			try {
				$query="SELECT c.id,c.fecha,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,c.id_consultorio as consultorio, c.id_turno as turno, c.id_empleado as odontologo FROM cita as c inner join paciente as p inner join turno as t inner join consultorio as co WHERE c.id_turno=t.id and c.id_paciente=p.id and c.id_consultorio=co.id and c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function pdfCita($id){
			try {
				// $query="SELECT c.id,c.fecha,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,co.descripcion as consultorio, t.descripcion as turno, e.nombres as nombreO, e.apellidos as apellidosO FROM cita as c inner join paciente as p inner join turno as t inner join consultorio as co INNER join empleado as e WHERE c.id_turno=t.id and c.id_paciente=p.id and c.id_consultorio=co.id and c.id_empleado=e.id and c.id=?";
				$query="SELECT c.id,c.fecha,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,co.descripcion as consultorio, t.descripcion as turno, e.nombres as nombreO, e.apellidos as apellidosO FROM cita as c inner join paciente as p inner join turno as t inner join consultorio as co INNER join empleado as e WHERE c.id_paciente=p.id and c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function modificarCita(cita_model $data){
			try {
				$query="UPDATE cita set fecha=?,id_paciente=?,id_mes=?,id_planificacion=? where id=?";
				$result = $this->CNX->prepare($query)->execute(array($data->fechaCita,$data->id_paciente,$data->mesRegistro,$data->idPlanificacion,$data->id));
				return $result;
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
				$query="INSERT into paciente (cedula,nombres,apellidos,fechaNacimiento,direccion,email,tlfno,sexo,status) values (?,?,?,?,?,?,?,?,?)";
				$result = $this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre,$data->apellido,'1994-04-12','direccion',$data->correo,$data->telefono,$data->sexo,'1'));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				return $result;
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
		
		private function contadorCitasOld($fecha,$turno,$consultorio){
			try {
				$query="SELECT COUNT(id) as contador FROM cita WHERE fecha=? and id_turno=? and id_consultorio=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($fecha,$turno,$consultorio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function contadorCitas($fecha,$turno,$consultorio){
			try {
				$query="SELECT COUNT(c.id) as contador FROM cita as c inner join planificacion as p WHERE c.fecha=? and p.id_turno=? and p.id_consultorio=? and c.id_planificacion=p.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($fecha,$turno,$consultorio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function verificarIdPlanificacion($consultorio,$turno,$cargarOdontologos){
			try {
				$query="SELECT id as idPlanificacion FROM planificacion WHERE id_consultorio=? and id_turno=? and id_empleado=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$cargarOdontologos));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		//FUNCION PARA REGISTRAR CITA

		private function registrarCita1(cita_model $data){
			try {
				$query="INSERT into cita (fecha,id_paciente,id_mes,id_consultorio,id_turno,id_empleado) values (?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->fechaCita,$data->id_paciente,$data->mesRegistro,$data->id_consultorio,$data->id_turno,$data->id_doctor));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function registrarPrueba(cita_model $data){
			try {
				$query="INSERT into prueba (fecha) values (?)";
				$this->CNX->prepare($query)->execute(array($data->fechaCita));
				
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function registrarCitaOld($fecha,$id_paciente,$mesRegistro,$consultorio,$turno,$cargarOdontologos){
			try {
				$query="INSERT into cita (fecha,id_paciente,id_mes,id_consultorio,id_turno,id_empleado) values (?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($fecha,$id_paciente,$mesRegistro,$consultorio,$turno,$cargarOdontologos));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function registrarCitaoldd($fecha,$mesRegistro,$id_paciente,$idPlanificacion){
			try {
				$query="INSERT into cita (fecha,id_mes,id_paciente,id_planificacion) values (?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($fecha,$mesRegistro,$id_paciente,$idPlanificacion));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function registrarCita(cita_model $data){
			try {
				$query="INSERT into cita (fecha,id_mes,id_paciente,id_planificacion) values (?,?,?,?)";
				$result = $this->CNX->prepare($query)->execute(array($data->fechaCita,$data->mesRegistro,$data->id_paciente,$data->idPlanificacion));
				//$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre.' '.$data->apellido,$data->direccion,$data->correo,$data->telefono,$data->status));
				return $result;
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
				$query="SELECT DISTINCT e.id, e.nombres, e.apellidos, d.nombre as dia from planificacion as p INNER JOIN empleado as e INNER JOIN dia_semana as d where p.id_dia_semana=d.id and p.id_empleado=e.id and p.id_consultorio=? and p.id_turno=? and p.id_empleado=? and p.status='1' order by d.id";
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

		private function verificarExistenciaCitaOld($fecha,$resultadoBusquedaPaciente){
			try {
				$query="SELECT c.id as verificarExistenciaCita FROM cita as c WHERE c.fecha=? and c.id_paciente=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($fecha,$resultadoBusquedaPaciente));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function verificarExistenciaCita($fecha,$resultadoBusquedaPaciente){
			try {
				$query="SELECT c.id as verificarExistenciaCita FROM cita as c WHERE c.fecha=? and c.id_paciente=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($fecha,$resultadoBusquedaPaciente));
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
				$result = $smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// CARGAR REGISTRO DE CITAS
		private function buscarRegistroCita($consultaBusqueda){
			try {
				// $query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id and p.cedula=?";
				$query="SELECT c.id,x.descripcion as consultorio, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) and c.id_paciente=p.id AND p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarCitasx($id_consultorio){
			try {
				$fecha = date('Y-m-d');
				
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
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
		private function listarCitasss($id_consultorio){
			try {
				$fecha = date('Y-m-d');
				// $query="SELECT c.id,x.descripcion as consultorio, p.cedula, concat (p.nombres,' ',p.apellidos) as paciente,p.tlfno,p.email,t.descripcion AS turno, concat(e.nombres,' ',e.apellidos) as doctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
				// FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x 
				$query="SELECT c.id, co.descripcion as consultorio, p.cedula, concat (p.nombres,' ',p.apellidos) as paciente,p.tlfno,p.email,t.descripcion AS turno, concat(e.nombres,' ',e.apellidos) as doctor,c.fecha FROM paciente as p, cita as c, planificacion as pl, empleado as e, turno as t, consultorio as co WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) and p.id=c.id_paciente and c.id_planificacion=pl.id and pl.id_turno=t.id and pl.id_empleado=e.id and pl.id_consultorio=co.id";
				$smt = $this->CNX->prepare($query);
				if($id_consultorio!=""){
					$query .= " and pl.id=".$id_consultorio;
				}
				$query .= " ORDER BY c.fecha desc, pl.id_consultorio";
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarCitas($id_consultorio){
			try {
				$fecha = date('Y-m-d');
				$query="SELECT c.id,x.descripcion as consultorio, p.cedula, concat (p.nombres,' ',p.apellidos) as paciente,p.tlfno,p.email,t.descripcion AS turno, concat(e.nombres,' ',e.apellidos) as doctor,c.fecha FROM cita as c inner join planificacion as l INNER join paciente as p INNER join turno as t INNER JOIN consultorio as x INNER join empleado as e WHERE c.id_planificacion=l.id and c.id_paciente=p.id and l.id_consultorio=x.id and l.id_turno=t.id and l.id_empleado=e.id";
				$smt = $this->CNX->prepare($query);
				if($id_consultorio!=""){
					$query .= " and c.id = ".$id_consultorio;
				}
				$query .= " ORDER BY c.fecha desc,c.id_consultorio";
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				// print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
				return $data;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarCitasssssssss($id_consultorio){
			try {
				$fecha = date('Y-m-d');
				$query="SELECT c.id,x.descripcion as consultorio, p.cedula, concat (p.nombres,' ',p.apellidos) as paciente,p.tlfno,p.email,t.descripcion AS turno, concat(e.nombres,' ',e.apellidos) as doctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
				$smt = $this->CNX->prepare($query);
				if($id_consultorio!=""){
					$query .= " and c.id = ".$id_consultorio;
				}
				$query .= " ORDER BY c.fecha desc,c.id_consultorio";
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarCitas1($id_consultorio){
			try {
				$fecha = date('Y-m-d');
				
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM paciente as p, cita as c, planificacion as pl, empleado as e, turno as t, consultorio as co WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha) = MONTH(CURRENT_DATE()) and p.id=c.id_paciente and c.id_planificacion=pl.id and pl.id_turno=t.id and pl.id_empleado=e.id and pl.id_consultorio=co.id";
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

		private function listarCitasParaHoy1($id_consultorio){
			try {
				//$fecha = date('Y-m-d');
				date_default_timezone_set("America/Caracas");
				$fecha = date('Y-m-d');
			
				// $query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM planificacion AS pl INNER JOIN cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.fecha='$fecha' and c.id_consultorio= x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
				$query="SELECT * FROM paciente as p, cita as c, planificacion as pl, empleado as e, turno as t, consultorio as co WHERE c.fecha='{$fecha}' and p.id=c.id_paciente and c.id_planificacion=pl.id and pl.id_turno=t.id and pl.id_empleado=e.id and pl.id_consultorio=co.id";
				if($id_consultorio!=""){
					$query .= " and co.id=".$id_consultorio;
				}
				$query .= " ORDER BY c.fecha desc, pl.id_consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		private function listarCitasParaHoy2($id_consultorio){
			try {
				date_default_timezone_set("America/Caracas");
				$fecha = date('Y-m-d');
				// $query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, concat (p.nombres,' ',p.apellidos) as paciente ,p.tlfno,p.email,t.descripcion AS turno,concat(e.nombres,' ' ,e.apellidos) as doctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.fecha='$fecha' and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id";
				/*$query="SELECT c.id, co.descripcion as consultorio, pl.id_consultorio, p.cedula, concat (p.nombres,' ',p.apellidos) as paciente, p.tlfno,p.email, t.descripcion AS turno,concat(e.nombres,' ' ,e.apellidos) as doctor, c.fecha FROM paciente as p, cita as c, planificacion as pl, empleado as e, turno as t, consultorio as co WHERE c.fecha='{$fecha}' and p.id=c.id_paciente and c.id_planificacion=pl.id and pl.id_turno=t.id and pl.id_empleado=e.id and pl.id_consultorio=co.id";*/
				$query="SELECT c.id, co.descripcion as consultorio, pl.id_consultorio, p.cedula, concat (p.nombres,' ',p.apellidos) as paciente, p.tlfno,p.email, t.descripcion AS turno,concat(e.nombres,' ' ,e.apellidos) as doctor, c.fecha FROM paciente as p, cita as c, planificacion as pl, empleado as e, turno as t, consultorio as co WHERE c.fecha='2023-12-03' and p.id=c.id_paciente and c.id_planificacion=pl.id and pl.id_turno=t.id and pl.id_empleado=e.id and pl.id_consultorio=co.id";
				if($id_consultorio!=""){
					$query .= " and co.id = ".$id_consultorio;
				}
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarCitasParaHoy($id_consultorio){
			try {
				date_default_timezone_set("America/Caracas");
				$fecha = date('Y-m-d');
				$query="SELECT c.id,x.descripcion as consultorio,t.descripcion AS turno,p.cedula, concat (p.nombres,' ',p.apellidos) as paciente ,p.tlfno,p.email,concat(e.nombres,' ' ,e.apellidos) as doctor FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x inner join planificacion as pl WHERE c.fecha='{$fecha}' and c.id_planificacion=pl.id and pl.id_consultorio=x.id and pl.id_turno=t.id and pl.id_empleado=e.id and c.id_paciente=p.id";
				if($id_consultorio!=""){
					$query .= " and x.id = ".$id_consultorio;
				}
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				// print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
				return $data;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		/*private function listarCitas(){
			try {
				$fecha = date('Y-m-d');
				
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha) = MONTH(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.id_consultorio,c.fecha desc";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarCitasParaHoy(){
			try {
				//$fecha = date('Y-m-d');
				date_default_timezone_set("America/Caracas");
				$fecha = date('Y-m-d');
			
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio,p.cedula, p.nombres,p.apellidos,p.tlfno,p.email,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.fecha='$fecha' and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}*/

		
	} 
?>