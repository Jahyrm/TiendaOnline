<?php
class Orden{
  
    // database connection and table name
    private $conn;
    private $table_name = "orden";
  
    // object properties
    public $id;
    public $idUsuario;
    public $idDomicilio;
    public $idMetodo;
    public $cupon;
    public $descuento;
    public $iva;
    public $total;
  
    public function __construct($db){
        $this->conn = $db;
    }


    // create category
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . " 
                    (idUsuario, idDomicilio, idMetodo, cupon, descuento, iva, total)
                VALUES
                    (:iduser, :iddom, :idmet, :cupon, :descuento, :iva, :total)";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idUsuario=htmlspecialchars(strip_tags($this->idUsuario));
        $this->idDomicilio=htmlspecialchars(strip_tags($this->idDomicilio));
        $this->idMetodo=htmlspecialchars(strip_tags($this->idMetodo));
        $this->cupon=htmlspecialchars(strip_tags($this->cupon));
        $this->descuento=htmlspecialchars(strip_tags($this->descuento));
        $this->iva=htmlspecialchars(strip_tags($this->iva));
        $this->total=htmlspecialchars(strip_tags($this->total));
    
        // bind values
        $stmt->bindParam(":iduser", $this->idUsuario);
        $stmt->bindParam(":iddom", $this->idDomicilio);
        $stmt->bindParam(":idmet", $this->idMetodo);
        $stmt->bindParam(":cupon", $this->cupon);
        $stmt->bindParam(":descuento", $this->descuento);
        $stmt->bindParam(":iva", $this->iva);
        $stmt->bindParam(":total", $this->total);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            $this->id=htmlspecialchars(strip_tags($this->id));
            return true;
        }
    
        return false;
        
    }
}
?>