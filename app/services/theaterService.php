<?php
// src/Services/theaterService.php
namespace App\Services;

use App\Repositories\TheaterRepository;

class TheaterService {
    protected $theaterRepository;

    public function __construct() {
        $theaterRepository = new TheaterRepository();
        $this->theaterRepository = $theaterRepository;
    }

    public function getAlltheaters() {
        return $this->theaterRepository->all();
    }

    public function theaterById($id) {
        return $this->theaterRepository->getTheaterById($id);
    }

    public function addTheater(array $data) {
        return $this->theaterRepository->save($data);
    }

    public function editTheater(array $data) {
        return $this->theaterRepository->update($data);
    }

    public function deleteTheater($id) {
        return $this->theaterRepository->delete($id);
    }
}