# Build frontend assets with Vite
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json .npmrc ./
RUN npm install

COPY resources ./resources
COPY vite.config.js ./
COPY public ./public

RUN npm run build


# Install production PHP dependencies
FROM composer:2 AS vendor

WORKDIR /app

COPY . .

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader


# Production application
FROM php:8.4-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpq-dev \
        libzip-dev \
        libonig-dev \
        libicu-dev \
        libxml2-dev \
        libcurl4-openssl-dev \
    && docker-php-ext-install \
        pdo_pgsql \
        mbstring \
        zip \
        intl \
        curl \
        bcmath \
        opcache \
        dom \
        xml \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy the Laravel application and Composer dependencies
COPY --from=vendor /app /var/www/html

# Copy the compiled Vite assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# Apache must serve Laravel's public directory
RUN sed -ri \
        's!/var/www/html!/var/www/html/public!g' \
        /etc/apache2/sites-available/000-default.conf \
    && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
        > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

COPY docker/start.sh /usr/local/bin/start-laravel

RUN chmod +x /usr/local/bin/start-laravel

EXPOSE 10000

CMD ["/usr/local/bin/start-laravel"]
