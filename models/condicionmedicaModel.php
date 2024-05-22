<?php
include_once "conexion.php";
class condicionmedica_model extends conexion_database {

    public $descripcion;
    public $id;
    public $status;
    public $observacion;
    public $consulta;
    public $consulta1;

	public function Consultar($metodo, $param1="", $param2="", $param3="", $param4=""){
		if($metodo=="verificarCondicionMedica"  && !empty($param1)){ return self::verificarCondicionMedica($param1); }
		if($metodo=="verificarCondicionMedicaId"  && ($param1)){ return self::verificarCondicionMedicaId($param1); }
		if($metodo=="verificarCondicionMedicaNombre"  && ($param1)){ return self::verificarCondicionMedicaNombre($param1); }
		if($metodo=="listarCondicionMedica"){ return self::listarCondicionMedica(); }
		if($metodo=="listarCondicionMedicaAsig"){ return self::listarCondicionMedicaAsig(); }
		if($metodo=="cargarCondicionMedica" && !empty($param1)){ return self::cargarCondicionMedica($param1); }
		if($metodo=="buscarRegistroCondicionMedica" && !empty($param1)){ return self::buscarRegistroCondicionMedica($param1); }
		if($metodo=="listarStatus"){ return self::listarStatus(); }
		if($metodo=="listarPlanificacion"){ return self::listarPlanificacion(); }
	}
	public function Registrar($metodo, $param1=[]){
		if($metodo=="registrarCondicionMedica" && !empty($param1)){ return self::registrarCondicionMedica($param1); }
	}
	public function Modificar($metodo, $param1=[]){
		if($metodo=="modificarCondicionMedica" && !empty($param1)){ return self::modificarCondicionMedica($param1); }
	}
	public function Eliminar($metodo, $param1=""){
		if($metodo=="inhabilitarCondicionMedica" && $param1!=""){ return self::inhabilitarCondicionMedica($param1); }
		if($metodo=="habilitarCondicionMedica" && $param1!=""){ return self::habilitarCondicionMedica($param1); }
		if($metodo=="eliminarCondicionMedica" && $param1!=""){ return self::eliminarCondicionMedica($param1); }
	}

    // CONSULTAR REGISTRO DE TIPO EMPLEADO
	private function verificarCondicionMedica($descripcion){
		try {
			$query="SELECT * FROM condicion_medica WHERE descripcion=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($descripcion));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	private function verificarCondicionMedicaId($id){
		try {
			$query="SELECT * FROM condicion_medica WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	private function verificarCondicionMedicaNombre($descripcion){
		try {
			$query="SELECT * FROM condicion_medica WHERE descripcion=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($descripcion));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

		// CARGAR REGISTRO DE CONDICION MEDICA
	private function buscarRegistroCondicionMedica($consultaBusqueda){
		try {
			$query="SELECT * FROM condicion_medica WHERE descripcion=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($consultaBusqueda));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    //RESGISTRAR CONDICIÓN MÉDICA EN BD
	private function registrarCondicionMedica(condicionmedica_model $data){
		try {
			$query="INSERT into condicion_medica (descripcion, observacion, status) values (?,?,?)";
			$this->CNX->prepare($query)->execute(array($data->descripcion, $data->observacion, '1'));
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//FUNCION PARA LLENAR TABLA TIPO EMPLEADOS
	private function listarCondicionMedicax(){
		try {
			
			$query="SELECT * from condicion_medica";
			$smt = $this->CNX->prepare($query);
			$smt->execute();
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	private function listarCondicionMedica(){
			try {
				
				$query="SELECT t.id,t.descripcion,t.observacion,s.status as estado from condicion_medica as t inner join status as s where t.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	

	private function listarCondicionMedicaAsig(){
		try {
			
			$query="SELECT * from condicion_medica where status=1";
			$smt = $this->CNX->prepare($query);
			$smt->execute();
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//ELIMINACION LOGICA DE TIPO EMPLEADO DE LA BD
	private function inhabilitarCondicionMedica($id){
		try {

			$query="UPDATE condicion_medica set status='0' WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			// return $smt->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	private function habilitarCondicionMedica($id){
		try {

			$query="UPDATE condicion_medica set status='1' WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			// return $smt->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	private function eliminarCondicionMedica($id){
		try {

			$query="DELETE FROM condicion_medica WHERE id=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($id));
			// return $smt->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	//ACTUALIZAR TIPO EMPLEADO EN BD
	private function modificarCondicionMedica(condicionmedica_model $data){
		try {
			$query="UPDATE condicion_medica set descripcion=?,observacion=? where id=?";
			$this->CNX->prepare($query)->execute(array($data->descripcion,$data->observacion,$data->id));
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	// CARGAR REGISTRO DE CONSULTORIOS
	private function cargarCondicionMedica($id){
		try {
			$query="SELECT * FROM condicion_medica WHERE id=?";
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