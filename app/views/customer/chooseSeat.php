<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Page</title>
  <link rel="shortcut icon" href="<?= BASEURL ?>/public/assets/img/icon/logo.png" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
  <style>
    .seat-container .flex {
      margin-bottom: 1rem;
      /* Jarak antar baris */
    }

    .seat-container .seat {
      width: 48px;
      height: 48px;
    }
  </style>

</head>

<body class="bg-gray-100 font-roboto flex flex-col min-h-screen">
  <header class="bg-gray-900 text-white fixed w-full z-10 top-0 shadow">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
      <div class="text-2xl font-bold">
        <button class="md:hidden" onclick="toggleMenu()">
          <i class="fas fa-bars"></i>
        </button>
        <span class="hidden md:inline">Cinnamon</span>
      </div>
      <nav class="hidden md:flex space-x-6">
        <ul class="flex space-x-6">
          <li><a class="hover:text-gray-400" href="<?= BASEURL ?>customer/index">Home</a></li>
          <li><a class="hover:text-gray-400" href="<?= BASEURL ?>customer/movies">Movies</a></li>
          <li><a class="hover:text-gray-400" href="<?= BASEURL ?>customer/ticket">Tickets</a></li>
        </ul>
      </nav>
      <div class="relative flex items-center space-x-4">
        <img alt="Profile logo with a generic user icon" class="w-10 h-10 rounded-full cursor-pointer" height="100" src="https://storage.googleapis.com/a1aa/image/rdJcZVhjeHzddqjhxgo9aeSCFbOMG6o7gjehU8fDj5lcJaffE.jpg" width="100" onclick="toggleDropdown()" />
        <div id="profile-dropdown" class="hidden absolute right-0 mt-24 bg-white text-black shadow-lg rounded-lg py-2 w-48 border border-gray-200">
          <a href="<?= BASEURL ?>auth/logout" class="block px-4 py-2 hover:bg-gray-100 text-sm">Logout</a>
        </div>
      </div>
    </div>
    <div class="md:hidden">
      <ul class="hidden" id="mobile-menu">
        <li class="py-2 px-4 border-t border-gray-700"><a class="hover:text-gray-400" href="<?= BASEURL ?>customer/index">Home</a></li>
        <li class="py-2 px-4 border-t border-gray-700"><a class="hover:text-gray-400" href="<?= BASEURL ?>customer/movies">Movies</a></li>
        <li class="py-2 px-4 border-t border-gray-700"><a class="hover:text-gray-400" href="<?= BASEURL ?>customer/ticket">Tickets</a></li>
      </ul>
    </div>
  </header>

  <main class="container mx-auto mt-20 py-8 px-6 flex-grow">
    <h1 class="text-3xl font-bold text-center mb-6">Choose Your Seats</h1>
    <?php
    // Array untuk semua kursi yang sudah terisi
    $occupiedSeats = [];

    // Iterasi setiap item dalam $data['seats']
    foreach ($data['seats'] as $seat) {
      $seatsArray = explode(',', $seat['seat_number']);
      $occupiedSeats = array_merge($occupiedSeats, $seatsArray);
    }
    ?>

    <div class="screen bg-gray-300 text-center py-2 rounded-lg text-lg font-semibold mb-8">Cinema Screen</div>

    <div id="seat-container" class="space-y-4 mb-8" style="grid-template-columns: repeat(auto-fit, minmax(40px, 1fr));"></div>

    <div class="legend flex flex-wrap justify-center gap-8 mb-8">
      <div class="flex items-center gap-2">
        <span class="w-5 h-5 bg-green-500 rounded"></span>
        <span>Tersedia</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="w-5 h-5 bg-blue-500 rounded"></span>
        <span>Dipilih</span>
      </div>
      <div class="flex items-center gap-2">
        <span class="w-5 h-5 bg-red-500 rounded"></span>
        <span>Terisi</span>
      </div>
    </div>

    <div class="text-center">
      <button id="proceed-btn" class="bg-blue-500 text-white px-6 py-2 rounded disabled:bg-gray-300 disabled:cursor-not-allowed">Lanjut</button>
    </div>
  </main>

  <footer class="bg-gray-900 text-white py-4">
    <div class="container mx-auto text-center">
      <p>© 2025 Cinnamon. All rights reserved.</p>
    </div>
  </footer>

  <?php
  $book = $data['book'];
  $URLId = $book['id'];
  $id = $_GET['data'];

  ?>

  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('profile-dropdown');
      dropdown.classList.toggle('hidden');
    }
    const seatContainer = document.getElementById('seat-container');
    const proceedBtn = document.getElementById('proceed-btn');
    const totalSeatsToSelect = <?php echo intval($book['details']['number_seats']); ?>;
    const URLId = "<?php echo $id; ?>";
    const occupiedSeats = <?php echo json_encode($occupiedSeats); ?>; // Kursi yang terisi (warna merah)
    let selectedSeats = [];

    const rows = 'ABCDEFGHIJ';
    const cols = 10;

    // Buat kursi per baris
    rows.split('').forEach(row => {
      const rowDiv = document.createElement('div');
      rowDiv.classList.add('flex', 'justify-center', 'gap-2'); // Menggunakan Flexbox untuk setiap baris

      for (let c = 1; c <= cols; c++) {
        const seatId = `${row}${c}`;
        const seatDiv = document.createElement('div');

        seatDiv.classList.add(
          'seat',
          'w-12',
          'h-12',
          'border-2',
          'rounded',
          'flex',
          'items-center',
          'justify-center',
          'cursor-pointer',
          'transition',
          'transform',
          'hover:scale-110'
        );

        if (occupiedSeats.includes(seatId)) {
          seatDiv.classList.add('bg-red-500'); // Kursi terisi
        } else {
          seatDiv.classList.add('bg-green-500'); // Kursi tersedia
        }
        seatDiv.innerText = seatId;

        seatDiv.addEventListener('click', () => {
          if (seatDiv.classList.contains('bg-red-500')) return; // Jangan lakukan apa pun jika kursi terisi.

          if (seatDiv.classList.contains('bg-blue-500')) {
            // Batalkan pemilihan kursi
            seatDiv.classList.replace('bg-blue-500', 'bg-green-500');
            selectedSeats = selectedSeats.filter(seat => seat !== seatId);
          } else if (selectedSeats.length < totalSeatsToSelect) {
            // Pilih kursi baru
            seatDiv.classList.replace('bg-green-500', 'bg-blue-500');
            selectedSeats.push(seatId);
          }

          // Aktifkan atau nonaktifkan tombol "Lanjut"
          proceedBtn.disabled = selectedSeats.length !== totalSeatsToSelect;
        });

        rowDiv.appendChild(seatDiv);
      }

      seatContainer.appendChild(rowDiv); // Tambahkan baris ke kontainer utama
    });


    proceedBtn.addEventListener('click', () => {
      const bookingData = {
        id: URLId, // Ganti dengan ID yang sesuai
        selectedSeats: selectedSeats // Array kursi terpilih
      };

      fetch('<?= BASEURL ?>customer/seats?data=' + URLId, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(bookingData),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            window.location.href = '<?= BASEURL ?>customer/payment?data=' + URLId;
          } else {
            alert(data.message);
          }
        })
        .catch(error => console.error('Error:', error));
    });

    function toggleMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
  </script>
</body>

</html>