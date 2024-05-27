

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Moment.js: -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.4/moment.min.js"></script>
<!-- Locales for moment.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.4/locale/es.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/datetime-moment.js"></script>

<link rel="stylesheet" href="resources/css/datatable.css">

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">






<p></p>
<!-- BUTTON MODAL -->
<div class="">
  <?php if($this->accesoRegistrar){ ?>

    <button type="button" class="btn btn-success btn-lg active" id="abrirModal" title="Registrar">
      Registrar
    </button>
  <?php } ?>
  <p></p>
</div>


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
        <div class="container-fluid">

          <!-- COMIENZO DE FORMULARIO -->
          <div class="row justify-content-center">
            <div class="card text-dark bg-light mb-3" style="max-width: 40rem;">

              <div class="card-body">
                <div class="alert alert-success" role="alert">
                  <h3>Agendar cita</h3>

                </div>

                <form class="form-horizontal" id="formulario" method="post" action="">
                  <input type="hidden" id="id" name="id">
                  <input type="hidden" id="urlActual" value="index.php?c=cita&a=guardar">
                  <input type="hidden" id="controlador" value="cita">
                  <!-- BOTON BUSCAR PACIENTE -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <?php if($this->accesoConsultar){ ?>
                        <div class="input-group">
                          <input type="search" onKeyUp="buscarPacienteReg();keepNumOrDecimal(this)" name="busquedaPaciente" id="busquedaPaciente" maxlength="8" class="form-control rounded" autocomplete="off" placeholder="Cédula del paciente" aria-label="Search" aria-describedby="search-addon" />
                          <button type="button" class="btn btn-outline-info">
                            <i class="bi bi-search"></i>
                          </button>
                        </div>
                      <?php } ?>
                    </div>
                              <!--<div class="form-group col-md-6">
                              <button type="button" class="btn btn-outline-success">Registrar Paciente</button>
                            </div>-->
                          </div>
                          <p></p>
                          <div class="col-md-8">
                          </label><b>Paciente:</b></label>
                          <select name="resultadoBusquedaPaciente" id="resultadoBusquedaPaciente"class="form-control" required>
                          </select>

                          <!--<div id="resultadoBusquedaPacientexx"></div>-->

                          <!--<div id="resultadoBusqueda1"></div>-->
                        </div>
                        
                        <div class="col-md-8">


                            <!--</label><b>Cédula:</b></label>
                              <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp="buscarPaciente();keepNumOrDecimal(this)" value="" aria-describedby="emailHelp" placeholder="Ejem. 22186490" maxlength="8" required>-->
                            </div>
                            <!--<div id="resultadoBusquedaPacientex"></div>-->
                       <!-- <div class="col-md-8">
                            </label><b>Nombres:</b></label>
                            <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Ejem Juan Carlos" maxlength="45" required>
                        </div>
                         <div class="col-md-8">
                         </label><b>Apellidos:</b></label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Ejem Perez Linares" maxlength="45" required>
                        </div>

                        <div class="col-md-8">
                            </label><b>Teléfono:</b></label>
                            <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
                        </div>
                        <div class="col-md-8">
                            </label><b>Correo:</b></label>
                            <input type="email" class="form-control" name="correo" id="correo" value="" aria-describedby="emailHelp" placeholder="ejemplo@gmail.com" maxlength="50" required>
                          </div>-->


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


                          <select name="cargarOdontologos" id="cargarOdontologos" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                          </select>


                        </div>
                        <div class="col-md-8">
                          <h3><label>Días que atiende el odontólogo</label></h3>
                          <div id="resultadoBusquedaDias"></div>

                          <!--<div id="resultadoBusqueda1"></div>-->
                        </div>
                        
                        <br>
                        <div class="col-md-8">

                          <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="col-md-8">
                          <div class="g-recaptcha" data-sitekey="6Lcc4xInAAAAAIhChEIZvj71HnTxRnwBqVgK6daJ"></div>
                        </div>


                        <br>


                        <div class="modal-footer">

                          <button type="submit" id="btnguardar" class="btn btn-outline-success">Registrar</button>
                          <button type="button" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>


                        
                      </form>

                    </div>
                  </div>
                </div>
                <!-- FIN DEL FORMULARIO -->

              </div>
            </div>
            <!--.modal-body-->


          </div>
          <!--.modal-content-->
        </div>
        <!--.modal-dialog-->
      </div>

      <!-- FIN MODAL -->

      <!-- COMIENZO DE LA TABLA -->

      <div id="apartado1" align='center'>
        <h3>Citas</h3>
      </div>

      <table id="example" class="table table-hover MarkTotal display responsive nowrap">


        <div class="col-md-12 text-center">
          <thead class="thead-dark">
            <tr class="table-dark">
              <th>Id</th>
              <th>Fecha</th>
              <th>Consultorio</th>
              <th>Turno</th>
              <th>Cedula</th>
              <th>Paciente</th>
              <th></th>
              <th>Telefono</th>
              <th>Correo</th>
              <th>Odontologo</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </div>
      </table>
      <br><br><br><br>

      <script src="resources/filtroCita.js"></script>























      <!--<script src="resources/ajax.js"></script>-->

