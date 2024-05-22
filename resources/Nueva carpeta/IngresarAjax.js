$(document).ready(function(){
  
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
        
      }

    });
    return false;
  }); 
  
});


