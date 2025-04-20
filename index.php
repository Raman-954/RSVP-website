<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/auth.php';
require_once 'includes/events.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the current tab (default to upcoming)
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'upcoming';

// Get events based on the selected tab
if ($current_tab === 'past') {
    $events = getPastEventsWithCounts();
} else {
    $events = getUpcomingEventsWithCounts();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event RSVP System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 bg-[url('https://events.linuxfoundation.org/wp-content/uploads/2020/06/KubeCon_Virtual_2020_web-01-1-1920x1080.jpg')] bg-cover bg-fixed">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container mx-auto px-4 py-8 min-h-screen">
        <!-- Tab Navigation -->
        <div class="flex justify-center mb-8">
            <div class="flex bg-white rounded-lg shadow-md overflow-hidden">
                <a href="?tab=upcoming" class="<?php echo $current_tab === 'upcoming' ? 'bg-blue-600 text-white' : 'bg-white text-blue-600'; ?> px-6 py-3 font-medium text-lg">
                    Upcoming Events
                </a>
                <a href="?tab=past" class="<?php echo $current_tab === 'past' ? 'bg-blue-600 text-white' : 'bg-white text-blue-600'; ?> px-6 py-3 font-medium text-lg">
                    Past Events
                </a>
            </div>
        </div>
        
        <h1 class="text-3xl text-white font-bold text-center mb-8">
            <?php echo $current_tab === 'upcoming' ? 'Upcoming Events' : 'Past Events'; ?>
        </h1>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($events as $event): 
                $rsvpStatus = getUserRSVPStatus($_SESSION['user_id'], $event['id']);
            ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($event['title']); ?></h2>
                    <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($event['description']); ?></p>
                    
                    <div class="flex items-center text-gray-500 mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <?php echo htmlspecialchars($event['location']); ?>
                    </div>
                    
                    <div class="flex items-center text-gray-500 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <?php echo date('F j, Y g:i a', strtotime($event['date'])); ?>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Attending: <?php echo $event['attending_count']; ?></span>
                            <span>Maybe: <?php echo $event['maybe_count']; ?></span>
                            <span>Not Attending: <?php echo $event['not_attending_count']; ?></span>
                        </div>
                    </div>
                    
                    <?php if ($current_tab === 'upcoming'): ?>
                    <div class="flex space-x-2">
                        <button onclick="updateRSVP(<?php echo $event['id']; ?>, 'attending')" 
                            class="flex-1 py-2 rounded <?php echo $rsvpStatus === 'attending' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800'; ?>">
                            Attending
                        </button>
                        <button onclick="updateRSVP(<?php echo $event['id']; ?>, 'maybe')" 
                            class="flex-1 py-2 rounded <?php echo $rsvpStatus === 'maybe' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800'; ?>">
                            Maybe
                        </button>
                        <button onclick="updateRSVP(<?php echo $event['id']; ?>, 'not_attending')" 
                            class="flex-1 py-2 rounded <?php echo $rsvpStatus === 'not_attending' ? 'bg-red-600 text-white' : 'bg-red-100 text-red-800'; ?>">
                            Can't Go
                        </button>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-2 text-gray-500">
                        <i class="fas fa-clock mr-2"></i>This event has ended
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer Section remains the same -->
    <footer class="bg-blue-900 text-white py-8">
    <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">About RSVP System</h3>
                    <p class="text-blue-200">
                        Our Event RSVP System helps organizations manage event attendance efficiently. 
                        Users can easily register for events, track their participation, and organizers 
                        can monitor attendance in real-time.
                    </p>
                </div>
                
                <!-- Developers Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Development Team</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Ashish Kumar
                            <a href="https://www.linkedin.com/in/ashish-kumar-957b82277/" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Raman Kumar
                            <a href="https://www.linkedin.com/in/raman-kumar-379081297" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Ritu Raj
                            <a href="https://www.linkedin.com/in/riturazz?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="flex items-center hover:font-bold">
                            <i class="fas fa-user-tie mr-2 text-blue-300"></i>
                            Aman Prakash
                            <a href="https://linkedin.com/in/aman" class="ml-2 text-blue-300 hover:text-white">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                    <address class="text-blue-200 not-italic">
                        <p class="mb-2 hover:font-bold">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Lovely Professional University,
                            Phagwara, Punjab
                        </p>
                        <p class="mb-2 hover:font-bold">
                            <i class="fas fa-phone mr-2"></i>
                            +91 95406-61607
                        </p>
                        <p class="hover:font-bold">
                            <i class="fas fa-envelope mr-2"></i>
                            raman2511kumar@gmail.com
                        </p>
                    </address>
                </div>
            </div>
            
            <div class="border-t border-blue-800 mt-8 pt-6 text-center text-blue-300">
                <p>&copy; <?php echo date('Y'); ?> Event RSVP System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
    function updateRSVP(eventId, status) {
        fetch('includes/events.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=update_rsvp&event_id=${eventId}&status=${status}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Failed to update RSVP');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }
    </script>
</body>
</html>