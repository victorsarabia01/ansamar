<?php

require_once('class/login.php');
$login = new login();

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');
header('Access-Control-Allow-Headers: Content-Type, x-requested-with');
header("Content-Type: application/json");
/*$dominioPermitido = "http://localhost:8081";
header("Access-Control-Allow-Origin: $dominioPermitido");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: OPTIONS,GET,PUT,POST,DELETE");*/

$data = json_decode(file_get_contents("php://input"));


if (isset($data->user) && isset($data->password)) {
       
    //$username = $data->user;
    //$password = $data->password;
    
    $login->set_usuario($data->user);
    $login->set_clave($data->password);

    $resultado = $login->busca();
   
    $mensaje="";
	$entrada= true;
    $contrasena=true;
    $Usuario=true;
    
    //VALIDA USUARIO 
    if(empty($resultado[1])){
        $entrada= false;
        $Usuario= false;
        $mensaje="El Usuario ingresado es incorrecto";
        $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje,
            'usuario' => $Usuario
        );
        echo json_encode($respuesta);		
    } else {
        //VALIDA CLAVE
        $verifica = password_verify($data->password, $resultado[0]);
        if (!$verifica) {
            $entrada= false;
            $contrasena= false;
            $mensaje = "La Contraseña ingresada es incorrecta";
            //echo $mensaje;
            $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje,
            'contrasena' => $contrasena
            );
            echo json_encode($respuesta);
            }
    }

    if($entrada == true && $resultado[1] != 3){
        $entrada= false;
        $mensaje = "El Usuario no es un Administrador";
        echo $mensaje;
    }
  
    if ($entrada && $Usuario && $contrasena) {
        $respuesta = array(
            'entrada' => $entrada,
            'resultado' => $resultado[2]
            
        );
        echo json_encode($respuesta);
    }
   
   
} 

?>
