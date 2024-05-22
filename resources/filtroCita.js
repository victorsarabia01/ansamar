
    
    $(document).ready(function(){
        var odontologo = $('#cargarOdontologos');
        var mostrarDias = $('#resultadoBusquedaDias');
        //console.log(mostrarDias);
        $('#turno').change(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();     
          mostrarDias.html('');  
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologos', 

              }).done(function(data){   
                odontologo.html(data);
                //mostrarDias.html(data);         
              });      
            
        });

        $('#turno').click(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val(); 
          mostrarDias.html('');     
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologos', 

              }).done(function(data){   
                odontologo.html(data);         
              });      
            
        });
        
        $('#consultorio').change(function(){
          $("#cargarOdontologos option").remove();
          $("#resultadoBusquedaDias option").remove();
          mostrarDias.html('<h3> Completa la busqueda </h3>');    
            
        });

         
        $('#cargarOdontologos').change(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();    
          if(empleado == "" || empleado== null)  {
            empleado=="0"
          } 
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologosDias', 

              }).done(function(data){   
                mostrarDias.html(data);         
              });      
            
        });

        $('#cargarOdontologos').click(function(){
          var consultorio = $("#consultorio").val(); 
          var turno = $("#turno").val();  
          var empleado = $("#cargarOdontologos").val();
          if(empleado == "" || empleado== null)  {
            empleado=="0"
          }  
          //var turno = $(this).val();
            $.ajax({
              data: {consultorio:consultorio,turno:turno,empleado:empleado}, 
              dataType: 'html', 
              type: 'POST', 
              url: 'index.php?c=cita&a=consultarOdontologosDias', 

              }).done(function(data){   
                mostrarDias.html(data);         
              });      
            
        });
        
        

    });

