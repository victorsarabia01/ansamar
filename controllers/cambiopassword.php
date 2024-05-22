<?php

include_once "controller.php";
	
	// HERENCIA DE LA CLASE CONTROLER USO SUS METODOS O ATRIBUTOS
	class cambiopasswordController extends controller {

		
		public function __construct(){
			//require_once "models/cambiopasswordModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			//$this->alm = new cambiopassword_model();
			
		
		}


		public function validar(){

			//$this->alm->usuario = $_POST['usuario'];
			echo "1";
				
		}

		
		public function validarx(){

				$this->alm->usuario = $_POST['usuario'];
		
				
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarConsultorio", $_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}
				if($this->alm->descripcion == "" || $this->alm->direccion == "" || $this->alm->tlfno == ""){

				}else{
					if (!$this->alm->consulta == "") {
						echo "2";
				
					}else{
						$this->mode->Registrar("registrarConsultorio", $this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
					

					}
				}
				
		}

		
	}

?>