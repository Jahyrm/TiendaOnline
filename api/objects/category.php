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


    // create category
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    NOMBRE=:name";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
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
            (SELECT c.ID_CATEGORIA, cs.ID_SUBCAT, c.NOMBRE FROM categoria_subcategoria cs RIGHT JOIN " . $this->table_name . " c ON cs.ID_CATEGORIA = c.ID_CATEGORIA) c
        LEFT JOIN subcategoria s
        ON c.ID_SUBCAT = s.ID_SUBCAT
        ORDER BY c.ID_CATEGORIA";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }



    // update the category
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    NOMBRE=:name
                WHERE
                    ID_CATEGORIA=:id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // bind new values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the category
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_CATEGORIA = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
}
?>