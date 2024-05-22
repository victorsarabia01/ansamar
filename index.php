<?php
	session_start();
	ini_set('date.timezone', 'america/caracas');
	require_once "config/config.php";
	require_once "core/routes.php";
	require_once "config/database.php"; //CONEXION A LA DATABASE
	$mode = null;
	// if(true){
	if(!empty($_SESSION[NAME.'_cuentaActiva']) && $_SESSION[NAME.'_cuentaActiva']==true && !empty($_SESSION[NAME.'_cuenta']) ){
		$defaultControl = "home";
		if(isset($_GET['c'])){
			$defaultControl = $_GET['c'];
			$controlador = cargarControlador($defaultControl);
			if(isset($_GET['a'])){
				if(isset($_GET['id'])){
					cargarAccion($controlador, $_GET['a'], $_GET['id']);
				} else {
					cargarAccion($controlador, $_GET['a']);
				}
			} else {
				cargarAccion($controlador, ACCION_PRINCIPAL);
			}
		} else {
			$controlador = cargarControlador($defaultControl);
			cargarAccion($controlador, ACCION_PRINCIPAL);
		}
	} else {
		if(isset($_GET['credenciales'])){
			$defaultControl = "login";
			// $defaultControl = $_GET['credenciales'];
			$controlador = cargarControlador($defaultControl);
			if(isset($_GET['a'])){
				if(isset($_GET['id'])){
					cargarAccion($controlador, $_GET['a'], $_GET['id']);
				} else {
					cargarAccion($controlador, $_GET['a']);
				}
			} else {
				cargarAccion($controlador, ACCION_PRINCIPAL);
			}
		}else{
			require_once "models/consultorioModel.php";
			$mode = new consultorio_model();
			$_SESSION['consultorios'] = $mode->Consultar("listarConsultoriosx");

			$controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
			$accionTmp = ACCION_PRINCIPAL;
			$controlador->$accionTmp();
		}
	}
?>