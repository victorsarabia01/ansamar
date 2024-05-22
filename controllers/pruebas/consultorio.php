<?php

include_once "controller.php";

	class consultorioController extends controller {
		
		public $mode;
		public $rol;
		public $accesos;
		public $nameControl = "Consultorio";
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;

		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/ConsultorioModel.php";
			$this->mode = new consultorio_model();
			$this->alm = new consultorio_model();

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
				return $this->vista("consultorio");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarConsultorio", $_REQUEST['id']);
				return $this->vista("consultorio/modificar");
			}else{
				return $this->vista("error");
			}
		}
		public function guardar(){

			$this->alm->descripcion = $_POST['descripcion'];
			$this->alm->direccion = $_POST['direccion'];
			$this->alm->tlfno = $_POST['telefono'];
			$this->alm->silla = $_POST['sillas'];
			
		//VALIDACIONES BACKEND
		foreach ($this->mode->Consultar("verificarConsultorio", $_POST['descripcion']) as $k) : 
					$this->alm->consulta = $k->id;
			endforeach; 
		
		if (!$this->alm->consulta == "") {
			echo "2";
			/*echo "<script>
                alert('Ya existe un Consultorio con el Mismo Nombre');
                 history.back();
    			</script>";*/

		}else{

			$this->mode->Registrar("registrarConsultorio", $this->alm);
			echo ('1');
				/*echo "<script>
                alert('Consultorio registrado');
                 setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
    			</script>";*/

			
		}

			
		}
		/*public function guardar(){
			if($this->accesoRegistrar){
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->tlfno = $_POST['telefono'];
				$this->alm->silla = $_POST['sillas'];
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarConsultorio", $_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}
				if (!$this->alm->consulta == ""){
					echo "<script>
						alert('Ya existe un Consultorio con el Mismo Nombre');
						history.back();
					</script>";
				}else{
					$this->mode->Registrar("registrarConsultorio", $this->alm);
					echo "<script>
						alert('Consultorio registrado');
						setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}*/

		public function modificar(){
			if($this->accesoModificar){
				//$alm = new consultorio_model();
				$this->alm->id = $_POST['id'];
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->telefono = $_POST['telefono'];	
				$this->alm->status = $_POST['status'];
				$this->alm->silla = $_POST['sillas'];

				foreach ($this->mode->Consultar("verificarConsultorioId", $_POST['id']) as $k){
					$this->alm->consulta1 = $k->descripcion;
				}
				foreach ($this->mode->Consultar("verificarConsultorioNombre", $_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}

				if ($this->alm->descripcion==$this->alm->consulta1){
					$this->mode->Modificar("modificarConsultorio", $alm);
					echo "<script>
						alert('Consultorio modificado');
						setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
					</script>";
				}else if(!$this->alm->consulta == ""){
					echo "<script>
						alert('Ya existe un Consultorio con el Mismo Nombre');
						history.back();
					</script>";
				}else{
					$this->mode->Modificar("modificarConsultorio", $this->alm);
					echo "<script>
						alert('Consultorio modificado');
						setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("inhabilitarConsultorio", $_REQUEST['id']);
				echo "<script>
					alert('Consultorio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
				</script>";
			}else{
				return $this->vista("error");
			}
		}

		public function buscarRegistro(){
			if($this->accesoConsultar){
				//$alm = new consultorio_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroConsultorio", $consultaBusqueda) as $resultados){
					$alm->id = $resultados->id;
					$alm->descripcion = $resultados->descripcion;
					$alm->direccion = $resultados->direccion;
					$alm->telefono = $resultados->tlfno;
					$alm->sillas = $resultados->sillas;
					$alm->status = $resultados->status;
				}
				if($alm->status==1){
					$alm->estado='Activo';
				}else if($alm->status==0){
					$alm->estado='Inactivo';
				}
				//Output
				if($alm->id != ""){
					echo '<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<thead class="table-success">
										<th>Consultorio</th>
										<th>Dirección</th>
										<th>Teléfono</th>
										<th>Sillas</th>
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
									<td>'.$alm->descripcion.'</td>
									<td>'.$alm->direccion.'</td>
									<td>'.$alm->telefono.'</td>
									<td>'.$alm->sillas.'</td>
									<td>'.$alm->estado.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=consultorio&a=editar&id='.$alm->id.'" type="button" class="btn btn-outline-primary">
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
										window.location.href="index.php?c=consultorio&a=inhabilitar&id="+id;
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

		public function cargarTablaConsultorios(){
			if($this->accesoConsultar){
				//$alm = new consultorio_model();
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Consultorios</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover" id="mitabla">
								<thead>
									<tr class="table-secondary">
										<th>Consultorio</th>
										<th>Dirección</th>
										<th>Teléfono</th>
										<th>Sillas</th>
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
									foreach ($this->mode->Consultar("listarConsultorios") as $k){
										if($k->status==1){
											$this->alm->estado='Activo';
										}else if($this->alm->status==0){
											$this->alm->estado='Inactivo';
										}
										$mensaje .= '
										
										<tr>
											<td>'.$k->descripcion.'</td>
											<td>'.$k->direccion.'</td>
											<td>'.$k->tlfno.'</td>
											<td>'.$k->sillas.'</td>
											<td>'.$this->alm->estado.'</td>';
											if($this->accesoModificar){
												$mensaje .='
												<td>
													<a href="index.php?c=consultorio&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
															<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
															<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
														</svg>
													</a>
												</td>
												';
											}
											if($this->accesoEliminar){
												$mensaje .='
												<td>
													<button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
															<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
															<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
														</svg>
													</button>
												</td>
												';
											}
											$mensaje .='
										</tr>
										';
									}
								$mensaje .= '</tbody>
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
								},
								function(isConfirm) {
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
				echo $mensaje;
			}else{
				return $this->vista("error");
			}
		}

		public function recargarDatosConsultorio(){
			if($this->accesoConsultar){
				$alm = $this->mode->Consultar("listarConsultorios");
				$k=$alm;
			}else{
				return $this->vista("error");
			}
		}

		public function cargarConsultoriosAjax(){
			if($this->accesoConsultar){
				$this->mode->Consultar("listarConsultoriosAjax");
				echo json_encode(['data' => $this->mode->Consultar("listarConsultoriosAjax"),]);
			}else{
				return $this->vista("error");
			}
		}

		public function verificarRegistroConsultorio(){
			if($this->accesoConsultar){
				//$alm = new consultorio_model();
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroConsultorio", $consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "<div class='col-md-8'>
						<p style='color:Red;'> Consultorio Ya Registrado </p>
					</div>";
				}
			}else{
				return $this->vista("error");
			}
		}

	}
?>