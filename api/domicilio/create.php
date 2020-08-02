<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate domicilio object
include_once '../objects/domicilio.php';
  
$database = new Database();
$db = $database->getConnection();
  
$domicilio = new Domicilio($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->iduser) &&
    !empty($data->pais) &&
    !empty($data->provincia) &&
    !empty($data->ciudad) &&
    !empty($data->cp) &&
    !empty($data->calle)
){
  
    // set domicilio property values
    $domicilio->idUsuario = $data->iduser;
    $domicilio->pais = $data->pais;
    $domicilio->provincia = $data->provincia;
    $domicilio->ciudad = $data->ciudad;
    $domicilio->cp = $data->cp;
    $domicilio->calle = $data->calle;
    $domicilio->calleDos = $data->calledos;
    $domicilio->referencia = $data->referencia;
  
    // create the domicilio
    if($domicilio->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("id" => $domicilio->id, "message" => "Domicilio creado."));
    }

    // if unable to create the subcategory, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "No se pudo crear la subcategoría."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "No se pudo crear la subcategoría. La información está incompleta."));
}
?>