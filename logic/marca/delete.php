<?php
session_start();
include "../../globalVars.php";


if (isset($_POST['maridel'])) {
    $id = $_POST['maridel'];

    $data = array(
        'id' => $id
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
    $result = file_get_contents($env."api/marca/delete.php", false, $context);
    $response = json_decode( $result );

    if ($http_response_header[0]=="HTTP/1.1 200 OK") {
        header("Location: ../../cuenta-usuario.php?m=13");
    } else {
        header("Location: ../../cuenta-usuario.php?m=14");
    }

} else {
    header("Location: ../../cuenta-usuario.php?m=15");
}
?>