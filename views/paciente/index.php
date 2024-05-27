
                


<!-- BOTON QUE ACTIVA MODAL -->
<p></p>
<div class="">
    <?php if($this->accesoRegistrar){ ?>
      <button type="button" class="btn btn-success btn-lg active" id="abrirModal" title="Registrar">
      Registrar
    </button>
    <?php } ?>
</div>
<p></p>
<!-- FIN QUE ACTIVA MODAL -->


<!-- MODAL -->
<div class="modal fade" id="trackerModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" id="salir" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
                            <h3>Registrar paciente</h3>
                       
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" id="formulario" method="post" action="">
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="urlActual" value="index.php?c=paciente&a=guardar">
            <input type="hidden" id="controlador" name="controlador" value="paciente">
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="nombre"><b>Cédula:</b></label>
                <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp= buscarReg();keepNumOrDecimal(this);validarCedula() value="" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="9" minlength="7" required>
                <input type="hidden" id="inputVerificarReg" name="inputVerificarReg" value="cedula">
                <div id="verificarRegistro"></div>
                <div id="verificarCedula"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="descripcion"><b>Correo:</b></label>
                <input type="email" class="form-control" name="email" id="email" onKeyUp=validarEmail(); value="" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
                <div id="verificarEmail"></div>
              </div>
            </div>
            <!-- COLUMNA -->
            <div class="row">
            <div class="form-group col-md-6">
                <label for="observaciones"><b>Nombres:</b></label>
                <input type="text" id="nombres" name="nombres" onKeyUp=validarNombres(); class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
                <div id="verificarNombres"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Apellidos:</b></label>
                <input type="text" name="apellidos" id="apellidos" onKeyUp=validarApellidos(); class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
                <div id="verificarApellidos"></div>
              </div>
            </div>

            
            
            <!-- COLUMNA -->
            <div class="row">
              
              <div class="form-group col-md-3">
                <label for="fecha_ini"><b>Fecha de nacimiento:</b></label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
              </div>
              <div class="form-group col-md-3">
                <label for="fecha_ini"><b>Género:</b></label>
                <select  name="sexo" id="sexo" class="form-select" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="x">Selecciona</option>
                                <option value="m">M</option>
                                <option value="f">F</option>
                </select>
              </div>

              <div class="form-group col-md-3">
                <label for="descripcion"><b>Teléfono:</b></label>
                  <select class="form-select" name="codtlfn" id="codtlfn" class="form-select form-select-lg mb-1" required>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                  </select>
              </div>
              <div class="form-group col-md-3">
                <br>
                <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this);validarTlfno() id="telefono" value="" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
                <div id="verificarTlfno"></div>
              </div>

            </div>

            
            <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Dirección:</b></label>
                <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="3" placeholder="Direccion" maxlength="100" required></textarea>
          
            </div>
           
          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" id="btnguardar" class="btn btn-outline-success">Registrar</button>
       
        <button type="button" id="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
     </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->


<div id="apartado1" align='center'>
<h3>Pacientes</h3>
</div>



  <table id="example" class="table table-hover">
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Cédula</th>
                <th>Nombres Apellidos</th>
                <th></th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>

<br><br><br>
        



    <!--<script type="text/javascript" src="resources/datatables.js"></script>-->
    

<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL PACIENTE BUSCADO -->


<!--<script>
$(document).ready(function() {
    $("#resultadoBusqueda").html('');
    //console.log('hola');
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
</script>-->
<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL PACIENTE -->

<!--<script>
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
</script>-->


<!-- FUNCICON JS PARA RECARGAR LOS REGISTROS SI EXISTE EL PACIENTE -->

<!--<script>
setInterval( function(){
    $('#tablaPaciente').load('index.php?c=paciente&a=cargarTablaPacientes');
},3000)
</script>-->


