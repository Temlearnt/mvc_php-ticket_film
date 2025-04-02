<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Customer Page</title>
    <link rel="shortcut icon" href="<?= BASEURL ?>/public/assets/img/icon/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    </link>
</head>

<body class="font-roboto bg-gray-100">
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
    <?php
    $descMovie = $data['book'];
    ?>
    <main class="container mx-auto py-8 px-6 mt-20">
        <section class="mb-12">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h1 class="text-3xl font-bold mb-4 md:mb-0">
                    Book Your Movie
                </h1>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex flex-col md:flex-row">
                    <img alt="Movie poster with a dramatic scene of a hero standing against a sunset" class="w-full md:w-1/3 h-100 object-cover rounded-lg mb-4 md:mb-0" height="400" src="<?php echo BASEURL . 'public' . $descMovie[0]['poster'] ?>" width="300" />
                    <div class="md:ml-6 flex-1">
                        <h2 class="text-2xl font-bold mb-4">
                            <?= $descMovie[0]['title'] ?>
                        </h2>
                        <p class="text-gray-700 mb-4">
                            <?= $descMovie[0]['description'] ?>
                        </p>
                        <form method="POST" id="bookingForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="location">
                                    Select Location
                                </label>
                                <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" id="location" name="location">
                                <option value="" selected>-- Select Location --</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="time">Select Schedule</label>
                                <select class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" id="time" name="time" disabled>
                                    <option value="" disabled selected>-- Select Schedule --</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="seats">
                                    Number of Seats
                                </label>
                                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" id="seats" max="10" min="1" name="seats" id="seats" type="number" />
                            </div>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300" type="submit">
                                Choose Your Seats
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p>
                © 2025 Cinnamon. All rights reserved.
            </p>
        </div>
    </footer>
    <?php
    // Mengencode data ke format JSON
    $encodedData = json_encode($descMovie);
    // Enkripsi data dengan base64
    $encryptedData = base64_encode($encodedData); // Base64 encoding untuk menyembunyikan data
    // Mengirim data terenkripsi ke halaman
    $id = $_GET['data'];
    ?>
    <script>
         function toggleDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
        }
        // Mengambil data yang sudah dienkripsi dari PHP
        const scheduleDataEncrypted = "<?php echo $encryptedData; ?>";

        // Dekripsi data menggunakan atob (decoding Base64) dan parsing JSON
        const scheduleData = JSON.parse(atob(scheduleDataEncrypted));
        const URLId = "<?php echo $id; ?>";

        // Lanjutkan menggunakan data jadwal seperti sebelumnya
        const locationDropdown = document.getElementById('location');
        const timeDropdown = document.getElementById('time');

        // Ambil daftar lokasi unik dari data
        const locations = [...new Set(scheduleData.map(schedule => schedule.location))];

        // Isi dropdown lokasi
        locationDropdown.innerHTML += locations
            .map(location => `<option value="${location}">${location}</option>`)
            .join('');

        // Event untuk perubahan lokasi
        locationDropdown.addEventListener('change', () => {
            const selectedLocation = locationDropdown.value;

            // Jika tidak ada lokasi yang dipilih, sembunyikan dropdown waktu dan reset isinya
            if (!selectedLocation) {
                timeDropdown.disabled = true;
                timeDropdown.innerHTML = '<option value="" disabled selected>-- Select Schedule --</option>';
                return;
            }

            // Filter jadwal berdasarkan lokasi yang dipilih
            const schedules = scheduleData.filter(schedule => schedule.location === selectedLocation);

            // Isi dropdown jadwal dengan tanggal dan waktu
            if (schedules.length > 0) {
                timeDropdown.innerHTML = schedules
                    .map(schedule => {
                        const showDateTime = `${schedule.show_time}`;
                        return `<option value="${schedule.schedule_id}">${schedule.name} - ${showDateTime}</option>`;
                    })
                    .join('');
                timeDropdown.disabled = false; // Enable the time dropdown if there are schedules
            } else {
                timeDropdown.innerHTML = '<option value="" disabled>No schedule available</option>';
                timeDropdown.disabled = false; // Still enable the dropdown but show no schedule message
            }
        });

        let currentId = parseInt(localStorage.getItem('currentId')) || 0;

        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            const location = document.getElementById('location').value;
            const timeDropdown = document.getElementById('time');
            const scheduleId = timeDropdown.value; // Ambil schedule_id dari dropdown
            const numberSeats = document.getElementById('seats').value;
            const movieId = scheduleData[0].movie_id; // Ambil movie_id dari data yang sudah didekripsi

            // Variabel untuk menyimpan ID terakhir

            // Fungsi untuk menghasilkan ID baru
            function generateNewId() {
                currentId++; // Meningkatkan ID
                localStorage.setItem('currentId', currentId); // Simpan ID baru ke localStorage
                return currentId; // Mengembalikan ID yang baru
            }

            // Data yang akan dikirim
            const bookingData = {
                id: generateNewId(),
                schedule_id: scheduleId,
                movie_id: movieId,
                number_seats: numberSeats
            };

            fetch('<?= BASEURL ?>customer/book?data=' + URLId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(bookingData),
                })
                .then((response) => {
                    console.log(response); // Debugging respons
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text(); // Ambil teks mentah
                })
                .then((text) => {
                    try {
                        const data = JSON.parse(text); // Parsing JSON
                        if (data.status === 'success') {
                            window.location.href = '<?= BASEURL ?>customer/seats?data=' + data.id;
                        } else {
                            alert(data.message);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error, text); // Log respons mentah untuk analisis
                        alert('Unexpected server response. Please try again.');
                    }
                })
                .catch((error) => {
                    console.error('Fetch error:', error);
                    alert('An error occurred. Please try again.');
                });
        });

        // Toggle mobile menu visibility
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>

</html>