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
                    (idUsuario, idDomicilio, idMetodo, fecha, cupon, descuento, iva, total)
                VALUES
                    (:iduser, :iddom, :idmet, CURDATE(), :cupon, :descuento, :iva, :total)";
    
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


    // read order
    function read($user){

        if($user) {
            $where = " WHERE idUsuario=? ";
        } else {
            $where = " WHERE id=? ";
        }

        // select all query
        $query = "SELECT dc.*, p.IMAGEN, p.NOMBRE, p.DESCRIPCION 
        FROM 
            (SELECT of.*, dt.idProducto, dt.cantidad, dt.precio 
                FROM detalle_orden dt 
                INNER JOIN 
                    (SELECT o.id, o.idUsuario, o.idDomicilio, o.idMetodo, o.fecha, o.cupon, o.descuento, o.iva, o.total, du.pais, du.provincia, du.ciudad, du.cp, du.calle, du.calleDos, du.referencia, du.name, du.apellido, du.telefono, du.fecha_nac, du.email, m.nombre as metodo_nombre 
                        FROM orden o 
                        INNER JOIN 
                            (SELECT d.*, u.name, u.apellido, u.telefono, u.fecha_nac, u.email 
                                FROM domicilio d 
                            INNER JOIN users u ON d.idUsuario = u.id) du
                        ON o.idDomicilio=du.id
                        INNER JOIN metodo_pago m 
                        ON o.idMetodo=m.id) of
                ON dt.idOrden=of.id) dc 
            INNER JOIN producto p ON dc.idProducto=p.ID_PRODUCTO".$where."
    ORDER BY dc.id ASC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        if($user) {
            $stmt->bindParam(1, $this->idUsuario);
        } else {
            $stmt->bindParam(1, $this->id);
        }
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>