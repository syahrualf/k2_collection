FROM richarvey/nginx-php-fpm:8.2

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R nginx:nginx storage bootstrap/cache

ENV WEBROOT /var/www/html/public
