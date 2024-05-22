<?php
include_once "conexion.php";
class prueba_model extends conexion_database {
public $get_total_rows;
/*$results = $this->CNX->prepare("");
$results->execute();
$get_total_rows = $results->fetch();

//breaking total records into pages
$pages = ceil($get_total_rows[0]/$item_per_page); */

		public function listar(){
			try {
				
				$query="SELECT COUNT(*) FROM paciente";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $get_total_rows = $smt->fetch();
				//return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function listar1($position){
			try {

				//$results = $this->CNX->prepare("SELECT tutsTitle,tutsLink FROM tutorials ORDER BY tutsID DESC LIMIT $position, $item_per_page");
				
				
				$query="SELECT nombres,apellidos FROM paciente ORDER BY id DESC LIMIT $position,'5'";
				$smt = $this->CNX->prepare($query);
				$smt->execute($position);
				return $results;
				//return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
}

?>