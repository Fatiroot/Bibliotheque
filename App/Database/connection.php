<?php
include __DIR__ .'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct() {
        $this->servername = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbname = $_ENV['DB_NAME'];
    }

    public function Connection() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>