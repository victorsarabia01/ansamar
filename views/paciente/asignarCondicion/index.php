    
<!-- MODAL -->
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=paciente" class="btn-close" aria-label="Close"></a>
      </div>

    <div class="modal-body">
        <div class="alert alert-success" role="alert">
                            <h3>Asignar condicion médica al paciente: <?php echo $this->alm->nombres; ?> <?php echo $this->alm->apellidos; ?> </h3>
                       
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" id="formulario" method="post" action="">
          <input type="hidden" id="urlActual" value="index.php?c=paciente&a=asignarCondicionMedica"> 
          <input type="hidden" id="id" name="id">  
                      
              <div class="form-group col-md-3">
                <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                <label for="site"><b>Condición médica:</b></label>
                <select name="condicion" id="condicion" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg">
                               
                                <?php foreach ($this->mode->Consultar("listarCondicionMedica")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->descripcion ?></option>
                                <?php endforeach ?>
                    
                </select>

                <div class="d-grid gap-2 d-md-block">
                
                <button type="submit" id="btnasignar" class="btn btn-warning">Asignar</button>     
                </div>  
            
             </form> 

        </div>
              
              
    </div>
            
<div class="row" style="overflow-x: scroll;">
            

    <div class="row">
          <div class="col-md-12 text-center">
            <h3>Condiciones médicas registradas</h3>
        </div>
    </div>
    
    
      <div id="" class="col-md-12 text-center">
        <table id="recargar" class="table table-hover">
          <tr class="table-secondary">
            
                  <th>Descripción</th>
                  <th>Observación</th>
          
                  <th>Eliminar</th>
            
          </tr>                 

          <?php foreach ($this->mode->Consultar("listarCondicionMedicaPaciente", $this->alm->id) as $k) : ?>
          
          <tr>
              
                  <td><?php echo $k->descripcion; ?></td>
                  <td><?php echo $k->observacion; ?></td>
                  
           
              <td>
                <button href="#" id="<?php echo $k->id; ?>" type="button" class="btn btn-outline-danger eliminarCondicionMedica">
                        <i class="bi bi-trash"></i>       
                </button>
              </td>
          </tr>  
            <?php  endforeach; ?>
          </table>
      </div>
    </div>


      <!--.modal-body-->
      <div class="modal-footer">
        
        <a class="btn btn-outline-danger" href="index.php?c=paciente">Salir</a>
      </div>
    
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

let modal1 = document.getElementById('exampleModal');
let flex1 = document.getElementById('flex1');
/*let abrirModificar = document.getElementById('abrirModificar');
let cerrar1 = document.getElementById('close1');*/

/*abrirModificar.addEventListener('click', function(){
    modal1.style.display = 'block';
});

cerrar1.addEventListener('click', function(){
    modal1.style.display = 'none';
});*/

window.addEventListener('click', function(e){
    //console.log(e.target);
    if(e.target == flex1){
        modal1.style.display = 'none';
    }
});

</script>

