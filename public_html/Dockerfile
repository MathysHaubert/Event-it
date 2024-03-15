# Dockerfile-php
FROM php:7.4-fpm
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html

# Dockerfile-nginx
FROM nginx:latest
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./site /var/www/html