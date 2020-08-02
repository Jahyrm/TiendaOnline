<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate detalle object
include_once '../objects/detalle.php';
  
$database = new Database();
$db = $database->getConnection();
  
$detalle = new Detalle($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->idorder) &&
    !empty($data->idprod) &&
    !empty($data->cantidad) &&
    !empty($data->precio)
){
  
    // set domicilio property values
    $detalle->idOrden = $data->idorder;
    $detalle->idProducto = $data->idprod;
    $detalle->cantidad = $data->cantidad;
    $detalle->precio = $data->precio;
  
    // create the domicilio
    if($detalle->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("id" => $detalle->id, "message" => "Producto insertado."));
    }

    // if unable to create the orden, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "No se pudo insertar el producto."));
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