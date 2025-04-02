<?php
// app/Repositories/MovieRepository.php
namespace App\Repositories;

use App\Core\Database;
use PDO;
use PDOException;

class MovieRepository {
    protected $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function find($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies WHERE SHA2(movie_id, 256) = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return null;
        }
    }

    public function all() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function realese() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies WHERE release_date <= CURDATE()");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function genre() {
        try {
            $stmt = $this->conn->prepare("SELECT genre FROM movies GROUP BY genre");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function recommendation() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies ORDER BY rating DESC LIMIT 4");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function comingSoon() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM movies WHERE rating = 0 LIMIT 4");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or handle exception
            return [];
        }
    }

    public function save(array $data) {
            try {
                // Validasi data array
                if (empty($data['title']) || empty($data['genre']) || empty($data['release_date']) || empty($data['description']) || empty($data['duration']) || empty($data['poster'])) {
                    return $result = [
                        'status' => false,
                        'message'=> 'All fields must be filled.'
                    ];
                }
        
                // Validasi file poster
                $poster = $data['poster'];
                if ($poster['error'] === UPLOAD_ERR_OK) {
                    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/cinnamon/public/assets/img/movies/";
                    $fileName = basename($poster['name']);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
                    $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                    if (in_array(strtolower($fileType), $allowTypes)) {
                        if (move_uploaded_file($poster["tmp_name"], $targetFilePath)) {
                            // Simpan data ke database
                            $sql = "INSERT INTO movies (title, genre, release_date,rating, description, duration_minutes, poster) VALUES (:title, :genre, :release_date, :rating, :description, :duration, :poster)";
                            $stmt = $this->conn->prepare($sql);
        
                            $stmt->execute([
                                ':title' => $data['title'],
                                ':genre' => $data['genre'],
                                ':release_date' => $data['release_date'],
                                ':rating' => $data['rating'],
                                ':description' => $data['description'],
                                ':duration' => $data['duration'],
                                ':poster' => '/assets/img/movies/'.$fileName
                            ]);
        
                            return $result = [
                                'status' => true,
                            ];
                        } else {
                            return $result = [
                                'status' => false,
                                'message'=> 'Sorry, an error occurred while uploading the file.'
                            ];
                        }
                    } else {
                        return $result = [
                            'status' => false,
                            'message'=> 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed.'
                        ];
                    }
                } else {
                    return $result = [
                        'status' => false,
                        'message'=> 'Sorry, there was a problem with the file upload.'
                    ];
                }
            } catch (PDOException $e) {
                // Log atau tangani error sesuai kebutuhan
                echo 'Error: ' . $e->getMessage();
                return null;
            }
        }        

        public function update(array $data) {
            try {
                // Validasi data array
                if (empty($data['title']) || empty($data['genre']) || empty($data['release_date']) || empty($data['description']) || empty($data['duration'])) {
                    return $result = [
                        'status' => false,
                        'message'=> 'All fields must be filled.'
                    ];
                }
        
                // Ambil ID movie yang ingin diupdate
                $movieId = $data['id'];  // Pastikan ID film tersedia dalam data
                
                // Validasi file poster jika ada
                $poster = isset($data['poster']) ? $data['poster'] : null;
                if ($poster && $poster['error'] === UPLOAD_ERR_OK) {
                    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/cinnamon/public";  // Tentukan direktori upload
                    $fileName = basename($poster['name']);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
                    // Jenis file yang diperbolehkan
                    $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                    if (in_array(strtolower($fileType), $allowTypes)) {
                        // Mengunggah file
                        if (move_uploaded_file($poster["tmp_name"], $targetFilePath)) {
                            // Mengambil nama poster yang baru
                            $fileName = $fileName;  // Nama file baru untuk disimpan
        
                            // Update data ke database, termasuk poster baru
                            $sql = "UPDATE movies SET title = :title, genre = :genre, release_date = :release_date, rating = :rating, description = :description, duration_minutes = :duration, poster = :poster WHERE SHA2(movie_id, 256) = :id";
                            $stmt = $this->conn->prepare($sql);
                            $stmt->execute([
                                ':title' => $data['title'],
                                ':genre' => $data['genre'],
                                ':release_date' => $data['release_date'],
                                ':rating' => $data['rating'],  // Nilai default untuk rating jika tidak diberikan
                                ':description' => $data['description'],
                                ':duration' => $data['duration'],
                                ':poster' => '/assets/img/movies/'.$fileName,
                                ':id' => $movieId
                            ]);
        
                            return $result = [
                                'status' => true,
                                'message' => 'Data has been updated successfully.'
                            ];
                        } else {
                            return $result = [
                                'status' => false,
                                'message' => 'Sorry, an error occurred while uploading the file.'
                            ];
                        }
                    } else {
                        return $result = [
                            'status' => false,
                            'message' => 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed.'
                        ];
                    }
                } else {
                    // Jika tidak ada file yang diupload, lakukan update tanpa poster
                    $sql = "UPDATE movies SET title = :title, genre = :genre, release_date = :release_date, rating = :rating, description = :description, duration_minutes = :duration WHERE SHA2(movie_id, 256) = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([
                        ':title' => $data['title'],
                        ':genre' => $data['genre'],
                        ':release_date' => $data['release_date'],
                        ':rating' => $data['rating'],  // Nilai default untuk rating jika tidak diberikan
                        ':description' => $data['description'],
                        ':duration' => $data['duration'],
                        ':id' => $movieId
                    ]);
        
                    return $result = [
                        'status' => true,
                    ];
                }
        
            } catch (PDOException $e) {
                // Tangani error
                return $result = [
                    'status' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ];
            }
        }
        public function delete(array $data)
        {
            $id = $data['id'];
            $image = $data['poster'];
            // Path lokal ke folder uploads
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/cinnamon/public";
            $fullImagePath = $targetDir . $image;
        
            // SQL statement to delete category
            $stmt = $this->conn->prepare("DELETE FROM movies WHERE movie_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            if ($stmt->execute()) {
                // Delete image file if exists and not default
                if (file_exists($fullImagePath)) {
                    if (unlink($fullImagePath)) {
                        return $result = [
                            'status' => true,
                        ];                    
                    } else {
                        return $result = [
                            'status' => true, 
                            'message' => "Failed to delete file: " . $fullImagePath
                        ];                    
                    }
                } else {
                    return true; // Return true if file does not exist
                }
            } else {
                return false; // Return false if SQL deletion fails
            }
        }    
}
