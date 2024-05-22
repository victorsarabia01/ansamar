<?php
	include_once "conexion.php";
	class reportes_model extends conexion_database {
		
	

		public function Consultar($metodo, $param1="", $param2="", $param3=""){
			if($metodo=="generarReporte"){ return self::generarReporte($param1,$param2,$param3); }
			if($metodo=="listarModulos"){ return self::listarModulos(); }
			
		}


		private function generarReporte($genero,$año,$edad){
			try {
			
			//$query = "CALL DATOS_GRAFICO";
			//print_r($año);
			/*$query = "SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m WHERE c.id_mes=m.id and YEAR(c.fecha) = '2024' AND MONTH(c.fecha) = '02'" ;*/
			

			//SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND p.sexo='M' AND c.id_mes=m.id and YEAR(c.fecha) = '2024' AND MONTH(c.fecha) = '02'
			
			/*SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m WHERE c.id_mes=m.id and YEAR(c.fecha) =2024 and MONTH(c.fecha)=02 GROUP BY m.id*/
			//$smt->execute(array($genero,$mes,$año));
			

			if($genero==1){
				//SELECT m.mes,count(c.id) as cantidadCitas FROM cita as c INNER join meses as m INNER join paciente as p WHERE YEAR(c.fecha)=YEAR(CURRENT_DATE()) and c.id_mes=m.id and p.id=c.id_paciente and YEAR(p.fechaNacimiento)='2024' group by m.id
				//SELECT m.mes,count(c.id) as cantidadCitas FROM cita as c INNER join meses as m inner join paciente as p WHERE YEAR(c.fecha)=YEAR(CURRENT_DATE()) and c.id_mes=m.id and p.fechaNacimiento <= DATE_SUB(CURDATE(), INTERVAL 29 YEAR) group by m.id;

				//SELECT m.mes,count(c.id) as cantidadCitas FROM cita as c INNER join meses as m inner join paciente as p WHERE YEAR(c.fecha)=YEAR(CURRENT_DATE()) and c.id_mes=m.id and p.id=c.id_paciente and p.fechaNacimiento <= DATE_SUB(CURDATE(), INTERVAL 29 YEAR) group by m.id
				//SELECT m.mes,count(c.id) as cantidadCitas FROM cita as c INNER join meses as m WHERE YEAR(c.fecha)=YEAR(CURRENT_DATE()) and c.id_mes=m.id group by m.id
					$query="SELECT m.mes,count(c.id) as cantidadCitas FROM cita as c INNER join meses as m inner join paciente as p WHERE YEAR(c.fecha)=$año and c.id_mes=m.id and p.id=c.id_paciente";


					if ($edad==2){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 15 YEAR)";
					}else if($edad==3){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 25 YEAR)";
					}else if($edad==4){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 45 YEAR)";
					}else if($edad==5){
						$query .= " and p.fechaNacimiento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR)";
					}
					/*$query = "SELECT m.mes, COUNT(m.mes) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND c.id_mes=m.id";
					$query .= " and YEAR(c.fecha)=$año";
					$query .= " and MONTH(c.fecha)=".$mess;*/

					//$query .= " GROUP BY m.id";
					//$query .= " GROUP BY c.fecha";

					//$query .= " and x.id = ".$id_consultori "GROUP BY m.id";
					$query .= " group by m.id";
					$arreglo = array();
					$smt = $this->CNX->prepare($query);
					$smt->execute();
					
					$smt->execute();
					while($row=$smt->fetch(PDO::FETCH_BOTH)){
		  			$userData[] = $row;
		 			}
		 			return $userData;
				
			}else if($genero==2){
					$query = "SELECT m.mes, COUNT(c.id) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND c.id_mes=m.id";
					$query .= " and YEAR(c.fecha)=$año";
					$query .= " and p.sexo = 'M'";
					if ($edad==2){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 15 YEAR)";
					}else if($edad==3){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 25 YEAR)";
					}else if($edad==4){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 45 YEAR)";
					}else if($edad==5){
						$query .= " and p.fechaNacimiento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR)";
					}
					$query .= " group by m.id";
					$arreglo = array();
					$smt = $this->CNX->prepare($query);
					$smt->execute();
					
					while($row=$smt->fetch(PDO::FETCH_BOTH)){
		  			$userData[] = $row;
		 			}
		 			return $userData;

			}else if($genero==3){
					$query = "SELECT m.mes, COUNT(c.id) as cantidadCitas FROM cita as c inner join meses as m inner join paciente as p WHERE p.id=c.id_paciente AND c.id_mes=m.id";
					$query .= " and YEAR(c.fecha)=$año";
					//$query .= " and MONTH(c.fecha)=".$mess;
					$query .= " and p.sexo = 'F'";
					if ($edad==2){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 15 YEAR)";
					}else if($edad==3){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 25 YEAR)";
					}else if($edad==4){
						$query .= " and p.fechaNacimiento >= DATE_SUB(CURDATE(), INTERVAL 45 YEAR)";
					}else if($edad==5){
						$query .= " and p.fechaNacimiento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR)";
					}
					$query .= " group by m.id";
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