<!-- MODAL -->
  
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="index.php?c=permiso&a=modificar">

        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <a href="index.php?c=permiso" class="btn-close" aria-label="Close"></a>
        </div>

        <div class="modal-body">
          <div class="alert alert-success" role="alert">
            <h3>Modificar permiso</h3>
          </div>
          <div class="container-fluid">
              <!-- COLUMNA -->
              <div class="row">
                <div class="form-group col-md-12">
                  <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                  <label for="nombre"><b>Nombre del permiso:</b></label>
                  <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $this->alm->nombre; ?>" aria-describedby="emailHelp" placeholder="Nombre del permiso" maxlength="50" required>
                  <div id="verificarRegistroPaciente"></div>
                </div>
              </div>
              <!-- COLUMNA -->
              
              <div class="form-group col-md-3">
                <label for="site"><b>Status:</b></label>           
                <select name="status" id="status" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                    <?php foreach ($this->mode->Consultar("listarStatus") as $f){ ?>
                        <option value="<?php echo $f->id ?>" <?php if($f->id == $this->alm->status){ echo 'selected'; } ?>> <?php echo $f->status; ?></option>
                    <?php } ?>
                </select>
          
              </div>
          </div>
        </div>
        <!--.modal-body-->
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success">Guardar</button>
          <a class="btn btn-outline-danger" href="index.php?c=permiso">Cancelar</a>
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


<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL PACIENTE -->

<script>
$(document).ready(function() {
    $("#verificarRegistroPaciente").html('');
});

// function buscarPaciente() {
//     var textoBusqueda = $("input#cedula").val();
    
//      if (textoBusqueda != "") {
//         $.post("index.php?c=paciente&a=verificarRegistroPaciente", {valorBusqueda: textoBusqueda}, function(mensaje) {
//             $("#verificarRegistroPaciente").html(mensaje);
//             //$("#idProducto").html(mensaje1);
//             //html(mennsaje1);
//          }); 
//      } else { 
//         $("#verificarRegistroPaciente").html('');
//         };
// };
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
