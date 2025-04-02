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
                <h1 class="text-3xl font-bold mb-4 md:mb-0">Movies</h1>
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <input type="text" id="search" oninput="filterMovies()" placeholder="Search..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Search</button>
                </div>
            </div>
            <div id="movie-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Movie 1 -->
                <?php
                $movies = $data['movies'];
                $color = '';
                foreach ($movies as $movie) :
                    switch ($movie['age_range']) {
                        case 'SU':
                            $colorClass = 'text-green-500';
                            break;
                        case 'PG':
                            $colorClass = 'text-blue-500';
                            break;
                        case 'R13+':
                            $colorClass = 'text-yellow-500';
                            break;
                        case 'D18+':
                            $colorClass = 'text-orange-500';
                            break;
                        case 'D21+':
                            $colorClass = 'text-red-500';
                            break;
                        default:
                            $colorClass = 'text-red-500';
                            break;
                    }
                    if ($movie['schedule_id'] !== NULL) :
                ?>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden relative movie-item">
                            <img alt="Movie poster with a dramatic scene of a hero standing against a sunset" class="w-full h-64 bg-cover bg-center" height="400" src="<?php echo BASEURL . 'public/' . $movie['poster'] ?>" width="300" />
                            <div class="absolute top-0 left-0">
                                <div class="text-sm bg-gradient-to-r from-green-500 to-teal-500 text-white font-bold px-2 py-1 rounded">
                                    Avalaible
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex mb-2">
                                    <h3 class="text-xl font-bold mr-2"><?= $movie['title'] ?></h3>
                                    <span class="font-bold <?= $colorClass ?> text-lg"><?= $movie['age_range'] ?></span>
                                </div>
                                <p class="text-gray-700 mb-4"><?= $movie['description'] ?></p>
                                <?php
                                $hashId = hash('sha256', $movie['movie_id']);
                                ?>
                                <a class="text-indigo-600 hover:text-indigo-800" href="<?= BASEURL; ?>customer/book?data=<?= urlencode($hashId) ?>">Book Now</a>
                            </div>
                        </div>
                        <?php
                    else :
                        if (strtotime($movie['release_date']) <= strtotime(date('Y-m-d'))) :
                        ?>
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden relative movie-item">
                                <img alt="Movie poster with a dramatic scene of a hero standing against a sunset" class="w-full h-64 bg-cover bg-center" height="400" src="<?php echo BASEURL . 'public/' . $movie['poster'] ?>" width="300" />
                                <div class="absolute top-0 left-0">
                                    <div class="text-sm bg-gradient-to-r from-red-500 to-teal-500 text-white font-bold px-2 py-1 rounded">
                                        Not Avalaible
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex mb-2">
                                        <h3 class="text-xl font-bold mr-2"><?= $movie['title'] ?></h3>
                                        <span class="font-bold <?= $colorClass ?> text-lg"><?= $movie['age_range'] ?></span>
                                    </div>
                                    <p class="text-gray-700 mb-4"><?= $movie['description'] ?></p>
                                    <?php
                                    $hashId = hash('sha256', $movie['movie_id']);
                                    ?>
                                </div>
                            </div>
                        <?php
                        else :
                        ?>
                            <!-- Coming Soon 1 -->
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden relative movie-item">
                                <img alt="Movie poster with a futuristic cityscape" class="w-full h-64 bg-cover bg-center opacity-50" height="400" src="<?php echo BASEURL . 'public/' . $movie['poster'] ?>" width="300" />
                                <div class="absolute top-0 left-0">
                                    <div class="text-sm bg-gradient-to-r from-blue-500 to-teal-500 text-white font-bold px-2 py-1 rounded">
                                        Coming Soon
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex mb-2">
                                        <h3 class="text-xl font-bold mr-2"><?= $movie['title'] ?></h3>
                                        <span class="font-bold <?= $colorClass ?> text-lg"><?= $movie['age_range'] ?></span>
                                    </div>
                                    <p class="text-gray-700 mb-4"><?= $movie['title'] ?></p>
                                </div>
                            </div>
                <?php
                        endif;
                    endif;
                endforeach;
                ?>
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

        // Filter movies based on search input
        function filterMovies() {
            const searchQuery = document.getElementById("search").value.toLowerCase();
            const movieItems = document.querySelectorAll(".movie-item");

            movieItems.forEach(item => {
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