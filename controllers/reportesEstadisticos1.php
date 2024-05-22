<?php
	include_once "controller.php";
    
    class reportesEstadisticosController extends controller{

    	/*public $rol;
		public $accesos;*/
		public $nameControl = "Reportes";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/

        public function __construct(){
        	require_once "models/rolModel.php";
			require_once "models/reportesModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new reportes_model();
			$this->alm = new reportes_model();
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
			
			$this->bitacora->AnexarBitacora();
			return $this->vista("reportesEstadisticos");	
		}

		public function dataGrafico(){
			
			$genero=$_POST['criterio1'];
			$fecha=$_POST['fecha'];

			$fechaSeleccionada = date($fecha);
			$fechaFormat = strtotime($fechaSeleccionada);
			//$mess = date ('M',$fechaFormat);
			$año = date ('Y',$fechaFormat);
			$mess = date ('m',$fechaFormat);
			//$año='2024';
			//$mess='2';
			//$mesActual=date("m");
			
			$this->bitacora->AnexarBitacora("Generar Estadistica");
			$consulta=$this->mode->Consultar("generarReporte",$genero,$año,$mess);
			echo json_encode($consulta);	
			//echo $consulta;
		}
	
		


    }

?>