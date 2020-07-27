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

function recuperarUser($id) {
	include("../datos/conexion.php");
	$query = mysqli_query($coneccion, "select * from users where UID='$id'");
    $row = mysqli_fetch_array($query);
    $_SESSION['UID'] = $row['id'];
    $_SESSION[ 'Nombre' ] = $row['name'];
    $_SESSION[ 'Apellido' ] = $row['apellido'];
    $_SESSION['Username'] = $row['username'];
    $_SESSION[ 'Correo' ] = $row['email'];
    $_SESSION[ 'FUID' ] = $row['fb_uuid'];
    $_SESSION[ 'Google' ] = $row['google_uuid'];
	$_SESSION[ 'Recuperado' ] = true;
	mysqli_free_result($query);
	mysqli_close($coneccion);
}
?>