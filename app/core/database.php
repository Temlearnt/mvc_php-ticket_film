<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        // Use the defined constants directly
        $this->host = DB_MAIN_HOST;
        $this->db_name = DB_MAIN_NAME;
        $this->username = DB_MAIN_USER;
        $this->password = DB_MAIN_PASS;
    }

    public function getConnection() {
        $this->conn = null;

        try {
            // Establish PDO connection using constants from config.php
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
