
<div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
  
  <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <h3>Planificación mensual de atención en consultorios</h3>
                        </div>

                      
                    <form class="form-horizontal" method="post" action="index.php?c=planificacion&a=guardar">
              

                        <div class="col-md-8">
                           
                             <select name="consultorio" id="consultorio" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Consultorio</option>
                                <?php foreach ($this->mode->Consultar("listarTodosConsultorios")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->descripcion ?></option>
                                <?php endforeach ?>
                            </select>
                           
                            <select name="turno" id="turno" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Turno</option>
                                <option value="1">Mañana</option>
                                <option value="2">Tarde</option>
                            </select>
                    
                            <select name="doctor" id="doctor" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                              <option value="0">Odontologo</option>
                                <?php foreach ($this->mode->Consultar("listarTodosDoctores")  as $k) : ?>
                                    <option value="<?php echo $k->id_empleado ?>"> <?php echo $k->nombres." ".$k->apellidos?></option>
                                <?php endforeach ?>
                            </select>
                            <!--<select name="diaSemana" id="diaSemana" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                              <option value="0">Dia</option>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miercoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sabado</option>
                            </select>-->
                        </div>

                        
                        </div>
                        <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group" id="prueba">
                        <input type="checkbox" class="btn-check" value="1" name="btncheck1" id="btncheck1" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck1">Lunes</label>
                        <input type="checkbox" class="btn-check" name="btncheck2" id="btncheck2" value="1" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck2">Martes</label>
                        <input type="checkbox" value="1" class="btn-check" id="btncheck3" name="btncheck3" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck3">Miercoles</label>
                    
                        <input type="checkbox" value="1" class="btn-check" id="btncheck4" name="btncheck4" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck4" >Jueves</label>
                        <input type="checkbox" value="1" class="btn-check" id="btncheck5" name="btncheck5" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck5">Viernes</label>
                        <input type="checkbox" value="1" class="btn-check" id="btncheck6" name="btncheck6" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck6">Sabado</label>
                        </div>
                  
                            <button type="submit" href="?c=guardar" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar planificación</button>
                      
                     
                        
            </form>
  </div>
</div>
</div>

<!-- BUTTON BUSCAR -->
<div class="container">
	
                <div class="col-md-8">
                        <div class="input-group">
                            <input type="search" onKeyUp="buscar();" name="busqueda" id="busqueda" class="form-control rounded mayusculas buscar" autocomplete="off" placeholder="Nombre del consultorio" aria-label="Search" aria-describedby="search-addon" maxlength="50" />
                        
                          <button type="button" class="btn btn-outline-info">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                          </svg>
                          </button>
                        </div>
                </div>
              </div>  
                       
		<p></p>
<!-- BUTTON BUTTON BUSCAR -->

<!-- RESULTADO BUSQUEDA-->
<div class="row" style="overflow-x: scroll;">
<div id="resultadoBusqueda"></div>
<div id="tablaPlanificacion"></div>
</div>
<!-- COMIENZO DE LA TABLE-->
<!--<div id="recargarTable">
		<div class="row">
			<div class="col-md-12 text-center">
				<table class="table table table-hover">
					<tr class="table-secondary">
					   
            <th>Odontologo</th>
						<th>Consultorio</th>
						<th>Dia</th>
						<th>turno</th>
						
						
						<th></th>
						<th></th>
						<th></th>
						
						
					</tr>
					<?php //foreach ($this->mode->listarPlanificacion() as $k) : ?>
						
						<tr>
              <td><?php echo $k->nombres; ?> <?php echo $k->apellidos; ?></td>
							<td><?php echo $k->consultorio; ?></td>
							<td><?php echo $k->dia_semana; ?></td>
							<td><?php echo $k->turno; ?></td>
							
					
						
							<td>
								
              <button href="#" type="button" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                </svg>
              </button>
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
<!-- FIN DE LA TABLE-->

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
        window.location.href="index.php?c=planificacion&a=eliminar&id="+id;
      } else {
    //Si se cancela se emite un mensaje
        swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
      }
    });
    });



    });
     

    </script>

<!--<script>
   $(document).ready(function(){
      
   window.setInterval(function(){
     $("#recargarTable").load(window.location.href + " #recargarTable" );
   }, 1000);
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
        $.post("index.php?c=planificacion&a=buscarRegistro", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
};
</script>



<script>
setInterval( function(){

$('#tablaPlanificacion').load('index.php?c=planificacion&a=tablaPlanificacion');

},3000)
</script>

<script type="text/javascript">
   $("input.buscar").bind('keypress', function(event) {
                          var regex = new RegExp("^[a-zA-Z ]+$");
                          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                          if (!regex.test(key)) {
                          event.preventDefault();
                          return false;
                          }
                          });
</script>


