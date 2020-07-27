<?php
class Marca{
  
    // database connection and table name
    private $conn;
    private $table_name = "marca";
  
    // object properties
    public $id_marca;
    public $nombre;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function read(){
        //select all data
        $query = "SELECT
                    ID_MARCA, NOMBRE
                FROM
                    " . $this->table_name . "
                ORDER BY
                    ID_MARCA";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
}
?>