<?php
	include_once "conexion.php";
	class reportes_model extends conexion_database {
		
	

		public function Consultar($metodo, $param1="", $param2="", $param3=""){
			if($metodo=="generarReporte"){ return self::generarReporte($param1,$param2,$param3); }
			if($metodo=="listarModulos"){ return self::listarModulos(); }
			
		}


		private function generarReporte($genero,$año,$mess){
			try {
			
			//$query = "CALL DATOS_GRAFICO";
			//print_r($año);
			/*$query = "SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m WHERE c.id_mes=m.id and YEAR(c.fecha) = '2024' AND MONTH(c.fecha) = '02'" ;*/
			

			//SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND p.sexo='M' AND c.id_mes=m.id and YEAR(c.fecha) = '2024' AND MONTH(c.fecha) = '02'
			
			/*SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m WHERE c.id_mes=m.id and YEAR(c.fecha) =2024 and MONTH(c.fecha)=02 GROUP BY m.id*/
			//$smt->execute(array($genero,$mes,$año));

			if($genero==1){
					$query = "SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND c.id_mes=m.id";
					$query .= " and YEAR(c.fecha)=$año";
					//$query .= " GROUP BY m.id";
					$query .= " and MONTH(c.fecha)=".$mess;
					//$query .= " GROUP BY c.fecha";

					//$query .= " and x.id = ".$id_consultori "GROUP BY m.id";
					$arreglo = array();
					$smt = $this->CNX->prepare($query);
					$smt->execute();
					
					$smt->execute();
					while($row=$smt->fetch(PDO::FETCH_BOTH)){
		  			$userData[] = $row;
		 			}
		 			return $userData;
				
			}else if($genero==2){
					$query = "SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND c.id_mes=m.id";
					$query .= " and YEAR(c.fecha)=$año";
					$query .= " and MONTH(c.fecha)=".$mess;
					$query .= " and p.sexo = 'M'";
					$arreglo = array();
					$smt = $this->CNX->prepare($query);
					$smt->execute();
					
					while($row=$smt->fetch(PDO::FETCH_BOTH)){
		  			$userData[] = $row;
		 			}
		 			return $userData;

			}else{
					$query = "SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND c.id_mes=m.id";
					$query .= " and YEAR(c.fecha)=$año";
					$query .= " and MONTH(c.fecha)=".$mess;
					$query .= " and p.sexo = 'F'";
					$arreglo = array();
					$smt = $this->CNX->prepare($query);
					$smt->execute();
					
					while($row=$smt->fetch(PDO::FETCH_BOTH)){
		  			$userData[] = $row;
		 			}
		 			return $userData;

			}


			
			}catch (Exception $e){
			die($e->getMessage());
			}
			
			}

			private function listarModulos(){
			try {
				
				$query="SELECT * FROM modulo";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
			

 

	

		
		
	} 
?>