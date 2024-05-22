
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

<!-- MODAL -->
<div class="modal fade" id="tratarModal" tabindex="-1" aria-labelledby="tratarModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog" style="min-width: 85%;">
		<!--Con el min-width manejo el ancho del modal -->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"></h5>
				<a href="?c=historia" id="btn-close-modal-agregar" class="btn-close" ></a>
				<!-- <button type="button" id="btn-close-modal-agregar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
			</div>

			<div class="modal-body">
							<?php echo obtenerFechaEnLetra($fechaActual); ?>
				<div class="alert alert-success" role="alert">
					<div class="row">
						<div class="col-md-6">
							<h3>HISTORIA CLINICA </h3>
						</div>
						<div class="col-md-6" style="text-align:right;">
							<h5 style="font-family:verdana;display:inline-block;">Paciente:  </h5>
							<span><?php if(!empty($busq->cedula)){ echo $busq->nombres." ".$busq->apellidos; } ?></span>
						</div>
					</div>
					<?php 
						$fechaMaxi = $_GET['fecha'];
					?>
				</div>
				

				<div class="col-sm-12">
					<input type="hidden" id="txtCodigoPaciente" name="txtCodigoPaciente" value="">
					<input type="hidden" id="txtCodigoProfesional" name="txtCodigoProfesional" value="">
					<div class="form-inline">
					</div>

						
						<div class="col-md-12" style="text-align:center;">
							<?php echo obtenerFechaEnLetra($fechaMaxi); ?>
							<form class="form-horizontal">
								<div class="form-group" style="text-align:center;">
									<label for="antiguedad">Fecha Antiguedad: </label>
									<input type="hidden" name="c" value="<?=$_GET['c']; ?>">
									<input type="hidden" name="paciente" value="<?=$_GET['paciente']; ?>">
									<input type="date" class="form-control" style="width:200px;display:inline-block;" value="<?=$fechaMaxi; ?>" id="antiguedad" name="fecha">
									<button class="btn btn-outline-success">Aplicar</button>
								</div>
							</form>
						</div>
					<br>

					<div class="row" style="">
						<div class="col-md-6"  style="height:50vh;overflow-y:auto;">
							<table class="table">
								<tr>
									<th>Fecha</th>
									<th>Pieza dental</th>
									<th>Posicion dental</th>
									<th>Enfermedad</th>
									<th></th>
									<!-- <th></th> -->
								</tr>
								<?php $cantRegistros=0; ?>
								<?php foreach ($this->citas as $hist){ ?>
									<?php
										$continuaa = false;
										if($fechaMaxi!=""){
											if($hist->fecha_historia >= $fechaMaxi){
												$continuaa = true;
											}else{
												if($hist->tratado==0){
													$continuaa = true;
												}else{
													$continuaa = false;
												}
											}
										} else if($fechaMaxi==""){
											$continuaa = true;
										}
										
										if($continuaa){
											$cantRegistros++;
									?>
										<tr class="tr<?=$hist->id_historia; ?>" <?php if($hist->tratado==1){ echo "style='background:#FF000033;'"; } ?>>
											<td><?=obtenerFechaEnLetra($hist->fecha_historia); ?></td>
											<td><?=$hist->pieza_dental; ?></td>
											<td><?=$hist->posicion_dental; ?></td>
											<td><?=$hist->enfermedad; ?></td>
											<td>
												<input type="hidden" class="txt<?=$hist->id_historia; ?>" value="<?=$hist->enfermedad.", ".$hist->pieza_dental.", ".$hist->posicion_dental; ?>">
												<button class="btn btn-outline-info tratar" id="<?=$hist->id_historia; ?>" >Tratar</button>
											</td>
											<!-- <td>
												<input type="hidde" class="trt<?=$hist->id_historia; ?>" value="<?=$hist->id_historia; ?>">
												<button class="btn btn-outline-danger tratado" id="<?=$hist->id_historia; ?>" >Borrar</button>
											</td> -->
										</tr>
									<?php } ?>
								<?php } ?>
								<?php if($cantRegistros==0){ ?>
									<tr style="text-align:center;">
										<td colspan="5">No se encontraron registros</td>
									</tr>
								<?php } ?>
							</table>
							<br>
						</div>
						<div class="col-md-6">
							<form>
								<div class="form-group">
									<label>Enfermedad</label>
									<input class="form-control enfermedad" id="" value="" readonly>
								</div>

								<div class="form-group">
									<label>Servicio</label>
									<select class="form-control servicio">
										<option class="" value="">Seleccione un servicio</option>
										<?php foreach ($this->mode->Consultar("listarTodosServicios") as $serv){ ?>
											<option class="op<?=$serv->id; ?>" value="<?=$serv->id; ?>" ><?=$serv->nombre." (".$serv->descripcion.")"; ?></option>
										<?php } ?>
									</select>
									<input type="hidden" class="opcionServicio" value="">
								</div>
									<input style="float:right;" type="reset" class="btn btn-secondary limpiarTratamiento" value="Limpiar">
							</form>
							
							<button class="btn btn-primary aplicarTratamientoGuardar" disabled>Aplicar Tratamiento</button>
						</div>
						<div style="clear:both;"></div>
					
					</div>

				</div>


				<div id="" style="width:100%;" class="">
					<br><br>
					<div class=""> 

						<div class="col-md-12" style="max-height:320px;overflow-y:scroll;">
							<!-- <form action='?c=historia&a=actualizarServicios' method='POST' class='formServiciosDetalles'> -->
							<table class="table tableServiciosDetalles" style="width:100%;">
								<thead style="width:100%">
									<th>ASIGNAR</th>
									<th>Enfermedad dental</th>
									<th>Tratamiento</th>
									<th>Descripcion</th>
									<th>Precio</th>
									<th>Evolucion</th>
									<th>Observacion</th>
									<th>Indicaciones</th>
									<th>Insumos utilizados</th>
									<th>ELIMINAR</th>
								</thead>
								<tbody class="listaServiciosAplicados" style="font-size: 13px;">
									<!-- <tr>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<input id="" type="button" class="btn btn-outline-success" value="Ver Detalle" onclick="cargarDientes('seccionDientes', 'dientes.php', this.id);">
										</td>
										<td id="realizado">
											<input id="" type="button" class="btn btn-outline-success" id="realizado" name="realizado"  value="Realizado" onclick="eliminar(this.id);">
										</td>
									</tr> -->
								</tbody>
							</table>
							<!-- </form> -->
						</div>
						<div class="col-sm-12">
							<div class="row" style="border-top:1px solid #777">
								<div class="col-md-12" style="text-align:right;">
									<br>
									<button class="btn btn-outline-success" id="guardarDetalles">Guardar</button> <!-- onclick="$('.formServiciosDetalles').submit()" -->
								</div>
							</div>
						</div>
					</div>
				</div>

				<hr>

			</div>
		</div>
	</div>
