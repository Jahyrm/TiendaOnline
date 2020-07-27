<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "producto";
  
    // object properties
    public $id;
    public $name;
    public $image;
    public $price;
    public $stock;
    public $description;
    public $id_marca;
    public $id_subcat;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // read products
    function read(){

        // select all query
        $query = "SELECT p.*, c.NOMBRE as CAT_NOMBRE
        FROM
            (SELECT p.*, s.NOMBRE as SUBCAT_NOMBRE
            FROM
                (SELECT p.*, m.NOMBRE as MARCA_NOMBRE
                FROM 
                    (SELECT
                        p.*, cs.ID_CATEGORIA
                    FROM
                        " . $this->table_name . " p
                    INNER JOIN
                        categoria_subcategoria cs
                    ON
                        p.ID_SUBCAT = cs.ID_SUBCAT) p
                INNER JOIN
                    marca m
                ON
                    p.ID_MARCA = m.ID_MARCA) p
            INNER JOIN
                subcategoria s
            ON
                p.ID_SUBCAT	 = s.ID_SUBCAT) p
        INNER JOIN
            categoria c
        ON
            p.ID_CATEGORIA = c.ID_CATEGORIA
        ORDER BY
            p.ID_PRODUCTO ASC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    NOMBRE=:name, IMAGEN=:image, PRECIO=:price, STOCK=:stock, DESCRIPCION=:description, ID_MARCA=:id_marca, ID_SUBCAT=:id_subcat";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id_marca=htmlspecialchars(strip_tags($this->id_marca));
        $this->id_subcat=htmlspecialchars(strip_tags($this->id_subcat));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_subcat", $this->id_subcat);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // read_one: used when filling up the update product form
    function readOne(){
        // select all query
        $query = "SELECT p.*, c.NOMBRE as CAT_NOMBRE
        FROM
            (SELECT p.*, s.NOMBRE as SUBCAT_NOMBRE
            FROM
                (SELECT p.*, m.NOMBRE as MARCA_NOMBRE
                FROM 
                    (SELECT
                        p.*, cs.ID_CATEGORIA
                    FROM
                        " . $this->table_name . " p
                    INNER JOIN
                        categoria_subcategoria cs
                    ON
                        p.ID_SUBCAT = cs.ID_SUBCAT) p
                INNER JOIN
                    marca m
                ON
                    p.ID_MARCA = m.ID_MARCA) p
            INNER JOIN
                subcategoria s
            ON
                p.ID_SUBCAT	 = s.ID_SUBCAT) p
        INNER JOIN
            categoria c
        ON
            p.ID_CATEGORIA = c.ID_CATEGORIA
        WHERE
            p.ID_PRODUCTO = ?
        LIMIT
            0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->name = $row['NOMBRE'];
        $this->image = $row['IMAGEN'];
        $this->price = $row['PRECIO'];
        $this->stock = $row['STOCK'];
        $this->description = $row['DESCRIPCION'];
        $this->id_marca = $row['ID_MARCA'];
        $this->id_subcat = $row['ID_SUBCAT'];
    }



    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    NOMBRE=:name,
                    IMAGEN=:image,
                    PRECIO=:price,
                    STOCK=:stock,
                    DESCRIPCION=:description,
                    ID_MARCA=:id_marca,
                    ID_SUBCAT=:id_subcat
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id_marca=htmlspecialchars(strip_tags($this->id_marca));
        $this->id_subcat=htmlspecialchars(strip_tags($this->id_subcat));
    
        // bind new values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_subcat", $this->id_subcat);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }



    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
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