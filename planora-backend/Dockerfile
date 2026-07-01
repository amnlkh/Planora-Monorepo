FROM php:8.2-fpm-alpine

# 1. Install dependensi sistem dan alat kompilasi (PHPIZE_DEPS)
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    zip \
    unzip \
    git

# 2. Konfigurasi dan install ekstensi PHP
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

# --- TAMBAHKAN PERINTAH INI (Install vendor laravel) ---
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# --- SESUAIKAN DENGAN PORT DINAMIS RENDER ---
EXPOSE 80
CMD php artisan serve --host=0.0.0.0 --port=$PORT
