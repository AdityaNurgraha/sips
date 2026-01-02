FROM php:8.2-fpm

# =========================
# Install system packages
# =========================
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    curl \
    fontconfig \
    fonts-dejavu \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring zip pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =========================
# Install Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Workdir
# =========================
WORKDIR /app

# =========================
# Copy project
# =========================
COPY . .

# =========================
# Install PHP deps
# =========================
RUN composer install --no-dev --optimize-autoloader

# =========================
# Build Vite assets (INI KUNCI)
# =========================
RUN npm install && npm run build

# =========================
# Laravel permissions
# =========================
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# =========================
# Expose port
# =========================
EXPOSE 8080

# =========================
# Run Laravel
# =========================
CMD php artisan serve --host=0.0.0.0 --port=8080
