<?php
class Detalle{
  
    // database connection and table name
    private $conn;
    private $table_name = "detalle_orden";
  
    // object properties
    public $id;
    public $idOrden;
    public $idProducto;
    public $cantidad;
    public $precio;
  
    public function __construct($db){
        $this->conn = $db;
    }

    // create category
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . " 
                    (idOrden, idProducto, cantidad, precio)
                VALUES
                    (:idOrden, :idProducto, :cantidad, :precio)";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idOrden=htmlspecialchars(strip_tags($this->idOrden));
        $this->idProducto=htmlspecialchars(strip_tags($this->idProducto));
        $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
    
        // bind values
        $stmt->bindParam(":idOrden", $this->idOrden);
        $stmt->bindParam(":idProducto", $this->idProducto);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio", $this->precio);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>