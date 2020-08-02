<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/metodo.php';
  
// instantiate database and metodo object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$metodo = new Metodo($db);
  
// query metodo
$stmt = $metodo->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // metodos array
    $metodos_arr=array();
    $metodos_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $metodo_item=array(
            "id" => $id,
            "name" => $nombre
        );
  
        array_push($metodos_arr["records"], $metodo_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show metodos data in json format
    echo json_encode($metodos_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no metodos found
    echo json_encode(
        array("message" => "No se encontraron métodos.")
    );
}
?>