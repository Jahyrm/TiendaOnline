<?php
session_start();
include "../../globalVars.php";

if (isset($_POST['mname'])) {
    $name = $_POST['mname'];

    $data = array(
        'name' => $name
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
    $result = file_get_contents($env."api/marca/create.php", false, $context);
    $response = json_decode( $result );

    if ($http_response_header[0]=="HTTP/1.1 201 Created") {
        header("Location: ../../cuenta-usuario.php?m=10");
    } else {
        header("Location: ../../cuenta-usuario.php?m=11");
    }

} else {
    header("Location: ../../cuenta-usuario.php?m=12");
}
?>