# ---- Base PHP ----
FROM php:8.3-fpm-alpine AS base

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances système nécessaires pour les extensions PHP
RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    zip \
    unzip \
    nginx \
    supervisor

# Installer les extensions PHP courantes pour Laravel
RUN docker-php-ext-install \
    bcmath \
    gd \
    mbstring \
    pdo_mysql \
    pdo_pgsql \
    xml \
    zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ---- Dépendances ----
FROM base AS dependencies

COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --prefer-dist --no-scripts

# ---- Frontend Assets ----
FROM node:20-alpine AS assets

# Accepter un argument pour l'URL de production
ARG APP_URL

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de dépendances et installer
COPY package.json package-lock.json vite.config.js ./
RUN npm install

# Copier le reste des fichiers nécessaires pour le build
COPY resources/ resources/
COPY tailwind.config.js postcss.config.js ./

# Compiler les assets pour la production
RUN VITE_APP_URL=${APP_URL} npm run build

# ---- Application ----
FROM base AS app

# Copier les dépendances installées
COPY --from=dependencies /var/www/html/vendor ./vendor
# Copier le code de l'application
COPY . .

# Copier la configuration Nginx et Supervisor
COPY .docker/nginx.conf /etc/nginx/nginx.conf
COPY .docker/supervisord.conf /etc/supervisord.conf
COPY .docker/start-container.sh /usr/local/bin/start-container.sh

RUN chmod +x /usr/local/bin/start-container.sh

# Copier les assets compilés
COPY --from=assets /app/public/build ./public/build

# Générer le fichier autoload optimisé
RUN composer dump-autoload --optimize


# Définir les permissions correctes pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Lancer Supervisor (qui gère Nginx et PHP-FPM)
CMD ["start-container.sh"]