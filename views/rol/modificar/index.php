<!-- MODAL -->
  
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="index.php?c=rol&a=modificar">

        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <a href="index.php?c=rol" class="btn-close" aria-label="Close"></a>
        </div>

        <div class="modal-body">
          <div class="alert alert-success" role="alert">
            <h3>Modificar Rol</h3>
          </div>
          <div class="container-fluid">
              <!-- COLUMNA -->
              <div class="row">
                <div class="form-group col-md-12">
                  <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                  <label for="nombre"><b>Nombre del rol:</b></label>
                  <input type="text" class="form-control" onKeyUp=buscarRol(); name="nombre" id="nombre" value="<?php echo $this->alm->nombre; ?>" aria-describedby="emailHelp" placeholder="Nombre del rol" maxlength="50" required>
                  <div id="verificarRegistroRol"></div>
                </div>
              </div>
              <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="text-align:center;">
                                    <label for="todos"><b>Seleccionar Todos</b></label><br>
                                    <input type="checkbox" id="todos" class="" value="Off">
                                </td>
                            <?php foreach ($this->permiso->Consultar("listarPermiso") as $permiso) { ?>
                                <td style="text-align:center;">
                                    <label><b><?=$permiso->nombre; ?></b></label>
                                </td>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->modulo->Consultar("listarModulo") as $modulo) { ?>
                                <tr>
                                    <td>
                                        <label><b><?=$modulo->nombre; ?></b></label>
                                    </td>
                                    <?php foreach ($this->permiso->Consultar("listarPermiso") as $permiso) { ?>
                                    <?php $idUnico = $modulo->id."-".$permiso->id; ?>
                                    <td style="text-align:center;">
                                        <!-- <label for="acceso<?=$idUnico; ?>"><small><?=$permiso->nombre." ".$modulo->nombre; ?></small></label><br> -->
                                        <input type="checkbox" id="acceso<?=$idUnico; ?>" class="checkVal" name="check[]"  <?php foreach ($this->accesos as $acc){ if($acc->id_modulo."-".$acc->id_permiso==$idUnico){ echo "checked value='On'"; } } ?> value="Off" >
                                        <input type="hidden" id="txtacceso<?=$idUnico; ?>" class="txtcheckVal" name="accesos[]" <?php foreach ($this->accesos as $acc){ if($acc->id_modulo."-".$acc->id_permiso==$idUnico){ echo "value='On'"; } } ?> value="Off">
                                        <input type="hidden" name="id_modulo[]" value="<?=$modulo->id; ?>">
                                        <input type="hidden" name="id_permiso[]" value="<?=$permiso->id; ?>">
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
              <!-- COLUMNA -->
              
        
          </div>
        </div>
        <!--.modal-body-->
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success">Guardar</button>
          <a class="btn btn-outline-danger" href="index.php?c=rol">Cancelar</a>
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
  $(".checkVal").click(function(){
        var id = $(this).attr("id");
        if($(this).is(":checked")){
            $(this).val("On");
            $("#txt"+id).val("On");
        }else{
            $(this).val("Off");
            $("#txt"+id).val("Off");
        }
    });
    $("#todos").click(function(){
        if($(this).is(":checked")){
            $(this).val("On");
            $(".checkVal").prop("checked", true);
            $(".checkVal").val("On");
            $(".txtcheckVal").val("On");
        }else{
            $(this).val("Off");
            $(".checkVal").prop("checked", false);
            $(".checkVal").val("Off");
            $(".txtcheckVal").val("Off");
        }
    });
  exampleModal.style.display = 'block';
});



</script>

<script>
$(document).ready(function() {
    $("#verificarRegistroRol").html('');
});

function buscarRol() {
    var textoBusqueda = $("input#nombre").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=rol&a=verificarRegistroRol", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroRol").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroRol").html('');
        };
};
</script>
