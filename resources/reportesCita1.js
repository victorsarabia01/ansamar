              



                          function generarReporteCitas(){
                            var datos=$('#formulario').serialize();
                            $.ajax({
                              url:'index.php?c=reportesEstadisticos&a=dataGrafico',
                              type:'POST',
                              data:datos

                            }).done(function(resp){
                              var mes = [];
                              var cantidadCitas = [];
                              var data = JSON.parse(resp);
                              for(var i=0; i< data.length;i++){
                                mes.push(data[i][0]);
                                cantidadCitas.push(data[i][1]);
                              }
                              const ctx = document.getElementById('myChart');
                              new Chart(ctx, {
                                type: 'bar',
                                data: {
                                  labels: mes,
                                  datasets: [{
                                    label: '#Citas por MES',
                                    data: cantidadCitas,
                                    borderWidth: 1
                                  }]
                                },
                                options: {
                                  scales: {
                                    y: {
                                      beginAtZero: true
                                    }
                                  }
                                }
                              });
        
                            })
                          }
                      

                      function cerrar(){
                              
                              setTimeout( function() { window.location.href = 'index.php?c=reportesEstadisticos'; }, 500 );
                          }