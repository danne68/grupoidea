FROM php:7.4-apache
RUN docker-php-ext-install mysqli && a2enmod rewrite

#COPY src /var/www/
#RUN chown -R www-data:www-data /var/www

#para volver a correr el build
#docker-compose up --build --force-recreate --no-deps