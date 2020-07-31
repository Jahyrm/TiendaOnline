<?php
session_start();
include_once("../globalVars.php");

if (isset($_POST['correo'])) {
	$correo = $_POST['correo'];
	$contrasena = $_POST['password'];
    $recordarme = $_POST['recordarme'];

    $result = file_get_contents($env."api/user/readByEmail.php?correo=$correo");
    $response = json_decode( $result );

    if( $http_response_header[0]=="HTTP/1.1 404 Not Found" ){
        header("Location: ../acceder.php?mensaje=2");
    } else {
        if ($response->password==NULL && ($response->fb_uuid!=NULL || $response->google_uuid!=NULL) ) {
            header("Location: ../acceder.php?mensaje=3"); //correo vinculado a red social
        } else {
            include 'funciones.php';
            $desencrypted = dec_enc('decrypt', $response->password);
            
            if ($desencrypted===$contrasena) {
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
                if (isset($recordarme)) {
                    $encrypted = dec_enc('encrypt', $_SESSION['UID']);
                    setcookie('logincookie', $encrypted, time() + (86400 * 365), '/');
                }
                header('Location: ../index.php');
				return;
            } else {
                header("Location: ../acceder.php?mensaje=4");
            }
        }
    }
} else {
    header("Location: ../acceder.php");
}
?>