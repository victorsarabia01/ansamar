<?php

include_once "cors.php"; // ---> INCLUIR CORNS
include_once "seguridad.php"; 

$data = file_get_contents("php://input"); // ---> DECODIFICAR JSON
//desencriptado de la informacion
 $json = json_decode($data); 
 $login = desencriptar($json->data);
 //$user = $login['user'];
 if (!isset($login['user']) || !isset($login['password'])) { // ---> SI NO LLEGAN DATOS SALIR
    $respuesta = array(
            'mensaje' => 'algo',
        );
    echo json_encode(encriptar($respuesta));
    exit;
}


include_once "modelos.php"; // ---> INCLUIR MODELO
$resultado = functionLogin($login['user']); // ---> USAR FUNCION

// ----> RETORNAR MENSAJE

    $mensaje="";
    $entrada= true;
    //$contrasena=true;
    //$Usuario=true;

    //VALIDA USUARIO 
    if(empty($resultado)){
        $entrada= false;
        //$Usuario= false;
        $mensaje="El Email ingresado es incorrecto";
        $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje,
            'usuario' => 'usuario no valido'
        );
        //http_response_code(400);

        echo json_encode(encriptar($respuesta));       
    } else {
        //VALIDA CLAVE
        $verifica = password_verify($login['password'], $resultado->password);
        if (!$verifica) {
            $entrada= false;
            //$contrasena= false;
            $mensaje = "La Contrasena ingresada es incorrecta";
            //echo $mensaje;
            $respuesta = array(
            'entrada' => $entrada,
            'mensaje' => $mensaje,
            'contrasena' => 'password no valida'
            );
        //http_response_code(400);

            echo json_encode(encriptar($respuesta));
            }
    }
        //SI EL USUARIO Y CLAVE SON CORRECTOS PERMITE ACCEDER AL DASHBOARD
    if ($entrada) {
        $respuesta = array(
            'entrada' => $entrada,
            'resultado' => $resultado->id
            
        );
        //http_response_code(200);
        echo json_encode(encriptar($respuesta));
    }
// ----> RETORNAR MENSAJE
?>


