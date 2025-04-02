<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="shortcut icon" href="<?= BASEURL ?>/public/assets/img/icon/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <?php
            $ticket = $data['payments'];
            $user = $data['user'];
            ?>
            <div class="ticket mx-auto max-w-md border-2 border-dashed border-gray-300 bg-gray-50 p-6 shadow">
                <div class="ticket-header text-center mb-4">
                    <h1 class="text-2xl font-bold text-orange-600">CINNAMON CINEMA</h1>
                </div>
                <div class="ticket-body space-y-3">
                    <div class="ticket-info flex justify-between">
                        <span class="font-bold">Movie:</span>
                        <span><?= $ticket[0]['title'] ?></span>
                    </div>
                    <div class="ticket-info flex justify-between">
                        <span class="font-bold">Schedule:</span>
                        <span><?= $ticket[0]['show_time'] ?></span>
                    </div>
                    <div class="ticket-info flex justify-between">
                        <span class="font-bold">Location:</span>
                        <span><?= $ticket[0]['name'] ?> - <?= $ticket[0]['location'] ?></span>
                    </div>
                    <div class="ticket-info flex justify-between">
                        <span class="font-bold">Booking Time:</span>
                        <span><?= $ticket[0]['booking_time'] ?></span>
                    </div>
                    <div class="ticket-info flex justify-between">
                        <span class="font-bold">Seats:</span>
                        <span><?= $ticket[0]['seat_number'] ?></span>
                    </div>
                    <div class="ticket-info flex justify-between">
                        <span class="font-bold">Name:</span>
                        <span><?= $user['name'] ?></span>
                    </div>
                </div>
                <div class="ticket-footer text-center mt-4">
                    <div class="barcode-container flex justify-center items-center mb-4">
                        <svg id="barcode"></svg>
                    </div>
                    <p class="text-gray-700">Enjoy Your Movie!</p>
                </div>
            </div>
            <div class="text-center mt-6">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700" onclick="downloadTicket()">
                    Download Ticket
                </button>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p>© 2025 Cinnamon. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
        }
        // Generate barcode
        JsBarcode("#barcode", "<?php echo 'TCKT' . '-CNM-' . $ticket[0]['ticket_id'] ?>", {
            format: "CODE128",
            lineColor: "#000",
            width: 2,
            height: 50,
            displayValue: true
        });

        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function downloadTicket() {
            const ticketContent = document.querySelector('.ticket');

            html2pdf()
                .from(ticketContent)
                .set({
                    margin: 1,
                    filename: 'ticket.pdf',
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                })
                .save()
                .catch(error => {
                    console.error("Error generating PDF:", error);
                });
        }
    </script>
</body>

</html>