
<link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>

<script type="text/javascript" src="resources/push.min.js"></script>

<input type="hidden" id="controlador" value="home">

<style>
body  {
  background-color: transparent;

}
</style> 

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <?php foreach ($this->mode->Consultar("contarCitas")  as $k) : ?>
        <h2>Citas: <?php echo $k->contador?></h2>
      <?php endforeach ?>
      
      

      <p>Citas programadas para hoy</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="index.php?c=home" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <?php foreach ($this->mode->Consultar("contarPacientes")  as $k) : ?>
        <h2>Pacientes: <?php echo $k->contador?></h2>
      <?php endforeach ?>

      <p>Pacientes activos</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="index.php?c=paciente" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <?php foreach ($this->mode->Consultar("contarOdontologos")  as $k) : ?>
        <h2>Médicos: <?php echo $k->contador?></h2>
      <?php endforeach ?>

      <p>Odontólogos activos</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="index.php?c=empleado" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <?php foreach ($this->mode->Consultar("contarConsultorios")  as $k) : ?>
        <h2>Consultorios: <?php echo $k->contador?></h2>
      <?php endforeach ?>

      <p>Consultorios activos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-cart"></i>
    
    </div>
    
    <a href="index.php?c=consultorio" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>






<h3 style="color: #000000"><FONT SIZE=5><b>Consultorio:</b> (<?php print_r($_SESSION[NAME.'_consultorio']->descripcion)?>)</FONT></h3>
<!-- COMIENZO DE LA TABLA -->
<table id="example" class="table table-secondary">
<?php
        date_default_timezone_set("America/Caracas");
        $fecha_actual = date("d-m-Y");
?>
            <div class="row">
              <div class="col-md-12 text-center">
                <h3>Citas programadas para hoy <?php echo $fecha_actual ?></h3>
              </div>
            </div>
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Consultorio</th>
                <th>Turno</th>
                <th>Cedula</th>
                <th>Paciente</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Odontologo</th>
            </tr>
        </thead>
    
  </div>
</table>


<br><br><br>

<script type="text/javascript">
  Push.create('Atención!', {
    body: 'Nueva Cita Registrada',
    icon: 'icon.png',
    timeout: 8000,               // Timeout before notification closes automatically.
    vibrate: [100, 100, 100],    // An array of vibration pulses for mobile devices.
    onClick: function() {
        // Callback for when the notification is clicked. 
        console.log(this);
    }  
});
</script>




<!-- <script type="text/javascript">
  $(document).ready(function() {
    //var table = $('#example').DataTable();
    
    var controlador = $("#controlador").val();
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
        "url": 'index.php?c=${controlador}&a=json',
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
      table.ajax.reload( null, false );
    }, 3000 );

});
</script> -->

	


