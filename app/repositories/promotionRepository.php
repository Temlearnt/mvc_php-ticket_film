<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class PromotionRepository
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fetch 5 active promotions with movie details
    public function getActivePromotionsWithMovies($limit = 5)
    {
        $stmt = $this->conn->prepare("SELECT * FROM promotions JOIN movies ON promotions.movie_id = movies.movie_id LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM promotions JOIN movies ON promotions.movie_id = movies.movie_id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function getPromotionByMovieId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM promotions JOIN movies ON promotions.movie_id = movies.movie_id WHERE movies.movie_id = :id AND promotions.end_date >= CURDATE()");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function getPromotionById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM promotions JOIN movies ON promotions.movie_id = movies.movie_id WHERE SHA2(promotions.id, 256) = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function edit(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("UPDATE promotions SET movie_id = :movie, discount_percentage = :discount, start_date = :start, end_date= :end, note=:note WHERE SHA2(id,256) = :id");
    
            // Bind parameters
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':movie', $data['movie']);
            $stmt->bindParam(':discount', $data['discount']);
            $stmt->bindParam(':start', $data['start']);
            $stmt->bindParam(':end', $data['end']);
            $stmt->bindParam(':note', $data['note']);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function save(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO promotions (id, movie_id, discount_percentage, start_date, end_date, note) VALUES ('', :movie, :discount, :start, :end, :note)");
    
            // Bind parameters
            $stmt->bindParam(':movie', $data['movie']);
            $stmt->bindParam(':discount', $data['discount']);
            $stmt->bindParam(':start', $data['start']);
            $stmt->bindParam(':end', $data['end']);
            $stmt->bindParam(':note', $data['note']);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function delete($id) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("DELETE FROM promotions WHERE SHA2(id,256) = :id");
    
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

