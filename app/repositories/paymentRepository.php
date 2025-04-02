<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class PaymentRepository
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function countCompletedTickets()
    {
        $query = "SELECT COUNT(ticket_id) as total_tickets FROM payments WHERE payment_status = 'completed'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_tickets'] ?? 0;
    }

    public function sumCompletedAmounts()
    {
        $query = "SELECT SUM(amount) as total_revenue FROM payments WHERE payment_status = 'completed'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_revenue'] ?? 0;
    }

    public function all() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM payments ORDER BY payment_time");
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
            $stmt = $this->conn->prepare("INSERT INTO payments (payment_id, ticket_id, payment_method, amount, payment_status, payment_time) 
                                           VALUES ('', :ticket_id, :payment_method, :amount, :payment_status, NOW())");
    
            // Bind parameters
            $stmt->bindParam(':ticket_id', $data['ticket']);
            $stmt->bindParam(':payment_method', $data['method']);
            $stmt->bindParam(':amount', $data['amount']);
            $paymentStatus = 'pending'; // Set payment status to 'pending'
            $stmt->bindParam(':payment_status', $paymentStatus);
            if($stmt->execute()){
                return $result = [
                    'status' => true,
                    'message' => 'Booking successfully.'
                ];
            }else{
                return $result = [
                    'status' => false,
                    'message' => 'Sorry, there is something wrong'
                ];
            }
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function selectBookHistoryTicket($id) {
        try {
            // Query with placeholders for safer binding
            $query = "SELECT * FROM payments JOIN tickets ON payments.ticket_id = tickets.ticket_id 
            JOIN schedules ON tickets.schedule_id = schedules.schedule_id 
            JOIN movies ON schedules.movie_id = movies.movie_id 
            JOIN theaters ON schedules.theater_id = theaters.theater_id 
            JOIN users ON tickets.user_id = users.user_id; 
            WHERE users.user = :user_id";
    
            $stmt = $this->conn->prepare($query);
    
            // Bind parameters safely
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
    
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

    public function selectPaymentTicket($id) {
        try {
            // Query with placeholders for safer binding
            $query = "SELECT * FROM payments JOIN tickets ON payments.ticket_id = tickets.ticket_id 
            JOIN schedules ON tickets.schedule_id = schedules.schedule_id 
            JOIN movies ON schedules.movie_id = movies.movie_id 
            JOIN theaters ON schedules.theater_id = theaters.theater_id 
            WHERE SHA2(payments.payment_id, 256) = :id";
            $stmt = $this->conn->prepare($query);
            // Bind parameters safely
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
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

    public function edit($status, $id){
        try {
            // Query with placeholders for safer binding
            $query = "UPDATE payments SET payment_status = '$status'  WHERE SHA2(payment_id, 256) = :id";
            $stmt = $this->conn->prepare($query);
            // Bind parameters safely
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    
            // Fetch all results
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception, and return an empty array
            error_log('Database error: ' . $e->getMessage()); // Example of logging error
            return [];
        }
    }

    public function selectSeat($id) {
        try {
            // Query with placeholders for safer binding
            $query = "SELECT * FROM payments JOIN tickets ON payments.ticket_id = tickets.ticket_id 
            JOIN schedules ON tickets.schedule_id = schedules.schedule_id 
            JOIN movies ON schedules.movie_id = movies.movie_id 
            JOIN theaters ON schedules.theater_id = theaters.theater_id 
            WHERE payments.payment_status = 'completed' AND SHA2(schedules.schedule_id, 256) = :id";
            $stmt = $this->conn->prepare($query);
            // Bind parameters safely
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
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
}

?>
