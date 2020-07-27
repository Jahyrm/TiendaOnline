<?php
class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "categoria";
  
    // object properties
    public $id_categoria;
    public $nombre;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function read(){
        //select all data
        $query = "SELECT
                    ID_CATEGORIA, NOMBRE
                FROM
                    " . $this->table_name . "
                ORDER BY
                    ID_CATEGORIA";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT c.*, s.NOMBRE as SUB_NOMBRE
        FROM
            (SELECT cs.ID_CATEGORIA, cs.ID_SUBCAT, c.NOMBRE FROM categoria_subcategoria cs INNER JOIN " . $this->table_name . " c ON cs.ID_CATEGORIA = c.ID_CATEGORIA) c
        INNER JOIN subcategoria s
        ON c.ID_SUBCAT = s.ID_SUBCAT";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
}
?>