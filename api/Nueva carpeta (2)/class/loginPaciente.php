<?php


/*$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);*/


class login{
    private $usuario;
	private $clave;
    
    public function set_usuario($valor){
		$this->usuario = $valor; 
	}
	public function set_clave($valor){
		$this->clave = $valor; 
	} 

    public function busca(){
		$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
		$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		try{
			
			$query="SELECT email,password,id
			FROM paciente 
			WHERE email = :email";
			$resultado = $PDO->prepare($query);

			$resultado->bindParam(':email',$this->usuario);
			$resultado->execute();

			foreach($resultado as $r){
				$fila= array($r["password"],$r["email"],$r["id"]);

            }
            //DATOS
            /*if(){

            }*/
			if (!empty($fila[0])) {
				return $fila;
			}
			else{
				$fila=array("Usuario incorrecto");
				return $fila;
			}

 
		}catch(Exception $e){
			return $e;
		}
	}

}

?>