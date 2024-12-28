# Use the official PHP image
FROM php:8.2-apache

# Install required PHP extensions and libraries
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libgmp-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libxml2-dev \
    iproute2 && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip gmp && \
    rm -rf /var/lib/apt/lists/*

# Copy all PHP files and directories into the container
COPY . /var/www/html/

# Set the correct permissions for all files
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Ensure Apache listens on both IPv4 and IPv6
RUN echo "Listen 80" > /etc/apache2/ports.conf && \
    echo "Listen [::]:80" >> /etc/apache2/ports.conf

# Fix permissions for Apache log directories
RUN mkdir -p /var/log/apache2 && \
    chown -R www-data:www-data /var/log/apache2 && \
    chmod -R 755 /var/log/apache2

# Expose the default Apache port for IPv4 and IPv6
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
