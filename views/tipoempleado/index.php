
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


<!-- MODAL PARA REGISTRAR -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" id="salir" name="salir" class="cancelar btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
<div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <h3>Tipo de empleado</h3>
                       
                        </div>
                       
                    <form class="form-horizontal" method="post" id="formulario" action="">
                    <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=tipoempleado&a=guardar"> 
                    <input type="hidden" id="accion" name="accion" value="index.php?c=tipoempleado&a=modificar"> 
                    <input type="hidden" id="controlador" name="controlador" value="tipoEmpleado">   
                    <input type="hidden" id="id" name="id">  
                        <p></p>
                        <div class="col-md-40">
                            </label><b>Nombre del tipo de empleado:</b></label>
                            <p></p>
                            <input type="text area" id="descripcion" name="descripcion" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarReg();" class="form-control mayusculas buscar" value="" aria-describedby="emailHelp" placeholder="Nombre" maxlength="50" required>
                            <input type="hidden" id="inputVerificarReg" name="inputVerificarReg" value="descripcion">
                        </div>
                        <p></p>
                        <div id="verificarRegistro"></div>
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" href="#" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
        <button type="button" id="cancelar" name="cancelar" class="cancelar btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN DEL MODAL -->

<div id="apartado2" align='center'>
<h3>Tipos de empleado</h3>
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