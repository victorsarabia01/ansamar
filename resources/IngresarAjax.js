$(document).ready(function(){

/*var contador = true;
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
  }*/

/*$('#abrirModal').click(function(){
    console.log('pruebaxx');
    $('#trackerModal').modal('show');
    $('#staticBackdrop').modal('show');
    });*/
  
$('#btningresar').click(function(){
  console.log("sipasa");
    var url = $("#urlActual").val();
    var datos=$('#formulario').serialize();
    //console.log('pruebaxxxxxxxxxxx');
    //alert(url);
    $.ajax({
      type:"POST",
      url:url,
      data:datos,
      success:function(r){
        if(r==1){
 
          swal("Excelente", "Bienvenido", "success")
          setTimeout( function() { window.location.href = 'index.php'; }, 1000 );
          /*$('#staticBackdrop').modal('hide');
          $('#trackerModal').modal('hide');*/
          /*$('#staticBackdrop').modal('dispose');
          $('#trackerModal').modal('dispose');*/
        }else if(r==2){
          swal("Atención!", "Usuario o clave Invalida", "error")
        }else if(r==3){
          swal("Atención!", "Acceso denegado", "warning")
        }else if(r==4){
          swal("Atención!", "Complete los campos", "error")
        }
        else if(r==5){
          swal("Atención!", "Clave incorrecta", "error")
        }
        else if(r==6){
          swal("Atención!", "Clave correcta", "error")
        }

        
      }

    });
    return false;
  }); 





$('#validarButton').click(function(){

//console.log("sipasaButtonx");
var urlx = $("#urlValida").val();
var datosx=$('#formulariox').serialize();
//console.log("sipasaButton");

        $.ajax({
        type:"POST",
        url:urlx,
        data:datosx,
        success:function(r){
        if(r==1){

        //swal("Excelente", "Bienvenidocc", "success")
        $("#validar").show();
        //$("#resultado").html(r);
        //$("#pregunta1").val(r)
        //$("#pregunta2").val(r)
        }
        else if (r==2){
          swal("Atención!", "Usuario no existe", "error")
        }else{
          swal("Atención!", "Campos vacios", "error")
        }


        }

        });
        return false;
        }); 



$('#cambiarPassword').click(function(){
  //console.log("sipasa");
    //var url = $("#urlActual").val();
    var datos=$('#cambiarPass').serialize();
    //console.log('pruebaxxxxxxxxxxx');
    //alert(url);
    //var datos = '';
    $.ajax({
      type:"POST",
      url:`index.php?credenciales=login&a=cambiarPassword`,
      data:datos,
      success:function(r){
        if(r==1){
 
          swal("Excelente", "Cambio de Contraseña Exitoso", "success")   
          setTimeout( function() { window.location.href = 'index.php'; }, 1000 );
        }else{
          swal("Atención!", "Error en el cambio de Contraseña", "error")
        }

        
      }

    });
    return false;
  }); 

  
});


