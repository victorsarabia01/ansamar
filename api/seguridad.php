<?php

function encriptar($texto){
    $publicKey = openssl_pkey_get_public(file_get_contents('keys/public.key'));

    openssl_public_encrypt(json_encode($texto),$textoEncriptado,$publicKey);

    return base64_encode($textoEncriptado);
}

 function desencriptar($texto){
    $privateKey = openssl_pkey_get_private(file_get_contents('keys/private.key'));

    openssl_private_decrypt(base64_decode($texto),$textoDesencriptado,$privateKey);

    return json_decode($textoDesencriptado,true);
}

function crear_llave () {
	try {
	    $parametros = array(
	        "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
	        "private_key_bits" => 2048,
	        "private_key_type" => OPENSSL_KEYTYPE_RSA, 
	    );
	    
	    $generar = openssl_pkey_new($parametros);
	    
	    openssl_pkey_export($generar,$keypriv, NULL,$parametros);
	    
	    $keypub = openssl_pkey_get_details($generar);
	    
	    file_put_contents('private.key', $keypriv);
	    file_put_contents('public.key', $keypub['key']);
	    echo "hecho";
    
	} catch (\Throwable $th) {
	    
	    echo 'no';
	}
}

?>