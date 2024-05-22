<?php
	
	class controller {
		
		public $nombreVista;
		
		public $alm;
		public $rol;
		public $mode;
		public $accesos;
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;
		public function __construct(){
			//require_once "models/PlanificacionModel.php";
			//$this->mode = new planificacion_model();
		}

		public function vista($cargarVista){
			require_once "views/comunes/header.php";
			require_once "views/$cargarVista/index.php";
			require_once "views/comunes/footer.php";	
		}
			
	
	}
?>