</div>

<div class="modalInsumoAsignar" style="display:none;background:#00000099;z-index:99998;position:absolute;width:100%;height:100vh;top:0;left:0;">
	<div style="background:#FCFCFC;max-width:70%;width:70%;max-height:70vh;height:70vh;margin-top:10vh;margin-left:15%;overflow:auto;display:block;border-radius:5px;padding:5px">
		<div class="alert alert-success" role="alert">
			<button style="border:10x solid #000;float:right;" class="btn btn-secondary cerrarModalInsumoAsignar">X</button>
			<div class="row">
				<div class="col-md-12">
					<h4 style="display:inline-block;">Uso de insumos</h4>
					<span>(<?=$_SESSION[NAME.'_consultorio']->descripcion; ?>)</span>
				</div>
			</div>
		</div>
		<div class='dataModal' style="background:;width:100%;height:75%;padding:10px;z-index:99999;"></div>
		<br>
	</div>
</div>
	
	<!-- COMENTADO 01-02-2024 -->
<!-- <script src="resources/js/jsTratamiento.js"></script> -->
<script type="text/javascript">
/*function functionrecargarLista(){
	$.ajax({
		type:"POST",
		url:"historiaModel.php",
		dat:"reparaciones=" +$('#cbxEstado').val(),
		success:function(r){
			alert(r);
			$('#cbxreparacion').html(r);
		}
	});
}*/
function ocultardecidua() {
	document.getElementById("permanente").style.display = 'block';
	document.getElementById("decidua").style.display = 'none';
	document.getElementById("permanente1").style.display = 'block';
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
	document.getElementById("dientegeneral4").style.display = 'none';
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
$(document).ready(function(){
	var indexEvolucion = 5;
	var indexObservaciones = 6;
	var indexIndicaciones = 7;
	var indexEliminar = 9;
	$("#guardarDetalles").click(function(){
		console.clear();
		var evoluciones = [];
		var observaciones = [];
		var indicaciones = [];
		var ids = [];
		var numero = $(".listaServiciosAplicados");
		// console.log(numero);
		var numeroChild = $(".listaServiciosAplicados")[0]['children'];
		for (var i = 0; i < (numeroChild.length-2); i++){
			var numeroChildChil = numeroChild[i]['children'];
			for (var j = 0; j < numeroChildChil.length; j++) {
				var numeroChildChildChild = numeroChildChil[j]['children'][0];
				if(j==indexEvolucion){
					var className = numeroChildChildChild['id'];
					evoluciones.push(""+$("#"+className).val()+"");
				}
				if(j==indexObservaciones){
					var className = numeroChildChildChild['id'];
					observaciones.push(""+$("#"+className).val()+"");
				}
				if(j==indexIndicaciones){
					var className = numeroChildChildChild['id'];
					indicaciones.push(""+$("#"+className).val()+"");
				}
				// alert('asd');
				if(j==indexEliminar){
					// console.log(numeroChildChildChild);
					var className = numeroChildChildChild['id'];
					ids.push(""+$("#"+className).val()+"");
				}
			}
		}
		// console.log(evoluciones);
		// console.log(observaciones);
		// console.log(indicaciones);
		// console.log(ids);
		$.ajax({
			url: '?c=historia&a=actualizarServicios',    
			type: 'POST',
			data: {
				evolucion: evoluciones,
				observacion: observaciones,
				indicaciones: indicaciones,
				ids: ids,
			},
			success: function(resp){
				console.log(resp);
				if(resp=="1"){
					// alert(resp);
					alert('Historia guardada y actualizada');
					setTimeout( function() { window.location.href = 'index.php?c=historia'; }, 1000 );
				}
				if(resp=="2"){
					// alert(resp);
					alert('No se pudo actualizar');
					history.back();
				}
				// document.getElementById("btn-close-modal-agregar").click();
				// setTimeout( function() { window.location.href = 'index.php?c=historia'; }, 1000 );
			},
			error: function(respuesta){
				// var datos = JSON.parse(respuesta);
				// console.log(datos);
			}
		});

	});
	$(".tratar").click(function(){
		var id = $(this).attr("id");
		$(".enfermedad").attr("id", id);
		$(".enfermedad").val($(".txt"+id).val());
		var enfermedad = $(".enfermedad").val();
		var servicio = $(".servicio").val();
		if(enfermedad!="" && servicio!=""){
			$(".aplicarTratamientoGuardar").removeAttr("disabled");
		}else{
			$(".aplicarTratamientoGuardar").attr("disabled", "disabled");
		}
	});
	$(".servicio").change(function(){
		var enfermedad = $(".enfermedad").val();
		var servicio = $(".servicio").val();
		var serviciotxt = $(".op"+servicio).html();
		$(".opcionServicio").val(serviciotxt);
		if(enfermedad!="" && servicio!=""){
			$(".aplicarTratamientoGuardar").removeAttr("disabled");
		}else{
			$(".aplicarTratamientoGuardar").attr("disabled", "disabled");
		}
	});
	$(".limpiarTratamiento").click(function(){
		$(".aplicarTratamientoGuardar").attr("disabled", "disabled");
	});
	$(".aplicarTratamientoGuardar").click(function(){
		var paciente = '<?=$_GET['paciente']; ?>';
		var fecha = '<?=$_GET['fecha']; ?>';
		var id = $(".enfermedad").attr("id");
		var enfermedad = $(".enfermedad").val();
		var id_servicio = $(".servicio").val();
		var servicio = $(".opcionServicio").val();
		// alert(cita+" "+paciente+" "+id+" "+id_servicio);
		$.ajax({
			url: '?c=historia&a=guardarServicios',
			type: 'POST',   
			data: {
				cedula_paciente: paciente,
				id_historia: id,
				id_servicio: id_servicio,
			},
			success: function(resp){
				// console.log(resp);
				// alert(resp);
				// $('.listaServiciosAplicados').load('index.php?c=historia&a=cargarTablaServicios&cita='+cita+'&paciente='+paciente);
				
				$('.listaServiciosAplicados').load('index.php?c=historia&a=cargarTablaServicios&paciente='+paciente+'&fecha='+fecha);
				
			},
			error: function(respuesta){
				// var datos = JSON.parse(respuesta);
				// console.log(datos);
			}
		});
	});
	// setInterval( function(){
		var paciente = '<?=$_GET['paciente']; ?>';
		var fecha = '<?=$_GET['fecha']; ?>';
		// $('.listaServiciosAplicados').load('index.php?c=historia&a=cargarTablaServicios&cita='+cita+'&paciente='+paciente);
		$('.listaServiciosAplicados').load('index.php?c=historia&a=cargarTablaServicios&paciente='+paciente+'&fecha='+fecha);
	// },3000);

	$('#cbxEstado').select2({
		sorter: function(data) {
			return data.sort(function(a, b) {
				return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
			});
		}
	});

/*  COMENTADO EL 01-02-2024  */
	/*recargarLista();
	$('#cbxEstado').change(function(){
		recargarLista();
	});*/
});
</script>
