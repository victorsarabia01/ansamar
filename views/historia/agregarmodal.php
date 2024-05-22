
<link rel="stylesheet" href="resources/css/select2.min.css">
<link href="resources/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<style type="text/css">
	#permanente,#txt,#permanente1{
		display:none;
	}
	#decidua,#decidua1{
		display:none;
	}
	#controls,#dientegeneral2{
		display:none;
	}
	#dientegeneral3,#dientegeneral4{
		display:none;
	}
</style>
<?php
	$busq = $this->consulta;
?>
<!-- MODAL -->
<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog" style="min-width: 85%;">
		<!--Con el min-width manejo el ancho del modal -->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"></h5>
				<?php if(!empty($_GET['ci'])){ ?>
					<a href="?c=historia" id="btn-close-modal-agregar" class="btn-close"></a>
				<?php } else { ?>
					<button type="button" id="btn-close-modal-agregar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<?php } ?>
			</div>

			<div class="modal-body">
				<?php
					date_default_timezone_set("America/Caracas");
					$fechaActual = date('Y-m-d');
				?>
				<div class="alert alert-success" role="alert">
					<div class="row">
						<div class="col-md-12">
							<h3 style="display:inline-block;">HISTORIA CLINICA </h3>
							<?php echo obtenerFechaEnLetra($fechaActual); ?>
						</div>
					</div>
				</div>
				

				<div class="col-sm-12">  	
					<input type="hidden" id="txtCodigoPaciente" name="txtCodigoPaciente" value="">
					<input type="hidden" id="txtCodigoProfesional" name="txtCodigoProfesional" value="">
					<!-- <br><br> -->
					<!-- <form action="" method="get" class="form-inline">
						<h5 style="font-family:verdana;">Cedula: </h5>
						<span style="width:30px"></span>
						<input type="hidden" name="c" value="<?=$_GET['c']; ?>">
						<input type="text" class="form-control" onkeyup="keepNumOrDecimal(this)" name="ci" id="ci" value="<?php if(!empty($busq->cedula)){ echo $busq->cedula; } ?>" required>
						<button class="btn btn-primary">Buscar</button>
					</form> -->
					<!-- <div class="form-inline">
						<h5 style="font-family:verdana;">Paciente:  </h5>
						<span style="width:30px"></span>
						<span><?php if(!empty($busq->cedula)){ echo $busq->nombres." ".$busq->apellidos; } ?></span>
					</div> -->

						<!-- <input type="hidden" name="cedula_paciente" value="<?=$_GET['ci'] ?>"> -->
					<?php //if(!empty($busq->cedula)){ ?>
						<?php //$this->mode->Consultar("BuscarCitaPaciente"); ?>
						<h5 style="font-family:verdana;">Cita: </h5>
						<select class="form-control" id="cita" name="cita" style="width:100%;" required>
							<option value="">Seleccionar Cita del paciente</option>
							<?php foreach ($this->mode->Consultar("BuscarCitaPaciente", $fechaActual) as $citas){ ?>
							<option value="<?=$citas->id_cita; ?>"><?php echo "(".$citas->fecha_cita.") ".$citas->cedula_paciente." ".$citas->nombre_paciente." ".$citas->apellido_paciente." | Doc. ".$citas->cedula_empleado." ".$citas->nombre_empleado." ".$citas->apellido_empleado; ?></option>
							<?php } ?>
						</select>
						<br>
					<?php //} ?>

				</div>

				<br>


				<section id="seccionRegistrarTratamiento" class="textAlignLeft sombraFormulario">
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-success"><b>DETALLES OBSERVADOS</b></div>
						</div>
						<div class="col-lg-6" style="">

							<div class="row" style="">
								<section class="col-lg-4 displayInlineBlockMiddleee" style="">
									<div class="dienteGeneral" id="dientegeneral1">
										<div id="DISTAL" onclick="seleccionarCara(this.id);"></div>
										<div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div>
										<div id="MESIAL" onclick="seleccionarCara(this.id);"></div>
										<div id="PALATINO" onclick="seleccionarCara(this.id);"></div>
										<div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div>
										<input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DS1" readonly="readonly">
									</div>

									<div class="dienteGeneral" id="dientegeneral2">
										<div id="MESIAL" onclick="seleccionarCara(this.id);"></div>
										<div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div>
										<div id="DISTAL" onclick="seleccionarCara(this.id);"></div>
										<div id="PALATINO" onclick="seleccionarCara(this.id);"></div>
										<div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div>
										<input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DS2" readonly="readonly">
									</div>

									<div class="dienteGeneral" id="dientegeneral3">
										<div id="MESIAL" onclick="seleccionarCara(this.id);"></div>
										<div id="LINGUAL" onclick="seleccionarCara(this.id);"></div>
										<div id="DISTAL" onclick="seleccionarCara(this.id);"></div>
										<div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div>
										<div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div>
										<input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DI3" readonly="readonly">
									</div>

									<div class="dienteGeneral" id="dientegeneral4">
										<div id="DISTAL" onclick="seleccionarCara(this.id);"></div>
										<div id="LINGUAL" onclick="seleccionarCara(this.id);"></div>
										<div id="MESIAL" onclick="seleccionarCara(this.id);"></div>
										<div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div>
										<div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div>
										<input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DI4" readonly="readonly">
									</div>
								</section>

								<section class="col-lg-8 displayInlineBlockMiddleee" style="">
									<!-- <form action="index.php?c=historia&a=guardarhistoria" method="post" name="test" class="form formulario sombraFormulario labelPequenio" style="text-align:left;width:100%;" > -->
										<div class="contenidoInterno" style="">
											<div class="form-group">
												<label style="width:100%;" ><b>CARA</b></label>
												<input type="text" id="txtCaraTratada" name="txtCaraTratada" class="form-control textAlignCenter" size="4" readonly="readonly">
											</div>
											<div class="form-group">
												<label style="width:100%;" for=""><b>ENFERMEDAD DENTAL</b></label>
												<select id="Estado" class="form-control Estado" name="Estado" style="width:100%;">
													<option value=""></option>
													<?php foreach ($this->mode->Consultar("listarTodasEnfermedades") as $k){ ?>
														<option value="<?php echo $k->id=$k->enfermedad; ?>"><?php echo $k->enfermedad; ?></option>
													<?php } ?>
												</select>
														<!-- <option value="<?php //echo $k->id=$k->enfermedad." ($".number_format($k->precio_enfermedad,2,',','.').")"; ?>"><?php //echo $k->enfermedad." ($".number_format($k->precio_enfermedad,2,',','.').")"; ?></option> -->
											</div>
											<div class="form-group">
												<label style="width:100%;" for=""><b>SERVICIO DENTAL</b></label>
												<select id="Servicio" class="form-control Servicio select2" name="Servicio" style="width:100%;z-index:99999 !important;">
													<option value=""></option>
													<?php foreach ($this->mode->Consultar("listarTodosServicios") as $s){ ?>
														<option value="<?php echo $s->id=$s->nombre." ($".number_format($s->precio,2,',','.').")"; ?>"><?php echo $s->nombre." ($".number_format($s->precio,2,',','.').")"; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label style="width:100%;" ><b>DIENTE</b></label>
												<input type="text" id="txtDienteTratado" name="txtDienteTratado" class="form-control textAlignCenter" size="4" readonly="readonly">
											</div>

											<hr>

											<div class="seccionBotones">
												<button type="button" class="btn btn-outline-success" value="Agregar" onclick="agregarTratamiento($('#txtDienteTratado').val(), $('#txtCaraTratada').val(), $('#Estado').val(), $('#Servicio').val());">
													Agregar
												</button>
											</div>
										</div>
									
									<!--/form-->
								</section>
							</div>
						</div>
						
						<div class="col-lg-6" style="background:;">
							<section class="displayInlineBlockToppp textAlignCenter" style="margin-left:10px;border:1px solid #ccc;">
								<form action="?c=historia&a=guardarhistoria" method="POST" class="formHistoriaCargar">
									<input type="hidden" name="cita" id="citaEnviar">
									<div id="divTratamiento" class="displayInlineBlockTopp sombraFormulario" style="width:100%;height:30vh;overflow-y: scroll;">
										<table id="tablaTratamiento" width="100%">
											<tbody></tbody>
										</table>
									</div>
								</form>
							</section>
							<div style="margin-left:10px;">
								<span>Presupuesto aproximado: <b>$</b><b id='presupuestoValor'>0.00</b></span>
							</div>
						</div>

					</div>


					<hr>

					<div>
						<section id="seccionPaginaAjax"></section>
						<button class="btn btn-outline-primary  btnOptions" href="javascript:void(0);" type="button" onclick="verificarOdontograma();verificarServiciosRecibidos();ocultarpermanente();">
							Decidua
						</button>
						<button class="btn btn-outline-primary  btnOptions" type="button" onclick="verificarOdontograma();verificarServiciosRecibidos();ocultardecidua();">
							Permanente
						</button>
						<button type="button"  class="btn btn-outline-primary  btnOptions"  onclick="prepararImpresion(); javascript:window.print(); terminarImpresion();">
							Imprimir Odontograma
						</button>
						<!--input type="button" href="?c=guardarhistoria" name="guardar" id="guardar"  class="btn btn-outline-primary"  value="Guardar Tratamientos" onclick="guardarTratamiento();"-->
						<button class="btn btn-outline-success" name="guardar" id="guardarhistoria" >Guadar</button>
					</div>
				</section>

				<!-- </form> -->
				<section>			
					<section style="width: 100%;background: red;">
						<section id="seccionDientes" class="displayInlineBlockTop" style="padding: 10px;height: 300px;width:100%;">
							<br>
							<div id="odontogramaSuperior" class="textAlignCenter">
								<div style="margin-top:-20px;">
									<div style="display:inline-block;"><div style="background:red;width:10px;height:10px;float:left;"></div><div style="float:right;margin-left:5px;margin-top:-8px;">Enfermo</div></div>
									<div style="margin-left:50px;display:inline-block;"><div style="background:blue;width:10px;height:10px;float:left;"></div><div style="float:right;margin-left:5px;margin-top:-8px;">Tratado</div></div>
								</div>


								<div class="" id="txt">
									<input type="text" id="txtD18" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD17" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD16" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD15" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD14" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD13" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD12" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD11" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">

									<input type="text" id="txtD21" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD22" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD23" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD24" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD25" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD26" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD27" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<input type="text" id="txtD28" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
									<hr><br>
								</div>
								<div class="row" >
									<div class="" id="permanente">
										<?php
											$general1 = ["D18", "D17", "D16", "D15", "D14", "D13", "D12", "D11"];
											foreach ($general1 as $D) {
												?>
												<div class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral1();">
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-PALATINO"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral1();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										|-|
										<?php
											$general2 = ["D21", "D22", "D23", "D24", "D25", "D26", "D27", "D28"];
											foreach ($general2 as $D) {
												?>
												<div style="clear:both" class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral2();">
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-PALATINO"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral2();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										<br><br><br><hr><br><br>
										<?php
											$general4 = ["D48", "D47", "D46", "D45", "D44", "D43", "D42", "D41"];
											foreach ($general4 as $D) {
												?>
												<div class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral4();">
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-LINGUAL"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral4();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										|-|
										<?php
											$general3 = ["D31", "D32", "D33", "D34", "D35", "D36", "D37", "D38"];
											foreach ($general3 as $D) {
												?>
												<div class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral3();">
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-LINGUAL"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral3();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										<!-- 
											<div class="diente" id="D18" onclick="seleccionarDiente('D18');dientegeneral1();">
												<div id="D18-DISTAL"></div><div id="D18-VESTIBULAR"></div><div id="D18-MESIAL"></div><div id="D18-PALATINO"></div><div id="D18-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D18');dientegeneral1();">D18</div>
											</div>
											<div class="diente" id="D17" onclick="seleccionarDiente('D17');dientegeneral1();">
												<div id="D17-DISTAL"></div><div id="D17-VESTIBULAR"></div><div id="D17-MESIAL"></div><div id="D17-PALATINO"></div><div id="D17-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D17');dientegeneral1();">D17</div>
											</div>
											<div class="diente" id="D16" onclick="seleccionarDiente('D16');dientegeneral1();">
												<div id="D16-DISTAL"></div><div id="D16-VESTIBULAR"></div><div id="D16-MESIAL"></div><div id="D16-PALATINO"></div><div id="D16-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D16');dientegeneral1();">D16</div>
											</div>
											<div class="diente" id="D15" onclick="seleccionarDiente('D15');dientegeneral1();">
												<div id="D15-DISTAL"></div><div id="D15-VESTIBULAR"></div><div id="D15-MESIAL"></div><div id="D15-PALATINO"></div><div id="D15-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D15');dientegeneral1();">D15</div>
											</div>
											<div class="diente" id="D14" onclick="seleccionarDiente('D14');dientegeneral1();">
												<div id="D14-DISTAL"></div><div id="D14-VESTIBULAR"></div><div id="D14-MESIAL"></div><div id="D14-PALATINO"></div><div id="D14-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D14');dientegeneral1();">D14</div>
											</div>
											<div class="diente" id="D13" onclick="seleccionarDiente('D13');dientegeneral1();">
												<div id="D13-DISTAL"></div><div id="D13-VESTIBULAR"></div><div id="D13-MESIAL"></div><div id="D13-PALATINO"></div><div id="D13-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D13');dientegeneral1();">D13</div>
											</div>
											<div class="diente" id="D12" onclick="seleccionarDiente('D12');dientegeneral1();">
												<div id="D12-DISTAL"></div><div id="D12-VESTIBULAR"></div><div id="D12-MESIAL"></div><div id="D12-PALATINO"></div><div id="D12-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D12');dientegeneral1();">D12</div>
											</div>
											<div class="diente" id="D11" onclick="seleccionarDiente('D11');dientegeneral1();">
												<div id="D11-DISTAL"></div><div id="D11-VESTIBULAR"></div><div id="D11-MESIAL"></div><div id="D11-PALATINO"></div><div id="D11-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D11');dientegeneral1();">D11</div>
											</div>
											|-|
											<div class="diente" id="D21" onclick="seleccionarDiente('D21');dientegeneral2();">
												<div id="D21-MESIAL"></div><div id="D21-VESTIBULAR"></div><div id="D21-DISTAL"></div><div id="D21-PALATINO"></div><div id="D21-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D21');dientegeneral2();">D21</div>
											</div>
											<div class="diente" id="D22" onclick="seleccionarDiente('D22');dientegeneral2();">
												<div id="D22-MESIAL"></div><div id="D22-VESTIBULAR"></div><div id="D22-DISTAL"></div><div id="D22-PALATINO"></div><div id="D22-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D22');dientegeneral2();">D22</div>
											</div>
											<div class="diente" id="D23" onclick="seleccionarDiente('D23');dientegeneral2();">
												<div id="D23-MESIAL"></div><div id="D23-VESTIBULAR"></div><div id="D23-DISTAL"></div><div id="D23-PALATINO"></div><div id="D23-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D23');dientegeneral2();">D23</div>
											</div>
											<div class="diente" id="D24" onclick="seleccionarDiente('D24');dientegeneral2();">
												<div id="D24-MESIAL"></div><div id="D24-VESTIBULAR"></div><div id="D24-DISTAL"></div><div id="D24-PALATINO"></div><div id="D24-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D24');dientegeneral2();">D24</div>
											</div>
											<div class="diente" id="D25" onclick="seleccionarDiente('D25');dientegeneral2();">
												<div id="D25-MESIAL"></div><div id="D25-VESTIBULAR"></div><div id="D25-DISTAL"></div><div id="D25-PALATINO"></div><div id="D25-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D25');dientegeneral2();">D25</div>
											</div>
											<div class="diente" id="D26" onclick="seleccionarDiente('D26');dientegeneral2();">
												<div id="D26-MESIAL"></div><div id="D26-VESTIBULAR"></div><div id="D26-DISTAL"></div><div id="D26-PALATINO"></div><div id="D26-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D26');dientegeneral2();">D26</div>
											</div>
											<div class="diente" id="D27" onclick="seleccionarDiente('D27');dientegeneral2();">
												<div id="D27-MESIAL"></div><div id="D27-VESTIBULAR"></div><div id="D27-DISTAL"></div><div id="D27-PALATINO"></div><div id="D27-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D27');dientegeneral2();">D27</div>
											</div>
											<div class="diente" id="D28" onclick="seleccionarDiente('D28');dientegeneral2();">
												<div id="D28-MESIAL"></div><div id="D28-VESTIBULAR"></div><div id="D28-DISTAL"></div><div id="D28-PALATINO"></div><div id="D28-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D28');dientegeneral2();">D28</div>
											</div>

											<br><br><br><hr><br><br><br>

											<div class="diente" id="D48" onclick="seleccionarDiente('D48');dientegeneral4();">
												<div id="D48-DISTAL"></div><div id="D48-LINGUAL"></div><div id="D48-MESIAL"></div><div id="D48-VESTIBULAR"></div><div id="D48-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D48');dientegeneral4();">D48</div>
											</div>
											<div class="diente" id="D47" onclick="seleccionarDiente('D47');dientegeneral4();">
												<div id="D47-DISTAL"></div><div id="D47-LINGUAL"></div><div id="D47-MESIAL"></div><div id="D47-VESTIBULAR"></div><div id="D47-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D47');dientegeneral4();">D47</div>
											</div>
											<div class="diente" id="D46" onclick="seleccionarDiente('D46');dientegeneral4();">
												<div id="D46-DISTAL"></div><div id="D46-LINGUAL"></div><div id="D46-MESIAL"></div><div id="D46-VESTIBULAR"></div><div id="D46-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D46');dientegeneral4();">D46</div>
											</div>
											<div class="diente" id="D45" onclick="seleccionarDiente('D45');dientegeneral4();">
												<div id="D45-DISTAL"></div><div id="D45-LINGUAL"></div><div id="D45-MESIAL"></div><div id="D45-VESTIBULAR"></div><div id="D45-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D45');dientegeneral4();">D45</div>
											</div>
											<div class="diente" id="D44" onclick="seleccionarDiente('D44');dientegeneral4();">
												<div id="D44-DISTAL"></div><div id="D44-LINGUAL"></div><div id="D44-MESIAL"></div><div id="D44-VESTIBULAR"></div><div id="D44-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D44');dientegeneral4();">D44</div>
											</div>
											<div class="diente" id="D43" onclick="seleccionarDiente('D43');dientegeneral4();">
												<div id="D43-DISTAL"></div><div id="D43-LINGUAL"></div><div id="D43-MESIAL"></div><div id="D43-VESTIBULAR"></div><div id="D43-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D43');dientegeneral4();">D43</div>
											</div>
											<div class="diente" id="D42" onclick="seleccionarDiente('D42');dientegeneral4();">
												<div id="D42-DISTAL"></div><div id="D42-LINGUAL"></div><div id="D42-MESIAL"></div><div id="D42-VESTIBULAR"></div><div id="D42-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D42');dientegeneral4();">D42</div>
											</div>
											<div class="diente" id="D41" onclick="seleccionarDiente('D41');dientegeneral4();">
												<div id="D41-DISTAL"></div><div id="D41-LINGUAL"></div><div id="D41-MESIAL"></div><div id="D41-VESTIBULAR"></div><div id="D41-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D41');dientegeneral4();">D41</div>
											</div> 

											|-|

											<div class="diente" id="D31" onclick="seleccionarDiente('D31');dientegeneral3();">
												<div id="D31-MESIAL"></div><div id="D31-LINGUAL"></div><div id="D31-DISTAL"></div><div id="D31-VESTIBULAR"></div><div id="D31-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D31');dientegeneral3();">D31</div>
											</div>
											<div class="diente" id="D32" onclick="seleccionarDiente('D32');dientegeneral3();">
												<div id="D32-MESIAL"></div><div id="D32-LINGUAL"></div><div id="D32-DISTAL"></div><div id="D32-VESTIBULAR"></div><div id="D32-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D32');dientegeneral3();">D32</div>
											</div>
											<div class="diente" id="D33" onclick="seleccionarDiente('D33');dientegeneral3();">
												<div id="D33-MESIAL"></div><div id="D33-LINGUAL"></div><div id="D33-DISTAL"></div><div id="D33-VESTIBULAR"></div><div id="D33-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D33');dientegeneral3();">D33</div>
											</div>
											<div class="diente" id="D34" onclick="seleccionarDiente('D34');dientegeneral3();">
												<div id="D34-MESIAL"></div><div id="D34-LINGUAL"></div><div id="D34-DISTAL"></div><div id="D34-VESTIBULAR"></div><div id="D34-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D34');dientegeneral3();">D34</div>
											</div>
											<div class="diente" id="D35" onclick="seleccionarDiente('D35');dientegeneral3();">
												<div id="D35-MESIAL"></div><div id="D35-LINGUAL"></div><div id="D35-DISTAL"></div><div id="D35-VESTIBULAR"></div><div id="D35-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D35');dientegeneral3();">D35</div>
											</div>
											<div class="diente" id="D36" onclick="seleccionarDiente('D36');dientegeneral3();">
												<div id="D36-MESIAL"></div><div id="D36-LINGUAL"></div><div id="D36-DISTAL"></div><div id="D36-VESTIBULAR"></div><div id="D36-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D36');dientegeneral3();">D36</div>
											</div>
											<div class="diente" id="D37" onclick="seleccionarDiente('D37');dientegeneral3();">
												<div id="D37-MESIAL"></div><div id="D37-LINGUAL"></div><div id="D37-DISTAL"></div><div id="D37-VESTIBULAR"></div><div id="D37-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D37');dientegeneral3();">D37</div>
											</div>
											<div class="diente" id="D38" onclick="seleccionarDiente('D38');dientegeneral3();">
												<div id="D38-MESIAL"></div><div id="D38-LINGUAL"></div><div id="D38-DISTAL"></div><div id="D38-VESTIBULAR"></div><div id="D38-OCLUSAL"></div>
												<div onclick="seleccionarDiente('D38');dientegeneral3();">D38</div>
											</div> 
										-->
										<br><br><br><hr>
									</div>
								</div>

								<div class="row">
									<div class="decidua" id="decidua">
										<?php
											$general1 = ["D55", "D54", "D53", "D52", "D51"];
											foreach ($general1 as $D) {
												?>
												<div class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral1();">
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-PALATINO"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral1();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										|-|
										<?php
											$general2 = ["D61", "D62", "D63", "D64", "D65"];
											foreach ($general2 as $D) {
												?>
												<div style="clear:both" class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral2();">
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-PALATINO"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral2();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										<br><br><br><hr><br><br>
										<?php
											$general4 = ["D85", "D84", "D83", "D82", "D81"];
											foreach ($general4 as $D) {
												?>
												<div class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral4();">
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-LINGUAL"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral4();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										|-|
										<?php
											$general3 = ["D71", "D72", "D73", "D74", "D75"];
											foreach ($general3 as $D) {
												?>
												<div class="diente" id="<?=$D; ?>" onclick="seleccionarDiente('<?=$D; ?>');dientegeneral3();">
													<div id="<?=$D."-MESIAL"; ?>" class="<?=$D."-CARA1"; ?>"></div>
													<div id="<?=$D."-LINGUAL"; ?>" class="<?=$D."-CARA2"; ?>"></div>
													<div id="<?=$D."-DISTAL"; ?>" class="<?=$D."-CARA3"; ?>"></div>
													<div id="<?=$D."-VESTIBULAR"; ?>" class="<?=$D."-CARA4"; ?>"></div>
													<div id="<?=$D."-OCLUSAL"; ?>" class="<?=$D."-CARA5"; ?>"></div>
													<div onclick="seleccionarDiente('<?=$D; ?>');dientegeneral3();"><?=$D; ?></div>
												</div>
												<?php
											}
										?>
										<!-- 
											<div class="diente" id="D55">
												<div id="D55-C1"></div><div id="D55-C2"></div><div id="D55-C3"></div><div id="D55-C4"></div><div id="D55-C5"></div>
												<div onclick="seleccionarDiente('D55');dientegeneral1();">D55</div>
											</div>
											<div class="diente" id="D54">
												<div id="D54-C1"></div><div id="D54-C2"></div><div id="D54-C3"></div><div id="D54-C4"></div><div id="D54-C5"></div>
												<div onclick="seleccionarDiente('D54');dientegeneral1();">D54</div>
											</div>
											<div class="diente" id="D53">
												<div id="D53-C1"></div><div id="D53-C2"></div><div id="D53-C3"></div><div id="D53-C4"></div><div id="D53-C5"></div>
												<div onclick="seleccionarDiente('D53');dientegeneral1();">D53</div>
											</div>
											<div class="diente" id="D52">
												<div id="D52-C1"></div><div id="D52-C2"></div><div id="D52-C3"></div><div id="D52-C4"></div><div id="D52-C5"></div>
												<div onclick="seleccionarDiente('D52');dientegeneral1();">D52</div>
											</div>
											<div class="diente" id="D51">
												<div id="D51-C1"></div><div id="D51-C2"></div><div id="D51-C3"></div><div id="D51-C4"></div><div id="D51-C5"></div>
												<div onclick="seleccionarDiente('D51');dientegeneral1();">D51</div>
											</div>
											|-|
											<div class="diente" id="D61">
												<div id="D61-C1"></div><div id="D61-C2"></div><div id="D61-C3"></div><div id="D61-C4"></div><div id="D61-C5"></div>
												<div onclick="seleccionarDiente('D61');dientegeneral2();">D61</div>
											</div>
											<div class="diente" id="D62">
												<div id="D62-C1"></div><div id="D62-C2"></div><div id="D62-C3"></div><div id="D62-C4"></div><div id="D62-C5"></div>
												<div onclick="seleccionarDiente('D62');dientegeneral2();">D62</div>
											</div>
											<div class="diente" id="D63">
												<div id="D63-C1"></div><div id="D63-C2"></div><div id="D63-C3"></div><div id="D63-C4"></div><div id="D63-C5"></div>
												<div onclick="seleccionarDiente('D63');dientegeneral2();">D63</div>
											</div>
											<div class="diente" id="D64">
												<div id="D64-C1"></div><div id="D64-C2"></div><div id="D64-C3"></div><div id="D64-C4"></div><div id="D64-C5"></div>
												<div onclick="seleccionarDiente('D64');dientegeneral2();">D64</div>
											</div>
											<div class="diente" id="D65">
												<div id="D65-C1"></div><div id="D65-C2"></div><div id="D65-C3"></div><div id="D65-C4"></div><div id="D65-C5"></div>
												<div onclick="seleccionarDiente('D65');dientegeneral2();">D65</div>
											</div>

											<br><br><br><br><br>
											
											<div class="diente" id="D85">
												<div id="D85-C1"></div><div id="D85-C2"></div><div id="D85-C3"></div><div id="D85-C4"></div><div id="D85-C5"></div>
												<div onclick="seleccionarDiente('D85');dientegeneral4();">D85</div>
											</div>
											<div class="diente" id="D84">
												<div id="D84-C1"></div><div id="D84-C2"></div><div id="D84-C3"></div><div id="D84-C4"></div><div id="D84-C5"></div>
												<div onclick="seleccionarDiente('D84');dientegeneral4();">D84</div>
											</div>
											<div class="diente" id="D83">
												<div id="D83-C1"></div><div id="D83-C2"></div><div id="D83-C3"></div><div id="D83-C4"></div><div id="D83-C5"></div>
												<div onclick="seleccionarDiente('D83');dientegeneral4();">D83</div>
											</div>
											<div class="diente" id="D82">
												<div id="D82-C1"></div><div id="D82-C2"></div><div id="D82-C3"></div><div id="D82-C4"></div><div id="D82-C5"></div>
												<div onclick="seleccionarDiente('D82');dientegeneral4();">D82</div>
											</div>
											<div class="diente" id="D81">
												<div id="D81-C1"></div><div id="D81-C2"></div><div id="D81-C3"></div><div id="D81-C4"></div><div id="D81-C5"></div>
												<div onclick="seleccionarDiente('D81');dientegeneral4();">D81</div>
											</div>
											|-|
											<div class="diente" id="D71">
												<div id="D71-C1"></div><div id="D71-C2"></div><div id="D71-C3"></div><div id="D71-C4"></div><div id="D71-C5"></div>
												<div onclick="seleccionarDiente('D71');">D71</div>
											</div>
											<div class="diente" id="D72">
												<div id="D72-C1"></div><div id="D72-C2"></div><div id="D72-C3"></div><div id="D72-C4"></div><div id="D72-C5"></div>
												<div onclick="seleccionarDiente('D72');">D72</div>
											</div>
											<div class="diente" id="D73">
												<div id="D73-C1"></div><div id="D73-C2"></div><div id="D73-C3"></div><div id="D73-C4"></div><div id="D73-C5"></div>
												<div onclick="seleccionarDiente('D73');">D73</div>
											</div>
											<div class="diente" id="D74">
												<div id="D74-C1"></div><div id="D74-C2"></div><div id="D74-C3"></div><div id="D74-C4"></div><div id="D74-C5"></div>
												<div onclick="seleccionarDiente('D74');">D74</div>
											</div>
											<div class="diente" id="D75">
												<div id="D75-C1"></div><div id="D75-C2"></div><div id="D75-C3"></div><div id="D75-C4"></div><div id="D75-C5"></div>
												<div onclick="seleccionarDiente('D75');">D75</div>
											</div>
										-->
										<br><br><br><hr>
									</div>
								</div>
							</div>
						</section>
						<!-- <section id="seccionTablaTratamientos" style="height: 320px;overflow-y: scroll;width:100%" class="displayInlineBlockTop sombraFormulario">
							<table class="table">
								<thead>
									<th>Numero de Tratamiento</th>
									<th>DESCRIPCIÓN</th>
									<th class="widthDetalleTable">FECHA REGISTRO</th>
									<th class="widthDetalleTable"></th>
									<th class="widthDetalleTable"></th>
								</thead>
								<tbody style="font-size: 13px;">
									<tr>
										<td></td>
										<td></td>
										<td>
											<input id="" type="button" class="btn btn-outline-success" value="Ver Detalle" onclick="cargarDientes('seccionDientes', 'dientes.php', this.id);">
										</td>
										<td id="realizado">
											<input id="" type="button" class="btn btn-outline-success" id="realizado" name="realizado"  value="Realizado" onclick="eliminar(this.id);">
										</td>
									</tr>
								</tbody>
							</table>
						</section> -->
					</section>

					<br><br>
				</section>

				
				

				<hr>

			</div>
		</div>
	</div>
</div>

<!-- <script src="resources/js/jsTratamiento.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){
	console.clear();
	$(".btnOptions").attr("disabled","disabled");
	$("#cita").change(function(){
		var id = $(this).val();
		$("#citaEnviar").val(id);
		if(id==""){
			$(".btnOptions").attr("disabled","disabled");
		}else{
			$(".btnOptions").removeAttr("disabled");
		}
	});
	$("#guardarhistoria").click(function(){
		console.clear();

		var indexDiente = 0;
		var indexCara = 1;
		var indexEnfermedad = 2;
		var indexServicio = 3;
		var indexPrecios = 4;
		var numero = $("#tablaTratamiento > tbody > tr").length;
		var cita = $("#cita").val();
		var dientes = [];
		var caras = [];
		var estados = [];
		var servicios = [];
		var precios = [];
		var numeroChild = $("#tablaTratamiento > tbody")[0]['children'];
		for (var i = 0; i < numeroChild.length; i++){
			var numeroChildChil = numeroChild[i]['children'];
			for (var j = 0; j < numeroChildChil.length; j++) {
				var numeroChildChildChild = numeroChildChil[j]['children'][0];
				if(j==indexDiente){
					var className = numeroChildChildChild['classList'][0];
					dientes.push($("."+className).val());
				}
				if(j==indexCara){
					var className = numeroChildChildChild['classList'][0];
					caras.push($("."+className).val());
				}
				if(j==indexEnfermedad){
					var className = numeroChildChildChild['classList'][0];
					estados.push($("."+className).val());
				}
				if(j==indexServicio){
					var className = numeroChildChildChild['classList'][0];
					servicios.push($("."+className).val());
				}
				if(j==indexPrecios){
					var className = numeroChildChildChild['classList'][0];
					precios.push($("."+className).val());
				}
			}
		}
		var continuar1 = false;
		var continuar2 = false;
		if(cita!="" || (dientes.length>0 && caras.length>0 && estados.length>0 && servicios.length>0)){
			if(cita!=""){
				continuar1 = true;
			}else{
				continuar1 = false;
				alert('Seleccionar cita del paciente');
			}
			if(dientes.length > 0 && caras.length > 0 && estados.length > 0 && servicios.length > 0){
				continuar2 = true;
			}else{
				continuar2 = false;
				alert('Seleccionar dientes, caras, enfermedades y servicios');
			}

			if(continuar1 && continuar2){
				// $('.formHistoriaCargar').submit();
				$.ajax({
					url: '?c=historia&a=guardarhistoria',
					type: 'POST',
					data: {
						cita: cita,
						dientes: dientes,
						caras: caras,
						enfermedades: estados,
						servicios: servicios,
						precios: precios,
					},
					success: function(resp){
						console.log(resp);
						// alert(resp);
						if(resp=="1"){
							alert("Historia registrada");
							let a = document.createElement("a");
							a.setAttribute("href", "?c=historia&a=reportePDF&tipo=presupuestoPDF&cita="+cita);
							a.setAttribute("id", "enlacePresupuesto");
							a.setAttribute("target", "_blank");
							document.body.appendChild(a);
							document.getElementById("enlacePresupuesto").click();

							setTimeout( function() { 
								window.location.href = 'index.php?c=historia'; 
							}, 1000);
						}
						if(resp=="2"){
							alert("Falta seleccionar dientes, caras y enfermedades del paciente");
							history.back();
						}
						if(resp=="3"){
							alert("El paciente no fue encontrado");
							history.back();
						}
					},
					error: function(respuesta){
						// var datos = JSON.parse(respuesta);
						// console.log(datos);
					}
				});
			}
		}else{
			alert('Seleccionar la Cita del paciente, dientes, caras y enfermedades');
		}
	});
	$('#cbxEstado').select2({
		sorter: function(data) {
			return data.sort(function(a, b) {
				return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
			});
		}
	});

// COMENTADO 01-02-2024

	/*recargarLista();
	$('#cbxEstado').change(function(){
		recargarLista();
	});*/
});
function verificarOdontograma(){
	var id = $("#cita").val();
	$.ajax({
		url: '?c=historia&a=verificarOdontograma',
		type: 'POST',
		data: {
			cita: id,
		},
		success:function(r){
			var data = JSON.parse(r);
			for(var z=0; z<data.length; z++){
				var dat=data[z];
				var diente = dat['pieza_dental'];
				var cara = dat['posicion_dental'];
				var campo = dat['campo'];
				var colorUsed = "red";
				$("#"+diente).attr("style","background:#000;box-shadow:0px 0px 2px #000");
				if(campo=="Completa"){
					$("."+diente+"-CARA1").attr("style","border-bottom: 25px solid "+colorUsed+";");
					$("."+diente+"-CARA2").attr("style","border-bottom: 25px solid "+colorUsed+";");
					$("."+diente+"-CARA3").attr("style","border-bottom: 25px solid "+colorUsed+";");
					$("."+diente+"-CARA4").attr("style","border-bottom: 25px solid "+colorUsed+";");
					$("."+diente+"-CARA5").attr("style","background:"+colorUsed+";");
				}else{
					if(cara=="OCLUSAL"){
						$("#"+diente+"-"+cara).attr("style","background:"+colorUsed+";");
					}else{
						$("#"+diente+"-"+cara).attr("style","border-bottom: 25px solid "+colorUsed+";");
					}
				}
			}
		}
	});
	

}
function verificarServiciosRecibidos(){
	setTimeout(function(){
		var id = $("#cita").val();
		$.ajax({
			url: '?c=historia&a=verificarServiciosRecibidos',
			type: 'POST',
			data: {
				cita: id,
			},
			success:function(r){
				// alert(r);
				console.log(r);
				var data = JSON.parse(r);
				console.log(data);
				for(var z=0; z<data.length; z++){
					var dat=data[z];
					// console.log(dat);
					var diente = dat['pieza_dental'];
					var cara = dat['posicion_dental'];
					var campo = dat['campo'];
					var colorUsed = "blue";
					$("#"+diente).attr("style","background:#000;box-shadow:0px 0px 2px #000");
					if(campo=="Completa"){
						$("."+diente+"-CARA1").attr("style","border-bottom: 25px solid "+colorUsed+";");
						$("."+diente+"-CARA2").attr("style","border-bottom: 25px solid "+colorUsed+";");
						$("."+diente+"-CARA3").attr("style","border-bottom: 25px solid "+colorUsed+";");
						$("."+diente+"-CARA4").attr("style","border-bottom: 25px solid "+colorUsed+";");
						$("."+diente+"-CARA5").attr("style","background:"+colorUsed+";");
					}else{
						if(cara=="OCLUSAL"){
							$("#"+diente+"-"+cara).attr("style","background:"+colorUsed+";");
						}else{
							$("#"+diente+"-"+cara).attr("style","border-bottom: 25px solid "+colorUsed+";");
						}
					}
				}
			}
		});
	}, 100);
}
function functionrecargarLista(){
	$.ajax({
		type:"POST",
		url:"historiaModel.php",
		dat:"reparaciones=" +$('#cbxEstado').val(),
		success:function(r){
			alert(r);
			$('#cbxreparacion').html(r);
		}
	});
}
function ocultardecidua() {
	document.getElementById("permanente").style.display = 'block';
	document.getElementById("decidua").style.display = 'none';
	// document.getElementById("permanente1").style.display = 'block';
}
function ocultarpermanente() {
	document.getElementById("permanente").style.display = 'none';
	document.getElementById("decidua").style.display = 'block';
	document.getElementById("decidua1").style.display = 'block';
}
function dientegeneral2() {
	document.getElementById("dientegeneral2").style.display = 'block';
	document.getElementById("dientegeneral3").style.display = 'none';
	document.getElementById("dientegeneral4").style.display = 'none';
	document.getElementById("dientegeneral1").style.display = 'none';
}
function dientegeneral3() {
	document.getElementById("dientegeneral2").style.display = 'none';
	document.getElementById("dientegeneral3").style.display = 'block';
	document.getElementById(";dientegeneral4").style.display = 'none';
	document.getElementById("dientegeneral1").style.display = 'none';
}
function dientegeneral4() {
	document.getElementById("dientegeneral2").style.display = 'none';
	document.getElementById("dientegeneral3").style.display = 'none';
	document.getElementById("dientegeneral4").style.display = 'block';
	document.getElementById("dientegeneral1").style.display = 'none';
}
function dientegeneral1() {
	document.getElementById("dientegeneral2").style.display = 'none';
	document.getElementById("dientegeneral3").style.display = 'none';
	document.getElementById("dientegeneral4").style.display = 'none';
	document.getElementById("dientegeneral1").style.display = 'block';
}

</script>
