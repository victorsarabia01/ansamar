<?php

include_once "controller.php";
	
	// HERENCIA DE LA CLASE CONTROLER USO SUS METODOS O ATRIBUTOS
	class consultorioController extends controller {
		/*public $mode;
		public $rol;
		public $accesos;*/
		public $nameControl = "Consultorio";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/ConsultorioModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			//INSTANCIAS DE CLASES Y CREACION DE OBJETOS
			$this->mode = new consultorio_model();
			$this->alm = new consultorio_model();
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

		public function json(){
			if($this->accesoConsultar){
				
				$this->mode->Consultar("listarConsultorios");
			}else{
				return $this->vista("error");
			}
			
		}

		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("consultorio");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarConsultorio", $_REQUEST['id']);
			return $this->vista("consultorio/modificar");
			}else{
				return $this->vista("error");
			}
			
		}

		
		public function guardar(){
			if($this->accesoRegistrar){
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->codtlfn = $_POST['codtlfn'];
				$this->alm->tlfno = $_POST['telefono'];
				$this->alm->silla = $_POST['sillas'];
				
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarConsultorio", $_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}
				if($this->alm->descripcion == "" || $this->alm->direccion == "" || $this->alm->tlfno == ""){

				}else{
					if (!$this->alm->consulta == "") {
						echo "2";
							/*echo "<script>
		                alert('Ya existe un Consultorio con el Mismo Nombre');
		                 history.back();
		    			</script>";*/
					}else{
						$this->mode->Registrar("registrarConsultorio", $this->alm);
						$this->bitacora->AnexarBitacora();
						echo "1";
					
						/*echo "<script>
		                alert('Consultorio registrado');
		                 setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
		    			</script>";*/
					}
				}
			}else{
				return $this->vista("error");
			}	
		}

		public function modificar(){
			//$alm = new consultorio_model();
			if($this->accesoModificar){
				$this->alm->id = $_POST['id'];
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->codtlfn = $_POST['codtlfn'];
				$this->alm->telefono = $_POST['telefono'];	
				//$this->alm->status = $_POST['status'];
				$this->alm->silla = $_POST['sillas'];

				foreach ($this->mode->Consultar("verificarConsultorioId", $_POST['id']) as $k){
					$this->alm->consulta1 = $k->descripcion;
				}
				foreach ($this->mode->Consultar("verificarConsultorioNombre", $_POST['descripcion']) as $k){
					$this->alm->consulta = $k->id;
				}
				if ($this->alm->descripcion==$this->alm->consulta1 ) {
					$this->mode->Modificar("modificarConsultorio", $this->alm);
					echo "1";
					$this->bitacora->AnexarBitacora();
					/*echo "<script>
		                alert('Consultorio modificado');
		                 setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
		    			</script>";*/
				}else if (!$this->alm->consulta == "") {
					echo "8";
					/*echo "<script>
		                alert('Ya existe un Consultorio con el Mismo Nombre');
		                 history.back();
		    			</script>";*/
				}else{
					$this->mode->Modificar("modificarConsultorio", $this->alm);
					echo "1";
					$this->bitacora->AnexarBitacora();
					/*echo "<script>
		                alert('Consultorio modificado');
		                 setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
		    			</script>";*/
				}
			}else{
				return $this->vista("error");
			}
		}
		
		public function eliminar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("eliminarConsultorio", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Consultorio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}

		}

		public function inhabilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("inhabilitarConsultorio", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Consultorio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		public function habilitar(){
			if($this->accesoEliminar){
				$this->mode->Eliminar("habilitarConsultorio", $_REQUEST['id']);
				$this->bitacora->AnexarBitacora();
				echo "1";
				/*echo "<script>
					alert('Consultorio inhabilitado');
					setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
				</script>";*/
			}else{
				return $this->vista("error");
			}
		}

		



		public function verificarRegistroConsultorio(){
			//$alm = new consultorio_model();
			if($this->accesoConsultar){
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->Consultar("buscarRegistroConsultorio", $consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					echo "
						<div class='col-md-8'>
							<p style='color:Red;'> Consultorio existe </p>
						</div>
					";
				}
			}else{
				return $this->vista("error");
			}
		}

		public function buscarRegistro(){
			//$alm = new consultorio_model();
			if($this->accesoConsultar){
		$consultaBusqueda = $_POST['valorBusqueda'];
		//echo '<option value="0">'.$id_turno.''.$id.'</option>';
		$mensaje="";
		$this->alm->estado="";
		foreach ($this->mode->Consultar("buscarRegistroConsultorio", $consultaBusqueda) as $resultados) : 
					
		//echo '<h5>'.$k->descripcion.'</h5>';
		$this->alm->id = $resultados->id;
		$this->alm->descripcion = $resultados->descripcion;
        $this->alm->direccion = $resultados->direccion;
        $this->alm->telefono = $resultados->tlfno;
        $this->alm->sillas = $resultados->sillas;
        $this->alm->status = $resultados->status;
    	endforeach;
		if($this->alm->status==1){
			$this->alm->estado='Activo';
		}else if($this->alm->status==0){
			$this->alm->estado='Inactivo';
		}
	
        
        //Output
		if($this->alm->id != ""){
			$mensaje.= '<div class="row">
						<div class="row">
							<div class="col-md-12 text-center">
								
							</div>
						</div>
					</div>
	

			<div class="col-md-12 text-center">
				<table class="table table-hover">
					<tr class="table-secondary">
						<thead class="table-success">
						<th>Consultorio</th>
						<th>Dirección</th>
						<th>Teléfono</th>
            			<th>Sillas</th>
						<th>Estado</th>';

								if($this->accesoModificar){
									$mensaje .='<th>EDITAR</th>';
								}
								if($this->accesoEliminar){
									$mensaje .='<th>ELIMINAR</th>';
								}
								$mensaje .='
						</thead>
					</tr>
		
			
					<tr>
							<td>'.$this->alm->descripcion.'</td>
							<td>'.$this->alm->direccion.'</td>
							<td>'.$this->alm->telefono.'</td>
              				<td>'.$this->alm->sillas.'</td>
							<td>'.$this->alm->estado.'</td>
							
					
							<td>';
							if($this->accesoModificar){
							$mensaje .='
                			<a href="index.php?c=consultorio&a=editar&id='.$this->alm->id.'" type="button" class="btn btn-outline-primary">
                			<i class="bi bi-pencil-square"></i>
               			 	</a>

							</td>';
							}
							if($this->accesoEliminar){
							$mensaje .='
							<td>
                				<button href="#" id="'.$this->alm->id.'" type="button" class="btn btn-outline-danger eliminar">
                                <i class="bi bi-trash"></i>
                			</button>
							</td>';
							}
							$mensaje .='	

					</tr>
				</table>	
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
        //window.location.href="index.php?c=consultorio&a=inhabilitar&id="+id;

      									$.ajax({
										      type:"POST",
										      url:"index.php?c=consultorio&a=inhabilitar&id="+id,
										
										      success:function(r){
										        if(r==1){
										 
										          swal("Atención!", "Registro Eliminado", "warning")
										          
										        }else {
										          swal("Atención!", "Error al eliminar", "error")
										        }
										      }

										 });

      } else {
    //Si se cancela se emite un mensaje
        swal("Cancelado", "Usted ha cancelado la acción de eliminación", "error");
      }
    });
    });



	});
     

    </script>
	';
		} echo $mensaje;
		}else{
				return $this->vista("error");
			}
				
		}

		public function tablaConsultorio(){
		if($this->accesoConsultar){
		//$alm = new consultorio_model();
		$mensaje ="";
		$mensaje .='

<div class="row">
    <div class="row">
      <div class="col-md-12 text-center">
      
        <h3>Consultorios</h3>

      </div>
    </div>
</div>
      <div class="col-md-12 text-center">
        <table class="table table-hover" id="mitabla">
         <thead>
          <tr class="table-secondary">
            
            			<th>Consultorio</th>
						<th>Dirección</th>
						<th>Teléfono</th>
            			<th>Sillas</th>
						<th>Estado</th>';
						if($this->accesoModificar){
									$mensaje .='<th>EDITAR</th>';
								}
								if($this->accesoEliminar){
									$mensaje .='<th>ELIMINAR</th>';
								}
								$mensaje .='    
          </tr>                 
		</thead>
  ';
		foreach ($this->mode->Consultar("listarConsultorios") as $k) : 
					if($k->status==1){
					$this->alm->estado='Activo';
					}else if($this->alm->status==0){
					$this->alm->estado='Inactivo';
					}
					$mensaje .= '    
			<tbody>
			<tr>
              
					<td>'.$k->descripcion.'</td>
              		<td>'.$k->direccion.'</td>
              		<td>'.$k->tlfno.'</td>
              		<td>'.$k->sillas.'</td>
              		
              		<td>'.$this->alm->estado.'</td>';
            if($this->accesoModificar){
			$mensaje .='
              <td>
                <a href="index.php?c=consultorio&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square"></i>       
                </a>
              </td>';
          	}
          	if($this->accesoEliminar){
							$mensaje .='
              <td>
                <button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
                <i class="bi bi-trash"></i>               
                </button>
              </td>';
             }
           $mensaje .='  
            </tr>
            
            ';
 endforeach;
$mensaje .= '
</tbody>
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
        //window.location.href="index.php?c=consultorio&a=inhabilitar&id="+id;

        								$.ajax({
										      type:"POST",
										      url:"index.php?c=consultorio&a=inhabilitar&id="+id,
										
										      success:function(r){
										        if(r==1){
										 
										          swal("Atención!", "Registro Eliminado", "warning")
										          
										        }else {
										          swal("Atención!", "Error al eliminar", "error")
										        }
										      }

										 });
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

    	}else{
				return $this->vista("error");
			}

}
		
		 












		/*public function recargarDatosConsultorio(){
			
			$alm = $this->mode->Consultar("listarConsultorios");
			$k=$alm;
		}

		public function cargarConsultoriosAjax(){
			
			$this->mode->Consultar("listarConsultoriosAjax");
			echo json_encode([
        	'data' => $this->mode->Consultar("listarConsultoriosAjax"),
   			 ]);
		}*/


	}
?>