<?php
session_start();
include "../../globalVars.php";

if (isset($_POST['catided'])) {
    $id = $_POST['catided'];
    $name = $_POST['cnameed'];

    $data = array(
        'id' => $id,
        'nombre' => $name
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
    $result = file_get_contents($env."api/category/update.php", false, $context);
    $response = json_decode( $result );

    if ($http_response_header[0]=="HTTP/1.1 200 OK") {
        header("Location: ../../cuenta-usuario.php?m=7");
    } else {
        header("Location: ../../cuenta-usuario.php?m=8");
    }

} else {
    header("Location: ../../cuenta-usuario.php?m=9");
}
?>