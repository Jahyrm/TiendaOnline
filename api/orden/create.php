<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate orden object
include_once '../objects/orden.php';
  
$database = new Database();
$db = $database->getConnection();
  
$orden = new Orden($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->iduser) &&
    !empty($data->iddom) &&
    !empty($data->idmet) &&
    !empty($data->total)
){
  
    // set domicilio property values
    $orden->idUsuario = $data->iduser;
    $orden->idDomicilio = $data->iddom;
    $orden->idMetodo = $data->idmet;
    $orden->cupon = $data->cupon;
    $orden->descuento = $data->descuento;
    $orden->iva = $data->iva;
    $orden->total = $data->total;
  
    // create the domicilio
    if($orden->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("id" => $orden->id, "message" => "Orden creada."));
    }

    // if unable to create the orden, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "No se pudo crear la orden."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo crear la orden. La información está incompleta."));
}
?>