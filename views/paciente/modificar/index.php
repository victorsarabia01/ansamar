    
<!-- MODAL -->
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=paciente" class="btn-close" aria-label="Close"></a>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
                            <h3>Modificar paciente</h3>
                       
        </div>
        <div class="container-fluid">
          <form id="formulario" name="formulario" class="form-horizontal" method="post" action="">
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                <label for="nombre"><b>Cédula:</b></label>
                <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp= buscarPaciente();keepNumOrDecimal(this);validarCedula() value="<?php echo $this->alm->cedula; ?>" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="9" minlength="7" required>
                <input type="hidden" id="controlador" name="controlador" value="paciente">
                <input type="hidden" id="inputVerificarReg" name="inputVerificarReg" value="cedula">
                <input type="hidden" id="accion" value="index.php?c=paciente&a=modificar">
                <div id="verificarRegistroPaciente"></div>
                <div id="verificarCedula"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="descripcion"><b>Correo:</b></label>
                <input type="email" class="form-control" name="email" id="email" onKeyUp=validarEmail(); value="<?php echo $this->alm->email; ?>" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
                <div id="verificarEmail"></div>
              </div>
            </div>
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Nombres:</b></label>
                <input type="text" id="nombres" name="nombres" onKeyUp=validarNombres(); class="form-control mayusculas buscar" id="nombres" value="<?php echo $this->alm->nombres; ?>" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
                <div id="verificarNombres"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Apellidos:</b></label>
                <input type="text" name="apellidos" id="apellidos" onKeyUp=validarApellidos(); class="form-control mayusculas buscar" id="nombres" value="<?php echo $this->alm->apellidos; ?>" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
                <div id="verificarApellidos"></div>
              </div>
            </div>

            <div class="row">
              
              <div class="form-group col-md-3">
              <label for="descripcion"><b>Telefono:</b></label>
              <select class="form-select" name="codtlfn" id="codtlfn"  class="form-select form-select-lg mb-1" required>
                    <option value="<?php echo $this->alm->codtlfno ?>"><?php echo $this->alm->codtlfno?></option>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
              </div>

              <div class="form-group col-md-3">
                
                <br>
                <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this);validarTlfno() id="telefono" value="<?php echo $this->alm->tlfno; ?>" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
                <div id="verificarTlfno"></div>

              </div>

              <div class="form-group col-md-3">
                <label for=""><b>Fecha Nacimiento:</b></label>
                <input type="date" class="form-control" id="fecha" value="<?php echo $this->alm->fechaNacimiento; ?>" name="fecha" required>
              </div>
              <div class="form-group col-md-3">
                <label for=""><b>Género:</b></label>
                <select  name="sexo" id="sexo" class="form-select" aria-label="Ejemplo de .form-select-lg" required>
                  <option value="<?php echo $this->alm->sexo ?>"><?php echo $this->alm->sexo?></option>
                                
                                <option value="M">M</option>
                                <option value="F">F</option>
                </select>
              </div>

            </div>
            
            <!-- COLUMNA -->
            <!--<div class="row">
              
              <div class="form-group col-md-3">
                <label for="fecha_ini"><b>Fecha Nacimiento:</b></label>
                <input type="date" class="form-control" id="fecha" value="<?php echo $this->alm->fechaNacimiento; ?>" name="fecha" required>
              </div>
              <div class="form-group col-md-3">
                <label for="fecha_ini"><b>Género:</b></label>
                <select  name="sexo" id="sexo" class="form-select" aria-label="Ejemplo de .form-select-lg" required>
                  <option value="<?php echo $this->alm->sexo ?>"><?php echo $this->alm->sexo?></option>
                                
                                <option value="M">M</option>
                                <option value="F">F</option>
                </select>
              </div>
              
              
            </div>-->

            <div class="row">

              <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Dirección:</b></label>
                <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="3" placeholder="Direccion" maxlength="100" required><?php echo $this->alm->direccion; ?></textarea>
          
              </div>
              
            </div>
             
            
          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" name="btnmodificar" id="btnmodificar" class="btn btn-outline-success">Guardar</button>
        <a class="btn btn-outline-danger" href="index.php?c=paciente">Cancelar</a>
      </div>
     </form> 
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
//let abrirModificar = document.getElementById('abrirModificar');
let cerrar1 = document.getElementById('close1');

/*abrirModificar.addEventListener('click', function(){
    modal1.style.display = 'block';
});*/

/*cerrar1.addEventListener('click', function(){
    modal1.style.display = 'none';
});*/

window.addEventListener('click', function(e){
    //console.log(e.target);
    if(e.target == flex1){
        modal1.style.display = 'none';
    }
});

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


<script>
$(document).ready(function() {
  var lista=[];
  var elementos=[];
    $('#asignar').click(function(){
          console.log('hizo click');
          var text="";
          var text1="";
          var condicion =  $('select[name="condicion"] option:selected').text();
          var indice = $('#condicion').val();
          
          lista.push(condicion);
          elementos.push(indice);
           document.getElementById("elementos1").innerHTML = elementos;
          /*for (var i = 0; i < lista.length; i++) {
            text += '<li>'+lista[i].condicion+'</li>';
          }
          
          document.getElementById("ulListado").innerHTML = text;*/ 
          elementos.forEach(function(condicion, index){
            text1 += `<li><input type="text" name="item[]">${index} : ${condicion}</li>`;
          //text1 += `<li><input type="text" name="item[]">${index} : ${condicion}</li>`;
          //$("#lista").html(`<li>${condicion}</li>`);
          console.log(`${indice}`);
          });  
          document.getElementById("elementos").innerHTML = text1;
          
          lista.forEach(function(condicion, index){
          text += `<li>${condicion}</li>`;
          //$("#lista").html(`<li>${condicion}</li>`);
          //console.log(`${index} : ${condicion}`);
          });  
          document.getElementById("ulListado").innerHTML = text;
          });
    $('#quitar').click(function(){
          
          var text="";
          //var condicion =  $('select[name="condicion"] option:selected').text();
          
          lista.pop();
          elementos.pop();

          lista.forEach(function(condicion, index){
          text += `<li>${condicion}</li>`;
          //$("#lista").html(`<li>${condicion}</li>`);
          //console.log(`${index} : ${condicion}`);
          });  
          document.getElementById("ulListado").innerHTML = text;
          });

           
});
</script>
