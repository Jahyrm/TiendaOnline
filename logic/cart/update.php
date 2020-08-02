<?php
session_start();
include "../../globalVars.php";

if (isset($_SESSION['UID'])) {
        
    $userid = $_SESSION['UID'];

    // Cargo productos actuales
    $prodsInCart = json_decode( file_get_contents($env.'api/carrito/read.php?id='.$_SESSION["UID"]), true );
    if ($http_response_header[0]!="HTTP/1.1 404 Not Found") {
        foreach ($prodsInCart["records"] as $productCart){
            $idProducto = "cantidad-".$productCart["id_prod"];
            $nuevaCantidad = $_POST[$idProducto];

            if($nuevaCantidad!=0) {
                $data = array(
                    'user' => $userid,
                    'product' => $productCart["id_prod"],
                    'cant' => $nuevaCantidad
                );
    
                // Send Carrito JSON object
                $options = array(
                    'http' => array(
                    'method'  => 'POST',
                    'content' => json_encode( $data ),
                    'header'=>  "Content-Type: application/json\r\n" .
                                "Accept: application/json\r\n"
                    )
                );
    
                $context  = stream_context_create( $options );
                $result = file_get_contents($env."api/carrito/update.php", false, $context);
                $response = json_decode( $result );
            } else {
                $data = array(
                    'userid' => $userid,
                    'prodid' => $productCart["id_prod"]
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
                $result = file_get_contents($env."api/carrito/delete.php", false, $context);
                $response = json_decode( $result );
            }
        }
        header("Location: ../../carrito.php?m=1");
    } else {
        header("Location: ../../carrito.php?m=3");
    }
} else {
    header("Location: ../../carrito.php?m=4");
}
?>