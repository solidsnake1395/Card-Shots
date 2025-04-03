FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Limpiar caché
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario no root
RUN useradd -G www-data,root -u 1000 -d /home/appuser appuser \
    && mkdir -p /home/appuser/.composer \
    && chown -R appuser:appuser /home/appuser

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar composer.json y composer.lock
COPY composer.json composer.lock ./

# Instalar dependencias como root
RUN composer install --no-scripts --no-autoloader

# Copiar el resto de archivos
COPY . .

# Crear directorios necesarios y establecer permisos
RUN mkdir -p var/cache var/log \
    && chown -R appuser:appuser var \
    && chmod -R 775 var

# Cambiar al usuario no root
USER appuser

# Optimizar autoloader
RUN composer dump-autoload --optimize

# Configurar variables de entorno
ENV APP_ENV=prod
ENV APP_DEBUG=0

# Comando para iniciar la aplicación
CMD ["symfony", "server:start", "--no-tls", "--port=8000"] 