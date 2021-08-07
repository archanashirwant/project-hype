<?php

class Database {

    private static $instance;
    public $conn;

    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    private $stmt;
    private $error;

    public function __construct() {
        $options  = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        );
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password, $options);

        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }


    }

    // a classical static method to make it universally available
    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

   //prepare qury 
   public function query($sql)
    {
        $this->stmt = $this->conn->prepare($sql);
    }

    //bind variables
    public function bind($param, $value, $type = null)
    {
        
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
              
    }

    //execute query
    public function execute()
    {
        return $this->stmt->execute();
    }

    //Get all rows
    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Get single row
    public function fetch()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}
?>