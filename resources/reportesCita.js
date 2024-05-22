

function cerrar(){

  setTimeout( function() { window.location.href = 'index.php?c=reportesEstadisticos'; }, 500 );
}



function generarReporteCitas(){
  var fecha = document.getElementById("fecha").value;
  if (fecha == ''){
    console.log('vacio');
    swal("Atención!", "Campo fecha vacio", "warning")
  } else {

  }
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
    const ctx1 = document.getElementById('myChart1');
    //const Utils = ChartUtils.init();
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: mes,
        datasets: [{
          label: '#Citas por MES',
          data: cantidadCitas,
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)',
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)'
          ],
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
    }); // fin del reporte tipo barra

    const labels = ['Red', 'Orange', 'Yellow', 'Green', 'Blue'];
    new Chart(ctx1, {
      type: 'polarArea',
      data : {
        labels: mes,
        datasets: [{
          label: '#Citas por MES',
          data: cantidadCitas,
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)'
          ]
        }]
      },
      options: {}
      });// fin del reporte tipo polar


    
  }) //despues del ajax
  } // fin de la funcion











  function generarReporteCitasx(){

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
    //const Utils = ChartUtils.init();
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: mes,
        datasets: [{
          label: '#Citas por MES',
          data: cantidadCitas,
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)',
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)'
          ],
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





function generarReporteCitas1(){
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
