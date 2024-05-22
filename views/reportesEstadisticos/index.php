
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/helpers.min.js"></script>-->

<p></p>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- ChartJS -->
<script src="resources/Utils1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js" integrity="sha512-oHBLR38hkpOtf4dW75gdfO7VhEKg2fsitvHZYHZjObc4BPKou2PGenyxA5ZJ8CCqWytBx5wpiSqwVEBy84b7tw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style type="text/css">
  .centrar{
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<!--<div class="row">-->
  <div id="centrar" class="centrar">
  <div class="col-sm-6">
    <div class="card">
      <h2 class="card-header">Citas</h2>
      <div class="card-body">
        <h5 class="card-title">Generar Reporte Estadístico</h5>
        <p class="card-text">Gráfico de reporte de citas</p>
        <label><b>Género:</b></label>
        <form id="formulario" method="post">
          <select name="criterio1" id="criterio1" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>

            <option value="1">Todos</option>
            <option value="2">Masculinos</option>
            <option value="3">Femeninos</option>
          </select>

          <label><b>Rango de Edad:</b></label>

          <select name="criterio2" id="criterio2" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>

            <option value="1">Todos</option>
            <option value="2">Menores de 15 años</option>
            <option value="3">Entre 5 y 25 años</option>
            <option value="4">Entre 5 y 45 años</option>
            <option value="5">Mas de 45 años</option>
          </select>
          
          <label><b>Ingrese el Año:</b></label>
          <!--<input type="month" name="fechax" id="fechax" class="form-select form-select-lg mb-1" >-->

          <input type="text" class="form-control" name="fecha" onkeyup= keepNumOrDecimal(this) id="fecha" value="" aria-describedby="emailHelp" placeholder="2024" maxlength="4" required>
          <br>
          <a href="#" class="btn btn-primary" type="submit" onclick="generarReporteCitas()">Generar</a>
          <a href="#" class="btn btn-danger" type="submit" onclick="cerrar()">Cerrar</a>
        </div>
      </div>
    </div>

  </form>
</div>
  <!--<div class="col-sm-6">
    <div class="card">
      <h2 class="card-header">Insumos</h2>
      <div class="card-body">
        <h5 class="card-title">Generar Reporte Estadístico</h5>
        <p class="card-text">Gráfico de reporte de insumos</p>
        <label><b>Selecciona:</b></label>
        <select name="consultorio" id="consultorio" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>

          <option value="0">En Stock Mínimo</option>
          <option value="0">Mas usados</option>
          <option value="0">Menos Usados</option>
          <option value="0">Por vencer</option>
        </select>
        <a href="#" class="btn btn-primary" onclick="generarReporteInsumos()">Generar</a>
      </div>
    </div>

  </div>
</div>-->


<!-- -->
<div>
  <canvas id="myChart"></canvas>
</div>
<br>
<br>
<br>
<div>
  <canvas id="myChart1"></canvas>
</div>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>



<script src="resources/reportesCita.js"></script>




<script>
  const ctx1 = document.getElementById('myChart1s');
  //const labels = Utils.months({count: 7});
  new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
      datasets: [{
      label: 'Dataset 1',
      data: [11, 16, 7, 3, 14],
      backgroundColor: Object.values(Utils.CHART_COLORS),
      }]
    },
    options: {
      responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Doughnut Chart'
      }
    }
  });

</script>

<!--<script>
  const ctx = document.getElementById('myChart1');

  new Chart(ctx, {
    type: 'polarArea',
    data : {
  labels: [
    'Red',
    'Green',
    'Yellow',
    'Grey',
    'Blue'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [11, 16, 7, 3, 14],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
},
    options: {}
  });
  
</script>-->















                      <script type="text/javascript">
                        $(document).ready(function(){

                          $('#fecha').click(function(){
                            console.log('hizo click');
                            var fecha = $("#fecha").val()
                            console.log(fecha);
                          });      

                        });
                      </script>


                      
