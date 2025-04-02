<?php
// src/Services/theaterService.php
namespace App\Services;

use App\Repositories\MovieRepository;
use App\Repositories\TicketRepository;

class TicketService {
    protected $ticketRepository;
    protected $movieRepository;

    public function __construct() {
        $ticketRepository = new TicketRepository();
        $this->ticketRepository = $ticketRepository;
        $movieRepository = new MovieRepository();
        $this->movieRepository = $movieRepository;
    }

    public function getAllTickets() {
        return $this->ticketRepository->all();
    }

    public function getTicketById($id) {
        return $this->ticketRepository->ticketById($id);
    }

    public function getAllMovies() {
        return $this->movieRepository->all();
    }

}