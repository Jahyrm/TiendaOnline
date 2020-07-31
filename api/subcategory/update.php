<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/subcategory.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare subcategory object
$subcategory = new Subcategory($db);
  
// get id of subcategory to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of subcategory to be edited
$subcategory->id_subcat = $data->id;
  
// set subcategory property values
$subcategory->id_cat = $data->catid;
$subcategory->name = $data->nombre;

// update the subcategory
if($subcategory->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Se actualizó la subcategoría."));
}
  
// if unable to update the subcategory, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo actualizar la subcategoría."));
}
?>