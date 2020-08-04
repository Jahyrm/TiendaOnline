<?php
function dec_enc($action, $string) {
    $output = false;
 
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'B38B730D4CC721156E3760D1D58546CE697ADC939188E4C6A80F0E24E032B9B7';
    $secret_iv = '064DF9633D9F5DD0B5614843F6B4B059';
 
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
 
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
 
    return $output;
}

function recuperarUser($id, $envs){
    $result = file_get_contents($envs."api/user/readById.php?id=$id");
    $response = json_decode( $result );
    $_SESSION['UID'] = $response->id;
    $_SESSION['Tipo'] = $response->user_type;
    $_SESSION[ 'Nombre' ] = $response->name;
    $_SESSION[ 'Apellido' ] = $response->apellido;
    $_SESSION['Username'] = $response->username;
    $_SESSION['Telefono'] = $response->telefono;
    $_SESSION['FechaNac'] = $response->fecha_nac;
    $_SESSION[ 'Correo' ] = $response->email;
    $_SESSION[ 'Imagen' ] = $response->image;
    $_SESSION[ 'FUID' ] = $response->fb_uuid;
    $_SESSION[ 'Google' ] = $response->google_uuid;
    $_SESSION[ 'Recuperado' ] = true;
}
?>