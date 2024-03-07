sudo apt install apache2 php8.3 php8.3-cli libapache2-mod-php8.3 -y
sudo apt update -y
sudo apt upgrade -y
sudo service apache2 enable
sudo service apache2 start
sudo rm -rf /var/www/html
sudo chown $USER:www-data /var/www
cd /var/www/
git clone https://github.com/MathysHaubert/Event-it.git
cd ~
sudo tee -a /etc/apache2/sites-available/Event-it.conf > /dev/null <<EOT
<VirtualHost *:80>
        ServerAdmin yapersonne@pasici
        DocumentRoot /var/www/Event-it
        <Directory "/var/www/Event-it">
                Options Indexes FollowSymLinks
                AllowOverride All
                Require all granted
                RewriteEngine On
                RewriteBase /
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.+)$ index.php [QSA,L]
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOT
sudo a2dissite 000-default.conf
sudo a2ensite Event-it
sudo a2enmod rewrite
sudo chown $USER:www-data /var/www
sudo service apache2 restart
sudo apt install mysql-server
mysql_secure_installation
EOF