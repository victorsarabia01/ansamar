

<?php

include_once "controller.php";

	class cerrarSesionController extends controller{
		//public $mode;
		
		public function __construct(){
			//require_once "models/plantillaModel.php";
			//$this->mode = new plantilla_model();
			
		}
		public function plantilla(){
			
			session_start();
			session_destroy();
			echo "<script>
            
                 setTimeout( function() { window.location.href = 'index.php'; }, 1000 );
    			</script>";
		}
		
			
		
		
	}
?>