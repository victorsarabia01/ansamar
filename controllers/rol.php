<?php
	
	include_once "controller.php";
	class rolController extends controller {
		/*public $mode;
		public $permiso;
		public $modulo;
		public $accesos;*/
		public $nameControl = "Rol";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/permisoModel.php";
			require_once "models/moduloModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new rol_model();
			$this->alm = new rol_model();
			$this->permiso = new permiso_model();
			$this->modulo = new modulo_model();

			$idRol=$_SESSION[NAME.'_cuenta']['id_rol'];
			$this->accesos = $this->mode->Consultar("cargarAccesos", $idRol);
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
				$this->mode->Consultar("listarRoles");
			}else{
				return $this->vista("error");
			}
			
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("rol");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarRol", $_REQUEST['id']);
				$this->accesos = $this->mode->Consultar("cargarAccesos", $_REQUEST['id']);
				return $this->vista("rol/modificar");
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
						alert('Ya existe un registro con este rol');
						history.back();
					</script>";*/
				}else{
					$this->mode->Registrar("registrarRol", $this->alm);
					$this->bitacora->AnexarBitacora();
					$id = $this->mode->Consultar("getLastId", "rol", "id");
					$this->alm->id_rol=$id;
					for ($i=0; $i < count($_POST['accesos']); $i++) { 
						if(mb_strtolower($_POST['accesos'][$i])==mb_strtolower("On")){
							$this->alm->id_modulo=$_POST['id_modulo'][$i];
							$this->alm->id_permiso=$_POST['id_permiso'][$i];
							$this->mode->Registrar("registrarAcceso", $this->alm);
						}
					}
					echo "1";
					/*echo "<script>
						alert('Rol Registrado');
						setTimeout( function() { window.location.href = 'index.php?c=rol'; }, 1000 );
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
					$this->mode->Editar("editarRol", $this->alm);
					$this->bitacora->AnexarBitacora();
					$this->alm->id_rol=$_POST['id'];
					$this->mode->Eliminar("deleteAccesos", $_REQUEST['id']);
					for ($i=0; $i < count($_POST['accesos']); $i++) { 
						if(mb_strtolower($_POST['accesos'][$i])==mb_strtolower("On")){
							$this->alm->id_modulo=$_POST['id_modulo'][$i];
							$this->alm->id_permiso=$_POST['id_permiso'][$i];
							$this->mode->Registrar("registrarAcceso", $this->alm);
						}
					}
					echo "<script>
	                alert('Rol modificado');
	                 setTimeout( function() { window.location.href = 'index.php?c=rol'; }, 1000 );
	    			</script>";
				}else if(!$this->alm->consulta == ""){
					echo "<script>
						alert('Rol no disponible');
						history.back();
	    			</script>";
				}else{
					$this->mode->Editar("editarRol", $this->alm);
					$this->bitacora->AnexarBitacora();
					$this->alm->id_rol=$_POST['id'];
					$this->mode->Eliminar("deleteAccesos", $_REQUEST['id']);
					for ($i=0; $i < count($_POST['accesos']); $i++) { 
						if(mb_strtolower($_POST['accesos'][$i])==mb_strtolower("On")){
							$this->alm->id_modulo=$_POST['id_modulo'][$i];
							$this->alm->id_permiso=$_POST['id_permiso'][$i];
							$this->mode->Registrar("registrarAcceso", $this->alm);
						}
					}
					echo "<script>
						alert('Rol modificado');
						setTimeout( function() { window.location.href = 'index.php?c=rol'; }, 1000 );
					</script>";
				}
			}else{
				return $this->vista("error");
			}
		}
		
		//ELIMINAR REGISTRO 
		public function habilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("habilitarRol", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Rol inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=rol'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("inhabilitarRol", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Rol inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=rol'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function eliminar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("eliminarRol", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Rol inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=rol'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function verificarRegistroRol(){
		//$alm = new consultorio_model();
		if($this->accesoConsultar){
		$consultaBusqueda = $_POST['valorBusqueda'];
		foreach ($this->mode->Consultar("buscarRegistroRol", $consultaBusqueda) as $resultados) : 					
		$this->alm->id = $resultados->id;
    	endforeach;
    	if($this->alm->id != ""){
    		echo "
    			<div class='col-md-8'>
                <p style='color:Red;'> Rol existe </p>
                </div>
    			";
    	}
    	}else{
				return $this->vista("error");
			}
				
		}

		
		public function cargarTablaRoles(){
			if($this->accesoConsultar){
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Roles</h3>
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
						</tr>                 
						';
						foreach ($this->mode->Consultar("listarRol") as $k){
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
											<a href="index.php?c=rol&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
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
										window.location.href="index.php?c=rol&a=inhabilitar&id="+id;
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
				$consultaBusqueda = $_POST['valorBusqueda'];
				//echo '<option value="0">'.$id_turno.''.$id.'</option>';
				$this->alm->estado="";
				foreach ($this->mode->Consultar("buscarRegistroRol", $consultaBusqueda) as $resultados){
					//echo '<h5>'.$k->descripcion.'</h5>';
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
					echo '<div class="row">
						<div class="col-md-12 text-center">
							<table class="table table-hover">
								<tr class="table-secondary">
									<thead class="table-success">
										<th>Nombre del permiso</th>
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
											<a href="index.php?c=rol&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
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
											window.location.href="index.php?c=rol&a=inhabilitar&id="+id;
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

	}
?>