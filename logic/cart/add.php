<?php
session_start();
include "../../globalVars.php";

if (isset($_GET['id'])) {
    if (isset($_SESSION['UID'])) {
        $userid = $_SESSION['UID'];
        $prodid = $_GET['id'];
        if(isset($_GET['cantidad'])){
            $cant = $_GET['cantidad'];
        } else {
            $cant = 1;
        }

        // Cargo productos actuales
        $prodsInCart = json_decode( file_get_contents($env.'api/carrito/read.php?id='.$_SESSION["UID"]), true );
        
        // Si hay productos.
        if ($http_response_header[0]!="HTTP/1.1 404 Not Found") {

            $already = false;
            $stock = 0;
            $inCart = 0;

            // Verifico que no exista.
            foreach ($prodsInCart["records"] as $productCart){
                if($productCart["id_prod"]==$prodid) {
                    $already = true;
                    $stock = $productCart["product"][0]["stock"];
                    $inCart = $productCart["cantidad"];
                    $cant = $cant + $productCart["cantidad"];
                    break;
                }
            }

            if ($already) {
                if($cant>$stock) {
                    header("Location: ../../index.php?m=0");
                    die();
                }
            }

            $data = array(
                'user' => $userid,
                'product' => $prodid,
                'cant' => $cant
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
            if($already) {
                $result = file_get_contents($env."api/carrito/update.php", false, $context);
            } else {
                $result = file_get_contents($env."api/carrito/create.php", false, $context);
            }
            $response = json_decode( $result );
        
            if ($http_response_header[0]=="HTTP/1.1 200 OK" || $http_response_header[0]=="HTTP/1.1 201 Created") {
                header("Location: ../../index.php?m=1");
            } else {
                header("Location: ../../index.php?m=2");
            }

        } else {

            // Si no hay productos, ingreso
            $data = array(
                'user' => $userid,
                'product' => $prodid,
                'cant' => $cant
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
            $result = file_get_contents($env."api/carrito/create.php", false, $context);
            $response = json_decode( $result );
        
            if ($http_response_header[0]=="HTTP/1.1 201 Created") {
                header("Location: ../../index.php?m=1");
            } else {
                header("Location: ../../index.php?m=2");
            }
        }
    } else {
        header("Location: ../../index.php?m=3");
    }
} else {
    header("Location: ../../index.php?m=4");
}
?>