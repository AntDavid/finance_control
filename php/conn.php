<?php
include_once '../env.php';
class Conn {
    protected $conn;
    private $isConnected = false;

    public function __construct() {
        $server = getenv('DB_SERVER');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD'); 
        $database = getenv('DB_DATABASE');
        
        $this->conn = new mysqli($server, $user, $password, $database);

        if ($this->conn->connect_error) {
            die("Falha na Conexão: " . $this->conn->connect_error);
        }
        $this->isConnected = true;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->isConnected) {
            $this->conn->close();
            $this->isConnected = false;
        }
    }

    public function __destruct() {
        
    }
}
?>