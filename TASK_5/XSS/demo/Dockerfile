FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli

COPY  ./src /var/www/html

WORKDIR /var/www/html