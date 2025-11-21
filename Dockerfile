FROM php:7.0-apache

# Instalar extensiones necesarias para bases de datos
RUN docker-php-ext-install mysqli pdo pdo_mysql