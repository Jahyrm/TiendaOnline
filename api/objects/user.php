<?php
class User{
  
    // database connection and table name
    private $conn;
    private $table_name = "users";
  
    // object properties
    public $id;
    public $user_type;
    public $name;
    public $apellido;
    public $username;
    public $telefono;
    public $fecha_nac;
    public $email;
    public $password;
    public $image;
    public $fb_uuid;
    public $google_uuid;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // create user
    function create(){
        
        //query to insert record
        $query = "INSERT INTO
            " . $this->table_name . "
            (name, apellido, username, email, password)
        VALUES (:name,:apellido,:username,:email,:password)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        
    }

    // create user
    function createBySocial($red){
        
        if($red==0) {
            //query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
                (name, apellido, email, image, fb_uuid)
            VALUES (:name,:apellido,:email,:image,:fb_uuid)";

        } else {
            //query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
                (name, apellido, email, image, google_uuid)
            VALUES (:name,:apellido,:email,:image,:google_uuid)";
        }

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->image=htmlspecialchars(strip_tags($this->image));
        if($red==0) {
            $this->fb_uuid=htmlspecialchars(strip_tags($this->fb_uuid));
        } else {
            $this->google_uuid=htmlspecialchars(strip_tags($this->google_uuid));
        }


        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":image", $this->image);
        if($red==0) {
            $stmt->bindParam(":fb_uuid", $this->fb_uuid);
        } else {
            $stmt->bindParam(":google_uuid", $this->google_uuid);
        }

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        
    }


    // read user by email
    function readByEmail(){
        // select all query
        $query = "SELECT * FROM users WHERE email=?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->email);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->user_type = $row['user_type'];
        $this->name = $row['name'];
        $this->apellido = $row['apellido'];
        $this->username = $row['username'];
        $this->telefono = $row['telefono'];
        $this->fecha_nac = $row['fecha_nac'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->image = $row['image'];
        $this->fb_uuid = $row['fb_uuid'];
        $this->google_uuid = $row['google_uuid'];
    }

    // read user by Id
    function readById(){
        // select all query
        $query = "SELECT * FROM users WHERE id=?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->user_type = $row['user_type'];
        $this->name = $row['name'];
        $this->apellido = $row['apellido'];
        $this->username = $row['username'];
        $this->telefono = $row['telefono'];
        $this->fecha_nac = $row['fecha_nac'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->image = $row['image'];
        $this->fb_uuid = $row['fb_uuid'];
        $this->google_uuid = $row['google_uuid'];
    }

    // read_one: used when filling up the update product form
    function readBySocial($red){

        // select query
        if($red=="fb") {
            $query = "SELECT * FROM users WHERE email=? OR fb_uuid=?";
        } else {
            $query = "SELECT * FROM users WHERE email=? OR google_uuid=?";
        }
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->email);

        if($red=="fb") {
            $stmt->bindParam(2, $this->fb_uuid);
        } else {
            $stmt->bindParam(2, $this->google_uuid);
        }
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->user_type = $row['user_type'];
        $this->name = $row['name'];
        $this->apellido = $row['apellido'];
        $this->username = $row['username'];
        $this->telefono = $row['telefono'];
        $this->fecha_nac = $row['fecha_nac'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->image = $row['image'];
        $this->fb_uuid = $row['fb_uuid'];
        $this->google_uuid = $row['google_uuid'];
    }



    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name=:name,
                    apellido=:apellido,
                    image=:image,
                    telefono=:telefono,
                    fecha_nac=:fecha_nac
                WHERE
                    id=:id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->fecha_nac=htmlspecialchars(strip_tags($this->fecha_nac));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":fecha_nac", $this->fecha_nac);
        $stmt->bindParam(":id", $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }



    // update the product
    function updateBySocial($case){

        if($case==0) {
            $query = "UPDATE
            " . $this->table_name . "
            SET
                email=:email,
                image=:image,
                fb_uuid=:fb_uuid
            WHERE
                fb_uuid=:fb_uuidd 
            OR
                email=:emaill";
        } else if ($case==1) {
            $query = "UPDATE
            " . $this->table_name . "
            SET
                email=:email,
                fb_uuid=:fb_uuid
            WHERE
                fb_uuid=:fb_uuidd 
            OR
                email=:emaill";
        } else if ($case==2) {
            $query = "UPDATE
            " . $this->table_name . "
            SET
                email=:email,
                image=:image,
                google_uuid=:google_uuid
            WHERE
                google_uuid=:google_uuidd 
            OR
                email=:emaill";
        } else if ($case==3) {
            $query = "UPDATE
            " . $this->table_name . "
            SET
                email=:email,
                google_uuid=:google_uuid
            WHERE
                google_uuid=:google_uuidd 
            OR
                email=:emaill";
        }
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        if($case==0) {
            $this->image=htmlspecialchars(strip_tags($this->image));
            $this->fb_uuid=htmlspecialchars(strip_tags($this->fb_uuid));
        } else if ($case==1) {
            $this->fb_uuid=htmlspecialchars(strip_tags($this->fb_uuid));
        } else if ($case==2) {
            $this->image=htmlspecialchars(strip_tags($this->image));
            $this->google_uuid=htmlspecialchars(strip_tags($this->google_uuid));
        } else if ($case==3) {
            $this->google_uuid=htmlspecialchars(strip_tags($this->google_uuid));
        }
    
        // bind new values
        $stmt->bindParam(":email", $this->email);
        if($case==0) {
            $stmt->bindParam(":image", $this->image);
            $stmt->bindParam(":fb_uuid", $this->fb_uuid);
            $stmt->bindParam(":fb_uuidd", $this->fb_uuid);
            $stmt->bindParam(":emaill", $this->email);
        } else if ($case==1) {
            $stmt->bindParam(":fb_uuid", $this->fb_uuid);
            $stmt->bindParam(":fb_uuidd", $this->fb_uuid);
            $stmt->bindParam(":emaill", $this->email);
        } else if ($case==2) {
            $stmt->bindParam(":image", $this->image);
            $stmt->bindParam(":google_uuid", $this->google_uuid);
            $stmt->bindParam(":google_uuidd", $this->google_uuid);
            $stmt->bindParam(":emaill", $this->email);
        } else if ($case==3) {
            $stmt->bindParam(":google_uuid", $this->google_uuid);
            $stmt->bindParam(":google_uuidd", $this->google_uuid);
            $stmt->bindParam(":emaill", $this->email);
        }
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    // read user by Id
    function readByUid($case){

        // select all query
        if($case==0) {
            $query = "SELECT * FROM users WHERE fb_uuid=?";
        } else if($case==1) {
            $query = "SELECT * FROM users WHERE google_uuid=?";
        }
        
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        if($case==0) {
            $stmt->bindParam(1, $this->fb_uuid);
        } else if($case==1) {
            $stmt->bindParam(1, $this->google_uuid);
        }
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->user_type = $row['user_type'];
        $this->name = $row['name'];
        $this->apellido = $row['apellido'];
        $this->username = $row['username'];
        $this->telefono = $row['telefono'];
        $this->fecha_nac = $row['fecha_nac'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->image = $row['image'];
        $this->fb_uuid = $row['fb_uuid'];
        $this->google_uuid = $row['google_uuid'];
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