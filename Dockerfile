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
    wget

# Limpiar caché
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Crear usuario no root
RUN useradd -m -u 1000 appuser

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar composer.json y composer.lock primero
COPY --chown=appuser:appuser composer.json composer.lock ./

# Instalar dependencias como root primero
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Instalar symfony/runtime específicamente
RUN composer require symfony/runtime --no-scripts

# Copiar el resto de archivos
COPY --chown=appuser:appuser . .

# Cambiar al usuario no root
USER appuser

# Ejecutar scripts post-install
RUN composer run-script post-install-cmd

# Exponer puerto
EXPOSE 8000

# Comando para iniciar la aplicación
CMD ["php", "-S", "0.0.0.0:8000", "public/index.php"] 