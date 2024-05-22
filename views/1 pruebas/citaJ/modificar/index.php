
<!-- MODAL -->
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=cita" class="btn-close" aria-label="Close"></a>
      </div>

      <div class="modal-body">
        <div class="container-fluid">

<!-- COMIENZO DE FORMULARIO -->
<div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">

  <div class="card-body">
                    <div class="alert alert-success" role="alert">
                            <h3>Modificar cita</h3>
                           
                        </div>
                       
                    <form class="form-horizontal" method="post" action="index.php?c=cita&a=modificar">
                    
                        <div class="col-md-8">
                            <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                            <input type="hidden" name="cedula1" id="cedula1" value="<?php echo $this->alm->cedula; ?>">
                            </label><b>Cédula:</b></label>
                            <input type="hidden" id="id" value="<?php echo $this->alm->id ?>" name="">
                            <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp="buscarPaciente();keepNumOrDecimal(this)" value="<?php echo $this->alm->cedula ?>" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="8" disabled required >
                        </div>
                        <div id="resultadoBusquedaPacientex"></div>
                        <div class="col-md-8">
                            </label><b>Nombres:</b></label>
                            <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="<?php echo $this->alm->nombres ?>" aria-describedby="emailHelp" placeholder="Nombres" maxlength="45" disabled required>
                        </div>
                         <div class="col-md-8">
                            </label><b>Apellidos:</b></label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="<?php echo $this->alm->apellidos ?>" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="45" disabled required>
                        </div>

                        <div class="col-md-8">
                            </label><b>Teléfono:</b></label>
                            <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="<?php echo $this->alm->tlfno ?>" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" disabled required>
                        </div>
                        <div class="col-md-8">
                            </label><b>Correo:</b></label>
                            <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $this->alm->email ?>" aria-describedby="emailHelp" placeholder="ejemplo@gmail.com" maxlength="50" disabled required>
                        </div>

                        <div class="col-md-8">
                           
                             <select name="consultorio" id="consultorio" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                
                                <?php foreach ($this->mode->Consultar("listarTodosConsultorios")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->consultorio ? 'selected' : ''; ?>><?php echo $k->descripcion ?></option>
                                <?php endforeach ?>
         
                            </select>
                            
                            <select name="turno" id="turno" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                 <?php foreach ($this->mode->Consultar("listarTodosTurnos")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->turno ? 'selected' : ''; ?>><?php echo $k->descripcion ?></option>
                                <?php endforeach ?>
                            </select>
                    
                            
                            <select name="cargarOdontologos" id="cargarOdontologos" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->Consultar("listarTodosDoctores")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->odontologo ? 'selected' : ''; ?>><?php echo $k->nombres ?> <?php echo $k->apellidos ?></option>
                                <?php endforeach ?>
                            </select>
                        
                        </div>
                        <div class="col-md-8">
                            <h3><label>Días que atiende el odontólogo</label></h3>
                            <div id="resultadoBusqueda"></div>
                            <div id="resultadoBusqueda1"></div>
                        </div>
                        
                        <br>
                        <div class="col-md-8">
                            
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $this->alm->fecha?>" required>
                        </div>
                        <div class="col-md-8">
                            <div class="g-recaptcha" data-sitekey="6Lcc4xInAAAAAIhChEIZvj71HnTxRnwBqVgK6daJ"></div>
                        </div>


                        

                  
                            <div class="modal-footer">
                            <button type="submit" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar</button>
                             <a class="btn btn-outline-danger" href="index.php?c=cita">Cancelar</a>
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

<script>
  $(document).ready(function(){
    exampleModal.style.display = 'block';
  });

let modal1 = document.getElementById('exampleModal');
let flex1 = document.getElementById('flex1');
let abrirModificar = document.getElementById('abrirModificar');
let cerrar1 = document.getElementById('close1');

abrirModificar.addEventListener('click', function(){
    modal1.style.display = 'block';
});

cerrar1.addEventListener('click', function(){
    modal1.style.display = 'none';
});

window.addEventListener('click', function(e){
    console.log(e.target);
    if(e.target == flex1){
        modal1.style.display = 'none';
    }
});

</script>

<script>
  $(document).ready(function(){
    exampleModal.style.display = 'block';
  });

let modal1 = document.getElementById('exampleModal');
let flex1 = document.getElementById('flex1');
let abrirModificar = document.getElementById('abrirModificar');
let cerrar1 = document.getElementById('close1');

abrirModificar.addEventListener('click', function(){
    modal1.style.display = 'block';
});

cerrar1.addEventListener('click', function(){
    modal1.style.display = 'none';
});

window.addEventListener('click', function(e){
    console.log(e.target);
    if(e.target == flex1){
        modal1.style.display = 'none';
    }
});

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
    
        var odontologo = $('#cargarOdontologos');
        var mostrarDias = $('#resultadoBusqueda');
        /*$('#turno').change(function(){
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
            
        });*/


        

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
               
            
        });

         
        $('#cargarOdontologos').change(function(){
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
        
        

    });
</script>