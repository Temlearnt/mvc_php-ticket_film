<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\UserRepository;
use App\Repositories\TheaterRepository;

class DashboardService
{
    private $paymentRepository;
    private $userRepository;
    private $promotionRepository;
    private $theaterRepository;

    public function __construct() 
    {
        $paymentRepository = new PaymentRepository();
        $userRepository = new UserRepository();
        $theaterRepository = new TheaterRepository();
        $promotionRepository = new PromotionRepository();
        $this->promotionRepository = $promotionRepository;
        $this->paymentRepository = $paymentRepository;
        $this->userRepository = $userRepository;
        $this->theaterRepository = $theaterRepository;
    }

    // Get the total count of completed tickets
    public function getTotalTicketsCompleted()
    {
        return $this->paymentRepository->countCompletedTickets();
    }

    // Get the total revenue from completed payments
    public function getTotalRevenue()
    {
        return $this->paymentRepository->sumCompletedAmounts();
    }

    // Get the total count of users by role
    public function getTotalUsersByRole($role)
    {
        return $this->userRepository->countUsersByRole($role);
    }

    // Get the total number of theaters
    public function getTotalTheaters()
    {
        return $this->theaterRepository->countTheaters();
    }

    // Get the active promotions with movie details
    public function getTablePromotion()
    {
        return $this->promotionRepository->getActivePromotionsWithMovies();
    }

    // Get the complete dashboard data
    public function getDashboardData()
    {
        return [
            'total_tickets_completed' => $this->getTotalTicketsCompleted(),
            'total_revenue' => $this->getTotalRevenue(),
            'total_customers' => $this->getTotalUsersByRole('customer'),
            'total_theaters' => $this->getTotalTheaters(),
            'active_promotions' => $this->getTablePromotion() // Added active promotions
        ];
    }
}

?>
