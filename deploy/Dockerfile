FROM php:8.4-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
    postgresql-dev \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_pgsql exif

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html
USER www-data
