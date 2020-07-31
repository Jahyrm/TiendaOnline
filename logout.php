<?php 
session_start();
session_unset();

$_SESSION['UID'] = NULL;
$_SESSION['Tipo'] = NULL;
$_SESSION[ 'Nombre' ] = NULL;
$_SESSION[ 'Apellido' ] = NULL;
$_SESSION['Username'] = NULL;
$_SESSION['Telefono'] = NULL;
$_SESSION['FechaNac'] = NULL;
$_SESSION[ 'Correo' ] = NULL;
$_SESSION[ 'Imagen' ] = NULL;
$_SESSION[ 'FUID' ] = NULL;
$_SESSION[ 'Google' ] = NULL;
$_SESSION[ 'Recuperado' ] = NULL;

include('google/config.php');

//Reset OAuth access token
if(isset($_SESSION['G'])) {
    $google_client->revokeToken();
}

$_SESSION[ 'G' ] = NULL;


//Destroy entire session data.
session_destroy();

unset($_COOKIE['logincookie']);
$res = setcookie('logincookie', null, -1, '/');

header("Location: acceder.php");        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>