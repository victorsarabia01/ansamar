<?php

include_once "controller.php";

	class pacienteController extends controller {
		public $mode;
		public $rol;
		public $accesos;
		public $nameControl = "Paciente";
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;
		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/pacienteModel.php";
			$this->mode = new paciente_model();
			$this->alm = new paciente_model();

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
				return $this->vista("paciente");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				//$alm = new paciente_model();
				$this->alm = $this->mode->Consultar("cargarPaciente", $_REQUEST['id']);
				return $this->vista("paciente/modificar");
			}else{
				return $this->vista("error");
			}
		}
			
		// GUARDAR PACIENTE
		public function guardar(){
			if($this->accesoRegistrar){
				//$alm = new paciente_model();
				$this->alm->cedula = $_POST['cedula'];
				$this->alm->nombres = $_POST['nombres'];
				$this->alm->apellidos = $_POST['apellidos'];
				$this->alm->fechaNacimiento = $_POST['fecha'];
				$this->alm->correo = $_POST['email'];
				$this->alm->telefono = $_POST['telefono'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->sexo = $_POST['sexo'];

				foreach ($this->mode->Consultar("validarCedula", $_POST['cedula']) as $k){
					$this->alm->consulta = $k->consulta;
				}
				$fechaSeleccionada = date($this->alm->fechaNacimiento);
				$fechaFormat = strtotime($fechaSeleccionada);
				$anoSeleccionado = date ('Y',$fechaFormat);
				$anoActual=date("Y");

				if(!$this->alm->consulta==""){
					echo "<script>
						alert('Ya existe un registro con esta cédula');
						history.back();
					</script>";
				}else if($this->alm->sexo == "x"){
					echo "<script>
						alert('Seleccione el sexo');
						history.back();
					</script>";
				}else if($anoActual-$anoSeleccionado < 5){
					echo "<script>
						alert('No es permitido paciente menor a 5 años');
						history.back();
						//setTimeout( function() { window.location.href = 'index.php?c=paciente'; }, 5000 );
					</script>";
				}else{
					$this->mode->Registrar("registrarPaciente", $this->alm);
					echo "<script>
						alert('Paciente Registrado');
						setTimeout( function() { window.location.href = 'index.php?c=paciente'; }, 1000 );
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function asignarCondicion(){
			if($this->accesoRegistrar){
				$this->alm = $this->mode->Consultar("cargarPaciente", $_REQUEST['id']);
				return $this->vista("paciente/asignarCondicion");
			}else{
				return $this->vista("error");
			}
		}

		public function agendarCita(){
			if($this->accesoRegistrar){
				$alm = new paciente_model();
				$alm = $this->mode->Consultar("cargarPaciente", $_REQUEST['id']);
				require_once "views/comunes/header.php";	
				require_once "views/paciente/asignarCita/index.php";
				require_once "views/comunes/footer.php";
			}else{
				return $this->vista("error");
			}
		}

		public function asignarCondicionMedica(){
			if($this->accesoRegistrar){
				//$alm = new paciente_model();
						
				$this->alm->id = $_POST['id'];
				$this->alm->condicion = $_POST['condicion'];

				foreach ($this->mode->Consultar("validarCondicionMedica", $_POST['id'],$_POST['condicion']) as $k){
					$this->alm->consulta = $k->id;
				} 
				if($this->alm->consulta != "" ){
					echo "<script>
						alert('Error condición médica ya asiganada');
						history.back();
					</script>";
				}else{
					$this->mode->Registrar("registrarCondicionMedicaPaciente", $this->alm);
					echo "<script>
						alert('Condición médica registrada');
						history.back();
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}

		// MODIFICAR PACIENTE
		public function modificar(){
			if($this->accesoModificar){
				//$alm = new paciente_model();
				
				$this->alm->id = $_POST['id'];
				$this->alm->cedula = $_POST['cedula'];
				$this->alm->nombres = $_POST['nombres'];
				$this->alm->apellidos = $_POST['apellidos'];
				$this->alm->fechaNacimiento = $_POST['fecha'];
				$this->alm->correo = $_POST['email'];
				$this->alm->telefono = $_POST['telefono'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->sexo = $_POST['sexo'];
				$this->alm->status = $_POST['status'];

				$fechaSeleccionada = date($this->alm->fechaNacimiento);
				$fechaFormat = strtotime($fechaSeleccionada);
				$anoSeleccionado = date ('Y',$fechaFormat);
				$anoActual=date("Y");

				foreach ($this->mode->Consultar("validarCedula1", $this->alm->id) as $k){
					$this->alm->consulta1 = $k->cedula;
				}
				foreach ($this->mode->Consultar("validarCedula", $this->alm->cedula) as $k){
					$this->alm->consulta = $k->consulta;
				}
				if($anoActual-$anoSeleccionado < 5){
					echo "<script>
						alert('No es permitido paciente menor a 5 años');
						history.back();
					</script>";
				}else if($this->alm->cedula==$this->alm->consulta1){
					$this->mode->Editar("editarPaciente", $this->alm);
					echo "<script>
						alert('Paciente modificado');
						setTimeout( function() { window.location.href = 'index.php?c=paciente'; }, 1000 );
					</script>";
				}else if(!$this->alm->consulta == ""){
					echo "<script>
						alert('Cedula no disponible');
						history.back();
					</script>";
				}else{
					$this->mode->Editar("editarPaciente", $this->alm);
					echo "<script>
						alert('Paciente modificado');
						setTimeout( function() { window.location.href = 'index.php?c=paciente'; }, 1000 );
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}
		
		//ELIMINAR REGISTRO 
		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("deletePaciente", $_REQUEST['id']);
				echo "<script>
					alert('Paciente inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=paciente'; }, 1000 );
				</script>";
			}else{
				return $this->vista("error");
			}
		}
		
		public function eliminarCondicionMedica(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("eliminarCondicionMedica", $_REQUEST['id']);
				echo "<script>
					alert('Condición médica eliminada');
					history.back();
				</script>";
			}else{
				return $this->vista("error");
			}
		}

		public function verificarRegistroPaciente(){
			if($this->accesoConsultar){
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroPaciente", $consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "<div class='col-md-8'>
						<p style='color:Red;'> Cédula No disponible </p>
					</div>";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function cargarTablaPacientes(){
			if($this->accesoConsultar){
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Pacientes</h3>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<table class="table table-hover">
							<tr class="table-secondary">
								<th>Cédula</th>
								<th>Nombres   Apellidos</th>
								<th>Teléfono</th>
								<th>Email</th>
								<th>Estado</th>';
								if($this->accesoModificar){
									$mensaje .='<th>EDITAR</th>';
								}
								if($this->accesoRegistrar){
									$mensaje .='<th>AGENDAR CITA</th>';
								}
								if($this->accesoRegistrar){
									$mensaje .='<th>CONDICION MÉDICA</th>';
								}
								if($this->accesoEliminar){
									$mensaje .='<th>ELIMINAR</th>';
								}
								$mensaje .='
							</tr>';
							foreach ($this->mode->Consultar("listarPaciente") as $k){
								if($k->status==1){
									$estado='Activo';
								}else{
									$estado='Inactivo';
								}

								$mensaje .= '
									<tr>
										<td>'.$k->cedula.'</td>
										<td>'.$k->nombres.' '.$k->apellidos.'</td>
										<td>'.$k->tlfno.'</td>
										<td>'.$k->email.'</td>
										<td>'.$estado.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=paciente&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
													<i class="bi bi-pencil-square"></i>
												</a>
											</td>
											';
										}
										if($this->accesoRegistrar){
											$mensaje .='
											<td>
												<a href="index.php?c=paciente&a=agendarCita&id='.$k->id.'" type="button" class="btn btn-outline-info">
													<i class="bi bi-calendar-check"></i>
												</a>
											</td>
											';
										}
										if($this->accesoRegistrar){
											$mensaje .='
											<td>
												<a href="index.php?c=paciente&a=asignarCondicion&id='.$k->id.'" type="button" class="btn btn-outline-info">
													<i class="bi bi-bag-heart"></i>
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

							$mensaje .= '
						</table>
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
										window.location.href="index.php?c=paciente&a=inhabilitar&id="+id;
									} else {
										//Si se cancela se emite un mensaje
										swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
									}
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

		public function buscarRegistro(){
			if($this->accesoConsultar){
				//$alm = new paciente_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				$this->alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroPaciente", $consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
					$this->alm->cedula = $resultados->cedula;
					$this->alm->nombres = $resultados->nombres;
					$this->alm->apellidos = $resultados->apellidos;
					$this->alm->telefono = $resultados->tlfno;
					$this->alm->correo = $resultados->email;
					$this->alm->status = $resultados->status;
					$this->alm->direccion = $resultados->direccion;
				}
				if($this->alm->status==1){
					$this->alm->estado='Activo';
				}else if($this->alm->status==0){
					$this->alm->estado='Inactivo';
				}

				//Output
				if($this->alm->id != ""){
					echo '<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<thead class="table-success">
										<th>Cédula</th>
										<th>Nombres Apellidos</th>
										<th>Teléfono</th>
										<th>Email</th>
										<th>Estado</th>';
										if($this->accesoModificar){
											$mensaje .='<th>EDITAR</th>';
										}
										if($this->accesoRegistrar){
											$mensaje .='<th>AGENDAR CITA</th>';
										}
										if($this->accesoRegistrar){
											$mensaje .='<th>CONDICION MÉDICA</th>';
										}
										if($this->accesoEliminar){
											$mensaje .='<th>ELIMINAR</th>';
										}
										$mensaje .='
									</thead>
								</tr>
								<tr>
									<td>'.$this->alm->cedula.'</td>
									<td>'.$this->alm->nombres.' '.$this->alm->apellidos.'</td>
									<td>'.$this->alm->telefono.'</td>
									<td>'.$this->alm->correo.'</td>
									<td>'.$this->alm->estado.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=paciente&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
												<i class="bi bi-pencil-square"></i>
											</a>
										</td>
										';
									}
									if($this->accesoRegistrar){
										$mensaje .='
										<td>
											<a href="index.php?c=paciente&a=agendarCita&id='.$this->alm->id.'" type="button" class="btn btn-outline-info">
												<i class="bi bi-calendar-check"></i>
											</a>
										</td>
										';
									}
									if($this->accesoRegistrar){
										$mensaje .='
										<td>
											<a href="index.php?c=paciente&a=asignarCondicion&id='.$this->alm->id.'" type="button" class="btn btn-outline-info">
												<i class="bi bi-bag-heart"></i>
											</a>
										</td>
										';
									}
									if($this->accesoEliminar){
										$mensaje .='
										<td>
											<button href="#" id="'.$this->alm->id.'" type="button" class="btn btn-outline-danger eliminar">
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
								},function(isConfirm) {
									if (isConfirm) {
										//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
										window.location.href="index.php?c=paciente&a=inhabilitar&id="+id;
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

		// public function cargarTablaCondicionMedica(){
		// 	if($this->accesoConsultar){
		// 		//$alm = new paciente_model();
		// 		$mensaje ="";
		// 		$mensaje .='
		// 			<div class="row">
		// 				<div class="col-md-12 text-center">
		// 					<h3>Condiciones médicas registradas</h3>
		// 				</div>
		// 			</div>

		// 			<div class="col-md-12 text-center">
		// 				<table class="table table-hover">
		// 					<tr class="table-secondary">
		// 						<th>Descripcion</th>
		// 						<th>Observación</th>
		// 						<th></th>
		// 						<th></th>
		// 					</tr>';

		// 					foreach ($this->mode->Consultar("listarCondicionMedicaPaciente", $this->alm->id) as $k){
		// 						$mensaje .= '
		// 							<tr>
		// 								<td>'.$k->descripcion.'</td>
		// 								<td>'.$k->observacion.'</td>
		// 								<td>
		// 									<button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
		// 										<i class="bi bi-trash"></i>
		// 									</button>
		// 								</td>
		// 							</tr>
		// 						';
		// 					}
		// 					$mensaje .= '
		// 				</table>
		// 			</div>

		// 			<script type="text/javascript">
		// 				$(document).ready(function(){
		// 					$(".eliminar").click(function(e){
		// 						console.log();
		// 						e.preventDefault();
		// 						var id = $(this).attr("id");
		// 						swal({
		// 							title: "Atención!!!",
		// 							text: "¿Esta seguro de eliminar el registro?!",
		// 							type: "warning",
		// 							showCancelButton: true,
		// 							confirmButtonClass: "btn-danger",
		// 							confirmButtonText: "Confirmar",
		// 							cancelButtonText: "Cancelar",
		// 							closeOnConfirm: false,
		// 							closeOnCancel: false
		// 						}, function(isConfirm) {
		// 							if (isConfirm) {
		// 								//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
		// 								window.location.href="index.php?c=paciente&a=eliminarCondicionMedica&id="+id;
		// 							} else {
		// 								//Si se cancela se emite un mensaje
		// 								swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
		// 							}
		// 						});
		// 					});
		// 				});
		// 			</script>
		// 		';
		// 		echo $mensaje;
		// 	}else{
		// 		return $this->vista("error");
		// 	}
		// }
	}
?>