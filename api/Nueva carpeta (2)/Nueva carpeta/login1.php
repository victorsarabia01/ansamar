<?php 
require_once('class/login.php');
$login = new login();
include_once "./conexion.php";

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user) && isset($data->password)) {
	
	$username = $data->user;
    $password = $data->password;
    $mensaje="El Usuario ingresado es incorrecto";
        echo $username,$password;	
}

?>