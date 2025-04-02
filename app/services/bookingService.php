<?php
// src/Services/MovieService.php
namespace App\Services;

use App\Repositories\ScheduleRepository;
use App\Repositories\TicketRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\BookingRepository;


class BookingService
{
    protected $scheduleRepository;
    protected $ticketRepository;
    protected $promotionRepository;
    protected $paymentRepository;
    protected $bookingRepository;


    public function __construct()
    {
        $scheduleRepository = new ScheduleRepository();
        $this->scheduleRepository = $scheduleRepository;
        $ticketRepository = new TicketRepository();
        $this->ticketRepository = $ticketRepository;
        $promotionRepository = new PromotionRepository();
        $this->promotionRepository = $promotionRepository;
        $paymentRepository = new PaymentRepository();
        $this->paymentRepository = $paymentRepository;
        $bookingRepository = new BookingRepository();
        $this->bookingRepository = $bookingRepository;
    }

    public function getPromotions($id)
    {
        return $this->promotionRepository->getPromotionByMovieId($id);
    }

    public function getSchedule($movie)
    {
        return $this->scheduleRepository->selectMovie($movie);
    }

    public function getSelectedSchedule($id)
    {
        $hashId = hash('sha256',$id);
        return $this->scheduleRepository->selectSchedule($hashId);
    }

    public function getDataBookingById($id)
    {
        return $this->bookingRepository->getBookingById($id);
    }

    public function getAllBooking()
    {
        return $this->bookingRepository->getAllBookings();
    }

    public function getSelectedSeats($id)
    {
        $hashId = hash('sha256',$id);
        return $this->paymentRepository->selectSeat($hashId);
    }

    public function saveBooking($data)
    {
        // Validasi data
        if (empty($data['schedule_id']) || empty($data['movie_id']) || empty($data['number_seats'])) {
            return ['status' => 'error', 'message' => 'All fields are required.'];
        }

        // Enkripsi ID (jika diperlukan)
        $encryptedId = base64_encode($data['id']); // Contoh enkripsi menggunakan Base64

        // Siapkan data untuk disimpan
        $bookingData = [
            'id' => $encryptedId,
            'details' => [
                'schedule_id' => $data['schedule_id'],
                'movie_id' => $data['movie_id'],
                'number_seats' => $data['number_seats']
            ]
        ];

        return $this->bookingRepository->saveBooking($bookingData);
    }

    public function saveSelectedSeats($data)
    {
        // Validasi data
        if (empty($data['id']) || empty($data['selectedSeats'])) {
            return ['status' => 'error', 'message' => 'ID and selected seats are required.'];
        }

        // Ambil data booking berdasarkan ID
        $existingBooking = $this->bookingRepository->getBookingById($data['id']);
        if (!$existingBooking) {
            return ['status' => 'error', 'message' => 'Booking not found.'];
        }

        // Perbarui data kursi terpilih
        $existingBooking['details']['number_seats'] = $data['selectedSeats'];

        // Simpan kembali data yang diperbarui
        return $this->bookingRepository->updateBooking($data['id'],$existingBooking);
    }

    public function getPromotionbyId($id)
    {
        $hashId = hash('sha256',$id);
        return $this->promotionRepository->getPromotionById($hashId);
    }

    public function insertTicket($data){
        return $this->ticketRepository->save($data);
    }

    public function insertPayment($data){
        return $this->paymentRepository->save($data);
    }

}
