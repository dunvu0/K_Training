FROM php:7.4-fpm

RUN apt-get update && apt-get install -y nginx

COPY ./src /var/www/html
COPY ./config/nginx.conf /etc/nginx/nginx.conf

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html
    
EXPOSE 80

    
ENTRYPOINT [ "/entrypoint.sh" ]