<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class ScheduleRepository
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function all() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies JOIN schedules ON movies.movie_id = schedules.movie_id 
            JOIN theaters ON schedules.theater_id = theaters.theater_id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function allGroupByMovie() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies LEFT JOIN schedules ON movies.movie_id = schedules.movie_id GROUP BY movies.movie_id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function selectSchedule($id) {
        try {
            // Query with placeholders for safer binding
            $query = "SELECT * FROM movies 
                      JOIN schedules ON movies.movie_id = schedules.movie_id 
                      JOIN theaters ON schedules.theater_id = theaters.theater_id 
                      WHERE SHA2(schedules.schedule_id, 256) = :schedule_id";
    
            $stmt = $this->conn->prepare($query);
    
            // Bind parameters safely
            $stmt->bindParam(':schedule_id', $id, PDO::PARAM_STR);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch all results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception, and return an empty array
            error_log('Database error: ' . $e->getMessage()); // Example of logging error
            return [];
        }
    }

    public function selectMovie($movie) {
        try {
            // Query with placeholders for safer binding
            $query = "SELECT * FROM movies 
                      JOIN schedules ON movies.movie_id = schedules.movie_id 
                      JOIN theaters ON schedules.theater_id = theaters.theater_id 
                      WHERE SHA2(schedules.movie_id, 256) = :movie_id";
    
            $stmt = $this->conn->prepare($query);
    
            // Bind parameters safely
            $stmt->bindParam(':movie_id', $movie, PDO::PARAM_STR);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch all results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception, and return an empty array
            error_log('Database error: ' . $e->getMessage()); // Example of logging error
            return [];
        }
    }
    public function edit(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("UPDATE schedules SET movie_id = :movie, theater_id= :theater, show_time = :show, price = :price WHERE SHA2(schedule_id,256) = :id");
    
            // Bind parameters
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':movie', $data['movie']);
            $stmt->bindParam(':theater', $data['theater']);
            $stmt->bindParam(':show', $data['show']);
            $stmt->bindParam(':price', $data['price']);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function save(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO schedules (schedule_id, movie_id, theater_id, show_time, price) VALUES ('', :movie, :theater, :show, :price)");
    
            // Bind parameters
            $stmt->bindParam(':movie', $data['movie']);
            $stmt->bindParam(':theater', $data['theater']);
            $stmt->bindParam(':show', $data['show']);
            $stmt->bindParam(':price', $data['price']);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function delete($id) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("DELETE FROM schedules WHERE SHA2(schedule_id,256) = :id");
    
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
