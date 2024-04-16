# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install PHP MySQL extension
RUN docker-php-ext-install mysqli

# Copy the current directory contents into the container at /var/www/html
# Copy custom Apache Virtual Host configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

