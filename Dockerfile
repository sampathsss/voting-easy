FROM php:8.2-apache

# Install necessary extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite (optional, if you use clean URLs)
RUN a2enmod rewrite

# Copy project files to Apache root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
