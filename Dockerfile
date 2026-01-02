FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    fontconfig \
    fonts-dejavu \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring zip pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Storage permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# 🔴 INI YANG PENTING UNTUK FOTO PROFIL
RUN php artisan storage:link

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
