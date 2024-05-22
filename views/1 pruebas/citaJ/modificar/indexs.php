
<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="resources/css/bootstrap.css">
    <script type="text/javascript" src="resources/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="resources/js/modalform/styleform.css">

    
    
</head>
<body>
    <br>

<!-- MODAL MODIFICAR-->
<div class="row justify-content-center">
<div class="card text-dark bg-light mb-8 " style="max-width: 80rem;">
<div class="card-body">
	<div id="miModal1" class="modal">
	<div class="flex" id="flex1">
		<div class="contenido-modal">

                        <div class="alert alert-success" role="alert">
                            <h3>Aqui puedes, Modificar Consultorio</h3>
                       
                        </div>
                  
                    <form class="form-horizontal" method="post" action="index.php?c=consultorio&a=modificar">
                        <div class="col-md-8">
                        <input type="hidden" name="id" id="id" value="<?php echo $alm->id; ?>">
                       
                        </div>
              
                        <div class="col-md-8">
                            <input type="text area" id="descripcion" name="descripcion" class="form-control mayusculas buscar" value="<?php echo $alm->descripcion; ?>" aria-describedby="emailHelp" placeholder="Nombre" maxlength="50" required>
							
						            </div>

                        <div class="col-md-8">
                          <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1"  rows="3" placeholder="Direccion" maxlength="100" required><?php echo $alm->direccion; ?></textarea>
                        
                        </div>

						<div class="col-md-8">
						<input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this) id="telefono" value="<?php echo $alm->tlfno; ?>" aria-describedby="emailHelp" placeholder="04245208619" maxlength="11" required>
						</div>
                 	
        
                        <div class="col-md-8">
                          <select name="status" id="status" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <?php foreach ($this->mode->listarStatus()  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"<?php echo $k->id == $alm->status ? 'selected' : '';?>> <?php echo $k->status?></option>
                                <?php endforeach ?>
                            </select>

                        </div>

                      

                        <br>

                  
                            <button type="submit" href="#" value="Guardar" name="registrar" id="registrar" class="btn btn-primary">Modificar</button>
                        	
                          <a class="btn btn-danger" href="index.php?c=consultorio">Cancelar</a>
                            <!--<a href="index.php?c=plantillaPrincipal" class="btn btn-block btn-danger">Cancelar</a>-->
                     
                        
            </form>

</div>
</div>
</div>
</div>
</div>
</div>

<script>
  $(document).ready(function(){
	  modal1.style.display = 'block';
  });

let modal1 = document.getElementById('miModal1');
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

<script>
    
    // Forzar solo números y puntos decimales
    function keepNumOrDecimal(obj) {
     // Reemplace todos los no numéricos primero, excepto la suma numérica.
    obj.value = obj.value.replace(/[^\d.]/g,"");
     // Debe asegurarse de que el primero sea un número y no.
    obj.value = obj.value.replace(/^\./g,"");
     // Garantizar que solo hay uno. No más.
    obj.value = obj.value.replace(/\.{2,}/g,".");
     // Garantía. Solo aparece una vez, no más de dos veces
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
    }
    </script>

    <script type="text/javascript"> // VALIDAR CAMPOS DE SOLO NUMERO Y LETRAS AL INPUT
                          //jQuery('.soloNumeros').keypress(function (tecla) {
                          //if (tecla.charCode < 48 || tecla.charCode > 57) return false;
                          //});
                          
                          $("input.buscar").bind('keypress', function(event) {
                          var regex = new RegExp("^[a-zA-Z ]+$");
                          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                          if (!regex.test(key)) {
                          event.preventDefault();
                          return false;
                          }
                          });
    </script>





    
</body>


</html>