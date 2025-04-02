<?php
// src/Services/theaterService.php
namespace App\Services;

use App\Repositories\ScheduleRepository;
use App\Repositories\MovieRepository;
use App\Repositories\TheaterRepository;

class ScheduleService {
    protected $scheduleRepository;
    protected $movieRepository;
    protected $theaterRepository;


    public function __construct() {
        $scheduleRepository = new ScheduleRepository();
        $this->scheduleRepository = $scheduleRepository;
        $movieRepository = new MovieRepository();
        $this->movieRepository = $movieRepository;
        $theaterRepository = new TheaterRepository();
        $this->theaterRepository = $theaterRepository;
    }

    public function getAllSchedules() {
        return $this->scheduleRepository->all();
    }

    public function getAllMovies() {
        return $this->movieRepository->all();
    }

    public function getAllTheaters() {
        return $this->theaterRepository->all();
    }

    public function getMovienTheaterData()
    {
        return [
            'movies_list' => $this->getAllMovies(),
            'theaters_list' => $this->getAllTheaters()// Added active promotions
        ];
    }

    public function scheduleById($id) {
        return $this->scheduleRepository->selectSchedule($id);
    }

    public function addSchedule(array $data) {
        return $this->scheduleRepository->save($data);
    }

    public function editSchedule(array $data) {
        return $this->scheduleRepository->edit($data);
    }

    public function deleteSchedule($id) {
        return $this->scheduleRepository->delete($id);
    }
}