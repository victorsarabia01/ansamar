
<!-- BOTON QUE ACTIVA MODAL -->.
<div class="col-md-8">
  <?php if($this->accesoRegistrar){ ?>
      <button type="button" class="btn btn-success btn-lg active" id="abrirModal" title="Registrar">
      Registrar
    </button>
  <?php } ?>
</div>
<p></p>
<!-- FIN QUE ACTIVA MODAL -->


<!-- MODAL -->
<div class="modal fade" id="trackerModal" tabindex="-1" aria-labelledby="nuevoProyecto" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">
      <style>.d-none{ display:none; } </style>

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h3>Registrar pago</h3>
          <small>Fecha del dia: <?php echo $this->obtenerFechaEnLetra(date("Y-m-d")); ?></small>
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
            <input type="hidden" id="id" name="id">
            <input type="hidden" name="urlActual" id="urlActual" value="index.php?c=pagos&a=guardar">
            <input type="hidden" id="accion" value="index.php?c=pagos&a=modificar">
            <input type="hidden" id="controlador" value="pagos">
            <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="cedula">
            <!-- COLUMNA -->
            
            <?php
              $historiaPacientes = $this->historia->Consultar("listarhistoria")['paciente'];
              $historiaPacientesP = $this->historia->Consultar("listarhistoria")['presupuesto'];
            ?>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="cita"><b>Paciente <small>(Evolución)</small>:</b></label>
                <select name="cita" id="cita" class="form-select form-select-md mb-1 cita" aria-label="Ejemplo de .form-select-lg" required>
                  <option class="option0" value="0"></option>
                  <?php foreach ($historiaPacientes as $k){ ?>
                    <?php
                      $k->id = 0;
                      foreach ($historiaPacientesP as $key) {
                        if($k->id_paciente==$key->id_paciente){
                          if($k->id==0){
                            $k->id=$key->id;
                          }
                        }
                      }
                      $precio = 0;
                      foreach ($this->historia->Consultar("listarHistoriaServicios", $k->cedula) as $cotizacion) {
                        $precio += $cotizacion->precio;
                      }
                      $abonos = 0;
                      foreach ($this->mode->Consultar("listarPagosPaciente",$k->cedula) as $pagosr) {
                        $abonos += $pagosr->equivalente;
                      }
                      $pendiente = $precio-$abonos; 
                      // echo "<b>$".number_format($precio, 2, ',','.')."</b>";
                    ?>
                    <option class="option<?php echo $k->id; ?>" value="<?php echo $k->id; ?>"> <?php echo number_format($k->cedula,0,',','.')." ".$k->nombres." ".$k->apellidos." ($".number_format($pendiente,2,',','.').")"; ?></option>
                  <?php } ?>
                </select>
                <input type="number" class="d-none" id="maximoLimite" value="0">
              </div>

              <div class="form-group col-md-6">
                <label for="tipo"><b>Tipo de pago:</b></label>
                <select class="form-select form-select-md mb-1 tipo" name="tipo" id="tipo" required>
                  <option value=""></option>
                  <option value="1">Transferencia o Pago movil</option>
                  <option value="2">Divisas (Dolares)</option>
                  <!-- <option value="3">Divisas (Euros)</option> -->
                  <option value="4">Efectivo (Bolivares)</option>
                </select>
              </div>
            </div>
            <div class="row">
              <span class="btn btn-secondary cargarInputsPago" style="width:100%;display:none;">Cargar formulario</span>
            </div>
            <br>

            <div class="row">
              <input type="hidden" class="fechaActual" value="<?=date('Y-m-d'); ?>">
              <div class="form-group col-md-12  d-none inputgeneral input1 input2 input3 input4">
                <label for="fecha"><b>Fecha de pago:</b></label>
                <input type="date" class="form-control fecha" name="fecha" max="<?=date('Y-m-d') ?>" id="fecha" value="" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
              </div>
              <div class="form-group col-md-6  d-none inputgeneral input1 input4">
                <label for="tasa"><b>Tasa del dolar:</b></label>
                <!-- <input type="hidden" class="precioOculto" value="<?=$precioActualDolar; ?>"> -->
                <input type="number" class="form-control tasa" name="tasa" id="tasa" value="<?=$this->precioActualDolar; ?>" readonly placeholder="Tasa Ej. 5,25" step="0.01">
              </div>

              <div class="form-group col-md-6  d-none inputgeneral input1 input2 input3">
                <label for="referencia"><b class='txtReferencia'></b></label>
                <input type="text" id="referencia" name="referencia" class="form-control referencia" style="text-transform:uppercase;" value="" placeholder="Referencia" maxlength="25">
              </div>

              <div class="form-group col-md-6  d-none inputgeneral input1 input4">
                <label for="monto"><b>Monto abonado:</b></label>
                <input type="number" class="form-control monto" name="monto" id="monto" placeholder="5,25" step="0.01" >
              </div>

              <div class="form-group col-md-6  d-none inputgeneral input1 input2 input3 input4">
                <label for="equivalente"><b>Equivalente abonado:</b></label>
                <div class="input-group">
                  <span class="form-control input-group-addon simbolo" style="width:10% !important;"></span>
                  <input type="number" class="form-control equivalente" style="width:90%;" name="equivalente" id="equivalente" placeholder="5,25" step="0.01" required>
                </div>
              </div>

              <div class="form-group col-md-12  d-none inputgeneral input1 input2 input3 input4">
                <label for="leyenda"><b>Leyenda <small>(Observación)</small>: <small>[opcional]</small></b></label>
                <textarea id="leyenda" name="leyenda" class="form-control leyenda" rows="3" placeholder="leyenda" maxlength="220" style="max-width:100%;min-height:100px;max-height:120px;"></textarea>
              </div>
              
            </div>
          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer d-none">
        <button type="submit" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
        <button type="button" id="cancelar" name="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
     </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->


  <div class="row">
    <div class="col-md-3"></div>
    <?php
      $fechaa = "";
      $fechac = "";
      if(!empty($_GET['fechaa']) && !empty($_GET['fechac'])){
        $fechaa = $_GET['fechaa'];
        $fechac = $_GET['fechac'];
      }
    ?>
    <div class="col-md-6" style="text-align:center;">
      <form action="" method="get">
        <input type="hidden" class="fechaah" value="<?=$fechaa; ?>">
        <input type="hidden" class="fechach" value="<?=$fechac; ?>">
        <input type="hidden" name="c" value="<?=$_GET['c']; ?>">
        <input type="date" id='fechaa' class="form-control" max="<?=$fechac; ?>" style="width:40%;margin-left:2%;display:inline-block;" name="fechaa" value="<?=$fechaa; ?>">
        <input type="date" id='fechac' class="form-control" min="<?=$fechaa; ?>" max="<?=date('Y-m-d'); ?>" style="width:40%;margin-left:2%;display:inline-block;" name="fechac" value="<?=$fechac; ?>">
        <button class="btn btn-primary" style="width:10%;margin-left:2%;display:inline-block;">Filtrar</button>
      </form>
    </div>
  </div>
