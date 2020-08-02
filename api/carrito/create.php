<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate carrito object
include_once '../objects/carrito.php';
  
$database = new Database();
$db = $database->getConnection();
  
$carrito = new Carrito($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->user) &&
    !empty($data->product) &&
    !empty($data->cant)
){
    // set cart property values
    $carrito->userid = $data->user;
    $carrito->prodid = $data->product;
    $carrito->cantidad = $data->cant;
  
    // create the cart
    if($carrito->create()){
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Producto insertado en el carrito."));
    }
    // if unable to create the cart, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "No se pudo agregar el producto."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo crear agregar el producto. La información está incompleta."));
}
?>