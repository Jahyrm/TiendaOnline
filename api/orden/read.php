<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/orden.php';
  
// instantiate database and orden object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$orden = new Orden($db);

// set ID property of record to read
if(isset($_GET['by'])) {
    if($_GET['by']=="user") {
        $user = true;
        $orden->idUsuario = isset($_GET['id']) ? $_GET['id'] : die();
    } else if ($_GET['by']=="orden") {
        $user = false;
        $orden->id = isset($_GET['id']) ? $_GET['id'] : die();
    }
} else {
    die();
}
  
// read orden will be here
// query ordens
$stmt = $orden->read($user);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){

    $ordens_arr=array();
    $ordens_arr["records"]=array();

    $ord_ant=0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $product_item=array(
            "id" => $idProducto,
            "image" => $IMAGEN,
            "name" => $NOMBRE,
            "description" => $DESCRIPCION,
            "cant" => $cantidad,
            "price" => $precio
        );

        if ($ord_ant==0) {
            $ord_ant = $id;

            $user_item=array(
                "id" => $idUsuario,
                "nombre" => $name,
                "apellido" => $apellido,
                "telefono" => $telefono,
                "fecha_nac" => $fecha_nac,
                "email" => $email
            );
    
            $domicilio_item=array(
                "pais" => $pais,
                "provincia" => $provincia,
                "ciudad" => $ciudad,
                "codigopostal" => $cp,
                "calle" => $calle,
                "calleDos" => $calleDos,
                "referencia" => $referencia
            );

            $orden_item=array(
                "id" => $id,
                "fecha" => $fecha,
                "cupon" => $cupon,
                "descuento" => $descuento,
                "iva" => $iva,
                "metodo" => $metodo_nombre,
                "total" => $total
            );
            $orden_item["user"]=$user_item;
            $orden_item["domicilio"]=$domicilio_item;
            $orden_item["productos"]=array();

            array_push($orden_item["productos"], $product_item);

        } else {
            if ($ord_ant==$id) {
                array_push($orden_item["productos"], $product_item);
                //array_push($ordens_arr["records"], $orden_item);
            } else {

                array_push($ordens_arr["records"], $orden_item);

                $ord_ant = $id;
                $user_item=array(
                    "id" => $idUsuario,
                    "nombre" => $name,
                    "apellido" => $apellido,
                    "telefono" => $telefono,
                    "fecha_nac" => $fecha_nac,
                    "email" => $email
                );
        
                $domicilio_item=array(
                    "pais" => $pais,
                    "provincia" => $provincia,
                    "ciudad" => $ciudad,
                    "codigopostal" => $cp,
                    "calle" => $calle,
                    "calleDos" => $calleDos,
                    "referencia" => $referencia
                );
    
                $orden_item=array(
                    "id" => $id,
                    "fecha" => $fecha,
                    "cupon" => $cupon,
                    "descuento" => $descuento,
                    "iva" => $iva,
                    "metodo" => $metodo_nombre,
                    "total" => $total
                );
                $orden_item["user"]=$user_item;
                $orden_item["domicilio"]=$domicilio_item;
                $orden_item["productos"]=array();

                array_push($orden_item["productos"], $product_item);
            }
        }

    }
    array_push($ordens_arr["records"], $orden_item);
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show ordens data in json format
    echo json_encode($ordens_arr);
}
  
// no ordens found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no ordens found
    echo json_encode(
        array("message" => "No se encontraron ordenes.")
    );
}