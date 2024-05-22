<?php
	include_once "controller.php";
    class condicionmedicaController extends controller{

       /* public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Condicion Medica";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/

        public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/condicionmedicaModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new condicionmedica_model();
			$this->alm = new condicionmedica_model();

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
				
				$this->mode->Consultar("listarCondicionMedica");
			}else{
				return $this->vista("error");
			}
		
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("condicionmedica");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->consultar("cargarCondicionMedica", ($_REQUEST['id']));
				return $this->vista("condicionmedica/modificar");
			}else{
				return $this->vista("error");
			}	
		}

		// GUARDAR CONDICIÓN MÉDICA
		public function guardar(){
			if($this->accesoRegistrar){
				//$alm = new condicionmedica_model();
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->observacion = $_POST['observacion'];

				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarCondicionMedica",$_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}

				if($this->alm->descripcion=="" || $this->alm->observacion=="" ){

				}else {

					if (!$this->alm->consulta == ""){
					echo "2";
					/*echo "<script>
						alert('Ya existe una condición médica con el mismo nombre');
						history.back();
					</script>";*/
				}else{
					$this->mode->Registrar("registrarCondicionMedica", $this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					//$this->mode->registrarCondicionMedica($alm);
					/*echo "<script>
						alert('Codición médica registrada');
						setTimeout( function() { window.location.href = 'index.php?c=condicionmedica'; }, 1000 );
					</script>";*/
				}

				}

				
			}else{
				return $this->vista("error");
			}
		}

		//ACTUALIZAR REGISTRO DE Condición Médica
		public function modificar(){
			if($this->accesoModificar){
				//$alm = new condicionmedica_model();
				$this->alm->id = $_POST['id'];
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->observacion = $_POST['observacion'];		
				//$this->alm->status = $_POST['status'];
				
				foreach ($this->mode->Consultar("verificarCondicionMedicaId",$_POST['id']) as $k){
					$this->alm->consulta1 = $k->descripcion;
				}
				foreach ($this->mode->Consultar("verificarCondicionMedicaNombre",$_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}

				if($this->alm->descripcion=="" || $this->alm->observacion=="" ){

				}else {

						if ($this->alm->descripcion==$this->alm->consulta1){
						$this->mode->Modificar("modificarCondicionMedica",$this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
					
					} else if (!$this->alm->consulta == "") {
						echo "8";
					
					}else{
						$this->mode->Modificar("modificarCondicionMedica",$this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
						
					}

				}
				
				
			}else{
				return $this->vista("error");
			}
		}

		//ELIMINACION LOGICA REGISTRO DE Condición Médica
		public function inhabilitar(){
			if($this->accesoEliminar){
				//$alm = new condicionmedica_model();
				$this->mode->Eliminar("inhabilitarCondicionMedica",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Condicion médica inhabilitada');
					setTimeout( function() { window.location.href = 'index.php?c=condicionmedica'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function habilitar(){
			if($this->accesoEliminar){
				//$alm = new condicionmedica_model();
				$this->mode->Eliminar("habilitarCondicionMedica",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Condicion médica inhabilitada');
					setTimeout( function() { window.location.href = 'index.php?c=condicionmedica'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function eliminar(){
			if($this->accesoEliminar){
				//$alm = new condicionmedica_model();
				$this->mode->Eliminar("eliminarCondicionMedica",$_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Condicion médica inhabilitada');
					setTimeout( function() { window.location.href = 'index.php?c=condicionmedica'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function buscarRegistro(){
			if($this->accesoConsultar){
				//$alm = new condicionmedica_model();
				$mensaje = '';
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$this->alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroCondicionMedica", $consultaBusqueda) as $resultados){
					//echo '<h5>'.$k->descripcion.'</h5>';
					$this->alm->id = $resultados->id;
					$this->alm->descripcion = $resultados->descripcion;
					$this->alm->observacion = $resultados->observacion;
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
											<th>Condición Médica</th>
											<th>Observaciones</th>
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
										<td>'.$this->alm->observacion.'</td>
										<td>'.$this->alm->estado.'</td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=condicionmedica&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
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
											//window.location.href="index.php?c=condicionmedicao&a=inhabilitar&id="+id;

											$.ajax({
										      type:"POST",
										      url:"index.php?c=condicionmedica&a=inhabilitar&id="+id,
										
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

		public function tablaCondicionMedica(){
			if($this->accesoConsultar){
				//$alm = new condicionmedica_model();
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Condiciones médicas</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<th>Tipo de condición médica</th>
									<th>Observaciones</th>
									<th>Estado</th>';
									if($this->accesoModificar){
										$mensaje .='<th>EDITAR</th>';
									}
									if($this->accesoEliminar){
										$mensaje .='<th>ELIMINAR</th>';
									}
									$mensaje .='
								</tr>';
								foreach ($this->mode->Consultar("listarCondicionMedica") as $k){
									if($k->status==1){
										$this->alm->estado='Activo';
									}else if($this->alm->status==0){
										$this->alm->estado='Inactivo';
									}
									$mensaje .= '
										<tr>
											<td>'.$k->descripcion.'</td>
											<td>'.$k->observacion.'</td>
											<td>'.$this->alm->estado.'</td>';
											if($this->accesoModificar){
												$mensaje .='
												<td>
													<a href="index.php?c=condicionmedica&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
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
										//window.location.href="index.php?c=condicionmedica&a=inhabilitar&id="+id;

										$.ajax({
										      type:"POST",
										      url:"index.php?c=condicionmedica&a=inhabilitar&id="+id,
										
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

		public function verificarRegistroCondicionMedica(){
			if($this->accesoConsultar){
				//$alm = new condicionmedica_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroCondicionMedica",$consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "<div class='col-md-8'>
						<p style='color:Red;'> Condición médica existe </p>
					</div>";
				}
			}else{
				return $this->vista("error");
			}
		}
	}

?>