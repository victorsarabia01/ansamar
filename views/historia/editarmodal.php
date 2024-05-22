<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      
      <div class="modal-body">
      <div class="row justify-content-center">
<div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
  
  <div class="card-body">
                       
                       
                     <form class="form-horizontal" method="post" action="index.php?c=historia&a=editar">
                        <div class="col-md-8">
                  
                        <--?php foreach ($this->mode->listarhistoria() as $k ) : ?>
                            <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp= keepNumOrDecimal(this) value="<--?php echo $k->cedula; ?>" aria-describedby="emailHelp" placeholder="Cedula Ejem. 22186490" maxlength="8" required>
                        </div>
              
                        <div class="col-md-8">
                            <input type="text" id="nombres" name="nombres" class="form-control mayusculas buscar" id="nombres" value="<--?php echo $k->nombres; ?>" aria-describedby="emailHelp" placeholder="Nombres" maxlength="25" required>
                        </div>
                         <div class="col-md-8">
                            <input type="text" name="apellidos" id="apellidos" class="form-control mayusculas buscar" id="nombres" value="<--?php echo $k->apellidos; ?>" aria-describedby="emailHelp" placeholder="Apellidos" maxlength="25" required>
                        </div>
						
						
						<div class="col-md-8">
                        
                            <input type="text" class="form-control" name="motivo" id="motivo" value="<--?php echo $k->motivo; ?>"  placeholder="Motivo de la consulta" maxlength="50" required>
                        </div>


                        <div class="col-md-8">
                        
                            <input type="text" class="form-control" name="alergia"  id="alergia" value="<--?php echo $k->alergia; ?>"  placeholder="alergico algun medicameto" maxlength="11" required>
                        </div>
						<div class="col-md-8">

                        <input id="direccion" name="toma_medicamento" class="form-control" id="toma_medicamento" value="<--?php echo $k->toma_medicamento; ?>" rows="3" placeholder="Toma algun medicamento" maxlength="100" required></textarea>
						</div>
                        <div class="col-md-8">

<input  name="enfermedad" class="form-control" id="enfermedad" value="<--?php echo $k->enfermedad; ?>" rows="3" placeholder="Sufre de alguna enfermedad" maxlength="100" required></textarea>
</div>
<div class="col-md-8">

                        <input  name="dolor" class="form-control" id="dolor" value="<..?php echo $k->dolor; ?>" rows="3" placeholder="Presenta dolor" maxlength="100" required></textarea>
						</div>
                        <div class="col-md-8">

                        <input  name="hablar" class="form-control" id="hablar" value="<--?php echo $k->hablar; ?>" rows="3" placeholder="Movilidad para hablar" maxlength="100" required></textarea>
						</div>a
                        
                        <div class="col-md-8">

<input  name="observacion" class="form-control" id="observacion" value="<--?php echo $k->observacion; ?>" rows="3" placeholder="Observacion" maxlength="100" required></textarea>
</div> 
                        <div class="col-md-8">
       
                        <select class="form-control"  id="id_tipo" name="id_tipo"
    style="width: 100%;" placeholder="seleccione" value="<--?php echo $k->nivel; ?>" required> 
    <option value="0">Tipo de dolor</option>
    <?php foreach ($this->mode->listarTodostipo()  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->nivel ?></option>
                                <?php endforeach ?></select> 
								
         
                            </select>
                         
                        </div>
                        <div class="col-md-8">
                        <select class="form-control"  id="id_lesiones" name="id_lesiones"
    style="width: 100%;" placeholder="seleccione"  value="<--?php echo $k->lesion; ?>" required> 
    <option value="0">Tipo de lesion que presenta</option>
    <?php foreach ($this->mode->listarTodoslesiones()  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->lesion ?></option>
                                <?php endforeach ?></select>
                                </div>
                                
                        <div class="col-md-8">
                        <select class="form-control"  id="id_tratamiento" name="id_tratamiento"
    style="width: 100%;" placeholder="seleccione" value="<--?php echo $k->trabajo; ?>"  required> 
    <option value="0">Trabajo a realizar</option>
    <?php foreach ($this->mode->listarTodostratamiento()  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->trabajo ?></option>
                                <?php endforeach ?></select>  
                          </div>
                     
<div class="col-md-8">
                            
                            <input readonly name="fecha" class="form-control" id="current_date"/>
                            </div>
                        <br>
                       
                        <--?php endforeach; ?>

                      

                  
                            <button type="submit" href="?c=editar" value="editar" name="editar" id="editar" class="btn btn-success">Guardar</button>
                        
                            <!--<a href="index.php?c=plantillaPrincipal" class="btn btn-block btn-danger">Cancelar</a>-->
                     
                        
            </form>
       </div>

      
    </div>
  </div>
</div>
<script>

date = new Date();
year = date.getFullYear();
month = date.getMonth() + 1;
day = date.getDate();
document.getElementById("current_date").value = day + "/" +  month+ "/" + year;
</script>