
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/helpers.min.js"></script>-->

<p></p>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row">
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

          
                              <label><b>Mes y Año:</b></label>
                              <input type="month" name="fecha" id="fecha" class="form-select form-select-lg mb-1" >
                              

                              <a href="#" class="btn btn-primary" type="submit" onclick="generarReporteCitas()">Generar</a>
                              <a href="#" class="btn btn-danger" type="submit" onclick="cerrar()">Cerrar</a>
                            </div>
                          </div>
                        </div>
                       
      </form>
















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



                      <div>
                        <canvas id="myChart"></canvas>
                      </div>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>

                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>
                      <br><br>


                      <script src="resources/reportesCita.js"></script>




















                      <script type="text/javascript">
                        $(document).ready(function(){

                          $('#fecha').click(function(){
                            console.log('hizo click');
                            var fecha = $("#fecha").val()
                            console.log(fecha);
                          });      

                        });
                      </script>


                      
