<?php


// try {
//     $parametros = array(
//         "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
//         "private_key_bits" => 2048,
//         "private_key_type" => OPENSSL_KEYTYPE_RSA, 
//     );
//     // $parametros = array(
//     //     "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
//     //     "private_key_bits" => 2048,
//     //     "default_md" => "sha256", 
//     // );
    
//     $generar = openssl_pkey_new($parametros);
    
//     openssl_pkey_export($generar,$keypriv, NULL,$parametros);
    
//     $keypub = openssl_pkey_get_details($generar);
    
//     file_put_contents('private.key', $keypriv);
//     file_put_contents('public.key', $keypub['key']);
//     echo "hecho";
//     //code...
// } catch (\Throwable $th) {
//     //throw $th;
//     echo 'no';
// }

$dato = 'una palabra sin cifrar'; 

$keypub = openssl_pkey_get_public(file_get_contents('public2.key'));

openssl_public_encrypt($dato,$datosEncriptado,$keypub);

echo base64_encode($datosEncriptado) . '<br/><br/>';

$keypriv = openssl_pkey_get_private(file_get_contents('private2.key'));

openssl_private_decrypt($datosEncriptado, $datosDesencriptados, $keypriv);

echo $datosDesencriptados;