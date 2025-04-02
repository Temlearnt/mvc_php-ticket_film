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
            <h1 class="text-3xl font-bold mb-6">Payment</h1>
            <form method="POST" class="bg-white p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-bold mb-2">Movie Title</label>
                    <input type="text" name="movie" value="<?php echo $data["schedule"][0]["title"] ?>" disabled id="location" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                </div>
                <div class="mb-4">
                    <label for="schedule-time" class="block text-gray-700 font-bold mb-2">Schedule Time</label>
                    <input type="datetime-local" value="<?php echo $data["schedule"][0]["show_time"] ?>" disabled id="schedule-time" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-bold mb-2">Location</label>
                    <input type="text" value="<?php echo $data["schedule"][0]["name"] . " - " . $data["schedule"][0]["location"] ?>" disabled id="location" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                </div>
                <div class="mt-8">
                    <h2 class="text-2xl font-bold mb-4">Selected Seats</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow-lg">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border-b-2 border-gray-300 text-left text-gray-700">No.</th>
                                    <th class="px-4 py-2 border-b-2 border-gray-300 text-left text-gray-700">Seat Number</th>
                                    <th class="px-4 py-2 border-b-2 border-gray-300 text-left text-gray-700">Price</th>
                                </tr>
                            </thead>
                            <tbody id="seats-table">
                                <?php
                                $numberSeats = $data["book"]["details"]["number_seats"];
                                // Pastikan $numberSeats adalah array
                                if (!is_array($numberSeats)) {
                                    $numberSeats = [$numberSeats]; // Jika bukan array, jadikan array dengan satu elemen
                                }
                                $i = 1;
                                foreach ($numberSeats as $book) :
                                    $price = $data["schedule"][0]["price"];
                                ?>
                                    <tr>
                                        <td class="px-4 py-2 border-b border-gray-300"><?= $i ?></td>
                                        <td class="px-4 py-2 border-b border-gray-300"><?= $book ?></td>
                                        <td class="px-4 py-2 border-b border-gray-300"><?= "Rp. " . number_format($price, 2, ',', '.') ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mb-4 mt-8">
                    <label for="amount" class="block text-gray-700 font-bold mb-2">Amount</label>
                    <input type="text" id="amount" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                </div>
                <div class="mb-4">
                    <label for="payment-method" class="block text-gray-700 font-bold mb-2">Payment Method</label>
                    <select name="method" id="payment-method" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="e_wallet">E-Wallet</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="voucher" class="block text-gray-700 font-bold mb-2">Voucher</label>
                    <select name="voucher" id="voucher" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="0">-- Pilih Voucher --</option>
                        <?php
                        foreach ($data['promotions'] as $promo) :
                        ?>
                            <option value="<?= $promo['id'] ?>" data-discount="<?= $promo['discount_percentage'] ?>"><?= $promo['discount_percentage'] ?>% Off - <?= $promo['note'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Book Now</button>
            </form>
        </section>
    </main>
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p> © 2025 Cinnamon. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
        }
        
        document.addEventListener("DOMContentLoaded", function() {
            const seats = <?php echo json_encode($data["book"]["details"]["number_seats"]); ?>;
            const price = <?php echo $data["schedule"][0]["price"]; ?>;
            const amountInput = document.getElementById("amount");
            const voucherSelect = document.getElementById("voucher");

            // Pastikan seats adalah array
            let seatArray = Array.isArray(seats) ? seats : [seats];

            // Hitung total amount
            let totalAmount = seatArray.length * price;

            // Format angka
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(amount);
            }

            // Set nilai awal pada input amount
            amountInput.value = formatCurrency(totalAmount);
            amountInput.disabled = true;

            // Event listener untuk voucher
            voucherSelect.addEventListener("change", function() {
                const selectedOption = this.options[this.selectedIndex];
                const discount = parseFloat(selectedOption.getAttribute('data-discount')); // Ambil nilai diskon dari atribut data

                let discountedAmount = totalAmount; // Default ke totalAmount

                if (!isNaN(discount)) {
                    discountedAmount = totalAmount - (totalAmount * (discount / 100));
                }

                amountInput.value = formatCurrency(discountedAmount); // Update amount dengan diskon
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