<br><br>

  <div id="apartado1" align='center'>
        <h3>Pagos</h3>
      </div>

<table id="example" class="table table-hover">

       
  <div class="">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>id</th>
                <th>N°</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Tipo</th>
                <th>Referencia</th>
                <th>Tasa</th>
                <th>Monto</th>
                <th>Equivalente</th>
                <th>Leyenda</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </div>
 </table>



<br><br>






<script type="text/javascript">
$(document).ready(function(){
  $("#fechaa").change(function(){
    var fechaa = $(this).val();
    var fechac = $("#fechac").val();
    $("#fechac").attr("min", fechaa);
  });
  $("#fechac").change(function(){
    var fechac = $(this).val();
    var fechaa = $("#fechaa").val();
    $("#fechaa").attr("max", fechac);
  });
  $(".d-none").hide();
  $(".d-none").removeClass("d-none");
  $(".cita").change(function(){
    $(".inputgeneral").fadeOut(300);
    $(".modal-footer").fadeOut(300);
    var nn = $(".tipo").val();
    var cita = $(".cita").val();
    var textCita = "";
    if(cita!="0"){
      var textCita = $(".option"+cita).html();
      var inI = textCita.indexOf("($");
      var inF = textCita.indexOf(")");
      var priceString = textCita.substring(inI+2, inF);
      var priceS = priceString.replace(",", '.');
      var price = parseFloat(priceS);
      $("#maximoLimite").val(price);
    }else{
      $("#maximoLimite").val(0);
    }
    if(cita!="0" && nn!=""){
      $(".cargarInputsPago").click().delay(300);
    }
  });
  $(".tipo").change(function(){
    $(".inputgeneral").fadeOut(300);
    $(".modal-footer").fadeOut(300);
    var nn = $(".tipo").val();
    var cita = $(".cita").val();
    if(cita!="0" && nn!=""){
      $(".cargarInputsPago").click().delay(300);
    }
  });
  $(".cargarInputsPago").click(function(){
    var nn = $(".tipo").val();
    var cita = $(".cita").val();
    if(cita>0 && nn!=""){
      if(nn=="3"){
        $(".simbolo").html("€");
      }else{
        $(".simbolo").html("$");
      }
      if(nn==1 || nn==4){
        $(".fecha").val("");
        $(".fecha").removeAttr("readonly", false);
        $(".equivalente").attr("readonly", true);
        $(".txtReferencia").html("Referencia de pago:");
      }else{
        var fecha = $(".fechaActual").val();
        $(".fecha").val(fecha);
        $(".fecha").attr("readonly", true);
        $(".equivalente").removeAttr("readonly", false);
        $(".txtReferencia").html("Serial del billete:");
      }
      $(".input"+nn).fadeIn(300);
      $(".modal-footer").fadeIn(300);
    }
  });
  $(".tasa").keyup(function(){
    var tasa = $(this).val();
    var monto = $(".monto").val();
    if(tasa!="" && monto != ""){
      var eqv = parseFloat(monto/tasa);
      $(".equivalente").val(eqv);
    }else{
      $(".equivalente").val(0);
    }
  });
  $(".tasa").change(function(){
    var tasa = $(this).val();
    var monto = $(".monto").val();
    if(tasa!="" && monto != ""){
      var eqv = parseFloat(monto/tasa);
      $(".equivalente").val(eqv);
    }else{
      $(".equivalente").val(0);
    }
  });
  $(".monto").keyup(function(){
    var tasa = $(".tasa").val();
    var monto = $(this).val();
    var max = $("#maximoLimite").val();
    var maximoBs = max*tasa;
    if(tasa!="" && monto != ""){
      if(monto!=""){
        monto = parseFloat(monto);
      }else{
        monto = parseFloat(0);
      }
      if(monto>maximoBs){
        $(this).val(maximoBs);
        monto = $(this).val();
      }
      var eqv = parseFloat((monto/tasa).toFixed(3));
      $(".equivalente").val(eqv);
    }else{
      $(".equivalente").val(0);
    }
  });
  $(".monto").change(function(){
    var tasa = $(".tasa").val();
    var monto = $(this).val();
    var max = $("#maximoLimite").val();
    if(tasa!="" && monto != ""){
      if(monto!=""){
        monto = parseFloat(monto);
      }else{
        monto = parseFloat(0);
      }
      if(monto>maximoBs){
        $(this).val(maximoBs);
        monto = $(this).val();
      }
      var eqv = parseFloat((monto/tasa).toFixed(3));
      $(".equivalente").val(eqv);
    }else{
      $(".equivalente").val(0);
    }
  });
  $(".equivalente").change(function(){
    var eqv = $(this).val();
    var max = $("#maximoLimite").val();
    if(eqv>max){
      $(this).val(max);
    }
  });
  $(".equivalente").keyup(function(){
    var eqv = $(this).val();
    var max = $("#maximoLimite").val();
    if(eqv>max){
      $(this).val(max);
    }
  });
});
</script>