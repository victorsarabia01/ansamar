
<!-- BOTON QUE ACTIVA MODAL -->.
<div class="col-md-8">
    <?php if($this->accesoRegistrar){ ?>
        <button type="button" class="btn btn-success btn-lg active" id="abrirModal" title="Registrar">
      Registrar
    </button>
    <?php } ?>
</div>
<p></p>
<!-- FIN QUE ACTIVA MODAL -->

<!-- FIN DEL BOTON BUSCAR -->

<!-- MODAL -->
<div class="modal fade" id="trackerModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" id="cancelar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form class="form-horizontal" method="post" id="formulario" action="">
            <div class="modal-body">
            <div class="alert alert-success" role="alert">
                <h3>Registrar rol</h3>
            </div>
            <div class="container-fluid">
                <!-- COLUMNA -->
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="nombre"><b>Nombre del rol:</b></label>
                    <input type="text" class="form-control mayusculas buscar"  name="nombre" id="nombre" onKeyUp=buscarReg(); value="" onkeypress="return permite(event, 'num_car')" aria-describedby="emailHelp" maxlength="50" placeholder="Administrador" required>
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" name="urlActual" id="urlActual" value="index.php?c=rol&a=guardar">
                        <input type="hidden" id="accion" value="index.php?c=rol&a=modificar">
                        <input type="hidden" id="controlador" value="rol">
                        <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="nombre">
                    <div id="verificarRegistro"></div>
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
                                        <input type="checkbox" id="acceso<?=$idUnico; ?>" class="checkVal" name="check[]" value="Off">
                                        <input type="hidden" id="txtacceso<?=$idUnico; ?>" class="txtcheckVal" name="accesos[]" value="Off">
                                        <input type="hidden" name="id_modulo[]" value="<?=$modulo->id; ?>">
                                        <input type="hidden" name="id_permiso[]" value="<?=$permiso->id; ?>">
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <!--.modal-body-->
            <div class="modal-footer">
                <button type="submit" id="btnguardar" class="btn btn-outline-success">Registrar</button>

                <button type="button" id="salir" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->


<div id="apartado1" align='center'>
<h3>Roles</h3>
</div>

<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>


<br><br>




<script>
$(document).ready(function() {
    $(".checkVal").click(function(){ //Al hacer clic Cambia el valor el input check, al valor on encendido o off apagado
        var id = $(this).attr("id");
        if($(this).is(":checked")){
            $(this).val("On");
            $("#txt"+id).val("On");
        }else{
            $(this).val("Off");
            $("#txt"+id).val("Off");
        }
    });
    $("#todos").click(function(){ //Al hacer clic en todods Cambia todos los valores de los inputs check, al valor on encendido  o  off apagado
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
    $("#resultadoBusqueda").html('');
});

</script>


