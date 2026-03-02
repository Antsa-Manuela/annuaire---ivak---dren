# ==============================
# Dockerfile minimal pour Render
# ==============================

# Étape 1 : image PHP + extensions
FROM php:8.2-fpm-alpine

# Variables d'environnement pour éviter les interactions pendant l'installation
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    PATH="/root/.composer/vendor/bin:$PATH"

# Installer les dépendances système et extensions PHP nécessaires
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

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer les dépendances Node et builder Vite
RUN npm install
RUN npm run build

# Générer la clé Laravel si absente
RUN php artisan key:generate

# Donner les permissions nécessaires pour storage et bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port utilisé par PHP-FPM
EXPOSE 9000

# Commande par défaut pour lancer le serveur PHP-FPM
CMD ["php-fpm"]