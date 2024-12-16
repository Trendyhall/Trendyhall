FROM php:7.4-fpm-alpine

# If using MySQL, add MySQL libraries
RUN docker-php-ext-install mysqli pdo pdo_mysql
