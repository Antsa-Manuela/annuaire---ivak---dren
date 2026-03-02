# Étape 1 : Node + PHP
FROM node:22-alpine AS node-build

WORKDIR /var/www/html

# Copier les fichiers
COPY . .

# Installer Node et build Vite
RUN npm install
RUN npm run build

# Étape 2 : PHP + Composer
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Installer extensions PHP
RUN apk add --no-cache bash git unzip curl libpng-dev libjpeg-turbo-dev freetype-dev oniguruma-dev icu-dev mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath intl gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier les fichiers buildés de Node
COPY --from=node-build /var/www/html /var/www/html

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Générer clé Laravel
RUN php artisan key:generate

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]