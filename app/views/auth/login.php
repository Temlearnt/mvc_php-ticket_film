<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - Cinnamon</title>
    <link rel="shortcut icon" href="<?=BASEURL?>/public/assets/img/icon/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?=BASEURL?>/public/assets/css/loading.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <?php if($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
    <!-- Loading Animation -->
    <div id="loading">
        <div class="ticket"></div>
        <p class="ml-4 text-lg">Getting ready for showtime...</p>
    </div>
    <?php endif;?>

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
        <div class="text-center mb-6">
            <img alt="Cinema 21 logo, a stylized film reel with the number 21 in the center" class="mx-auto mb-4" height="100" src="<?=BASEURL?>/public/assets/img/icon/logo.png" width="100" />
            <h1 class="text-2xl font-bold text-gray-800">
                Cinnamon
            </h1>
            <p class="text-gray-600">
                Sign in to your account
            </p>
        </div>
        <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="email" placeholder="Enter your email" type="email" />
                    <div class="text-red-500 mb-4"><?= $data['errors']['email']?></div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="password" placeholder="Enter your password" type="password" maxlength="6" />
                    <div class="text-red-500 mb-4"><?= $data['errors']['password'] ?></div>
                </div>
                <div class="mb-6 text-right">
                    <a class="text-blue-600 hover:text-blue-800" href="<?=BASEURL?>auth/forgetPassword">
                        Forgot password?
                    </a>
                </div>
            <button class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">
                Sign In
            </button>
        </form>
        <p class="text-center text-gray-600 mt-6">
            Don't have an account?
            <a class="text-blue-600 hover:text-blue-800" href="<?=BASEURL?>auth/regist">
                Sign up
            </a>
        </p>
    </div>
</body>
<!-- Scripts -->
<script>
        $(document).ready(function() {
            // Hide loading spinner after page loads
            setTimeout(function() {
                $('#loading').fadeOut(500);
            }, 1000);

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

</html>