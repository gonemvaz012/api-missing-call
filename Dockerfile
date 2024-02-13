# Usa la imagen oficial de PHP 8.2 para arquitectura ARM64
FROM php:8.0-fpm

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libzip-dev

# Install PDO extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql


# Instala la extensión GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd

# Instala la extensión zip
RUN docker-php-ext-install zip

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configura el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto al contenedor
COPY . .

# Instala las dependencias de Composer
RUN composer install

# Expone el puerto 8002
ENV PHP_LOCAL_PORT=$PHP_LOCAL_PORT
EXPOSE $PHP_LOCAL_PORT

# Comando para iniciar el servidor de desarrollo en el puerto 8002
CMD php artisan serve --host=0.0.0.0 --port=$PHP_LOCAL_PORT
