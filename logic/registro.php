<?php
session_start();
include_once("../globalVars.php");

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['usuario'];
	$correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $result1 = file_get_contents($env."api/user/readByEmail.php?correo=$correo");
    $response1 = json_decode( $result1 );

    if( $http_response_header[0]!="HTTP/1.1 404 Not Found" ){
        if ($response1->fb_uuid!="" || $response1->google_uuid!="") {
            header("Location: ../registro.php?mensaje=2");
        } else {
            header("Location: ../registro.php?mensaje=3");
        }
    } else{
        include 'funciones.php';
        $encrypted = dec_enc('encrypt', $contrasena);

        // Create JSON
        $data = array(
            'nombre' => $nombre,
            'apellido' => $apellido,
            'usuario' => $username,
            'correo' => $correo,
            'contrasena' => $encrypted
        );

        // Send User JSON object
        $options = array(
            'http' => array(
              'method'  => 'POST',
              'content' => json_encode( $data ),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
        $context  = stream_context_create( $options );
        $result2 = file_get_contents($env."api/user/create.php", false, $context);
        $response2 = json_decode( $result2 );
        
        // Chequear que se creó y obtener datos.
        if($http_response_header[0]=="HTTP/1.1 201 Created") {

            $result3 = file_get_contents($env."api/user/readByEmail.php?correo=$correo", true);
            $response3 = json_decode( $result3 );

            if( $http_response_header[0]!="HTTP/1.1 404 Not Found" ){
                    $_SESSION['UID'] = $response3->id;
					$_SESSION['Tipo'] = $response3->user_type;
					$_SESSION[ 'Nombre' ] = $response3->name;
					$_SESSION[ 'Apellido' ] = $response3->apellido;
					$_SESSION['Username'] = $response3->username;
					$_SESSION['Telefono'] = $response3->telefono;
					$_SESSION['FechaNac'] = $response3->fecha_nac;
					$_SESSION[ 'Correo' ] = $response3->email;
					$_SESSION[ 'Imagen' ] = $response3->image;
					$_SESSION[ 'FUID' ] = $response3->fb_uuid;
					$_SESSION[ 'Google' ] = $response3->google_uuid;
                    $_SESSION[ 'Recuperado' ] = true;
                    /*
					if (isset($recordarme)) {
						$encrypted = dec_enc('encrypt', $_SESSION['UID']);
						setcookie('logincookie', $encrypted, time() + (86400 * 365), '/');
					}
                    */
					header('Location: ../index.php');
                    return;
            }

        } else{
            header("Location: ../registro.php?mensaje=1");
        }
     }
} else {
	header("Location: ../registro.php");
}
?>