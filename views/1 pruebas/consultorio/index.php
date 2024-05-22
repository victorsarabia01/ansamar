

<!-- BOTON QUE ACTIVA MODAL -->.
<div class="col-md-8">
    <?php if($this->accesoRegistrar){ ?>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Registrar
        </button>
    <?php } ?>
</div>
<p></p>
<!-- FIN QUE ACTIVA MODAL -->



<!-- BOTON BUSCAR -->
    <div class="col-md-8">
        <?php if($this->accesoConsultar){ ?>
            <div class="input-group">
                <input type="search" onkeypress="return permite(event, 'num_car')" onKeyUp="buscar();" name="busqueda" id="busqueda" class="form-control rounded"  autocomplete="off" placeholder="Nombre del consultorio" aria-label="Search" aria-describedby="search-addon" maxlength="50" />
                <button type="button" class="btn btn-outline-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg>
                </button>
            </div>
        <?php } ?>
    </div>
<p></p>
<!-- MODAL PARA REGISTRAR -->
<div class="modal fade" style="overflow-y: scroll;" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
<div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <h3>Registrar consultorio</h3>
                       
                        </div>
                       
                    <form class="form-horizontal" method="post" action="index.php?c=consultorio&a=guardar">
                        <div class="col-md-40">
                        <input type="hidden" name="id" id="id" value="">
                       
                        </div>
                        
                        <div class="col-md-40">
                            </label><b>Nombre:</b></label>
                            <input type="text area" id="descripcion" name="descripcion" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarConsultorio();" class="form-control" value="" aria-describedby="emailHelp" placeholder="Ejemplo. Dental la 48" maxlength="50" required>
                      
              
                        </div>
                        <div id="verificarRegistroConsultorio"></div>
            
                        <div class="col-md-40">
                        </label><b>Dirección:</b></label>
                        <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. Carrera 13A entre 3 y 5 San Francisco" maxlength="100" required></textarea>
                        </div>
          
                        <div class="col-md-40">
                        </label><b>Cantidad de sillón dental:</b></label>
                       
                        <select class="form-select form-select-lg mb-1" name="sillas" id="sillas" class="form-select form-select-lg mb-1" required>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                        </div>
              
            <div class="row">
              <!--<div class="form-group col-md-6">
                <input type="hidden" name="id" id="id" value="<?php echo $alm->id; ?>">
                <label for="nombre"><b>Cod:</b></label>

                <select name="codTlfno" id="codTlfno" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Selecciona</option>
                                <option value="0412">0412</option>
                                <option value="0414">0414</option>
                                <option value="0424">0424</option>
                                <option value="0416">0416</option>
                                <option value="0426">0426</option>
                                <option value="5">Otro</option>
            </select>
            <div class="form-group col-md-6">
            <input id="codTlfno1" name="codTlfno1" class="form-control" onkeyup= keepNumOrDecimal(this) type="text" maxlength="4" disabled>
            </div>
              </div>-->
              <div class="form-group col-md-6">
                <label for="nombre"><b>Número teléfono:</b></label>
                <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
              </div>
            </div>                      
                            
                            
                     
                        
            
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" href="?c=guardarConsultorio" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Registrar</button>
        <button type="button" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN DEL MODAL -->
<div class="row" style="overflow-x: scroll;">
<div id="resultadoBusqueda"></div>
<div id="tablaConsultorio"></div>
</div>
<!-- COMIENZO DE TABLA QUE MUESTRA LOS REGISTROS -->
<!--<div id="recargarTable">
<div class="row">
	<div class="row">
      <div class="col-md-12 text-center">
        <h3>Consultorio</h3>
      </div>
    </div>

			<div class="col-md-12 text-center">
				<table class="table table-hover">
					<tr class="table-secondary">
					 
						<th>Consultorio</th>
						<th>Direccion</th>
						<th>Telefono</th>
            <th>Sillas</th>
						<th>Estado</th>
						<th></th>
						<th></th>
			    
					
						
					</tr>
					<?php //foreach ($this->mode->listarConsultorios() as $k) : ?>
						
						<tr>
							<td><?php echo $k->descripcion; ?></td>
							<td><?php echo $k->direccion; ?></td>
							<td><?php echo $k->tlfno; ?></td>
              <td><?php echo $k->sillas; ?></td>
							<td><?php if ($k->status == "1"){
                echo 'Activo';
              }else{
                echo 'Inactivo';
              } ?></td>
							
					
							<td>
								
                <a href="index.php?c=consultorio&a=editar&id=<?php echo $k->id; ?>" type="button" class="btn btn-outline-primary">
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

				<?php //endforeach; ?>
					
				</table>
				
				
			</div>
		</div>
</div>-->
<!-- FIN DE TABLA QUE MUESTRA LOS REGISTROS -->
<!--<div class="row" style="overflow-x: scroll;">
<div class="container my-5">
<div class="row">
<div class="row">
      <div class="col-md-12 text-center">
      
        <h3>Consultorios</h3>

      </div>
    </div>
<table class="table table-hover" id="mitabla">
  <caption>
    consultorios
  </caption>
    <thead>
        <tr class="table-secondary">
            <th>consultorio</th>
            <th>direccion</th>
            <th>telefono</th>
            <th>sillas</th>
            <th>status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
      <?php //foreach ($this->mode->listarConsultorios() as $k) : ?>
            
            <tr>
              <td><?php echo $k->descripcion; ?></td>
              <td><?php echo $k->direccion; ?></td>
              <td><?php echo $k->tlfno; ?></td>
              <td><?php echo $k->sillas; ?></td>
              <td><?php if ($k->status == "1"){
                echo 'Activo';
              }else{
                echo 'Inactivo';
              } ?></td>
              
          
              <td>
                
                <a href="index.php?c=consultorio&a=editar&id=<?php echo $k->id; ?>" type="button" class="btn btn-outline-primary">
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


        <?php //endforeach; ?>
    </tbody>
</table>
</div>
</div>
</div>


	<script type="text/javascript">

		$(".eliminar").click(function(e){
     	console.log('pasa');
    e.preventDefault();
    var id = $(this).attr('id');
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

    </script>-->

<!-- FUNCICON JS PARA BUSCAR REGISTROS -->

<script>
$(document).ready(function() {
    $("#resultadoBusqueda").html('');
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=consultorio&a=buscarRegistro", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
};
</script>
<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL CONSULTORIO -->

<script>
$(document).ready(function() {
    $("#verificarRegistroConsultorio").html('');
});

function buscarConsultorio() {
    var textoBusqueda = $("input#descripcion").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=consultorio&a=verificarRegistroConsultorio", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroConsultorio").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroConsultorio").html('');
        };
};
</script>


<script type="text/javascript">
  $( function() {
    $("#codTlfno").change( function() {
        if ($(this).val() == "5") {
            $("#codTlfno1").prop("disabled", false);
        } else {
            $("#codTlfno1").prop("disabled", true);
        }
    });
});
</script>

<script>
setInterval( function(){

$('#tablaConsultorio').load('index.php?c=consultorio&a=cargarTablaConsultorios');

},3000)
</script>



    
