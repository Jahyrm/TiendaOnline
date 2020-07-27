<?php
class Subcategory{
  
    // database connection and table name
    private $conn;
    private $table_name = "subcategoria";
  
    // object properties
    public $id_subcat;
    public $nombre;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function read(){
        //select all data
        $query = "SELECT
                    ID_SUBCAT, NOMBRE
                FROM
                    " . $this->table_name . "
                ORDER BY
                ID_SUBCAT";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
}
?>