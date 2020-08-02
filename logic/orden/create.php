<?php
session_start();
include "../../globalVars.php";

if (isset($_POST['pais'])) {
    $idUser = $_SESSION["UID"];
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $cp = $_POST['cp'];
    $calle = $_POST['calle'];
    $calledos = $_POST['calledos'];
    $referencia = $_POST['referencia'];
    $idmetodo = $_POST['gridRadios'];
    $total = $_POST['total'];
    $descuento = $_POST['descuento'];
    $iva = $_POST['iva'];
    $cupon = $_POST['cupon'];


    $data = array(
        'iduser' => $idUser,
        'pais' => $pais,
        'provincia' => $provincia,
        'ciudad' => $ciudad,
        'cp' => $cp,
        'calle' => $calle,
        'calledos' => $calledos,
        'referencia' => $referencia
    );

    // Send Domicilio JSON object
    $options = array(
        'http' => array(
        'method'  => 'POST',
        'content' => json_encode( $data ),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
        )
    );
    $context  = stream_context_create( $options );
    $result = file_get_contents($env."api/domicilio/create.php", false, $context);
    $response = json_decode( $result );

    if ($http_response_header[0]=="HTTP/1.1 201 Created") {
        $idDomicilio = $response->id;

        $data = array(
            'iduser' => $idUser,
            'iddom' => $idDomicilio,
            'idmet' => $idmetodo,
            'cupon' => $cupon,
            'descuento' => $descuento,
            'iva' => $iva,
            'total' => $total
        );

        // Send Order JSON object
        $options = array(
            'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
            )
        );
        $context  = stream_context_create( $options );
        $result = file_get_contents($env."api/orden/create.php", false, $context);
        $response = json_decode( $result );

        if ($http_response_header[0]=="HTTP/1.1 201 Created") {
            $idOrden = $response->id;

            $prodsInCart = json_decode( file_get_contents($env.'api/carrito/read.php?id='.$idUser), true );
            foreach ($prodsInCart["records"] as $productCart){
                $data = array(
                    'idorder' => $idOrden,
                    'idprod' => $productCart["id_prod"],
                    'cantidad' => $productCart["cantidad"],
                    'precio' => $productCart["product"][0]["price"]
                );
                // Send Order JSON object
                $options = array(
                    'http' => array(
                    'method'  => 'POST',
                    'content' => json_encode( $data ),
                    'header'=>  "Content-Type: application/json\r\n" .
                                "Accept: application/json\r\n"
                    )
                );
                $context  = stream_context_create( $options );
                $result = file_get_contents($env."api/detalle/create.php", false, $context);
                $response = json_decode( $result );

                // UPDATE STOCK
                $data = array(
                    'id' => $productCart["id_prod"],
                    'stock' => ($productCart["product"][0]["stock"] - $productCart["cantidad"]) 
                );
                // Send Order JSON object
                $options = array(
                    'http' => array(
                    'method'  => 'POST',
                    'content' => json_encode( $data ),
                    'header'=>  "Content-Type: application/json\r\n" .
                                "Accept: application/json\r\n"
                    )
                );
                $context  = stream_context_create( $options );
                $result = file_get_contents($env."api/product/updateStock.php", false, $context);
                $response = json_decode( $result );
            }


            // DELETE CARRITO
            $data = array(
                'userid' => $idUser
            );
            // Send Order JSON object
            $options = array(
                'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n"
                )
            );
            $context  = stream_context_create( $options );
            $result = file_get_contents($env."api/carrito/deleteByUser.php", false, $context);
            $response = json_decode( $result );
            if ($http_response_header[0]=="HTTP/1.1 200 OK") {
                header("Location: ../../cuenta-usuario.php?m=1");
            } else {
                header("Location: ../../cuenta-usuario.php?m=2");
            }
        } else {
            header("Location: ../../cuenta-usuario.php?m=1");
        }
    } else {
        header("Location: ../../cuenta-usuario.php?m=2");
    }
} else {
    header("Location: ../../cuenta-usuario.php?m=3");
}
?>