<?php

	class listarCitasController {
		public $mode;
		
		public function __construct(){
			require_once "models/listarCitasModel.php";
			$this->mode = new ListarCitas_model();
		}
		
		public function index(){
			
			$alm = new ListarCitas_model();
		
			require_once "views/comunes/header.php";
			require_once "views/listarCitas/index.php";	
			require_once "views/comunes/footer.php";
		}
		
	}
?>