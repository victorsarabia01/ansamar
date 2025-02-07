<?php
	//include_once 'controller/control.php';
?>
<html>
<head>
	<title></title>
	
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h3>Citas Registradas Del Mes en curso</h3>
			</div>
		</div>
		<div class="">
			<a href="?c=cita" class="btn btn-block btn-success">Agendar Cita</a>
			
		</div>
		
		<br>
		<div class="row">
			<div class="col-md-12 text-center">
				<table class="table">
					<tr class="table-secondary">
						
						<th>fecha</th>
						<th>Consultorio</th>
						<th>cliente</th>
						<th>telefono</th>
						<th>turno</th>
						<th>doctor</th>
						<th></th>
						<th></th>
						
						
						
					</tr>
					<?php foreach ($this->mode->listarCitas() as $k) : ?>
						
						<tr>
							<td><?php echo $newDate = date("d-m-Y", strtotime($k->fecha)); ?></td>
							<td><?php echo $k->consultorio; ?></td>
							<td><?php echo $k->nombres; ?><?php echo $k->apellidos; ?></td>
							<td><?php echo $k->tlfno; ?></td>
							<td><?php echo $k->turno; ?></td>
							<td><?php echo $k->nombresDoctor; ?><?php echo $k->apellidosDoctor; ?></td>
							
							
							<td>
								<a href="index.php?c=cita&a=editar&id=<?php echo $k->id; ?>" type="button" class="btn btn-outline-primary">
                				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                				<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                				<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                				</svg>
                				</a>
							</td>
							<td>
								<button href="#" id="<?php echo $k->id; ?>" type="button" class="btn btn-outline-danger eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                </svg>
                </button>
							</td>

						</tr>

				<?php endforeach; ?>
					
				</table>
				<!--<div class="row">
				<a href="?c=nuevaDonacion" class="btn btn-block btn-success">Nuevo Registro</a>
				</div>-->
				
			</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){

		$(".eliminar").click(function(e){
     	console.log('pasa');
    e.preventDefault();
    var id = $(this).attr('id');
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
        window.location.href="index.php?c=cita&a=eliminar&id="+id;
      } else {
    //Si se cancela se emite un mensaje
        swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
      }
    });
    });



	});
     

    </script>



</body>
</html>