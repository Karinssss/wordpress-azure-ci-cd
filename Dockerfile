FROM wordpress:php8.2-apache

COPY custom/index.php /var/www/html/index.php
COPY html/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
