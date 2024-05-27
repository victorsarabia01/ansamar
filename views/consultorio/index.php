
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>-->


  <!-- BOTON QUE ACTIVA MODAL -->
  <p></p>
  <div class="">
    <?php if($this->accesoRegistrar){ ?>
      <button type="button" class="btn btn-success btn-lg active" id="abrirModal" title="Registrar">
        Registrar
      </button>

    <?php } ?>
  </div>
  <p></p>
  <!-- FIN QUE ACTIVA MODAL -->


  <!-- MODAL PARA REGISTRAR -->
  <div class="modal fade" style="overflow-y: scroll;" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="card text-dark bg-light mb-3" style="max-width: 40rem;">
              <div class="card-body">

                <div class="alert alert-success" role="alert">
                  <h3>Consultorio</h3>

                </div>

                <form class="form-horizontal" method="post" id="formulario" name="formulario" action="">
                  <input type="hidden" id="id" name="id">
                  <input type="hidden" name="urlActual" id="urlActual" value="index.php?c=consultorio&a=guardar">
                  <input type="hidden" id="accion" value="index.php?c=consultorio&a=modificar">
                  <input type="hidden" id="controlador" value="consultorio">


                  <fieldset>
                    <legend></legend>
                    <div>
                    </label><b>Nombre:</b></label>
                    <input type="text area" id="descripcion" name="descripcion" onkeypress="return permite(event, 'num_car')" onKeyUp=buscarReg(); class="form-control mayusculas buscar" value="" aria-describedby="emailHelp" placeholder="Ejemplo. Dental la 48" maxlength="50" required>
                    <input type="hidden" name="inputVerificarReg" id="inputVerificarReg" value="descripcion">
                    <div id="verificarRegistro"></div>
                  </div>
                </label><b>Dirección:</b></label>
                <textarea id="direccion" name="direccion" class="form-control" id="exampleFormControlTextarea1" value="" rows="4" placeholder="Ejemplo. Carrera 13A entre 3 y 5 San Francisco" maxlength="100" required></textarea>
              </label><b>Cantidad de sillón dental:</b></label>

              <select class="form-select form-select-lg mb-1" name="sillas" id="sillas" class="form-select form-select-lg mb-1" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>

              <label for="nombre"><b>Número teléfono:</b></label>
              <div class="row">
                <div class="form-group col-md-3">
                  <select class="form-select" name="codtlfn" id="codtlfn" class="form-select form-select-lg mb-1" required>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                  </select>
              </div>
              <div class="form-group col-md-6">
              
              <input type="text" class="form-control" name="telefono" onkeyup= keepNumOrDecimal(this);validarTlfno() id="telefono" value="" aria-describedby="emailHelp" placeholder="5208619" maxlength="7" required>
              <div id="verificarTlfno"></div>  
            </div>
            </div>

            </fieldset>


            <div class="col-md-40">


            </div>



          </div>
        </div>
      </div>
    </div>


    <div class="modal-footer">
      <button type="submit" name="btnguardar" id="btnguardar" class="btn btn-outline-success">Registrar</button>
      <button type="button" id="cancelar" name="cancelar" class="btn btn-sebtn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- FIN DEL MODAL -->





<!-- <div class="papa" id="main">
   <div class="dolartoday">
   <span v-bind="dolartodaylists ">{{ dolartodaylists.USD.transferencia }}</span>
   </div>
 </div>-->




 <div id="apartado1" align='center'>
  <h3>Consultorios</h3>
</div>

<table id="example" class="table table-hover">



  <div class="col-md-12 text-center">
    <thead class="thead-dark">
      <tr class="table-dark">
        <th>Id</th>
        <th>Consultorio</th>
        <th>Dirección</th>
        <th></th>
        <th>Teléfono</th>
        <th>Sillas</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
  </div>
</table>



<br><br>


<script type="text/javascript">
  $.getJSON("https://s3.amazonaws.com/dolartoday/data.json",function(data){
    console.log(data)
    $('#texto').html('Transferencia: '+data.USD.transferencia+ '<br> Sicad: ' + data.USD.sicad2);
    $('#al').html('DolarToday al: '+data._timestamp.fecha);
  });   
</script>
<script>
        var urlMonitor = 'https://s3.amazonaws.com/dolartoday/data.json';
        var urlLocalbitcoins ='https://api.bitcoinvenezuela.com';
        new Vue({
            el: '#main',
            created: function(){
                this.getDolartoday();
            },

            data() {
                return {
                    dolartodaylists:[],
                    bitcoinslists:[]
                }
            },
            methods: {
                getDolartoday: function() {
                    axios.get(urlMonitor).then(response => {
                        console.log(response.data);
                        this.dolartodaylists = response.data;
                    });
                },
                
            }
        });

    
    </script>