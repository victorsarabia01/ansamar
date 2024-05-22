<style type="text/css">
  #centrar{
    /*justify-content: center;*/
  }
  .restore{
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<br><br>
<br><br>
<div id="centrar" class="restore">
<div class="mb-3">
  <label for="formFileMultiple" class="form-label">Seleccionar Base de datos a Restaurar</label>
  <input class="form-control" type="file" id="formFileMultiple" multiple>
  <br>
  
  <a class="btn btn-primary btn-lg" href="index.php?c=restore&a=restore">Restaurar</a>

</div>
</div>

<br><br>

<script type="text/javascript">
  $('input[type=file]').change(function () {
    console.log(this.files[0].mozFullPath);
});
</script>