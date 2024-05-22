
<!--<nav class="navbar navbar-expand-sm bg-dark navbar-dark">-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-success">
    <!--<a class="navbar-brand" href="#">
      
      <div class="avatar" style="background-image: url(resources/logo1.jpg)"></div>
    </a>-->
    <!--<div class="row">
    <div class="form-group col-md-4">
    <a class="navbar-brand" href="index.php?c=home"><h3>Ansamar</h3></a>
    </div>
    </div>
    <a class="navbar-brand" href="index.php?c=home"><h6>J-50162165-9</h6></a>-->
    
  <div class="container-fluid">
  
    <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>-->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">



      <ul class="navbar-nav">
        
        
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
          <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" role="button" data-bs-toggle="dropdown">Citas</a>
          <ul class="dropdown-menu">

            <li><a class="dropdown-item text-dark" href="index.php?c=paciente">Pacientes</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=condicionMedica">Condición médica</a></li>
            <li><a class="dropdown-item text-dark" href="index.php?c=cita">Gestionar Citas</a></li>
          </ul>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" role="button" data-bs-toggle="dropdown">Insumos</a>
          <ul class="dropdown-menu">
            <!--<li><a class="dropdown-item text-dark" href="index.php?c=proveedor">Proveedor</a></li>-->
            <li><a class="dropdown-item text-dark" href="index.php?c=insumo">Insumos</a></li>
            <!--<li><a class="dropdown-item text-dark" href="#">Compra</a></li>-->
            <li><a class="dropdown-item text-dark" href="#">Asignacion</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" style="color: #fff;" role="button" data-bs-toggle="dropdown">Historia</a>
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
          <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" role="button" data-bs-toggle="dropdown">Reportes</a>
          <ul class="dropdown-menu">
            <!--<li><a class="dropdown-item text-dark" href="index.php?c=reportesSencillos">Sencillos</a></li>
            <li><hr class="dropdown-divider"></li>-->
            <li><a class="dropdown-item text-dark" href="index.php?c=reportesEstadisticos">Estadisticos</a></li>
          </ul>
        </li>

      <?php } ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" role="button" data-bs-toggle="dropdown">Ayuda</a>
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
          <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" role="button" data-bs-toggle="dropdown">Seguridad</a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item text-dark" href="index.php?c=usuario">Usuarios</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=rol">Roles</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=modulo">Modulos</a></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=permiso">Permisos</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=bitacora&fechaa=<?=$tiempoAnterior; ?>&fechac=<?=$tiempoActual; ?>">Bitacora</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-dark" href="index.php?c=backup&a=backup">Backup</a></li>
          <li><a class="dropdown-item text-dark" href="#">Restore</a></li>
          </ul>
        </li>

        <?php } ?>

        <li class="nav-item dropdown text-dark">
        <a class="nav-link">
          <p style="color: #fff;">
            <b style="color: #fff;">Consultorio:</b> (<?php print_r($_SESSION[NAME.'_consultorio']->descripcion)  ?>) 
          </p>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="index.php?c=login&a=cerrarSession">
          <i class="align-middle" data-feather="power"></i>
        </a>
      </li>
         

      </ul>
    </div>
  </div>
</nav>