<?php
include_once "controller.php";
	class insumoController extends controller{
		/*public $mode;
		public $alm;
		public $rol;
		public $accesos;*/
		public $nameControl = "Insumos";
		/*public $accesoRegistrar=false;
		public $accesoConsultar=false;
		public $accesoModificar=false;
		public $accesoEliminar=false;*/
		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/insumoModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new insumo_model();

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
				$this->mode->Consultar("listarInsumos");
			}else{
				return $this->vista("error");
			}
			
		}
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("insumo");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarInsumo", $_REQUEST['id']);
			return $this->vista("insumo/modificar");
			}else{
				return $this->vista("error");
			}
			
		}

		public function guardar(){
			if($this->accesoRegistrar){
				$alm = new insumo_model();
				$alm->nombre = $_POST['nombre'];
				$alm->descripcion = $_POST['descripcion'];
				$alm->cantidad = $_POST['cantidad'];
				//$alm->stock = $_POST['stock'];
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarInsumo",$_POST['nombre']) as $k) : 
						$alm->consulta = $k->id;
				endforeach;
				if($alm->nombre == "" || $alm->descripcion =="" || $alm->cantidad =="" ){

				}else{

					if (!$alm->consulta == "") {
					echo "2";
					}else{
					$this->mode->Registrar("registrarInsumo",$alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
					}

				}
				
			}else{
				return $this->vista("error");
			}
		}




		public function verificarRegistroInsumo(){
			$alm = new insumo_model();
		
			$consultaBusqueda = $_POST['valorBusqueda'];
			foreach ($this->mode->Consultar("buscarRegistroInsumo",$consultaBusqueda) as $resultados) : 					
				$alm->id = $resultados->id;
    	endforeach;
    	if($alm->id != ""){
    		echo "
    			<div class='col-md-8'>
                <p style='color:Red;'> Insumo ya existe</p>
                </div>
    			";
    	}
				
		}
		
		
		
		
		//ELIMINACION LOGICA REGISTRO DE INSUMO
		public function inhabilitar(){
		$alm = new insumo_model();
		
    	$this->mode->Eliminar("inhabilitarInsumo",$_REQUEST['id']);
    	$this->bitacora->AnexarBitacora();
    	echo "1";
		/*echo "<script>
                alert('Insumo inhabilitado');
                 setTimeout( function() { window.location.href = 'index.php?c=insumo'; }, 1000 );
    			</script>";*/
		}
		public function habilitar(){
		$alm = new insumo_model();
		
    	$this->mode->Eliminar("habilitarInsumo",$_REQUEST['id']);
    	$this->bitacora->AnexarBitacora();
    	echo "1";
		/*echo "<script>
                alert('Insumo inhabilitado');
                 setTimeout( function() { window.location.href = 'index.php?c=insumo'; }, 1000 );
    			</script>";*/
		}
		public function eliminar(){
		$alm = new insumo_model();
		
    	$this->mode->Eliminar("eliminarInsumo",$_REQUEST['id']);
    	$this->bitacora->AnexarBitacora();
    	echo "1";
		/*echo "<script>
                alert('Insumo inhabilitado');
                 setTimeout( function() { window.location.href = 'index.php?c=insumo'; }, 1000 );
    			</script>";*/
		}

		//ACTUALIZAR REGISTRO DE CONSULTORIO
		public function modificar(){
		$alm = new insumo_model();

		$alm->id = $_POST['id'];
		$alm->nombre = $_POST['nombre'];
		$alm->descripcion = $_POST['descripcion'];
		$alm->stock = $_POST['cantidad'];
		//$alm->status = $_POST['status'];


		foreach ($this->mode->Consultar("verificarInsumoId",$_POST['id']) as $k) : 
					$alm->consulta1 = $k->nombre;
		endforeach; 
		foreach ($this->mode->Consultar("verificarInsumoNombre",$_POST['nombre']) as $k) : 
					$alm->consulta = $k->id;
		endforeach; 
		
		if($alm->nombre == "" || $alm->descripcion =="" || $alm->stock =="" ){

				}else{

										if ($alm->nombre==$alm->consulta1 ) {

								$this->mode->Modificar("modificarInsumo",$alm);
								$this->bitacora->AnexarBitacora();
								echo "1";
								/*echo "<script>
					                alert('Insumo modificado');
					                 setTimeout( function() { window.location.href = 'index.php?c=insumo'; }, 1000 );
					    			</script>";*/
								

							}
							else if (!$alm->consulta == "") {
								echo "8";
							/*echo "<script>
					                alert('Ya existe un insumo con el mismo nombre');
					                 history.back();
					    			</script>";*/

							}else{
								$this->mode->Modificar("modificarInsumo",$alm);
								$this->bitacora->AnexarBitacora();
								echo "1";
								/*echo "<script>
					                alert('Insumo modificado');
					                 setTimeout( function() { window.location.href = 'index.php?c=insumo'; }, 1000 );
					    			</script>";*/
							}


				}

		


}




















		public function buscarRegistro(){
		$alm = new insumo_model();

		$consultaBusqueda = $_POST['valorBusqueda'];
		//echo '<option value="0">'.$id_turno.''.$id.'</option>';
		$alm->estado="";
		foreach ($this->mode->Consultar("buscarRegistroInsumo",$consultaBusqueda) as $resultados) : 
					
		//echo '<h5>'.$k->descripcion.'</h5>';
		$alm->id = $resultados->id;
		$alm->nombre = $resultados->nombre;
        $alm->descripcion = $resultados->descripcion;
        $alm->stock = $resultados->stock;
        $alm->status = $resultados->status;
    	endforeach;
		if($alm->status==1){
			$alm->estado='Activo';
		}else if($alm->status==0){
			$alm->estado='Inactivo';
		}
	
        
        //Output
		if($alm->id != ""){
			echo '
<div class="row">
    <div class="row">
      <div class="col-md-12 text-center">
      
        <h3>Insumos</h3>

      </div>
    </div>
</div>
	

			<div class="col-md-12 text-center">
				<table class="table table-hover">
					<tr class="table-secondary">
						<thead class="table-success">
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Stock</th>
						<th>Estado</th>
						<th>EDITAR</th>
						<th>ASIGNAR</th>
						<th>ELIMINAR</th>
						</thead>
					</tr>
		
			
					<tr>
							<td>'.$alm->nombre.'</td>
							<td>'.$alm->descripcion.'</td>
							<td>'.$alm->stock.'</td>
							<td>'.$alm->estado.'</td>
							
					
							<td>
						
                				<a href="index.php?c=insumo&a=editar&id='.$alm->id.'" type="button" class="btn btn-outline-primary">
                				<i class="bi bi-pencil-square"></i>
                				</a>
							</td>
							<td>
                				<a href="index.php?c=insumo&a=asignarr&id='.$alm->id.'" type="button" class="btn btn-outline-primary">
                       			<i class="bi bi-clipboard2-check"></i>
                        		</a>
              				</td>
			
							<td>
							
                				<button href="#" id="'.$alm->id.'" type="button" class="btn btn-outline-danger eliminar">
                                <i class="bi bi-trash"></i>
               					 </button>
							</td>
							

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
        //window.location.href="index.php?c=insumo&a=inhabilitar&id="+id;
       									$.ajax({
										      type:"POST",
										      url:"index.php?c=insumo&a=inhabilitar&id="+id,
										
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
		}
		
				
		}

		public function tablaInsumo(){
		$alm = new insumo_model();
		$mensaje ="";
		$mensaje .='

<div class="row">
    <div class="row">
      <div class="col-md-12 text-center">
      
        <h3>Insumos</h3>

      </div>
    </div>
</div>
  
      <div class="col-md-12 text-center">
        <table class="table table-hover" id="mitabla">
         <thead>
          <tr class="table-secondary">
            
            			<th>Nombre</th>
						<th>Descripcion</th>
						<th>Stock</th>
						<th>Estado</th>
						<th>EDITAR</th>
						<th>ASIGNAR</th>
						<th>ELIMINAR</th>
            
          </tr>                 
		</thead>
  ';
		foreach ($this->mode->Consultar("listarInsumos") as $k) : 
					if($k->status==1){
					$alm->estado='Activo';
					}else if($alm->status==0){
					$alm->estado='Inactivo';
					}
					$mensaje .= '    
			<tbody>
			<tr>
              
					<td>'.$k->nombre.'</td>
              		<td>'.$k->descripcion.'</td>
              		<td>'.$k->stock.'</td>     		
              		<td>'.$alm->estado.'</td>
              
              
              <td>
                <a href="index.php?c=insumo&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i>
                        </a>
              </td>
              <td>
                <a href="index.php?c=insumo&a=asignarr&id='.$k->id.'" type="button" class="btn btn-outline-primary">
                       <i class="bi bi-clipboard2-check"></i>
                        </a>
              </td>
              <td>
                <button href="#" id="'.$k->id.'" type="button" class="btn btn-outline-danger eliminar">
                               <i class="bi bi-trash"></i>
                </button>
              </td>
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
        //window.location.href="index.php?c=insumo&a=inhabilitar&id="+id;

      									$.ajax({
										      type:"POST",
										      url:"index.php?c=insumo&a=inhabilitar&id="+id,
										
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

}
		public function recargarDatosConsultorio(){
			
			$alm = $this->mode->listarConsultorios();
			$k=$alm;
		}

		public function cargarConsultoriosAjax(){
			
			$this->mode->listarConsultoriosAjax();
			echo json_encode([
        	'data' => $this->mode->listarConsultoriosAjax(),
   			 ]);
		}


	}
?>