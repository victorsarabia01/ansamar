<?php
include_once "conexion.php";
class proveedor_model extends conexion_database {

    //public $CNX;
    public $id;
	public $nombre;
    public $descripcion;
    public $direccion;
    public $email;
    public $stock;
    public $insumo;
    public $consulta;
    public $consulta1;
	public $status;
	public $tlfno;

 		//ENCAPSULAMIENTO DE FUNCIONES PRIVADAS ACCEDIDAS UNICAMENTE POR FUNCIONES PUBLICAS 
		public function Consultar($metodo, $param1=""){

			if($metodo=="listarProveedores"){ return self::listarProveedores(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }

			if($metodo=="cargarProveedor" && $param1!=""){ return self::cargarProveedor($param1); }
			if($metodo=="verificarProveedor" && $param1!=""){ return self::verificarProveedor($param1); }
			if($metodo=="buscarRegistroProveedor" && $param1!=""){ return self::buscarRegistroProveedor($param1); }
			
			if($metodo=="buscarRegistroInsumo" && $param1!=""){ return self::buscarRegistroInsumo($param1); }


			if($metodo=="verificarProveedorId" && $param1!=""){ return self::verificarProveedorId($param1); }
			if($metodo=="verificarProveedorNombre" && $param1!=""){ return self::verificarProveedorNombre($param1); }
			
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarProveedor" && !empty($param1)){ return self::registrarProveedor($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarProveedor" && !empty($param1)){ return self::modificarProveedor($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="inhabilitarProveedor" && $param1!=""){ return self::inhabilitarProveedor($param1); }
			if($metodo=="habilitarProveedor" && $param1!=""){ return self::habilitarProveedor($param1); }
			if($metodo=="eliminarProveedor" && $param1!=""){ return self::eliminarProveedor($param1); }
		}

		//FUNCION PARA LLENAR TABLA PROVEEDOR
		private function listarProveedoresx(){
			try {
				
				$query="SELECT * from proveedor";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarProveedores(){
			try {
				//$arreglo;
				$query="SELECT p.id, p.descripcion,p.direccion,p.tlfno,p.email,s.status as estado from proveedor as p INNER JOIN status as s where p.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function cargarProveedor($id){
			try {
				$query="SELECT * FROM proveedor WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		

		private function verificarProveedor($descripcion){
			try {
				$query="SELECT * FROM proveedor WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($descripcion));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function registrarProveedor(proveedor_model $data){
				try {
					$query="INSERT into proveedor (descripcion,direccion,tlfno,email,status) values (?,?,?,?,?)";
					$this->CNX->prepare($query)->execute(array($data->descripcion,$data->direccion,$data->telefono,$data->email,'1'));
					
				} catch (Exception $e) {
					die($e->getMessage());
				}
			}

		private function buscarRegistroProveedor($consultaBusqueda){
			try {
				$query="SELECT * FROM proveedor WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function inhabilitarProveedor($id){
			try {

				$query="UPDATE proveedor set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarProveedor($id){
			try {

				$query="UPDATE proveedor set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarProveedor($id){
			try {

				$query="DELETE FROM proveedor WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		//MODIFICAR INSUMO EN BD
		private function modificarProveedor(proveedor_model $data){
			try {
				$query="UPDATE proveedor set descripcion=?,direccion=?,tlfno=?,email=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->descripcion,$data->direccion,$data->telefono,$data->email,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// CARGAR REGISTRO DE CONSULTORIOS
		

		// VERIFICAR SI NOMBRE ESTA DISPONIBLE
		private function verificarProveedorId($id){
			try {
				$query="SELECT * FROM proveedor WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function verificarProveedorNombre($nombre){
			try {
				$query="SELECT * FROM proveedor WHERE descripcion=?";
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