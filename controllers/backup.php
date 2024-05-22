<?php
include_once "models/conexion.php";
class backupController extends conexion_database {

//public $db_host = 'localhost';
//public $db_name = 'ansamar';
//public $db_user = 'root';
//public $db_pass = '';
//public $stmt = '';
//public $conn = '';
//public $CNX;


public function backup(){

			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();

			$stmt = $this->CNX->query("SHOW TABLES");
			$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);


			$date = date('Ymd_His');
			$filename = 'backup_'.$date.'.sql';
			$file = fopen($filename, 'w');


			foreach($tables as $table) {
			    // Obtener estructura de la tabla
			    $stmt = $this->CNX->query("SHOW CREATE TABLE $table");
			    $table_structure = $stmt->fetchAll(PDO::FETCH_COLUMN)[0];
			    
			    // Escribir estructura de la tabla en el archivo
			    fwrite($file, $table_structure.";");
			    
			    // Obtener datos de la tabla
			    $stmt = $this->CNX->query("SELECT * FROM $table");
			    $table_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			    
			    // Escribir datos de la tabla en el archivo
			    foreach($table_data as $row) {
			        $values = array_map(function ($value) {
			            return "'" . addslashes($value) . "'";
			        }, array_values($row));
			        fwrite($file, "INSERT INTO $table VALUES (" . implode(',', $values) . ");");
			    } 
			}

			fclose($file);
			$this->bitacora->AnexarBitacora("Generado");
			echo "<script>
						alert('Backup exitoso');
						setTimeout( function() { window.location.href = 'index.php'; }, 1000 );
	    		    </script>";

}


}
?>

