<?php
class Database{
  
    // specify your own database credentials
    private $host = "216.104.47.210:3306";
    private $db_name = "wwecuado_ziba";
    private $username = "wwecuado_zibauser";
    private $password = "S58E{-sD+gix";
    //public $conn;

    //private $host = "localhost:3306";
    //private $db_name = "zibabd";
    //private $username = "root";
    //private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>