<?php
	include_once "controller.php";
	// require_once 'vendor/autoload.php'


    class historiaController extends controller {
		public $mode;
		// public $paciente;
		public $rol;
		public $consulta;
		public $citas;
		public $accesos;
		public $nameControl = "Odontograma";
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;
		
		public function __construct(){
			require_once "models/rolModel.php";
			// require_once "models/pacienteModel.php";
			// require_once "models/citaModel.php";
			require_once "models/historiaModel.php";
			require_once "models/pagosModel.php";
			require_once "models/bitacoraModel.php";
			$this->pago = new pagos_model();
			$this->mode = new historia_model();
			$this->alm = new historia_model();
			$this->bitacora = new bitacora_model();
			

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
				if(!empty($_GET['ci'])){
					$this->consulta = $this->mode->Consultar("BuscarPacienteCita", $_GET['ci']);
					if(count($this->consulta)>0){
						$this->consulta = $this->consulta[0];
					}
				}
				if(!empty($_GET['paciente'])){
					$this->consulta = $this->mode->Consultar("BuscarPacienteCita", $_GET['paciente']);
					if(count($this->consulta)>0){
						$this->consulta = $this->consulta[0];
					}
					$this->citas = $this->mode->Consultar("listarHistoriaOdontograma", $_GET['paciente']);
					$this->verEv = $this->mode->Consultar("listarHistoriaServicios", $_GET['paciente']);
					for ($i=0; $i < count($this->citas); $i++){
						$this->citas[$i]->tratado=0;
						foreach($this->verEv as $ev){
							if($this->citas[$i]->id_historia==$ev->id_historia){
								$this->citas[$i]->tratado=1;
							}
						}
					}

				}
				// print_r($this->mode->Consultar("listarHistoriaServicios", '22186490'));
				$busq = $this->mode->Consultar("listarInsumosEvolucion", 14);
				$this->bitacora->AnexarBitacora();
				return $this->vista("historia");
			}else{
				return $this->vista("error");
			}
		}

		public function reportePDF(){
			$tipo=$_GET['tipo'];
			if(mb_strtolower($tipo)==mb_strtolower("presupuestoPDF")){
				$rutaReporte="./controllers/PDF/presupuestoPDF.php";
				if(is_file($rutaReporte)){
					require_once $rutaReporte;
				}
			}
		}

		// GUARDAR EMPLEADO
		public function guardarhistoria(){
			if($this->accesoRegistrar){
				// print_r($_POST['enfermedades']);
				// print_r($_POST['servicios']);
				// $this->alm->cedula_paciente = $_POST['cedula_paciente'];
				$this->alm->id_paciente = 0;
				$this->alm->id_cita = 0;
				$this->alm->id_cita = $_POST['cita'];
				$busqueda = $this->mode->Consultar("ValidarCita", $this->alm->id_cita);
				if(count($busqueda)>0){
					$this->alm->cedula_paciente = $busqueda[0]->cedula;
					$this->alm->id_paciente = $busqueda[0]->id_paciente;
				}
				if($this->alm->id_cita > 0){
					$this->alm->fecha = date("Y-m-d");
					if(count($_POST['dientes'])>0){
						$dientes = $_POST['dientes'];
						$caras = $_POST['caras'];
						$enfermedades = $_POST['enfermedades'];
						$servicios = $_POST['servicios'];
						$precios = $_POST['precios'];
						$errores=0;
						
						// $nDientes = [];
						// $nCaras = [];
						// $nEnfermedades = [];
						// $presupuesto = [];
						$nIndex=0;
						$datas = [];
						$datas2['elementos'] = [];
						$datas2['presupuestos'] = [];
						for ($i=0; $i < count($dientes); $i++){
							$nuevo = true;
							$indexRepetido = 0;
							$indexInterno = 0;
							for ($z=0; $z < count($datas); $z++) { 
								if(
									$datas[$z]['dientes']==$dientes[$i] && 
									$datas[$z]['caras']==$caras[$i] && 
									$datas[$z]['enfermedades']==$enfermedades[$i]
								){
									$nuevo = false;
									$indexRepetido=$z;
								}
							}
							if($nuevo){
								// echo "Nuevo - ".$servicios[$i]."\n";
								$busqueda = $this->mode->Consultar("ValidarServicios", $servicios[$i]);
								$presupuesto = 0;
								if(count($busqueda)>0){
									foreach ($busqueda as $serv) {
										$presupuesto=(float)$serv->precio;
										$datas2['presupuestos'][$nIndex][0]=['servicio'=>$servicios[$i], 'precio'=>$presupuesto];
										$indexInterno++;
									}
								}
								$datas[$nIndex]=["dientes"=>$dientes[$i], "caras"=>$caras[$i], "enfermedades"=>$enfermedades[$i], "presupuesto"=>$presupuesto];
								$datas2['elementos'][$nIndex]=["dientes"=>$dientes[$i], "caras"=>$caras[$i], "enfermedades"=>$enfermedades[$i], "presupuesto"=>$presupuesto];
								$nIndex++;
							}else{
								// echo "Repetido - ".$servicios[$i]." - INDEX: ".$indexRepetido."\n";
								$busqueda = $this->mode->Consultar("ValidarServicios", $servicios[$i]);
								$presupuesto = 0;
								if(count($busqueda)>0){
									foreach ($busqueda as $serv) {
										$presupuesto=(float)$serv->precio;
										$datas2['presupuestos'][$indexRepetido][count($datas2['presupuestos'][$indexRepetido])]=['servicio'=>$servicios[$i], 'precio'=>$presupuesto];
									}
								}
								$datas[$indexRepetido]['presupuesto']+=$presupuesto;
							}
						}
						// echo "\n";
						// echo json_encode($datas);

						// for ($i=0; $i < count($dientes); $i++){
						foreach ($datas as $data) {
							$this->alm->presupuesto = 0;
							$this->alm->id_enfermedad = 0;
							// $this->alm->diente = $dientes[$i];
							// $this->alm->cara = $caras[$i];
							$this->alm->diente = $data['dientes'];
							$this->alm->cara = $data['caras'];
							$indexActualRegistro=0;
							for ($i=0; $i < count($datas2['elementos']); $i++){
								if(
									$datas2['elementos'][$i]['dientes']==$data['dientes'] &&
									$datas2['elementos'][$i]['caras']==$data['caras'] &&
									$datas2['elementos'][$i]['enfermedades']==$data['enfermedades']
								){
									// print_r($datas2['elementos'][$i]); 
									// print_r($data);
									$indexActualRegistro=$i;
								}
								// echo "\n\n";
								// echo "\n\n";
							}
							$busqueda = $this->mode->Consultar("ValidarEnfermedad", $data['enfermedades']);
							if(count($busqueda)>0){
								$this->alm->id_enfermedad = $busqueda[0]->id;
							}
							// $busqueda = $this->mode->Consultar("ValidarServicios", $servicios[$i]);
							// if(count($busqueda)>0){
							// 	foreach ($busqueda as $serv) {
							// 		$this->alm->presupuesto=(float)$serv->precio;
							// 	}
							// }
							$this->alm->presupuesto = $data['presupuesto'];
							if(($this->alm->presupuesto>0) && ($this->alm->id_enfermedad>0)){
								$this->mode->Registrar("registrarHistoria",$this->alm);
								$historias=$this->mode->Consultar("listarEnfermedadesCita",$this->alm->id_cita);
								$id_historia=0;
								foreach ($historias as $hist) {
									if(
										$hist->id_enfermedad==$this->alm->id_enfermedad &&
										$hist->pieza_dental==$this->alm->diente &&
										$hist->posicion_dental==$this->alm->cara
									){
										$id_historia=$hist->id_historia;
									}
								}
								$data2 = $datas2['presupuestos'][$indexActualRegistro];
								foreach ($data2 as $presupData) {
									$this->alm->servicio=$presupData['servicio'];
									$this->alm->precio=$presupData['precio'];
									$this->alm->id_historia=$id_historia;
									$this->mode->Registrar("registrarHistoriaPresupuesto",$this->alm);
								}
								$this->bitacora->AnexarBitacora();
							}else{
								$errores++;
							}
						}
						if($errores==0){
							$stat="1";
						}
					}else{
						$stat = "2";
					}
				}else{
					$stat = "3";
				}
				echo $stat;
			}else{
				return $this->vista("error");
			}
		}

		public function guardarServicios(){
			if($this->accesoRegistrar){
				$cita = $_POST['cita'];
				$cedula = $_POST['cedula_paciente'];
				$id_historia = $_POST['id_historia'];
				$id_servicio = $_POST['id_servicio'];

				foreach ($this->mode->Consultar("ValidarHistoriaServicio", $id_historia, $id_servicio) as $k){
					$this->alm->consulta = $k->consulta;
				}
				if($this->alm->consulta==""){
					$this->alm->id_historia=$id_historia;
					$this->alm->id_servicio=$id_servicio;
					$this->mode->Registrar("registrarHistoriaServicio", $this->alm);
					$this->bitacora->AnexarBitacora("Aplicar tratamiento");
					echo "1";
				}else{
					echo "3";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function actualizarServicios(){
			if($this->accesoRegistrar){
				$ids = $_POST['ids'];
				$evoluciones = $_POST['evolucion'];
				$observaciones = $_POST['observacion'];
				$indicaciones = $_POST['indicaciones'];
				$index = 0;
				for ($i=0; $i < count($ids); $i++) { 
					$this->alm->id_detalle = $ids[$i];
					$this->alm->evolucion = $evoluciones[$i];
					$this->alm->observacion = $observaciones[$i];
					$this->alm->indicacion = $indicaciones[$i];
					$this->mode->Modificar("actualizarHistoriaServicio", $this->alm);
					$index++;
				}
				if($index==count($ids)){
					$this->bitacora->AnexarBitacora("Actualizar evolucion");
					echo "1";
					// echo "<script>
					// 	alert('Historia guardada y actualizada');
					// 	setTimeout( function() { window.location.href = 'index.php?c=historia'; }, 1000 );
					// </script>";
				}else{
					echo "2";
					// echo "<script>
					// 	alert('No se pudo actualizar');
					// 	history.back();
					// </script>";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function actualizarUsoInsumos(){
			if($this->accesoRegistrar){
				$this->alm->id_evolucion = $_POST['id_evolucion'];
				$result = [];
				for ($i=0; $i < count($_POST['id_insumo']); $i++) {
					$this->alm->id_insumo = $_POST['id_insumo'][$i];
					$this->alm->cantidad = $_POST['cantidad'][$i];
					// if($this->alm->cantidad>0){
						$insumos=$this->mode->Consultar("BuscarInsumosAsignado", $this->alm->id_insumo);
						// echo " | ".$insumos[0]->cantidad_asignada." | ".$insumos[0]->cantidad_usada." | ";
						$this->alm->newUsada = $insumos[0]->cantidad_usada + $this->alm->cantidad;
						$stat = "";
						$diferent = 0;
						$operacion = "";
						if(($this->alm->id_evolucion!="") && ($this->alm->id_insumo!="") && ($this->alm->cantidad!="")){
							$buscar = $this->mode->Consultar("ValidarInsumosEvolucion", $this->alm->id_evolucion, $this->alm->id_insumo);
							if(count($buscar)>0){
								// echo "Existe";
								$this->alm->id_evInsumo = $buscar[0]->id;
								// $this->alm->nCantidadEI = $buscar[0]->cantidad + $this->alm->cantidad;
								if($buscar[0]->cantidad > $this->alm->cantidad){
									$diferent = $buscar[0]->cantidad - $this->alm->cantidad;
									$operacion = "resta";
								}else if($this->alm->cantidad > $buscar[0]->cantidad){
									$operacion = "suma";
									$diferent = $this->alm->cantidad - $buscar[0]->cantidad;
								}else{
									$operacion = "igual";
								}

								if($operacion=="suma"){
									$this->alm->newUsada = $insumos[0]->cantidad_usada + $diferent;
								} else if($operacion=="resta"){
									$this->alm->newUsada = $insumos[0]->cantidad_usada - $diferent;
								} else if($operacion=="igual"){
									$this->alm->newUsada = $insumos[0]->cantidad_usada;
								}
								// echo "Actual: ".$buscar[0]->cantidad;
								// echo " | ";
								// echo "Nuevo : ".$this->alm->cantidad;
								// echo " | ";
								// echo "Operacion : ".$operacion;
								// echo " | ";
								// echo "Diferencia : ".$diferent;
								// echo " \n\n ";
								// echo "Usados : ".$insumos[0]->cantidad_usada;
								// echo " | ";
								// echo "Nueva Usada : ".$this->alm->newUsada;
								$this->mode->Modificar("actualizarEvolucionInsumo", $this->alm);
							}else{
								// echo "No existe";
								$this->mode->Registrar("registrarEvolucionInsumo", $this->alm);
							}
							$stat = "1";
						}else{
							$stat = "2";
						}
						if($stat=="1"){
							$this->mode->Modificar("actualizarAsignacionInsumo", $this->alm);
							$result[$i] = "1";
						}else{
							$result[$i] = "2";
						}
					// }
				}
				$error=0;
				$num = 0;
				foreach ($result as $key){ $num+=$key; }
				if($num==count($_POST['id_insumo'])){ echo "1"; }else{ echo "2"; }
			}else{
				return $this->vista("error");
			}
		}

		public function verificarOdontograma(){
			if($this->accesoConsultar){
				$id_cita = $_POST['cita'];
				$cedula_paciente = "";
				foreach ($this->mode->Consultar("ValidarCita", $id_cita) as $k){
					$cedula_paciente = $k->cedula;
				}
				// echo $cedula_paciente; 
				$result = $this->mode->Consultar("BuscarHistoriaPaciente", $cedula_paciente);
				echo json_encode($result);
				// foreach ($this->mode->Consultar("BuscarPacienteCita", $cedula_paciente) as $k){
					// echo count($k);
				// }
			}
		}

		public function verificarServiciosRecibidos(){
			if($this->accesoConsultar){
				$id_cita = $_POST['cita'];
				$cedula_paciente = "";
				foreach ($this->mode->Consultar("ValidarCita", $id_cita) as $k){
					$cedula_paciente = $k->cedula;
				}
				// echo $cedula_paciente;
				$result = $this->mode->Consultar("BuscarEvolucionPaciente", $cedula_paciente);
				echo json_encode($result);
				// foreach ($this->mode->Consultar("BuscarPacienteCita", $cedula_paciente) as $k){
					// echo count($k);
				// }
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
		public function alimentarModalInsumos(){
			if($this->accesoConsultar){
				// $cita = $_GET['cita'];
				$fechaAnt = $_GET['fecha'];
				$cedula = $_GET['paciente'];
				$id_evolucion = $_GET['id'];
				$consultorio = $_SESSION[NAME.'_consultorio'];
				$evolucion = $this->mode->Consultar("ExtraerEvolucionParaInsumos", $id_evolucion);
				$evolucionIn = $this->mode->Consultar("ConsultarInsumosEvolucion", $id_evolucion);

				$imprimir = "";
				$imprimir .= "
					<form class='formUsarInsumo' style='z-index:99999'>
						<div class='row'>";
							$imprimir.="
								<table class='table table-hover'>
									<thead>
									<tr>
										<th>Fecha</th>
										<th>Pieza dental</th>
										<th>Enfermedad</th>
										<th>Tratamiento</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>".self::obtenerFechaEnLetra($evolucion[0]->fecha_historia)."</td>
										<td>".$evolucion[0]->posicion_dental." en <b>".$evolucion[0]->pieza_dental."</b></td>
										<td>".$evolucion[0]->enfermedad."</td>
										<td>".$evolucion[0]->nombre."</td>
									</tr>
									</tbody>
								</table>
							";
							$imprimir.="
							<div class='col-md-12'>
								<div class='form-group'>
										<table class='table table-hover datatable'>
											<tr>
												<th>Insumos</th>
												<th>Cantidad</th>
											</tr>";
											$jsonInsumo = [];
											$numIndex=0;
											foreach ($this->mode->Consultar("listarTodosInsumos", $consultorio->id) as $insumo) {
												$cantidadDisponible = $insumo->cantidad_asignada - $insumo->cantidad_usada;
												$jsonInsumo[$numIndex]=[
													'id'=>$numIndex, 
													'nombre'=>$insumo->nombre, 
													'cantidad_asignada'=>$insumo->cantidad_asignada, 
													'cantidad_usada'=>$insumo->cantidad_usada, 
													'cantidadDisponible'=>$cantidadDisponible
												];
												$imprimir.="
													<tr>
														<td>
															<input type='hidden' class='idInsumo".$numIndex."' readonly value='".$insumo->id_ai."'>
															<input type='text' class='form-control' readonly value='".$insumo->nombre."'>
														</td>
														<td>
															<select class='form-control cantidadInsumo".$numIndex."'>
																<option value='0'>0</option>";
																for ($i=1; $i <= $cantidadDisponible; $i++) {
																	$imprimir .= "<option class='cant".$insumo->id_ai."' value='".$i."'";
																	foreach ($evolucionIn as $key) {
																		if($key->id_asignacion_insumo==$insumo->id_ai){
																			if($key->cantidad==$i){
																				$imprimir .= "selected='selected'";
																			}
																		}
																	}
																	$imprimir .= ">".$i."</option>";
																}
																$imprimir .= "
															</selectd>
														</td>
													</tr>
												";
												$numIndex++;
											}
									$imprimir .= "</table>
								</div>
								<span class='d-none jsonInsumos'>".json_encode($jsonInsumo)."</span>
							</div>";

						$imprimir.="</div>
						<input style='float:right;' type='reset' class='btn btn-secondary limpiarSeleccionInsumo' value='limpiar'>
					</form>
					<div class='row'>
						<div class='col-md-12'>
							<button class='btn btn-info descontarInsumo'>Descontar insumo</button>
						</div>
					</div>
					<br><br>
					<script type='text/javascript'>
						$(document).ready(function(){
							$('.descontarInsumo').click(function(){
								var id_evolucion = '{$id_evolucion}';
								var jsonInsumos = $('.jsonInsumos').html();
								var dataInsumos = JSON.parse(jsonInsumos);
								console.log(dataInsumos);
								var id_insumos = Array(); 
								var cantidades = Array(); 
								for (var x = 0; x < dataInsumos.length; x++){
									var idT = dataInsumos[x]['id'];
									var id_insumo = $('.idInsumo'+idT).val();
									var cantidad_insumo = $('.cantidadInsumo'+idT).val();
									id_insumos.push(id_insumo);
									cantidades.push(cantidad_insumo);
								}
								// console.log(id_insumos);
								// console.log(cantidades);
								$.ajax({
									url: '?c=historia&a=actualizarUsoInsumos',
									type: 'POST',
									data: {
										id_evolucion: id_evolucion,
										id_insumo: id_insumos,
										cantidad: cantidades,
									},
									success: function(resp){
										// alert(resp);
										// console.log(resp);
										$('.listaServiciosAplicados').load('index.php?c=historia&a=cargarTablaServicios&paciente={$cedula}&fecha={$fechaAnt}');
										$('.cerrarModalInsumoAsignar').click();
									},
									error: function(respuesta){
									}
								});
							});
						});
					</script>
				";
				echo $imprimir;
			}
		}

		public function cargarTablaServicios(){
			if($this->accesoConsultar){
				// $cita = $_GET['cita'];
				$cedula = $_GET['paciente'];
				$fechaMaxi = $_GET['fecha'];
				$mensaje = "";
				$totalPrecio = 0;
				// $semana = ((60*60)*24)*7;
				// $fechaMaxi = date('Y-m-d', time()-($semana*5));
				// $fechaMaxi = "";
				// if(!empty($_GET['fecha'])){ $fechaMaxi=$_GET['fecha']; }
				$cantRegistros=0;
				foreach ($this->mode->Consultar("listarHistoriaServicios", $cedula) as $k){
					$busq = $this->mode->Consultar("listarInsumosEvolucion", $k->id);
					$continuaa = false;
					if($fechaMaxi!=""){
						if($k->fecha_historia >= $fechaMaxi){
							$continuaa = true;
						}else{
							$continuaa = false;
						}
					} else if($fechaMaxi==""){
						$continuaa = true;
					}
					
					if($continuaa){
						$cantRegistros++;
						$mensaje .= "
							<tr>
								<td>
									<button class='btn btn-warning utilizarInsumos' value='".$k->id."'>Insumos</button>
								</td>
								<td style='text-align:center;'>
									".$k->pieza_dental." ".$k->posicion_dental." ".$k->enfermedad."<br>
									(".$k->fecha_historia.")
								</td>
								<td>".ucwords(mb_strtolower($k->tratamiento))."</td>
								<td>".ucwords(mb_strtolower($k->descripcion))."</td>
								<td>$".number_format($k->precio,2,',','.')."</td>
								<td><textarea name='evolucion[]' class='evolucion' id='evolucion".$k->id."'>".$k->evolucion."</textarea></td>
								<td><textarea name='observacion[]' class='observacion' id='observacion".$k->id."'>".$k->observacion."</textarea></td>
								<td><textarea name='indicaciones[]' class='indicaciones' id='indicaciones".$k->id."'>".$k->indicaciones."</textarea></td>
								<td>";
									$ndata = [];
									foreach ($this->mode->Consultar("listarInsumosEvolucion", $k->id) as $key) {
										if(!empty($ndata[$key->nombre])){
											$ndata[$key->nombre] += $key->cantidad;
										}else{
											$ndata[$key->nombre] = $key->cantidad;
										}
									}
									foreach ($ndata as $nombre => $cantidad) {
										if($cantidad>0){
											$mensaje.=" ".$nombre."-(".$cantidad."Unds)<br>";
										}
									}
								$mensaje .= "</td>
								<td style='width:400px !important;'>
									<input type='hidden' name='ids[]' id='ids".$k->id."' value='".$k->id."'>
									<input type='button' class='btn btn-danger eliminarServicio' id='".$k->id."' value='Eliminar'>
								</td>
							</tr>
						";
						$totalPrecio += $k->precio;
					}
				}
				if($cantRegistros==0){
					$mensaje .= "
						<tr style='text-align:center;'>
							<td colspan='10'>No se encontraron registros</td>
						</tr>
					";
				} else {
					$mensaje .= "
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>Total: </td>
							<td><b>$".number_format($totalPrecio, 2,',','.')."</b></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					";
				}
				$mensaje .= "
					<script type='text/javascript'>
						$(document).ready(function(){
							$('.utilizarInsumos').click(function(){
								var id = $(this).val();
								// alert('Utilizar en ID: '+id);
								$('.modalInsumoAsignar').hide();
								$('.modalInsumoAsignar').attr('display','display:;');

								$('.dataModal').load('index.php?c=historia&a=alimentarModalInsumos&paciente={$cedula}&id='+id);
								$('.modalInsumoAsignar').fadeIn();
							});
							$('.cerrarModalInsumoAsignar').click(function(){
								$('.modalInsumoAsignar').fadeOut();
							});
							$('.eliminarServicio').click(function(e){
								console.log();
								e.preventDefault();
								var id = $(this).attr('id');
								$.ajax({
									url: '?c=historia&a=eliminarServicios',
									type: 'POST',
									data: {
										cedula_paciente: {$cedula},
										id: id,
									},
									success: function(resp){
										$('.listaServiciosAplicados').load('index.php?c=historia&a=cargarTablaServicios&paciente={$cedula}');
									},
									error: function(respuesta){
									}
								});
							});
						});
					</script>
				";
				echo $mensaje;
			}else{
				return $this->vista("error");
			}
		}

		public function eliminarServicios(){
			if($this->accesoConsultar){
				$cedula = $_POST['cedula_paciente'];
				$id = $_POST['id'];
				$result = $this->mode->Eliminar("eliminarServicio", $id);
				echo $result;
			}else{
				return $this->vista("error");
			}
		}
		
	}

		

	
	
?>