<?php

include_once "controller.php";

	class citaController extends controller {
		
		public $mode;
		public $rol;
		public $accesos;
		public $nameControl = "Cita";
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;

		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/citaModel.php";
			$this->mode = new cita_model();
			$this->alm = new cita_model();

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
				return $this->vista("cita");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$alm = $this->mode->Consultar("cargarInformacionCita", $_REQUEST['id']);
				return $this->vista("cita/modificar");
			}else{
				return $this->vista("error");
			}
		}
		
		//GUARDAR REGISTRO DEL CLIENTE
		public function guardar(){
			if($this->accesoRegistrar){
				$this->alm->cedula_cliente = $this->mode->Consultar("cargarCedula", $_POST['cedula']);
				$this->alm->cedula = $_POST['cedula'];
				$this->alm->nombre = $_POST['nombres'];
				$this->alm->apellido = $_POST['apellidos'];
				$this->alm->telefono = $_POST['telefono'];
				$this->alm->id_consultorio = $_POST['consultorio'];
				$this->alm->id_turno = $_POST['turno'];
				$this->alm->id_doctor = $_POST['cargarOdontologos'];
				$this->alm->fechaCita = $_POST['fecha'];
				$this->alm->correo = $_POST['correo'];
				$fechaSeleccionada = date($alm->fechaCita);
				$fechaFormat = strtotime($fechaSeleccionada);
				$mes = date ('m',$fechaFormat);
				$mesActual=date("m");

				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
				$diaSeleccionado= $dias[date('w',$fechaFormat)];
				$diaSemana = date ("N",$fechaFormat);

				$hoy = date("Y-m-d");
				$fechaFormulario = $fechaSeleccionada;
				// Si la fecha es de apartir de hoy => true 
				if ($hoy <= $fechaFormulario) {
					foreach ($this->mode->Consultar("verificarDiaSemana", $_POST['consultorio'],$_POST['turno'],$_POST['cargarOdontologos'],$diaSemana) as $k){
						$this->alm->verificarDia = $k->verificarDia;
					}

					if($mes != $mesActual || $diaSeleccionado != $this->alm->verificarDia){
						echo "<script type='text/javascript'>  
							//alertify.error('no se pudo Registrar');
							alert('Mes o dia Incorrecto');
							history.back();
							//setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
						</script>";
					}else{
						if ($this->alm->id_consultorio==0 || $this->alm->id_turno==0 || $this->alm->id_doctor==0 ){
							echo "<script>  
								alert('Debe Llenar todo el Formulario');
								history.back();
							</script>";
						}else if($this->alm->cedula_cliente==""){
							//REGISTRAR CLIENTE
							$this->mode->Registrar("registrarC", $this->alm);
							foreach ($this->mode->Consultar("cargarIdPaciente", $_POST['cedula']) as $k){
								$this->alm->id_paciente = $k->id;
							}
							foreach ($this->mode->Consultar("contadorCitas", $_POST['fecha'],$_POST['turno'],$_POST['consultorio']) as $k){
								$this->alm->contador = $k->contador;
							}
							if($this->alm->contador<=2){
								$this->mode->Registrar("registrarCita", $this->alm);
								echo "<script>jQuery(function(){swal(\'¡Bien!\', \'Condición cumplida\', \'success\');});</script>";
								echo "<script>
									alert('Cita registrada');
									setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
								</script>";
							}else{
								echo "<script>
									alert('SELECCIONE OTRO TURNO O DIA DIFERENTE');
									history.back();
								</script>";
							}
						}else{
							foreach ($this->mode->Consultar("cargarIdPaciente", $_POST['cedula']) as $k){
								$this->alm->id_paciente = $k->id;
							}
							foreach ($this->mode->Consultar("contadorCitas", $_POST['fecha'],$_POST['turno'],$_POST['consultorio']) as $k){
								$this->alm->contador = $k->contador;
							}
							if($this->alm->contador<=2){
								$this->mode->Registrar("registrarCita", $this->alm);
								echo "<script>
									alert('Cita registrada');
									setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
								</script>";
							}else{
								echo "<script>
									alert('SELECCIONE OTRO TURNO O DIA DIFERENTE');
									history.back();
								</script>";
							}
						}
					}
				}else{
					echo "<script>
						alert('Seleccione una fecha correcta');
						history.back();
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function modificar(){
			if($this->accesoModificar){
				$alm = new cita_model();
				//$alm->cedula_cliente = $this->mode->Consultar("cargarCedula", $_POST['cedula']);

				$alm->id = $_POST['id'];
				$alm->cedula = $_POST['cedula1'];
				$alm->id_consultorio = $_POST['consultorio'];
				$alm->id_turno = $_POST['turno'];
				$alm->id_doctor = $_POST['cargarOdontologos'];
				$alm->fechaCita = $_POST['fecha'];
				//$alm->correo = $_POST['correo'];

				$fechaSeleccionada = date($alm->fechaCita);
				$fechaFormat = strtotime($fechaSeleccionada);
				$mes = date ('m',$fechaFormat);
				$mesActual=date("m");

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

					if($mes != $mesActual || $diaSeleccionado != $alm->verificarDia){
						echo   "<script type='text/javascript'>  
							//alertify.error('no se pudo Registrar');
							alert('Mes o dia Incorrecto');
							history.back();
							//setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
						</script>";
					}else{
						foreach ($this->mode->Consultar("cargarIdPaciente", $_POST['cedula1']) as $k){
							$alm->id_paciente = $k->id;
						}
						foreach ($this->mode->Consultar("contadorCitas", $_POST['fecha'],$_POST['turno'],$_POST['consultorio']) as $k){
							$alm->contador = $k->contador;
						}
						if($alm->contador<=2){
							$this->mode->Modificar("modificarCita", $alm);
							echo "<script>
								alert('Cita modificada');
								setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
								//location.reload();
								//window. history. back();
							</script>";
						}else{
							echo "<script>
								alert('SELECCIONE OTRO TURNO O DIA DIFERENTE');
								history.back();
							</script>";
						}
					}
				}else{
					echo   "<script>  
						alert('Seleccione una fecha correcta');
						history.back();
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function eliminar(){
			if($this->accesoEliminar){
				$alm = new cita_model();
				$this->mode->Eliminar("eliminar", $_REQUEST['id']);
				echo "<script>
					alert('Cita eliminada');
					setTimeout( function() { window.location.href = 'index.php?c=cita'; }, 1000 );
				</script>";
			}else{
				return $this->vista("error");
			}
		}

		public function listarCitasAjax(){
			if($this->accesoConsultar){
				$parameter = "";
				if($_SESSION[NAME.'_cuenta']['nombre_rol']=="Superusuario" || $_SESSION[NAME.'_cuenta']['nombre_rol']=="Administrador"){
					$parameter = "";
				}else{
					$parameter = $_SESSION[NAME.'_consultorio']->id;
				}
				$alm = new cita_model();
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="row">
							<div class="col-md-12 text-center">
								<h3>Citas registradas del mes en curso</h3>
							</div>
						</div>
					</div>

					<div class="col-md-12 text-center">
						<table class="table table-hover">
							<tr class="table-secondary">
								<th>Fecha</th>
								<th>Consultorio</th>
								<th>Turno</th>
								<th>Cédula</th>
								<th>Paciente</th>
								<th>Teléfono</th>
								<th>Correo</th>
								<th>Odontologo</th>';
								if($this->accesoModificar){
									$mensaje .='<th>EDITAR</th>';
								}
								if($this->accesoEliminar){
									$mensaje .='<th>ELIMINAR</th>';
								}
								$mensaje .='
							</tr>';
							foreach ($this->mode->Consultar("listarCitas", $parameter) as $k){
								$mensaje .= '
								<tr>
									<td>'.date("d-m-Y", strtotime($k->fecha)).'</td>
									<td>'.$k->consultorio.'</td>
									<td>'.$k->turno.'</td>
									<td>'.$k->cedula.'</td>
									<td>'.$k->nombres.' '.$k->apellidos.'</td>
									<td>'.$k->tlfno.'</td>
									<td>'.$k->email.'</td>
									<td>'.$k->nombresDoctor.' '.$k->apellidosDoctor.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=cita&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
												<i class="bi bi-pencil-square"></i>
											</a>
										</td>
										';
									}
									if($this->accesoEliminar){
										$mensaje .='
										<td>
											<button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
												<i class="bi bi-trash"></i>
											</button>
										</td>
										';
									}
									$mensaje .='
								</tr>';
							}
						$mensaje .= '</table>
					</div>

					<script type="text/javascript">
						$(document).ready(function(){
							$(".eliminar").click(function(e){
								console.log();
								e.preventDefault();
								var id = $(this).attr("id");
								swal({
									title: "Atención!!!",
									text: "¿Esta seguro de eliminar el registro?!",
									type: "warning",
									showCancelButton: true,
									confirmButtonClass: "btn-danger",
									confirmButtonText: "Confirmar",
									cancelButtonText: "Cancelar",
									closeOnConfirm: false,
									closeOnCancel: false
									}, function(isConfirm) {
										if (isConfirm) {
											//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
											window.location.href="index.php?c=cita&a=eliminar&id="+id;
										} else {
											//Si se cancela se emite un mensaje
											swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
										}
									});
								});
							});
						});
					</script>
				';
				echo $mensaje;
			}else{
				return $this->vista("error");
			}
		}

		public function listarCitasAjaxHoy(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$mensaje ="";
				date_default_timezone_set("America/Caracas");
				$fecha_actual = date("d-m-Y");
				$mensaje .='
					<div class="row">
						<div class="row">
							<div class="col-md-12 text-center">
								<h3>Citas programadas para hoy '.$fecha_actual.'</h3>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<table class="table table-hover">
							<tr class="table-secondary">
								<th>Consultorio</th>
								<th>Turno</th>
								<th>Cédula</th>
								<th>Paciente</th>
								<th>Teléfono</th>
								<th>Correro</th>
								<th>Odontólogo</th>';
								if($this->accesoModificar){
									$mensaje .='<th>EDITAR</th>';
								}
								if($this->accesoEliminar){
									$mensaje .='<th>ELIMINAR</th>';
								}
								$mensaje .='
							</tr>';
							foreach ($this->mode->Consultar("listarCitasParaHoy") as $k){
								$mensaje .= '
									<tr>
										<td>'.$k->consultorio.'</td>
										<td>'.$k->turno.'</td>
										<td>'.$k->cedula.'</td>
										<td>'.$k->nombres.' '.$k->apellidos.'</td>
										<td>'.$k->tlfno.'</td>
										<td>'.$k->email.'</td>
										<td>'.$k->nombresDoctor.' '.$k->apellidosDoctor.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=cita&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
													<i class="bi bi-pencil-square"></i>
												</a>
											</td>
											';
										}
										if($this->accesoEliminar){
											$mensaje .='
											<td>
												<button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
													<i class="bi bi-trash"></i>
												</button>
											</td>
											';
										}
										$mensaje .='
									</tr>
								';
							}
						$mensaje .= '</table>
					</div>

					<script type="text/javascript">
						$(document).ready(function(){
							$(".eliminar").click(function(e){
								console.log();
								e.preventDefault();
								var id = $(this).attr("id");
								swal({
									title: "Atención!!!",
									text: "¿Esta seguro de eliminar el registro?!",
									type: "warning",
									showCancelButton: true,
									confirmButtonClass: "btn-danger",
									confirmButtonText: "Confirmar",
									cancelButtonText: "Cancelar",
									closeOnConfirm: false,
									closeOnCancel: false
									},
									function(isConfirm) {
										if (isConfirm) {
											//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
											window.location.href="index.php?c=cita&a=eliminar1&id="+id;
										} else {
											//Si se cancela se emite un mensaje
											swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
										}
									}
								);
							});
						});
					</script>
				';
				echo $mensaje;
			}else{
				return $this->vista("error");
			}
		}
		
		public function buscarRegistro(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroCita", $consultaBusqueda) as $resultados){
					$alm->id = $resultados->id;
					$alm->fecha = $resultados->fecha;
					$alm->consultorio = $resultados->consultorio;
					$alm->nombres = $resultados->nombres;
					$alm->cedula = $resultados->cedula;
					$alm->apellidos = $resultados->apellidos;
					$alm->telefono = $resultados->tlfno;
					$alm->turno = $resultados->turno;
					$alm->nombresDoctor = $resultados->nombresDoctor;
					$alm->apellidosDoctor = $resultados->apellidosDoctor;
					$alm->correo = $resultados->email;
				}
				if($alm->id != ""){
					echo '<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<thead class="table-success">
										<th>Fecha</th>
										<th>Consultorio</th>
										<th>Turno</th>
										<th>Cédula</th>
										<th>Paciente</th>
										<th>Teléfono</th>
										<th>Correro</th>
										<th>Odontólogo</th>';
										if($this->accesoModificar){
											$mensaje .='<th>EDITAR</th>';
										}
										if($this->accesoEliminar){
											$mensaje .='<th>ELIMINAR</th>';
										}
										$mensaje .='
									</thead>
								</tr>
								<tr>
									<td>'.date("d-m-Y", strtotime($alm->fecha)).'</td>
									<td>'.$alm->consultorio.'</td>
									<td>'.$alm->turno.'</td>
									<td>'.$alm->cedula.'</td>
									<td>'.$alm->nombres.' '.$alm->apellidos.'</td>
									<td>'.$alm->telefono.'</td>
									<td>'.$alm->correo.'</td>
									<td>'.$alm->nombresDoctor.' '.$alm->apellidosDoctor.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=cita&a=editar&id='.$alm->id.'" type="button" class="btn btn-outline-primary">
												<i class="bi bi-pencil-square"></i>
											</a>
										</td>
										';
									}
									if($this->accesoEliminar){
										$mensaje .='
										<td>
											<button href="#" id="'.$alm->id.'" type="button" class="btn btn-outline-danger eliminar">
												<i class="bi bi-trash"></i>
											</button>
										</td>
										';
									}
									$mensaje .='
								</tr>
							</table>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
							$(".eliminar").click(function(e){
								e.preventDefault();
								var id = $(this).attr("id");
								swal({
									title: "Atención!!!",
									text: "¿Esta seguro de inhabilitar el registro?!",
									type: "warning",
									showCancelButton: true,
									confirmButtonClass: "btn-danger",
									confirmButtonText: "Confirmar",
									cancelButtonText: "Cancelar",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm) {
									if (isConfirm) {
										//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
										window.location.href="index.php?c=cita&a=eliminar&id="+id;
									} else {
										//Si se cancela se emite un mensaje
										swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
									}
								});
							});
						});
					</script>';
				}
			}else{
				return $this->vista("error");
			}
		}

		public function buscarRegistroHoy(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroCita", $consultaBusqueda) as $resultados){
					$alm->id = $resultados->id;
					$alm->fecha = $resultados->fecha;
					$alm->consultorio = $resultados->consultorio;
					$alm->nombres = $resultados->nombres;
					$alm->cedula = $resultados->cedula;
					$alm->apellidos = $resultados->apellidos;
					$alm->telefono = $resultados->tlfno;
					$alm->turno = $resultados->turno;
					$alm->nombresDoctor = $resultados->nombresDoctor;
					$alm->apellidosDoctor = $resultados->apellidosDoctor;
					$alm->correo = $resultados->email;
				}
				if($alm->id != ""){
					echo '<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<thead class="table-success">
										<th>Fecha</th>
										<th>Consultorio</th>
										<th>Turno</th>
										<th>Cédula</th>
										<th>Paciente</th>
										<th>Teléfono</th>
										<th>Correro</th>
										<th>Odontólogo</th>';
										if($this->accesoModificar){
											$mensaje .='<th>EDITAR</th>';
										}
										if($this->accesoEliminar){
											$mensaje .='<th>ELIMINAR</th>';
										}
										$mensaje .='
									</thead>
								</tr>
								<tr>
									<td>'.date("d-m-Y", strtotime($alm->fecha)).'</td>
									<td>'.$alm->consultorio.'</td>
									<td>'.$alm->turno.'</td>
									<td>'.$alm->cedula.'</td>
									<td>'.$alm->nombres.' '.$alm->apellidos.'</td>
									<td>'.$alm->telefono.'</td>
									<td>'.$alm->correo.'</td>
									<td>'.$alm->nombresDoctor.' '.$alm->apellidosDoctor.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=cita&a=editar&id='.$alm->id.'" type="button" class="btn btn-outline-primary">
												<i class="bi bi-pencil-square"></i>
											</a>
										</td>
										';
									}
									if($this->accesoEliminar){
										$mensaje .='
										<td>
											<button href="#" id="'.$alm->id.'" type="button" class="btn btn-outline-danger eliminar">
												<i class="bi bi-trash"></i>
											</button>
										</td>
										';
									}
									$mensaje .='
								</tr>
							</table>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
							$(".eliminar").click(function(e){
								e.preventDefault();
								var id = $(this).attr("id");
								swal({
									title: "Atención!!!",
									text: "¿Esta seguro de inhabilitar el registro?!",
									type: "warning",
									showCancelButton: true,
									confirmButtonClass: "btn-danger",
									confirmButtonText: "Confirmar",
									cancelButtonText: "Cancelar",
									closeOnConfirm: false,
									closeOnCancel: false
								},
								function(isConfirm) {
									if (isConfirm) {
										//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
										window.location.href="index.php?c=cita&a=eliminar1&id="+id;
									} else {
										//Si se cancela se emite un mensaje
										swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
									}
								});
							});
						});
					</script>';
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
						<p style='color:Red;'> Paciente Ya registrado </p>
					</div>";
				}
			}else{
				return $this->vista("error");
			}
		}
		
		public function consultarOdontologos(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$id = filter_input(INPUT_POST, 'consultorio'); 
				$id_turno = filter_input(INPUT_POST, 'turno'); 
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				foreach ($this->mode->Consultar("consultarOdontologos", $id,$id_turno) as $k){
					echo '<option value="'.$k->id.'">'.$k->nombres.''." ".''.$k->apellidos.'</option>';
				}
			}else{
				return $this->vista("error");
			}
		}

		public function consultarOdontologosDias(){
			if($this->accesoConsultar){
				$alm = new cita_model();
				$id = filter_input(INPUT_POST, 'consultorio'); 
				$id_turno = filter_input(INPUT_POST, 'turno'); 
				$empleado = filter_input(INPUT_POST, 'empleado'); 
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				foreach ($this->mode->Consultar("consultarOdontologos1", $id,$id_turno,$empleado) as $k){
					echo '<h5>'.$k->dia.'</h5>';
				}
			}else{
				return $this->vista("error");
			}
		}

		public function consultarTurnos(){
			if($this->accesoConsultar){
				foreach ($this->mode->Consultar("consultarOdontologos", $id,$id_turno) as $k){
					echo '<option value="'.$alm->datos = $k->id.'">'.$alm->datos1 = $k->nombres.'</option>';
				}
			}else{
				return $this->vista("error");
			}
		}
	}
?>