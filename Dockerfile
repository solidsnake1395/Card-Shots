FROM php:8.2-cli

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip zip libicu-dev libonig-dev libzip-dev libpq-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia tu proyecto
WORKDIR /app
COPY . /app

# Instala dependencias
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Expone el puerto para PHP server
EXPOSE 8000

# Comando por defecto
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

RUN mkdir -p /var/lib/php/sessions \
    && chmod -R 777 /var/lib/php/sessions

ENV PHP_SESSION_SAVE_PATH=/var/lib/php/sessions
