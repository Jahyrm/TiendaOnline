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
  
    // create marca
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
                    ID_MARCA, NOMBRE
                FROM
                    " . $this->table_name . "
                ORDER BY
                    ID_MARCA";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }



    // update the marca
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    NOMBRE=:name
                WHERE
                    ID_MARCA=:id";
    
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


    // delete the marca
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_MARCA = ?";
    
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