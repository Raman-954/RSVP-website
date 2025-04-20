<?php
require_once 'includes/db.php';
session_start();



// Fetch Events
$events = $pdo->query("
    SELECT e.*, 
           (SELECT COUNT(*) FROM rsvps WHERE event_id = e.id) as participant_count
    FROM events e
    ORDER BY e.date ASC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://events.linuxfoundation.org/wp-content/uploads/2020/06/KubeCon_Virtual_2020_web-01-1-1920x1080.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .glass {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
        }
        .gradient-btn {
            background: linear-gradient(to right, #6366F1, #8B5CF6);
        }
        .gradient-btn:hover {
            background: linear-gradient(to right, #4F46E5, #7C3AED);
        }
    </style>
</head>
<body class="min-h-screen bg-black/50 py-10 px-6">

<div class="max-w-6xl mx-auto p-6 rounded-xl shadow-lg glass">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🎛️ Admin Dashboard</h1>
    </div>

    <!-- Add Event Form -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">➕ Add New Event</h2>
        <form action="admin_action.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="hidden" name="action" value="add_event">
            <div class="col-span-2">
                <label class="block text-sm text-gray-700">Event Name</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="col-span-2">
                <label class="block text-sm text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Date & Time</label>
                <input type="datetime-local" name="date" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Location</label>
                <input type="text" name="location" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="col-span-2">
                <button type="submit" class="gradient-btn text-white font-semibold px-4 py-2 rounded">Create Event</button>
            </div>
        </form>
    </div>

    <!-- Events List -->
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">📅 Upcoming Events</h2>
    <?php foreach ($events as $event): ?>
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($event['title']) ?></h3>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars($event['location']) ?> | <?= date('F j, Y g:i A', strtotime($event['date'])) ?></p>
                </div>
                <form method="POST" action="admin_action.php" onsubmit="return confirm('Delete this event and all RSVPs?')">
                    <input type="hidden" name="action" value="delete_event">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <button class="text-red-600 hover:text-red-800 text-sm font-semibold">🗑 Delete</button>
                </form>
            </div>
            <p class="mt-2 text-sm text-gray-700">👥 Participants: <?= $event['participant_count'] ?></p>

            <!-- Participant List -->
            <h4 class="font-semibold text-gray-800 mt-4 mb-2">👤 Attendees</h4>
            <ul class="list-disc ml-6 text-sm space-y-1">
                <?php
                $stmt = $pdo->prepare("SELECT r.id AS rsvp_id, u.username, u.email, r.status FROM rsvps r JOIN users u ON r.user_id = u.id WHERE r.event_id = ?");
                $stmt->execute([$event['id']]);
                $attendees = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($attendees as $attendee):
                ?>
                <li class="flex justify-between items-center">
                    <?= htmlspecialchars($attendee['username']) ?> (<?= $attendee['status'] ?>)
                    <form action="admin_action.php" method="POST" class="inline">
                        <input type="hidden" name="action" value="delete_participant">
                        <input type="hidden" name="rsvp_id" value="<?= $attendee['rsvp_id'] ?>">
                        <button type="submit" class="text-red-500 text-xs hover:text-red-700">Remove</button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Send Email -->
            <form method="POST" action="send_email.php" class="mt-4">
                <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                <button class="gradient-btn text-white px-3 py-2 rounded font-semibold">📧 Send Email to Participants</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
