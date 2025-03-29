# Use the official Apache HTTP Server image from Docker Hub
#FROM httpd:latest
#FROM php:8.1-apache
FROM php:8.2.0-apache

# Install PHP and required modules
#RUN apt-get update && apt-get install -y php libapache2-mod-php

# Enable PHP module
RUN a2enmod php

RUN apt-get update && apt-get install -y \
libmariadb-dev \
&& docker-php-ext-install pdo_mysql

# Copy your website files to the default web directory
#ADD ./public/ /usr/local/apache2/htdocs/
ADD ./public/ /var/www/html/

ADD . /var/www/html/

RUN chmod 777 -R storage/


# Expose port 80 for HTTP traffic
EXPOSE 80


