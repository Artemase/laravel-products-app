FROM php:8.3-fpm

# Устанавливаем зависимости для gd, zip, postgresql-client и другие необходимые пакеты
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    postgresql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd zip

# Устанавливаем xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Копируем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копируем файлы проекта
COPY . .

# Явно копируем .env
COPY .env .env

# Устанавливаем зависимости Composer
RUN composer install

# Настраиваем права доступа
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]