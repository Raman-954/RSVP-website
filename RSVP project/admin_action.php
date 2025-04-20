<?php
require 'includes/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'add_event':
            $stmt = $pdo->prepare("INSERT INTO events (title, description, date, location) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                trim($_POST['title']),
                trim($_POST['description']),
                $_POST['date'],
                trim($_POST['location'])
            ]);
            break;

        case 'delete_event':
            $eventId = (int)$_POST['event_id'];
            $pdo->prepare("DELETE FROM rsvps WHERE event_id = ?")->execute([$eventId]); // delete related rsvps
            $pdo->prepare("DELETE FROM events WHERE id = ?")->execute([$eventId]);
            break;

        case 'delete_participant':
            $rsvpId = (int)$_POST['rsvp_id'];
            $pdo->prepare("DELETE FROM rsvps WHERE id = ?")->execute([$rsvpId]);
            break;
    }

    header('Location: admin.php');
    exit();
}
