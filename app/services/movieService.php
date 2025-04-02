<?php
// src/Services/MovieService.php
namespace App\Services;

use App\Repositories\MovieRepository;

class MovieService {
    protected $movieRepository;

    public function __construct() {
        $movieRepository = new MovieRepository();
        $this->movieRepository = $movieRepository;
    }

    public function getMovie($id) {
        return $this->movieRepository->find($id);
    }

    public function getAllMovies() {
        return $this->movieRepository->all();
    }

    public function createMovie(array $data) {
        return $this->movieRepository->save($data);
    }

    public function updateMovie(array $data) {
        return $this->movieRepository->update($data);
    }

    public function deleteMovie(array $data) {
        return $this->movieRepository->delete($data);
    }
}
