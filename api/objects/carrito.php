<?php
class Carrito{
  
    // database connection and table name
    private $conn;
    private $table_name = "carrito";


    // object properties
    public $id;
    public $userid;
    public $prodid;
    public $cantidad;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create user
    function create(){
        
        //query to insert record
        $query = "INSERT INTO
            " . $this->table_name . "
            (idUsuario, idProducto, cantidad)
        VALUES (:iduser, :idprod, :cant)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $this->prodid=htmlspecialchars(strip_tags($this->prodid));
        $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));

        // bind values
        $stmt->bindParam(":iduser", $this->userid);
        $stmt->bindParam(":idprod", $this->prodid);
        $stmt->bindParam(":cant", $this->cantidad);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        
    }

    // read user
    function read($userid){
        //query to insert record
        $query = "SELECT * 
        FROM 
            " . $this->table_name . "
        INNER JOIN
            producto p
        ON
            " . $this->table_name . ".idProducto = p.ID_PRODUCTO
        WHERE 
            " . $this->table_name . ".idUsuario=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $userid=htmlspecialchars(strip_tags($userid));

        // bind values
        $stmt->bindParam(":id", $userid);

        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    // update the product in cart
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    cantidad=:cantidad
                WHERE
                    idUsuario=:id_usuario AND idProducto=:id_producto";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $this->prodid=htmlspecialchars(strip_tags($this->prodid));
        $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
    
        // bind new values
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":id_usuario", $this->userid);
        $stmt->bindParam(":id_producto", $this->prodid);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product in cart
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE idUsuario=:iduser AND idProducto=:idprod";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $this->prodid=htmlspecialchars(strip_tags($this->prodid));
    
        // bind id of record to delete
        $stmt->bindParam(":iduser", $this->userid);
        $stmt->bindParam(":idprod", $this->prodid);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product in cart
    function deleteByUser(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE idUsuario=:iduser";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->userid=htmlspecialchars(strip_tags($this->userid));
    
        // bind id of record to delete
        $stmt->bindParam(":iduser", $this->userid);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}
?>