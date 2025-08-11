# Portfolio Website with LEMP Stack

A memory-optimized portfolio website built with the LEMP stack (Linux, Nginx, MySQL, PHP) designed to run efficiently on low-memory servers.

## 🚀 Features

### Portfolio Features
- **Dynamic Projects Section**: Projects loaded from MySQL database
- **Contact Form**: Store contact messages in database
- **Admin Panel**: View and manage contact messages
- **Responsive Design**: Modern, mobile-friendly interface
- **Social Links**: GitHub, LinkedIn, and email integration

### Technical Features
- **Memory Optimized**: Configured for low-memory servers (64MB PHP limit)
- **Rate Limiting**: Protection against spam and abuse
- **Security Headers**: XSS protection, CSRF prevention
- **Caching**: Static file caching and OPcache for PHP
- **Monitoring**: Built-in memory usage monitoring

## 📋 Prerequisites

- Ubuntu/Debian server
- At least 512MB RAM (optimized for 1GB)
- Root or sudo access

## 🛠️ Installation

### Quick Setup
```bash
# Make setup script executable
chmod +x setup_lemp.sh

# Run the setup script
sudo ./setup_lemp.sh
```

### Manual Setup

1. **Install LEMP Stack**:
   ```bash
   sudo apt update
   sudo apt install nginx mysql-server php-fpm php-mysql php-json php-opcache
   ```

2. **Configure Database**:
   ```bash
   sudo mysql -e "source setup_database.sql"
   ```

3. **Configure Nginx**:
   ```bash
   sudo cp nginx.conf /etc/nginx/nginx.conf
   sudo nginx -t
   sudo systemctl restart nginx
   ```

4. **Configure PHP-FPM**:
   ```bash
   sudo cp www.conf /etc/php/*/fpm/pool.d/www.conf
   sudo systemctl restart php*-fpm
   ```

5. **Set Permissions**:
   ```bash
   sudo chown -R www-data:www-data /var/www/html
   sudo chmod -R 755 /var/www/html
   ```

## 📁 File Structure

```
/var/www/html/
├── index.html          # Main portfolio page
├── contact.php         # Contact form handler
├── projects.php        # Projects API endpoint
├── admin.php          # Admin panel
├── monitor.php        # Memory monitoring
├── setup_database.sql # Database setup script
├── nginx.conf         # Nginx configuration
├── www.conf           # PHP-FPM configuration
└── setup_lemp.sh      # Automated setup script
```

## 🔧 Configuration

### Update Contact Information
Edit `index.html` and update:
- GitHub username
- LinkedIn profile
- Email address
- Project links

### Database Configuration
Default database settings:
- Database: `portfolio_db`
- User: `portfolio_user`
- Password: `portfolio_pass_2024`

### Admin Panel
- URL: `http://your-domain.com/admin.php`
- Username: `admin`
- Password: `admin123`

**⚠️ Change the admin password in production!**

## 🎯 Use Cases

### 1. Contact Management
- Visitors can send messages through the contact form
- Messages are stored in MySQL database
- Admin panel to view and manage messages
- Rate limiting prevents spam

### 2. Dynamic Portfolio
- Projects loaded from database
- Easy to add/remove projects without editing code
- Support for GitHub links and live demos
- Technology stack display

### 3. Memory Monitoring
- Built-in memory usage monitoring
- Database connection testing
- Performance tracking

### 4. Additional Ideas
- **Blog System**: Add blog posts table and CMS
- **Skills Database**: Store and display technical skills
- **Testimonials**: Client feedback system
- **Analytics**: Track page views and visitor data
- **File Upload**: Portfolio images and documents
- **Email Notifications**: Get notified of new messages

## 🔒 Security Features

- Rate limiting on contact form and admin panel
- SQL injection prevention with prepared statements
- XSS protection with input sanitization
- Security headers (X-Frame-Options, X-XSS-Protection, etc.)
- Disabled dangerous PHP functions
- Open_basedir restrictions

## 📊 Memory Optimization

### PHP Settings
- Memory limit: 64MB
- Max execution time: 30 seconds
- OPcache enabled with 32MB memory
- Limited file upload sizes

### MySQL Settings
- InnoDB buffer pool: 64MB
- Query cache: 8MB
- Max connections: 50
- Optimized for low memory usage

### Nginx Settings
- Worker processes: auto
- Worker connections: 512
- Gzip compression enabled
- Static file caching

## 🚨 Troubleshooting

### Check Services
```bash
sudo systemctl status nginx
sudo systemctl status mysql
sudo systemctl status php*-fpm
```

### Check Logs
```bash
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/mysql/error.log
sudo tail -f /var/log/php-fpm/www-error.log
```

### Test Database Connection
```bash
mysql -u portfolio_user -p portfolio_db
```

### Monitor Memory Usage
Visit: `http://your-domain.com/monitor.php`

## 📈 Performance Tips

1. **Enable OPcache**: Already configured in PHP-FPM
2. **Use CDN**: For static assets (images, CSS, JS)
3. **Optimize Images**: Compress images before uploading
4. **Database Indexing**: Already configured for common queries
5. **Regular Maintenance**: Clean old contact messages periodically

## 🤝 Contributing

Feel free to submit issues and enhancement requests!

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

**Built with ❤️ using LEMP Stack** 