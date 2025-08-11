<?php
ini_set('memory_limit', '128M');

$memory_usage = memory_get_usage(true);
$memory_peak = memory_get_peak_usage(true);
$memory_limit = ini_get('memory_limit');

echo "Current Memory Usage: " . round($memory_usage / 1024 / 1024, 2) . " MB\n";
echo "Peak Memory Usage: " . round($memory_peak / 1024 / 1024, 2) . " MB\n";
echo "Memory Limit: " . $memory_limit . "\n";

// Database connection test
try {
    $pdo = new PDO('mysql:host=localhost;dbname=portfolio_db', 'portfolio_user', 'portfolio_password');
    echo "Database: Connected successfully\n";
    
    // Count contact messages
    $stmt = $pdo->query("SELECT COUNT(*) FROM contact_messages");
    $message_count = $stmt->fetchColumn();
    echo "Contact Messages: " . $message_count . "\n";
    
    // Count projects
    $stmt = $pdo->query("SELECT COUNT(*) FROM projects");
    $project_count = $stmt->fetchColumn();
    echo "Projects: " . $project_count . "\n";
    
} catch (PDOException $e) {
    echo "Database: Connection failed - " . $e->getMessage() . "\n";
}

echo "PHP Version: " . phpversion() . "\n";
echo "Server Time: " . date('Y-m-d H:i:s') . "\n";
echo "Max Execution Time: " . ini_get('max_execution_time') . " seconds\n";
echo "Post Max Size: " . ini_get('post_max_size') . "\n";
echo "Upload Max Filesize: " . ini_get('upload_max_filesize') . "\n";
echo "Max File Uploads: " . ini_get('max_file_uploads') . "\n";
?>
