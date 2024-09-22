# Використовуємо базовий образ PHP 8.2 з FPM
FROM php:8.2-fpm

# Встановлюємо необхідні залежності
RUN apt-get update && apt-get install -y \
    supervisor \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Копіюємо Composer з образу Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Встановлюємо робочу директорію
WORKDIR /var/www

# Копіюємо файл composer.json і composer.lock
COPY composer.json composer.lock ./

# Копіюємо всі файли проекту
COPY . .

# Встановлюємо PHP-залежності за допомогою Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Копіюємо конфігурацію Supervisord
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Налаштовуємо права доступу
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

# Експонуємо порт 8000 для доступу до додатку
EXPOSE 8000

# Запускаємо Supervisord
CMD ["/usr/bin/supervisord", "-n"]
