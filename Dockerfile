# Apache + PHP image serving the site; the database lives in a separate container (see compose.yaml).
FROM php:8.3-apache

RUN docker-php-ext-install mysqli \
 && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY . /var/www/html/

# Product images added from the vendor pages are written here.
RUN chown -R www-data:www-data /var/www/html/upload

EXPOSE 80
