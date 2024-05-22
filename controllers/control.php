<?php
	include_once "controller.php";

	class ControlController extends controller{
		public function __construct(){
		}
		public function index(){
			require_once "views/index.php";	
			//return $this->vista("consultorio");
		}

	}
?>