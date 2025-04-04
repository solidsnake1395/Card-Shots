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
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Obtener Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario sin privilegios
RUN useradd -G www-data,root -u 1000 -d /home/appuser appuser \
    && mkdir -p /home/appuser/.composer \
    && chown -R appuser:appuser /home/appuser

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar TODO el proyecto primero (incluye composer.json, lock, y bin/console)
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader --classmap-authoritative

# Crear carpetas necesarias y dar permisos
RUN mkdir -p var/cache var/log \
    && chown -R appuser:appuser var vendor \
    && chmod -R 775 var

# Limpiar caché de Symfony (modo prod)
RUN php bin/console cache:clear --env=prod || true

# Cambiar a usuario limitado
USER appuser

# Configurar entorno
ENV APP_ENV=prod
ENV APP_DEBUG=0

# Exponer puerto
EXPOSE ${PORT:-8000}

# Comando de inicio
CMD /bin/sh -c "php -S 0.0.0.0:$PORT -t public"
