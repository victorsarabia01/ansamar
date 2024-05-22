<?php
include_once "controller.php";
include_once "models/conexion.php";

	class restoreController extends controller{
		
		public $nameControl = "Seguridad";

		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/bitacoraModel.php";
			require_once "models/conexion.php";
			$this->CNX = new conexion_database();
			$this->bitacora = new bitacora_model();
			$this->rol = new rol_model();

			$idRol=$_SESSION[NAME.'_cuenta']['id_rol'];
			$this->accesos = $this->rol->Consultar("cargarAccesos", $idRol);
			foreach ($this->accesos as $acc) {
				if($acc->nombre_modulo==$this->nameControl){
					if($acc->nombre_permiso=="Registrar"){ $this->accesoRegistrar = true; }
					if($acc->nombre_permiso=="Consultar"){ $this->accesoConsultar = true; }
					if($acc->nombre_permiso=="Modificar"){ $this->accesoModificar = true; }
					if($acc->nombre_permiso=="Eliminar"){ $this->accesoEliminar = true; }
				}
			}

			
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("restore");
			}else{
				return $this->vista("error");
			}
		}

		public function restore(){


			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ansamar";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
				die("Error de conexión: " . mysqli_connect_error());
			}

			$sql = file_get_contents('C:\xampp\htdocs\ansamarIV\ansamar150224.sql');

			if (mysqli_multi_query($conn, $sql)) {
				echo "<script>
						alert('Base de datos restaurada exitosamente');
						setTimeout( function() { window.location.href = 'index.php'; }, 500 );
	    		    </script>";
			} else {
				echo "Error al restaurar la base de datos: " . mysqli_error($conn);
			}

			mysqli_close($conn);

			
			/*$db_host = 'localhost';
			$db_name = 'ansamar';
			$db_user = 'root';
			$db_pass = '';

			try {
				$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Error de conexión: " . $e->getMessage();
			}


			$conn->exec('SET FOREIGN_KEY_CHECKS = 0');

			$sql = file_get_contents('C:\xampp\htdocs\ansamarIV\ansamar150224.sql');

			try {
				$conn->exec($sql);
				echo "Restauración de la base de datos completada.";
			} catch (PDOException $e) {
				echo "Error al restaurar la base de datos: " . $e->getMessage();
			}

			$conn->exec('SET FOREIGN_KEY_CHECKS = 1');*/

			/*$mysqlDatabaseName ='ansamar';
			$mysqlUserName ='root';
			$mysqlPassword ='';
			$mysqlHostName ='localhost';
			$mysqlImportFilename ='C:\xampp\htdocs\ansamarIV\ansamar150224.sql';

			//Por favor, no haga ningún cambio en los siguientes puntos
			//Importación de la base de datos y salida del status
			$command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' --password="' .$mysqlPassword .'" ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
			exec($command,$output,$worked);
			switch($worked){
				case 0:
				echo 'Los datos del archivo <b>' .$mysqlImportFilename .'</b> se han importado correctamente a la base de datos <b>' .$mysqlDatabaseName .'</b>';
				break;
				case 1:
				echo 'Se ha producido un error durante la importación. Por favor, compruebe si el archivo está en la misma carpeta que este script. Compruebe también los siguientes datos de nuevo: <br/><br/><table><tr><td>Nombre de la base de datos MySQL:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>Nombre de usuario MySQL:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>Contraseña MySQL:</td><td><b>NOTSHOWN</b></td></tr><tr><td>Nombre de host MySQL:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>Nombre de archivo de la importación de MySQL:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
				break;
			}*/

			/*$dbHost     = 'localhost';
			$dbUsername = 'root';
			$dbPassword = '';
			$dbName     = 'ansamar';
			$filePath   = 'C:\xampp\htdocs\ansamarIV\ansamar1502244.sql';

			function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
    // Connect & select the database
				$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

    // Temporary variable, used to store current query
				$templine = '';

    // Read in entire file
				$lines = file($filePath);

				$error = '';

    // Loop through each line
				foreach ($lines as $line){
        // Skip it if it's a comment
					if(substr($line, 0, 2) == '--' || $line == ''){
						continue;
					}

        // Add this line to the current segment
					$templine .= $line;

        // If it has a semicolon at the end, it's the end of the query
					if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
						if(!$db->query($templine)){
							$error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
						}

            // Reset temp variable to empty
						$templine = '';
					}
				}
				return !empty($error)?$error:true;
			}*/


		



		}


	}
?>