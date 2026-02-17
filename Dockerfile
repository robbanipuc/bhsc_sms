FROM php:8.2-apache

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql mysqli

EXPOSE 80