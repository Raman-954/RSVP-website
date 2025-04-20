<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // Get participant emails
    $stmt = $pdo->prepare("
        SELECT u.email, u.username
        FROM rsvps r
        JOIN users u ON r.user_id = u.id
        WHERE r.event_id = ?
    ");
    $stmt->execute([$event_id]);
    $recipients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get event details
    $eventStmt = $pdo->prepare("SELECT title, date, location FROM events WHERE id = ?");
    $eventStmt->execute([$event_id]);
    $event = $eventStmt->fetch(PDO::FETCH_ASSOC);

    if (!$event || empty($recipients)) {
        echo "<script>alert('Event or participants not found.'); history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'eventeven098@gmail.com';      // Your Gmail
        $mail->Password   = 'qyrj tisd bmpp zwpn';      // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('eventeven098@gmail.com', 'Event Organizer');

        foreach ($recipients as $r) {
            $mail->addAddress($r['email'], $r['username']);
        }

        $mail->isHTML(true);
        $mail->Subject = "Reminder for Event: {$event['name']}";
        $mail->Body = "
            <h3>Hello!</h3>
            <p>This is a reminder for the upcoming event:</p>
            <ul>
                <li><strong>Name:</strong> {$event['title']}</li>
                <li><strong>Date:</strong> " . date('F j, Y, g:i A', strtotime($event['date'])) . "</li>
                <li><strong>Location:</strong> {$event['location']}</li>
            </ul>
            <p>We look forward to seeing you there!</p>
        ";

        $mail->send();
        echo "<script>alert('Emails sent successfully!'); window.history.back();</script>";
    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
}
?>
