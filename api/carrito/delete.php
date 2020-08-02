<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../config/database.php';
include_once '../objects/carrito.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare carrito object
$carrito = new Carrito($db);
  
// get carrito id
$data = json_decode(file_get_contents("php://input"));
  
// set carrito id to be deleted
$carrito->userid = $data->userid;
$carrito->prodid = $data->prodid;
  
// delete the carrito
if($carrito->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "El producto se borró del carrito."));
}
  
// if unable to delete the carrito
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo borrar el producto del carrito."));
}
?>