<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="bg-blue-900 text-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-2">
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <img src="event.gif" alt="Event Logo" class="h-12 md:h-16 w-auto">
                <a href="index.php" class="text-2xl md:text-3xl font-bold">Event RSVP</a>
            </div>
            <div class="flex space-x-4 items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="px-4 py-2 text-lg flex items-center gap-2 rounded bg-green-500 hover:bg-green-700">
                        <i class="fa-solid fa-user-tie"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                    <a href="logout.php" class="px-4 py-2 text-lg rounded bg-red-500 hover:bg-red-700 flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="px-4 py-2 text-lg rounded hover:bg-blue-700">Login</a>
                    <a href="signup.php" class="px-4 py-2 text-lg rounded hover:bg-blue-700">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>