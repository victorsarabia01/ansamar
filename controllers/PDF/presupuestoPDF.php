<?php
	
	include_once "./vendor/autoload.php";
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();

	$id_cita = $_GET['cita'];
	$id_paciente = 0;
	$busqueda = $this->mode->Consultar("ValidarCita", $id_cita);
	$paciente = [];
	if(count($busqueda)>0){
		$paciente = $busqueda[0];
	}
	$historia = $this->mode->Consultar("listarHistoriaOdontograma", $paciente->cedula);
	$limitarACita=false;

	$num_factura=0;
	$num_factura2 = $num_factura;
	if(strlen($num_factura2)==1){$num_factura = "00000".$num_factura2;}
	else if(strlen($num_factura2)==2){$num_factura = "0000".$num_factura2;}
	else if(strlen($num_factura2)==3){$num_factura = "000".$num_factura2;}
	else if(strlen($num_factura2)==4){$num_factura = "00".$num_factura2;}
	else if(strlen($num_factura2)==5){$num_factura = "0".$num_factura2;}
	else if(strlen($num_factura2)==6){$num_factura = $num_factura2;}
	else{$num_factura = $num_factura2;}
	$fecha_emision = date('d-m-Y');
	$fecha_vencimiento = date('d-m-Y',time()+(  ((60*60)*24)*15  ));

	$path = 'img/ansamarLogox.png';
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

	$html = "
	<!DOCTYPE html>
	<html>
	<head>
	</head>
	<body>
		<style>
			body{font-family:'arial';}
			*{font-family: 'Arial', sans-serif !important;font-size: 0.98em;}
			.serif{font-family: 'Arial', serif !important;}
			.hr-box{padding:0;margin:3px;}
			.numeroFactura{float:right;}
			.descripcion{font-size:1.5em;text-align: center;}
			.tabled{width:100%;margin-top:1%;}
			.celtitle2{text-align:left !important;}
			.celtitle2R{text-align:right; !important;}
			.celcontent{text-align:left !important;}
			.celcontentR{text-align:right !important;}
			.table1 tr, .table1 td, .table2 tr, .table2 td{padding:0;margin:0;}
			.marginleft{margin-left:100px;}
			.numFact{font-size:1.5em;}
			.table1{width:100%;}
			.table1 .celtitle2{text-align:left !important;width:20%;}
			.table1 .celcontent{text-align:left !important;width:25%;}
			.celtitleR{text-align:right;}
			.celtitleL{text-align:left;}
			.dates{text-align:left;}
			.fecha{ position:absolute;right:0;margin-top:-12%; }
			/*.box-content-final{display:inline-block;position:absolute;right:2%;top:30em;width:35%; }*/
		</style>
		<div class='row col-xs-12' style='padding:0;margin:0;'>
			<div class='col-xs-12'  style='width:100%;'>
				";		
				$html .= "<table class='' style='text-align:center;width:100%;'>
					<tr>
						<td style='width:25%'>
							<img src='".$base64."' style='Width:50%;'>	
						</td>
						<td style='width:45%'>
							<h3 style='width:100%;font-size:1.3em;margin-bottom:0;'>
								Centro Médico Odontologico Ansamar
							</h3>
							<p style='font-size:1.2em;' class='sans-serif'>
								<br>
							</p>
							<small class='sans-serif'>
								<br>
								<br>
							</small>
						</td>

						<td style='width:20%;text-align:left;margin-left:50px'>
						</td>
					</tr>
				</table>

				<div class='row'>
					<div class='col-xs-12' style=''>
						<span class='fecha' >
							<table class=''>
								<tr style='text-align:right;'>
									<td>
										<b>Emitido: </b> 
									</td>
								</tr>
								<tr style='text-align:right;'>
									<td>
										<span class='dates'>".self::obtenerFechaEnLetra($fecha_emision)."</span>
									</td>
								</tr>
								<tr style='text-align:right;'>
									<td>
										<b>Valido hasta: </b>
									</td>
								</tr>
								<tr style='text-align:right;'>
									<td>
										<span class='dates'>".self::obtenerFechaEnLetra($fecha_vencimiento)."</span>
									</td>
								</tr>
							</table>
						</span>

						<br>
						<table class='table1'>
							<tr>
								<td class='celtitle2'><b class='titulo-table'>Paciente: </b></td>
								<td class='celcontent'><span class='content-table'>".ucwords(mb_strtolower($paciente->nombres))." ".ucwords(mb_strtolower($paciente->apellidos))."</span></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class='celtitle2'><b class='titulo-table'>Dirección: </b></td>
								<td class='celcontent' colspan='2'><span class='content-table'>".ucwords(mb_strtolower($paciente->direccion))."</span></td>
							</tr>
							<tr>
								<td class='celtitle2'><b class='titulo-table'>Cédula: </b></td>
								<td class='celcontent'><span class='content-table'>".number_format($paciente->cedula,0,'','.')."</span></td>
								<td class='celtitle2R'><b class='titulo-table'>Sexo: </b></td>
								<td class='celcontent'><span class='content-table'>".mb_strtoupper($paciente->sexo)."</span></td>
							</tr>
							<tr>
								<td class='celtitle2'><b class='titulo-table'>Telefono: </b></td>
								<td class='celcontent'><span class='content-table'>".$paciente->tlfno."</span></td>
								<td class='celtitle2R'><b class='titulo-table'>Correo: </b></td>
								<td class='celcontent'><span class='content-table'>".mb_strtolower($paciente->email)."</span></td>
							</tr>
						</table>
						<br>
						<table class='table2' style='width:100%;'>
							<tr>
								<td class='celtitleL'><b>Descripcion</b></td>
								<td class='celtitleR'><b>Precio</b></td>
								<td class='celtitleR'><b>Total</b></td>
							</tr>
							<tr style='margin:0:padding:0;'><td colspan='6'><hr style='border-top:1px solid #ccc;margin:0:padding:0;'></td></tr>
							";

							$totalNeto = 0;
							foreach ($historia as $hist){
								$presupuestos = $this->mode->Consultar("listarPresupuestos", $hist->id_historia);
								$mostrar = false;
								if($limitarACita){
									if($hist->id_cita==$id_cita){
										$mostrar=true;
									}else{
										$mostrar=false;
									}
								}else{
									$mostrar=true;
								}
								if($mostrar){
									//<span style='width:100%;height:5px;border-bottom:1px solid red;'></span>
									$html.="<tr><td colspan='3'><span style='border-bottom:1px solid #00000000;padding:15px;'></span></td></tr>";
									$html.="
									<tr>
										<td class='celcontent'><b>".$hist->enfermedad." en ".$hist->pieza_dental." ".$hist->posicion_dental."</b></td>
										<td class='celcontent'><b></b></td>
										<td class='celcontentR'><b></b></td>
									</tr>
									<tr><td colspan='3'><div style='background:#33333322;width:100%;height:1px;;'></div></td></tr>
									";
									$precioTotal = 0;
									foreach ($presupuestos as $prep) {
										$precioTotal+=$prep->precio;
										$html.="
										<tr>
											<td class='celcontent'><span class='content-table' style='margin-left:15px;'>".$prep->servicio." </span></td>
											<td class='celcontentR'><span class='content-table'>$".number_format($prep->precio,2,',','.')."</span></td>
											<td class='celcontentR'><span class='content-table'>$".number_format($precioTotal,2,',','.')."</span></td>
										</tr>

										";
									}
									$html.="<tr><td colspan='3'><span style='border-bottom:1px solid #00000000;padding:15px;'></span></td></tr>";
									$html.="
										<tr>
											<td class='celcontent'></td>
											<td class='celcontentR'></td>
											<td class='celcontentR'><b><span class='content-table'>$".number_format($precioTotal,2,',','.')."</span></b></td>
										</tr>
									";
									$totalNeto+=$precioTotal;
								}
							}

							$html.="
						</table>
						<br>
						<div class='box-content-final' style='margin-left:70%;width:30%;'>
							<table style='width:100%;font-size:1.1em;'>
								<tr>
									<td class='celtitleL'>Total Neto: </td>
									<td class='celcontentR'><span class='content-table'><b>$".number_format($totalNeto,2,',','.')."
									</b></span></td>
								</tr>
								<!--
								<tr>
									<td class='celtitleL'>Impuesto (I.V.A): </td>
									<td class='celcontentR'><span class='content-table'>$".number_format("1.56",2,',','.')."</span></td>
								</tr>
								<tr>
									<td class='celtitleL'>Total Operacion: </td>
									<td class='celcontentR'><span class='content-table'>$".number_format("7.96",2,',','.')."</span></td>
								</tr>
								-->
							</table>
						</div>

					</div>
				</div>

				<footer class='main-footer' style='position:absolute;bottom:0;font-size:1.5em;width:100%;'>
					<div >
						<span>
							<br><br>
						</span>
					</div>
				</footer>";

				//<span class='string'>Copyright &copy; 2021-2022 <b>Style Collection</b>.</span> <span class='string'>Todos los derechos reservados.</span>
				//<h2>tengo mucha hambre, y sueño, aparte tengo que hacer muchas cosas lol jajaja xd xd xd xd xd xd xd xd hangria </h2>
			$html .= "</div>
		</div><br>
	</body>
	</html>";
	// echo $html;
	$dompdf->loadHtml($html);
	$dompdf->render();
	$dompdf->stream("Archivo", array("Attachment" => false));
?>