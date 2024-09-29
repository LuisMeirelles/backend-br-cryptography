FROM php:8.3-fpm

ARG UID
ARG GID

RUN usermod -u $UID www-data && groupmod -g $GID www-data

USER www-data
