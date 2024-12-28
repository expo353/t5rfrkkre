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

# Configure Apache to listen on IPv4 (or IPv6)
RUN echo "Listen 0.0.0.0:80" > /etc/apache2/ports.conf && \
    # Uncomment the following if you need IPv6
    # echo "Listen [::]:80" >> /etc/apache2/ports.conf

# Set the ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Fix permissions for Apache log directories
RUN mkdir -p /var/log/apache2 && \
    chown -R www-data:www-data /var/log/apache2 && \
    chmod -R 755 /var/log/apache2

# Expose the default Apache port for IPv4 (or IPv6)
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
