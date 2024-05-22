

<!-- Modal -->

<div class="flex" id="flex1">

<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=consultorio" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
       <div class="alert alert-success" role="alert">
                            <h3>Modificar consultorio</h3>
                       
                        </div>
                  
                    <form class="form-horizontal" method="post" action="index.php?c=consultorio&a=modificar">
                        <div class="col-md-8">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                       
                        </div>
              
                        <div class="col-md-40">
                          </label><b>Nombre:</b></label>
                            <input type="text area" onKeyUp="buscarConsultorio();" id="descripcion" name="descripcion" onkeypress="return permite(event, 'num_car')" class="form-control" value="<?php echo $this->alm->descripcion; ?>" aria-describedby="emailHelp" placeholder="Nombre" maxlength="50" required>
              
                        </div>
                        <div id="verificarRegistroConsultorio"></div>
                        <div class="col-md-40">
                        </label><b>Dirección:</b></label>
                          <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1"  rows="3" placeholder="Direccion" maxlength="100" required><?php echo $this->alm->direccion; ?></textarea>
                        
                        </div>

            <div class="col-md-40">
            </label><b>Teléfono:</b></label>
            <input type="text"  name="telefono" class="form-control" onkeyup= keepNumOrDecimal(this) id="telefono" value="<?php echo $this->alm->tlfno; ?>" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
            </div>

                        <div class="col-md-40">
                        </label><b>Cantidad de sillón dental:</b></label>
                        <input type="number" min="0" max="5" class="form-control" name="sillas" id="sillas" value="<?php echo $this->alm->sillas ?>">
              
                        </div>
                  
        
                        <div class="col-md-15">
                        </label><b>Estado:</b></label>
                          <select name="status" id="status" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->Consultar("listarStatus")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->status ? 'selected' : '';?>> <?php echo $k->status?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                            <div class="modal-footer">
        
                            <button type="submit" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar</button>
                            <a class="btn btn-outline-danger" href="index.php?c=consultorio">Cancelar</a>
                     
                        
            </form>
      </div>
      
      </div>
    </div>
  </div>
</div>
</div>
<!-- FIN MODAL -->

<!-- FUNCION JS PARA MODAL EDITAR -->
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

<!-- VALIDACIONES FRONT -->

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
  function permite(elEvento, permitidos) {
  // Variables que definen los caracteres permitidos
  var numeros = "0123456789";
  var caracteres = " aábcdeéfghiíjklmnñoópqrstuvwxyzAÁBCDEÉFGHIÍJKLMNÑOÓPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  var teclas_especiales = [8, 37, 39, 46];
  // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
 
 
  // Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) {
    case 'num':
      permitidos = numeros;
      break;
    case 'car':
      permitidos = caracteres;
      break;
    case 'num_car':
      permitidos = numeros_caracteres;
      break;
  }
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada es alguna de las teclas especiales
  // (teclas de borrado y flechas horizontales)
  var tecla_especial = false;
  for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
      tecla_especial = true;
      break;
    }
  }
 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}
</script>



    
