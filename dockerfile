FROM php:7.4-apache

RUN apt-get update && apt-get upgrade -y \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli \
    && a2enmod headers \
    && sed -ri -e 's/^([ \t]*)(<\/VirtualHost>)/\1\tHeader set Access-Control-Allow-Origin "*"\n\tHeader set Access-Control-Allow-Methods "GET,POST,PUT,DELETE,OPTIONS"\n\tHeader set Access-Control-Allow-Headers "Content-Type,Authorization,X-Requested-With"\n\tHeader set Access-Control-Allow-Credentials "true"\n\1\2/g' /etc/apache2/sites-available/*.conf
