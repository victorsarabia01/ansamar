<?php


/*$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);*/


class registrarUsuario{
    private $cedula;
	private $name;
    private $email;
	private $clave;

    public function set_cedula($valor){
		$this->cedula = $valor; 
	}
	public function set_name($valor){
		$this->name = $valor; 
	} 
	public function set_email($valor){
		$this->email = $valor; 
	} 
	public function set_password($valor){
		$this->clave = $valor; 
	} 



    public function registrarUsuario(){
		$PDO = new PDO("mysql:host=localhost;dbname=ansamar;charset=utf8","root","");
		$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		try{
			
			$query1="SELECT id
			FROM paciente
			WHERE cedula = '{$this->cedula}'";
			$resultado = $PDO->prepare($query1);
			$resultado->execute();
			//$resultado->fetch(PDO::FETCH_OBJ);
			foreach($resultado as $r){
				$fila= array($r["id"]);


            }
            $query1="SELECT email
			FROM paciente
			WHERE email = '{$this->email}'";
			$resultado = $PDO->prepare($query1);
			$resultado->execute();
			//$resultado->fetch(PDO::FETCH_OBJ);
			foreach($resultado as $r){
				$fila1= array($r["email"]);


            }

            if (!empty($fila[0])){
				$result="Cedula en uso";
				return $result;
            }else
            if (!empty($fila1[0])){
				$result="Email en uso";
				return $result;
            }else
            {    
			
			$passwordEncriptada = password_hash($this->clave, PASSWORD_DEFAULT) ;

			$query="INSERT into paciente (cedula,nombres,email,password,status) 
			values ('{$this->cedula}','{$this->name}','{$this->email}','{$passwordEncriptada}','1')";
			$resultado = $PDO->prepare($query);
			$resultado->execute();
				$result="Usuario registrado";
				return $result;
			}
 
		}catch(Exception $e){
			return $e;
		}
	}

}

?>