# Use the official PHP image as a base
FROM php:8.2-apache

# Install required dependencies and libraries
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libgmp-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libxml2-dev \
    iproute2 \
    iputils-ping \
    && rm -rf /var/lib/apt/lists/*

# Ensure PHP is compiled with IPv6 support by installing necessary dependencies
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip gmp

# Copy all PHP files and directories into the container
COPY . /var/www/html/

# Set the correct permissions for all files
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Enable IPv6 support in Apache by ensuring it listens on all interfaces (IPv6 and IPv4)
RUN echo "Listen [::]:80" >> /etc/apache2/ports.conf

# Enable Apache modules for IPv6 and allow Apache to use the IPv6 address
RUN a2enmod rewrite
RUN a2enmod vhost_alias
RUN a2enmod proxy
RUN a2enmod proxy_http

# Update Apache to listen on both IPv6 and IPv4
RUN echo "<VirtualHost *:80>" > /etc/apache2/sites-available/000-default.conf && \
    echo "    ServerAdmin webmaster@localhost" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    DocumentRoot /var/www/html" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/000-default.conf && \
    echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf

# Fix permissions for Apache log directories
RUN mkdir -p /var/log/apache2 && \
    chown -R www-data:www-data /var/log/apache2 && \
    chmod -R 755 /var/log/apache2

# Expose the default Apache ports for both IPv4 and IPv6
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
