FROM node:latest AS node
FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        wget \
        libaio-dev \
        libmcrypt-dev

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install zip && docker-php-ext-enable zip

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html/

COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod ssl
RUN a2enmod include
RUN a2enmod expires
RUN a2enmod actions
RUN a2enmod status
RUN a2enmod info

COPY . /var/www/html

RUN mv .env.docker .env

RUN chmod 777 /var/www/html/public
RUN chmod -R 777 /var/www/html/storage/
