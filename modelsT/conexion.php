<?php
	
	class conexion_database {
		
		public $CNX;
		public $conection;

		public function __construct(){
			try {
				$this->CNX = conexion::conectar();
				$this->conection = conexion::conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
			
	
	} 
?>