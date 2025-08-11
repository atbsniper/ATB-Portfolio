#!/bin/bash

# LEMP Stack Setup Script - Memory Optimized
# For Ubuntu/Debian systems

set -e

echo "🚀 Setting up LEMP Stack (Linux, Nginx, MySQL, PHP)..."

# Update system
echo "📦 Updating system packages..."
sudo apt update && sudo apt upgrade -y

# Install Nginx
echo "🌐 Installing Nginx..."
sudo apt install -y nginx

# Install MySQL
echo "🗄️ Installing MySQL..."
sudo apt install -y mysql-server

# Install PHP and extensions
echo "🐘 Installing PHP and extensions..."
sudo apt install -y php-fpm php-mysql php-json php-opcache php-mbstring php-xml php-curl php-gd

# Secure MySQL installation
echo "🔒 Securing MySQL installation..."
sudo mysql_secure_installation

# Create database and user
echo "🗄️ Setting up database..."
sudo mysql -e "source /var/www/html/setup_database.sql"

# Configure Nginx
echo "⚙️ Configuring Nginx..."
sudo cp /var/www/html/nginx.conf /etc/nginx/nginx.conf
sudo nginx -t
sudo systemctl restart nginx
sudo systemctl enable nginx

# Configure PHP-FPM
echo "⚙️ Configuring PHP-FPM..."
sudo cp /var/www/html/www.conf /etc/php/*/fpm/pool.d/www.conf
sudo systemctl restart php*-fpm
sudo systemctl enable php*-fpm

# Set proper permissions
echo "🔐 Setting file permissions..."
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html

# Create log directories
echo "📝 Creating log directories..."
sudo mkdir -p /var/log/php-fpm
sudo chown www-data:www-data /var/log/php-fpm

# Configure firewall
echo "🔥 Configuring firewall..."
sudo ufw allow 'Nginx Full'
sudo ufw allow OpenSSH
sudo ufw --force enable

# Memory optimization for MySQL
echo "💾 Optimizing MySQL for low memory..."
sudo tee -a /etc/mysql/mysql.conf.d/mysqld.cnf > /dev/null <<EOF

# Memory optimization settings
[mysqld]
innodb_buffer_pool_size = 64M
innodb_log_file_size = 16M
innodb_log_buffer_size = 8M
key_buffer_size = 16M
max_connections = 50
table_open_cache = 200
query_cache_size = 8M
query_cache_type = 1
tmp_table_size = 16M
max_heap_table_size = 16M
EOF

# Restart MySQL
sudo systemctl restart mysql

# Create a simple monitoring script
echo "📊 Creating monitoring script..."
cat > /var/www/html/monitor.php <<'EOF'
<?php
// Memory usage monitoring
$memory_usage = memory_get_usage(true);
$memory_peak = memory_get_peak_usage(true);
$memory_limit = ini_get('memory_limit');

echo "Current Memory Usage: " . round($memory_usage / 1024 / 1024, 2) . " MB\n";
echo "Peak Memory Usage: " . round($memory_peak / 1024 / 1024, 2) . " MB\n";
echo "Memory Limit: " . $memory_limit . "\n";

// Database connection test
try {
    $pdo = new PDO("mysql:host=localhost;dbname=portfolio_db", "portfolio_user", "portfolio_pass_2024");
    echo "Database: Connected successfully\n";
} catch (PDOException $e) {
    echo "Database: Connection failed\n";
}
?>
EOF

echo "✅ LEMP Stack setup completed!"
echo ""
echo "📋 Next steps:"
echo "1. Update your contact information in index.html"
echo "2. Access your website: http://$(curl -s ifconfig.me)"
echo "3. Access admin panel: http://$(curl -s ifconfig.me)/admin.php"
echo "4. Monitor memory usage: http://$(curl -s ifconfig.me)/monitor.php"
echo ""
echo "🔑 Admin credentials:"
echo "Username: admin"
echo "Password: admin123"
echo ""
echo "⚠️  Remember to change the admin password in production!" 