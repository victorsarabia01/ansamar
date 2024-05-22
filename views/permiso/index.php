
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


<!-- MODAL -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" id="cancelar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
            <h3>Permisos</h3>
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" method="post" id="formulario" action="">
          <input type="hidden" id="id" name="id">
          <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=permiso&a=guardar">
          <input type="hidden" id="accion" name="accion" value="index.php?c=permiso&a=modificar">
          <input type="hidden" id="controlador" name="controlador" value="permiso">
            <!-- COLUMNA -->
            <div class="row">
              <div class="form-group col-md-12">
                <label for="nombre"><b>Nombre del permiso:</b></label>
                <input type="text" class="form-control mayuscula buscar" onKeyUp="buscarReg();" name="nombre" id="nombre" value="" aria-describedby="emailHelp" maxlength="50" placeholder="Nombre del permiso" required>
                <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="nombre">
                <div id="verificarRegistro"></div>
              </div>
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
<h3>Permisos</h3>
</div>


<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>


<br><br>