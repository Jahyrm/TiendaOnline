<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/carrito.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare carrito object
$carrito = new Carrito($db);
  
// set ID property of record to read
$id = isset($_GET['id']) ? $_GET['id'] : null;

$stmt = $carrito->read($id);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
        // products array
        $items_arr=array();
        $items_arr["records"]=array();

        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
            $product_arr=array(
                "name" => $NOMBRE,
                "image" => $IMAGEN,
                "price" => $PRECIO,
                "stock" => $STOCK
            );
            $item=array(
                "id" => $id,
                "id_user" => $idUsuario,
                "id_prod" => $idProducto,
                "cantidad" => $cantidad
            );
            $item["product"]=$product_arr;

            //array_push($item["product"], $product_arr);
            
            array_push($items_arr["records"], $item);
        }
      
        // set response code - 200 OK
        http_response_code(200);
      
        // show products data in json format
        echo json_encode($items_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No se encontraron productos.")
    );
}
?>