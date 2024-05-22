<?php
include_once "conexion.php";
class insumo_model extends conexion_database {

    //public $CNX;
    public $id;
	public $nombre;
    public $descripcion;
    public $stock;
    public $insumo;
    public $consulta;
    public $consulta1;
	public $status;

 		//ENCAPSULAMIENTO DE FUNCIONES PRIVADAS ACCEDIDAS UNICAMENTE POR FUNCIONES PUBLICAS 
		public function Consultar($metodo, $param1=""){

			if($metodo=="listarInsumos"){ return self::listarInsumos(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }


			if($metodo=="cargarInsumo" && $param1!=""){ return self::cargarInsumo($param1); }
			if($metodo=="verificarInsumo" && $param1!=""){ return self::verificarInsumo($param1); }
			if($metodo=="buscarRegistroInsumo" && $param1!=""){ return self::buscarRegistroInsumo($param1); }
			if($metodo=="verificarInsumoId" && $param1!=""){ return self::verificarInsumoId($param1); }
			if($metodo=="verificarInsumoNombre" && $param1!=""){ return self::verificarInsumoNombre($param1); }
			if($metodo=="buscarRegistroInsumo" && $param1!=""){ return self::buscarRegistroInsumo($param1); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarInsumo" && !empty($param1)){ return self::registrarInsumo($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarInsumo" && !empty($param1)){ return self::modificarInsumo($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="inhabilitarInsumo" && $param1!=""){ return self::inhabilitarInsumo($param1); }
			if($metodo=="habilitarInsumo" && $param1!=""){ return self::habilitarInsumo($param1); }
			if($metodo=="eliminarInsumo" && $param1!=""){ return self::eliminarInsumo($param1); }
		}

    // CONSULTAR REGISTRO DE TIPO EMPLEADO
	private function verificarInsumo($nombre){
		try {
			$query="SELECT * FROM insumo WHERE nombre=?";
			$smt = $this->CNX->prepare($query);
			$smt->execute(array($nombre));
			return $smt->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

		// BUSCAR EN BD SEGUN INPUT BUSQUEDA
		private function buscarRegistroInsumo($consultaBusqueda){
			try {
				$query="SELECT * FROM insumo WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

    //RESGISTRAR INSUMO EN BD
		private function registrarInsumo(insumo_model $data){
			try {
				$query="INSERT into insumo (nombre,descripcion,stock,status) values (?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->nombre,$data->descripcion,$data->cantidad, '1'));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//FUNCION PARA LLENAR TABLA INSUMOS
		private function listarInsumosx(){
			try {
				
				$query="SELECT * from insumo";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarInsumos(){
			try {
				//$arreglo;
				$query="SELECT i.id, i.nombre,i.descripcion,i.stock,s.status as estado from insumo as i INNER JOIN status as s where i.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//ELIMINACION LOGICA DE INSUMO DE LA BD
		private function inhabilitarInsumo($id){
			try {

				$query="UPDATE insumo set status=0 WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$return = $smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
				return $return;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarInsumo($id){
			try {

				$query="UPDATE insumo set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$return = $smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
				return $return;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarInsumo($id){
			try {

				$query="DELETE FROM insumo WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$return = $smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);
				return $return;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//MODIFICAR INSUMO EN BD
		private function modificarInsumo(insumo_model $data){
			try {
				$query="UPDATE insumo set nombre=?,descripcion=?,stock=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->nombre,$data->descripcion,$data->stock,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// CARGAR REGISTRO DE CONSULTORIOS
		private function cargarInsumo($id){
			try {
				$query="SELECT * FROM insumo WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// VERIFICAR SI NOMBRE ESTA DISPONIBLE
		private function verificarInsumoId($id){
			try {
				$query="SELECT * FROM insumo WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function verificarInsumoNombre($nombre){
			try {
				$query="SELECT * FROM insumo WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($nombre));
				return $smt->fetchAll(PDO::FETCH_OBJ);
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