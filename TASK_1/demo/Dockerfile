
FROM php:8.0.30-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli


### install XDebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug


WORKDIR /var/www/html

COPY ./src .
COPY ./config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE 80

