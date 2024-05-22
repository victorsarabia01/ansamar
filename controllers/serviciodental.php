 <?php

include_once "controller.php";
	
	class servicioDentalController extends controller {

		/*public $mode;
		public $rol;*/
		public $accesos;
		public $nameControl = "Servicio Dental";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/serviciodentalModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new serviciodental_model();
			$this->alm = new serviciodental_model();

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
				
				$this->mode->Consultar("listarServicioDental");
			}else{
				return $this->vista("error");
			}
		
		}
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				// echo "asd";
				return $this->vista("servicioDental");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarServicioDental", ($_REQUEST['id']));
				return $this->vista("servicioDental/modificar");	
			}else{
				return $this->vista("error");
			}
		}

		// GUARDAR SERVICIO DENTAL
		public function guardar(){
			if($this->accesoRegistrar){
				//$alm = new serviciodental_model();
				$this->alm->nombre = $_POST['nombre'];
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->precio = $_POST['precio'];
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarServicioDental",$_POST['nombre']) as $k){
					$this->alm->consulta = $k->id;
				}
				if (!$this->alm->consulta == "") {
					echo "2";
					/*echo "<script>
						alert('Ya existe el registro');
						history.back();
					</script>";*/
				}else if($this->alm->nombre == "" || $this->alm->descripcion== "" || $this->alm->precio == ""){
					echo "2";
				}else{
					$this->mode->Registrar("registrarServicioDental",$this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
						alert('Servicio registrado');
						setTimeout( function() { window.location.href = 'index.php?c=serviciodental'; }, 1000 );
					</script>";*/
				}
			}else{
				return $this->vista("error");
			}
		}

		public function modificar(){
			if($this->accesoModificar){
				//$alm = new serviciodental_model();
				$this->alm->id = $_POST['id'];
				$this->alm->nombre = $_POST['nombre'];
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->precio = $_POST['precio'];
				//$this->alm->status = $_POST['status'];
				foreach ($this->mode->Consultar("verificarServicioId",$_POST['id']) as $k){
					$this->alm->consulta1 = $k->nombre;
				}
				foreach ($this->mode->Consultar("verificarServicioNombre",$_POST['nombre']) as $k){
					$this->alm->consulta = $k->id;
				}
				if ($this->alm->nombre==$this->alm->consulta1) {
					$this->mode->Modificar("modificarServicioDental",$this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
						alert('Servicio dental modificado');
						setTimeout( function() { window.location.href = 'index.php?c=serviciodental'; }, 1000 );
					</script>";*/
				} else if (!$this->alm->consulta == "") {
					echo "8";
					/*echo "<script>
						alert('Ya existe un servicio con el mismo nombre');
						history.back();
					</script>";*/
				}else{
					$this->mode->Modificar("modificarServicioDental",$this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
						alert('Servicio dental modificado');
						setTimeout( function() { window.location.href = 'index.php?c=serviciodental'; }, 1000 );
					</script>";*/
				}
			}else{
				return $this->vista("error");
			}
		}

		public function inhabilitar(){
			if($this->accesoEliminar){
				//$alm = new serviciodental_model();
				$this->mode->Eliminar("inhabilitarServicioDental",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Servicio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=serviciodental'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function habilitar(){
			if($this->accesoEliminar){
				//$alm = new serviciodental_model();
				$this->mode->Eliminar("habilitarServicioDental",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Servicio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=serviciodental'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function eliminar(){
			if($this->accesoEliminar){
				//$alm = new serviciodental_model();
				$this->mode->Eliminar("eliminarServicioDental",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Servicio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=serviciodental'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function buscarRegistro(){
			if($this->accesoConsultar){
				//$alm = new serviciodental_model();
				$mensaje="";
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$this->alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroServicioDental",$consultaBusqueda) as $resultados){
					//echo '<h5>'.$k->descripcion.'</h5>';
					$this->alm->id = $resultados->id;
					$this->alm->descripcion = $resultados->descripcion;
					$this->alm->nombre = $resultados->nombre;
					$this->alm->precio = $resultados->precio;
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
						<div class="row">
							<div class="col-md-12 text-center">
								
							</div>
						</div>
					</div>
							<div class="col-md-12 text-center">
								<table class="table table-hover">
									<tr class="table-secondary">
										<thead class="table-success">
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Precio</th>
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
										<td>'.$this->alm->nombre.'</td>
										<td>'.$this->alm->descripcion.'</td>
										<td>'.$this->alm->precio.'</td>
										<td>'.$this->alm->estado.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=serviciodental&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
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
											//window.location.href="index.php?c=serviciodental&a=inhabilitar&id="+id;

										$.ajax({
										      type:"POST",
										      url:"index.php?c=serviciodental&a=inhabilitar&id="+id,
										
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

		public function tablaServicioDental(){
			if($this->accesoConsultar){
				$mensaje ="";
				$mensaje .='
				<div class="row">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Servicios dentales</h3>
						</div>
					</div>
				</div>	
						<div class="col-md-12 text-center">
							<table class="table table-hover" id="mitabla">
								<thead>
									<tr class="table-secondary">
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Precio</th>
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
								<tbody>';
									foreach ($this->mode->Consultar("listarServicioDental") as $k){
										if($k->status==1){
											$this->alm->estado='Activo';
										}else if($this->alm->status==0){
											$this->alm->estado='Inactivo';
										}
										$mensaje .= '    
											<tr>
												<td>'.$k->nombre.'</td>
												<td>'.$k->descripcion.'</td>
												<td>'.$k->precio.'</td>             		
												<td>'.$this->alm->estado.'</td>';
												if($this->accesoModificar){
													$mensaje .='
													<td>
														<a href="index.php?c=serviciodental&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
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
								</tbody>
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
										//window.location.href="index.php?c=serviciodental&a=inhabilitar&id="+id;

										$.ajax({
										      type:"POST",
										      url:"index.php?c=serviciodental&a=inhabilitar&id="+id,
										
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

		public function verificarRegistroServicioDental(){
			if($this->accesoConsultar){
				//$alm = new serviciodental_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroServicioDental",$consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "
						<div class='col-md-8'>
							<p style='color:Red;'> servicio ya registrado </p>
						</div>
					";
				}
			}else{
				return $this->vista("error");
			}
		}

	}
?>