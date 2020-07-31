<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/marca.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare marca object
$marca = new Marca($db);
  
// get id of marca to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of marca to be edited
$marca->id = $data->id;
  
// set marca property values
$marca->name = $data->nombre;

// update the marca
if($marca->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Se actualizó la marca."));
}
  
// if unable to update the marca, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar la marca."));
}
?>