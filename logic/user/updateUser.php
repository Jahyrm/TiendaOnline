<?php
session_start();
include "../../globalVars.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha_nac = $_POST['fecha_nac'];


    //uploading image
    $path = $_FILES['image']['name'];
    $ext = pathinfo($path);
    if(!empty($ext['extension'])) {
        $host = 'ftp.wwecuador.com';
        $usr = 'zibauser@wwecuador.com';
        $pwd = 'S58E{-sD+gix';
        $conn_id=ftp_connect($host);
        $success = ftp_login($conn_id, $usr, $pwd);
        $rightName = basename($_POST["id"].".".$ext['extension']);
        ftp_pasv($conn_id, true);
        if($success) { 
            ftp_put($conn_id, $rightName,$_FILES['image']['tmp_name'],FTP_BINARY) or die('Cannot ftp');
            ftp_close($conn_id);
            echo ' Upload Successful';
        }
        if($success) {
            $image = "https://wwecuador.com/ziba/img/users/".$_POST["id"].".".$ext['extension'];
        } else {
            if(isset($_SESSION['Imagen']) && $_SESSION['Imagen']!="") {
                $image = $_SESSION['Imagen'];
            } else {
                $image = NULL;
            }
        }
    } else {
        if(isset($_SESSION['Imagen']) && $_SESSION['Imagen']!="") {
            $image = $_SESSION['Imagen'];
        } else {
            $image = NULL;
        }
    }

    $data = array(
        'id' => $id,
        'name' => $name,
        'apellido' => $apellido,
        'image' => $image,
        'telefono' => $telefono,
        'fecha_nac' => $fecha_nac
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
    $result = file_get_contents($env."api/user/update.php", false, $context);
    $response = json_decode( $result );

    if($http_response_header[0]=="HTTP/1.1 200 OK") {
        $_SESSION["Nombre"] = $name;
        $_SESSION["Apellido"] = $apellido;
        $_SESSION['Telefono'] = $telefono;
        $_SESSION['FechaNac'] = $fecha_nac;
        $_SESSION['Imagen'] = $image;
        
        header("Location: ../../cuenta-usuario.php?m=1");
    } else {
        header("Location: ../../cuenta-usuario.php?m=2");
    }
} else {
    header("Location: ../../cuenta-usuario.php");
}
?>