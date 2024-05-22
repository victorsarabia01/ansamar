<?php
	
	include_once "controller.php";
    class tipoempleadoController extends controller {

		/*public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Tipo De Empleado";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/

        public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/tipoempleadoModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new tipoempleado_model();
			$this->alm = new tipoempleado_model();

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
				
				$this->mode->Consultar("listarTipoEmpleado");
			}else{
				return $this->vista("error");
			}
		
		}
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("tipoempleado");	
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarTipoEmpleado", ($_REQUEST['id']));
				return $this->vista("tipoempleado/modificar");
			}else{
				return $this->vista("error");
			}
		}

		// GUARDAR TIPO EMPLEADO
		public function guardar(){
			if($this->accesoRegistrar){
				//$alm = new tipoempleado_model();
				$this->alm->descripcion = $_POST['descripcion'];
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarTipoEmpleado1",$_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}

				if($this->alm->descripcion==""){

				}else {

					if (!$this->alm->consulta == ""){
						echo "2";
						/*echo "<script>
							alert('Ya existe un tipo de empleado con el Mismo Nombre');
							history.back();
						</script>";*/
					} else {
						$this->mode->Registrar("registrarTipoEmpleado",$this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
						/*echo "<script>
							alert('Tipo de empleado registrado');
							setTimeout( function() { window.location.href = 'index.php?c=tipoempleado'; }, 1000 );
						</script>";*/
					}

				}
				
			}else{
				return $this->vista("error");
			}
		}

		//ACTUALIZAR REGISTRO DE TIPO DE EMPLEADO
		public function modificar(){
			if($this->accesoModificar){
				//$alm = new tipoempleado_model();
				$this->alm->id = $_POST['id'];
				$this->alm->descripcion = $_POST['descripcion'];	
				//$this->alm->status = $_POST['status'];
				foreach ($this->mode->Consultar("verificarTipoEmpleado",$_POST['id']) as $k){
					$this->alm->consulta1 = $k->descripcion;
				}
				foreach ($this->mode->Consultar("verificarTipoEmpleado1",$_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}


				if($this->alm->descripcion==""){

				}else {

					if ($this->alm->descripcion==$this->alm->consulta1){
					$this->mode->Modificar("modificarTipoEmpleado",$this->alm);
					echo "1";
					/*echo "<script>
						alert('Tipo de empleado modificado');
						setTimeout( function() { window.location.href = 'index.php?c=tipoempleado'; }, 1000 );
					</script>";*/
				} else if (!$this->alm->consulta == "") {
					echo "8";
					/*echo "<script>
						alert('Ya existe un registro con el mismo nombre');
						history.back();
					</script>";*/
				}else{
					$this->mode->Modificar("modificarTipoEmpleado",$this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
						alert('Tipo de empleado modificado');
						setTimeout( function() { window.location.href = 'index.php?c=tipoempleado'; }, 1000 );
					</script>";*/
				}

				}

				
			}else{
				return $this->vista("error");
			}
		}

		//ELIMINACION LOGICA REGISTRO DE TIPO EMPLEADO
		public function inhabilitar(){
			if($this->accesoEliminar){
				//$alm = new tipoempleado_model();
				$this->mode->Eliminar("inhabilitarTipoEmpleado",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Tipo de empleado inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=tipoempleado'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function habilitar(){
			if($this->accesoEliminar){
				//$alm = new tipoempleado_model();
				$this->mode->Eliminar("habilitarTipoEmpleado",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Tipo de empleado inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=tipoempleado'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function eliminar(){
			if($this->accesoEliminar){
				//$alm = new tipoempleado_model();
				$this->mode->Eliminar("EliminarTipoEmpleado",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Tipo de empleado inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=tipoempleado'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function tablaTipoEmpleado(){
			if($this->accesoConsultar){
				//$alm = new tipoempleado_model();
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Tipos de empleados</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<th>Tipo de Empleado</th>
									<th>Estado</th>';
									if($this->accesoModificar){
										$mensaje .='<th>EDITAR</th>';
									}
									if($this->accesoEliminar){
										$mensaje .='<th>ELIMINAR</th>';
									}
									$mensaje .='
								</tr>';
								foreach ($this->mode->Consultar("listarTipoEmpleado") as $k){
									if($k->status==1){
										$this->alm->estado='Activo';
									}else if($this->alm->status==0){
										$this->alm->estado='Inactivo';
									}
									$mensaje .= '
										<tr>
											<td>'.$k->descripcion.'</td>
											<td>'.$this->alm->estado.'</td>';
											if($this->accesoModificar){
												$mensaje .='
												<td>
													<a href="index.php?c=tipoempleado&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
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
										//window.location.href="index.php?c=tipoempleado&a=inhabilitar&id="+id;

										$.ajax({
										      type:"POST",
										      url:"index.php?c=tipoempleado&a=inhabilitar&id="+id,
										
										      success:function(r){
										        if(r==1){
										 
										          swal("Atención!", "Registro Eliminado", "warning")
										          
										        }else {
										          swal("Atención!", "Error al eliminar", "error")
										        }
										      }

										});
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

		//BUSCAR LA TABLA DEL BUSCADOR
		public function buscarRegistro(){
			if($this->accesoConsultar){
				$mensaje='';
				//$alm = new tipoempleado_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$this->alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroTipoEmpleado",$consultaBusqueda) as $resultados){
					//echo '<h5>'.$k->descripcion.'</h5>';
					$this->alm->id = $resultados->id;
					$this->alm->descripcion = $resultados->descripcion;
					$this->alm->status = $resultados->status;
				}
				if($this->alm->status==1){
					$this->alm->estado='Activo';
				}else if($this->alm->status==0){
					$this->alm->estado='Inactivo';
				}
				//Output
				if($this->alm->id != ""){
					$mensaje.= '
						<div class="row">
							<div class="col-md-12 text-center">
								<table class="table table-hover">
									<tr class="table-secondary">
										<thead class="table-success">
											<th>Tipo de Empleado</th>
											<th>Estado</th>';
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
										<td>'.$this->alm->descripcion.'</td>
										<td>'.$this->alm->estado.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=tipoempleado&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
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
											//window.location.href="index.php?c=tipoempleado&a=inhabilitar&id="+id;

										$.ajax({
										      type:"POST",
										      url:"index.php?c=tipoempleado&a=inhabilitar&id="+id,
										
										      success:function(r){
										        if(r==1){
										 
										          swal("Atención!", "Registro Eliminado", "warning")
										          
										        }else {
										          swal("Atención!", "Error al eliminar", "error")
										        }
										      }

										});

										} else {
											//Si se cancela se emite un mensaje
											swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
										}
									});
								});
							});
						</script>
					';
				}echo $mensaje;
			}else{
				return $this->vista("error");
			}
		}

		public function verificarRegistroTipoEmpleado(){
			if($this->accesoConsultar){
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroTipoEmpleado",$consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "
						<div class='col-md-8'>
							<p style='color:Red;'> Tipo de empleado ya registrado </p>
						</div>
					";
				}
			}else{
				return $this->vista("error");
			}
		}
	}


?>