<?php
	
	include_once "controller.php";
	
	class pagosController extends controller {
		/*public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Pagos";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/

		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/pagosModel.php";
			require_once "models/historiaModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new pagos_model();
			$this->alm = new pagos_model();
			$this->historia = new historia_model();

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
				$this->mode->Consultar("listarPagos");	
			}else{
				return $this->vista("error");
			}
		}
		
		public function index(){
			if($this->accesoConsultar){
				$this->precioActualDolar = self::obtenerPrecioBCVLocal();
				$this->historias = $this->historia->Consultar("listarhistoria");
				$this->bitacora->AnexarBitacora();
				// self::abrirReporte();
				return $this->vista("pagos");
			}else{
				return $this->vista("error");
			}
		}
		
		private function obtenerPrecioBCVLocal(){
			$fechaActual = date('Y-m-d');
			$horaActual = date('H:i');
			$urlDataMoneda = "./controllers/monedas/bcv";
			$jsonLoad = [];
			if($horaActual >= "08:00"){
				$datos = file_get_contents($urlDataMoneda.".json");
				if($datos!=""){
					$jsonLoad = json_decode($datos, true);
				}else{
					$obtener = self::obtenerPrecioBCVOnline($urlDataMoneda);
					if($obtener){
						$datos = file_get_contents($urlDataMoneda.".json");
						$jsonLoad = json_decode($datos, true);
						$precioActual = $jsonLoad['precio'];
					}
				}
			}
			if(count($jsonLoad)>0){
				if($jsonLoad['fecha']!=$fechaActual){
					$obtener = self::obtenerPrecioBCVOnline($fechaActual, $urlDataMoneda);
					if($obtener){
						$datos = file_get_contents($urlDataMoneda.".json");
						$jsonLoad = json_decode($datos, true);
						$precioActual = $jsonLoad['precio'];
					}
				}else{
					$precioActual = $jsonLoad['precio'];
				}
				return $precioActual; 
			}else{
				return 0;
			}
		}
		private function obtenerPrecioBCVOnline($fechaActual, $file){
			$moneda = "bcv"; 
			$urlDolarBcv = "https://exchangemonitor.net/estadisticas/ve/dolar-bcv";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $urlDolarBcv); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$output = curl_exec($ch);
			curl_close($ch);
			if(file_exists($file.".php")){
				file_put_contents($file.".php", $output);
				$exchange = file_get_contents($file.".php");
				$posILen = strlen('<meta name="description" content="');
				$posI = strpos($exchange, '<meta name="description" content="');
				$posF = strpos($exchange, '<meta name="keywords"');
				$string = substr($exchange, ($posI+$posILen), ($posF-$posI)-10);

				$posI2 = strpos($string, 'es de');
				$string2 = substr($string, ($posI2+6));
				$posF2 = strpos($string2, 'BS');
				$precio = substr($string, ($posI2+6), $posF2-1);
				// return $precio;

				$datos = file_get_contents($file.".json");
				$jsonLoad = json_decode($datos, true);
				$precio = str_replace('.','',$precio);
				$precio = str_replace(',','.',$precio);
				$precio = (float) $precio;
				$jsonLoad['fecha']=$fechaActual;
				$jsonLoad['precio']=$precio;
				$files = $file.'.json';
				if(file_exists($files)){
					file_put_contents($files, json_encode($jsonLoad));
				}
				return true;
			} else {
				return false;
			}
		}
		public function obtenerFechaEnLetra($fecha){
			$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
			$dia = $dias[date('w', strtotime($fecha))];
			$num = date("j", strtotime($fecha));
			$anno = date("Y", strtotime($fecha));
			$mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
			$mes = $mes[(date('m', strtotime($fecha))*1)-1];
			return $dia.', '.$num.' de '.$mes.' del '.$anno;
		}

		public function editar(){
			if($this->accesoModificar){
				//$this->alm = $this->mode->()cargarEmpleado($_REQUEST['id']);
				$this->alm = $this->mode->Consultar("cargarPagos", ($_REQUEST['id']));
				foreach ($this->mode->Consultar("extraerEvolucionCita", "cita", $this->alm->id_evolucion) as $k){
					$this->alm->id_cita = $k->id_cita;
				}
				if($this->alm->tipo_pago=="Transferencia o Pago movil"){ $this->alm->id_tipo="1"; }
				if($this->alm->tipo_pago=="Divisas (Dolares)"){ $this->alm->id_tipo="2"; }
				if($this->alm->tipo_pago=="Divisas (Euros)"){ $this->alm->id_tipo="3"; }
				if($this->alm->tipo_pago=="Efectivo (Bolivares)"){ $this->alm->id_tipo="4"; }
				return $this->vista("pagos/modificar");
			}else{
				return $this->vista("error");
			}
		}
		
		// GUARDAR EMPLEADO
		public function guardar(){
			if($this->accesoRegistrar){
				//$alm = new pagos_model();
				$this->alm->id_cita = $_POST['cita'];
				$this->alm->id_tipo = $_POST['tipo'];
				if($this->alm->id_tipo==1){
					$this->alm->tipo="Transferencia o Pago movil";
				} else if($this->alm->id_tipo==2){
					$this->alm->tipo="Divisas (Dolares)";
				} else if($this->alm->id_tipo==3){
					$this->alm->tipo="Divisas (Euros)";
				} else if($this->alm->id_tipo==4){
					$this->alm->tipo="Efectivo (Bolivares)";
				}
				$this->alm->fecha = $_POST['fecha'];
				$this->alm->tasa = null;
				if(!empty($_POST['tasa'])){ $this->alm->tasa = $_POST['tasa']; }
				$this->alm->referencia = null;
				if(!empty($_POST['referencia'])){ $this->alm->referencia = str_replace(' ', '', mb_strtoupper($_POST['referencia'])); }
				$this->alm->monto = null;
				if(!empty($_POST['monto'])){ $this->alm->monto = $_POST['monto']; }
				$this->alm->equivalente = $_POST['equivalente'];
				$this->alm->leyenda = null;
				if(!empty($_POST['leyenda'])){ $this->alm->leyenda = ucwords(mb_strtoupper($_POST['leyenda'])); }
				foreach ($this->mode->Consultar("extraerEvolucionCita", "evolucion", $_POST['cita']) as $k){
					$this->alm->id_evolucion = $k->id_evolucion;
				}
				$continuar = false;
				if($this->alm->id_tipo==1){
					if(
						(!empty(trim(isset($this->alm->id_evolucion))) && $this->alm->id_evolucion!="") && 
						(!empty(trim(isset($this->alm->tipo))) && $this->alm->tipo!="") &&
						(!empty(trim(isset($this->alm->fecha))) && $this->alm->fecha!="")  &&
						(!empty(trim(isset($this->alm->tasa))) && $this->alm->tasa!="") &&
						(!empty(trim(isset($this->alm->referencia))) && $this->alm->referencia!="") && 
						(!empty(trim(isset($this->alm->monto))) && $this->alm->monto!="") &&
						(!empty(trim(isset($this->alm->equivalente))) && $this->alm->equivalente!="" && $this->alm->equivalente>0)
					){
						$continuar = true;
					}else{
						$continuar = false;
					}
				} else if($this->alm->id_tipo==2 || $this->alm->id_tipo==3){
					if(
						(!empty(trim(isset($this->alm->id_evolucion))) && $this->alm->id_evolucion!="") &&
						(!empty(trim(isset($this->alm->tipo))) && $this->alm->tipo!="") &&
						(!empty(trim(isset($this->alm->fecha))) && $this->alm->fecha!="") &&
						(!empty(trim(isset($this->alm->referencia))) && $this->alm->referencia!="") &&
						(!empty(trim(isset($this->alm->equivalente))) && $this->alm->equivalente!="" && $this->alm->equivalente>0)
					){
						$continuar = true;
					}else{
						$continuar = false;
					}
				} else if($this->alm->id_tipo==4){
					if(
						(!empty(trim(isset($this->alm->id_evolucion))) && $this->alm->id_evolucion!="") &&
						(!empty(trim(isset($this->alm->tipo))) && $this->alm->tipo!="") &&
						(!empty(trim(isset($this->alm->fecha))) && $this->alm->fecha!="") &&
						(!empty(trim(isset($this->alm->tasa))) && $this->alm->tasa!="") &&
						(!empty(trim(isset($this->alm->monto))) && $this->alm->monto!="") &&
						(!empty(trim(isset($this->alm->equivalente))) && $this->alm->equivalente!="" && $this->alm->equivalente>0)
					){
						$continuar = true;
					}else{
						$continuar = false;
					}
				}
				if($continuar){
					foreach ($this->mode->Consultar("verificarPago", $this->alm) as $k){
						$this->alm->consulta = $k->id;
					}

					if(!$this->alm->consulta==""){
						// echo "Repetido";
						echo "2";
					}else{
						// echo "Disponible";
						$this->mode->Registrar("registrarPagos", $this->alm);
						foreach ($this->mode->Consultar("verificarPago", $this->alm) as $k){
							$this->alm->consulta = $k->id;
						}
						$this->bitacora->AnexarBitacora();
						echo "1";
					}
				} else {
					echo "Vacio";
				}
			}else{
				return $this->vista("error");
			}
		}
		public function abrirReporte(){
			$busqueda = $this->mode->Consultar("buscarUltimoPagos");
			$this->alm->consulta = $busqueda->id;
			// echo json_encode($this->alm->consulta);
			echo $this->alm->consulta;
		}
		public function reportePDF(){
			$tipo=$_GET['tipo'];
			if(mb_strtolower($tipo)==mb_strtolower("pagosPDF")){
				$rutaReporte="./controllers/PDF/pagosPDF.php";
				if(is_file($rutaReporte)){
					require_once $rutaReporte;
				}
			}
		}
		
		//MODIFICAR EMPLEADO
		public function modificar(){
			if($this->accesoModificar){
				//$alm = new pagos_model();
				$this->alm->id = $_POST['id'];
				$this->alm->id_cita = $_POST['cita'];
				$this->alm->id_tipo = $_POST['tipo'];
				if($this->alm->id_tipo==1){
					$this->alm->tipo="Transferencia o Pago movil";
				} else if($this->alm->id_tipo==2){
					$this->alm->tipo="Divisas (Dolares)";
				} else if($this->alm->id_tipo==3){
					$this->alm->tipo="Divisas (Euros)";
				} else if($this->alm->id_tipo==4){
					$this->alm->tipo="Efectivo (Bolivares)";
				}
				$this->alm->fecha = $_POST['fecha'];
				$this->alm->tasa = null;
				if(!empty($_POST['tasa'])){ $this->alm->tasa = $_POST['tasa']; }
				$this->alm->referencia = null;
				if(!empty($_POST['referencia'])){ $this->alm->referencia = str_replace(' ', '', mb_strtoupper($_POST['referencia'])); }
				$this->alm->monto = null;
				if(!empty($_POST['monto'])){ $this->alm->monto = $_POST['monto']; }
				$this->alm->equivalente = $_POST['equivalente'];
				$this->alm->leyenda = null;
				if(!empty($_POST['leyenda'])){ $this->alm->leyenda = ucwords(mb_strtoupper($_POST['leyenda'])); }
				foreach ($this->mode->Consultar("extraerEvolucionCita", "evolucion", $_POST['cita']) as $k){
					$this->alm->id_evolucion = $k->id_evolucion;
				}
				$continuar = false;
				if($this->alm->id_tipo==1){
					if(
						(!empty(trim(isset($this->alm->id_evolucion))) && $this->alm->id_evolucion!="") && 
						(!empty(trim(isset($this->alm->tipo))) && $this->alm->tipo!="") &&
						(!empty(trim(isset($this->alm->fecha))) && $this->alm->fecha!="")  &&
						(!empty(trim(isset($this->alm->tasa))) && $this->alm->tasa!="") &&
						(!empty(trim(isset($this->alm->referencia))) && $this->alm->referencia!="") && 
						(!empty(trim(isset($this->alm->monto))) && $this->alm->monto!="") &&
						(!empty(trim(isset($this->alm->equivalente))) && $this->alm->equivalente!="" && $this->alm->equivalente>0)
					){
						$continuar = true;
					}else{
						$continuar = false;
					}
				} else if($this->alm->id_tipo==2 || $this->alm->id_tipo==3){
					if(
						(!empty(trim(isset($this->alm->id_evolucion))) && $this->alm->id_evolucion!="") &&
						(!empty(trim(isset($this->alm->tipo))) && $this->alm->tipo!="") &&
						(!empty(trim(isset($this->alm->fecha))) && $this->alm->fecha!="") &&
						(!empty(trim(isset($this->alm->referencia))) && $this->alm->referencia!="") &&
						(!empty(trim(isset($this->alm->equivalente))) && $this->alm->equivalente!="" && $this->alm->equivalente>0)
					){
						$continuar = true;
					}else{
						$continuar = false;
					}
				} else if($this->alm->id_tipo==4){
					if(
						(!empty(trim(isset($this->alm->id_evolucion))) && $this->alm->id_evolucion!="") &&
						(!empty(trim(isset($this->alm->tipo))) && $this->alm->tipo!="") &&
						(!empty(trim(isset($this->alm->fecha))) && $this->alm->fecha!="") &&
						(!empty(trim(isset($this->alm->tasa))) && $this->alm->tasa!="") &&
						(!empty(trim(isset($this->alm->monto))) && $this->alm->monto!="") &&
						(!empty(trim(isset($this->alm->equivalente))) && $this->alm->equivalente!="" && $this->alm->equivalente>0)
					){
						$continuar = true;
					}else{
						$continuar = false;
					}
				}
				if($continuar){
					foreach ($this->mode->Consultar("verificarPago", $this->alm) as $k){
						$this->alm->consulta = $k->id;
					}
					if($this->alm->consulta==$this->alm->id){
						// echo "1";
						$this->mode->Modificar("modificarPagos", $this->alm);
						$this->bitacora->AnexarBitacora();
						if(!empty($_GET['fechaa']) && !empty($_GET['fechac'])){
							echo "<script>
								alert('Pago modificado');
								setTimeout( function() { window.location.href = 'index.php?c=pagos&fechaa=".$_GET['fechaa']."&fechac=".$_GET['fechac']."'; }, 1000 );
							</script>";
						} else {
							echo "<script>
								alert('Pago modificado');
								setTimeout( function() { window.location.href = 'index.php?c=pagos'; }, 1000 );
							</script>";
						}
					}else if(!$this->alm->consulta == ""){
						// echo "8";
						echo "<script>
							alert('Pago no disponible');
							history.back();
		    			</script>";
					}else{
						// echo "1";
						$this->mode->Modificar("modificarPagos", $this->alm);
						$this->bitacora->AnexarBitacora();
						if(!empty($_GET['fechaa']) && !empty($_GET['fechac'])){
							echo "<script>
								alert('Pago modificado');
								setTimeout( function() { window.location.href = 'index.php?c=pagos&fechaa=".$_GET['fechaa']."&fechac=".$_GET['fechac']."'; }, 1000 );
							</script>";
						} else {
							echo "<script>
								alert('Pago modificado');
								setTimeout( function() { window.location.href = 'index.php?c=pagos'; }, 1000 );
							</script>";
						}
					}
				} else {
					echo "Vacio";
				}
			}else{
				return $this->vista("error");
			}
		}

		//ELIMINAR REGISTRO DE EMPLEADO
		public function eliminar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("deletePagos",$_REQUEST['id']);
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
				$this->mode->Eliminar("inhabilitarPagos", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
			}else{
				return $this->vista("error");
			}

		}

		public function habilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("habilitarPagos", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
			}else{
				return $this->vista("error");
			}

		}
		
		public function verificarRegistropagos(){
			if($this->accesoConsultar){
				//$alm = new pagos_model();
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

		// public function cargarEmpleados(){
		// 	if($this->accesoConsultar){
		// 		//$alm = new pagos_model();
		// 		$mensaje ="";
		// 		$mensaje .='
		// 			<div class="row">
		// 				<div class="col-md-12 text-center">
		// 					<h3>Empleados</h3>
		// 				</div>
		// 			</div>
		// 			<div class="row">
		// 				<div class="col-md-12 text-center">
		// 					<table class="table table-hover">
		// 						<tr class="table-secondary">
		// 							<th>Empleado</th>
		// 							<th>Cédula</th>
		// 							<th>Nombres Apellidos</th>
		// 							<th>Teléfono</th>
		// 							<th>Estado</th>';
		// 							if($this->accesoModificar){
		// 								$mensaje .='<th>EDITAR</th>';
		// 							}
		// 							if($this->accesoEliminar){
		// 								$mensaje .='<th>ELIMINAR</th>';
		// 							}
		// 							$mensaje .='
		// 						</tr>';
		// 						foreach ($this->mode->Consultar("listarEmpleado") as $k){
		// 							if($k->status==1){
		// 								$this->alm->estado='Activo';
		// 							}else if($this->alm->status==0){
		// 								$this->alm->estado='Inactivo';
		// 							}
		// 							$mensaje .= '<tr>
		// 								<td>'.$k->tipo_empleado.'</td>
		// 								<td>'.$k->cedula.'</td>
		// 								<td>'.$k->nombres.' '.$k->apellidos.'</td>
		// 								<td>'.$k->tlfno.'</td>
		// 								<td>'.$this->alm->estado.'</td>';
		// 								if($this->accesoModificar){
		// 									$mensaje .='
		// 									<td>
		// 										<a href="index.php?c=empleado&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
		// 											<i class="bi bi-pencil-square"></i>
		// 										</a>
		// 									</td>
		// 									';
		// 								}
		// 								if($this->accesoEliminar){
		// 									$mensaje .='
		// 									<td>
		// 										<button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
		// 											<i class="bi bi-trash"></i>		
		// 										</button>
		// 									</td>
		// 									';
		// 								}
		// 								$mensaje .='
		// 							</tr>';
		// 						}
		// 						$mensaje .= '
		// 					</table>
		// 				</div>
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
		// 								window.location.href="index.php?c=empleado&a=inhabilitar&id="+id;
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
		
		// public function buscarRegistro(){
		// 	if($this->accesoConsultar){
		// 		//$alm = new pagos_model();
		// 		$consultaBusqueda = $_POST['valorBusqueda'];
		// 		//echo '<option value="0">'.$id_turno.''.$id.'</option>';
		// 		$this->alm->estado="";
		// 		foreach ($this->mode->buscarRegistroEmpleado($consultaBusqueda) as $resultados){
		// 			$this->alm->id = $resultados->id;
		// 			$this->alm->tipo_empleado = $resultados->tipo_empleado;
		// 			$this->alm->cedula = $resultados->cedula;
		// 			$this->alm->nombres = $resultados->nombres;
		// 			$this->alm->apellidos = $resultados->apellidos;
		// 			$this->alm->tlfno = $resultados->tlfno;
		// 			$this->alm->status = $resultados->status;
		// 		}
		// 		if($this->alm->status==1){
		// 			$this->alm->estado='Activo';
		// 		}else if($this->alm->status==0){
		// 			$this->alm->estado='Inactivo';
		// 		}

		// 		if($this->alm->id != ""){
		// 			echo '
		// 				<div class="row">
		// 					<div class="col-md-12 text-center">
		// 						<table class="table table-hover">
		// 							<thead class="table-success">
		// 								<tr class="table-secondary">
		// 									<th>Empleado</th>
		// 									<th>Cédula</th>
		// 									<th>Nombres Apellidos</th>
		// 									<th>Teléfono</th>
		// 									<th>Estado</th>';
		// 									if($this->accesoModificar){
		// 										$mensaje .='<th>EDITAR</th>';
		// 									}
		// 									if($this->accesoEliminar){
		// 										$mensaje .='<th>ELIMINAR</th>';
		// 									}
		// 									$mensaje .='
		// 								</tr>
		// 							</thead>
		// 							<tr>
		// 								<td>'.$this->alm->tipo_empleado.'</td>
		// 								<td>'.$this->alm->cedula.'</td>
		// 								<td>'.$this->alm->nombres.' '.$this->alm->apellidos.'</td>
		// 								<td>'.$this->alm->tlfno.'</td>
		// 								<td>'.$this->alm->estado.'</td>';
		// 								if($this->accesoModificar){
		// 									$mensaje .='
		// 									<td>
		// 										<a href="index.php?c=empleado&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
		// 											<i class="bi bi-pencil-square"></i>
		// 										</a>
		// 									</td>
		// 									';
		// 								}
		// 								if($this->accesoEliminar){
		// 									$mensaje .='
		// 									<td>
		// 										<button href="#" id="'.$this->alm->id.'" type="button" class="btn btn-outline-danger eliminar">
		// 											<i class="bi bi-trash"></i>	
		// 										</button>
		// 									</td>
		// 									';
		// 								}
		// 								$mensaje .='
		// 							</tr>
		// 						</table>
		// 					</div>
		// 				</div>
		// 				<script type="text/javascript">
		// 					$(document).ready(function(){
		// 						$(".eliminar").click(function(e){
		// 							e.preventDefault();
		// 							var id = $(this).attr("id");
		// 							swal({
		// 								title: "Atención!!!",
		// 								text: "¿Esta seguro de inhabilitar el registro?!",
		// 								type: "warning",
		// 								showCancelButton: true,
		// 								confirmButtonClass: "btn-danger",
		// 								confirmButtonText: "Confirmar",
		// 								cancelButtonText: "Cancelar",
		// 								closeOnConfirm: false,
		// 								closeOnCancel: false
		// 							}, function(isConfirm) {
		// 								if (isConfirm) {
		// 									//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
		// 									window.location.href="index.php?c=consultorio&a=inhabilitar&id="+id;
		// 								} else {
		// 									//Si se cancela se emite un mensaje
		// 									swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
		// 								}
		// 							});
		// 						});
		// 					});
		// 				</script>
		// 			';
		// 		}
		// 	}else{
		// 		return $this->vista("error");
		// 	}
		// }
	}
?>