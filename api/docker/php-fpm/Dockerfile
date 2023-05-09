FROM php:8.1.0-fpm-alpine

# Устанавливаем расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Install the Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"


