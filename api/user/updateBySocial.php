<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare user object
$user = new User($db);
  
// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of user to be edited
$user->email = $data->correo;

if(!empty($data->image)) {
    $user->image = $data->image;
}
if(!empty($data->fb_uuid)) {
    $user->fb_uuid = $data->fb_uuid;
}
if(!empty($data->google_uuid)) {
    $user->google_uuid = $data->google_uuid;
}

if(!empty($data->fb_uuid)) {
    if(!empty($data->image)) {
        if($user->updateBySocial(0)){
            http_response_code(200);
            echo json_encode(array("message" => "Se actualizó el usuario."));
        } else{
            http_response_code(200);
            echo json_encode(array("message" => "No se pudo actualizar el usuario.0"));
        }
    } else {
        if($user->updateBySocial(1)){
            http_response_code(200);
            echo json_encode(array("message" => "Se actualizó el usuario."));
        } else{
            http_response_code(200);
            echo json_encode(array("message" => "No se pudo actualizar el usuario.1"));
        }
    }
} else {
    if(!empty($data->image)) {
        if($user->updateBySocial(2)){
            http_response_code(200);
            echo json_encode(array("message" => "Se actualizó el usuario."));
        } else{
            http_response_code(200);
            echo json_encode(array("message" => "No se pudo actualizar el usuario.2"));
        }
    } else {
        if($user->updateBySocial(3)){
            http_response_code(200);
            echo json_encode(array("message" => "Se actualizó el usuario."));
        } else{
            http_response_code(200);
            echo json_encode(array("message" => "No se pudo actualizar el usuario.3"));
        }
    }
}

?>