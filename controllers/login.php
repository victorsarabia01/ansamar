<?php

include_once "controller.php";

	class loginController extends controller {
		//public $mode;
		//public $usuariox;
		//public $rol;
		public $consultorio;
		//public $accesos;
		public function __construct(){
			require_once "models/rolModel.php";
			require_once "models/ConsultorioModel.php";
			require_once "models/loginModel.php";
			require_once "models/bitacoraModel.php";
			$this->bitacora = new bitacora_model();
			$this->mode = new login_model();
			$this->alm = new login_model();
		}
		
		public function index(){
			
			//$alm = new login_model();
			return $this->vista("login");
			//require_once "views/login.php";	
		}
		
		//INGRESAR AL SISTEMA

		public function acceder(){
			//$alm = new login_model();
			
			$this->alm->passwordIngresada = $_POST['password'];
			if($_POST['usuario']=="" or $_POST['password']=="" or $_POST['consultorio']==""){
				/*echo "<script>
					alert('campos vacios');
					history.back();
				</script>";*/
				echo "4";
			}else{
				$cuenta = [];
				//$password = "";
				//$dbpassword = "";
				/*foreach ($this->mode->verificarUsuario(ucwords(mb_strtolower($_POST['usuario'])), $_POST['password']) as $k){
					$cuenta = $k;
				}*/
				foreach ($this->mode->verificarUsuario(ucwords(mb_strtolower($_POST['usuario']))) as $k){
					$cuenta = $k;
				}
				
				foreach ($this->mode->verificarpasswork(ucwords(mb_strtolower($_POST['usuario']))) as $c){
					$this->alm->dbpassword = $c->password;
				}
			

				if(password_verify($_POST['password'], $this->alm->dbpassword)){
					$this->rol = new rol_model();
					$idRol=$cuenta['id_rol'];
					$this->accesos = $this->rol->Consultar("cargarAccesos", $idRol);
					if(count($this->accesos)==0){
						/*echo "<script>  
							alert('ACCESO DENEGADO');
							history.back();
						</script>";*/
						echo "3";
					}else{
						$this->consultorio = new consultorio_model();
						$this->usuario = new login_model();
						$consultorios = $this->consultorio->Consultar("cargarConsultorio", $_POST['consultorio']);
						$usuarios = $this->mode->cargarUsuario($_POST['usuario']);
						// echo "Buscar Consultorio";
						// echo "<br>";
						// print_r($consultorios);
						$_SESSION[NAME.'_cuentaActiva'] = true;
						$_SESSION[NAME.'_cuenta'] = $cuenta;
						$_SESSION[NAME.'_usuario'] = $usuarios;
						$_SESSION[NAME.'_consultorio'] = $consultorios;
						$this->bitacora->AnexarBitacora("Inició Sesión", "Sistema");
						// $_SESSION['id']=$alm->verificar;
						// $_SESSION['usuario']=$alm->verificar1;
						/*echo "<script>
							alert('Bienvenid@');
							setTimeout( function() { window.location.href = 'index.php'; }, 1000 );
						</script>";*/
						echo "1";
					}
				}else{
					/*echo "<script>  
						alert('Usuario o clave Invalida');
						history.back();
					</script>";*/
					echo "2";
				}
			}
		}

		//SALIR DEL SISTEMA

		public function cerrarSession(){
			$this->bitacora->AnexarBitacora("Cerró Sesión");
			session_destroy();
			echo "<script>
				setTimeout( function() { window.location.href = 'index.php'; }, 1000 );
			</script>";
		}

		public function validar(){
			$this->alm->usuario = $_POST['usuariox'];
			
			if($this->alm->usuario != ''){

				foreach ($this->mode->verificarUsuariox($_POST['usuariox']) as $k){
					$this->alm->consulta = $k->id;
				}
				if($this->alm->consulta == ""){
					echo "2";
				}else {
					echo "1";
				}

			}
			
			
		}

		public function verificarRegistrox(){

				$mensaje ="";
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->buscarRegistro($consultaBusqueda) as $resultados){
					$this->alm->id = $resultados->id;
				}
				if($this->alm->id != ""){
					$mensaje .= "
						<div class='col-md-8'>
							<p style='color:Red;'> Consultorio existe ".$this->alm->id."</p>
							<label for='exampleInputPassword1'>Pregunta1</label>
							<input type='password' class='form-control' id='pregunta1' name='pregunta1' placeholder='Respuesta'>
						</div>
					";
					echo $mensaje;
				}

			
		}

		public function verificarRegistro(){

				$mensaje ="";
				$consultaBusqueda = $_POST['valorBusqueda'];
				foreach ($this->mode->buscarRegistro($consultaBusqueda) as $resultados):

					$this->alm->id = $resultados->id;
					$this->alm->pregunta1 = $resultados->pregunta1;
					$this->alm->pregunta2 = $resultados->pregunta2;
					
				if($this->alm->id != ""){
					$mensaje .= "
							<form method='POST' id='formularioz' name='formularioz'>
							<div id='validaciones'>
							<div class='form-group'>
							<label for='exampleInputPasswordv'><h5>Pregunta 1:</h5></label>
							<br>
							<label>".$this->alm->pregunta1."</label>
							<input type='text' class='form-control' id='pregunta1' name='pregunta1' maxlength='20' placeholder='Respuesta'>
							
							<br>
							<label for='exampleInputPasswords'><h5>Pregunta 2:</h5></label>
							<br>
							<label>".$this->alm->pregunta2."</label>
							<input type='text' class='form-control' id='pregunta2' name='pregunta2' maxlength='20' placeholder='Respuesta'>
							<br>
							<label for='exampleInputPassword3'>Codigo Seguridad:</label>
            				<input type='password' class='form-control' name='codigoSeguridad' id='codigoSeguridad' placeholder='Codigo Seguridad' maxlength='4'>
							</div>
							<div id='mensajeError'></div>
							<!--<button type='submit' name='validarSeguridad' onclick='validarSeguridad();' id='validarSeguridad' class='btn btn-outline-success'>Validar</button>-->
							</div>
							</form>
					";
					echo $mensaje;
				}
				endforeach;
				
			
		}

		public function verificarSeguridad(){
			$respuesta1 = $_POST['respuesta1'];
			$respuesta2 = $_POST['respuesta2'];
			$codigoSeguridad = $_POST['codigoSeguridad'];
			$usuario = $_POST['usuario'];

			//$usuario='admin';
			//$respuesta1='frea';

			//Respuesta Numero 1
			foreach ($this->mode->verificarPregunta1($usuario,$respuesta1,$respuesta2,$codigoSeguridad) as $resultados){
					$this->alm->consultaRespuesta1 = $resultados->id;
			}
			
			if($this->alm->consultaRespuesta1 != ""){
				echo "1";
			}else{
				echo "2";
			}

		}


		public function cambiarPassword(){
			//$this->alm->usuario = ucwords(mb_strtolower($_POST['usuariox']));
			//$this->alm->passwordEncriptada = password_hash($_POST['password'], PASSWORD_DEFAULT) ;
			$usuario = ucwords(mb_strtolower($_POST['usuarioxx']));
			$passwordEncriptada = password_hash($_POST['exampleInputPassword1'], PASSWORD_DEFAULT) ;
			//$usuario = 'Angel';
			//$passwordEncriptada = '12345678';
			//$passwordEncriptada = password_hash('12345678', PASSWORD_DEFAULT) ;
			//$this->mode->registrarNewPassword($passwordEncriptada,$usuario);
			$this->mode->registrarNewPassword($passwordEncriptada,$usuario);
			echo "1";
		}


				

	}
?>