<!--<script type="text/javascript">
  function comprobarNombre(valor, campo) {
  
  var mensaje = "";
  
  // comprobar los posibles errores
  if (this.value == "") {
    mensaje = "Coloque aqui su cedula Ejem. 22186490";
  }
  
  // mostrar/resetear mensaje (el mensaje se resetea poniendolo a "")
  this.setCustomValidity(mensaje);
}

var cedula = document.querySelector("#cedula");
var nombres = document.querySelector("#nombres");
// cuando se cambie el valor del campo o sea incorrecto, mostrar/resetear mensaje
cedula.addEventListener("invalid", comprobarNombre);
//nombres.addEventListener("invalid", comprobarNombre);
cedula.addEventListener("input", comprobarNombre);
</script>-->



<!--<script type="text/javascript" >
    
    // Forzar solo números y puntos decimales
    function keepNumOrDecimal(obj) {
     // Reemplace todos los no numéricos primero, excepto la suma numérica.
    obj.value = obj.value.replace(/[^\d.]/g,"");
     // Debe asegurarse de que el primero sea un número y no.
    obj.value = obj.value.replace(/^\./g,"");
     // Garantizar que solo hay uno. No más.
    obj.value = obj.value.replace(/\.{2,}/g,".");
     // Garantía. Solo aparece una vez, no más de dos veces
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
    }
  </script>-->

    <!--<script type="text/javascript"> // VALIDAR CAMPOS DE SOLO NUMERO Y LETRAS AL INPUT
                          //jQuery('.soloNumeros').keypress(function (tecla) {
                          //if (tecla.charCode < 48 || tecla.charCode > 57) return false;
                          //});
                          
                          $("input.buscar").bind('keypress', function(event) {
                          var regex = new RegExp("^[a-zA-Z ]+$");
                          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                          if (!regex.test(key)) {
                          event.preventDefault();
                          return false;
                          }
                          });
                        </script>-->


                        <!-- FUNCICON JS PARA BUSCAR REGISTROS -->



<!--<script>
$(document).ready(function() {
    $("#resultadoBusqueda").html('');
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=cita&a=buscarRegistro", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
};
</script>-->


<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL CLIENTE -->

<!--<script>
$(document).ready(function() {
    $("#resultadoBusquedaPaciente").html('');
});

function buscarPaciente() {
    var textoBusqueda = $("input#cedula").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=cita&a=buscarRegistroPaciente", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusquedaPaciente").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#resultadoBusquedaPaciente").html('');
        };
};
</script>-->



<!--<script>
setInterval( function(){

$('#tabla').load('index.php?c=cita&a=listarCitasAjax');

},3000)
</script>-->



