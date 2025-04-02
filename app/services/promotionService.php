<?php
// src/Services/theaterService.php
namespace App\Services;

use App\Repositories\PromotionRepository;
use App\Repositories\MovieRepository;


class PromotionService {
    protected $promotionRepository;
    protected $movieRepository;

    public function __construct() {
        $promotionRepository = new PromotionRepository();
        $this->promotionRepository = $promotionRepository;
        $movieRepository = new MovieRepository();
        $this->movieRepository = $movieRepository;
    }

    public function getAllPromotions() {
        return $this->promotionRepository->all();
    }

    public function getMovies() {
        return $this->movieRepository->realese();
    }

    public function addPromotion(array $data) {
        return $this->promotionRepository->save($data);
    }

    public function promotionById($id){
        return $this->promotionRepository->getPromotionById($id);
    }

    public function editPromotion(array $data){
        return $this->promotionRepository->edit($data);
    }

    public function deletePromotion($id){
        return $this->promotionRepository->delete($id);
    }
}