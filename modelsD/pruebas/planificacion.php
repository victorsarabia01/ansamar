<?php

include_once "controller.php";
	
class PlanificacionController extends controller {

		public $mode;
		public $alm;
		public $rol;
		public $accesos;
		public $nameControl = "Planificacion";
		public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;
	
	public function __construct(){
			require_once "models/rolModel.php";
		require_once "models/PlanificacionModel.php";
		$this->mode = new planificacion_model();
		$this->alm = new planificacion_model();

		$this->rol = new rol_model();
		$idRol=$_SESSION[NAME.'_cuenta']['id_rol'];
		$this->accesos = $this->rol->Consultar("cargarAccesos", $idRol);
		foreach ($this->accesos as $acc) {
			if($acc->nombre_modulo==$this->nameControl){
				if($acc->nombre_permiso=="Registrar"){ $this->accesoRegistrar = true; }
				if($acc->nombre_permiso=="Consultar"){ $this->accesoConsultar = true; }
				if($acc->nombre_permiso=="Modificar"){ $this->accesoModificar = true; }
				if($acc->nombre_permiso=="Eliminar"){ $this->accesoEliminar = true; }
			}
		}
	}
	
	public function index(){
				
			return $this->vista("planificacion");
			
		}

			
	public function editar(){
			
			$this->alm = $this->mode->consultar("cargarPlanificacionAEditar", ($_REQUEST['id']));
			return $this->vista("planificacion/modificar");
		
	}
	
	
	// GUARDAR PLANIFICACION
	public function modificar(){
		$alm = new planificacion_model();
		
		
		$alm->id_consultorio = $_POST['consultorio'];
		$alm->turno = $_POST['turno'];
		$alm->id_doctor = $_POST['doctor'];
		$alm->diaSemana = $_POST['diaSemana'];
		
			foreach ($this->mode->Consultar("consultarSillas", $_POST['consultorio']) as $k) : 
				$alm->sillas = $k->sillas;
			endforeach;
			foreach ($this->mode->Consultar("consultarCantPlanificacion", $_POST['consultorio'],$_POST['turno'],$alm->diaSemana) as $k) : 
				$alm->planificacion = $k->cantPlanificacion;
			endforeach;  

 				foreach ($this->mode->Consultar("cargarPlanificacion", $alm->id_consultorio,$alm->turno,$alm->id_doctor,$alm->diaSemana) as $k) : 
				$alm->consulta = $k->id;
			endforeach; 
			foreach ($this->mode->Consultar("cargarPlanificacion1", $_POST['turno'],$_POST['doctor'],$alm->diaSemana) as $k) : 
				$alm->consulta1 = $k->id;
			endforeach;
			

		if(!$alm->consulta==""){
			echo "<script>
              alert('Ya existe una planificacion con los datos Seleccionados');
               history.back();
  			</script>";

		}else if(!$alm->consulta1==""){
			echo "<script>
              alert('Odontologo ya posee el turno en otro consultorio');
               history.back();
  			</script>";

		}else if ($alm->sillas<$alm->planificacion+1){
			echo "<script>
              alert('No hay sillas disponibles');
               history.back();
  			</script>";

		}else {
			$this->mode->Registrar("registrarPlanificacion", $alm);
			echo "<script>
              alert('Planificacion registrada');
               setTimeout( function() { window.location.href = 'index.php?c=planificacion'; }, 5000 );
  			</script>";

		}
	}


