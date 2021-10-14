FROM php:8.0-fpm

RUN apt update && apt -y install git && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data:www-data /var/www/html
