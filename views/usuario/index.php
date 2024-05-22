
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


<!-- FIN DEL BOTON BUSCAR -->

<!-- MODAL -->
<div class="modal fade" id="trackerModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" id="salir" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

    <form class="form-horizontal" method="post" id="formulario" action="">
      <input type="hidden" id="id" name="id">
      <input type="hidden" id="urlActual" name="urlActual" value="index.php?c=usuario&a=guardar">
      <input type="hidden" id="accion" name="accion" value="index.php?c=usuario&a=modificar">
      <input type="hidden" id="controlador" name="controlador" value="usuario">

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
            <h3>Usuario</h3>
        </div>
        <div class="container-fluid">
            <!-- COLUMNA -->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="empleado"><b>Empleado:</b></label>
                    <select class="form-select form-select-lg mb-1" name="empleado" id="empleado" required>
      
                        <?php foreach ($this->empleado->Consultar("listarEmpleadoUsuario1") as $emp) { ?>
                            <option value="<?=$emp->id; ?>" ><?=$emp->nombres." ".$emp->apellidos." (".$emp->cedula.")"; ?></option>
                        <?php } ?>
                    </select>
                     
                </div>

                <div class="form-group col-md-6">
                    <label for="rol"><b>Rol:</b></label>
                    <select class="form-select form-select-lg mb-1" name="rol" id="rol" required>
                     
                        <?php foreach ($this->rol->Consultar("listarRol") as $role) { ?>
                            <option value="<?=$role->id; ?>" ><?=$role->nombre; ?></option>
                        <?php } ?>
                    </select>
                    
                </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="usuario"><b>Nombre de Usuario:</b></label>
                <input type="text" class="form-control" name="usuario" id="usuario" value="" aria-describedby="emailHelp" maxlength="50" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="usuario">
                <div id="verificarRegistro"></div>
              </div>

              <div class="form-group col-md-4">
                <label for="password"><b>Password del usuario:</b></label>
                <input type="password" class="form-control" onKeyUp="contrasena();" name="password" id="password" value="" aria-describedby="emailHelp" minlength="6" maxlength="12" placeholder="Password de usuario" required>
                <div id="verificarPassword"></div>
              </div>

              <div class="form-group col-md-4">
                <label for="passwordd"><b>Confirmar password:</b></label>
                <input type="password" class="form-control" onKeyUp="contrasena();" name="passwordd" id="passwordd" value="" aria-describedby="emailHelp" minlength="6" maxlength="12" placeholder="Confirmar Password" required>
                <div id="verificarPasswordd"></div>
              </div>
              <div class="form-group col-md-4">
                <label for="passwordd"><b>Codigo de seguridad:</b></label>
                <input type="password" class="form-control" onKeyUp=codigox();keepNumOrDecimal(this) name="codigo" id="codigo" value="" aria-describedby="emailHelp" minlength="6" maxlength="4" placeholder="Codigo 4 digitos" required>
                <div id="verificarCodigo"></div>
              </div>
              <div class="form-group col-md-4">
                <label for="passwordd"><b>Confirmar codigo seguridad:</b></label>
                <input type="password" class="form-control" onKeyUp=codigox();keepNumOrDecimal(this) name="codigoo" id="codigoo" value="" aria-describedby="emailHelp" minlength="6" maxlength="4" placeholder="Confirmar Codigo 4 digitos" required>
                <div id="verificarCodigoo"></div>
              </div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="passwordd"><b>Pregunta 1:</b></label>
                <input type="text" class="form-control mayusculas buscar" name="pregunta1" id="pregunta1" value="" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                <input type="text" class="form-control mayusculas buscar" name="respuesta1" id="respuesta1" value="" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
           
                <label for="passwordd"><b>Pregunta 2:</b></label>
                <input type="text" class="form-control mayusculas buscar" name="pregunta2" id="pregunta2" value="" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                <input type="text" class="form-control mayusculas buscar" name="respuesta2" id="respuesta2" value="" aria-describedby="emailHelp" maxlength="100" onKeyUp="buscarReg();" placeholder="Nombre de usuario" required>
                
              </div>

            </div>

        </div>
      </div>
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
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" id="btnguardar" class="btn btn-outline-success">Registrar</button>
       
        <button type="button" id="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
     </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->



<div id="apartado1" align='center'>
<h3>Usuarios</h3>
</div>


<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Empleado</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>

 <br><br><br>

<script>
$(document).ready(function() {
    $("#verificarPasswordd").html('');
    $("#verificarPassword").html('');
});

function contrasena() {
    var pass1 = $("input#passwordd").val();
    var pass2 = $("input#password").val();
     if (pass1 != pass2) {
      var mensaje=`<div class='col-md-8'>
                <p style='color:Red;'> Claves no coinciden </p>
                </div>`;
                
                $("#verificarPasswordd").html(mensaje);
                $("#verificarPassword").html(mensaje);
     } else { 
        $("#verificarPasswordd").html('');
        $("#verificarPassword").html('');
        };
};
</script>

<script>
$(document).ready(function() {
    $("#verificarCodigo").html('');
    $("#verificarCodigoo").html('');
});

function codigox() {
    var pass1 = $("input#codigoo").val();
    var pass2 = $("input#codigo").val();
     if (pass1 != pass2) {
      var mensaje=`<div class='col-md-8'>
                <p style='color:Red;'> Codigos no coinciden </p>
                </div>`;
                
                $("#verificarCodigo").html(mensaje);
                $("#verificarCodigoo").html(mensaje);
     } else { 
        $("#verificarCodigo").html('');
        $("#verificarCodigoo").html('');
        };
};
</script>