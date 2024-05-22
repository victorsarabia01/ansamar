<?php
	
	include_once "./vendor/autoload.php";
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();

	$id_pago = $_GET['id'];
	$busqueda = $this->mode->Consultar("listarPagosReporte", $id_pago);
	$pagos = [];
	if(count($busqueda)>0){
		$pagos = $busqueda[0];
	}
	
	// $fecha_emision = $pagos->fecha_pago;
	$fecha_emision = date('d-m-Y');
	// $fecha_vencimiento = date('d-m-Y',time()+(  ((60*60)*24)*15  ));

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
					";
					// foreach ($pagos as $key => $value) {
					// 	$html.= $key." = ".$value." | ";	
					// }
					$titleRef = "";
					if($pagos->tipo_pago=="Divisas (Dolares)" || $pagos->tipo_pago=="Divisas (Euros)"){
						$titleRef = "Serial";
					}else{
						$titleRef = "Numero de operación";
					}
					$fp1 = substr($pagos->fecha_pago."", 8, 2);
					$fp2 = substr($pagos->fecha_pago."", 5, 2);
					$fp3 = substr($pagos->fecha_pago."", 0, 4);

					
					$html.="
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
							</table>
						</span>

						<table class='table1'>
							<tr>
								<td class='celtitle2'>
									<b class='titulo-table'>Cédula: </b>
									<span class='content-table' style='margin-left:50px;'>".number_format($pagos->cedula,0,'','.')."</span>
								</td>
								<td class='celtitle2'>
									<b class='titulo-table' style='margin-right:50px;'>Correo: </b>
									<span class='content-table'>".mb_strtolower($pagos->email)."</span>
								</td>
							</tr>
							<tr>
								<td class='celtitle2'>
									<b class='titulo-table' style='margin-right:40px;'>Paciente: </b>
									<span class='content-table' style='margin-right:50px;'>".ucwords(mb_strtolower($pagos->nombres))." ".ucwords(mb_strtolower($pagos->apellidos))."</span>
								</td>
								<td class='celtitle2'>
									<b class='titulo-table' style='margin-right:40px;'>Telefono: </b>
									<span class='content-table'>".$pagos->tlfno."</span>
								</td>
							</tr>
						</table>
						<br>
						<table class='table2' style='width:100%;'>";
							$html.="
							<tr><td style='font-size:1.5em;padding:10px;'><b>Comprobante de pago</b></td></tr>
							<tr style='margin:0:padding:0;'><td colspan=''><hr style='border-top:1px solid #ccc;margin:0:padding:0;'></td></tr>
							<tr><td style='font-size:1.2em;padding:10px;'>".self::obtenerFechaEnLetra($pagos->fecha_pago)."</td></tr>
							<tr style='margin:0:padding:0;'><td colspan=''><hr style='border-top:1px solid #ccc;margin:0:padding:0;'></td></tr>
							<tr><td style='font-size:1.2em;padding:10px;color:#555'>Total</td></tr>
							<tr><td style='font-size:2em;padding-left:10px;'><b>$".number_format($pagos->equivalente,2,',','.')."</b></td></tr>
							<tr><td style='font-size:1.2em;padding:10px;'><span style='color:#555'>Forma de pago:</span> ".$pagos->tipo_pago."</td></tr>
							";
							if($pagos->monto!=""){
							$html.="
							<tr><td style='font-size:1.2em;padding:10px;'><span style='color:#555'>Monto: </span>".number_format($pagos->monto,2,',','.')."</td></tr>
							";
							}
							$html.="
							<tr><td style='font-size:1.2em;padding:10px;'><span style='color:#555'>".$titleRef.":</span> ".$pagos->referencia."</td></tr>
							";
							if($pagos->leyenda!=""){
							$html.="
							<tr><td style='font-size:1.2em;padding:10px;'><span style='color:#555'>Nota:</span> <span style='font-size:0.85em;'>".$pagos->leyenda."</span></td></tr>
							";
							}
							$html.="
						</table>

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