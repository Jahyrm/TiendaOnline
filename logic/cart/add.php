<?php
session_start();
include "../../globalVars.php";


if (strpos($_SERVER['HTTP_REFERER'], '?') !== false) {

    $tieneParams = false;
    $porid = "";
    $porciones = explode("?", $_SERVER['HTTP_REFERER']);
    if (strpos($porciones[1], 'id=') !== false || strpos($porciones[1], 'c=') !== false || strpos($porciones[1], 's=') !== false) {
        
        $tieneParams= true;

        $porcionesDos = explode("&", $porciones[1]);
        foreach($porcionesDos as $porcionDos) {
            if (strpos($porcionDos, 'id=') !== false) {
                if($porid=="") {$porid=$porcionDos;} else {$porid=$porid."&".$porcionDos;}
            }

            if (strpos($porcionDos, 'c=') !== false) {
                if($porid=="") {$porid=$porcionDos;} else {$porid=$porid."&".$porcionDos;}
            }

            if (strpos($porcionDos, 's=') !== false) {
                if($porid=="") {$porid=$porcionDos;} else {$porid=$porid."&".$porcionDos;}
            }

        }
    }
    if($tieneParams) {
        $url = strtok($_SERVER['HTTP_REFERER'], '?')."?".$porid;
    } else {
        $url = strtok($_SERVER['HTTP_REFERER'], '?');
    }
} else {
    $tieneParams = false;
    $url = $_SERVER['HTTP_REFERER'];
}


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
                    $stock = $productCart["product"]["stock"];
                    $inCart = $productCart["cantidad"];
                    $cant = $cant + $productCart["cantidad"];
                    break;
                }
            }

            if ($already) {
                if($cant>$stock) {
                    if($tieneParams) { header("Location: " . $url."&m=0&s=".$stock."&a=".$inCart); } else { header("Location: " . $url."?m=0&s=".$stock."&a=".$inCart); }
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
                header("Location: " . $url);
            } else {
                if($tieneParams) { header("Location: " . $url."&m=1"); } else { header("Location: " . $url."?m=1"); }
            }

        } else {

            $product = json_decode( file_get_contents($env.'api/product/read_one.php?id='.$prodid), true );

            if($cant>$product["stock"]) {
                header("Location: " . $url."?m=0&s=".$product["stock"]);
                die();
            }
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
                header("Location: " . $url);
            } else {
                if($tieneParams) { header("Location: " . $url."&m=1"); } else { header("Location: " . $url."?m=1"); }
            }
        }
    } else {
        if($tieneParams) { header("Location: " . $url."&m=2"); } else { header("Location: " . $url."?m=2"); }
    }
} else {
    if($tieneParams) { header("Location: " . $url."&m=3"); } else { header("Location: " . $url."?m=3"); }
}
?>