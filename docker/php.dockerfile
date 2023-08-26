FROM php:8.2-fpm

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
    vim \
    git \
    unzip \
    libzip-dev

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data
USER www-data

WORKDIR /www/elasticsearch-demo

EXPOSE 9000
