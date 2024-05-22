<?php
$varSQL = "";
if(!empty($_GET['fechaa']) && !empty($_GET['fechac'])){
  $varSQL="&fechaa=".$_GET['fechaa']."&fechac=".$_GET['fechac'];
}
?>




<!-- MODAL -->
<div class="modal" style="overflow-y: scroll;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="min-width: 75%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <a href="index.php?c=pagos<?=$varSQL; ?>" class="btn-close" aria-label="Close"></a>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h3>Modificar empleado</h3>
          <small>Fecha del dia: <?php echo $this->obtenerFechaEnLetra(date("Y-m-d")); ?></small>
        </div>
        <div class="container-fluid">
          <form class="form-horizontal" method="post" action="index.php?c=pagos&a=modificar<?=$varSQL; ?>">
            <!-- COLUMNA -->
            <div class="row">
              <?php
                $historiaPacientes = $this->historia->Consultar("listarhistoria")['paciente'];
                $historiaPacientesP = $this->historia->Consultar("listarhistoria")['presupuesto'];
              ?>
              <div class="form-group col-md-6">
                <input type="hidden" name="id" id="id" value="<?php echo $this->alm->id; ?>">
                <label for="cita"><b>Paciente <small>(Evolución)</small>:</b></label><br>
                  <?php foreach ($historiaPacientes as $k){
                    $k->id = 0;
                    foreach ($historiaPacientesP as $key) {
                      if($k->id_paciente==$key->id_paciente){
                        if($k->id==0){
                          $k->id=$key->id;
                        }
                      }
                    }
                    $precio = 0;
                    foreach ($this->historia->Consultar("listarHistoriaServicios", $k->cedula) as $cotizacion){ $precio += $cotizacion->precio; }
                    if($this->alm->id_cita==$k->id){ echo number_format($k->cedula,0,',','.')." ".$k->nombres." ".$k->apellidos." ($".number_format($precio,2,',','.').")"; }
                  } ?>
                <input type="hidden" name="cita" id="cita" class="cita" value="<?=$this->alm->id_cita; ?>">
                <div id="verificarRegistropagos"></div>
              </div>

              <div class="form-group col-md-6">
                <label for="tipo"><b>Tipo de pago:</b></label><br>
                 <?=$this->alm->tipo_pago; ?>
                <input type="hidden" name="tipo" id="tipo" class="tipo" value="<?=$this->alm->id_tipo; ?>">
              </div>
            </div>
            
            <hr>

            <div class="row">
              <?php if($this->alm->id_tipo==1 || $this->alm->id_tipo==2 || $this->alm->id_tipo==3 || $this->alm->id_tipo==4){ ?>
                <?php
                  $lectura = false;
                  $txtReferencia = "";
                  if($this->alm->id_tipo==2 || $this->alm->id_tipo==3){
                    $txtReferencia = "Serial del billete:";
                    $lectura = true;
                  }else{
                    $txtReferencia = "Referencia de pago:";
                  }
                ?>
              <div class="form-group col-md-12  inputgeneral input1 input2 input3 input4">
                <label for="fecha"><b>Fecha de pago:</b></label>
                <input type="date" class="form-control fecha" name="fecha" max="<?=date('Y-m-d') ?>" id="fecha" value="<?=$this->alm->fecha_pago; ?>" aria-describedby="emailHelp" placeholder="example@gmail.com" maxlength="50" required>
              </div>
              <?php } ?>
              <?php if($this->alm->id_tipo==1 || $this->alm->id_tipo==4){ ?>
              <div class="form-group col-md-6  inputgeneral input1 input4">
                <label for="tasa"><b>Tasa del dolar:</b></label>
                <input type="number" class="form-control tasa" name="tasa" id="tasa" readonly placeholder="Tasa Ej. 5,25" step="0.01" value="<?=$this->alm->tasa; ?>">
              </div>
              <?php } ?>

              <?php if($this->alm->id_tipo==1 || $this->alm->id_tipo==2 || $this->alm->id_tipo==3){ ?>
              <div class="form-group col-md-6  inputgeneral input1 input2 input3">
                <label for="referencia"><b><?=$txtReferencia; ?></b></label>
                <input type="text" id="referencia" name="referencia" class="form-control referencia" style="text-transform:uppercase;" value="<?=$this->alm->referencia; ?>" placeholder="Referencia" maxlength="25">
              </div>
              <?php } ?>

              <?php if($this->alm->id_tipo==1 || $this->alm->id_tipo==4){ ?>
              <div class="form-group col-md-6  inputgeneral input1 input4">
                <label for="monto"><b>Monto abonado:</b></label>
                <input type="number" class="form-control monto" name="monto" id="monto" placeholder="5,25" step="0.01" value="<?=$this->alm->monto; ?>">
              </div>
              <?php } ?>

              <?php if($this->alm->id_tipo==1 || $this->alm->id_tipo==2 || $this->alm->id_tipo==3 || $this->alm->id_tipo==4){ ?>
              <div class="form-group col-md-6  inputgeneral input1 input2 input3 input4">
                <label for="equivalente"><b>Equivalente abonado:</b></label>
                <div class="input-group">
                  <?php 
                    if($this->alm->id_tipo==3){ $this->alm->simbol="€"; } else { $this->alm->simbol="$"; } 
                    if($this->alm->id_tipo==1 || $this->alm->id_tipo==4){
                      $this->alm->readonly="readonly";
                    }else{
                      $this->alm->readonly="";
                    }
                  ?>
                  <span class="form-control input-group-addon simbolo" style="width:10% !important;"><?=$this->alm->simbol; ?></span>
                  <input type="number" class="form-control equivalente" style="width:90%;" name="equivalente" value="<?=$this->alm->equivalente; ?>" id="equivalente" placeholder="5,25" step="0.01" <?=$this->alm->readonly; ?> required>
                </div>
              </div>
              <?php } ?>

              <?php if($this->alm->id_tipo==1 || $this->alm->id_tipo==2 || $this->alm->id_tipo==3 || $this->alm->id_tipo==4){ ?>
              <div class="form-group col-md-12  inputgeneral input1 input2 input3 input4">
                <label for="leyenda"><b>Leyenda <small>(Observación)</small>: <small>[opcional]</small></b></label>
                <textarea id="leyenda" name="leyenda" class="form-control leyenda" rows="3" placeholder="leyenda" maxlength="220" style="max-width:100%;min-height:100px;max-height:120px;"><?=$this->alm->leyenda; ?></textarea>
              </div>
              <?php } ?>
              
            </div>
      
            
       

          
        </div>
      </div>
      <!--.modal-body-->
      <div class="modal-footer">
        <button type="submit" value="Guardar" name="registrar" id="registrar" class="btn btn-outline-success">Guardar</button>
        <a class="btn btn-outline-danger" href="index.php?c=pagos<?=$varSQL; ?>">Cancelar</a>
      </div>
     </form> 
    </div>
    <!--.modal-content-->
  </div>
  <!--.modal-dialog-->
