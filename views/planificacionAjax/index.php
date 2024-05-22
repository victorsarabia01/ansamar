
<div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
  
  <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <h3>Planificación mensual de atención en consultorios</h3>
                        </div>

                      
                    <!--<form class="form-horizontal" method="post" id="formulario" action="index.php?c=planificacion&a=guardar">-->
                    <form class="form-horizontal" method="post" id="formulario" action="">

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
                  
                            <button type="submit" href="?c=guardar" value="Guardar" name="registrar" id="btnguardar" class="btn btn-outline-success">Guardar planificación</button>
                      
                     
                        
            </form>
  </div>
</div>
</div>

<div id="liveAlertPlaceholder"></div>


<!-- BUTTON BUSCAR -->
<div class="container">
	
                <div class="col-md-8">
                        <div class="input-group">
                            <input type="search" onKeyUp="buscar();" name="busqueda" id="busqueda" class="form-control rounded mayusculas buscar" autocomplete="off" placeholder="Nombre del consultorio" aria-label="Search" aria-describedby="search-addon" maxlength="50" />
                        
                          <button type="button" class="btn btn-outline-info">
                          <i class="bi bi-search"></i>
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

<script type="text/javascript">
  const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
  const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
  }

  const alertTrigger = document.getElementById('liveAlertBtn')
  if (alertTrigger) {
    alertTrigger.addEventListener('click', () => {
      appendAlert('Nice, you triggered this alert message!', 'success')
    })
  }
</script>


<script type="text/javascript">
  $(document).ready(function(){
$('#btnguardar').click(function(){
  var datos=$('#formulario').serialize();

    /*alert(datos);
    return false;*/
    $.ajax({
      type:"POST",
      url:"index.php?c=planificacion&a=guardar",
      data:datos,
      success:function(r){
        if(r==0){
          swal("Error", "Selecciona todas las opciones", "error")
          //appendAlert('Selecciona todas las opciones', 'danger')
        }
        //LUNES
        if(r==1){
          console.log('hola');
          swal("Error", "Ya tiene asignado turno los Lunes en el consultorio Seleccionado", "error")
          //appendAlert('Lunes: Ya tiene asignado turno los Lunes en el consultorio Seleccionado', 'danger')
        }
        if(r==2){
          //swal("Error", "Odontologo ocupado los Lunes en otro Consultorio", "error")
          appendAlert('Lunes: Odontologo ocupado los Lunes en otro Consultorio', 'danger')
        }
        if(r==3){
          //swal("Error", "No hay sillas disponibles", "error")
          appendAlert('Lunes: no hay sillas disponibles en el turno', 'danger')
        }
        if(r==4){
          //swal("Good job!", "Lunes Planificación registrada", "success")
          appendAlert('Lunes: Turno asignado los Lunes', 'success')
        }
        //MARTES
        if(r==5){
          console.log('hola');
          swal("Error", "Ya tiene asignado turno los Martes en el consultorio Seleccionado", "error")
          //appendAlert('Martes: Ya tiene asignado turno los Martes en el consultorio Seleccionado', 'danger')
        }
        else if(r==6){
          //swal("Error", "Odontologo ocupado los Lunes en otro Consultorio", "error")
          appendAlert('Martes: Odontologo ocupado los Martes en otro Consultorio', 'danger')
        }
        else if(r==7){
          //swal("Error", "No hay sillas disponibles", "error")
          appendAlert('Martes: no hay sillas disponibles en el turno', 'danger')
        }else if(r==8){
          //swal("Good job!", "Lunes Planificación registrada", "success")
          appendAlert('Martes: Turno asignado los Martes', 'success')
        } 

      }

    });
    return false;
  }); 
});
</script>