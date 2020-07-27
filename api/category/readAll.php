<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
  
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$category = new Category($db);
  
// query categorys
$stmt = $category->readAll();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // categories array
    $categories_arr=array();
    $categories_arr["records"]=array();

    $cat_ant=0;
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $subcategory_item=array(
            "id" => $ID_SUBCAT,
            "name" => $SUB_NOMBRE
        );

        if ($cat_ant==0) {

            $cat_ant = $ID_CATEGORIA;
            $category_item=array(
                "id" => $ID_CATEGORIA,
                "name" => $NOMBRE
            );
            $category_item["subcategories"]=array();

            array_push($category_item["subcategories"], $subcategory_item);

        } else {
            if ($cat_ant==$ID_CATEGORIA) {

                array_push($category_item["subcategories"], $subcategory_item);

            } else {

                array_push($categories_arr["records"], $category_item);

                $cat_ant = $ID_CATEGORIA;
                $category_item=array(
                    "id" => $ID_CATEGORIA,
                    "name" => $NOMBRE
                );
                $category_item["subcategories"]=array();
                array_push($category_item["subcategories"], $subcategory_item);
                

            }
        }
        

        
  
        
  
        
    }
  
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show categories data in json format
    echo json_encode($categories_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no categories found
    echo json_encode(
        array("message" => "No se encontraron categorías.")
    );
}
?>