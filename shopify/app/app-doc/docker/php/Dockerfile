FROM php:8.0-apache

RUN docker-php-ext-install \
        pdo_mysql \
        mysqli \
    && a2enmod rewrite

COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