	// GUARDAR PLANIFICACION
	public function guardar(){
		$alm = new planificacion_model();
		
		
		$alm->id_consultorio = $_POST['consultorio'];
		$alm->turno = $_POST['turno'];
		$alm->id_doctor = $_POST['doctor'];
		//$alm->diaSemana = $_POST['diaSemana'];
		//$alm->diaLunes = $_POST['btncheck1'];
		if(isset($_POST['btncheck1']) != ""){
			define("Lunes", 1);
			$alm->diaLunes = $_POST['btncheck1'] == 1 ? Lunes: false;
		}
		if(isset($_POST['btncheck2']) != ""){
			define("Martes", 2);
			$alm->diaMartes = $_POST['btncheck2'] == 1 ? Martes: false;
		}
		if(isset($_POST['btncheck3']) != ""){
			define("Miercoles", 3);
			$alm->diaMiercoles = $_POST['btncheck3'] == 1 ? Miercoles: false;
		}
		if(isset($_POST['btncheck4']) != ""){
			define("Jueves", 4);
			$alm->diaJueves = $_POST['btncheck4'] == 1 ? Jueves: false;
		}
		if(isset($_POST['btncheck5']) != ""){
			define("Viernes", 5);
		$alm->diaViernes = $_POST['btncheck5'] == 1 ? Viernes: false;
		}
		if(isset($_POST['btncheck6']) != ""){
			define("Sabado", 6);
			$alm->diaSabado = $_POST['btncheck6'] == 1 ? Sabado: false;
		}
		
		

		if ($alm->id_consultorio==0 || $alm->turno==0 || $alm->id_doctor==0 ){
			echo "0";
				/*echo   "<script>  
						//swal('Heres a message!');
                          //alert('Debe seleccionar todas las opciones');
                          //history.back();

                          </script>";*/

		}else{

			//echo "1";
			if(!$alm->diaLunes==false){
			$alm->id_consultorio = $_POST['consultorio'];
			$alm->turno = $_POST['turno'];
			$alm->id_doctor = $_POST['doctor'];
 			$alm->diaSemana ='1';

 				/*echo "<script>
              alert('Lunes');
               
  			</script>";*/
  			foreach ($this->mode->Consultar("consultarSillas", $_POST['consultorio']) as $k) : 
				$alm->sillas = $k->sillas;
			endforeach;
			foreach ($this->mode->Consultar("consultarCantPlanificacion", $_POST['consultorio'],$_POST['turno'],$alm->diaSemana) as $k) : 
				$alm->planificacion = $k->cantPlanificacion;
			endforeach;  

 				foreach ($this->mode->Consultar("cargarPlanificacionLunes", $_POST['consultorio'],$_POST['turno'],$_POST['doctor'],$alm->diaSemana) as $k) : 
				$alm->consultaL1 = $k->consultaL1;
			endforeach; 
			foreach ($this->mode->Consultar("cargarPlanificacionLunes1", $_POST['turno'],$_POST['doctor'],$alm->diaSemana) as $k) : 
				$alm->consultaL2 = $k->consultaL2;
			endforeach; 


			if(!$alm->consultaL1==""){
			echo ('1');
			/*echo "<script>
              alert('Ya tiene asignado turno los Lunes en el consultorio Seleccionado');
  			</script>";*/
			
			}else if(!$alm->consultaL2==""){
			echo ('2');
			/*echo "<script>
              alert('Odontologo ocupado los Lunes en otro Consultorio');
  			</script>";*/
			
			}else if($alm->sillas<$alm->planificacion+1){
			echo ('3');
			/*echo "<script>
              alert('No hay sillas disponibles');
  			</script>";*/
			}
			else{
			echo ('4');
			$this->mode->Registrar("registrarPlanificacion", $alm);
			
			}
			}//CIERRE DEL IF DIA LUNES
			if(!$alm->diaMartes==false){
 			$alm->id_consultorio = $_POST['consultorio'];
			$alm->turno = $_POST['turno'];
			$alm->id_doctor = $_POST['doctor'];
 			$alm->diaSemana='2';
 			/*echo "<script>
              alert('Martes');
               
  			</script>";*/

  			foreach ($this->mode->Consultar("consultarSillas", $_POST['consultorio']) as $k) : 
				$alm->sillas = $k->sillas;
			endforeach;
			foreach ($this->mode->Consultar("consultarCantPlanificacion", $_POST['consultorio'],$_POST['turno'],$alm->diaSemana) as $k) : 
				$alm->planificacion = $k->cantPlanificacion;
			endforeach; 

 				foreach ($this->mode->Consultar("cargarPlanificacionMartes", $_POST['consultorio'],$_POST['turno'],$_POST['doctor'],$alm->diaSemana) as $k) : 
				$alm->consultaM1 = $k->consultaM1;
			endforeach; 
			foreach ($this->mode->Consultar("cargarPlanificacionMartes1", $_POST['turno'],$_POST['doctor'],$alm->diaSemana) as $k) : 
				$alm->consultaM2 = $k->consultaM2;
			endforeach; 

			if(!$alm->consultaM1==""){
			echo ('5');
			/*echo "<script>
              alert('Ya tiene asignado turno los Martes en el consultorio Seleccionado');
  			</script>";*/

			}else if(!$alm->consultaM2==""){
			echo ('6');
			/*echo "<script>
              alert('Odontologo ocupado los Martes en otro Consultorio');
  			</script>";*/
			}else if($alm->sillas<$alm->planificacion+1){
			echo ('7');
			/*echo "<script>
              alert('No hay sillas disponibles');
  			</script>";*/
			}
			else{
			echo ('8');
			$this->mode->Registrar("registrarPlanificacion", $alm);
			
			}
			}//CIERRE DEL IF DIA MARTES
 				

 			}//CIERRE DEL ELSE SI NO SELECCIONA TODOS LOS CAMPOS
	}//CIERRE DE LA FUNCION


