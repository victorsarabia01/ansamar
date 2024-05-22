<?php
	include_once "conexion.php";
	class usuario_model extends conexion_database {
		
		public $CNX;
		public $consulta;
		public $nombre;
		public $status;
		public $usuario;
		public $password;
		public $passwordd;
		public $id;
		public $consulta1;
		public $ulListado1;
		public $ulListado;
		public $condicion;
		public $condicion1;
		public $prueba;
		public $elementos_array;
		public $observacion;
		public $id_rol;
		public $nombre_rol;
		public $id_empleado;
		public $nombre_empleado;
		public $full_name;
		public $cedula;
		
		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="listarUsuario"){ return self::listarUsuario(); }
			if($metodo=="listarUsuarios"){ return self::listarUsuarios(); }
			if($metodo=="listarStatus"){ return self::listarStatus(); }
			// if($metodo=="listarCondicionMedica"){ return self::listarCondicionMedica(); }
			
			if($metodo=="cargarUsuario" && $param1!=""){ return self::cargarUsuario($param1); }
			if($metodo=="validarId" && $param1!=""){ return self::validarId($param1); }
			if($metodo=="validarNombreUsuario" && $param1!=""){ return self::validarNombreUsuario($param1); }

			if($metodo=="buscarRegistroUsuario" && $param1!=""){ return self::buscarRegistroUsuario($param1); }
			if($metodo=="buscarRegistroUsuario1" && $param1!=""){ return self::buscarRegistroUsuario1($param1); }

			if($metodo=="getLastId" && $param1!="" && $param2!=""){ return self::getLastId($param1, $param2); }
		}
		public function Registrar($metodo, $param1=[]){
			if($metodo=="registrarUsuario" && !empty($param1)){ return self::registrarUsuario($param1); }
		}
		public function Editar($metodo, $param1=[]){
			if($metodo=="editarUsuario" && !empty($param1)){ return self::editarUsuario($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="eliminarUsuario" && $param1!=""){ return self::eliminarUsuario($param1); }
			if($metodo=="inhabilitarUsuario" && $param1!=""){ return self::inhabilitarUsuario($param1); }
			if($metodo=="habilitarUsuario" && $param1!=""){ return self::habilitarUsuario($param1); }
		}
		
		private function validarNombreUsuario($cedula){
			try {
				$query="SELECT * from usuario where usuario=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// FUNCION PARA VERIFICAR SI YA EXISTE UNA CEDULA
		private function validarId($id){
			try {
				$query="SELECT * from usuario where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	
		//ACTUALIZAR PACIENTE EN BD
		private function editarUsuario(usuario_model $data){
			try {
				$query="UPDATE usuario set id_rol=?, usuario=?, password=? , pregunta1=? , respuesta1=? , pregunta2=? , respuesta2=? , codigoSeguridad=? where id=?";
				$this->CNX->prepare($query)->execute(array( $data->id_rol, $data->usuario, $data->passwordEncriptada,$data->pregunta1,$data->respuesta1, $data->pregunta2,$data->respuesta2,$data->codigo,$data->id));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// FUNCION PARA BUSCAR LOS DATOS DEL PACIENTE A EDITAR
		private function cargarUsuario($id){
			try {
				$query="SELECT * from usuario where id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		private function registrarUsuario(usuario_model $data){
			try {
				//$query="INSERT into usuario (id_empleado, id_rol, usuario, password, status) values (?,?,?,?,?)";
				$query="INSERT into usuario (id_empleado, id_rol, usuario, password, pregunta1, respuesta1, pregunta2, respuesta2, codigoSeguridad, status) values (?,?,?,?,?,?,?,?,?,?)";
				//$this->CNX->prepare($query)->execute(array($data->id_empleado, $data->id_rol, $data->usuario, $data->password, '1'));
				$this->CNX->prepare($query)->execute(array($data->id_empleado, $data->id_rol, $data->usuario, $data->passwordEncriptada, $data->pregunta1, $data->respuesta1, $data->pregunta2,$data->respuesta2, $data->codigo, '1'));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		


		private function listarUsuario(){
			try {
				// $query="SELECT * from usuario";
				$query="SELECT empleado.id as id_empleado, empleado.cedula, empleado.nombres as nombre_empleado, empleado.apellidos as apellido_empleado, usuario.id, usuario.usuario, rol.id as id_rol, rol.nombre as nombre_rol, usuario.status FROM empleado, usuario, rol WHERE empleado.id=usuario.id_empleado and rol.id=usuario.id_rol";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function listarUsuarios(){
			try {
				//$arreglo;
				$query="SELECT u.id,e.nombres as empleado,u.usuario,r.nombre as rol,s.status as estado from usuario as u INNER JOIN status as s INNER join empleado as e INNER JOIN rol as r where u.status=s.id and u.id_rol=r.id and u.id_empleado=e.id";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$data=$smt->fetchAll(PDO::FETCH_ASSOC);
				print json_encode($data,JSON_UNESCAPED_UNICODE);
				//return json_encode($sub_array);
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
		
		
		//ELIMINAR PACIENTE DE LA BD
		private function inhabilitarUsuario($id){
			try {
				$query="UPDATE usuario SET status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function habilitarUsuario($id){
			try {
				$query="UPDATE usuario SET status='1' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function eliminarUsuario($id){
			try {
				$query="DELETE FROM usuario WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		// CARGAR REGISTRO DE CONSULTORIOS
		private function buscarRegistroUsuario($consultaBusqueda){
			try {
				$query="SELECT empleado.id as id_empleado, empleado.cedula, empleado.nombres as nombre_empleado, empleado.apellidos as apellido_empleado, usuario.id, usuario.usuario, rol.id as id_rol, rol.nombre as nombre_rol FROM empleado, usuario, rol WHERE empleado.id=usuario.id_empleado and rol.id=usuario.id_rol and empleado.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function buscarRegistroUsuario1($consultaBusqueda){
			try {
				$query="SELECT u.id FROM usuario as u WHERE u.usuario=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultaBusqueda));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function getLastId($tabla, $id)
		{
			//$sql='SELECT '.$id.' FROM '.$tabla.' ORDER BY '.$id.' desc';
			$query = 'SELECT MAX(' . $id . ') as id FROM ' . $tabla;
			try {
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$result = $smt->fetchAll();
				return $result[0]['id'];
			} catch (PDOException $e) {
				echo "Error al consultar el Id de la tabla $tabla <br>";
				echo $e;
			}
		}


	} 
?>