<?php
session_start();
include "../../globalVars.php";


if (isset($_POST['pid'])) {
    $id = $_POST['pid'];
    $oldimage = $_POST['oldimage'];
    $marcaid = $_POST['emarcaid'];
    $subcatid = $_POST['esubcatid'];
    $nombre = $_POST['enombrep'];
    $precio = $_POST['eprecio'];
    $stock = $_POST['estock'];
    $descripcion = $_POST['edescripcion'];


    // IMAGE
    $path = $_FILES['eimagep']['name'];
    $ext = pathinfo($path);
    if(!empty($ext['extension'])) {
        $host = 'ftp.wwecuador.com';
        $usr = 'zibauserp@wwecuador.com';
        $pwd = 'S58E{-sD+gix';
        $conn_id=ftp_connect($host);
        $success = ftp_login($conn_id, $usr, $pwd);
        $rightName = basename($nombre."_".$marcaid."_".$subcatid.".".$ext['extension']);
        ftp_pasv($conn_id, true);
        if($success) { 
            ftp_put($conn_id, $rightName,$_FILES['eimagep']['tmp_name'],FTP_BINARY) or die('Cannot ftp');
            ftp_close($conn_id);
            echo ' Upload Successful';
        }
        if($success) {
            $image = "https://wwecuador.com/ziba/img/products/".rawurlencode($nombre)."_".$marcaid."_".$subcatid.".".$ext['extension'];
        } else {
            if($oldimage!="cero") {
                $image = $oldimage;
            } else {
                $image = NULL;
            }
        }
    } else {
        if($oldimage!="cero") {
            $image = $oldimage;
        } else {
            $image = NULL;
        }
    }

    $data = array(
        'id' => $id,
        'idmarca' => $marcaid,
        'idsubcat' => $subcatid,
        'name' => $nombre,
        'price' => $precio,
        'stock' => $stock,
        'description' => $descripcion,
        'image' => $image
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
    $result = file_get_contents($env."api/product/update.php", false, $context);
    $response = json_decode( $result );

    if ($http_response_header[0]=="HTTP/1.1 200 OK") {
        header("Location: ../../cuenta-usuario.php?m=30");
    } else {
        header("Location: ../../cuenta-usuario.php?m=31");
    }

} else {
    header("Location: ../../cuenta-usuario.php?m=32");
}
?>