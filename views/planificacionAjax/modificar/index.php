

<!-- Modal -->

<div class="flex" id="flex1">

<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=planificacion" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
       <div class="alert alert-success" role="alert">
                            <h3>Modificar planificación</h3>
                       
                        </div>
                  
                    <form class="form-horizontal" method="post" action="index.php?c=planificacion&a=modificar">
                        <div class="col-md-8">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                       
                        </div>
                        <div class="col-md-15">
                        </label><b>Consultorio:</b></label>
                           <select name="consultorio" id="consultorio" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                        
                                <?php foreach ($this->mode->Consultar("listarTodosConsultorios")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>" <?php echo $k->id == $this->alm->id_consultorio ? 'selected' : ''; ?>> <?php echo $k->descripcion?></option>
                                <?php endforeach ?>
                            </select>
                          </div>

                          <div class="col-md-15">
                          </label><b>Turno:</b></label>
                          <select name="turno" id="turno" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->Consultar("listarTodosTurnos")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>" <?php echo $k->id == $this->alm->id_turno ? 'selected' : ''; ?>> <?php echo $k->descripcion?></option>
                                <?php endforeach ?>
                          </select>
                          </div>

                          <div class="col-md-15">
                          </label><b>Odontólogo:</b></label>
                             <select name="doctor" id="doctor" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                              
                                <?php foreach ($this->mode->Consultar("listarTodosDoctores")  as $k) : ?>
                                    <option value="<?php echo $k->id_empleado ?>" <?php echo $k->id_empleado == $this->alm->id_empleado ? 'selected' : ''; ?>> <?php echo $k->nombres." ".$k->apellidos?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-15">
                          </label><b>Día de la semana:</b></label>
                          <select name="diaSemana" id="diaSemana" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->Consultar("listarDiaSemana")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>" <?php echo $k->id == $this->alm->id_dia_semana ? 'selected' : ''; ?>> <?php echo $k->nombre?></option>
                                <?php endforeach ?>
                          </select>
                          </div>
              
                        
        
                        <!--<div class="col-md-15">
                        </label><b>Estado:</b></label>
                          <select name="status" id="status" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->Consultar("listarStatus")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $alm->status ? 'selected' : '';?>> <?php echo $k->status?></option>
                                <?php endforeach ?>
                          </select>

                        </div>-->
                        

                            <div class="modal-footer">
        
                            <button type="submit" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar</button>
                            <a class="btn btn-outline-danger" href="index.php?c=planificacion">Cancelar</a>
                     
                        
            </form>
      </div>
      
      </div>
    </div>
  </div>
</div>
</div>
<!-- FIN MODAL -->

<!-- FUNCION JS PARA MODAL EDITAR -->
<script>
  $(document).ready(function(){
    exampleModal.style.display = 'block';
  });

let modal1 = document.getElementById('exampleModal');
let flex1 = document.getElementById('flex1');
let abrirModificar = document.getElementById('abrirModificar');
let cerrar1 = document.getElementById('close1');

abrirModificar.addEventListener('click', function(){
    modal1.style.display = 'block';
});

cerrar1.addEventListener('click', function(){
    modal1.style.display = 'none';
});

window.addEventListener('click', function(e){
    console.log(e.target);
    if(e.target == flex1){
        modal1.style.display = 'none';
    }
});

</script>




    
