FROM php:apache

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
COPY ./app/composer.* ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction
COPY ./app .
RUN composer dump-autoload --optimized