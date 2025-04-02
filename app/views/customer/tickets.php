<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Customer Page</title>
    <link rel="shortcut icon" href="<?= BASEURL ?>/public/assets/img/icon/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
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
    <main class="container mx-auto py-8 px-6 mt-20">
        <section class="mb-12">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h1 class="text-3xl font-bold mb-4 md:mb-0">Ticket History</h1>
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <input type="text" id="search" oninput="filterTickets()" placeholder="Search..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Search</button>
                </div>
            </div>
            <div id="ticket-list" class="space-y-6">
                <?php
                foreach ($data['tickets'] as $ticket) :
                ?>
                    <!-- Ticket 1 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden relative ticket-item flex flex-col md:flex-row">
                        <img alt="Movie poster with a dramatic scene of a hero standing against a sunset" class="w-full md:w-1/3 h-64 object-cover" height="400" src="<?php echo BASEURL . 'public/' . $ticket['poster'] ?>" width="300" />
                        <div class="p-4 flex-1">
                            <div class="flex flex-col md:flex-row justify-between mb-2">
                                <h3 class="text-xl font-bold mr-2"><?= $ticket['title'] ?></h3>
                                <?php
                                $color = '';
                                if ($ticket['payment_status'] == 'completed') {
                                    $color = 'text-green-500';
                                } elseif ($ticket['payment_status'] == 'pending') {
                                    $color = 'text-orange-500';
                                } else {
                                    $color = 'text-red-500';
                                }
                                ?>
                                <span class="font-bold <?= $color ?> text-lg"><?= $ticket['payment_status'] ?></span>
                            </div>
                            <p class="text-gray-700 mb-2">Seats: <?= $ticket['seat_number'] ?></p>
                            <p class="text-gray-700 mb-2">Amount: <?= "Rp. " . number_format($ticket['amount'], 2, ',', '.') ?></p>
                            <p class="text-gray-700 mb-2">Schedule: <?= $ticket['show_time'] ?></p>
                            <p class="text-gray-700 mb-4">Booking Time: <?= $ticket['booking_time'] ?></p>
                            <?php
                            if ($ticket['payment_status'] == 'completed') :
                                $hashId = hash('sha256', $ticket['payment_id']);
                            ?>
                                <a class="text-indigo-600 hover:text-indigo-800" href="<?= BASEURL ?>customer/print?data=<?= urlencode($hashId) ?>">Print Ticket</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p> © 2025 Cinnamon. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle mobile menu visibility
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function toggleDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Filter tickets based on search input
        function filterTickets() {
            const searchQuery = document.getElementById("search").value.toLowerCase();
            const ticketItems = document.querySelectorAll(".ticket-item");

            ticketItems.forEach(item => {
                const title = item.querySelector("h3").textContent.toLowerCase();
                if (title.includes(searchQuery)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
</body>

</html>