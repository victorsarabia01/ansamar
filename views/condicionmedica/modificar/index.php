<body>

<!-- Modal -->

<div class="flex" id="flex1">

<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=condicionmedica" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
       <div class="alert alert-success" role="alert">
                            <h3>Modificar condición médica</h3>
                       
                        </div>
                  
                    <form class="form-horizontal" method="post" action="index.php?c=condicionmedica&a=modificar">
                        <div class="col-md-8">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                       
                        </div>
              
                        <div class="col-md-40">
                          </label><b>Nombre:</b></label>
                            <input type="text area" id="descripcion" name="descripcion" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarCondicionMedica();" class="form-control mayusculas buscar" value="<?php echo $this->alm->descripcion; ?>" aria-describedby="emailHelp" placeholder="Nombre" maxlength="50" required>
              
                        </div>
                        <div id="verificarRegistroCondicionMedica"></div>

                        <div class="form-group col-md-40">
                            <label for="fecha_ini"><b>Observaciones:</b></label>
                            
                            <textarea id="observacion" name="observacion" class="form-control" id="exampleFormControlTextarea1"  rows="4"  placeholder="Observaciones" maxlength="250" required><?php echo $this->alm->observacion; ?></textarea>
          
                         </div>

        
                        <div class="col-md-15">
                        </label><b>Estado:</b></label>
                          <select name="status" id="status" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->Consultar("listarStatus") as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->status ? 'selected' : '';?>> <?php echo $k->status?></option>
                                <?php endforeach ?>
                          </select>

                        </div>
                            <div class="modal-footer">
        
                            <button type="submit" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar</button>
                            <a class="btn btn-outline-danger" href="index.php?c=condicionmedica">Cancelar</a>
                     
                        
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


<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE LA CONDICON MEDICA -->


<script>
  $(document).ready(function() {
    $("#verificarRegistroCondicionMedica").html('');
});

function buscarCondicionMedica() {
    var textoBusqueda = $("input#descripcion").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=condicionmedica&a=verificarElRegistroCondicionMedica", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroCondicionMedica").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroCondicionMedica").html('');
        };
};
</script>