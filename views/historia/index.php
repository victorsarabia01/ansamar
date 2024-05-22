<style type="text/css">
  #permanente{
    display:none;
   
  }
  #decidua{
    display:none;
  }
  #mixta{
    display:none;
  }
</style>

<div class="container-fluid py-3">

 
    <div class="row justif">
      <div class="col-md-8">
        <?php if($this->accesoRegistrar){ ?>
          <a  class="btn btn-success btn-lg active" id="openModal" href="#" data-bs-toggle="modal" data-bs-target="#nuevoModal">
            Registrar
          </a>
         
        <?php } ?>
      </div>


    </div>
    
    <table class="table table-sm table-striped table-hover mt-4">
      <thead class="table-secondary"  >
        <tr>
          <th>#</th>
          <th>Cedula</th>
          <th>Nombre y Apellido</th>
          <!-- <th>Fecha de Consulta</th> -->
          <th>Condición medica</th>
          <!-- <th>toma algun medicamento</th> -->
          <th>Presupuesto</th>
          <th>Precio de Atención</th>
          <th>Abonado</th>
          <th>Pendiente</th>
          <?php if($this->accesoRegistrar || $this->accesoModificar){ ?>
          <th>accion</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
          $num=1;
          $historias = $this->mode->Consultar("listarhistoria"); 
        ?>
        <?php foreach ($historias['paciente'] as $k){ ?>
          <?php 
            $semana = ((60*60)*24)*7;
            $fechaMaxi = date('Y-m-d', time()-($semana*5));
            $condiciones = $this->mode->Consultar("listarCondicionMedicaPaciente", $k->cedula);
            $tratamientos = $this->mode->Consultar("listarHistoriaServicios", $k->cedula);
            $pagosRealizado = $this->pago->Consultar("listarPagosPaciente",$k->cedula);
            $abonos = 0;
            foreach ($pagosRealizado as $pagosr) {
              $abonos += $pagosr->equivalente;
            }
            $presupuestos = 0;
            $id_cita = 0;
            foreach ($historias['presupuesto'] as $presup) {
              if($k->id_paciente==$presup->id_paciente){
                $id_cita = $presup->id;
                $presupuestos += $presup->presupuesto;
              }
            }
            $enfermedades = $this->mode->Consultar("listarEnfermedadesCita", $id_cita);

          ?>
          <tr class="table">
            <td><?=$num; ?></td>
            <td><?=$k->cedula; ?></td>
            <td><?=$k->nombres." ".$k->apellidos; ?></td>
            <td>
              <?php 
                foreach ($condiciones as $cond) {
                  echo " - ".$cond->descripcion."<br>";
                }
              ?>
            </td>
            <td>
              <?php 
                echo "<b>$".number_format($presupuestos, 2, ',','.')."</b>";
              ?>
            </td>
            <td>
              <?php
                $precio = 0;
                foreach ($tratamientos as $cotizacion) {
                  $precio += $cotizacion->precio;
                }
                echo "<b>$".number_format($precio, 2, ',','.')."</b>";
              ?>
            </td>
            <td>
              <?php
                echo "<b>$".number_format($abonos, 2, ',','.')."</b>";
              ?>
            </td>
            <td>
              <?php 
                echo "<b>$".number_format($precio-$abonos, 2, ',','.')."</b>";
              ?>
            </td>
            <td>
              <?php if($this->accesoRegistrar){ ?>
                <a href="?c=historia&paciente=<?=$k->cedula; ?>&fecha=<?=$fechaMaxi; ?>" id="openTratarModal" class="btn btn-info">Tratar</a>
                <!-- <a href="?c=historia&cita=<?=$id_cita; ?>&paciente=<?=$k->cedula; ?>" id="openTratarModal" class="btn btn-info">Tratar</a> -->
              <?php } ?>
              <?php if($this->accesoModificar){ ?>
              <!-- <a href="#" data-bs-toggle="modal" <?php echo $id_cita; ?> data-bs-target="#editarModal"class="btn btn-success">Editar</a> -->
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
        <a href="#" data-bs-toggle="modal" id="openTratarModal" data-bs-target="#tratarModal"class="btn btn-success" style="display:none">Tratar</a>
      </tbody>
    </table>
</div>
<?php 
  function obtenerFechaEnLetra($fecha){
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $dia = $dias[date('w', strtotime($fecha))];
    $num = date("j", strtotime($fecha));
    $anno = date("Y", strtotime($fecha));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    return $dia.', '.$num.' de '.$mes.' del '.$anno;
  }
?>
<?php include 'agregarmodal.php'; ?>
<?php include 'tratarmodal.php'; ?>
<?php //include 'segundoAgregarmodal.php'; ?>
<?php //include 'nuevomodal.php'; ?>
<?php //include 'editarmodal.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
  var cita = "";
  var paciente = "";
  paciente = '<?=$_GET['paciente']; ?>';
  if(paciente!=""){
    document.getElementById("openTratarModal").click();
  // if(cita!="" && paciente!=""){
  }
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  var ci = "";
  ci = '<?=$_GET['ci']; ?>';
  if(ci!=""){
    document.getElementById("openModal").click();
  }
});
</script>

