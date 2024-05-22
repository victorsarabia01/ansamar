

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
        <button type="button" id="salir" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
<div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <h3>Servicio Dental</h3>
                       
                        </div>
                       
                    <form class="form-horizontal" id="formulario" method="post" action="">
                    <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=serviciodental&a=guardar">
                    <input type="hidden" id="accion" name="accion" value="index.php?c=serviciodental&a=modificar">
                    <input type="hidden" id="controlador" name="controlador" value="serviciodental">
                    <input type="hidden" id="id" name="id">    
                        <div class="col-md-40">
                            </label><b>Nombre:</b></label>
                            <input type="text area" id="nombre" name="nombre" onkeypress="return permite(event, 'num_car')" onKeyUp="buscarReg();" class="form-control mayusculas buscar" value="" aria-describedby="emailHelp" placeholder="Ejemplo. Remoción de caries" maxlength="50" required>
                      
                        <input type="hidden" id="inputVerificarReg" name="inputVerificarReg" value="nombre">
                        </div>
                        <div id="verificarRegistro"></div>
            
                        <div class="col-md-40">
                        </label><b>Descrición:</b></label>
                        <textarea id="descripcion" name="descripcion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. La remoción química de la caries consiste en aplicar un gel con un agente químico sobre la dentina infectada y posteriormente eliminar la caries con una pequeña cucharilla. Se elimina toda la dentina blanda y se conserva la dentina dura." maxlength="100" required></textarea>
                        </div>
          
            
              
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="nombre"><b>Precio del servicio:</b></label>
                <input type="text" class="form-control" name="precio" onkeyup= keepNumOrDecimal(this) id="precio" value="" aria-describedby="emailHelp" placeholder="50" maxlength="3" required>
              </div>
            </div>                      
                                 
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" href="#" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
        <button type="button" id="cancelar" name="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- FIN DEL MODAL -->


<div id="apartado2" align='center'>
<h3>Servicios Dentales</h3>
</div>

<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>


<br><br>