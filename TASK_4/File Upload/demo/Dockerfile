FROM php:7.4-apache

# Install dependencies for Imagick
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libgif-dev --no-install-recommends && \
    pecl install imagick && \
    docker-php-ext-enable imagick

COPY ./src /var/www/html
COPY config/php.ini /usr/local/etc/php/php.ini
COPY config/apache2.conf /etc/apache2/apache2.conf


# RUN mkdir /var/www/html/uploads \
# && chmod -R 777 /var/www/html/uploads