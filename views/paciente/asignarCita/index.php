


<!-- MODAL -->
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=paciente" class="btn-close" aria-label="Close"></a>
      </div>

      <div class="modal-body">
        <div class="container-fluid">

<!-- COMIENZO DE FORMULARIO -->
<div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">

  <div class="card-body">
                    <div class="alert alert-success" role="alert">
                            <h3>Agendar cita: <?php echo $this->alm->cedula ?> <?php echo $this->alm->nombres ?> <?php echo $this->alm->apellidos ?> </h3>
                            
                        </div>
                       
                    <form class="form-horizontal" id="formulario" method="post" action="">
                    <input type="hidden" id="urlActual" value="index.php?c=cita&a=guardar">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" name="resultadoBusquedaPaciente" id="resultadoBusquedaPaciente" value="<?php echo $this->alm->id ?>">
                  
                    <p></p>

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
                    
                           
                            <select name="cargarOdontologos" id="cargarOdontologos" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                            </select>
                            
                        
                        </div>
                        <div class="col-md-8">
                            <h3><label>Días que atiende el odontólogo</label></h3>
                            <div id="resultadoBusquedaDias"></div>

                            <!--<div id="resultadoBusqueda1"></div>-->
                        </div>
                        
                        <br>
                        <div class="col-md-8">
                            
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                       

                        <br>

                  
                            <div class="modal-footer">
                            <button type="submit" id="btnguardar" class="btn btn-outline-success ">Registrar</button>
                            <a class="btn btn-outline-danger " href="index.php?c=paciente">Salir</a>
                            </div>
                            
                     
                        
            </form>
           
  </div>
</div>
</div>
<!-- FIN DEL FORMULARIO -->
          
        </div>
      </div>
      <!--.modal-body-->
      
      
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>


<script>
  $(document).ready(function(){
    exampleModal.style.display = 'block';
  });

let modal1 = document.getElementById('exampleModal');
let flex1 = document.getElementById('flex1');
//let abrirModificar = document.getElementById('abrirModificar');
let cerrar1 = document.getElementById('close1');

/*abrirModificar.addEventListener('click', function(){
    modal1.style.display = 'block';
});*/

/*cerrar1.addEventListener('click', function(){
    modal1.style.display = 'none';
});*/

window.addEventListener('click', function(e){
    //console.log(e.target);
    if(e.target == flex1){
        modal1.style.display = 'none';
    }
});

</script>

<script src="resources/filtroCita.js"></script>