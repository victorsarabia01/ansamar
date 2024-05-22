<?php
	
	class conexion_database {
		
		public $CNX;
		public $conection;
		public $desconection;

		public function __construct(){
			try {
				$this->CNX = conexion::conectar();
				$this->conection = conexion::conectar();
				$this->desconection = conexion::desconectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
			
	
	} 
?>