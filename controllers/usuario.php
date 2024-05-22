<?php
	
	include_once "controller.php";

	class usuarioController extends controller {
		//public $mode;
		public $rol;
		public $empleado;
		//public $accesos;
		public $nameControl = "Usuario";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		
		public function __construct(){
			require_once "models/usuarioModel.php";
			require_once "models/rolModel.php";
			require_once "models/empleadoModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new usuario_model();
			$this->alm = new usuario_model();
			$this->empleado = new empleado_model();
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
				$this->mode->Consultar("listarUsuarios");
			}else{
				return $this->vista("error");
			}
			
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("usuario");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarUsuario", $_REQUEST['id']);
				return $this->vista("usuario/modificar");
			}else{
				return $this->vista("error");
			}
		}

		// GUARDAR USUARIO
		public function guardar(){
			if($this->accesoRegistrar){
				$this->alm->id_empleado = $_POST['empleado'];
				$this->alm->id_rol = $_POST['rol'];
				$this->alm->usuario = ucwords(mb_strtolower($_POST['usuario']));
				$this->alm->password = $_POST['password'];
				$this->alm->passwordd = $_POST['passwordd'];
				$this->alm->codigo = $_POST['codigo'];
				$this->alm->codigoo = $_POST['codigoo'];
				$this->alm->pregunta1 = $_POST['pregunta1'];
				$this->alm->respuesta1 = $_POST['respuesta1'];
				$this->alm->pregunta2 = $_POST['pregunta2'];
				$this->alm->respuesta2 = $_POST['respuesta2'];

				$this->alm->passwordEncriptada = password_hash($_POST['password'], PASSWORD_DEFAULT) ;


				foreach ($this->mode->Consultar("validarNombreUsuario", $this->alm->usuario) as $k){
					$this->alm->consulta = $k->usuario;
				}

				if($this->alm->password=="" || $this->alm->codigo=="" || $this->alm->pregunta1==""){
					echo "2";
				}else if($this->alm->password != $this->alm->passwordd || $this->alm->codigo != $this->alm->codigoo){
					echo "7";
				
				} else if(!$this->alm->consulta==""){
					echo "2";
					
				}else{
					$this->mode->Registrar("registrarUsuario", $this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
				
				}
			}else{
				return $this->vista("error");
			}
		}

		// MODIFICAR PACIENTE
		public function modificar(){
			if($this->accesoModificar){
				$this->alm->id = $_POST['id'];
				//$this->alm->id_empleado = $_POST['empleado'];
				$this->alm->id_rol = $_POST['rol'];
				$this->alm->usuario = ucwords(mb_strtolower($_POST['usuario']));
				$this->alm->password = $_POST['password'];
				$this->alm->passwordd = $_POST['passwordd'];
				$this->alm->codigo = $_POST['codigo'];
				$this->alm->codigoo = $_POST['codigoo'];
				$this->alm->pregunta1 = $_POST['pregunta1'];
				$this->alm->respuesta1 = $_POST['respuesta1'];
				$this->alm->pregunta2 = $_POST['pregunta2'];
				$this->alm->respuesta2 = $_POST['respuesta2'];

				$this->alm->passwordEncriptada = password_hash($_POST['password'], PASSWORD_DEFAULT) ;
				//$this->alm->status = $_POST['status'];

				foreach ($this->mode->Consultar("validarId", $this->alm->id) as $k){
					$this->alm->consultaId = $k->usuario;
				}
				foreach ($this->mode->Consultar("validarNombreUsuario", $this->alm->usuario) as $k){
					$this->alm->consulta = $k->usuario;
				}

				if($this->alm->password=="" || $this->alm->codigo=="" || $this->alm->pregunta1==""){
					echo "11";
				}else{



					if($this->alm->password != $this->alm->passwordd || $this->alm->codigo != $this->alm->codigoo){
						echo "9";
					/*echo "<script>
						alert('Las contraseñas no coinciden');
						history.back();
						</script>";*/
					} else if($this->alm->consulta==$this->alm->consultaId){
						$this->mode->Editar("editarUsuario", $this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
					/*echo "<script>
						alert('Usuario modificado');
						setTimeout( function() { window.location.href = 'index.php?c=usuario'; }, 1000 );
						</script>";*/
					}else if(!$this->alm->consulta == ""){
						echo "10";
					/*echo "<script>
						alert('Usuario no disponible');
						history.back();
						</script>";*/
					}else{
						$this->mode->Editar("editarUsuario", $this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
					/*echo "<script>
						alert('Usuario modificado');
						setTimeout( function() { window.location.href = 'index.php?c=usuario'; }, 1000 );
						</script>";*/
					}



				}
				
				}else{
				return $this->vista("error");
			}
		}

		//ELIMINAR REGISTRO 
		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("inhabilitarUsuario", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Usuario inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=usuario'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function habilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("habilitarUsuario", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Usuario inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=usuario'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}
		public function eliminar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("eliminarUsuario", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Usuario inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=usuario'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function verificarRegistroUsuario(){
		//$alm = new consultorio_model();
		if($this->accesoConsultar){
		$consultaBusqueda = $_POST['valorBusqueda'];
		foreach ($this->mode->Consultar("buscarRegistroUsuario1", $consultaBusqueda) as $resultados) : 					
		$this->alm->id = $resultados->id;
    	endforeach;
    	if($this->alm->id != ""){
    		echo "
    			<div class='col-md-8'>
                <p style='color:Red;'> Usuario existe </p>
                </div>
    			";
    	}
    	}else{
				return $this->vista("error");
			}
				
		}
















































		
		
		public function cargarTablaUsuarios(){
			if($this->accesoConsultar){
				$mensaje ="";
				$mensaje .='
					<div class="row">
						<div class="col-md-12 text-center">
							<h3>Usuarios</h3>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<table class="table table-hover">
							<tr class="table-secondary">
								<th>Empleado</th>
								<th>Usuario</th>
								<th>Rol</th>
								<th>Estado</th>';
								if($this->accesoModificar){
									$mensaje .='<th>EDITAR</th>';
								}
								if($this->accesoEliminar){
									$mensaje .='<th>ELIMINAR</th>';
								}
								$mensaje .='
							</tr>';
							foreach ($this->mode->Consultar("listarUsuario") as $k){
								if($k->status==1){
									$estado='Activo';
								}else{
									$estado='Inactivo';
								}
								$mensaje .= '    
								<tr>
									<td>'.$k->nombre_empleado.' '.$k->apellido_empleado.' </td>
									<td>'.$k->usuario.' </td>
									<td>'.$k->nombre_rol.' </td>
									<td>'.$estado.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=usuario&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
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
										window.location.href="index.php?c=usuario&a=inhabilitar&id="+id;
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
				foreach ($this->mode->Consultar("buscarRegistroUsuario", $consultaBusqueda) as $resultados){
					//echo '<h5>'.$k->descripcion.'</h5>';
					$this->alm->id = $resultados->id;
					$this->alm->nombre_empleado = $resultados->nombre_empleado;
					$this->alm->usuario = $resultados->usuario;
					$this->alm->nombre_rol = $resultados->nombre_rol;
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
									<th>Empleado</th>
									<th>Usuario</th>
									<th>Rol</th>
									<th>Estado</th>';
									if($this->accesoModificar){
										$mensaje .='<th>EDITAR</th>';
									}
									if($this->accesoEliminar){
										$mensaje .='<th>ELIMINAR</th>';
									}
									$mensaje .='
								</tr>
								<tr>
									<td>'.$k->nombre_empleado.' </td>
									<td>'.$k->usuario.' </td>
									<td>'.$k->nombre_rol.' </td>
									<td>'.$this->alm->estado.'</td>';
									if($this->accesoModificar){
										$mensaje .='
										<td>
											<a href="index.php?c=usuario&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
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
									},function(isConfirm) {
										if (isConfirm) {
											//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
											window.location.href="index.php?c=usuario&a=inhabilitar&id="+id;
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