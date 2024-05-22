<?php
	include_once "controller.php";
	class moduloController extends controller {
		/*public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Modulo";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/moduloModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new modulo_model();
			$this->alm = new modulo_model();

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
				$this->mode->Consultar("listarModulos");
			}else{
				return $this->vista("error");
			}
			
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("modulo");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarModulo", $_REQUEST['id']);
				return $this->vista("modulo/modificar");
			}else{
				return $this->vista("error");
			}
		}

		// GUARDAR PACIENTE
		public function guardar(){
			if($this->accesoRegistrar){
				$this->alm->nombre = ucwords(mb_strtolower($_POST['nombre']));
				foreach ($this->mode->Consultar("validarNombre", $_POST['nombre']) as $k){
					$this->alm->consulta = $k->nombre;
				}
				if(!$this->alm->consulta==""){
					echo "2";
					/*echo "<script>
						alert('Ya existe un registro con este modulo');
						history.back();
					</script>";*/
				}else{
					$this->mode->Registrar("registrarModulo", $this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
						alert('Modulo Registrado');
						setTimeout( function() { window.location.href = 'index.php?c=modulo'; }, 1000 );
	    			</script>";*/
				}
			}else{
				return $this->vista("error");
			}
		}

		// MODIFICAR PACIENTE
		public function modificar(){
			if($this->accesoModificar){
				$this->alm->id = $_POST['id'];
				$this->alm->nombre = ucwords(mb_strtolower($_POST['nombre']));
				//$this->alm->status = $_POST['status'];
				foreach ($this->mode->Consultar("validarId", $this->alm->id) as $k){
					$this->alm->consultaId = $k->nombre;
				}
				foreach ($this->mode->Consultar("validarNombre", $this->alm->nombre) as $k){
					$this->alm->consulta = $k->nombre;
				}
				if($this->alm->consulta==$this->alm->consultaId){
					$this->mode->Editar("editarModulo", $this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
	                alert('Modulo modificado');
	                 setTimeout( function() { window.location.href = 'index.php?c=modulo'; }, 1000 );
	    			</script>";*/
				}else if(!$this->alm->consulta == ""){
					echo "8";
					/*echo "<script>
						alert('Modulo no disponible');
						history.back();
	    			</script>";*/
				}else{
					$this->mode->Editar("editarModulo", $this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					/*echo "<script>
						alert('Modulo modificado');
						setTimeout( function() { window.location.href = 'index.php?c=modulo'; }, 1000 );
					</script>";*/
				}
			}else{
				return $this->vista("error");
			}
		}
		
		//ELIMINAR REGISTRO 
		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("inhabilitarModulo", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Modulo inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=modulo'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function habilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("habilitarModulo", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Modulo inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=modulo'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function eliminar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("eliminarModulo", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Modulo inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=modulo'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function verificarRegistroModulo(){
		//$alm = new consultorio_model();
		if($this->accesoConsultar){
		$consultaBusqueda = $_POST['valorBusqueda'];
		foreach ($this->mode->Consultar("buscarRegistroModulo", $consultaBusqueda) as $resultados) : 					
		$this->alm->id = $resultados->id;
    	endforeach;
    	if($this->alm->id != ""){
    		echo "
    			<div class='col-md-8'>
                <p style='color:Red;'> Modulo existe </p>
                </div>
    			";
    	}
    	}else{
				return $this->vista("error");
			}
				
		}















		
		public function cargarTablaModulos(){
			if($this->accesoConsultar){
				$mensaje ="";
				$mensaje .='
				<div class="row">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Modulos</h3>
						</div>
					</div>
				</div>	
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<th>Nombre</th>
									<th>Estado</th>';
									if($this->accesoModificar){
										$mensaje .='<th>EDITAR</th>';
									}
									if($this->accesoEliminar){
										$mensaje .='<th>ELIMINAR</th>';
									}
									$mensaje .='
								</tr>';
								foreach ($this->mode->Consultar("listarModulo") as $k){
									if($k->status==1){
										$estado='Activo';
									}else{
										$estado='Inactivo';
									}
									$mensaje .= '    
										<tr>
											<td>'.$k->nombre.' </td>
											<td>'.$estado.'</td>';
											if($this->accesoModificar){
												$mensaje .='
												<td>
													<a href="index.php?c=modulo&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
														<i class="bi bi-pencil-square"></i>
													</a>
												</td>';
											}
											if($this->accesoEliminar){
												$mensaje .='
												<td>
													<button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
																<i class="bi bi-trash"></i>       
													</button>
												</td>';
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
										window.location.href="index.php?c=modulo&a=inhabilitar&id="+id;
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
				$mensaje='';
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$this->alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroModulo", $consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
					$this->alm->nombre = $resultados->nombre;
					$this->alm->status = $resultados->status;
				}
				if($this->alm->status==1){
					$this->alm->estado='Activo';
				}else if($this->alm->status==0){
					$this->alm->estado='Inactivo';
				}

				//Output
				if($this->alm->id != ""){
					echo '
						<div class="row">
							<div class="row">
								<div class="col-md-12 text-center">
									<h3>Modulos</h3>
								</div>
							</div>
						</div>
							<div class="col-md-12 text-center">
								<table class="table table-hover">
									<tr class="table-secondary">
										<thead class="table-success">
											<th>Nombre de modulo</th>
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
										<td>'.$this->alm->nombre.' </td>
										<td>'.$this->alm->estado.' </td>';
										if($this->accesoModificar){
											$mensaje .='
											<td>
												<a href="index.php?c=modulo&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
													<i class="bi bi-pencil-square"></i>
												</a>
											</td>';
										}
										if($this->accesoEliminar){
											$mensaje .='
											<td>
												<button href="#" id="'.$this->alm->id.'" type="button" class="btn btn-outline-danger eliminar">
													<i class="bi bi-trash"></i>
												</button>
											</td>';
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
												window.location.href="index.php?c=modulo&a=inhabilitar&id="+id;
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