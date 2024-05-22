
function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    var controlador = $("#controlador").val();
    
     if (textoBusqueda != "") {
        $.post(`index.php?c=${controlador}&a=buscarRegistro`, {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
      };

function buscarPacienteReg() {
    var textoBusqueda = $("input#busquedaPaciente").val();
    var controlador = $("#controlador").val();
    
     if (textoBusqueda != "") {
        $.post(`index.php?c=${controlador}&a=buscarPacienteReg`, {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusquedaPaciente").html(mensaje);
         }); 
     } else { 
        $("#resultadoBusquedaPaciente").html('');
        };
      };


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
    };

$(document).ready(function() {
	
	$("#resultadoBusqueda").html('');
  	buscar ();
    $("#resultadoBusquedaPaciente").html('');
    buscarPacienteReg ();
    //keepNumOrDecimal(obj);

  //CARGAR LA TABLA EN LOS INDEX DE LOS MODULOS
  var controlador = $("#controlador").val();
  	setInterval( function(){
	$('#tabla').load(`index.php?c=${controlador}&a=tabla${controlador}`);
	},3000)
  //VALIDAR SOLO TEXTO EN EL INPUT BUSCAR
    $("input.buscar").bind('keypress', function(event) {
                          var regex = new RegExp("^[a-zA-Z ]+$");
                          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                          if (!regex.test(key)) {
                          event.preventDefault();
                          return false;
                          }
                          });

    

});