	//ELIMINAR REGISTRO DE PLANIFICACION

	public function eliminar(){
		$alm = new planificacion_model();
		
		$this->mode->Eliminar("deletePlanificacion", $_REQUEST['id']);

		echo "<script>
              alert('Planificacion eliminada');
               setTimeout( function() { window.location.href = 'index.php?c=planificacion'; }, 1000 );
  			</script>";

	}

	/*public function consultarRegistrosNuevos(){
		$alm = new planificacion_model();
		
	$this->mode->Consultar("listarPlanificacion");

	}*/

	public function buscarRegistro(){
		$alm = new planificacion_model();

		$consultaBusqueda = $_POST['valorBusqueda'];
		
		$alm->estado="";
		$mensaje ='';
		foreach ($this->mode->Consultar("buscarRegistroPlanificacion", $consultaBusqueda) as $resultados) : 
		$alm->id = $resultados->id;
		endforeach;

		if($alm->id != ""){
			$mensaje .='
		<div class="row">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3></h3>
      </div>
    </div>
    
    
      <div class="col-md-12 text-center">
        <table class="table table-hover">
          <tr class="table-secondary">
            <thead class="table-success">
            			<th>Odontólogo</th>
						<th>Consultorio</th>
						<th>Dia</th>
						<th>Turno</th>
						<th>EDITAR</th>
						<th>ELIMINAR</th>
					
            </thead>
	          </tr>                 

	  ';}
		
			foreach ($this->mode->Consultar("buscarRegistroPlanificacion", $consultaBusqueda) as $resultados) : 
						
			$alm->id = $resultados->id;
			$alm->nombreOdontologo = $resultados->nombres;
			$alm->apellidoOdontologo = $resultados->apellidos;
	        $alm->consultorio = $resultados->consultorio;
	        $alm->dia = $resultados->dia_semana;
	        $alm->turno = $resultados->turno;
		      
	        //Output
			if($alm->id != ""){
				$mensaje .= ' 
						
								<tr>
	              				<td>'.$alm->nombreOdontologo.' '.$alm->apellidoOdontologo.'</td>
								<td>'.$alm->consultorio.'</td>
								<td>'.$alm->dia.'</td>
								<td>'.$alm->turno.'</td>
								
						
							
								<td>
									
	             				<button href="#" type="button" class="btn btn-outline-primary">
	                				<i class="bi bi-pencil-square"></i>
	              				</button>
								
								</td>
								
								<td>
	                            
	                            <button href="#" id="<?php echo $k->id; ?>" type="button" class="btn btn-outline-danger eliminar">
	                               <i class="bi bi-trash"></i>
	                          </button>
								</td>
							</tr>
							';}
			 endforeach;

		$mensaje .= '</table>
			
					
				</div>
			</div>

				<script type="text/javascript">
		$(document).ready(function(){

			$(".eliminar").click(function(e){
	     	
	    e.preventDefault();
	    var id = $(this).attr("id");
	    swal({
	      title: "Atención!!!",
	      text: "¿Esta seguro de inhabilitar el registro?!",
	      type: "warning",
	      showCancelButton: true,
	      confirmButtonClass: "btn-danger",
	      confirmButtonText: "Confirmar",
	      cancelButtonText: "Cancelar",
	      closeOnConfirm: false,
	      closeOnCancel: false
	    },
	    function(isConfirm) {
	      if (isConfirm) {
	    //Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
	        window.location.href="index.php?c=consultorio&a=inhabilitar&id="+id;
	      } else {
	    //Si se cancela se emite un mensaje
	        swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
	      }
	    });
	    });



		});
	     

	    </script>
		';
		
			
			echo $mensaje;
					
	}

	public function tablaPlanificacion(){
		$alm = new planificacion_model();
		$mensaje ="";
		$mensaje .='
		<div class="row">
	    <div class="row">
	      <div class="col-md-12 text-center">
	        <h3></h3>
	      </div>
	    </div>
    
    
      <div class="col-md-12 text-center">
        <table class="table table-hover" id="mitabla">
		      <thead>
		          <tr class="table-secondary">
		            
		            			<th>Odontólogo</th>
								<th>Consultorio</th>
								<th>Dia</th>
								<th>Turno</th>
		            			<th>EDITAR</th>
		            			<th>ELIMINAR</th>
		          </tr>                 
		 			</thead>';
					foreach ($this->mode->Consultar("listarPlanificacion") as $k) : 
						$mensaje .= ' 
						<tbody>   
							<tr>
	              
										<td>'.$k->nombres.' '.$k->apellidos.'</td>
	              		<td>'.$k->consultorio.'</td>
	              		<td>'.$k->dia_semana.'</td>
	              		<td>'.$k->turno.'</td>

	              
	              
	              <td>
	                <a href="index.php?c=planificacion&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
	                        <i class="bi bi-pencil-square"></i>
	                        </a>
	              </td>
	              <td>
	                <button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
	                                <i class="bi bi-trash"></i>
	                </button>
	              </td>
	            </tr>
	           </tbody>';
	 				endforeach;

	 				$mensaje .= '
	 			</table>
      </div>
    </div>
 
		<script type="text/javascript">
		  $(document).ready(function(){
		    $(".eliminar").click(function(e){
		      console.log();
			    e.preventDefault();
			    var id = $(this).attr("id");
			    swal({
			      title: "Atención!!!",
			      text: "¿Esta seguro de eliminar el registro?!",
			      type: "warning",
			      showCancelButton: true,
			      confirmButtonClass: "btn-danger",
			      confirmButtonText: "Confirmar",
			      cancelButtonText: "Cancelar",
			      closeOnConfirm: false,
			      closeOnCancel: false
			    },
			    function(isConfirm) {
			      if (isConfirm) {
			    		//Si SE confirma la eliminacion se ejecuta el reenvio al php encargado
			        window.location.href="index.php?c=planificacion&a=eliminar&id="+id;
			      } else {
			    		//Si se cancela se emite un mensaje
			        swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
			      }
			    });
		    });
		  });
  	</script>';
    echo $mensaje;
	}	

					
		
	
	}
?>