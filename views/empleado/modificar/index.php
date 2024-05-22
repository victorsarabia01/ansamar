



<!-- MODAL -->
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=empleado" class="btn-close" aria-label="Close"></a>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
                            <h3>Modificar empleado</h3>
                       
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" method="post" action="index.php?c=empleado&a=modificar">
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-6">
                <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                <label for="nombre"><b>Cédula:</b></label>
                <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp=buscarEmpleado();keepNumOrDecimal(this) value="<?php echo $this->alm->cedula; ?>" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="8" required>
                <div id="verificarRegistroEmpleado"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="descripcion"><b>Correo:</b></label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $this->alm->email; ?>" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
              </div>
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Nombres:</b></label>
                <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="<?php echo $this->alm->nombres; ?>" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
              </div>
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Apellidos:</b></label>
                <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="<?php echo $this->alm->apellidos; ?>" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
              </div>
              <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Fecha Nacimiento:</b></label>
                <input type="date" class="form-control" id="fecha" value="<?php echo $this->alm->fechaNacimiento; ?>" name="fecha" required>
              </div>
              <div class="form-group col-md-6">
                <label for="site"><b>Tipo de Empleado:</b></label>
                <select name="empleado" id="empleado" class="form-select" aria-label="Ejemplo de .form-select-lg" required>
                                
                                <?php foreach ($this->mode->Consultar("listarTodosTipoEmpleados")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->id_tipo_empleado ? 'selected' : '';?>> <?php echo $k->descripcion?></option>
                                <?php endforeach ?>
                     
         
                </select>
                         
              </div>
            </div>
            <!-- COLUMNA -->
            <div class="row">
              <label for="descripcion"><b>Telefono:</b></label>
              <div class="form-group col-md-3">
                <!-- value="<?php echo $this->alm->codtlfno; ?>" -->
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
                
                <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="<?php echo $this->alm->tlfno; ?>" aria-describedby="emailHelp" placeholder="5208619" maxlength="7" required>
              </div>
            </div>
            <!-- COLUMNA -->
            <div class="row">
              
              
              <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Direccion:</b></label>
                <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="3" placeholder="Direccion" maxlength="100" required><?php echo $this->alm->direccion; ?></textarea>
          
              </div>

              

              
            </div>

            <!--<div class="row">
              <div class="form-group col-md-6">
                <label for="site">Tipo de Empleado:</label>
                <select name="empleado" id="empleado" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                
                                <?php foreach ($this->mode->Consultar("listarTodosTipoEmpleados")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $this->alm->id_tipo_empleado ? 'selected' : '';?>> <?php echo $k->descripcion?></option>
                                <?php endforeach ?>
                     
         
                </select>
                         
              </div>
          
            </div>-->
      
            
       

          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar</button>
        <a class="btn btn-outline-danger" href="index.php?c=empleado">Cancelar</a>
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



</script>




<script>
$(document).ready(function() {
    $("#verificarRegistroEmpleado").html('');
});

function buscarEmpleado() {
    var textoBusqueda = $("input#cedula").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=empleado&a=verificarRegistroEmpleado", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroEmpleado").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroEmpleado").html('');
        };
};
</script>

