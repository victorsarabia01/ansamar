

<!-- Modal -->

<div class="flex" id="flex1">

<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=serviciodental" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
       <div class="alert alert-success" role="alert">
                            <h3>Editar servicio dental</h3>
                       
                        </div>
                  
                    <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
                        <div class="col-md-8">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                       
                        </div>
              
                        <div class="col-md-40">
                            </label><b>Nombre:</b></label>
                            <input type="text area" id="nombre" name="nombre" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarReg();" class="form-control" value="<?php echo $this->alm->nombre; ?>" aria-describedby="emailHelp" placeholder="Ejemplo. Remoción de caries" maxlength="50" required>
                        <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="nombre">
                        <input type="hidden" id="accion" value="index.php?c=serviciodental&a=modificar">
                        <input type="hidden" id="controlador" value="serviciodental">
                      
              
                        </div>
                        <div id="verificarRegistro"></div>
            
                        <div class="col-md-40">
                        </label><b>Descripción:</b></label>
                        <textarea id="descripcion" name="descripcion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. La remoción química de la caries consiste en aplicar un gel con un agente químico sobre la dentina infectada y posteriormente eliminar la caries con una pequeña cucharilla. Se elimina toda la dentina blanda y se conserva la dentina dura." maxlength="100" required><?php echo $this->alm->descripcion; ?></textarea>
                        </div>
          
            
              
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="nombre"><b>Precio del servicio:</b></label>
                <input type="text" class="form-control" name="precio" onkeyup= keepNumOrDecimal(this) id="precio" value="<?php echo $this->alm->precio; ?>" aria-describedby="emailHelp" placeholder="50" maxlength="3" required>
              </div>
            </div>                      
                  
        
                        <div class="col-md-15">
                        </label><b>Estado:</b></label>
                          <select name="status" id="status" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->consultar("listarStatus")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->status ? 'selected' : '';?>> <?php echo $k->status?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                            <div class="modal-footer">
        
                            <button type="submit" name="btnmodificar" id="btnmodificar" class="btn btn-outline-success">Guardar</button>
                            <a class="btn btn-outline-danger" href="index.php?c=serviciodental">Cancelar</a>
                     
                        
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

<!--<script>
$(document).ready(function() {
    $("#verificarRegistroServicioDental").html('');
});

function buscarServicioDental() {
    var textoBusqueda = $("input#nombre").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=serviciodental&a=verificarRegistroServicioDental", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroServicioDental").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroServicioDental").html('');
        };
};
</script>-->



    
