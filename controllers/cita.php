<?php

include_once "controller.php";
//require('fpdf186/fpdf.php');



	class citaController extends controller {
		
		/*public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Cita";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/

		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/citaModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new cita_model();
			$this->alm = new cita_model();
			//$this->pdf=new FPDF();
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

		public function json(){
			if($this->accesoConsultar){
			$this->mode->Consultar("listarCitas");
			}else{
				return $this->vista("error");
			}
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("cita");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarInformacionCita", $_REQUEST['id']);
				return $this->vista("cita/modificar");
			}else{
				return $this->vista("error");
			}
		}
		
		//GUARDAR REGISTRO DEL CLIENTE
		public function guardar(){
			if($this->accesoRegistrar){
			
				$this->alm->id_consultorio = $_POST['consultorio'];
				$this->alm->id_turno = $_POST['turno'];
				$this->alm->id_doctor = $_POST['cargarOdontologos'];
				$this->alm->fechaCita = $_POST['fecha'];
				$this->alm->id_paciente = $_POST['resultadoBusquedaPaciente'];
				//$this->alm->idPlanificacion='265';
				
				$fechaSeleccionada = date($this->alm->fechaCita);
				$fechaFormat = strtotime($fechaSeleccionada);
				$mes = date ('m',$fechaFormat);
				$mesActual=date("m");
				
				$this->alm->mesRegistro = date ('m',$fechaFormat);
				//$this->alm->mesRegistro = '10';

				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$diaSeleccionado= $dias[date('w',$fechaFormat)];
				$diaSemana = date ("N",$fechaFormat);

				$hoy = date("Y-m-d");
				$fechaFormulario = $fechaSeleccionada;
				foreach ($this->mode->Consultar("verificarDiaSemana", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos'],$diaSemana) as $k){
						$this->alm->verificarDia = $k->verificarDia;
				}
				foreach ($this->mode->Consultar("verificarIdPlanificacion", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos']) as $k){
						$this->alm->idPlanificacion = $k->idPlanificacion;
				}
				// Si la fecha es de apartir de hoy => true 
				if ($hoy <= $fechaFormulario) {

				foreach ($this->mode->Consultar("verificarDiaSemana", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos'],$diaSemana) as $k){
						$this->alm->verificarDia = $k->verificarDia;
				}

				if($diaSeleccionado != $this->alm->verificarDia){
						echo "4";
						//$this->mode->Registrar("registrarCita", $this->alm);
						
				}else{
							foreach ($this->mode->Consultar("contadorCitas", $_POST['fecha'],$_POST['turno'],$_POST['consultorio']) as $k){
								$this->alm->contador = $k->contador;
							}
							foreach ($this->mode->Consultar("verificarExistenciaCita", $_POST['fecha'],$_POST['resultadoBusquedaPaciente']) as $k){
								$this->alm->verificarExistenciaCita = $k->verificarExistenciaCita;
							}
							if($this->alm->contador<=1 && $this->alm->verificarExistenciaCita == ""){
								
								$this->mode->Registrar("registrarCita", $this->alm);
								$this->bitacora->AnexarBitacora();

								echo "1";

								/*$this->pdf->AddPage();
								$this->pdf->SetFont('Arial','B',16);
								$this->pdf->Cell(40,10,'¡Mi primera página pdf con FPDF!');
								$this->pdf->Output();*/
																
								
								
							}else{
								echo "5";
							}
				}		
				
				}// FIN DEL IF FECHA CORRECTA
				else{

					echo "6";
				}
				}// FIN DEL IF PERMISO REGISTRAR
				else{
				return $this->vista("error");
				}
		}// FIN DE CLASE

		public function modificar(){
			if($this->accesoModificar){
				$alm = new cita_model();
		
				$alm->id = $_POST['id'];
				
				$alm->id_consultorio = $_POST['consultorio'];
				$alm->id_turno = $_POST['turno'];
				$alm->id_doctor = $_POST['cargarOdontologos'];
				
				$alm->fechaCita = $_POST['fecha'];
				$alm->id_paciente = $_POST['idPaciente'];
				
				$fechaSeleccionada = date($alm->fechaCita);
				$fechaFormat = strtotime($fechaSeleccionada);
				$mes = date ('m',$fechaFormat);
				$mesActual=date("m");
				$alm->mesRegistro = date ('m',$fechaFormat);
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$diaSeleccionado= $dias[date('w',$fechaFormat)];
				$diaSemana = date ("N",$fechaFormat);
				$hoy = date("Y-m-d");
				$fechaFormulario = $fechaSeleccionada;


				foreach ($this->mode->Consultar("verificarIdPlanificacion", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos']) as $k){
						$alm->idPlanificacion = $k->idPlanificacion;
				}
				
				// Si la fecha es de apartir de hoy => true 
				if ($hoy <= $fechaFormulario) {
					foreach ($this->mode->Consultar("verificarDiaSemana", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos'],$diaSemana) as $k){
						$alm->verificarDia = $k->verificarDia;
					}

					if($diaSeleccionado != $alm->verificarDia){
						echo "5";
						
					}else{
					//echo "1";	
					
					foreach ($this->mode->Consultar("contadorCitas", $_POST['fecha'],$_POST['turno'],$_POST['consultorio']) as $k){
							$alm->contador = $k->contador;
					}
					foreach ($this->mode->Consultar("verificarExistenciaCita", $_POST['fecha'],$_POST['resultadoBusquedaPaciente']) as $k){
								$this->alm->verificarExistenciaCita = $k->verificarExistenciaCita;
					}
						if($alm->contador<=1 && $alm->verificarExistenciaCita == ""){
							$this->mode->Modificar("modificarCita", $alm);
							$this->bitacora->AnexarBitacora();
							echo "1";
							

							
						}else{
							echo "6";
							
						}
			
					}
					}else{
					echo "7";			
					}
				
					}else{
					return $this->vista("error");
					}
				}

		public function modificar1(){
			if($this->accesoModificar){
				$alm = new cita_model();
				//$alm->cedula_cliente = $this->mode->Consultar("cargarCedula", $_POST['cedula']);

				$alm->id = $_POST['id'];
				//$alm->cedula = $_POST['cedula1'];
				$alm->id_consultorio = $_POST['consultorio'];
				$alm->id_turno = $_POST['turno'];
				$alm->id_doctor = $_POST['cargarOdontologos'];
				$alm->fechaCita = $_POST['fecha'];
				//$alm->correo = $_POST['correo'];

				$fechaSeleccionada = date($alm->fechaCita);
				$fechaFormat = strtotime($fechaSeleccionada);
				$mes = date ('m',$fechaFormat);
				$mesActual=date("m");
				$alm->mesRegistro = date ('m',$fechaFormat);
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
				$diaSeleccionado= $dias[date('w',$fechaFormat)];
				$diaSemana = date ("N",$fechaFormat);

				$hoy = date("Y-m-d");
				$fechaFormulario = $fechaSeleccionada;
				// Si la fecha es de apartir de hoy => true 
				if ($hoy <= $fechaFormulario) {
					foreach ($this->mode->Consultar("verificarDiaSemana", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos'],$diaSemana) as $k){
						$alm->verificarDia = $k->verificarDia;
					}

					if($diaSeleccionado != $alm->verificarDia){
						echo "5";
						/*echo   "<script type='text/javascript'>  
							//alertify.error('no se pudo Registrar');
							alert('Mes o dia Incorrecto');
							history.back();
							//setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
						</script>";*/
					}else{
						foreach ($this->mode->Consultar("cargarIdPaciente", $_POST['cedula1']) as $k){
							$alm->id_paciente = $k->id;
						}
						foreach ($this->mode->Consultar("contadorCitas", $_POST['fecha'],$_POST['turno'],$_POST['consultorio']) as $k){
							$alm->contador = $k->contador;
						}
						foreach ($this->mode->Consultar("verificarExistenciaCita", $_POST['fecha'],$_POST['resultadoBusquedaPaciente']) as $k){
								$this->alm->verificarExistenciaCita = $k->verificarExistenciaCita;
						}
						if($this->alm->contador<=1 && $this->alm->verificarExistenciaCita == ""){
							//$this->mode->Modificar("modificarCita", $alm);
							echo "1";
							/*echo "<script>
								alert('Cita modificada');
								setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
								//location.reload();
								//window. history. back();
							</script>";*/
						}else{
							echo "6";
							/*echo "<script>
								alert('SELECCIONE OTRO TURNO O DIA DIFERENTE');
								history.back();
							</script>";*/
						}
					}
				}else{
					echo "7";
					/*echo   "<script>  
						alert('Seleccione una fecha correcta');
						history.back();
					</script>";*/
				}
			}else{
				return $this->vista("error");
			}
		}

		public function eliminar(){
			if($this->accesoEliminar){
				//$alm = new cita_model();
				$this->mode->Eliminar("eliminarC", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				/*echo "<script>
					alert('Cita eliminada');
					setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
				</script>";*/
				echo "1";
			}else{
				return $this->vista("error");
			}
		}

		

			
		public function consultarOdontologos(){
			if($this->accesoConsultar){

				$alm = new cita_model();
				$prueba="No existe planificacion";
				$id = filter_input(INPUT_POST, 'consultorio'); 
				$id_turno = filter_input(INPUT_POST, 'turno'); 
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				foreach ($this->mode->Consultar("consultarOdontologos", $id,$id_turno) as $k){
					if ($k->nombres != ""){
						echo '<option value="'.$k->id.'">'.$k->nombres.''." ".''.$k->apellidos.'</option>';
					}else{
						echo '<option value="0">'.$prueba.'</option>';
					}	
				}
				if($k->nombres == ""){
					echo '<option value="0">'.$prueba.'</option>';
				}

			}else{
				return $this->vista("error");
			}
		}

		public function consultarOdontologosDias(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				/*$id = filter_input(INPUT_POST, 'consultorio'); 
				$id_turno = filter_input(INPUT_POST, 'turno'); 
				$empleado = filter_input(INPUT_POST, 'empleado');*/
				
				$id = $_POST['consultorio'];
				$id_turno = $_POST['turno'];
				$empleado = $_POST['empleado'];
				if($empleado=='' || $empleado==null){
					$empleado=="0";
					
				}else{
					foreach ($this->mode->Consultar("consultarOdontologos1", $id,$id_turno,$empleado) as $k){
						if ($k->dia != "" || $k->dia =! null){
						echo '<h5><b>- '.$k->dia.'</b></h5>';
						
						}else{
						echo '<h5><b>Noooooo</b></h5>';	
						}
					
					
				}

				}
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				
			}else{
				return $this->vista("error");
			}
		}

		public function buscarPacienteReg1(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroPaciente", $consultaBusqueda) as $resultados){
					$alm->id = $resultados->id;
				}
				if($alm->id != ""){
					/*echo "<div class='col-md-8'>
						<p style='color:Red;'> Paciente Ya registrado </p>
					</div>";*/
					echo '
					<h5><label>Paciente:</label></h5>
					<input type="hidden" id="id_paciente" value="'.$resultados->id.'">
					<h3><b>'.$resultados->nombres.''." ".''.$resultados->apellidos.'</b></h3>
					
					';
				}
			}else{
				return $this->vista("error");
			}
		}

		public function buscarPacienteReg(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroPaciente", $consultaBusqueda) as $resultados){
					$alm->id = $resultados->id;
				}
				if($alm->id != ""){
					/*echo "<div class='col-md-8'>
						<p style='color:Red;'> Paciente Ya registrado </p>
					</div>";*/
					echo '<option value="'.$resultados->id.'">'.$resultados->nombres.''." ".''.$resultados->apellidos.'</option>';
				}
				else{
					echo '<option value="">No existe Registro</option>';
				}
			}else{
				return $this->vista("error");
			}
		}

		public function buscarRegistroPaciente(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroPaciente", $consultaBusqueda) as $resultados){
					$alm->id = $resultados->id;
				}
				if($alm->id != ""){
					echo "<div class='col-md-8'>
						<p style='color:Red;'> Paciente Ya registradox </p>
					</div>";
				}
			}else{
				return $this->vista("error");
			}
		}

	}
?>