FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nginx \
    supervisor

# Install Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/admin admin
RUN mkdir -p /home/admin/.composer && \
    chown -R admin:admin /home/admin

# Set working directory
WORKDIR /var/www

# Copy application code
COPY . /var/www

# Ensure correct ownership (in case any files are root-owned)
RUN chown -R admin:admin /var/www

# Change to non-root user
USER admin

# Allow Composer to run as root (since we are admin, but just in case)
ENV COMPOSER_ALLOW_SUPERUSER=1
# Install Composer dependencies including Ziggy
RUN composer require beyondcode/laravel-ziggy --prefer-dist --no-interaction && \
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev && \
    php artisan vendor:publish --provider="BeyondCode\Ziggy\ZiggyServiceProvider" --tag=config --force && \
    php artisan ziggy:generate

# Install Ziggy Vue NPM package
RUN npm install --save-dev @ziggy/vue

# Install npm dependencies and build assets for production
RUN npm ci && npm run build

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