</div>

<!-- FIN MODAL -->



<script>
  $(document).ready(function(){
    exampleModal.style.display = 'block';
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
      if(tasa!="" && monto != ""){
        if(monto!=""){
          monto = parseFloat(monto);
        }else{
          monto = parseFloat(0);
        }
        var eqv = parseFloat(monto/tasa);
        $(".equivalente").val(eqv);
      }else{
        $(".equivalente").val(0);
      }
    });
    $(".monto").change(function(){
      var tasa = $(".tasa").val();
      var monto = $(this).val();
      if(tasa!="" && monto != ""){
        if(monto!=""){
          monto = parseFloat(monto);
        }else{
          monto = parseFloat(0);
        }
        var eqv = parseFloat(monto/tasa);
        $(".equivalente").val(eqv);
      }else{
        $(".equivalente").val(0);
      }
    });
  });



</script>




<script>
$(document).ready(function() {
    $("#verificarRegistroEmpleado").html('');
});

function buscarEmpleado() {
    var textoBusqueda = $("input#cedula").val();
    
     if (textoBusqueda != "") {
        $.post("index.php?c=empleado&a=verificarRegistroEmpleado", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#verificarRegistroEmpleado").html(mensaje);
            //$("#idProducto").html(mensaje1);
            //html(mennsaje1);
         }); 
     } else { 
        $("#verificarRegistroEmpleado").html('');
        };
};
</script>

