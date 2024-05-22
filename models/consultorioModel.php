<?php
	include_once "conexion.php";
	class consultorio_model extends conexion_database {
		
		//public $CNX;
		public $consulta;
		public $consulta1;
		public $descripcion;
		public $direccion;
		public $tlfno;
		public $resultados;
		public $telefono;
		public $sillas;
		public $status;
		public $estado;
		public $id;
		public $Codtelefono;
		public $Codtelefono1;
		public $telefonoComp;
		public $codtlfn;
	

		// ENCAPSULAMIENTO DE FUNCIONES PRIVADAS ACCEDIDAS UNICAMENTE POR FUNCIONES PUBLICAS 
		public function Consultar($metodo, $param1=""){
			if($metodo=="listarConsultorios1"){ return self::listarConsultorios1(); }
			if($metodo=="listarConsultoriosx"){ return self::listarConsultoriosx(); }
			if($metodo=="listarConsultoriosAjax"){ return self::listarConsultoriosAjax(); }
			if($metodo=="listarConsultorios"){ return self::listarConsultorios(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }

			if($metodo=="verificarConsultorio" && $param1!=""){ return self::verificarConsultorio($param1); }
			if($metodo=="verificarConsultorioId" && $param1!=""){ return self::verificarConsultorioId($param1); }
			if($metodo=="verificarConsultorioNombre" && $param1!=""){ return self::verificarConsultorioNombre($param1); }
			if($metodo=="cargarConsultorio" && $param1!=""){ return self::cargarConsultorio($param1); }
			if($metodo=="buscarRegistroConsultorio" && $param1!=""){ return self::buscarRegistroConsultorio($param1); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarConsultorio" && !empty($param1)){ return self::registrarConsultorio($param1); }
		}
		public function Modificar($metodo, $param1=[]){
			if($metodo=="modificarConsultorio" && !empty($param1)){ return self::modificarConsultorio($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="eliminarConsultorio" && $param1!=""){ return self::eliminarConsultorio($param1); }
			if($metodo=="inhabilitarConsultorio" && $param1!=""){ return self::inhabilitarConsultorio($param1); }
			if($metodo=="habilitarConsultorio" && $param1!=""){ return self::habilitarConsultorio($param1); }
		}
	

		// CONSULTAR REGISTRO DE CONSULTORIOS
		private function verificarConsultorio($descripcion){
			try {
				$query="SELECT * FROM consultorio WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($descripcion));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// CONSULTAR REGISTRO DE CONSULTORIOS
		private function verificarConsultorioId($id){
			try {
				$query="SELECT * FROM consultorio WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function verificarConsultorioNombre($descripcion){
			try {
				$query="SELECT * FROM consultorio WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($descripcion));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// CARGAR REGISTRO DE CONSULTORIOS
		private function cargarConsultorio($id){
			try {
				$query="SELECT * FROM consultorio WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroConsultorio($consultaBusqueda){
			try {
				$query="SELECT * FROM consultorio WHERE descripcion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		//RESGISTRAR CONSULTORIO EN BD
		private function registrarConsultorio(consultorio_model $data){
			try {
				$query="INSERT into consultorio (descripcion,direccion,codtlfno,tlfno,sillas,status) values (?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->descripcion,$data->direccion,$data->codtlfn,$data->tlfno,$data->silla,'1'));
			
    			//echo json_encode ('1');
 
				
			} catch (Exception $e) {
				die($e->getMessage());
				 //echo json_encode ('0');
  
			}
		}

		//FUNCION PARA LLENAR TABLA CONSULTORIOS
		private function listarConsultorios1(){
			try {
				
				$query="SELECT c.id, c.descripcion,c.direccion,c.tlfno,s.status from consultorio as c inner join status as s where c.id_status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//FUNCION PARA LLENAR TABLA CONSULTORIOS
		private function listarConsultoriosAjax(){
			try {
				$query="SELECT descripcion,direccion,tlfno,sillas,status,id from consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
				// return $smt->fetchAll(PDO::FETCH_FUNC, fn($descripcion, $direccion,$tlfno,$sillas,$status,$id) => [$descripcion, $direccion,$tlfno,$sillas,$status,$id] );
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//FUNCION PARA LLENAR TABLA CONSULTORIOS
		private function listarConsultoriosx(){
			try {
				
				$query="SELECT * from consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarConsultorios(){
			try {
				//$arreglo;
				$query="SELECT c.id,c.descripcion,c.direccion,c.codtlfno,c.tlfno,c.sillas,s.status as estado from consultorio as c INNER JOIN status as s where c.status=s.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//FUNCION PARA COMPARAR STATUS EN LA VISTA EDITAR CONSULTORIO
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


		//ELIMINACION LOGICA DE CONSULTORIO DE LA BD
		private function inhabilitarConsultorio($id){
			try {

				$query="UPDATE consultorio set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarConsultorio($id){
			try {

				$query="UPDATE consultorio set status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarConsultorio($id){
			try {

				$query="DELETE from consultorio WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetchAll(PDO::FETCH_OBJ);

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		//ACTUALIZAR CONSULTORIO EN BD
		private function modificarConsultorio(consultorio_model $data){
			try {
				$query="UPDATE consultorio set descripcion=?,direccion=?,codtlfno=?,tlfno=?,sillas=? where id=?";
				$this->CNX->prepare($query)->execute(array($data->descripcion,$data->direccion,$data->codtlfn,$data->telefono,$data->silla,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function contarActores() {
            try {
                $st = $this->CNX->prepare("SELECT count(*) FROM consultorio");
                $st->execute();
                $actores = $st->fetchAll();
                return $actores['0']['0'];
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        public function actoresPagina($page) {
            try {
                $st = $this->CNX->prepare("SELECT *  FROM consultorio LIMIT " . (($page) * 18) . ", 18 ");
                $st->execute();
                $actores = $st->fetchAll();
                return $actores;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

		
		
	} 
?>