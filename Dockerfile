FROM php:8.4-cli-alpine

# Install dependensi Alpine & extension PHP
RUN apk add --no-cache icu-dev libzip-dev zip unzip git $PHPIZE_DEPS \
    && docker-php-ext-install pdo_mysql bcmath \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .

# Set COMPOSER_ALLOW_SUPERUSER agar composer tidak melempar warning root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install vendor
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

CMD sh -c "php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan storage:link --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"
