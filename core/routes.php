<?php
	
	function cargarControlador($controlador){
		$nombreControlador = ucwords($controlador)."Controller";
		$archivoControlador = 'controllers/'.ucwords($controlador).'.php';
		
		if(!is_file($archivoControlador)){
			
			$archivoControlador= 'controllers/'.$controlador.'.php';
			
		}
		if(is_file($archivoControlador)){
			require_once $archivoControlador;
			require_once $archivoControlador;
			$control = new $nombreControlador();
			return $control;
		} else {
			// require_once "views/comunes/header.php";
			require_once "views/error/index404.php";
			require_once "views/comunes/footer.php";
		}
	}
	
	function cargarAccion($controller, $accion, $id = null){
		if(isset($accion) && method_exists($controller, $accion)){
			if($id == null){
				$controller->$accion();
				} else {
				$controller->$accion($id);
			}
		} else {
			$controller->ACCION_PRINCIPAL();
		}	
	}
?>