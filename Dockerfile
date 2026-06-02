FROM php:8.2-cli

WORKDIR /app

# Install system dependencies and database utilities
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    zip

# Install PHP extensions including pdo_mysql for Railway/MySQL database connection
RUN docker-php-ext-install zip pdo pdo_mysql

# Configure custom upload and post sizes for PHP
RUN echo "upload_max_filesize = 64M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/uploads.ini

COPY . .

# Copy environment template to .env to allow key generation and configuration
RUN cp .env.example .env

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install production dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

EXPOSE 10000

# Automatically generate APP_KEY, run database migrations safely, and boot the application
CMD php artisan key:generate --force && (php artisan storage:link || true) && (php artisan migrate --force --seed || true) && php artisan serve --host=0.0.0.0 --port=10000