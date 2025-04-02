-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2025 pada 14.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_ticket_film`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `duration_minutes` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `rating` float(2,1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster` varchar(255) NOT NULL,
  `age_range` enum('SU','PG','R13+','D18+','D21+') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre`, `duration_minutes`, `release_date`, `rating`, `description`, `poster`, `age_range`, `created_at`) VALUES
(1, 'Inception', 'Sci-Fi', 148, '2010-07-16', 8.8, 'A mind-bending thriller about dream manipulation.', '/assets/img/movies/interception.jpg', 'SU', '2024-12-21 03:39:18'),
(2, 'The Godfather', 'Crime', 175, '1972-03-24', 9.2, 'The aging patriarch of an organized crime dynasty transfers control to his reluctant son.', '/assets/img/movies/godfather.jpg', 'SU', '2024-12-21 03:39:18'),
(3, 'The Dark Knight', 'Action', 152, '2008-07-18', 9.0, 'Batman faces the Joker, a criminal mastermind who seeks to create chaos in Gotham City.', '/assets/img/movies/darkknight.jpg', 'SU', '2024-12-23 18:27:20'),
(4, 'The Matrix', 'Action', 136, '1999-03-31', 8.7, 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', '/assets/img/movies/matrix.jpg', 'SU', '2024-12-23 18:27:20'),
(5, 'Gladiator', 'Action', 155, '2000-05-05', 8.5, 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.', '/assets/img/movies/gladiator.jpeg', 'SU', '2024-12-23 18:27:20'),
(6, 'Interstellar', 'Sci-Fi', 169, '2014-11-07', 8.6, 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', '/assets/img/movies/interstlellar.jpg', 'SU', '2024-12-23 18:27:20'),
(7, 'The Prestige', 'Drama', 130, '2006-10-20', 8.5, 'Two magicians engage in a bitter rivalry, each trying to best the other in their quest to create the ultimate stage illusion.', '/assets/img/movies/prestige.jpg', 'SU', '2024-12-23 18:27:20'),
(8, 'Ambawick2', 'Action', 200, '2025-01-10', 0.0, 'It\'s a film from the early two thousands about a guy named ambawick.', '/assets/img/movies/ambawick2.jpg', 'SU', '2024-12-28 07:24:00'),
(11, 'Ambatukam', 'Historical', 100, '2025-02-21', 0.0, 'Documentary about the viral meme, Ambatukam and a series of related zoom bombings.', '/assets/img/movies/ambatukam.jpg', 'SU', '2024-12-29 06:25:02'),
(12, 'Ambaratos', 'Action', 100, '2025-03-20', 0.0, 'Kisah perjalanan berat ambaratos demi setetes muani', '/assets/img/movies/ambaratos.jpg', 'SU', '2024-12-29 06:33:09'),
(13, 'Ambaman', 'Hero', 100, '2025-06-29', 0.0, 'The story of the superhero who saves the earth, namely Ambaman', '/assets/img/movies/ambaman.jpg', 'SU', '2024-12-29 06:35:10'),
(15, 'Tiyas', 'Romance', 200, '2025-03-10', 0.0, 'Tiara and Ilyas', '/assets/img/movies/movie1.png', 'SU', '2024-12-30 08:31:45'),
(16, 'Ambatron and Rusdi', 'Action', 100, '2025-01-01', 8.0, 'Ambatron with Rusdi', '/assets/img/movies/ambatron.jpg', 'SU', '2025-01-02 03:18:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `payment_method` enum('credit_card','debit_card','e_wallet','cash') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `ticket_id`, `payment_method`, `amount`, `payment_status`, `payment_time`) VALUES
(1, 1, 'credit_card', 50000.00, 'completed', '2024-12-21 03:39:19'),
(2, 2, 'e_wallet', 60000.00, 'completed', '2024-12-21 03:39:19'),
(11, 7, 'e_wallet', 135000.00, 'completed', '2025-01-01 15:20:18'),
(12, 8, 'debit_card', 90000.00, 'completed', '2025-01-02 03:02:46'),
(13, 9, 'credit_card', 225000.00, 'pending', '2025-01-02 05:46:16'),
(14, 10, 'e_wallet', 350000.00, 'pending', '2025-01-02 14:50:59'),
(15, 11, 'debit_card', 80000.00, 'pending', '2025-01-05 03:31:05'),
(16, 12, 'e_wallet', 150000.00, 'pending', '2025-01-05 11:18:36'),
(17, 15, 'credit_card', 150000.00, 'pending', '2025-01-05 11:28:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `discount_percentage` int(11) DEFAULT NULL CHECK (`discount_percentage` between 0 and 100),
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `promotions`
--

INSERT INTO `promotions` (`id`, `movie_id`, `discount_percentage`, `start_date`, `end_date`, `note`) VALUES
(2, 2, 10, '2024-12-10', '2024-12-20', 'Midweek Madness: 10% off on selected movies.'),
(3, 1, 10, '2025-01-01', '2025-01-30', 'Special New Year 2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `show_time` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `movie_id`, `theater_id`, `show_time`, `price`) VALUES
(1, 1, 1, '2025-01-22 19:00:00', 50000.00),
(2, 2, 2, '2025-01-22 20:00:00', 60000.00),
(3, 6, 1, '2025-01-15 13:00:00', 50000.00),
(4, 5, 1, '2025-01-15 13:00:00', 50000.00),
(6, 4, 4, '2025-01-20 18:00:00', 70000.00),
(7, 2, 5, '2025-01-21 21:00:00', 55000.00),
(8, 1, 4, '2025-01-22 14:00:00', 50000.00),
(9, 3, 2, '2025-01-23 16:00:00', 60000.00),
(10, 16, 3, '2025-01-29 22:03:00', 40000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `theaters`
--

CREATE TABLE `theaters` (
  `theater_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `theaters`
