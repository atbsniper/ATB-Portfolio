<?php
// Memory optimization
ini_set('memory_limit', '64M');
ini_set('max_execution_time', 30);

session_start();

// Simple authentication (in production, use proper authentication)
$admin_username = 'admin';
$admin_password = 'admin123'; // Change this in production

if (!isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
        $_POST['username'] === $admin_username && 
        $_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        // Show login form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Login</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
                .login-form { max-width: 400px; margin: 100px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
                button { width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
                button:hover { background: #0056b3; }
            </style>
        </head>
        <body>
            <div class="login-form">
                <h2>Admin Login</h2>
                <form method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Database configuration
$host = 'localhost';
$dbname = 'portfolio_db';
$username = 'portfolio_user';
$password = 'portfolio_pass_2024';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 50");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $messages = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Contact Messages</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .logout { padding: 8px 16px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px; }
        .message { padding: 20px; border-bottom: 1px solid #eee; }
        .message h3 { margin: 0 0 10px 0; color: #333; }
        .message .meta { color: #666; font-size: 0.9em; margin-bottom: 10px; }
        .message .content { background: #f8f9fa; padding: 15px; border-radius: 4px; }
        .no-messages { padding: 20px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contact Messages</h1>
            <a href="?logout=1" class="logout">Logout</a>
        </div>
        
        <?php if (empty($messages)): ?>
            <div class="no-messages">
                <p>No messages found.</p>
            </div>
        <?php else: ?>
            <?php foreach ($messages as $msg): ?>
                <div class="message">
                    <h3><?= htmlspecialchars($msg['subject']) ?></h3>
                    <div class="meta">
                        From: <?= htmlspecialchars($msg['name']) ?> (<?= htmlspecialchars($msg['email']) ?>)<br>
                        Date: <?= date('M j, Y g:i A', strtotime($msg['created_at'])) ?><br>
                        IP: <?= htmlspecialchars($msg['ip_address']) ?>
                    </div>
                    <div class="content">
                        <?= nl2br(htmlspecialchars($msg['message'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html> 