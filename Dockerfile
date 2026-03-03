# =======================================
# Dockerfile multi-stage Laravel + React
# =======================================

# ==========================
# Stage 1 - Build Frontend
# ==========================
FROM node:18 AS frontend

# Répertoire de travail pour Node
WORKDIR /app

# Copier package.json et package-lock.json pour installer les dépendances
COPY package*.json ./

# Installer les dépendances Node
RUN npm install

# Copier le reste du projet frontend
COPY . .

# Construire le frontend avec Vite
RUN npm run build

# ==========================
# Stage 2 - Backend Laravel + PHP
# ==========================
FROM php:8.2-fpm AS backend

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git curl unzip libonig-dev libzip-dev zip libpng-dev libjpeg-dev libfreetype6-dev \
    libicu-dev libpq-dev \
    nodejs npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip gd bcmath intl exif pcntl

# Installer Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers de l'application
COPY . .

# Copier le build frontend depuis Stage 1
COPY --from=frontend /app/public/build ./public/build

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Nettoyer les caches Laravel
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Permissions pour storage et cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port PHP-FPM
EXPOSE 8080

# Lancer PHP-FPM
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080