<?php
// src/Services/MovieService.php
namespace App\Services;

use App\Repositories\MovieRepository;
use App\Repositories\TheaterRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\PaymentRepository;



class CustomerService {
    protected $movieRepository;
    protected $theaterRepository;
    protected $promotionRepository;
    protected $paymentRepository;
    protected $scheduleRepository;


    public function __construct() {
        $scheduleRepository = new ScheduleRepository();
        $this->scheduleRepository = $scheduleRepository;
        $movieRepository = new MovieRepository();
        $this->movieRepository = $movieRepository;
        $theaterRepository = new TheaterRepository();
        $this->theaterRepository = $theaterRepository;
        $promotionRepository = new PromotionRepository();
        $this->promotionRepository = $promotionRepository;
        $paymentRepository = new PaymentRepository();
        $this->paymentRepository = $paymentRepository;
    }

    public function getRecommendMovies() {
        return $this->movieRepository->recommendation();
    }

    public function getAllMovies() {
        return $this->movieRepository->all();
    }

    public function getMovies() {
        return $this->scheduleRepository->allGroupByMovie();
    }

    public function getGenre() {
        return $this->movieRepository->genre();
    }

    public function getComing(){
        return $this->movieRepository->comingSoon();
    }

    public function getTheater(){
        return $this->theaterRepository->all();
    }

    public function getPromotion(){
        return $this->promotionRepository->all();
    }

    public function getHistoryBooking($id){
        return $this->paymentRepository->selectBookHistoryTicket($id);
    }

    public function getSelectedTicketByPaymentId($id){
        return $this->paymentRepository->selectPaymentTicket($id);
    }
}
