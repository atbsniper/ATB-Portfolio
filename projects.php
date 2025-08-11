<?php
// Memory optimization
ini_set('memory_limit', '64M');
ini_set('max_execution_time', 30);

// Database configuration
$host = 'localhost';
$dbname = 'portfolio_db';
$username = 'portfolio_user';
$password = 'portfolio_pass_2024';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM projects WHERE active = 1 ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($projects);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode([]);
}
?> 