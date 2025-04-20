<?php
require_once 'db.php';

function getPastEventsWithCounts() {
    global $pdo;
    
    $current_date = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("
        SELECT e.*, 
               SUM(CASE WHEN r.status = 'attending' THEN 1 ELSE 0 END) as attending_count,
               SUM(CASE WHEN r.status = 'maybe' THEN 1 ELSE 0 END) as maybe_count,
               SUM(CASE WHEN r.status = 'not_attending' THEN 1 ELSE 0 END) as not_attending_count
        FROM events e
        LEFT JOIN rsvps r ON e.id = r.event_id
        WHERE e.date < :current_date
        GROUP BY e.id
        ORDER BY e.date DESC
    ");
    $stmt->execute(['current_date' => $current_date]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUpcomingEventsWithCounts() {
    global $pdo;
    
    $current_date = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("
        SELECT e.*, 
               SUM(CASE WHEN r.status = 'attending' THEN 1 ELSE 0 END) as attending_count,
               SUM(CASE WHEN r.status = 'maybe' THEN 1 ELSE 0 END) as maybe_count,
               SUM(CASE WHEN r.status = 'not_attending' THEN 1 ELSE 0 END) as not_attending_count
        FROM events e
        LEFT JOIN rsvps r ON e.id = r.event_id
        WHERE e.date >= :current_date
        GROUP BY e.id
        ORDER BY e.date ASC
    ");
    $stmt->execute(['current_date' => $current_date]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserRSVPStatus($userId, $eventId) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT status FROM rsvps WHERE user_id = ? AND event_id = ?");
    $stmt->execute([$userId, $eventId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['status'] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    session_start();
    header('Content-Type: application/json');
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Not authenticated']);
        exit();
    }
    
    if ($_POST['action'] === 'update_rsvp') {
        $eventId = (int)$_POST['event_id'];
        $status = $_POST['status'];
        $userId = $_SESSION['user_id'];
        
        // Check if RSVP exists
        $stmt = $pdo->prepare("SELECT id FROM rsvps WHERE user_id = ? AND event_id = ?");
        $stmt->execute([$userId, $eventId]);
        
        if ($stmt->rowCount() > 0) {
            $stmt = $pdo->prepare("UPDATE rsvps SET status = ? WHERE user_id = ? AND event_id = ?");
        } else {
            $stmt = $pdo->prepare("INSERT INTO rsvps (status, user_id, event_id) VALUES (?, ?, ?)");
        }
        
        $success = $stmt->execute([$status, $userId, $eventId]);
        
        echo json_encode(['success' => $success]);
        exit();
    }
}
?>