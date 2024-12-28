# Use the official PHP image
FROM php:8.2-apache

# Install required PHP extensions and libraries
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libgmp-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip gmp && \
    rm -rf /var/lib/apt/lists/*

# Copy the PHP files into the container
COPY index.php /var/www/html/
COPY antibot_installer.php /var/www/html/


# Set the correct permissions for all files
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html



# Expose the default Apache port
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
