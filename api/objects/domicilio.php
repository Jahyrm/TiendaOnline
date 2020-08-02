<?php
class Domicilio{
  
    // database connection and table name
    private $conn;
    private $table_name = "domicilio";
  
    // object properties
    public $id;
    public $idUsuario;
    public $pais;
    public $provincia;
    public $ciudad;
    public $cp;
    public $calle;
    public $calleDos;
    public $referencia;
  
    public function __construct($db){
        $this->conn = $db;
    }


    // create category
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . " 
                    (idUsuario, pais, provincia, ciudad, cp, calle, calleDos, referencia)
                VALUES
                    (:iduser, :pais, :provincia, :ciudad, :cp, :calle, :calledos, :referencia)";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idUsuario=htmlspecialchars(strip_tags($this->idUsuario));
        $this->pais=htmlspecialchars(strip_tags($this->pais));
        $this->provincia=htmlspecialchars(strip_tags($this->provincia));
        $this->ciudad=htmlspecialchars(strip_tags($this->ciudad));
        $this->cp=htmlspecialchars(strip_tags($this->cp));
        $this->calle=htmlspecialchars(strip_tags($this->calle));
        $this->calleDos=htmlspecialchars(strip_tags($this->calleDos));
        $this->referencia=htmlspecialchars(strip_tags($this->referencia));
    
        // bind values
        $stmt->bindParam(":iduser", $this->idUsuario);
        $stmt->bindParam(":pais", $this->pais);
        $stmt->bindParam(":provincia", $this->provincia);
        $stmt->bindParam(":ciudad", $this->ciudad);
        $stmt->bindParam(":cp", $this->cp);
        $stmt->bindParam(":calle", $this->calle);
        $stmt->bindParam(":calledos", $this->calleDos);
        $stmt->bindParam(":referencia", $this->referencia);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            $this->id=htmlspecialchars(strip_tags($this->id));
            return true;
        }
        return false;
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