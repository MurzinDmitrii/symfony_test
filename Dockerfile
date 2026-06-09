FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install zip pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . /app

RUN composer install

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]