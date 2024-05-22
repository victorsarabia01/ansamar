<?php

	include_once "controller.php";
	class homeController extends controller {
		/*public $mode;
		public $rol;
		public $accesos;
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		public $nameControl = "Home";

		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/citaModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new cita_model();
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
			$parameter = "";
			if($_SESSION[NAME.'_cuenta']['nombre_rol']=="Superusuario" || $_SESSION[NAME.'_cuenta']['nombre_rol']=="Administrador"){
				$parameter = "";
			}else{
				$parameter = $_SESSION[NAME.'_consultorio']->id;
				//$parameter = '2';
			}
			$this->mode->Consultar("listarCitasParaHoy", $parameter);
			
		}
		

		public function index(){
			$this->bitacora->AnexarBitacora();
			return $this->vista("inicio");	
		}



























		
		
		public function tablaHome(){
				//$alm = new cita_model();
				//echo "<script> console.log('hola'); </script>";
				$mensaje ="";
				date_default_timezone_set("America/Caracas");
				$fecha_actual = date("d-m-Y");
				$parameter = "";
				if($_SESSION[NAME.'_cuenta']['nombre_rol']=="Superusuario" || $_SESSION[NAME.'_cuenta']['nombre_rol']=="Administrador"){
					$parameter = "";
				}else{
					$parameter = $_SESSION[NAME.'_consultorio']->id;
					//$parameter = '2';
				}
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
							foreach ($this->mode->Consultar("listarCitasParaHoy", $parameter) as $k){
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
		}

		public function buscarRegistro(){
			
				$alm = new cita_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				$mensaje="";
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
										<th>Odontólogo</th>
										
									
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
									<td>'.$alm->nombresDoctor.' '.$alm->apellidosDoctor.'</td>
									
									
									
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
		}

	}//FIN DE LA CLASE
?>