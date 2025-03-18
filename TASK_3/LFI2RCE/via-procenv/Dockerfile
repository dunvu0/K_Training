FROM php:8.2-cli

RUN apt-get update && \
    apt-get install -y lighttpd 

    
WORKDIR /var/www/html

# Copy file cấu hình Lighttpd và file PHP
COPY ./config/lighttpd.conf /etc/lighttpd/lighttpd.conf
COPY ./src /var/www/html

EXPOSE 80

CMD ["lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
