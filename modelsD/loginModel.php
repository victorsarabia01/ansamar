<?php
	
	class login_model extends conexion {
		
		private $db;
		private $cita;
		public $CNX;
		public $cedula;
		public $nombres;
		public $apellidos;
		public $tlfn;
		public $cedula_cliente;
		public $usuario;
		public $password;
		public $dbpassword;
		public $passwordIngresada;
		
		public function __construct(){
			try {
				$this->CNX = parent::conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		// FUNCION PARA VERIFICAR EXISTA UN USUARIO REGISTRADO CON LOS DATOS ENVIADOS POR POST
		public function verificarUsuario($usuario){
			try {
				$query="SELECT empleado.id as id_empleado, empleado.cedula, empleado.nombres as nombre_empleado, empleado.apellidos as apellido_empleado, empleado.fechaNacimiento, empleado.email, empleado.tlfno, empleado.direccion, empleado.id_tipo_empleado, tipo_empleado.descripcion as tipo_empleado, usuario.id, usuario.usuario, rol.id as id_rol, rol.nombre as nombre_rol, usuario.status, usuario.password as password FROM tipo_empleado, empleado, usuario, rol WHERE tipo_empleado.id=empleado.id_tipo_empleado and empleado.id=usuario.id_empleado and rol.id=usuario.id_rol and usuario.usuario=? and usuario.status = 1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($usuario));
				return $smt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function verificarpasswork1($usuario){
			try {
				$query="SELECT empleado.id as id_empleado, empleado.cedula, empleado.nombres as nombre_empleado, empleado.apellidos as apellido_empleado, empleado.fechaNacimiento, empleado.email, empleado.tlfno, empleado.direccion, empleado.id_tipo_empleado, tipo_empleado.descripcion as tipo_empleado, usuario.id, usuario.usuario, rol.id as id_rol, rol.nombre as nombre_rol, usuario.status, usuario.password as password FROM tipo_empleado, empleado, usuario, rol WHERE tipo_empleado.id=empleado.id_tipo_empleado and empleado.id=usuario.id_empleado and rol.id=usuario.id_rol and usuario.usuario=? and usuario.status = 1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($usuario));
				return $smt->fetchAll(PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function verificarpasswork($usuario){
			try {
				$query="SELECT usuario.password as password FROM tipo_empleado, empleado, usuario, rol WHERE tipo_empleado.id=empleado.id_tipo_empleado and empleado.id=usuario.id_empleado and rol.id=usuario.id_rol and usuario.usuario=? and usuario.status = 1";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($usuario));
				return $smt->fetchAll(PDO::FETCH_OBJ);
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