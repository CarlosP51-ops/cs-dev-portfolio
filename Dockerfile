# Étape 1 : utiliser PHP 8.2 avec FPM
FROM php:8.2-fpm

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libpng-dev \
    npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tout le code du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer les dépendances Node (pour Tailwind/Vite)
RUN npm install
RUN npm run build

# Exposer le port que Render va utiliser
EXPOSE 10000

# Démarrer le serveur Laravel en utilisant la variable $PORT de Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT
