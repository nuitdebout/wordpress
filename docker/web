FROM php:7.0

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libcurl4-openssl-dev \
    && docker-php-ext-install -j$(nproc) mysqli mcrypt gd curl \
    && rm -rf /var/lib/apt/lists/*
