<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RSVP System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-[url('https://events.linuxfoundation.org/wp-content/uploads/2020/06/KubeCon_Virtual_2020_web-01-1-1920x1080.jpg')] bg-cover bg-center">
    <div class="bg-transparent flex items-center justify-center p-6 md:p-10 shadow-lg rounded-lg max-w-4xl w-full hover:shadow-2xl transition-transform transform hover:scale-105">
        <!-- Login Form Section -->
        <div class="w-full md:w-1/2 px-4">
            <h1 class="font-bold text-3xl text-blue-600">Login</h1>
            <p class="text-white">Don't have an account yet? 
                <a href="signup.php" class="text-blue-500 hover:underline">Sign Up</a>
            </p>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="includes/auth.php" method="POST">
                <input type="hidden" name="action" value="login">

                <label for="username" class="block font-semibold mt-6 text-white">Username</label>
                <input type="text" id="username" name="username" required
                       class="rounded-lg w-full h-10 pl-4 border focus:ring-2 focus:ring-blue-400 focus:outline-none">

                <label for="password" class="block font-semibold mt-4 text-white">Password</label>
                <input type="password" id="password" name="password" required
                       class="rounded-lg w-full h-10 pl-4 border focus:ring-2 focus:ring-blue-400 focus:outline-none">

                <button type="submit"
                        class="bg-blue-500 font-bold text-white w-full rounded-lg mt-6 h-10 hover:bg-blue-600 transition duration-200">
                    Login
                </button>
            </form>

            <p class="text-white text-center mt-6">or sign in with</p>
            <div class="flex justify-center space-x-4 mt-2">
                <button class="p-3">
                    <i class="fa-brands fa-facebook text-blue-600 text-xl transition-transform duration-200 hover:scale-125"></i>
                </button>
                <button class="p-3">
                    <i class="fa-brands fa-google text-red-500 text-xl transition-transform duration-200 hover:scale-125"></i>
                </button>
                <button class="p-3">
                    <i class="fa-brands fa-apple text-white text-xl transition-transform duration-200 hover:scale-125"></i>
                </button>
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="hidden md:block md:w-1/2">
            <img src="https://img.thegoodocs.com/templates/preview/upcoming-event-poster-free-template-in-google-docs-0016-151280.jpg" class="rounded-lg">
        </div>
    </div>
</body>
</html>
