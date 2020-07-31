<?php
class Subcategory{
  
    // database connection and table name
    private $conn;
    private $table_name = "subcategoria";
    private $table_name_dos = "categoria_subcategoria";
  
    // object properties
    public $id_cat;
    public $id_subcat;
    public $name;
  
    public function __construct($db){
        $this->conn = $db;
    }


    // create subcategory
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

            $this->id_subcat = $this->conn->lastInsertId();

            $newquery = "INSERT INTO " . $this->table_name_dos . " 
            SET
                ID_CATEGORIA=:id_cat, ID_SUBCAT=:id_subcat";

            $newstmt = $this->conn->prepare($newquery);

            // sanitize
            $this->id_cat=htmlspecialchars(strip_tags($this->id_cat));
            $this->id_subcat=htmlspecialchars(strip_tags($this->id_subcat));
        
            // bind values
            $newstmt->bindParam(":id_cat", $this->id_cat);
            $newstmt->bindParam(":id_subcat", $this->id_subcat);

            if($newstmt->execute()) {
                return true;
            }
            return false;
        }
        return false;
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


    // update the subcategory
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . ", " . $this->table_name_dos . " 
                SET
                    " . $this->table_name . ".NOMBRE=:name, 
                    " . $this->table_name_dos . ".ID_CATEGORIA=:id_cat
                WHERE
                    " . $this->table_name . ".ID_SUBCAT=:id_subcat 
                AND 
                    " . $this->table_name_dos . ".ID_SUBCAT=:id_subcatt";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->id_cat=htmlspecialchars(strip_tags($this->id_cat));
        $this->id_subcat=htmlspecialchars(strip_tags($this->id_subcat));
    
        // bind new values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id_cat", $this->id_cat);
        $stmt->bindParam(":id_subcat", $this->id_subcat);
        $stmt->bindParam(":id_subcatt", $this->id_subcat);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the subcategory
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name_dos . " WHERE ID_SUBCAT = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subcat=htmlspecialchars(strip_tags($this->id_subcat));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_subcat);
    
        // execute query
        if($stmt->execute()){
            $newquery = "DELETE FROM " . $this->table_name . " WHERE ID_SUBCAT = ?";
            $newstmt = $this->conn->prepare($newquery);
            $newstmt->bindParam(1, $this->id_subcat);
            if($newstmt->execute()){
                return true;
            }
            return false;
        }
    
        return false;
    }

}
?>