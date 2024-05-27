<?php
	
	include_once "controller.php";
	
	class empleadoController extends controller {
		/*public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Empleado";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/

		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/empleadoModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new empleado_model();
			$this->alm = new empleado_model();

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
				$this->mode->Consultar("listarEmpleado");	
			}else{
				return $this->vista("error");
			}
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("empleado");	
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				//$this->alm = $this->mode->()cargarEmpleado($_REQUEST['id']);
				$this->alm = $this->mode->Consultar("cargarEmpleado", (base64_decode($_REQUEST['id'])));
				return $this->vista("empleado/modificar");
			}else{
				return $this->vista("error");
			}
		}
		
		// GUARDAR EMPLEADO
		public function guardar(){
			if($this->accesoRegistrar){
				//$alm = new empleado_model();
				$this->alm->cedula = $_POST['cedula'];
				$this->alm->nombres = ucwords(mb_strtolower($_POST['nombres']));
				$this->alm->apellidos = ucwords(mb_strtolower($_POST['apellidos']));
				$this->alm->fechaNacimiento = $_POST['fecha'];
				$this->alm->correo = $_POST['email'];
				$this->alm->codtlfn = $_POST['codtlfn'];
				$this->alm->telefono = $_POST['telefono'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->tipo_empleado = $_POST['empleado'];

				$fechaSeleccionada = date($this->alm->fechaNacimiento);
				$fechaFormat = strtotime($fechaSeleccionada);
				$anoSeleccionado = (int) date('Y',$fechaFormat);
				$anoActual=(int) date("Y");

				//echo $anoActual;
				foreach ($this->mode->Consultar("validarCedula",$_POST['cedula']) as $k){
					$this->alm->consulta = $k->consulta;
				}

				if ($this->alm->tipo_empleado==0 || $this->alm->telefono== '' || $this->alm->correo== '' || $this->alm->direccion== '' ){
					/*echo   "<script>  
						alert('Debe seleccionar todas las opciones');
						history.back();
					</script>";*/
				}else{
					if(!$this->alm->consulta==""){
						echo "2";
						/*echo "<script>
							alert('Ya existe un registro con esta cédula');
							history.back();
						</script>";*/
					}else if($anoActual-$anoSeleccionado < 18){
						echo "3";
						/*echo "<script>
							alert('No es permitido personal menor a 18 años');
							history.back();
						</script>";*/
					}else{
						$this->mode->Registrar("registrarEmpleado",$this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
						/*echo "<script>
							alert('Empleado registrado');
							setTimeout( function() { window.location.href = 'index.php?c=empleado'; }, 1000 );
						</script>";
*/
					}
				}
			}else{
				return $this->vista("error");
			}
		}
		
		//MODIFICAR EMPLEADO
		public function modificar(){
			if($this->accesoModificar){
				//$alm = new empleado_model();
				$this->alm->id = $_POST['id'];
				$this->alm->cedula = $_POST['cedula'];
				$this->alm->nombres = ucwords(mb_strtolower($_POST['nombres']));
				$this->alm->apellidos = ucwords(mb_strtolower($_POST['apellidos']));
				$this->alm->fechaNacimiento = $_POST['fecha'];
				$this->alm->correo = $_POST['email'];
				$this->alm->codtlfn = $_POST['codtlfn'];
				$this->alm->telefono = $_POST['telefono'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->tipo_empleado = $_POST['empleado'];
				//$this->alm->status = $_POST['status'];


				$fechaSeleccionada = date($this->alm->fechaNacimiento);
				$fechaFormat = strtotime($fechaSeleccionada);
				$anoSeleccionado = date ('Y',$fechaFormat);
				$anoActual=date("Y");

				foreach ($this->mode->Consultar("verificarEmpleado",$this->alm->id) as $k){
					$this->alm->consulta1 = $k->cedula;
				}
				foreach ($this->mode->Consultar("verificarEmpleado1",$this->alm->cedula) as $k){
					$this->alm->consulta = $k->id;
				}

				if($anoActual-$anoSeleccionado < 18){
					echo "<script>
						alert('No es permitido personal menor a 18 años');
						history.back();
					</script>";
				}else{
					if ($this->alm->cedula==$this->alm->consulta1){
						$this->mode->Modificar("modificarEmpleado",$this->alm);
						$this->bitacora->AnexarBitacora();
						echo "<script>
							alert('Empleado modificado');
							setTimeout( function() { window.location.href = 'index.php?c=empleado'; }, 1000 );
						</script>";
					} else if (!$this->alm->consulta == "") {
						echo "<script>
							alert('Ya existe un empleado con la misma cédula');
							history.back();
						</script>";
					}else{
						$this->mode->Modificar("modificarEmpleado",$this->alm);
						$this->bitacora->AnexarBitacora();
						echo "<script>
							alert('Empleado modificado');
							setTimeout( function() { window.location.href = 'index.php?c=empleado'; }, 1000 );
						</script>";
					}
				}
			}else{
				return $this->vista("error");
			}
		}

		//ELIMINAR REGISTRO DE EMPLEADO
		public function eliminar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("deleteEmpleado",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Empleado inhabilitado');
					//swal('Empleado Inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=empleado'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("inhabilitarEmpleado", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
			}else{
				return $this->vista("error");
			}
		}

		public function habilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("habilitarEmpleado", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
			}else{
				return $this->vista("error");
			}

		}
		
		public function verificarRegistroEmpleado(){
			if($this->accesoConsultar){
				//$alm = new empleado_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("consultarRegistroEmpleado",$consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "
						<div class='col-md-8'>
							<p style='color:Red;'> Cédula no disponible </p>
						</div>
					";
				}
			}else{
				return $this->vista("error");
			}
		}



















































		public function cargarEmpleados(){
			if($this->accesoConsultar){
				//$alm = new empleado_model();
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Empleados</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<th>Empleado</th>
									<th>Cédula</th>
									<th>Nombres Apellidos</th>
									<th>Teléfono</th>
									<th>Estado</th>';
									if($this->accesoModificar){
										$mensaje .='<th>EDITAR</th>';
									}
									if($this->accesoEliminar){
										$mensaje .='<th>ELIMINAR</th>';
									}
									$mensaje .='
								</tr>';
								foreach ($this->mode->Consultar("listarEmpleado") as $k){
									if($k->status==1){
										$this->alm->estado='Activo';
									}else if($this->alm->status==0){
										$this->alm->estado='Inactivo';
									}
									$mensaje .= '<tr>
										<td>'.$k->tipo_empleado.'</td>
										<td>'.$k->cedula.'</td>
										<td>'.$k->nombres.' '.$k->apellidos.'</td>
										<td>'.$k->tlfno.'</td>
										<td>'.$this->alm->estado.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=empleado&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
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
								$mensaje .= '
							</table>
						</div>
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
										window.location.href="index.php?c=empleado&a=inhabilitar&id="+id;
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
				//$alm = new empleado_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$this->alm->estado="";
				foreach ($this->mode->buscarRegistroEmpleado($consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
					$this->alm->tipo_empleado = $resultados->tipo_empleado;
					$this->alm->cedula = $resultados->cedula;
					$this->alm->nombres = $resultados->nombres;
					$this->alm->apellidos = $resultados->apellidos;
					$this->alm->tlfno = $resultados->tlfno;
					$this->alm->status = $resultados->status;
				}
				if($this->alm->status==1){
					$this->alm->estado='Activo';
				}else if($this->alm->status==0){
					$this->alm->estado='Inactivo';
				}

				if($this->alm->id != ""){
					echo '
						<div class="row">
							<div class="col-md-12 text-center">
								<table class="table table-hover">
									<thead class="table-success">
										<tr class="table-secondary">
											<th>Empleado</th>
											<th>Cédula</th>
											<th>Nombres Apellidos</th>
											<th>Teléfono</th>
											<th>Estado</th>';
											if($this->accesoModificar){
												$mensaje .='<th>EDITAR</th>';
											}
											if($this->accesoEliminar){
												$mensaje .='<th>ELIMINAR</th>';
											}
											$mensaje .='
										</tr>
									</thead>
									<tr>
										<td>'.$this->alm->tipo_empleado.'</td>
										<td>'.$this->alm->cedula.'</td>
										<td>'.$this->alm->nombres.' '.$this->alm->apellidos.'</td>
										<td>'.$this->alm->tlfno.'</td>
										<td>'.$this->alm->estado.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=empleado&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
													<i class="bi bi-pencil-square"></i>
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
									}, function(isConfirm) {
										if (isConfirm) {
											//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
											window.location.href="index.php?c=consultorio&a=inhabilitar&id="+id;
										} else {
											//Si se cancela se emite un mensaje
											swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
										}
									});
								});
							});
						</script>
					';
				}
			}else{
				return $this->vista("error");
			}
		}
	}
?>