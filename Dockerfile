FROM php:8.2-cli

# Instalar extensiones necesarias
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

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto
COPY . .

# Instalar las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto que usará Laravel
EXPOSE 10000

# Comando para arrancar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
