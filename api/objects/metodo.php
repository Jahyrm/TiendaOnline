<?php
class Metodo{
  
    // database connection and table name
    private $conn;
    private $table_name = "metodo_pago";
  
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
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

}
?>