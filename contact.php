<?php
// Memory optimization
ini_set('memory_limit', '64M');
ini_set('max_execution_time', 30);

// Database configuration
$host = 'localhost';
$dbname = 'portfolio_db';
$username = 'portfolio_user';
$password = 'portfolio_pass_2024';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
        $ip_address = $_SERVER['REMOTE_ADDR'];
        
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, ip_address, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $subject, $message, $ip_address]);
        
        $response = ['success' => true, 'message' => 'Thank you! Your message has been sent successfully.'];
    } catch (PDOException $e) {
        $response = ['success' => false, 'message' => 'Sorry, there was an error sending your message. Please try again.'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?> 