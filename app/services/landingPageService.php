<?php
// src/Services/MovieService.php
namespace App\Services;

use App\Repositories\MovieRepository;
use App\Repositories\TheaterRepository;
use App\Repositories\PromotionRepository;

class LandingPageService {
    protected $movieRepository;
    protected $theaterRepository;
    protected $promotionRepository;

    public function __construct() {
        $movieRepository = new MovieRepository();
        $this->movieRepository = $movieRepository;
        $theaterRepository = new TheaterRepository();
        $this->theaterRepository = $theaterRepository;
        $promotionRepository = new PromotionRepository();
        $this->promotionRepository = $promotionRepository;
    }

    public function getRecommendMovies() {
        return $this->movieRepository->recommendation();
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
}
