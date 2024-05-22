<?php
include_once "controller.php";
	class proveedorController extends controller{

		public $nameControl = "Proveedor";

		
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/proveedorModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new proveedor_model();
			$this->alm = new proveedor_model();
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
				$this->mode->Consultar("listarProveedores");
			}else{
				return $this->vista("error");
			}
			
		}
		public function index(){
			if($this->accesoConsultar){
				$this->bitacora->AnexarBitacora();
				return $this->vista("proveedor");
			}else{
				return $this->vista("error");
			}
		}

		public function editar(){
			
			if($this->accesoModificar){
				$this->alm = $this->mode->Consultar("cargarProveedor", $_REQUEST['id']);
			return $this->vista("proveedor/modificar");
			}else{
				return $this->vista("error");
			}
			
		}

		public function guardar(){
			if($this->accesoRegistrar){
				$this->alm->descripcion = $_POST['descripcion'];
				$this->alm->direccion = $_POST['direccion'];
				$this->alm->telefono = $_POST['telefono'];
				$this->alm->email = $_POST['email'];
			
				//VALIDACIONES BACKEND
				foreach ($this->mode->Consultar("verificarProveedor",$_POST['descripcion']) as $k) : 
						$this->alm->consulta = $k->id;
				endforeach;
				if (!$this->alm->consulta == "") {
					echo "2";
				}else{
					$this->mode->Registrar("registrarProveedor",$this->alm);
					$this->bitacora->AnexarBitacora();
					echo "1";
				}
			}else{
				return $this->vista("error");
			}
			}

		public function guardar1(){
			echo "1";
		}



		public function verificarRegistroProveedor(){
			//$alm = new insumo_model();
		
			$consultaBusqueda = $_POST['valorBusqueda'];
			foreach ($this->mode->Consultar("buscarRegistroProveedor",$consultaBusqueda) as $resultados) : 					
				$this->alm->id = $resultados->id;
	    endforeach;
	    if($this->alm->id != ""){
	    		echo "
	    			<div class='col-md-8'>
	                <p style='color:Red;'> Proveedor ya registrado </p>
	                </div>
	    			";
    	}
				
		}
		
		
		
		
		//ELIMINACION LOGICA REGISTRO DE INSUMO
		public function inhabilitar(){
		if($this->accesoEliminar){
		//$alm = new insumo_model();
		
    	$this->mode->Eliminar("inhabilitarProveedor",$_REQUEST['id']);
    	$this->bitacora->AnexarBitacora();
    	echo "1";
    	}else{
				return $this->vista("error");
			}
		}

		public function habilitar(){
		if($this->accesoEliminar){
		//$alm = new insumo_model();
		
    	$this->mode->Eliminar("habilitarProveedor",$_REQUEST['id']);
    	$this->bitacora->AnexarBitacora();
    	echo "1";
    	}else{
				return $this->vista("error");
			}
		}

		public function eliminar(){
		if($this->accesoEliminar){
		//$alm = new insumo_model();
		
    	$this->mode->Eliminar("eliminarProveedor",$_REQUEST['id']);
    	$this->bitacora->AnexarBitacora();
    	echo "1";
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
		$this->alm->telefono = $_POST['telefono'];	
		//$this->alm->status = $_POST['status'];
		$this->alm->email = $_POST['email'];

		foreach ($this->mode->Consultar("verificarProveedorId", $_POST['id']) as $k) : 
					
					$this->alm->consulta1 = $k->descripcion;
		endforeach; 
		foreach ($this->mode->Consultar("verificarProveedorNombre", $_POST['descripcion']) as $k) : 
					$this->alm->consulta = $k->id;
					
		endforeach; 
		
		if ($this->alm->descripcion==$this->alm->consulta1 ) {

			$this->mode->Modificar("modificarProveedor", $this->alm);
			$this->bitacora->AnexarBitacora();
			echo "1";
			/*echo "<script>
                alert('Consultorio modificado');
                 setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
    			</script>";*/
			

		}
		else if (!$this->alm->consulta == "") {
		echo "8";
		/*echo "<script>
                alert('Ya existe un Consultorio con el Mismo Nombre');
                 history.back();
    			</script>";*/

		}else{
			$this->mode->Modificar("modificarProveedor", $this->alm);
			$this->bitacora->AnexarBitacora();
			echo "1";
			/*echo "<script>
                alert('Consultorio modificado');
                 setTimeout( function() { window.location.href = 'index.php?c=consultorio'; }, 1000 );
    			</script>";*/
		}
		}else{
				return $this->vista("error");
			}
		}

	

		public function buscarRegistro(){
			if($this->accesoConsultar){
		$alm = new proveedor_model();

		$consultaBusqueda = $_POST['valorBusqueda'];
		//echo '<option value="0">'.$id_turno.''.$id.'</option>';
		$alm->estado="";
		foreach ($this->mode->Consultar("buscarRegistroProveedor",$consultaBusqueda) as $resultados) : 
					
		//echo '<h5>'.$k->descripcion.'</h5>';
		$alm->id = $resultados->id;
        $alm->descripcion = $resultados->descripcion;
        $alm->direccion = $resultados->direccion;
        $alm->telefono = $resultados->tlfno;
        $alm->email = $resultados->email;
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
				      
				        <h3></h3>

				      </div>
				    </div>
				</div>
					

			<div class="col-md-12 text-center">
				<table class="table table-hover">
					<tr class="table-secondary">
						<thead class="table-success">
						<th>Descripcion</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Estado</th>
						<th>EDITAR</th>
						<th>ELIMINAR</th>
						</thead>
					</tr>
		
			
					<tr>
							<td>'.$alm->descripcion.'</td>
							<td>'.$alm->direccion.'</td>
							<td>'.$alm->telefono.'</td>
							<td>'.$alm->email.'</td>
							<td>'.$alm->estado.'</td>
					
							<td>
						
                				<a href="index.php?c=proveedor&a=editar&id='.$alm->id.'" type="button" class="btn btn-outline-primary">
                				<i class="bi bi-pencil-square"></i>
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
										      url:"index.php?c=proveedor&a=inhabilitar&id="+id,
										
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
		}else{
				return $this->vista("error");
			}
				
		}

		public function tablaProveedor(){
		if($this->accesoConsultar){
		$alm = new proveedor_model();
		$mensaje ="";
		$mensaje .='

		<div class="row">
		    <div class="row">
		      <div class="col-md-12 text-center">
		      
		        <h3>Proveedores</h3>

		      </div>
		    </div>
		</div>
  
      <div class="col-md-12 text-center">
        <table class="table table-hover" id="mitabla">
         <thead>
          <tr class="table-secondary">
            
          
						<th>Descripcion</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Estado</th>
						<th>EDITAR</th>
						<th>ELIMINAR</th>
            
          </tr>                 
		</thead>
  ';
		foreach ($this->mode->Consultar("listarProveedores") as $k) : 
					if($k->status==1){
					$alm->estado='Activo';
					}else if($alm->status==0){
					$alm->estado='Inactivo';
					}
					$mensaje .= '    
			<tbody>
			<tr>
              
					<td>'.$k->descripcion.'</td>
              		<td>'.$k->direccion.'</td>
              		<td>'.$k->tlfno.'</td>
              		<td>'.$k->email.'</td>       		
              		<td>'.$alm->estado.'</td>
              
              
              <td>
                <a href="index.php?c=insumo&a=editar&id='.$k->id.'" type="button" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i>
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
										      url:"index.php?c=proveedor&a=inhabilitar&id="+id,
										
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

		


	}
?>