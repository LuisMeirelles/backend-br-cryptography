FROM php:8.3-fpm

ARG UID
ARG GID

RUN deluser www-data && \
    addgroup --gid "$GID" www-data && \
    adduser --disabled-password --gecos "" --uid "$UID" --gid "$GID" --no-create-home --home /nonexistent www-data

RUN apt-get update

RUN apt-get install -y \
    git \
    zip \
    unzip

RUN apt-get install -y  \
    libcurl4-openssl-dev \
    libevent-dev \
    libssl-dev \
    libicu-dev \
    libidn2-dev \
    zlib1g-dev

RUN docker-php-ext-install pdo pdo_mysql && \
    pecl install raphf && \
    docker-php-ext-enable raphf && \
    pecl install pecl_http && \
    docker-php-ext-enable http

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

USER www-data
