ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm
ARG PROJECT_FILES

RUN apt-get update && apt-get install -y \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libjpeg-dev \
        libzip-dev \
        unzip \
        git \
        netcat

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd curl zip mysqli \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

ARG USER_ID=0
RUN groupadd -r appuser
RUN useradd -r -u ${USER_ID} -g appuser appuser

USER appuser

WORKDIR ${PROJECT_FILES}