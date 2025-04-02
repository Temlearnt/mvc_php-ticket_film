<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class TicketRepository
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function all()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies JOIN schedules ON movies.movie_id = schedules.movie_id 
            RIGHT JOIN tickets ON schedules.schedule_id = tickets.schedule_id LEFT JOIN users ON tickets.user_id = users.user_id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function ticketById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies JOIN schedules ON movies.movie_id = schedules.movie_id 
            JOIN tickets ON schedules.schedule_id = tickets.schedule_id JOIN users ON tickets.user_id = users.user_id WHERE SHA2(ticket_id, 256) = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function save(array $data)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO tickets (user_id, schedule_id, seat_number) VALUES (:user_id, :schedule_id, :seats)");

            // Bind parameters
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':schedule_id', $data['schedule_id']);
            $stmt->bindParam(':seats', $data['seats']);

            // Execute the statement
            $stmt->execute();

            // Return the last inserted ID
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }
}
