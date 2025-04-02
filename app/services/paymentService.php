<?php
// src/Services/theaterService.php
namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;

class PaymentService {
    protected $paymentRepository;
    protected $userRepository;

    public function __construct() {
        $paymentRepository = new PaymentRepository();
        $this->paymentRepository = $paymentRepository;
        $userRepository = new UserRepository();
        $this->userRepository = $userRepository;
    }

    public function getAllPayments() {
        return $this->paymentRepository->all();
    }

    public function selectedById($id) {
        return $this->paymentRepository->selectPaymentTicket($id);
    }

    public function userById($id){
        return $this->userRepository->findById($id);
    }

    public function editStatus($status, $id){
        return $this->paymentRepository->edit($status, $id);
    }
}