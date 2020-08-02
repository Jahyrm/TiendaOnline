<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/carrito.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare carrito object
$carrito = new Carrito($db);

// get id of carrito to be edited
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->user) &&
    !empty($data->product) &&
    !empty($data->cant)
){
    // set ID property of carrito to be edited
    $carrito->userid = $data->user;
    
    // set product property values
    $carrito->prodid = $data->product;
    $carrito->cantidad = $data->cant;

    // update the product
    if($carrito->update()){
    
        // set response code - 200 ok
        http_response_code(200);
    
        // tell the user
        echo json_encode(array("message" => "Se actualizó el producto del carrito."));
    }
    
    // if unable to update the product, tell the user
    else{
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "No se pudo actualizar el producto en el carrito."));
    }
} else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar el carrito. La información está incompleta."));
}
?>