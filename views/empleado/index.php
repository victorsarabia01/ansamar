
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
<div class="modal fade" id="trackerModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
                            <h3>Registrar empleado</h3>
                       
        </div>

        <div class="container-fluid">
          <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" name="urlActual" id="urlActual" value="index.php?c=empleado&a=guardar">
                        <input type="hidden" id="accion" value="index.php?c=empleado&a=modificar">
                        <input type="hidden" id="controlador" value="empleado">
                        <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="cedula">
            <!-- COLUMNA -->

            <div class="row">
              <div class="form-group col-md-6">
                <label for="nombre"><b>Cédula:</b></label>
                <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp=buscarReg();keepNumOrDecimal(this);validarCedula() value="" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" min="7" max="8" maxlength="8" required>
                <div id="verificarRegistro"></div>
                <div id="verificarCedula"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="descripcion"><b>Correo:</b></label>
                <input type="email" class="form-control" name="email" id="email" onKeyUp=validarEmail(); value="" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
                <div id="verificarEmail"></div>
              </div>
              
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Nombres:</b></label>
                <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
            </div>
              <div class="form-group col-md-6">
                <label for="observaciones"><b>Apellidos:</b></label>
                <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
              </div>
              <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Fecha de nacimiento</b></label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
              </div>
              <div class="form-group col-md-6">
                <label for="site"><b>Tipo de empleado:</b></label>
                <select name="empleado" id="empleado" class="form-select" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Empleado</option>
                                <?php foreach ($this->mode->Consultar("listarTodosTipoEmpleados")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->descripcion?></option>
                                <?php endforeach ?>
                     
         
                </select>
                         
              </div>
                
            </div>
            <!-- COLUMNA -->
            <div class="row">
              
              
           
              <label for="descripcion"><b>Teléfono:</b></label>
                <div class="form-group col-md-3">
                  <select class="form-select" name="codtlfn" id="codtlfn" class="form-select form-select-lg mb-1" required>
                  <option value="0251">0251</option>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                  </select>
              </div>
              <div class="form-group col-md-3">
                <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this);validarTlfno() id="telefono" value="" aria-describedby="emailHelp" placeholder="5208619" maxlength="7" required>
                <div id="verificarTlfno"></div>
              </div>


              
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                <label for="fecha_ini"><b>Dirección:</b></label>
                <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Direccion" maxlength="100" required></textarea>
              </div>
              </div>
              
              
            
            <!--<div class="row">
              <div class="form-group col-md-3">
                <label for="site"><b>Tipo de empleado:</b></label>
                <select name="empleado" id="empleado" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Empleado</option>
                                <?php foreach ($this->mode->Consultar("listarTodosTipoEmpleados")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->descripcion?></option>
                                <?php endforeach ?>
                     
         
                </select>
                         
              </div>
            </div>-->
          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
        <button type="button" id="cancelar" name="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
     </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->

<div id="apartado1" align='center'>
<h3>Empleados</h3>
</div>

<table id="example" class="table table-hover">

       
  <div class="">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Cargo</th>
                <th>Cedula</th>
                <th>Apellidos Nombres</th>
                <th></th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>

<br><br>