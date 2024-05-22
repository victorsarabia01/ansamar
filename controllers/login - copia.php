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
			if($_POST['usuario']=="" or $_POST['password']=="" or $_POST['consultorio']==""){
				/*echo "<script>
					alert('campos vacios');
					history.back();
				</script>";*/
				echo "4";
			}else{
				$cuenta = [];
				foreach ($this->mode->verificarUsuario(ucwords(mb_strtolower($_POST['usuario'])), $_POST['password']) as $k){
					$cuenta = $k;
				}
				if(count($cuenta)>0){
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
						$consultorios = $this->consultorio->Consultar("cargarConsultorio", $_POST['consultorio']);
						// echo "Buscar Consultorio";
						// echo "<br>";
						// print_r($consultorios);
						$_SESSION[NAME.'_cuentaActiva'] = true;
						$_SESSION[NAME.'_cuenta'] = $cuenta;
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
				

	}
?>