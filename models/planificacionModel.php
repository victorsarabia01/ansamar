<?php
	include_once "conexion.php";
	class planificacion_model extends conexion_database {
		
		//public $CNX;
		public $consulta;
		public $consulta1;
		public $consultaL1;
		public $consultaL2;
		public $consultaM1;
		public $consultaM2;
		public $consultaX1;
		public $consultaX2;
		public $consultaJ1;
		public $consultaJ2;
		public $consultaV1;
		public $consultaV2;
		public $consultaS1;
		public $consultaS2;
		public $status;
		public $sillas;
		public $diaLunes;
		public $diaMartes;
		public $diaMiercoles;
		public $diaJueves;
		public $diaViernes;
		public $diaSabado;
		public $planificacion;
		public $id;
		public $nombreOdontologo;
		public $apellidoOdontologo;
		public $consultorio;
		public $dia;
		public $turno;
		public $id_consultorio;
		public $id_turno;
		public $id_empleado;
		public $id_dia_semana;

		
		public function Consultar($metodo, $param1="", $param2="", $param3="", $param4=""){
			if($metodo=="listarTodosConsultorios"){ return self::listarTodosConsultorios(); }
			if($metodo=="listarTodosTurnos"){ return self::listarTodosTurnos(); }
			if($metodo=="listarDiaSemana"){ return self::listarDiaSemana(); }
			if($metodo=="listarTodosDoctores"){ return self::listarTodosDoctores(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			if($metodo=="listarPlanificacion"){ return self::listarPlanificacion(); }


			if($metodo=="consultarSillas" && $param1!=""){ return self::consultarSillas($param1); }
			if($metodo=="cargarPlanificacionAEditar" && $param1!=""){ return self::cargarPlanificacionAEditar($param1); }
			if($metodo=="buscarRegistroPlanificacion" && $param1!=""){ return self::buscarRegistroPlanificacion($param1); }


			if($metodo=="cargarPlanificacion1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacion1($param1, $param2, $param3); 
			}
			if($metodo=="consultarCantPlanificacion" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::consultarCantPlanificacion($param1, $param2, $param3); 
			}
			if($metodo=="cargarPlanificacionLunes1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacionLunes1($param1, $param2, $param3); 
			}
			if($metodo=="cargarPlanificacionMartes1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacionMartes1($param1, $param2, $param3); 
			}
			if($metodo=="cargarPlanificacionMiercoles1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacionMiercoles1($param1, $param2, $param3); 
			}
			if($metodo=="cargarPlanificacionJueves1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacionJueves1($param1, $param2, $param3); 
			}
			if($metodo=="cargarPlanificacionViernes1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacionViernes1($param1, $param2, $param3); 
			}
			if($metodo=="cargarPlanificacionSabado1" && $param1!="" && $param2!="" && $param3!=""){ 
				return self::cargarPlanificacionSabado1($param1, $param2, $param3); 
			}


			if($metodo=="cargarPlanificacion" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacion($param1, $param2, $param3, $param4); 
			}
			if($metodo=="cargarPlanificacionLunes" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacionLunes($param1, $param2, $param3, $param4); 
			}
			if($metodo=="cargarPlanificacionMartes" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacionMartes($param1, $param2, $param3, $param4); 
			}
			if($metodo=="cargarPlanificacionMiercoles" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacionMiercoles($param1, $param2, $param3, $param4); 
			}
			if($metodo=="cargarPlanificacionJueves" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacionJueves($param1, $param2, $param3, $param4); 
			}
			if($metodo=="cargarPlanificacionViernes" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacionViernes($param1, $param2, $param3, $param4); 
			}
			if($metodo=="cargarPlanificacionSabado" && $param1!="" && $param2!="" && $param3!="" && $param4!=""){ 
				return self::cargarPlanificacionSabado($param1, $param2, $param3, $param4); 
			}
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarPlanificacion" && !empty($param1)){ return self::registrarPlanificacion($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarPlanificacion" && !empty($param1)){ return self::modificarPlanificacion($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="deletePlanificacion" && $param1!=""){ return self::deletePlanificacion($param1); }
			if($metodo=="habilitarPlanificacion" && $param1!=""){ return self::habilitarPlanificacion($param1); }
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
		private function modificarPlanificacion(planificacion_model $data){
			try {
				$query="UPDATE planificacion set id_consultorio=?,id_turno=?,id_empleado=?,id_dia_semana=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->id_consultorio,$data->turno,$data->id_doctor,$data->diaSemana,$data->id));
				
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
		private function listarDiaSemana(){
			try {
				
				$query="SELECT * from dia_semana";
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
				
				$query="SELECT e.id as id_empleado, e.nombres,e.apellidos from empleado as e inner join tipo_empleado as t where e.id_tipo_empleado=t.id and t.descripcion='odontologo' and e.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function consultarSillas($consultorio){
			try {
				
				$query="SELECT sillas from consultorio where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function cargarPlanificacion($consultorio,$turno,$doctor,$diaSemana){
			try {
				
				$query="SELECT * from planificacion as p where p.id_consultorio=? and p.id_turno=? and p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarPlanificacion1($turno,$doctor,$diaSemana){
			try {
				
				$query="SELECT * from planificacion as p where p.id_turno=? and p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function consultarCantPlanificacion($consultorio,$turno,$diaSemana){
			try {
				
				$query="SELECT count(p.id) as cantPlanificacion from consultorio as c INNER JOIN planificacion as p where p.id_consultorio=c.id and p.id_consultorio=? and p.id_turno=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarPlanificacionAEditar($id){
			try {
				$query="SELECT * from planificacion where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		

		//FUNCION PARA REGISTRAR PLANIFICACION
		private function registrarPlanificacion(planificacion_model $data){
			try {
				$query="INSERT into planificacion (id_consultorio,id_turno,id_empleado,id_dia_semana,status) values (?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_consultorio,$data->turno,$data->id_doctor,$data->diaSemana,'1'));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionLunes($consultorio,$turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaL1 FROM planificacion AS p WHERE p.id_consultorio=? AND p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionLunes1($turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaL2 FROM planificacion AS p WHERE p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionMartes($consultorio,$turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaM1 FROM planificacion AS p WHERE p.id_consultorio=? AND p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionMartes1($turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaM2 FROM planificacion AS p WHERE p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionMiercoles($consultorio,$turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaX1 FROM planificacion AS p WHERE p.id_consultorio=? AND p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionMiercoles1($turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaX2 FROM planificacion AS p WHERE p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarPlanificacionJueves($consultorio,$turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaJ1 FROM planificacion AS p WHERE p.id_consultorio=? AND p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionJueves1($turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaJ2 FROM planificacion AS p WHERE p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarPlanificacionViernes($consultorio,$turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaV1 FROM planificacion AS p WHERE p.id_consultorio=? AND p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionViernes1($turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaV2 FROM planificacion AS p WHERE p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarPlanificacionSabado($consultorio,$turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaS1 FROM planificacion AS p WHERE p.id_consultorio=? AND p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio,$turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA PLANIFICACION CON LOS DATOS SELECCIONADOS
		private function cargarPlanificacionSabado1($turno,$doctor,$diaSemana){
			try {
				$query="SELECT p.id_consultorio as consultaS2 FROM planificacion AS p WHERE p.id_turno=? AND p.id_empleado=? and p.id_dia_semana=? and p.status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($turno,$doctor,$diaSemana));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarPlanificacion(){
			try {
				//$arreglo;
				$query="SELECT p.id,c.descripcion as consultorio,s.nombre as dia_semana,t.descripcion as turno, CONCAT(d.nombres,' ',d.apellidos) as doctor FROM planificacion AS p INNER JOIN consultorio AS c INNER JOIN empleado AS d INNER join dia_semana as s inner join turno as t WHERE p.id_consultorio=c.id AND p.id_empleado=d.id and p.status=1 and p.id_turno=t.id and p.id_dia_semana=s.id ORDER BY d.id,s.id,t.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
		private function listarPlanificacion1(){
			try {
		
				$query="SELECT p.id,c.descripcion as consultorio,s.nombre as dia_semana,t.descripcion as turno,d.nombres,d.apellidos,p.status FROM planificacion AS p INNER JOIN consultorio AS c INNER JOIN empleado AS d INNER join dia_semana as s inner join turno as t WHERE p.id_consultorio=c.id AND p.id_empleado=d.id and p.status=1 and p.id_turno=t.id and p.id_dia_semana=s.id ORDER BY d.id,s.id,t.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//ELIMINAR PLANIFICACION DE LA BD
		public function deletePlanificacion($id){
			try {

				$query="DELETE from planificacion WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		public function deletePlanificacionx($id){
			try {

				$query="UPDATE planificacion set status=0 WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//HABILITAR PLANIFICACION DE LA BD
		public function habilitarPlanificacion($id){
			try {

				$query="UPDATE planificacion set status=1 WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroPlanificacion($consultaBusqueda){
			try {
				$query="SELECT p.id,c.descripcion as consultorio,s.nombre as dia_semana,t.descripcion as turno,d.nombres,d.apellidos,p.status FROM planificacion AS p INNER JOIN consultorio AS c INNER JOIN empleado AS d INNER join dia_semana as s inner join turno as t WHERE p.id_consultorio=c.id AND p.id_empleado=d.id and p.status=1 and p.id_turno=t.id and p.id_dia_semana=s.id and c.descripcion=? ORDER BY d.id,s.id,t.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
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
		
	
	} 
?>