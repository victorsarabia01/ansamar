<?php

require_once('class/registrarUsuario.php');
$login = new registrarUsuario();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');
header('Access-Control-Allow-Headers: Content-Type, x-requested-with');
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));

if (isset($data->cedula) && isset($data->name) && isset($data->email) && isset($data->password)) {
       

    $login->set_cedula($data->cedula);
    $login->set_name($data->name);
    $login->set_email($data->email);
    $login->set_password($data->password);
    
    $resultado = $login->registrarUsuario();
    
   /* if($data->cedula != ''){
         $mensaje="Datos recibidos";
         echo $mensaje;
    }*/
    
    $mensaje="";
	$entrada= true;
    $cedula=true;
    $email=true;

    if(empty($resultado)){
        $entrada= false;
        $mensaje="Error al registrar";
        $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje
        );
        echo json_encode($respuesta);
        //echo $mensaje;          
    }
    
    if($resultado == 'Cedula en uso'){
        $entrada= false;
        $cedula=false;
        $mensaje="cedula en uso";
        $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje,
            'cedula' => $cedula
        );
        echo json_encode($respuesta);
        //echo $mensaje;  
    }if($resultado == 'Email en uso'){

        $entrada= false;
        $email= false;
        $mensaje="email en uso";
        $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje,
            'email' => $email
        );
        echo json_encode($respuesta);

    } if($cedula && $email){

        $respuesta = array(
            'entrada' => $entrada,
            'resultado' => $resultado
        );
        echo json_encode($respuesta);
    }

        
    
   
   
} 

?>
