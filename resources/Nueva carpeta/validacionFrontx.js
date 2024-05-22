
/*function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    var controlador = $("#controlador").val();
    
     if (textoBusqueda != "") {
        $.post(`index.php?c=${controlador}&a=buscarRegistro`, {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
      };*/
function buscarReg() {
    var buscar = $("#inputVerificarReg").val();
    var textoBusqueda = $(`input#${buscar}`).val();
    var controlador = $("#controlador").val();
    
     if (textoBusqueda != "") {
        $.post(`index.php?c=${controlador}&a=verificarRegistro${controlador}`, {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistro").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistro").html('');
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

    function permite(elEvento, permitidos) {
    // Variables que definen los caracteres permitidos
    var numeros = "0123456789";
    var caracteres = " aábcdeéfghiíjklmnñoópqrstuvwxyzAÁBCDEÉFGHIÍJKLMNÑOÓPQRSTUVWXYZ";
    var numeros_caracteres = numeros + caracteres;
    var teclas_especiales = [8, 37, 39, 46];
    // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
    };
$(document).ready(function() {
	
  $("#verificarRegistro").html('');
    buscarReg ();

	/*$("#resultadoBusqueda").html('');
  	buscar ();*/
  $("#resultadoBusquedaPaciente").html('');
    buscarPacienteReg ();
      //keepNumOrDecimal(obj);
    permite (event, 'num_car');

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





  //var table = $('#example').DataTable();

    // COMIENZO DEL DATATABLE
    if (controlador == 'paciente'){
      //var tabla = '[{"data": "id"},{"data": "cedula"},{"data": "full_name"},{"data": "tlfno"},{"data": "email"},{"data": "estado"},{"defaultContent": "<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>"}]';
      var columnas='';
      columnas =[
      {"data": 'id'},
      {"data": 'cedula'},
      {"data": 'full_name'},
      {"data": 'tlfno'},
      {"data": 'email'},
      {"data": 'estado'},
       {"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
      ];

    }else if(controlador == 'consultorio'){
      var columnas='';
      columnas =[
      {"data": 'id'},
      {"data": 'descripcion'},
      {"data": 'direccion'},
      {"data": 'tlfno'},
      {"data": 'sillas'},
      {"data": 'estado'},
       {"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
      ];
    }else if(controlador == 'planificacion'){
      var columnas='';
      columnas =[
      {"data": 'id'},
      {"data": 'doctor'},
      {"data": 'consultorio'},
      {"data": 'dia_semana'},
      {"data": 'turno'},
       {"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
      ];
    }else if(controlador == 'home'){
      var columnas='';
      columnas =[
      {"data": 'id'},
      {"data": 'consultorio'},
      {"data": 'turno'},
      {"data": 'cedula'},
      {"data": 'paciente'},
      {"data": 'tlfno'},
      {"data": 'email'},
      {"data": 'doctor'}
      ];
    }else if(controlador == 'cita'){
      var columnas='';
      columnas =[
      {"data": 'id'},
      {"data": 'fecha'},
      {"data": 'consultorio'},
      {"data": 'turno'},
      {"data": 'cedula'},
      {"data": 'paciente'},
      {"data": 'tlfno'},
      {"data": 'email'},
      {"data": 'doctor'},
      {"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
      ];
    }


    var table = $('.example').DataTable({

    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json',
    },
    dom: 'Bfrtilp',
  buttons: [
    {
      extend: 'excelHtml5',
      text: '<i class="fas fa-file-excel"></i> ',
      titleAttr: 'Exportar a Excel',
      className: 'btn btn-success',
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
    },
  ],

    "ajax":{
      "url": `index.php?c=${controlador}&a=json`,
      "dataSrc":""
    },

    "columns": columnas,
    columnDefs: [
        {
            target: 0,
            visible: false,
            searchable: false
        },
        
    ]

    });
    
    setInterval( function () {
    table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 30000 )
    //console.log(columnas);
     var obtener_data_editar = function(tbody, table){
        $(tbody).on("click","button.editar", function(){
          var data = table.row($(this).parents("tr")).data();
          //console.log(data);
          var id = data.id;
          location.href =`index.php?c=${controlador}&a=editar&id=${id}`;
          console.log(id);
        });
     }
     var obtener_data_asignar_condicion = function(tbody, table){
        $(tbody).on("click","button.condicion_medica", function(){
          var data = table.row($(this).parents("tr")).data();
          //console.log(data);
          var id = data.id;
          location.href =`index.php?c=${controlador}&a=asignarCondicion&id=${id}`;
          console.log(id);
        });
     }
     var obtener_data_cita = function(tbody, table){
        $(tbody).on("click","button.cita", function(){
          var data = table.row($(this).parents("tr")).data();
          //console.log(data);
          var id = data.id;
          location.href =`index.php?c=${controlador}&a=agendarCita&id=${id}`;
          console.log(id);
        });
     }  
     var obtener_data_eliminar = function(tbody, table){
        $(tbody).on("click","button.eliminar", function(){
          var data = table.row($(this).parents("tr")).data();
          //console.log(data);
          var id = data.id;
          //location.href =`index.php?c=paciente&a=editar&id=${id}`;
          console.log(id);

          swal({
                  title: "Atención!!!",
                  text: "¿Esta seguro de eliminar el registro?!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Confirmar",
                  cancelButtonText: "Cancelar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                }, function(isConfirm) {
                  if (isConfirm) {
                    //Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
                    //window.location.href="index.php?c=paciente&a=inhabilitar&id="+id;

                    $.ajax({
                          type:"POST",
                          url:`index.php?c=${controlador}&a=inhabilitar&id=`+id,
                    
                          success:function(r){
                            if(r==1){
                     
                              swal("Atención!", "Registro Eliminado", "warning")
                             
                              
                             table.ajax.reload(null,false);
                              
                            }else {
                              swal("Atención!", "Error al eliminar", "error")
                            }
                          }

                     });


                  } else {
                    //Si se cancela se emite un mensaje
                    swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
                  }
                });//
        });
     }// funcion eliminar

    //listar();
    obtener_data_editar("#example tbody", table);
    obtener_data_eliminar("#example tbody", table);
    obtener_data_asignar_condicion("#example tbody", table);
    obtener_data_cita("#example tbody", table);

    // APERTURA DEL FORMULARIO PARA REGISTRAR
    $('#abrirModal').click(function(){
    //console.log('pruebaxx');
    $('#trackerModal').modal('show');
    $('#staticBackdrop').modal('show');
  });
  $('#btnguardar').click(function(){
    //var tablex = $('#example').DataTable({});
    var url = $("#urlActual").val();
    var datos=$('#formulario').serialize();
    //console.log('prueba');
    //alert(url);
    $.ajax({
      type:"POST",
      url:url,
      data:datos,
      success:function(r){
        if(r==1){
 
          swal("Excelente", "Registro Exitoso", "success")
                  

          $('#staticBackdrop').modal('hide');
          $('#trackerModal').modal('hide');
          
          table.ajax.reload(null,false);
          //tablex.ajax.reload();

          /*$('#staticBackdrop').modal('dispose');
          $('#trackerModal').modal('dispose');*/
          /*<?php
          require('fpdf186/fpdf.php');

          $pdf = new FPDF();
          $pdf->AddPage();
          $pdf->SetFont('Arial','B',16);
          $pdf->Cell(40,10,'¡Hola, Mundo!');
          $pdf->Output();
          ?>*/

        }else if(r==2){

          swal("Atención!", "Error en registro", "error")

        }else if(r==3){

          swal("Atención!", "Fecha de nacimiento incorrecta", "error")

        }else if(r==4){

          swal("Atención!", "Mes o dia Incorrecto", "error")

        }
        else if(r==5){

          swal("Atención!", "Ya tiene cita asignada", "error")

        }
        else if(r==6){

          swal("Atención!", "Fecha fuera de rango", "error")

        }else {
          swal("Atención!", "Complete los campos", "error")
        }
      }

    });
    return false;
  }); 




  $('#btnmodificar').click(function(){
    var url = $("#accion").val();
    var controlador = $("#controlador").val();
    var datos=$('#formulario').serialize();
    //console.log('prueba');
    //alert(url);
    $.ajax({
      type:"POST",
      url:url,
      data:datos,
      success:function(r){
        if(r==1){
 
          swal("Excelente", "Modificacion Exitosa", "success")
          setTimeout( function() { window.location.href = `index.php?c=${controlador}`; }, 1000 );
          
        }else if(r==2){

          swal("Atención!", "Ya existe una planificacion con los datos Seleccionados", "error")

        }else if(r==3){

          swal("Atención!", "Odontologo ya posee el turno en otro consultorio", "error")

        }else if(r==4){

          swal("Atención!", "No hay sillas disponibles", "error")

        }else if(r==5){

          swal("Atención!", "Mes o dia Incorrecto", "error")

        }else if(r==6){

          swal("Atención!", "Seleccione otro turno o dia diferente", "error")

        }else if(r==7){

          swal("Atención!", "Seleccione una fecha correcta", "error")

        }else if(r==8){

          swal("Atención!", "Error en Modificacion", "error")

        }else {
          swal("Atención!", "Complete los campos", "error")
        }
      }

    });
    return false;
  }); 

    

}); // DOCUMENT READY FUNCTION