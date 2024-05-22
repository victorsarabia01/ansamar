<?php
	
	class conexion_database {
		
		public $CNX;
		public $conection;
		public $desconection;
		
		public static function conectar(){
			$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
			$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $PDO;
		}
		
				
		
			
	
	} 
?>