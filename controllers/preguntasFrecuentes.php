<?php
include_once "controller.php";
	class preguntasFrecuentesController extends controller{

		public $nameControl = "Preguntasfrecuentes";

		
		public function __construct(){
			require_once "models/rolModel.php";
			
			require_once "models/bitacoraModel.php";
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
				return $this->vista("preguntasFrecuentes");
			}else{
				return $this->vista("error");
			}
		}

		
	}
?>