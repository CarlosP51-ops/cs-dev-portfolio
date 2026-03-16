#!/bin/bash

set -e

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

# Démarrer PHP-FPM en TCP sur 127.0.0.1:9000
php-fpm -D

# Attendre que PHP-FPM soit prêt
sleep 3

# Vérifier que PHP-FPM écoute bien
echo "PHP-FPM status:"
ss -tlnp | grep 9000 || netstat -tlnp | grep 9000 || echo "Port 9000 check skipped"

# Migrations
php artisan migrate --force 2>/dev/null || echo "Migration skipped"

# Storage link
php artisan storage:link --force 2>/dev/null || true

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Port Railway
PORT=${PORT:-8080}
echo "Démarrage Nginx sur le port $PORT"
sed -i "s|listen 8080;|listen ${PORT};|g" /etc/nginx/sites-available/default

# Tester nginx
nginx -t

# Démarrer Nginx
exec nginx -g "daemon off;"
