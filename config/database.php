<?php 
//namespace configg;
	class conexion{
		public static function conectar(){
			$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
			$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $PDO;
		}

		public static function desconectar(){
			global $pdo,$smt,$CNX;
			//$stmt->closeCursor();
			$smt=null;
			$CNX=null;
			$PDO=null;
		}
	}

 ?>