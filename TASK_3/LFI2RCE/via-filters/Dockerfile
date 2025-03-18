FROM php:7.4-apache

WORKDIR /var/www/html/


COPY ./src .
COPY ./config/php.ini /usr/local/etc/php/conf.d

RUN chmod -R 777 /var/www/html/uploads
