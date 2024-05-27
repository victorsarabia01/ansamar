<?php
require_once "config/database.php"; //CONEXION A LA DATABASE
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ansamar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  

 
    <script src="resources/js/jquery.js"></script>

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <link rel="stylesheet" href="resources/bootstrap-5.1.3-dist/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootpag/1.0.4/jquery.bootpag.min.js"></script>
    <script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



    <script type="text/javascript" src="resources/push.min.js"></script>
    <script type="text/javascript" src="resources/msjAlert/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="resources/msjAlert/sweetalert.css">
    <script src="resources/validacionFront.js"></script>
    <script src="resources/condicionMedica.js"></script>

    <!-- ODONTOGRAMA -->
    <link rel="stylesheet" href="resources/css/cssDiente.css">
    <link rel="stylesheet" href="resources/css/cssDienteGeneral.css">
    <link rel="stylesheet" href="resources/css/cssFormulario.css">
    <link rel="stylesheet" href="resources/css/cssComponentes.css">
    <link rel="stylesheet" href="resources/css/cssComponentesPersonalizados.css">
    <link rel="stylesheet" href="resources/css/cssContenido.css">
    <script src="resources/js/jsAcciones.js"></script>
    <!-- ODONTOGRAMA -->


    <!-- DATATABLES -->

    <!--<link rel="stylesheet" href="resources/css/datatable1.css">--> 
    <link href="resources/DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="resources/DataTables/Buttons-2.4.2/css/buttons.bootstrap5.css" rel="stylesheet">
    <script src="resources/DataTables/JSZip-3.10.1/jszip.js"></script>
    <script src="resources/DataTables/pdfmake-0.2.7/pdfmake.js"></script>
    <script src="resources/DataTables/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="resources/DataTables/DataTables-1.13.8/js/jquery.dataTables.js"></script>
    <script src="resources/DataTables/DataTables-1.13.8/js/dataTables.bootstrap5.js"></script>
    <script src="resources/DataTables/Buttons-2.4.2/js/dataTables.buttons.js"></script>
    <script src="resources/DataTables/Buttons-2.4.2/js/buttons.bootstrap5.js"></script>
    <script src="resources/DataTables/Buttons-2.4.2/js/buttons.colVis.js"></script>
    <script src="resources/DataTables/Buttons-2.4.2/js/buttons.html5.js"></script>
    <script src="resources/DataTables/Buttons-2.4.2/js/buttons.print.js"></script>

    <!-- DATATABLES -->

    
    <script src="resources/js/app.js"></script>
    <link rel="stylesheet" href="css/titulos.css">

    <style type="text/css">
      #logo {
        display: flex;
        float: left;
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 130px;
    width: 150px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 5%;
    background-size: 100% auto;
}
    </style>

    <style>
    .div-1 {
        background-color: #094293;
    }
    a{

    }
    
    </style>

    <style>
      .header {
        display: flex;

      }

      .cerrar {
        display: flex;
        float: right;
      }

      

    </style>

    


  <title>Centro Médico Ansamar</title>
  
  
</head>

<body>



<div>
  <!--<img id="logo" src="img/ansamarLogox.jpg" width="50"
    height="50" />-->
  <div  class="div-1 flex flex-row h-full w-full justify-center items-center text-center py-4 px-2 divide-x-2 divide-dark">
    <h1 style="color: #FFFFFF">Ansamar Centro Médico </h1>
    <h6 style="color: #FFFFFF">J-50162165-9</h6>
    
  </div>
