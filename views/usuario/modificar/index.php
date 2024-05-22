<!-- MODAL -->
  
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">
      <form class="form-horizontal" id="formulario" method="post" action="">

        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <a href="index.php?c=usuario" class="btn-close" aria-label="Close"></a>
        </div>

        <div class="modal-body">
          <div class="alert alert-success" role="alert">
            <h3>Modificar usuario</h3>
          </div>
          <div class="container-fluid">
            <div class="row">
                <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                <input type="hidden" id="accion" name="accion" value="index.php?c=usuario&a=modificar">
                <input type="hidden" id="controlador" value="usuario">
                <div class="form-group col-md-6">
                    <label for="rol"><b>Rol:</b></label>
                    <select class="form-control" name="rol" id="rol" required>
                        <option value=""></option>
                        <?php foreach ($this->rol->Consultar("listarRol") as $role) { ?>
                            <option <?php if($role->id==$this->alm->id_rol){ echo "selected"; } ?> value="<?=$role->id; ?>" ><?=$role->nombre; ?></option>
                        <?php } ?>
                    </select>
                    
                </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="usuario"><b>Nombre de Usuario:</b></label>
                <input type="text" class="form-control" name="usuario" id="usuario" onKeyUp=buscarUsuario(); value="<?php echo $this->alm->usuario; ?>" aria-describedby="emailHelp" maxlength="50" placeholder="Nombre de usuario" required>
                <div id="verificarRegistroUsuario"></div>
              </div>

              <div class="form-group col-md-4">
                <label for="password"><b>Password del usuario:</b></label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo $this->alm->password; ?>" aria-describedby="emailHelp" minlength="6" maxlength="100" placeholder="Password de usuario" required>
                <div id="verificarPassword"></div>
              </div>

              <div class="form-group col-md-4">
                <label for="passwordd"><b>Confirmar password:</b></label>
                <input type="password" class="form-control" onKeyUp="contrasena();" name="passwordd" id="passwordd" value="<?php echo $this->alm->password; ?>" aria-describedby="emailHelp" minlength="6" maxlength="100" placeholder="Confirmar Password" required>
                <div id="verificarPasswordd"></div>
              </div>
            </div>
            <div class="form-group col-md-4">
                <label for="passwordd"><b>Codigo de seguridad:</b></label>
                <input type="password" class="form-control" onKeyUp=codigox();keepNumOrDecimal(this) name="codigo" id="codigo" value="<?php echo $this->alm->codigoSeguridad; ?>" aria-describedby="emailHelp" minlength="6" maxlength="4" placeholder="Codigo 4 digitos" required>
                <div id="verificarCodigoo"></div>
              </div>
              <div class="form-group col-md-4">
                <label for="passwordd"><b>Confirmar codigo seguridad:</b></label>
                <input type="password" class="form-control" onKeyUp=codigox();keepNumOrDecimal(this) name="codigoo" id="codigoo" value="<?php echo $this->alm->codigoSeguridad; ?>" aria-describedby="emailHelp" minlength="6" maxlength="4" placeholder="Confirmar Codigo 4 digitos" required>
                <div id="verificarCodigo"></div>
              </div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="passwordd"><b>Pregunta 1:</b></label>
                <input type="text" class="form-control mayusculas buscar" name="pregunta1" id="pregunta1" value="<?php echo $this->alm->pregunta1; ?>" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                <input type="text" class="form-control mayusculas buscar" name="respuesta1" id="respuesta1" value="<?php echo $this->alm->respuesta1; ?>" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
           
                <label for="passwordd"><b>Pregunta 2:</b></label>
                <input type="text" class="form-control mayusculas buscar" name="pregunta2" id="pregunta2" value="<?php echo $this->alm->pregunta2; ?>" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                <input type="text" class="form-control mayusculas buscar" name="respuesta2" id="respuesta2" value="<?php echo $this->alm->respuesta2; ?>" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                
              </div>
              
          
          </div>
        </div>
        <!--.modal-body-->
        <div class="form-group col-md-8">
            <label for="formGroupExampleInput" class="form-label"><b><h4 style="color:red;">Atenciòn!!!</h4></b></label>
            <br>
            <label for="formGroupExampleInput" class="form-label"><b>Escriba y confirme una clave de acceso para iniciar sesion en el Sistema</b></label>
            <br>
            <label for="formGroupExampleInput" class="form-label"><b>Su clave debe cumplir con:</b></label>
            <br>
            <label for="formGroupExampleInput" class="form-label">° La clave de acceso y su confirmacion deben ser iguales</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">° Al menos un caracter especial</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">° Al menos una letra Mayúscula</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">° Al menos un número</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">° Logintud entre 8 y 12 caracteres</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">-> Las preguntas de seguridad y el codigo de 4 números son para recuperar el acceso en caso de olvido de contraseña</label>
            <br>
            <label for="formGroupExampleInput" class="form-label"><b><H4>Por su seguridad No debe contener:</H4></b></label>
            <br>
            <label for="formGroupExampleInput" class="form-label">-> Cedula de identidad/Rif</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">-> Nombres y/o apellidos</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">-> Fecha de nacimiento</label>
            <br>
            <label for="formGroupExampleInput" class="form-label">-> Numeros de telefono</label>
            <br>
            
            
        </div>
        <div class="modal-footer">
          <button type="submit" id="btnmodificar" class="btn btn-outline-success">Guardar</button>
          <a class="btn btn-outline-danger" href="index.php?c=usuario">Cancelar</a>
        </div>
      </form> 



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


</script>

<script>
$(document).ready(function() {
    $("#verificarRegistroUsuario").html('');
});

function buscarUsuario() {
    var textoBusqueda = $("input#usuario").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=usuario&a=verificarRegistroUsuario", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroUsuario").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroUsuario").html('');
        };
};
</script>

<script>
$(document).ready(function() {
    $("#verificarPasswordd").html('');
});

function contrasena() {
    var pass1 = $("input#passwordd").val();
    var pass2 = $("input#password").val();
     if (pass1 != pass2) {
      var mensaje=`<div class='col-md-8'>
                <p style='color:Red;'> Claves no coinciden </p>
                </div>`;
                
                $("#verificarPasswordd").html(mensaje);
     } else { 
        $("#verificarPasswordd").html('');
        };
};
</script>

<script>
$(document).ready(function() {
    $("#verificarCodigo").html('');
});

function codigox() {
    var pass1 = $("input#codigoo").val();
    var pass2 = $("input#codigo").val();
     if (pass1 != pass2) {
      var mensaje=`<div class='col-md-8'>
                <p style='color:Red;'> Codigos no coinciden </p>
                </div>`;
                
                $("#verificarCodigo").html(mensaje);
     } else { 
        $("#verificarCodigo").html('');
        };
};
</script>