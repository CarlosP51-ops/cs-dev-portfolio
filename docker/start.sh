#!/bin/bash

set -e

# Créer le .env si absent
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Injecter les variables d'environnement dans le .env
for var in APP_NAME APP_ENV APP_KEY APP_DEBUG APP_URL \
           DB_CONNECTION DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD \
           SESSION_DRIVER CACHE_DRIVER QUEUE_CONNECTION \
           MAIL_MAILER MAIL_HOST MAIL_PORT MAIL_USERNAME MAIL_PASSWORD MAIL_ENCRYPTION MAIL_FROM_ADDRESS MAIL_FROM_NAME; do
    value=$(printenv "$var" 2>/dev/null || true)
    if [ -n "$value" ]; then
        if grep -q "^${var}=" /var/www/html/.env; then
            sed -i "s|^${var}=.*|${var}=${value}|" /var/www/html/.env
        else
            echo "${var}=${value}" >> /var/www/html/.env
        fi
    fi
done

# Nettoyer tous les caches avant de démarrer
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# Générer la clé app
php artisan key:generate --force

# Corriger les permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Démarrer PHP-FPM
php-fpm -D

# Attendre PHP-FPM
sleep 2

# Migrations + Seeders
echo "Lancement des migrations..."
php artisan migrate:refresh --force
echo "Lancement des seeders..."
php artisan db:seed --force || echo "Seeder warning (non bloquant)"

# Storage link
php artisan storage:link --force 2>/dev/null || true

# Reconstruire les caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Port Railway
PORT=${PORT:-8080}
echo "Démarrage Nginx sur le port $PORT"
sed -i "s|listen 8080;|listen ${PORT};|g" /etc/nginx/sites-available/default

nginx -t

exec nginx -g "daemon off;"
