<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    
    $action = $_POST['action'] ?? '';
    
    if ($action === 'signup') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // Validate input
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'All fields are required';
            header('Location: ../signup.php');
            exit();
        }
        
        // Check if username or email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Username or email already exists';
            header('Location: ../signup.php');
            exit();
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Create user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);
        
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['username'] = $username;
        $_SESSION['message'] = 'Registration successful!';
        header('Location: ../index.php');
        exit();
        
    } elseif ($action === 'login') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        // Get user by username
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid username or password';
            header('Location: ../login.php');
            exit();
        }
        
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['message'] = 'Login successful!';
        header('Location: ../index.php');
        exit();
    }
}
?>