--

INSERT INTO `theaters` (`theater_id`, `name`, `location`, `created_at`) VALUES
(1, 'Cinema XXI', 'Jakarta', '2024-12-21 03:39:18'),
(2, 'CGV Blitz', 'Bandung', '2024-12-21 03:39:18'),
(3, 'Plaza Indonesia Theater', 'Jakarta', '2024-12-22 08:30:45'),
(4, 'Empire XXI', 'Surabaya', '2024-12-23 01:20:10'),
(5, 'Mega Cinema', 'Medan', '2024-12-24 05:45:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `schedule_id`, `user_id`, `seat_number`, `booking_time`) VALUES
(1, 1, 2, 'A1', '2024-12-21 03:39:19'),
(2, 2, 2, 'B1', '2024-12-21 03:39:19'),
(6, 8, 2, 'B3,B2,B1', '2025-01-01 15:16:00'),
(7, 8, 2, 'A1,A2,A3', '2025-01-01 15:20:18'),
(8, 8, 2, 'A4,A5', '2025-01-02 03:02:46'),
(9, 8, 2, 'A4,B3,B4,B', '2025-01-02 05:46:16'),
(10, 6, 2, 'A1,B2,C3,D', '2025-01-02 14:50:54'),
(11, 10, 2, 'E5,E6', '2025-01-05 03:31:04'),
(12, 8, 1, 'B1,B2,B3', '2025-01-05 11:18:36'),
(13, 8, 1, 'E4,E6,E5', '2025-01-05 11:19:40'),
(14, 8, 1, 'E4,E6,E5', '2025-01-05 11:28:14'),
(15, 8, 1, 'E4,E6,E5', '2025-01-05 11:28:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$fGthTCGfo78GPKKRkrUqFO5jLUv03TeeYsw.oq6UVPFYFlLjZvU.S', 'admin', '2024-12-21 03:36:35'),
(2, 'John Doe', 'john.doe@example.com', '$2y$10$RFA14JUPJQHEh4sTsztbi.15vmRLPrBgJ234VlCt/DD3Clnt2TWja', 'customer', '2024-12-21 03:36:35'),
(4, 'Jarvis Scott', 'jarvisscott@gmail.com', '$2y$10$1E7v06JJFvBq4n8Xg6/WOu9AUhDUwHEMGUtDKNcvCLGw2krqe8AZi', 'customer', '2025-01-04 05:19:26'),
(5, 'Carlos Scott', 'carlos.scott@example.com', '$2y$10$sjTydYrflHhGVZHIFKgidug81Z0En4HpBwAZIZPVelQkPrJrM6VYO', 'customer', '2025-01-04 05:20:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indeks untuk tabel `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `theater_id` (`theater_id`);

--
-- Indeks untuk tabel `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`theater_id`);

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `theaters`
--
ALTER TABLE `theaters`
  MODIFY `theater_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`theater_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
