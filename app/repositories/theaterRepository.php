<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class TheaterRepository
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function countTheaters()
    {
        $query = "SELECT COUNT(*) as total_theaters FROM theaters";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_theaters'] ?? 0;
    }

    public function all() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM theaters");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function getTheaterById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM theaters WHERE SHA2(theater_id, 256) = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function save(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO theaters (theater_id, name, location) VALUES ('', :name, :location)");
    
            // Bind parameters
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':location', $data['location']);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function update(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("UPDATE theaters SET name = :name, location = :location WHERE SHA2(theater_id, 256) = :id");
    
            // Bind parameters
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':location', $data['location']);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function delete($id) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("DELETE FROM theaters WHERE SHA2(theater_id,256) = :id");
    
            // Bind parameters
            $stmt->bindParam(':id', $id);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }
}

?>
