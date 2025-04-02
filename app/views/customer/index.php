<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Customer Page</title>
    <link rel="shortcut icon" href="<?= BASEURL ?>/public/assets/img/icon/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASEURL ?>/public/assets/css/home.css">
    <script src="<?= BASEURL ?>/public/assets/js/home.js"></script>
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
            <div class="relative">
                <img alt="A large cinema screen with an audience watching a movie" class="w-full h-64 object-cover rounded-lg shadow-lg" height="400" src="http://localhost/cinnamon/public/assets/img/banner-cinema.jpg" width="1200" />
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <h1 class="text-4xl text-white font-bold text-center">
                        Welcome to Cinnamon
                    </h1>
                </div>
            </div>
        </section>
        <section class="mb-12">
            <h1 class="text-3xl font-bold mb-6 text-center">Special Promos That Are Still Remaining</h1>
            <div class="banner-container">
                <button class="arrow arrow-left" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></button>
                <div class="banner-slide">
                    <?php
                    $promotion = $data['promotion'];
                    foreach ($promotion as $promo) : ?>
                        <div class="banner-item bg-white shadow-lg rounded-lg p-6 flex items-center justify-center gap-x-10">
                            <div class="pattern"></div>
                            <div class="content">
                                <h2 class="text-3xl font-bold mb-2 text-blue-600"><?= $promo['discount_percentage'] ?>% Off Tickets <?= $promo['title'] ?></h2>
                            </div>
                            <div class="content-right">
                                <p class="text-gray-700 mb-4"><?= $promo['note'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button class="arrow arrow-right" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></button>
        </section>
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">
                Top Movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $movies = $data['movies'];
                $movies_to_show = array_slice($movies, 0, 3);
                foreach ($movies_to_show as $movie) : ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img alt="Movie poster with a dramatic scene of a hero standing against a sunset" class="w-full h-64 bg-cover bg-center" src="<?php echo BASEURL . 'public/' . $movie['poster'] ?>" width="300" />
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">
                                <?= $movie['title'] ?>
                            </h3>
                            <p class="text-gray-700 mb-4">
                                <?= $movie['description'] ?>
                            </p>
                            <a class="text-indigo-600 hover:text-indigo-800" href="#">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">
                Upcoming Movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $comings = $data['coming'];
                $comings_to_show = array_slice($comings, 0, 3);
                foreach ($comings_to_show as $coming) : ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img alt="Movie poster with a futuristic cityscape" class="w-full h-64 bg-cover bg-center" src="<?php echo BASEURL . 'public/' . $coming['poster'] ?>" width="300" />
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">
                                <?= $coming['title'] ?>
                            </h3>
                            <p class="text-gray-700 mb-4">
                                <?= $coming['description'] ?>
                            </p>
                            <a class="text-indigo-600 hover:text-indigo-800" href="#">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
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
</body>
<script src="<?= BASEURL ?>public/assets/js/home.js"></script>

</html>