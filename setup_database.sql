-- Create database
CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user
CREATE USER IF NOT EXISTS 'portfolio_user'@'localhost' IDENTIFIED BY 'portfolio_pass_2024';
GRANT ALL PRIVILEGES ON portfolio_db.* TO 'portfolio_user'@'localhost';
FLUSH PRIVILEGES;

USE portfolio_db;

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    technologies VARCHAR(500) NOT NULL,
    github_url VARCHAR(500),
    live_url VARCHAR(500),
    image_url VARCHAR(500),
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_active (active),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample projects
INSERT INTO projects (title, description, technologies, github_url, live_url, image_url) VALUES
('ilovejpeg.com', 'A web application for image processing and optimization', 'PHP, JavaScript, HTML5, CSS3', 'https://github.com/yourusername/ilovejpeg', 'https://www.ilovejpeg.com', '/images/ilovejpeg.jpg'),
('trackwithturtle.com', 'A tracking and analytics platform', 'React, Node.js, MongoDB, Express', 'https://github.com/yourusername/trackwithturtle', 'https://www.trackwithturtle.com', '/images/trackwithturtle.jpg'),
('Portfolio Website', 'Personal portfolio website with LEMP stack', 'PHP, MySQL, Nginx, HTML5, CSS3, JavaScript', 'https://github.com/yourusername/portfolio', 'https://yourdomain.com', '/images/portfolio.jpg'),
('DevOps Automation', 'CI/CD pipeline automation scripts', 'Docker, Kubernetes, Jenkins, AWS', 'https://github.com/yourusername/devops-automation', NULL, '/images/devops.jpg'); 