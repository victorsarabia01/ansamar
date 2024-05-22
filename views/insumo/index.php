

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
<div class="modal fade" style="overflow-y: scroll;" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
<div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <h3>Insumo</h3>
                       
                        </div>
                       
                    <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
                    <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=insumo&a=guardar"> 
                    <input type="hidden" id="accion" name="accion" value="index.php?c=insumo&a=modificar">     
                    <input type="hidden" id="controlador" name="controlador" value="insumo">
                    <input type="hidden" id="id" name="id">
                        
                        <div class="col-md-40">
                            </label><b>Nombre:</b></label>
                            <input type="text area" id="nombre" name="nombre" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarReg();" class="form-control mayusculas buscar" value="" aria-describedby="emailHelp" placeholder="Ejemplo. Amalgama" maxlength="50" required>
                        <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="nombre">
              
                        </div>
                        <div id="verificarRegistro"></div>
            
                        <div class="col-md-40">
                        </label><b>Descripción:</b></label>
                        <textarea id="descripcion" name="descripcion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. Usar 2cc en pacientes Hipertensos" maxlength="250" required></textarea>
                        </div>

                        <!-- POR FALTA DE MODULO COMPRA -->
                        <div class="form-group col-md-6">
                        <label for="nombre"><b>Cantidad:</b></label>
                        <input type="text" class="form-control" name="cantidad" onkeyup= keepNumOrDecimal(this) id="cantidad" value="" aria-describedby="emailHelp" placeholder="145" maxlength="3" required>
                        </div>
          
              
                      <!--<div class="form-group col-md-40">
                      <label><b>Stock:</b></label>
                      <input type="number" class="form-control" name="stock" onkeyup= keepNumOrDecimal(this) id="stock" value="" aria-describedby="emailHelp" placeholder="150" min="0" max="999" maxlength="2" required>
                      </div>-->
                          
                            
                            
                     
                        
            
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
        <button type="button" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN DEL MODAL -->


<div id="apartado1" align='center'>
<h3>Insumos</h3>
</div>


<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>
    
<br><br>