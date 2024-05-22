

<!-- Modal -->

<div class="flex" id="flex1">

<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=insumo" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
       <div class="alert alert-success" role="alert">
                            <h3>Modificar insumo</h3>
                       
                        </div>
                  
                    <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
                      <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=insumo&a=modificar">
                        <div class="col-md-8">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                       
                        </div>
              
                        <div class="col-md-40">
                            </label><b>Nombre:</b></label>
                            <input type="text area" id="nombre" name="nombre" onkeypress="return permite(event, 'num_car')" onkeydown="" onKeyUp="buscarReg();" class="form-control" value="<?php echo $this->alm->nombre; ?>" aria-describedby="emailHelp" placeholder="Ejemplo. Amalgama" maxlength="50" required>
                        <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="nombre">
                        <input type="hidden" id="accion" value="index.php?c=insumo&a=modificar">
                        <input type="hidden" id="controlador" value="insumo">
              
                        </div>
                        <div id="verificarRegistro"></div>
                        <div class="col-md-40">
                        </label><b>Descripción:</b></label>
                        <textarea id="descripcion" name="descripcion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. Usar 2cc en pacientes Hipertensos" maxlength="250" required><?php echo $this->alm->descripcion; ?></textarea>
                        </div>
                        <div class="form-group col-md-40">
                        <label for="nombre"><b>Stock:</b></label>
                        <input type="number" class="form-control" name="stock" onkeyup= keepNumOrDecimal(this) id="stock" value="<?php echo $this->alm->stock; ?>" aria-describedby="emailHelp" placeholder="150" min="0" max="999" maxlength="2" required>
                         
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
        
                            <button type="submit" name="btnmodificar" id="btnmodificar" class="btn btn-outline-success">Guardar</button>
                            <a class="btn btn-outline-danger" href="index.php?c=insumo">Cancelar</a>
                     
                        
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

<script type="text/javascript">
  var input=  document.getElementById('stock');
  input.addEventListener('input',function(){
  if (this.value.length > 3) 
     this.value = this.value.slice(0,3); 
})
</script>

<!-- FUNCICON JS PARA BUSCAR REGISTROS SI EXISTE EL INSUMO -->

<!--<script>
$(document).ready(function() {
    $("#verificarRegistroInsumo").html('');
});

function buscarInsumo() {
    var textoBusqueda = $("input#nombre").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=insumo&a=verificarRegistroInsumo", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroInsumo").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroInsumo").html('');
        };
};
</script>-->



    
