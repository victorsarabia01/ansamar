
$(document).ready(function(){

  $('#btnasignar').click(function(){
    var url = $("#urlActual").val();
    var datos=$('#formulario').serialize();
    
    $.ajax({
      type:"POST",
      url:url,
      data:datos,
      success:function(r){
        if(r==1){
 
          swal("Excelente", "Registro Exitoso", "success")
      
          location.reload();
        }else if(r==2){

          swal("Atención!", "Condicion medica existe", "warning")

        }else {
          swal("Atención!", "Error en Registro", "error")
        }
      }

    });
    return false;
  }); 

  $(".eliminar").click(function(e){
        //console.log('pasa');
    e.preventDefault();
    var id = $(this).attr('id');
    swal({
      title: "Atención!!!",
      text: "¿Esta seguro de inhabilitar el registro?!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Confirmar",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
    //Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
        //window.location.href="index.php?c=paciente&a=eliminarCondicionMedica&id="+id;
                      $.ajax({
                          type:"POST",
                          url:"index.php?c=paciente&a=eliminarCondicionMedica&id="+id,
                    
                          success:function(r){
                            if(r==1){
                     
                              swal("Atención!", "Registro Eliminado", "warning")
                              location.reload();
                              
                            }else {
                              swal("Atención!", "Error al eliminar", "error")
                            }
                          }

                     });
      } else {
    //Si se cancela se emite un mensaje
        swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
      }
    });
    });
  
});

