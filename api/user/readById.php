<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare user object
$user = new User($db);
  
// set ID property of record to read
$user->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of user to be read
$user->readById();
  
if($user->id!=null){
    // create array
    $users_arr = array(
        "id" =>  $user->id,
        "user_type" => $user->user_type,
        "name" =>  $user->name,
        "apellido" => $user->apellido,
        "username" => $user->username,
        "telefono" => $user->telefono,
        "fecha_nac" => $user->fecha_nac,
        "email" => $user->email,
        "password" => $user->password,
        "image" => $user->image,
        "fb_uuid" => $user->fb_uuid,
        "google_uuid" => $user->google_uuid
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($users_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user user does not exist
    echo json_encode(array("message" => "El usuario no existe."));
}
?>