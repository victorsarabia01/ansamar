
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
/*function validarTlfno(){
const btn = document.getElementById('btnguardar');
if($('#telefono').val().length <10 || $('#descripcion').val().length <10 || $('#direccion').val().length <10 ){

btn.disabled = true; 

}else{
btn.disabled = false;
}
}*/
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

//$.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );

//var campo = $('#telefono').val();

//validarTlfno();

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
$('#tabla').load(`index.php?c=${controlador}&a=tabla${controlador}&fechaa=2024-01-03&fechac=2024-01-04`);
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




$('#example td:nth-child(2)').css('font-weight', 'bold');
//var table = $('#example').DataTable();


$('.datatable').DataTable();



//$.fn.dataTable.moment( 'DD/MM/YYYY' );



// COMIENZO DEL DATATABLE
if (controlador == 'empleado'){
var definicionColumnas =[ 
{
target: 0,
visible: false,
searchable: false
},

{ className: "bolded", "targets": [ 0 ] }
,
{
"targets": [1],
  
},

]; 
//var tabla = '[{"data": "id"},{"data": "cedula"},{"data": "full_name"},{"data": "tlfno"},{"data": "email"},{"data": "estado"},{"defaultContent": "<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>"}]';
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'cargo'},
{"data": 'cedula'},
{"data": 'full_name'},
{"data": 'tlfno'},
{"data": 'email'},
{"data": 'direccion'},
{"data": 'estado'},
{"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if (controlador == 'paciente'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
//var tabla = '[{"data": "id"},{"data": "cedula"},{"data": "full_name"},{"data": "tlfno"},{"data": "email"},{"data": "estado"},{"defaultContent": "<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>"}]';
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'cedula'},
{"data": 'full_name'},
{"data": 'tlfno'},
{"data": 'email'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="condicion_medica" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" title="cita" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="eliminar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if (controlador == 'tipoEmpleado'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
//var tabla = '[{"data": "id"},{"data": "cedula"},{"data": "full_name"},{"data": "tlfno"},{"data": "email"},{"data": "estado"},{"defaultContent": "<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>"}]';
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'descripcion'},
{"data": 'estado'},
{"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if (controlador == 'serviciodental'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
//var tabla = '[{"data": "id"},{"data": "cedula"},{"data": "full_name"},{"data": "tlfno"},{"data": "email"},{"data": "estado"},{"defaultContent": "<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>"}]';
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'nombre'},
{"data": 'descripcion'},
{"data": 'precio'},
{"data": 'estado'},
{"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if (controlador == 'condicionMedica'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
//var tabla = '[{"data": "id"},{"data": "cedula"},{"data": "full_name"},{"data": "tlfno"},{"data": "email"},{"data": "estado"},{"defaultContent": "<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" class="condicion_medica btn btn-outline-info"><i class="bi bi-bag-heart"></i> </button> <button type="button" class="cita btn btn-outline-info"><i class="bi bi-calendar-check"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>"}]';
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'descripcion'},
{"data": 'observacion'},
{"data": 'estado'},
{"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'consultorio'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'descripcion'},
{"data": 'direccion'},
{"data": 'tlfno'},
{"data": 'sillas'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="Editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="Editar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'pagos'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'numero'},
{"data": 'fecha_pago'},
{"data": 'nombre_paciente'},
{"data": 'tipo_pago'},
{"data": 'referencia'},
{"data": 'tasaM'},
{"data": 'montoM'},
{"data": 'equivalenteM'},
{"data": 'leyenda'},
{"data": 'estado'},
{"defaultContent": 
'<button type="button" title="PDF" class="pdfTemp btn btn-outline-danger">PDF</button>   <button type="button" title="Editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button>  <button type="button" title="Editar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'rol'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'nombre'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="Editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="Editar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'insumo'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'nombre'},
{"data": 'descripcion'},
{"data": 'stock'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="Editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="Editar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'proveedor'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'descripcion'},
{"data": 'direccion'},
{"data": 'tlfno'},
{"data": 'email'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="Editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="Editar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'modulo'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'nombre'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="eliminar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'permiso'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'nombre'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="eliminar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'bitacora'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'modulo'},
{"data": 'accion'},
{"data": 'fechas'},
{"data": 'user'},
];
}else if(controlador == 'usuario'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'empleado'},
{"data": 'usuario'},
{"data": 'rol'},
{"data": 'estado'},
{"defaultContent": '<button type="button" title="editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="status" class="status btn btn-outline-secondary"><i class="bi bi-toggle2-off"></i> </button> <button type="button" title="eliminar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'planificacion'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
var columnas='';
columnas =[
{"data": 'id'},
{"data": 'doctor'},
{"data": 'consultorio'},
{"data": 'dia_semana'},
{"data": 'turno'},
{"defaultContent": '<button type="button" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button>  <button type="button" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}else if(controlador == 'home'){
var definicionColumnas=[ {
target: 0,
visible: false,
searchable: false
},];
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
//var fecha='';
var definicionColumnas =[ 
{
target: 0,
visible: false,
searchable: false
},

{ className: "bolded", "targets": [ 0 ] }
,
{
"targets": [1],
  "render": function (data) {
      return moment(data).format('DD-MM-YYYY');
},



},

]; 
//console.log(fecha);
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
{"defaultContent": '<button type="button" title="editar" class="editar btn btn-outline-primary"><i class="bi bi-pencil-square"></i> </button> <button type="button" title="PDF" target="_blank" class="pdf btn btn-outline-success"><i class="bi bi-filetype-pdf"></i> </button> </button> <a href="?c=sendEmail&id=103" id="enviarEmail" target="_blank"> <button type="button" title="eliminar" class="eliminar btn btn-outline-danger"><i class="bi bi-trash"></i> </button>'}
];
}

var dateTemp = "";
var fechaa = $(".fechaa").val();
var fechac = $(".fechac").val();
if(fechaa != "" && fechac != ""){
// alert(fechaa+' '+fechac);
dateTemp = '&fechaa='+fechaa+'&fechac='+fechac;
}
// alert(dateTemp);
var table = $('#example').DataTable({

"pageLength": 7,
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
'colvis'
],

"ajax":{
"url": `index.php?c=${controlador}&a=json${dateTemp}`,
"dataSrc":""
},

"columns": 

columnas
,
"columnDefs":
definicionColumnas,




});

$( table.column( 3 ).nodes() ).addClass( 'bolded' );

/*$( table.column( 1 ).nodes() ).addClass( 'bolded' );
$( table.column( 1 ).nodes() ).addClass( 'bold' );*/


setInterval( function () {
table.ajax.reload( null, false ); // user paging is not reset on reload
}, 30000 )
//console.log(columnas);
var obtener_data_editar = function(tbody, table){
$(tbody).on("click","button.editar", function(){
var data = table.row($(this).parents("tr")).data();
//console.log(data);
var id = data.id;
// alert(dateTemp);
if (controlador == 'planificacion' || controlador == 'empleado' || controlador == 'paciente' || controlador == 'pagos' || controlador == 'usuario' || controlador == 'rol' || controlador == 'cita'){
location.href =`index.php?c=${controlador}&a=editar&id=${id}${dateTemp}`;
}else{
var id_registro=$("#id").val(data.id),
descripcion=$("#descripcion").val(data.descripcion),
direccion=$("#direccion").val(data.direccion),
sillas=$("#sillas").val(data.sillas),
nombre=$("#nombre").val(data.nombre),
precio=$("#precio").val(data.precio),
observacion=$("#observacion").val(data.observacion),
email=$("#email").val(data.email),
telefono=$("#telefono").val(data.tlfno),
cantidad=$("#cantidad").val(data.stock);
//status=$("#status").val(data.status);
//location.href =`index.php?c=${controlador}&a=editar&id=${id}`;
$('#staticBackdrop').modal('show');
$('#exampleModal').modal('show');

}
console.log(id);
});
}
var obtener_data_pdfComp = function(tbody, table){
$(tbody).on("click","button.pdfTemp", function(){
var data = table.row($(this).parents("tr")).data();
//console.log(data);
var id = data.id;
// alert(dateTemp);
if (controlador == 'pagos'){
window.open(`index.php?c=pagos&a=reportePDF&tipo=pagosPDF&id=${id}`, '_blank');
}
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
var obtener_data_PDF = function(tbody, table){
$(tbody).on("click","button.pdf", function(){
var data = table.row($(this).parents("tr")).data();
//console.log(data);
var id = data.id;
//alert('asdasd');
//document.getElementById('enviarEmail').click;
// location.href =`index.php?c=sendEmail&a=pdf&id=${id}`;
// var anchor = document.createElement('a');
// anchor.href = 'index.php?c=sendEmail&id=${id}';
// anchor.target="_blank";
// anchor.click();
//window.open(`index.php?c=sendEmail`, '_blank');


window.open(`index.php?c=citaPdf&a=pdf&id=${id}`, '_blank');
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
var obtener_data_status = function(tbody, table){
$(tbody).on("click","button.status", function(){
var data = table.row($(this).parents("tr")).data();
//console.log(data);
var status = data.estado;
var id = data.id;
//var id = data.id;
//location.href =`index.php?c=${controlador}&a=cambiarStatus&id=${id}`;
//console.log(id);
if(status=='Activo'){
console.log('activo');
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
}, function(isConfirm) {
if (isConfirm) {
  //Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
  //window.location.href="index.php?c=paciente&a=inhabilitar&id="+id;

  $.ajax({
        type:"POST",
        url:`index.php?c=${controlador}&a=inhabilitar&id=`+id,
  
        success:function(r){
          if(r==1){
   
            swal("Atención!", "Registro Inhabilitado", "warning")
           
            
           table.ajax.reload(null,false);
            
          }else {
            swal("Atención!", "Error al eliminar", "error")
          }
        }

   });


} else {
  //Si se cancela se emite un mensaje
  swal("Cancelado", "Usted ha cancelado la acción de Inhabilitacion", "error");
}
});//
}else{
console.log('inactivo');
swal({
title: "Atención!!!",
text: "¿Esta seguro de Habilitar el registro?!",
type: "success",
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
        url:`index.php?c=${controlador}&a=habilitar&id=`+id,
  
        success:function(r){
          if(r==1){
   
            swal("Atención!", "Registro Habilitado", "success")
           
            
           table.ajax.reload(null,false);
            
          }else {
            swal("Atención!", "Error al eliminar", "error")
          }
        }

   });


} else {
  //Si se cancela se emite un mensaje
  swal("Cancelado", "Usted ha cancelado la acción de Activacion", "error");
}
});//
}
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

        url:`index.php?c=${controlador}&a=eliminar&id=`+id,
  
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
obtener_data_pdfComp("#example tbody", table);
obtener_data_editar("#example tbody", table);
obtener_data_eliminar("#example tbody", table);
obtener_data_status("#example tbody", table);
obtener_data_asignar_condicion("#example tbody", table);
obtener_data_cita("#example tbody", table);
obtener_data_PDF("#example tbody", table);

$('#cancelar').click(function(){

$("#id").val('');
$("#descripcion").val('');
$("#direccion").val('');
$("#sillas").val('');
$("#telefono").val('');
$("#cedula").val('');
$("#email").val('');
$("#nombres").val('');
$("#apellidos").val('');
$("#fecha").val('');
$("#nombre").val('');
$("#precio").val('');
$("#observacion").val('');
$("#usuario").val('');
$("#password").val('');
$("#passwordd").val('');
$("#cantidad").val('');


});
$('#salir').click(function(){

$("#id").val('');
$("#descripcion").val('');
$("#direccion").val('');
$("#sillas").val('');
$("#telefono").val('');
$("#cedula").val('');
$("#email").val('');
$("#nombres").val('');
$("#apellidos").val('');
$("#fecha").val('');
$("#nombre").val('');
$("#precio").val('');
$("#observacion").val('');
$("#usuario").val('');
$("#password").val('');
$("#passwordd").val('');

$("#cantidad").val('');

});


// APERTURA DEL FORMULARIO PARA REGISTRAR
$('#abrirModal').click(function(){
//console.log('pruebaxx');
$('#trackerModal').modal('show');
$('#staticBackdrop').modal('show');
});

$('#btnguardar').click(function(){

var url = $("#urlActual").val();
var datos=$('#formulario').serialize();
var controlador = $("#controlador").val();





if(document.getElementById("id").value == "" ){
console.log('guardar');
$.ajax({
type:"POST",
url:url,
data:datos,
success:function(r){
// alert(r);
if(r==1){

swal("Excelente", "Registro Exitoso", "success")
if(url=='index.php?c=pagos&a=guardar'){
$.ajax({
  type:"POST",
  url:'index.php?c=pagos&&a=abrirReporte',
  data:{},
  success:function(id){
      console.log('ID: '+id);
      window.open(`index.php?c=pagos&a=reportePDF&tipo=pagosPDF&id=${id}`, '_blank');
  }
});
}

$('#staticBackdrop').modal('hide');
$('#trackerModal').modal('hide');
$('#exampleModal').modal('hide');

table.ajax.reload(null,false);
$("#id").val('');
$("#descripcion").val('');
$("#direccion").val('');
$("#sillas").val('');
$("#telefono").val('');
$("#cedula").val('');
$("#email").val('');
$("#nombres").val('');
$("#nombre").val('');
$("#apellidos").val('');
$("#fecha").val('');
$("#nombre").val('');
$("#precio").val('');
$("#cantidad").val('');
$("#observacion").val('');
$("#usuario").val('');
$("#password").val('');
$("#passwordd").val('');
$("#formulario").reset();
$("#cantidad").val('');
//$("#formulario").find("input,textarea,select").val("");

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

}else if(r==7){

swal("Atención!", "Contraseñas no coinciden", "error")

}else if(r==8){

swal("Atención!", "Registro no encontrado", "error")

}else {
swal("Atención!", "Complete los campos", "error")
}
}

});
return false;

}else{

var url = $("#accion").val();
console.log('modificar');
$.ajax({
type:"POST",
url:url,
data:datos,
success:function(r){
if(r==1){

swal("Excelente", "Modificacion Exitosa", "success")
$('#staticBackdrop').modal('hide');
$('#trackerModal').modal('hide');

table.ajax.reload(null,false);
$("#id").val('');
$("#descripcion").val('');
$("#direccion").val('');
$("#sillas").val('');
$("#telefono").val('');
$("#cedula").val('');
$("#email").val('');
$("#nombres").val('');
$("#apellidos").val('');
$("#fecha").val('');
$("#nombre").val('');
$("#precio").val('');
$("#observacion").val('');
$("#cantidad").val('');
//$("#formulario").find("input,textarea,select").val("");
//setTimeout( function() { window.location.href = `index.php?c=${controlador}`; }, 1000 );

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

}else if(r==9){

swal("Atención!", "Las Contraseñas no coinciden", "error")

}else if(r==10){

swal("Atención!", "Usuario no disponible", "error")

}else {
swal("Atención!", "Complete los campos", "error")
}
}

});
return false;

}

}); 




$('#btnmodificar').click(function(){
var url = $("#accion").val();
var controlador = $("#controlador").val();
var datos=$('#formulario').serialize();

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

}else if(r==9){

swal("Atención!", "Las Contraseñas no coinciden", "error")

}else if(r==10){

swal("Atención!", "Usuario no disponible", "error")

}else {
swal("Atención!", "Complete los campos", "error")
}
}

});
return false;
}); 





$(".eliminarCondicionMedica").click(function(e){
console.log('pasa');
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
            window.location.reload();
            
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




}); // DOCUMENT READY FUNCTION