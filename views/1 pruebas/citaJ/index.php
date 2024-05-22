
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    

<p></p>
<!-- BUTTON MODAL -->
<div class="col-md-8">
  <?php if($this->accesoRegistrar){ ?>
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#trackerModal">
      Agendar
    </button>
  <?php } ?>
<p></p>
</div>
<!-- BOTON BUSCAR -->
  <div class="col-md-8">
    <?php if($this->accesoConsultar){ ?>
      <div class="input-group">
        <input type="search" onKeyUp="buscar();keepNumOrDecimal(this)" name="busqueda" id="busqueda" maxlength="8" class="form-control rounded" autocomplete="off" placeholder="Cédula del paciente" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-info">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
          </svg>
        </button>
      </div>
    <?php } ?>
  </div>
<p></p>

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
                            <h3>Hola, Agenda tu cita Aqui</h3>
                            <h6>(solicitud de cita)</h6>
                        </div>
                       
                    <form class="form-horizontal" method="post" action="index.php?c=cita&a=guardar">
                    
                        <div class="col-md-8">
                        
                            </label><b>Cédula:</b></label>
                            <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp="buscarPaciente();keepNumOrDecimal(this)" value="" aria-describedby="emailHelp" placeholder="Ejem. 22186490" maxlength="8" required>
                        </div>
                        <div id="resultadoBusquedaPacientex"></div>
                        <div class="col-md-8">
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
                        </div>


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
                            <div id="resultadoBusqueda"></div>
                            <div id="resultadoBusqueda1"></div>
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
                            <button type="submit" class="btn btn-outline-success">Registrar</button>
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
<div class="row" style="overflow-x: scroll;">
<div id="resultadoBusquedaConsulta"></div>
<div id="tablaCitas"></div>
</div>
 
  
<script type="text/javascript">
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
</script>



<script>
    
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
    </script>

    <script type="text/javascript"> // VALIDAR CAMPOS DE SOLO NUMERO Y LETRAS AL INPUT
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
    </script>

<script>
    
    $(document).ready(function(){
      alert('ASD');
        var odontologo = $('#cargarOdontologos');
        var mostrarDias = ${('#resultadoBusqueda');
        $('#turno').change(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();     
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologos', 

              }).done(function(data){   
                odontologo.html(data);
                //mostrarDias.html(data);         
              });      
            
        });


        $('#cargarOdontologos').click(function(){
          

          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologosDias', 

              }).done(function(data){   
                mostrarDias.html(data);         
              });      
            
        });

        //ESTO ES LO NUEVO 08-08-23
        $('#turno').click(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologosDias', 

              }).done(function(data){   
                mostrarDias.html(data);         
              });      
            
        });
        $('#turno').click(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologos', 

              }).done(function(data){   
                odontologo.html(data);         
              });      
            
        });
        //prueba
        $('#turno').change(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologos', 

              }).done(function(data){   
                odontologo.html(data);       
              });      
            
        });
        $('#turno').change(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologosDias', 

              }).done(function(data){   
                mostrarDias.html(data);         
              });      
            
        });
        $('#consultorio').change(function(){
          $("#cargarOdontologos option").remove();
          $("#resultadoBusqueda option").remove();
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologosDias', 

              }).done(function(data){   
                mostrarDias.html(data);         
              });      
            
        });

</script>
<!--<script type="text/javascript">
  $(document).ready(function(){
    var prueba = $('#resultadoBusquedax');
    //prueba.html('<h1> HOLA </h1>');  
    console.log('hola');
    $.ajax({
              data: {}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=listarCitasAjax', 

              }).done(function(data){   
                prueba.html(data);
                //prueba.html('<h1> HOLAdd </h1>');         
              }); 
  });
function Hola(nombre,mensaje) {
     var parametros = {"Nombre":nombre,"Mensaje":mensaje};
$.ajax({
    data:parametros,
    url:'procesoAjax.php',
    type: 'post',
    beforeSend: function () {
        $("#resultado").html("Procesando, espere por favor");
    },
    success: function (response) {   
        $("#resultado").html(response);
    }
});
}
</script>-->

<!-- FUNCICON JS PARA BUSCAR REGISTROS -->

<script>
$(document).ready(function() {
    $("#resultadoBusquedaConsulta").html('');
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=cita&a=buscarRegistro", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusquedaConsulta").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#resultadoBusquedaConsulta").html('');
        };
};
</script>

<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL CLIENTE -->

<script>
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
</script>



<script>
setInterval( function(){

$('#tablaCitas').load('index.php?c=cita&a=listarCitasAjax');

},3000)
</script>


    
