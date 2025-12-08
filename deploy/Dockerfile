FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    postgresql-dev \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath zip gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html
USER www-data
