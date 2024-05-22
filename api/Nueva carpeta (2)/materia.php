<?php 

require_once('./class/materia.php');
$m = new Materia();


$data = json_decode(file_get_contents("php://input"));

// Verifica si se ha enviado un dato por POST
if (isset($data->dato)) {
   
  // Captura el dato enviado por POST
  $d = $data->dato;

  // Llama a la función de consulta con el dato recibido
  $consulta = $m->consultar();

  // Imprime la consulta realizada
//   echo $consulta;
echo json_encode($consulta);
}


?>
