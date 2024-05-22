
<!-- BOTON QUE ACTIVA MODAL -->.
<div class="col-md-8">
    <?php if($this->accesoRegistrar){ ?>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#trackerModal">
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
                <input type="search" onKeyUp="buscar();keepNumOrDecimal(this)" name="busqueda" id="busqueda" class="form-control rounded" autocomplete="off" placeholder="Cédula del paciente" aria-label="Search" aria-describedby="search-addon" maxlength="8" />
                <button type="button" class="btn btn-outline-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg>
                </button>
            </div>
        <?php } ?>
    </div>
<p></p>

<!-- FIN DEL BOTON BUSCAR -->

<!-- MODAL -->
<div class="modal fade" id="trackerModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
                            <h3>Registrar paciente</h3>
                       
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" method="post" action="index.php?c=paciente&a=guardar">
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="nombre"><b>Cédula:</b></label>
                <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp= buscarPaciente();keepNumOrDecimal(this) value="" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="9" minlength="7" required>
                <div id="verificarRegistroPaciente"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="descripcion"><b>Correo:</b></label>
                <input type="email" class="form-control" name="email" id="email" value="" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
              </div>
            </div>
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Nombres:</b></label>
                <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
              </div>
              <div class="form-group col-md-6">
                <label for="descripcion"><b>Teléfono:</b></label>
                <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
              </div>
            </div>
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Apellidos:</b></label>
                <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
              </div>
              <div class="form-group col-md-3">
                <label for="fecha_ini"><b>Fecha de nacimiento:</b></label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
              </div>
              <div class="form-group col-md-3">
                <label for="fecha_ini"><b>Género:</b></label>
                <select  name="sexo" id="sexo" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="x">Selecciona</option>
                                <option value="m">M</option>
                                <option value="f">F</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Dirección:</b></label>
                <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="3" placeholder="Direccion" maxlength="100" required></textarea>
          
              </div>

              
            </div>
           
          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success">Registrar</button>
       
        <button type="button" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
     </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->

<div class="row" style="overflow-x: scroll;">
    <div id="resultadoBusqueda"></div>
    <div id="tablaPaciente"></div>
</div>

<!--
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
  
  <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <h3>Aqui puedes, Registrar Paciente</h3>
                       
                        </div>
                       
                     <form class="form-horizontal" method="post" action="index.php?c=paciente&a=guardar">
                        <div class="col-md-8">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $alm->id; ?>">
                        <input type="hidden" name="cedulaAmigo" id="cedulaAmigo" value="">

                            <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp= keepNumOrDecimal(this) value="" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="8" required>
                        </div>
              
                        <div class="col-md-8">
                            <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
                        </div>
                         <div class="col-md-8">
                            <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
                        </div>
						<div class="col-md-8">
                            
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
						
						<div class="col-md-8">
                        
                            <input type="text" class="form-control" name="email" id="email" value="" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
                        </div>


                        <div class="col-md-8">
                        
                            <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
                        </div>
						<div class="col-md-8">

                        <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="<?php echo $alm->direccion; ?>" rows="3" placeholder="Direccion" maxlength="100" required></textarea>
						</div>


                        
                        

                        <div class="col-md-8">

                                
                           
                           
                             
                         
                        </div>
                        <div id="resultadoBusqueda"></div>
                        <div id="resultadoBusqueda1"></div>
                        <br>
                        <div class="col-md-8">
                            <div class="g-recaptcha" data-sitekey="6Lcc4xInAAAAAIhChEIZvj71HnTxRnwBqVgK6daJ"></div>
                        </div>


                        <br>

                  
                            <button type="submit" href="?c=guardar" value="Guardar" name="registrar" id="registrar" class="btn btn-success">Guardar</button>
                        
                          
                     
                        
            </form>
  </div>
</div>
-->
<!--
<div class="container">
<div class="row">
			<div class="col-md-12 text-center">
				<table class="table">
					<tr class="table-secondary">
					
						<th>Cedula</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						
						<th>Telefono</th>
						<th>Email</th>
						<th>Direccion</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						
					</tr>
					<?php //foreach ($this->mode->listarPaciente() as $k) : ?>
						
						<tr>
							<td><?php echo $k->cedula; ?></td>
							<td><?php echo $k->nombres; ?></td>
							<td><?php echo $k->apellidos; ?></td>
                        
							<td><?php echo $k->tlfno; ?></td>
							<td><?php echo $k->email; ?></td>
					       <td><?php echo $k->direccion; ?></td>
							<td>
								<a href="index.php?c=paciente&a=editar" class="btn btn-primary">>Editar<</a>
							</td>
							<td>
								<a href="#" class="btn btn-info">VerFicha</a>
							</td>
							<td>
								<a href="#" class="btn btn-warning">Asignar Condicion Medica</a>
							</td>
						

						</tr>

				<?php //endforeach; ?>
					
				</table>
			
				
			</div>
		</div>

</div>-->



<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL PACIENTE BUSCADO -->
<script>
$(document).ready(function() {
    $("#resultadoBusqueda").html('');
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=paciente&a=buscarRegistro", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
};
</script>
<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL PACIENTE -->

<script>
$(document).ready(function() {
    $("#verificarRegistroPaciente").html('');
});

function buscarPaciente() {
    var textoBusqueda = $("input#cedula").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=paciente&a=verificarRegistroPaciente", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroPaciente").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroPaciente").html('');
        };
};
</script>


<!-- FUNCICON JS PARA RECARGAR LOS REGISTROS SI EXISTE EL PACIENTE -->

<script>
setInterval( function(){
    $('#tablaPaciente').load('index.php?c=paciente&a=cargarTablaPacientes');
},3000)
</script>


