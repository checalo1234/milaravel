# Usa la imagen oficial PHP con Apache (puedes usar php-cli si prefieres)
FROM php:8.1-cli

# Instala dependencias necesarias y extensiones PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl

# Instala Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Instala dependencias de PHP con Composer sin dev y optimizando autoloader
RUN composer install --no-dev --optimize-autoloader

# Da permisos correctos a storage y cache
RUN chmod -R 775 storage bootstrap/cache

# Expone el puerto que usará Laravel
EXPOSE 10000

# Ejecuta migraciones y levanta el servidor de Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
