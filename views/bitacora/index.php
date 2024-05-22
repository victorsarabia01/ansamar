
<!-- BOTON QUE ACTIVA MODAL -->.
<p></p>
<!-- FIN QUE ACTIVA MODAL -->

<input type="hidden" id="urlActual" name="urlActual" value="index.php?c=bitacora&a=guardar">
<input type="hidden" id="accion" name="accion" value="index.php?c=bitacora&a=modificar">
<input type="hidden" id="controlador" name="controlador" value="bitacora">

<div id="apartado1" align='center'>
<h3>Bitácora</h3>
</div>
<p></p>
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
        <input type="hidden" name="c" value="<?=$_GET['c']; ?>">
        <input type="date" id='fechaa' class="form-control" max="<?=$fechac; ?>" style="width:40%;margin-left:2%;display:inline-block;" name="fechaa" value="<?=$fechaa; ?>">
        <input type="date" id='fechac' class="form-control" min="<?=$fechaa; ?>" max="<?=date('Y-m-d'); ?>" style="width:40%;margin-left:2%;display:inline-block;" name="fechac" value="<?=$fechac; ?>">
        <button class="btn btn-primary" style="width:10%;margin-left:2%;display:inline-block;">Filtrar</button>
      </form>
    </div>
  </div>


<table id="example" class="table table-hover">

       
  <div class="col-md-12 text-center">
        <thead class="thead-dark">
            <tr class="table-dark">
                <th>Id</th>
                <th>Modulo</th>
                <th>Accion</th>
                <th>Fecha - Hora</th>
                <th>Usuario</th>
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
});
</script>