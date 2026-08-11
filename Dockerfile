FROM php:8.1-cli-alpine

# Install dependensi Alpine & extension PHP
RUN apk add --no-cache icu-dev libzip-dev zip unzip git $PHPIZE_DEPS \
    && docker-php-ext-install pdo_mysql bcmath \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .

# Install vendor
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

EXPOSE 8000

# Menggunakan sh -c agar environment variable $PORT dibaca dengan benar oleh Railway
CMD sh -c "php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan storage:link --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"
