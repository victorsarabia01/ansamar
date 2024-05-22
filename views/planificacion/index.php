

<!-- BOTON QUE ACTIVA MODAL -->
<p></p>
<div class="">
  <?php if($this->accesoRegistrar){ ?>
  <button type="button" class="btn btn-success btn-lg active" id="abrirModal" title="Registrar">
      Registrar
    </button>
  <?php } ?>
</div>
<p></p>
<!-- FIN QUE ACTIVA MODAL -->

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
                            <h3>Planificación de atención en consultorios</h3>
                        </div>

                     
                    <form class="form-horizontal" method="post" action="index.php?c=planificacion&a=guardar">
                    <input type="hidden" id="controlador" value="planificacion">

                        <div class="col-md-8">
                           
                             <select name="consultorio" id="consultorio" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Consultorio</option>
                                <?php foreach ($this->mode->Consultar("listarTodosConsultorios")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->descripcion ?></option>
                                <?php endforeach ?>
                            </select>
                           
                            <select name="turno" id="turno" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Turno</option>
                                <option value="1">Mañana</option>
                                <option value="2">Tarde</option>
                            </select>
                    
                            <select name="doctor" id="doctor" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                              <option value="0">Odontologo</option>
                                <?php foreach ($this->mode->Consultar("listarTodosDoctores")  as $k) : ?>
                                    <option value="<?php echo $k->id_empleado ?>"> <?php echo $k->nombres." ".$k->apellidos?></option>
                                <?php endforeach ?>
                            </select>
                           
                        </div>

                        
                        </div>
                        <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group" id="prueba">
                        <input type="checkbox" class="btn-check" value="1" name="btncheck1" id="btncheck1" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck1">Lunes</label>
                        <input type="checkbox" class="btn-check" name="btncheck2" id="btncheck2" value="1" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck2">Martes</label>
                        <input type="checkbox" value="1" class="btn-check" id="btncheck3" name="btncheck3" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck3">Miercoles</label>
                    
                        <input type="checkbox" value="1" class="btn-check" id="btncheck4" name="btncheck4" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck4" >Jueves</label>
                        <input type="checkbox" value="1" class="btn-check" id="btncheck5" name="btncheck5" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck5">Viernes</label>
                        <input type="checkbox" value="1" class="btn-check" id="btncheck6" name="btncheck6" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncheck6">Sabado</label>
                        </div>
                        <p></p>
                            
                      
                     
                        
            

  </div>
  
</div>
</div>
 

 </div>
      <div class="modal-footer">
        <button type="submit" href="?c=guardar" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Registrar</button>
        <button type="button" id="cancelar" name="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>




<div id="apartado1" align='center'>
<h3>Planificación</h3>
</div>


<table id="example" class="table table-hover">
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Odontologo</th>
                <th>Consultorio</th>
                <th>Dia_semana</th>
                <th>Turno</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>



<br><br>





