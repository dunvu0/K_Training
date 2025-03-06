
FROM php:8.0.30-apache

RUN docker-php-ext-install mysqli \ 
    && docker-php-ext-enable mysqli

RUN apt-get update && apt-get install -y nano
### install XDebug
# RUN pecl install xdebug \
#     && docker-php-ext-enable xdebug


WORKDIR /var/www/html
COPY ./sqlite3.db /var/www/sqlitoe3.db
COPY . .
# COPY ./config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE 8000

