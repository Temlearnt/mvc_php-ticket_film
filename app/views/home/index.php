<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinnamon</title>
    <link rel="shortcut icon" href="<?= BASEURL ?>/public/assets/img/icon/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASEURL ?>/public/assets/css/loading.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Loading Animation -->
    <div id="loading">
        <div class="ticket"></div>
        <p class="ml-4 text-lg">Getting ready for showtime...</p>
    </div>

    <!-- Sticky Header -->
    <header class="bg-gray-900 text-white sticky top-0 z-40 shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="text-2xl font-bold">
                Cinnamon
            </div>
            <nav class="hidden md:flex space-x-4">
                <a class="hover:text-gray-400" href="#home">Home</a>
                <a class="hover:text-gray-400" href="#now-showing">Top Movies</a>
                <a class="hover:text-gray-400" href="#coming-soon">Coming Soon</a>
                <a class="hover:text-gray-400" href="#theaters">Theaters</a>
                <a class="hover:text-gray-400" href="#promotions">Promotions</a>
                <a class="hover:text-gray-400" href="<?= BASEURL ?>auth/login" id="login-btn">Login</a>
            </nav>
            <div class="md:hidden">
                <button id="menu-toggle" class="focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800">
            <nav class="flex flex-col space-y-2 py-4 px-6">
                <a class="hover:text-gray-400" href="#home">Home</a>
                <a class="hover:text-gray-400" href="#now-showing">Top Movies</a>
                <a class="hover:text-gray-400" href="#coming-soon">Coming Soon</a>
                <a class="hover:text-gray-400" href="#theaters">Theaters</a>
                <a class="hover:text-gray-400" href="#promotions">Promotions</a>
                <a class="hover:text-gray-400" href="." id="mobile-login-btn">Login</a>
            </nav>
        </div>
    </header>

    <!-- Main Sections -->
    <main>
        <!-- Home Section -->
        <section id="home" class="relative bg-cover bg-center h-screen flex items-center justify-center text-white" style="background-image: url('<?= BASEURL ?>/public/assets/img/banner-cinema.jpg');">
            <!-- Overlay for opacity effect -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <!-- Content -->
            <div class="relative z-10 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Cinnamon</h1>
                <p class="text-xl md:text-2xl mb-6">Your favorite movies, in the best theaters</p>
                <a href="#now-showing" class="bg-blue-500 px-6 py-3 text-lg rounded hover:bg-blue-600 transition">
                    Book Now
                </a>
            </div>
        </section>


        <!-- Now Showing Section -->
        <section id="now-showing" class="py-12">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold mb-6 text-center">Top Movies</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Example movie -->
                    <?php
                    $movies = $data['movies'];
                    foreach ($movies as $movie) : ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-2">
                            <img src="<?php echo BASEURL . 'public/' . $movie['poster'] ?>" alt="Movie Poster" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2"><?= $movie['title'] ?></h3>
                                <p class="text-gray-700 mb-4"><?= $movie['description'] ?></p>
                                <a href="<?= BASEURL ?>auth/login" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block text-center">
                                    Book Now
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Coming Soon Section -->
        <section id="coming-soon" class="bg-gray-200 py-12">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold mb-6 text-center">Coming Soon</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Example movie -->
                    <?php
                    $coming = $data['coming'];
                    foreach ($coming as $soon) : ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:-translate-y-2">
                            <img src="<?php echo BASEURL . 'public/' . $soon['poster'] ?>" alt="Movie Poster" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2"><?= $soon['title'] ?></h3>
                                <p class="text-gray-700 mb-4"><?= $soon['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Theaters Section -->
        <section id="theaters" class="py-12">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold mb-6 text-center">Our Theaters</h2>
                <p class="text-center mb-6 text-gray-700">Find the best Cinema XXI locations near you.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Example theater -->
                    <?php
                    $theaters = $data['theater'];
                    foreach ($theaters as $theater) : ?>
                        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg">
                            <h3 class="text-xl font-bold mb-2"><?= $theater['name'] ?></h3>
                            <p class="text-gray-700 mb-4">Location: <?= $theater['location'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Promotions Section -->
        <section id="promotions" class="bg-gray-200 py-12">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold mb-6 text-center">Promotions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    $promotion = $data['promotion'];
                    foreach ($promotion as $promo) : ?>
                        <!-- Example promotion -->
                        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg">
                            <h3 class="text-xl font-bold mb-2"><?= $promo['discount_percentage'] ?>% Off Tickets</h3>
                            <p class="text-gray-700 mb-4"><?= $promo['note'] ?></p>
                            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Learn More
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p> © 2025 Cinnamon. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            // Hide loading spinner after page loads
            setTimeout(function() {
                $('#loading').fadeOut(500);
            }, 1000);

            // Mobile menu toggle
            $('#menu-toggle').on('click', function() {
                $('#mobile-menu').slideToggle();
            });

            // Smooth scrolling
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 800);
                }
            });
        });
    </script>

</body>

</html>