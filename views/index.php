<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="resources/js/jquery.js"></script>
    <script type="text/javascript" src="resources/ingresarAjax.js"></script>
    <link rel="stylesheet" href="resources/login/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resources/login/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> 
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">-->

  <!--<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>-->




    <title>Inicio de sesión</title>
</head>

<body>



    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.svg">
        </div>
        <div class="login-content">
            <form method="POST" id="formulario" action="">

                <input type="hidden" id="urlActual" value="index.php?credenciales=login&a=acceder">

                <img src="resources/login/img/avatar.svg">
                <h2 class="title">BIENVENIDO</h2>
                <!-- AQUI VA EL MENSAJE DE ERROR -->
                    <!-- <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                        <small>mensaje de error</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->                
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="usuario" type="text"
                            class="input" name="usuario"
                            title="ingrese su nombre de usuario" autocomplete="usuario" value="" maxlength="10">


                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" id="password" class="input"
                            name="password" title="ingrese su clave para ingresare" autocomplete="current-password" maxlength="10">


                    </div>
                </div>

                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>

                <div class="form-group">
                    <select name="consultorio" id="consultorio" class="form-control select2 rounded-left">
                        <option value="">Consultorios</option>
                        <?php foreach ($_SESSION['consultorios'] as $cons) { ?>
                            <option value="<?=$cons->id; ?>" ><?=$cons->descripcion." (".$cons->direccion.")"; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="text-center">
                    <a class="font-italic isai5"  id="abrirModal" href="#" data-toggle="modal" data-target="#exampleModal">Olvidé mi contraseña</a>

                    
                </div>
                <input name="btningresar" id="btningresar" class="btn" title="click para ingresar" type="submit"
                    value="INICIAR SESION">
            </form>
        </div>
    </div>
    






<!-- Modal -->
<div class="modal fade" style="overflow-y: scroll;" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar Acceso</h5>
        <button type="button" class="close" id="cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="POST" id="formulariox" name="formulariox">
          <input type="hidden" id="urlValida" value="index.php?credenciales=login&a=validar">
          <div class="form-group">
            <label for="exampleInputEmail1">Usuario:</label>
            <input type="text" class="form-control"  id="usuariox" name="usuariox" aria-describedby="emailHelp" placeholder="usuario" maxlength="10" required>
            <small id="emailHelp" class="form-text text-muted">Introduzca su usuario</small>
            <!--onKeyUp=buscarRegx();-->
          </div>

          <div id="verificarRegistrox"></div>
          
          <!--<div id="validar">
            
          <div class="form-group">
            <label for="exampleInputPassword1">Pregunta1</label>
            <input type="password" class="form-control" id="pregunta1" name="pregunta1" placeholder="Respuesta">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword2">Pregunta2</label>
            <input type="password" class="form-control" id="pregunta2" name="pregunta2" placeholder="Respuesta">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword3">Codigo Seguridad</label>
            <input type="password" class="form-control" id="codigoSeguridad" placeholder="Codigo Seguridad">
          </div>
          
          
          </div>
          -->
          <button type="submit" name="validarButton" onclick="buscarRegx();" id="validarButton" class="btn btn-outline-success">Buscar</button>


          
          </form>

          <button type='submit' name='validarSeguridad' id='validarSeguridad' class='btn btn-outline-success'>Validar</button>
          
          <!--<button type='submit' name='validarSeguridadx' onclick='validarSeguridad();' id='validarSeguridadx' class='btn btn-outline-success'>ValidarJS</button>-->

          <div id="Newpassword">
            <form id="cambiarPass" name="cambiarPass" method="POST">
          <div class="form-group">
            <input type="hidden" id="usuarioxx" name="usuarioxx" value="Aaaa">
            <label for="exampleInputPassword1x">Nueva Contraseña</label>
            <input type="password" onKeyUp="contrasena();" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" maxlength="8">
          </div>
          <div id="verificarPassword"></div>
          <div class="form-group">
            <label for="exampleInputPassword1x">Repetir Nueva Contraseña</label>
            <input type="password" onKeyUp="contrasena();" class="form-control" id="exampleInputPassword2" name="exampleInputPassword2" maxlength="8">
          </div>
          <div id="verificarPasswordd"></div>

            <label for="formGroupExampleInput" class="form-label"><b><h4 style="color:red;">Atención!!!</h4></b></label>
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
            
    

          <button type="submit" id="cambiarPassword" class="btn btn-success">Guardar</button>
          </form>
        </div>  
        
        

      </div>
     
      
    </div>
  </div>
</div>





 

    <script type="text/javascript" src="resources/msjAlert/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="resources/msjAlert/sweetalert.css">
    <script src="resources/login/js/fontawesome.js"></script>
    <script src="resources/login/js/main.js"></script>
   <!-- <script src="resources/login/js/main2.js"></script>-->
    <script src="resources/login/js/jquery.min.js"></script>
    <script src="resources/login/js/bootstrap.js"></script>
    <script src="resources/login/js/bootstrap.bundle.js"></script>

    <!-- LOGIN -->
    <script type="text/javascript" src="resources/msjAlert/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="resources/msjAlert/sweetalert.css">
    
    <!-- LOGIN -->























































    <script type="text/javascript">

        var contador = true;
        function vista() {
            console.log('hpa');
            var texto = document.getElementById("verPassword");
            if (contador == true) {
              texto.className = "fas fa-eye-slash verPassword";
              document.getElementById("password").type="text";
              contador=false;
              console.log(contador);
          } else {
              texto.className = "fas fa-eye verPassword";
              document.getElementById("password").type="password";
              contador = true;
              console.log(contador);
          }
      }
      
  </script>




  <script type="text/javascript">
    $(document).ready(function(){
    
    $("#validar").hide();
    $("#Newpassword").hide();
    $("#validarSeguridad").hide();

    $('#abrirModal').click(function(){
    //console.log('pruebaxx');
    $('#trackerModal').modal('show');
    $('#staticBackdrop').modal('show');
    });

    $('#cerrar').click(function(){
        var usuario = document.getElementById("usuariox");
        usuario.disabled = false;
        $("#usuariox").val('');
        $("#validaciones").hide();
        $("#validarButton").show();
        $("#validarSeguridad").hide();
        $("#Newpassword").hide();
    });
    

});
  </script>



<script type="text/javascript">

  function buscarRegx() {
    //$("#verificarRegistrox").html('<h1> HOLA </h1>');
    //var buscar = $("#inputVerificarReg").val();
    var usuario = document.getElementById("usuariox");
    var textoBusqueda = $(`input#usuariox`).val();
    //var controlador = $("#controlador").val();
    
     if (textoBusqueda != "") {
        $.post(`index.php?credenciales=login&a=verificarRegistro`, {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistrox").html(mensaje);
            if (mensaje == ""){

            }else{
              usuario.disabled = true;
              $("#validarButton").hide();
              $("#validarSeguridad").show();
            }
            

            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistrox").html('');
        usuario.disabled = false;
        };
    };
  
</script>




<script type="text/javascript">


  $('#validarSeguridad').click(function(){

   
    //var datos=$('#formularioz').serialize();
 
    var usuario = $(`input#usuariox`).val();
    //var textoBusqueda = $(`input#usuariox`).val();
    var respuesta1 = $(`input#pregunta1`).val();
    var respuesta2 = $(`input#pregunta2`).val();
    var codigoSeguridad = $(`input#codigoSeguridad`).val();
    console.log(respuesta1,respuesta2,codigoSeguridad,usuario);
    

    if (respuesta1 != "" && respuesta2 != "" && codigoSeguridad != "") {
        $.post(`index.php?credenciales=login&a=verificarSeguridad`, {respuesta1,respuesta2,codigoSeguridad,usuario}, function(r) {
            
            if (r == "1"){
              
              console.log('valida');
              $("#mensajeError").html('');
              $("#validarSeguridad").hide();
              $("#validaciones").hide();
              $("#Newpassword").show();
              $("#usuarioxx").val($("#usuariox").val());
            }else if (r == "2"){
              
              //$("#Newpassword").show();
              console.log('No valida');
              $("#mensajeError").html(`<div class="alert alert-danger" role="alert">
                Respuestas incorrectas
              </div>`);
            }
            

          
         }); 
     } else { 
            
            swal("Atención!", "Complete los campos", "error")
        };


  })
  
</script>


<script>
$(document).ready(function() {
    $("#verificarPasswordd").html('');
    var buttonCambiarPassword = document.getElementById("cambiarPassword");
    buttonCambiarPassword.disabled = true;

    //$("#verificarPassword").html('');
});

function contrasena() {
    var buttonCambiarPassword = document.getElementById("cambiarPassword");
    var pass1 = $("input#exampleInputPassword1").val();
    var pass2 = $("input#exampleInputPassword2").val();
    const inputElement1 = document.getElementById('exampleInputPassword1');
    const numeroCaracteresPass1 = inputElement1.value.length;
    const inputElement2 = document.getElementById('exampleInputPassword2');
    const numeroCaracteresPass2 = inputElement2.value.length;
    
    if(numeroCaracteresPass1 > 7 && numeroCaracteresPass2 > 7){
      //console.log('hola');
      buttonCambiarPassword.disabled = false;
    }
     if (pass1 != pass2 ) {
      var mensaje=`<div class='col-md-8'>
                <p style='color:Red;'> Claves no coinciden </p>
                </div>`;
                
                $("#verificarPasswordd").html(mensaje);
                buttonCambiarPassword.disabled = true;
                //$("#verificarPassword").html(mensaje);
     } else { 
        $("#verificarPasswordd").html('');
        //buttonCambiarPassword.disabled = false;
        //$("#verificarPassword").html('');
        };
};
</script>






















<script type="text/javascript">
    function validarSeguridad() {

    var usuario = document.getElementById("usuariox");
    var textoBusqueda = $(`input#usuariox`).val();
    var pregunta1 = $(`input#pregunta1`).val();
    var pregunta2 = $(`input#pregunta2`).val();
    var codigoSeguridad = $(`input#codigoSeguridad`).val();
    console.log(pregunta1,pregunta2, codigoSeguridad);

     /*if (textoBusqueda != "") {
        $.post(`index.php?credenciales=login&a=verificarSeguridad`, {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistrox").html(mensaje);
            if (mensaje == ""){
              $("#Newpassword").hide();
            }else{
              //usuario.disabled = true;
              //$("#validarButton").hide();
              $("#Newpassword").hide();
            }
            

          
         }); 
     } else { 
        $("#verificarRegistrox").html('');
        usuario.disabled = false;
        };*/
    };
</script>

</body>
</html>
