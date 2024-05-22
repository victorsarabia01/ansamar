

<!-- BOTON QUE ACTIVA MODAL -->.
<div class="col-md-8">
  <?php if($this->accesoRegistrar){ ?>
  <button type="button" class="btn btn-outline-success" id="abrirModal">
  Registrar
  </button>
  <?php } ?>
</div>
<p></p>
<!-- FIN QUE ACTIVA MODAL -->

<!-- MODAL PARA REGISTRAR -->
<div class="modal fade" style="overflow-y: scroll;" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" id="salir" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
<div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <h3>Proveedor</h3>
                       
                        </div>
                       
                    <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
                    <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=proveedor&a=guardar">  
                    <input type="hidden" id="accion" name="accion" value="index.php?c=proveedor&a=modificar">
                    <input type="hidden" id="id" name="id">  
                    <input type="hidden" id="controlador" name="controlador" value="proveedor">
                        
                        <div class="col-md-40">
                            </label><b>Descripcion:</b></label>
                            <input type="text area" id="descripcion" name="descripcion" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarReg();" class="form-control" value="" aria-describedby="emailHelp" placeholder="Ejemplo. Inversiones Oroca" maxlength="100" required>
                        <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="descripcion">
              
                        </div>
                        <div id="verificarRegistro"></div>
            
                        <div class="col-md-40">
                        </label><b>Dirección:</b></label>
                        <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. Carrera 13A con calle 56 Galpon #2" maxlength="250" required></textarea>
                        </div>
                        <div class="col-md-40">
                        <label><b>Número teléfono:</b></label>
                        <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
                        </div>
                        <div class="col-md-40">
                        <label><b>Correo:</b></label>
                        <input type="email" class="form-control" name="email" id="email" value="" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
                        </div>          
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
        <button type="button" id="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN DEL MODAL -->



    
<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Proveedor</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>