</div>


  


  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <a class="navbar-brand" href="index.php?c=home" style="color: #000000;"><FONT SIZE=5>Inicio</FONT></a>
  <!--<button class="navbar-brand" href="index.php?c=home" type="button" class="btn btn-primary">Primary</button>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">


      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Planificación</font></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-dark"  href="index.php?c=consultorio">Consultorios</a></li>
            <li><a class="dropdown-item text-dark"  href="index.php?c=empleado">Empleados</a></li>
            <li><a class="dropdown-item text-dark"  href="index.php?c=tipoempleado">Tipo de empleado</a></li>
            <li><a class="dropdown-item text-dark " href="index.php?c=planificacion">Gestionar Planificación</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Citas</FONT></a>
          <ul class="dropdown-menu">

            <li><a class="dropdown-item text-dark" href="index.php?c=paciente">Pacientes</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=condicionMedica">Condición médica</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=cita">Gestionar Citas</a></li>
          </ul>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Insumos</FONT></a>
          <ul class="dropdown-menu">
            <!--<li><a class="dropdown-item text-dark" href="index.php?c=proveedor">Proveedor</a></li>-->
            <li><a class="dropdown-item text-dark" href="index.php?c=insumo">Insumos</a></li>
            <!--<li><a class="dropdown-item text-dark" href="#">Compra</a></li>-->
            <li><a class="dropdown-item text-dark" href="#">Asignacion</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" style="color: #000000;" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Historia</FONT></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-dark" href="index.php?c=serviciodental">Servicios Dentales</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=historia">Odontograma</a></li>
            <?php $tiempoActual = date('Y-m-d'); $tiempoAnterior = date('Y-m-d', time()-(((60*60)*24)*7)); ?>
            <li><a class="dropdown-item text-dark" href="index.php?c=pagos&fechaa=<?=$tiempoAnterior; ?>&fechac=<?=$tiempoActual; ?>">Pagos</a></li>

          </ul>
        </li>

        <?php 
            $accesoModuloMenu = false;
            foreach ($this->accesos as $acc){ if($acc->nombre_modulo=="Reportes"){ if($acc->nombre_permiso=="Consultar"){ $accesoModuloMenu = true; } } }
            ?>
            <?php if($accesoModuloMenu){ ?>

        
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Reportes</FONT></a>
          <ul class="dropdown-menu">
            <!--<li><a class="dropdown-item text-dark" href="index.php?c=reportesSencillos">Sencillos</a></li>
            <li><hr class="dropdown-divider"></li>-->
            <li><a class="dropdown-item text-dark" href="index.php?c=reportesEstadisticos">Estadísticos de cita</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=reportesEstadisticos">Estadísticos de insumos</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=reportesEstadisticos">Estadísticos de pagos</a></li>
          </ul>
        </li>

      <?php } ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Ayuda</FONT></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-dark" href="index.php?c=preguntasFrecuentes">Preguntas Frecuentes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-dark" href="#">Manual de usuario</a></li>
          </ul>
        </li>
        
       


        <?php 
            $accesoModuloMenu = false;
            foreach ($this->accesos as $acc){ if($acc->nombre_modulo=="Seguridad"){ if($acc->nombre_permiso=="Consultar"){ $accesoModuloMenu = true; } } }
            ?>
            <?php if($accesoModuloMenu){ ?>



        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><FONT SIZE=5>Seguridad</FONT></a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item text-dark" href="index.php?c=usuario">Usuarios</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=rol">Roles</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=modulo">Modulos</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=permiso">Permisos</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=bitacora&fechaa=<?=$tiempoAnterior; ?>&fechac=<?=$tiempoActual; ?>">Bitacora</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=backup&a=backup">Backup</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=restore">Restore</a></li>
          </ul>
        </li>

        <?php } ?>


        <!--<li class="nav-item dropdown text-dark">
        <a class="nav-link">
          <p style="color: #000000;">
            <b style="color: #000000;">Consultorio:</b> (<?php print_r($_SESSION[NAME.'_consultorio']->descripcion)  ?>) 
          </p>
        </a>
      </li>-->




     
    </ul>





   
  </div>
   

  <div id="cerrar" class="cerrar">

          <li class="nav-item dropdown">
          <a class="dropdown-toggle" style="color: #000000;" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i><FONT SIZE=4><?php print_r($_SESSION[NAME.'_usuario']->nombre_empleado)?></FONT></a>
          <ul class="dropdown-menu">
         
          <a class="nav-link" id="btnperfil" name="btnperfil" href="#">
          <i class="bi bi-person-fill"></i> Perfil
          </a>

          <a class="nav-link" id="btncerrarSesion" name="btncerrarSesion" href="#">
          <i class="align-middle" data-feather="power"></i> Salir
          </a>
        
          </ul>
          </li>



      <!--<?php print_r($_SESSION[NAME.'_usuario']->nombre_empleado)?>
      <a class="nav-link" id="btncerrarSesion" name="btncerrarSesion" href="#">
      <i class="align-middle" data-feather="power"></i>
      </a>-->

  </div>
</nav>




    

<!-- AQUI ESTO HACE .... -->

<?php if(!empty($_GET['fechaa']) && !empty($_GET['fechac'])){ ?>
<input type="hidden" class="fechaa" value="<?=$_GET['fechaa']; ?>">
<input type="hidden" class="fechac" value="<?=$_GET['fechac']; ?>">
<?php } else { ?>
<input type="hidden" class="fechaa" value="">
<input type="hidden" class="fechac" value="">
<?php } ?>

<script type="text/javascript">
  $('#btncerrarSesion').click(function(){

    swal({
      title: "Atención!!!",
      text: "¿Esta seguro de cerrar sesion?!",
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

       setTimeout( function() { window.location.href = `index.php?c=login&a=cerrarSession`; }, 1000 );

     } else {

      swal("Cancelado", "Usted ha cancelado el cierre de sesion", "error");
    }
  });

  });
</script>


   