# Étape 1 : image PHP + extensions
FROM php:8.2-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    PATH="/root/.composer/vendor/bin:$PATH"

# Installer dépendances système + Node.js/NPM
RUN apk add --no-cache \
        bash \
        git \
        unzip \
        curl \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        oniguruma-dev \
        nodejs \
        npm \
        icu-dev \
        mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath intl gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tout le projet
COPY . .

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer dépendances Node et build Vite
RUN npm install
RUN npm run build

# Générer clé Laravel si absente
RUN php artisan key:generate

# Permissions pour storage + cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer port PHP-FPM
EXPOSE 9000

# Lancer PHP-FPM
CMD ["php-fpm"]