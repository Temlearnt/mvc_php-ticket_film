<?php

namespace App\Repositories;

class BookingRepository
{
    protected $filePath;

    public function __construct()
    {
        // Inisialisasi filePath di dalam konstruktor
        $this->filePath = $_SERVER['DOCUMENT_ROOT'] . '/cinnamon/app/config/data/bookMovie.json';
    }

    public function getAllBookings()
    {
        if (file_exists($this->filePath)) {
            return json_decode(file_get_contents($this->filePath), true);
        }
        return [];
    }

    public function getBookingById($id)
    {
        if (file_exists($this->filePath)) {
            // Ambil semua data booking
            $allBookings = json_decode(file_get_contents($this->filePath), true);

            // Dekode ID base64 yang disimpan dalam file JSON
            foreach ($allBookings as $booking) {
                // Hash ID yang telah di-decode untuk mencocokkan dengan ID yang di-hash
                $hashedId = hash('sha256', $booking['id']);

                // Bandingkan hashed ID dengan ID yang diterima melalui URL (di-hash)
                if ($hashedId === $id) {
                    return $booking; // Jika cocok, kembalikan data booking
                }
            }
        }
    }

    public function saveBooking($bookingData)
    {
        $currentData = $this->getAllBookings(); // Ambil data yang ada
        $currentData[] = $bookingData; // Tambahkan data baru
        file_put_contents($this->filePath, json_encode($currentData, JSON_PRETTY_PRINT)); // Simpan kembali ke file

        // Kembalikan status sukses dan hash ID
        $hashId = hash('sha256', $bookingData['id']);
        return ['status' => 'success', 'id' => $hashId];
    }

    public function updateBooking($id, $updatedData)
    {
        $allBookings = $this->getAllBookings();

        // Hapus data lama dengan ID yang sama
        $allBookings = array_filter($allBookings, function ($booking) use ($id) {
            $hashedId = hash('sha256', $booking['id']);
            return $hashedId !== $id; // Simpan hanya data yang tidak cocok
        });

        // Tambahkan data yang diperbarui
        $allBookings[] = $updatedData;

        // Simpan kembali data ke file JSON
        file_put_contents($this->filePath, json_encode(array_values($allBookings), JSON_PRETTY_PRINT));

        return ['status' => 'success'];
    }
}
