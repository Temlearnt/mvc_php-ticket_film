<?php

// app/Repositories/MovieRepository.php
namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class UserRepository
{

    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findByEmail($email)
    {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return null;
        }
    }

    public function findById($id)
    {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE user_id = :user_id LIMIT 1');
            $stmt->execute(['user_id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return null;
        }
    } 

    public function countUsersByRole($role)
    {
        $query = "SELECT COUNT(*) as total_users FROM users WHERE role = :role";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_users'] ?? 0;
    }

    public function save(array $data) {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO users (user_id, email, name, password_hash, role) VALUES ('', :email, :name, :password, 'customer')");
    
            // Bind parameters
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':password', $data['password']);
    
            return $stmt->execute();;
        } catch (PDOException $e) {
            // Log error or handle exception
            return null; // or throw an exception
        }
    }

    public function update($email, $passwordHash)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET password_hash = :password WHERE email = :email");
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':email', $email);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or handle exception
            return null;
        }
    }
}
