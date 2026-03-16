#!/bin/bash

set -e

# Créer le répertoire pour le socket PHP-FPM
mkdir -p /var/run/php

# Créer le .env si absent
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Injecter les variables Railway dans le .env
for var in APP_NAME APP_ENV APP_KEY APP_DEBUG APP_URL \
           DB_CONNECTION DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD \
           SESSION_DRIVER CACHE_DRIVER QUEUE_CONNECTION; do
    value=$(printenv "$var" 2>/dev/null || true)
    if [ -n "$value" ]; then
        if grep -q "^${var}=" /var/www/html/.env; then
            sed -i "s|^${var}=.*|${var}=${value}|" /var/www/html/.env
        else
            echo "${var}=${value}" >> /var/www/html/.env
        fi
    fi
done

# Générer la clé app
php artisan key:generate --force

# Démarrer PHP-FPM
php-fpm -D

# Attendre que le socket soit prêt
sleep 2

# Migrations
php artisan migrate --force 2>/dev/null || echo "Migration skipped - DB not ready"

# Storage link
php artisan storage:link --force 2>/dev/null || true

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Remplacer le port nginx si Railway fournit $PORT
PORT=${PORT:-8080}
sed -i "s|listen 8080;|listen ${PORT};|g" /etc/nginx/sites-available/default

# Démarrer Nginx au premier plan
nginx -g "daemon off;"
